<?php
$config = require_once 'config.php';
echo json_encode(array_values($config['status_fields']));
