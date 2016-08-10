<?php
/**************************************************
 #	Version 1.2		PHP MySQL JavaScript
 #	Copyright (c) 2009 http://www.fangbian123.com
 #	Author: Li Zhixiao <English Name: Hawking E-mail:578731186@qq.com QQ:578731186>
 #	Date: 2009/10/10
 **************************************************/
header("Content-Type:text/html;charset=utf-8");

ini_set('date.timezone', 'Asia/Shanghai'); // 设置默认时间为北京时间

set_magic_quotes_runtime(0);

session_start();

define("LIMIT_SIZE", 2 * 1024 * 1024); // 文件上传大小限制

define("ROOTPATH", dirname(__FILE__) . '/');
define("CENTER_ROOTPATH",dirname(__FILE__).'/');

define('DBBACKUPPATH', 'D:/db/');
define("SP_BASEPATH", dirname(dirname(__FILE__)) . '\\');
define("WWWPATH", dirname(__FILE__) . '/../../');

// define("USERNAME", "FRED"); // 数据库连接用户名
// define("PASSWORD", "123456"); // 数据库连接密码
// define("SERVERNAME", "192.168.1.171"); // 数据库服务器的名称
// define("DBNAME", "project"); // 数据库名称
define("USERNAME", "root"); // 数据库连接用户名
define("PASSWORD", ""); // 数据库连接密码
define("SERVERNAME", "127.0.0.1"); // 数据库服务器的名称
define("DBNAME", "project"); // 数据库名称                      


//科室编号
$global_department = array(
    0 => array(
        "name" => "发展计划科",
        "status" => 0
    ),
    1 => array(
        "name" => "科技综合科",
        "status" => 0
    ),
    2 => array(
        "name" => "知识产权科",
        "status" => 0
    ),
    3 => array(
        "name" => "监察科",
        "status" => -1
    )
);

//表状态
$global_table_status = array(
    1 => array(
        "status" => "待提交",
        "manageStatus" => "等待用户提交"
    ),
    2 => array(
        "status" => "审核中", 
        "manageStatus" => "待审核"
    ),
    3 => array(
        "status" => "驳回修改",
        "manageStatus" => "文件已驳回，等待用户修改"
    ),
    4 => array(
        "status" => "审核通过",
        "manageStatus" => "审核通过"
        
    ),
    5 => array(
        "status" => "审核未通过",
        "manageStatus" => "审核未通过"
    ),
    6=> array(
        "status" => "填写过期",
        "manageStatus" => "填写过期"
    ),
    7=> array(
        "status" => "立项待审",
        "manageStatus" => "立项待审"
    )
);


//项目阶段
$global_project_stage = array(
   0 => array(
        "stage" => "申报阶段"
   ),
   1 => array(
        "stage" => "立项阶段"
   ),
   2 => array(
        "stage" => "实施阶段"
   ),
   3 => array(
        "stage" => "验收阶段"
   ),
   4 => array(
        "stage" => "项目存档"
   ),
   5 => array(
        "stage" => "储存阶段"
   )
);







