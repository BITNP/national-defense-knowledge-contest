<?php
date_default_timezone_set("PRC");

//database configuration
$db_host        = "localhost";
$db_username    = "root";
$db_password    = "";
$db_name        = "gfexam";

//CAS server
$cas_host       = 'login.bit.edu.cn';
$cas_port       = 443;
$cas_uri        = 'devcas';

//题库设置
$cnt_judge      = 20;        //每份试题判断题数量
$cnt_choose     = 10;        //每份试题选择题数量
$score_judge    = 2;       //判断题单题分值
$score_choose   = 4;       //选择题单题分值

//活动结束时间
$END_TIME       = strtotime('2018-12-1 23:59');

//答题机会
$CHANCE = 5;

/*
php extentions
- PDO

- mbstring
 (php.ini)
 extension=php_mbstring.dll
 mbstring.language = Chinese
 mbstring.internal_encoding = UTF-8

- php-gd
*/