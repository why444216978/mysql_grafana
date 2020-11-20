
USE `monitor`;


DROP TABLE IF EXISTS `instance_info`;
CREATE TABLE `instance_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `host` varchar(100) NOT NULL COMMENT 'MySQL Host',
  `port` smallint(11) NOT NULL COMMENT 'MySQL Port',
  `user` varchar(100) NOT NULL COMMENT 'MySQL User',
  `password` varchar(100) NOT NULL COMMENT 'MySQL Password',
  `monitor` tinyint(1) DEFAULT '1' COMMENT '1开启，0关闭',
  `send_mail` tinyint(4) DEFAULT '1' COMMENT '1开启，0关闭',
  `send_mail_to_list` varchar(255) DEFAULT NULL COMMENT '邮件人列表',
  PRIMARY KEY (`id`),
  UNIQUE KEY `instance` (`host`,`port`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='监控信息表';


DROP TABLE IF EXISTS `instance_current_status`;
CREATE TABLE `instance_current_status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `instance_id` int(11) unsigned DEFAULT 0,
  `is_live` tinyint(4) unsigned DEFAULT 1,

  `max_connections` int(11) unsigned DEFAULT 0,
  `max_used_connections` int(11) unsigned DEFAULT 0,
  `threads_connected` int(11) unsigned DEFAULT 0,
  `threads_created` bigint(11) unsigned DEFAULT 0,

  `db_select` bigint(20) unsigned DEFAULT 0,
  `db_insert` bigint(20) unsigned DEFAULT 0,
  `db_update` bigint(20) unsigned DEFAULT 0,
  `db_delete` bigint(20) unsigned DEFAULT 0,

  `select_scan` bigint(20) unsigned DEFAULT 0,
  `handler_read_key` bigint(20) unsigned DEFAULT 0,
  `handler_read_first` bigint(20) unsigned DEFAULT 0,
  `handler_read_last` bigint(20) unsigned DEFAULT 0,
  `handler_read_next` bigint(20) unsigned DEFAULT 0,
  `handler_read_prev` bigint(20) unsigned DEFAULT 0,
  `handler_read_rnd` bigint(20) unsigned DEFAULT 0,
  `handler_read_rnd_next` bigint(20) unsigned DEFAULT 0,

  `innodb_row_lock_current_waits` bigint(20) unsigned DEFAULT 0,
  `innodb_row_lock_time` bigint(20) unsigned DEFAULT 0,
  `innodb_row_lock_time_avg` bigint(20) unsigned DEFAULT 0,
  `innodb_row_lock_time_max` bigint(20) unsigned DEFAULT 0,
  `innodb_row_lock_waits` bigint(20) unsigned DEFAULT 0,

  `sort_merge_passes` bigint(20) unsigned DEFAULT 0,
  `sort_range` bigint(20) unsigned DEFAULT 0,
  `sort_scan` bigint(20) unsigned DEFAULT 0,
  `sort_rows` bigint(20) unsigned DEFAULT 0,

  `select_full_join` bigint(20) unsigned DEFAULT 0,
  `select_full_range_join` bigint(20) unsigned DEFAULT 0,

  `created_tmp_disk_tables` bigint(20) unsigned DEFAULT 0,
  `created_tmp_tables` bigint(20) unsigned DEFAULT 0,
  `created_tmp_files` bigint(20) unsigned DEFAULT 0,

  `runtime` bigint(20) unsigned DEFAULT 0,
  `db_version` varchar(100) DEFAULT '',
  `create_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `instance` (`instance_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='当前监控信息表';


DROP TABLE IF EXISTS `status_record`;
CREATE TABLE `status_record` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `instance_id` int(11) unsigned DEFAULT 0,

  `max_used_connections` int(11) unsigned DEFAULT 0,
  `threads_connected` int(11) unsigned DEFAULT 0,
  `threads_created` bigint(11) unsigned DEFAULT 0,

  `db_select` bigint(20) unsigned DEFAULT 0,
  `db_insert` bigint(20) unsigned DEFAULT 0,
  `db_update` bigint(20) unsigned DEFAULT 0,
  `db_delete` bigint(20) unsigned DEFAULT 0,

  `select_scan` bigint(20) unsigned DEFAULT 0,
  `handler_read_key` bigint(20) unsigned DEFAULT 0,
  `handler_read_first` bigint(20) unsigned DEFAULT 0,
  `handler_read_last` bigint(20) unsigned DEFAULT 0,
  `handler_read_next` bigint(20) unsigned DEFAULT 0,
  `handler_read_prev` bigint(20) unsigned DEFAULT 0,
  `handler_read_rnd` bigint(20) unsigned DEFAULT 0,
  `handler_read_rnd_next` bigint(20) unsigned DEFAULT 0,

  `innodb_row_lock_current_waits` bigint(20) unsigned DEFAULT 0,
  `innodb_row_lock_time` bigint(20) unsigned DEFAULT 0,
  `innodb_row_lock_time_avg` bigint(20) unsigned DEFAULT 0,
  `innodb_row_lock_time_max` bigint(20) unsigned DEFAULT 0,
  `innodb_row_lock_waits` bigint(20) unsigned DEFAULT 0,

  `sort_merge_passes` bigint(20) unsigned DEFAULT 0,
  `sort_range` bigint(20) unsigned DEFAULT 0,
  `sort_scan` bigint(20) unsigned DEFAULT 0,
  `sort_rows` bigint(20) unsigned DEFAULT 0,

  `select_full_join` bigint(20) unsigned DEFAULT 0,
  `select_full_range_join` bigint(20) unsigned DEFAULT 0,

  `created_tmp_disk_tables` bigint(20) unsigned DEFAULT 0,
  `created_tmp_tables` bigint(20) unsigned DEFAULT 0,
  `created_tmp_files` bigint(20) unsigned DEFAULT 0,

  `runtime` bigint(20) unsigned DEFAULT 0,
  `minute_time` bigint(11)  NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `instance` (`instance_id`),
  KEY `min_time` (`min_time`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='历史监控信息记录表';

ALTER TABLE status_record modify `threads_created` int(11) unsigned DEFAULT 0;
ALTER TABLE status_record ADD `select_scan` int(11) unsigned DEFAULT 0;
ALTER TABLE status_record ADD `handler_read_key` int(11) unsigned DEFAULT 0;
ALTER TABLE status_record ADD `handler_read_first` int(11) unsigned DEFAULT 0;
ALTER TABLE status_record ADD `handler_read_last` int(11) unsigned DEFAULT 0;
ALTER TABLE status_record ADD `handler_read_next` int(11) unsigned DEFAULT 0;
ALTER TABLE status_record ADD `handler_read_prev` int(11) unsigned DEFAULT 0;
ALTER TABLE status_record ADD `handler_read_rnd` int(11) unsigned DEFAULT 0;
ALTER TABLE status_record ADD `handler_read_rnd_next` int(11) unsigned DEFAULT 0;
ALTER TABLE status_record ADD `innodb_row_lock_current_waits` int(11) unsigned DEFAULT 0;
ALTER TABLE status_record ADD `innodb_row_lock_time` int(11) unsigned DEFAULT 0;
ALTER TABLE status_record ADD `innodb_row_lock_time_avg` int(11) unsigned DEFAULT 0;
ALTER TABLE status_record ADD `innodb_row_lock_time_max` int(11) unsigned DEFAULT 0;
ALTER TABLE status_record ADD `innodb_row_lock_waits` int(11) unsigned DEFAULT 0;
ALTER TABLE status_record ADD `sort_merge_passes` int(11) unsigned DEFAULT 0;
ALTER TABLE status_record ADD `sort_range` int(11) unsigned DEFAULT 0;
ALTER TABLE status_record ADD `sort_scan` int(11) unsigned DEFAULT 0;
ALTER TABLE status_record ADD `sort_rows` int(11) unsigned DEFAULT 0;
ALTER TABLE status_record ADD `select_full_join` int(11) unsigned DEFAULT 0;
ALTER TABLE status_record ADD `select_full_range_join` int(11) unsigned DEFAULT 0;
ALTER TABLE status_record ADD `created_tmp_disk_tables` int(11) unsigned DEFAULT 0;
ALTER TABLE status_record ADD `created_tmp_tables` int(11) unsigned DEFAULT 0;
ALTER TABLE status_record ADD `created_tmp_files` int(11) unsigned DEFAULT 0;

