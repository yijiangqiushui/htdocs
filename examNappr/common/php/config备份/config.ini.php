<?php
/**************************************************
#	Version 1.2		PHP MySQL JavaScript
#	Copyright (c) 2009 http://www.fangbian123.com
#	Author: Li Zhixiao <English Name: Hawking E-mail:578731186@qq.com QQ:578731186>
#	Date: 2009/10/10
**************************************************/
header("Content-Type:text/html;charset=utf-8");

ini_set('date.timezone','Asia/Shanghai');					//设置默认时间为北京时间

set_magic_quotes_runtime(0);

session_start();

define("LIMIT_SIZE",2*1024*1024);		//文件上传大小限制

define("ROOTPATH",dirname(__FILE__).'/');

/**************/
define("CENTER_ROOTPATH",dirname(__FILE__).'/');

define("SP_ROOTPATH",dirname(__FILE__).'\\');
define("SP_BASEPATH",dirname(dirname(__FILE__)).'\\');

define('DBBACKUPPATH','d:/db/');

// define("USERNAME","root");									//数据库连接用户名
// define("PASSWORD","");									//数据库连接密码
// define("SERVERNAME","localhost");							//数据库服务器的名称
// define("DBNAME","examine");//数据库名称


define ( "USERNAME", "FRED" ); // 数据库连接用户名
define ( "PASSWORD", "123456" ); // 数据库连接密码
define ( "SERVERNAME", "192.168.1.171" ); // 数据库服务器的名称
define ( "DBNAME", "project" ); // 数据库名称


/*
//基地名称
define('BASE','所有分类');

define('FACE','
	http://image.crewcn.com/news/images/face/face1.gif,
	http://image.crewcn.com/news/images/face/face2.gif,
	http://image.crewcn.com/news/images/face/face3.gif,
	http://image.crewcn.com/news/images/face/face5.gif,
	http://image.crewcn.com/news/images/face/face6.gif,
	http://image.crewcn.com/news/images/face/face7.gif,
	http://image.crewcn.com/news/images/face/face8.gif,
	http://image.crewcn.com/news/images/face/face9.gif,
	http://image.crewcn.com/news/images/face/face10.gif,
	http://image.crewcn.com/news/images/face/face11.gif,
	http://image.crewcn.com/news/images/face/face12.gif,
	http://image.crewcn.com/news/images/face/face13.gif,
	http://image.crewcn.com/news/images/face/face14.gif,
	http://image.crewcn.com/news/images/face/face15.gif,
	http://image.crewcn.com/news/images/face/face16.gif,
	http://image.crewcn.com/news/images/face/face17.gif,
	http://image.crewcn.com/news/images/face/face18.gif,
	http://image.crewcn.com/news/images/face/face19.gif
');

define('PIC','
	http://image.crewcn.com/news/images/face/pic1.gif,
	http://image.crewcn.com/news/images/face/pic2.gif,
	http://image.crewcn.com/news/images/face/pic3.gif,
	http://image.crewcn.com/news/images/face/pic4.gif,
	http://image.crewcn.com/news/images/face/pic5.gif,
	http://image.crewcn.com/news/images/face/pic6.gif,
	http://image.crewcn.com/news/images/face/pic7.gif,
	http://image.crewcn.com/news/images/face/pic8.gif,
	http://image.crewcn.com/news/images/face/pic9.gif,
	http://image.crewcn.com/news/images/face/pic10.gif
');
*/
								
?>