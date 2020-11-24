<?php
error_reporting(0);
require_once 'db_conn.php';

class Load
{
    //需要计算的监控字段
    protected $diffFields = [
        'threads_created',
        'max_used_connections',
        'db_select',
        'db_insert',
        'db_update',
        'db_delete',
        'select_scan',
        'handler_read_key',
        'handler_read_first',
        'handler_read_last',
        'handler_read_next',
        'handler_read_prev',
        'handler_read_rnd',
        'handler_read_rnd_next',
        'innodb_row_lock_current_waits',
        'innodb_row_lock_time',
        'innodb_row_lock_time_avg',
        'innodb_row_lock_time_max',
        'innodb_row_lock_waits',
        'sort_merge_passes',
        'sort_range',
        'sort_scan',
        'sort_rows',
        'select_full_join',
        'select_full_range_join',
        'created_tmp_disk_tables',
        'created_tmp_tables',
        'created_tmp_files',
    ];
    protected $con;
    protected $config;

    public function __construct()
    {
        $this->con = conn('localhost:3306', 'root', '123456', 'monitor');
    }

    public function getList($instanceId, $type, $startTime, $endTime)
    {
        $isDiff = false;
        if (in_array($type, $this->diffFields)) {
            $isDiff    = true;
            $startTime += 1;
        }

        $data  = $this->getAll($instanceId, $type, $startTime, $endTime);
        $xList = array_column($data, 'minute_time');
        if ($isDiff) {
            array_pop($xList);
        }
        $dataList = array_column($data, $type);

        if ($isDiff) {
            $ret = [];
            foreach ($dataList as $k => $item) {
                if ($k == 0) {
                    continue;
                }
                $ret[] = intval($item) - intval($dataList[$k - 1]);
            }
            $dataList = $ret;
        }

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

        $sql = "select minute_time, {$type} from status_record where instance_id={$instanceId} and minute_time>={$startTime} and minute_time<={$endTime} order by minute_time asc";
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


