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

    public function getList($instanceId, $type, $startTime, $endTime)
    {
        $data = $this->getAll($instanceId, $type, $startTime, $endTime);
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

    protected function getAll($instanceId, $type, $startTime, $endTime)
    {
        $startTime = intval(date('YmdHi', strtotime($startTime)));
        $endTime   = intval(date('YmdHi', strtotime($endTime)));

        $sql = "select 'minute_time', {$type} from status_record where instance_id={$instanceId} and minute_time>={$startTime} and minute_time<={$endTime} order by minute_time asc";
        return $this->query($sql);
    }

    public function getInstanceList()
    {
        $sql = 'select * from instance_info order by id asc';
        return $this->query($sql);
    }

    protected function query($sql)
    {
        $result = mysqli_query($this->con, $sql);
        $data   = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }
}


