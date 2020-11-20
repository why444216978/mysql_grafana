<?php
error_reporting(0);
require_once 'load_class.php';

if (!$_POST['type']) {
    $config        = require_once 'config.php';
    $_POST['type'] = current($config['status_fields']);
}
$load = new Load();
if(!$_POST['instance']){
    $instanceList = $load->getInstanceList();
    $instance = current($instanceList);
    $_POST['instance'] = $instance['id'];
}


$time = time();
if(!$_POST['start_time']){
    $_POST['start_time'] = date('YmdHi', $time - 3600 * 3);
}else{
    $_POST['start_time'] = date('YmdHi', strtotime($_POST['start_time']));
}

if(!$_POST['end_time']){
    $_POST['end_time'] = date('YmdHi', $time);
}{
    $_POST['end_time'] = date('YmdHi', strtotime($_POST['end_time']));
}

$data = $load->getList($_POST['instance'], $_POST['type'], $_POST['start_time'], $_POST['end_time']);
echo json_encode($data);

