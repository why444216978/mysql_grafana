<?php
error_reporting(0);
require_once 'db_conn.php';

class Load
{
    protected $con;

    public function __construct()
    {
        $this->con = conn('localhost:3306', 'root', '123456', 'monitor');
    }

    public function getList($type, $startTime, $endTime)
    {
        $data     = $this->getAll($startTime, $endTime);
        $xList    = array_column($data, 'minute_time');
        $dataList = array_column($data, $type);

        $data = [
            'x_list'      => $xList,
            'select_list' => $dataList,
            'title'       => $type . '数变化趋势图',
            'name'        => 'count',
        ];
        return $data;
    }

    protected function getAll($startTime, $endTime)
    {
        $startTime = intval(date('YmdHi', strtotime($startTime)));
        $endTime = intval(date('YmdHi', strtotime($endTime)));

        $sql    = "select * from status_record where minute_time>={$startTime} and minute_time<={$endTime} order by minute_time asc";
        $result = mysqli_query($this->con, $sql);
        $data   = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }
}
if (!$_POST['type']) {
    $config = require_once 'config.php';
    $_POST['type'] = current($config['status_fields']);
}
$load = new Load();
$data = $load->getList($_POST['type'], $_POST['start_time'], $_POST['end_time']);
echo json_encode($data);

