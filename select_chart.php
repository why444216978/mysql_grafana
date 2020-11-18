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
$sql          = 'select * from status_record';
$result       = mysqli_query($con, $sql);
$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}
print_r($data);