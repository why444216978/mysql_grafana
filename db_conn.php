<?php
function &conn($host, $user, $password, $db = '')
{
    static $dbList = [];
    if (!empty($dbList[$db])) {
        return $dbList[$db];
    }

    $con = mysqli_connect($host, $user, $password, $db);
    if (mysqli_connect_errno()) {
        throw new Exception(mysqli_connect_error(), mysqli_errno($con));
    }
    $dbList[$db] = $con;

    return $dbList[$db];
}

