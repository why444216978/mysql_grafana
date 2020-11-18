<?php
error_reporting(0);
require_once 'db_conn.php';

$cfg    = [
    'host'     => 'localhost:3306',
    'user'     => 'root',
    'password' => '123456',
    'db'       => 'monitor',
];
$con    = conn('localhost:3306', 'root', '123456', 'monitor');
$sql    = 'select * from status_record order by minute_time asc';
$result = mysqli_query($con, $sql);
$data   = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

$xList      = array_column($data, 'minute_time');
$seriesList = array_column($data, 'db_select');

$data = [
    'x_list'      => $xList,
    'series_list' => $seriesList,
];
echo json_encode($data);
