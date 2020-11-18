<?php
error_reporting(0);
require_once 'db_conn.php';

$cfg          = [
    'host'     => 'localhost:3306',
    'user'     => 'root',
    'password' => '123456',
    'db'       => 'monitor',
];
$con          = conn('localhost:3306', 'root', '123456', 'monitor');
$sql          = 'select * from instance_info';
$result       = mysqli_query($con, $sql);
$instanceList = [];
while ($row = mysqli_fetch_assoc($result)) {
    $instanceList[] = $row;
}
if (!$instanceList) {
    exit('no instance');
}

$config          = require_once 'config.php';
$statusFields    = array_keys($config['status_fields']);
$variablesFields = array_keys($config['variables_fields']);

$statusFields = array_map(function ($item) {
    return '^' . $item . '$';
}, $statusFields);

$variablesFields = array_map(function ($item) {
    return '^' . $item . '$';
}, $variablesFields);
$sqlList         = [
    "show global status where variable_name regexp '" . implode('|', $statusFields) . "'",
    "show global variables where variable_name regexp '" . implode('|', $variablesFields) . "'",
];

foreach ($instanceList as $instance) {
    $data = [];

    $instanceConn = conn($instance['host'], $instance['user'], $instance['password'], '');
    foreach ($sqlList as $sql) {
        $result = mysqli_query($instanceConn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $data[$row['Variable_name']] = $row['Value'];
        }
    }

    $updateFields = array_merge($config['status_fields'], $config['variables_fields']);

    $updateSql = 'update instance_current_status set ';
    foreach ($updateFields as $k => $v) {
        if ($k == 'version') {
            $updateSql .= ($v . '=\'' . $data[$k]) . '\',';
        } else {
            $updateSql .= ($v . '=' . $data[$k]) . ',';
        }
    }
    $updateSql = substr_replace($updateSql, "", -1);
    $updateSql .= 'where instance_id=' . $instance['id'];
    $result    = mysqli_query($con, $updateSql);

    $insertSql = sprintf("insert into status_record values(null, %d, %d,%d,%d,%d,%d,%d,%d,'%s');",
        $instance['id'],
        $data['Max_used_connections'],
        $data['Threads_connected'],
        $data['Com_select'],
        $data['Com_insert'],
        $data['Com_update'],
        $data['Com_delete'],
        $data['Uptime'],
        date('YmdHi')
    );
    $result = mysqli_query($con, $insertSql);
    print_r($data) . "\n";
}

mysqli_close($con);
?>