<?php
//注意：添加监控字段，需对应表中添加相应映射字段。

return [
    //对应 show global status like 'db_select' 等
    'status_fields'    => [
        'Com_select'           => 'db_select',
        'Com_insert'           => 'db_insert',
        'Com_update'           => 'db_update',
        'Com_delete'           => 'db_delete',
        'Uptime'               => 'runtime',
        'Threads_connected'    => 'threads_connected',
        'Max_used_connections' => 'max_used_connections',
    ],

    //对应 show global variables like 'db_select' 等
    'variables_fields' => [
        'max_connections' => 'max_connections',
        'version'         => 'db_version',
    ],
];