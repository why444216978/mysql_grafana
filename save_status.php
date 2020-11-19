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

$updateMap = array_merge($config['status_fields'], $config['variables_fields']);
foreach ($instanceList as $instance) {
    $data = [];

    $instanceConn = conn($instance['host'], $instance['user'], $instance['password'], '');
    foreach ($sqlList as $sql) {
        $result = mysqli_query($instanceConn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $data[$row['Variable_name']] = $row['Value'];
        }
    }

    //更新instance当前状态
    $updateSql = 'update instance_current_status set ';
    foreach ($updateMap as $k => $v) {
        if ($k == 'version') {
            $updateSql .= ($v . '=\'' . $data[$k]) . '\',';
        } else {
            $updateSql .= ($v . '=' . $data[$k]) . ',';
        }
    }
    $updateSql = substr_replace($updateSql, "", -1);
    $updateSql .= 'where instance_id=' . $instance['id'];
    $result    = mysqli_query($con, $updateSql);

    //记录instance历史状态
    $insertMap    = $config['status_fields'];
    $insertFields = ['instance_id'];
    $insertValues = [$instance['id']];
    foreach ($insertMap as $k => $v) {
        $insertValues[] = $data[$k];
        $insertFields[] = $v;
    }
    $insertFields[] = 'minute_time';
    $insertValues[] = date('YmdHi');

    $insertSql = sprintf("insert into status_record(%s) values(%s);", implode(',', $insertFields), implode(',', $insertValues));
    $result = mysqli_query($con, $insertSql);
    mysqli_close($instanceConn);
    echo $insertSql . "\n";
    var_dump($result);
}

mysqli_close($con);
?>