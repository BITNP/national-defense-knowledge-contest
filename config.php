<?php
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
$cnt_judge      = 2;        //每份试题判断题数量
$cnt_choose     = 2;        //每份试题选择题数量
$score_judge    = 25;       //判断题单题分值
$score_choose   = 25;       //选择题单题分值

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
?>