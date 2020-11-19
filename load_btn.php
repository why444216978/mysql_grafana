<?php
require_once 'load_class.php';
$config = require_once 'config.php';

$load = new Load();
$instanceList = $load->getInstanceList();

$data = [
    'status_fields' => array_values($config['status_fields']),
    'instance_list' => $instanceList,
];
echo json_encode($data);
