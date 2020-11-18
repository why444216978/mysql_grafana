<?php
return [
    'status_fields'    => [
        'Com_select'           => 'db_select',
        'Com_insert'           => 'db_insert',
        'Com_update'           => 'db_update',
        'Com_delete'           => 'db_delete',
        'Uptime'               => 'runtime',
        'Threads_connected'    => 'threads_connected',
        'Max_used_connections' => 'max_used_connections',
    ],
    'variables_fields' => [
        'max_connections' => 'max_connections',
        'version'         => 'db_version',
    ],
];