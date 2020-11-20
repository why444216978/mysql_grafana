<?php
//注意：添加监控字段，需对应表中添加相应映射字段。

return [
    //对应 show global status like 'db_select' 等
    'status_fields'    => [
        'Com_select' => 'db_select',
        'Com_insert' => 'db_insert',
        'Com_update' => 'db_update',
        'Com_delete' => 'db_delete',
        'Uptime'     => 'runtime',

        'Threads_connected'    => 'threads_connected',
        'Threads_created'      => 'threads_created',
        'Max_used_connections' => 'max_used_connections',

        'Select_scan'           => 'select_scan',
        'Handler_read_key'      => 'handler_read_key',
        'Handler_read_first'    => 'handler_read_first',
        'Handler_read_last'     => 'handler_read_last',
        'Handler_read_next'     => 'handler_read_next',
        'Handler_read_prev'     => 'handler_read_prev',
        'Handler_read_rnd'      => 'handler_read_rnd',
        'Handler_read_rnd_next' => 'handler_read_rnd_next',

        'Innodb_row_lock_current_waits' => 'innodb_row_lock_current_waits',
        'Innodb_row_lock_time'          => 'innodb_row_lock_time',
        'Innodb_row_lock_time_avg'      => 'innodb_row_lock_time_avg',
        'Innodb_row_lock_time_max'      => 'innodb_row_lock_time_max',
        'Innodb_row_lock_waits'         => 'innodb_row_lock_waits',

        'Sort_merge_passes' => 'sort_merge_passes',
        'Sort_range'        => 'sort_range',
        'Sort_scan'         => 'sort_scan',
        'Sort_rows'         => 'sort_rows',

        'Select_full_join'       => 'select_full_join',
        'Select_full_range_join' => 'select_full_range_join',

        'Created_tmp_disk_tables' => 'created_tmp_disk_tables',
        'Created_tmp_tables'      => 'created_tmp_tables',
        'Created_tmp_files'       => 'created_tmp_files',

    ],

    //对应 show global variables like 'db_select' 等
    'variables_fields' => [
        'max_connections' => 'max_connections',
        'version'         => 'db_version',
    ],
];