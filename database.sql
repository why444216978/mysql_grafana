
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
  `instance_id` int(11) DEFAULT 0,
  `is_live` tinyint(4) DEFAULT 1,
  `max_connections` int(11) DEFAULT 0,
  `max_used_connections` int(11) DEFAULT 0,
  `threads_connected` int(11) DEFAULT 0,
  `db_select` int(11) DEFAULT 0,
  `db_insert` int(11) DEFAULT 0,
  `db_update` int(11) DEFAULT 0,
  `db_delete` int(11) DEFAULT 0,
  `runtime` int(11) DEFAULT 0,
  `db_version` varchar(100) DEFAULT '',
  `create_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `instance` (`instance_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='当前监控信息表';


DROP TABLE IF EXISTS `status_record`;
CREATE TABLE `status_record` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `instance_id` int(11) DEFAULT 0,
  `max_used_connections` int(11) DEFAULT 0,
  `threads_connected` int(11) DEFAULT 0,
  `db_select` int(11) DEFAULT 0,
  `db_insert` int(11) DEFAULT 0,
  `db_update` int(11) DEFAULT 0,
  `db_delete` int(11) DEFAULT 0,
  `runtime` int(11) DEFAULT 0,
  `minute_time` bigint(11) NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `instance` (`instance_id`),
  KEY `min_time` (`min_time`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='历史监控信息记录表';

