# mysql_grafana
PHP实现的MySQL监控组件，包含数据采集和web端可视化监控，可灵活扩展监控指标。
<br>
PS：代码还在完善中，后续会进行封装，以及部分可配置化。
<br><br>


#### 数据库：monitor

#### 数据表：database.sql文件

#### 修改 config.php 中的 status 和 variables_fields 监控指标字段

#### 配置增长字段进行分钟减法计算
load_class.php 的 $diffFields 变量

#### 插入监控实例（可多个）
```
INSERT INTO `monitor`.`instance_info`(`id`, `host`, `port`, `user`, `password`, `monitor`, `send_mail`, `send_mail_to_list`) VALUES (1, '127.0.0.1', 3306, 'root', '123456', 1, 1, 'why@qq.com');
```

#### 修改数据库连接
db_conn.php

#### 配置ajax请求host
config.js

#### 配置定时任务
crontab -e
```
* * * * * /usr/bin/php /Users/why/Desktop/php/mysql_grafana/save_status.php
```

#### 修改展示页面请求url为自己的

#### 查看数据
浏览器：http://localhost/mysql_grafana/index.html

#### 监控图
<img src="https://github.com/why444216978/mysql_grafana/blob/master/threads_connected.png" width="600" height="200"/>
<img src="https://github.com/why444216978/mysql_grafana/blob/master/select.png" width="600" height="200" alt="图片描述文字"/>
