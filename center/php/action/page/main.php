<?php
/**************************************************
#	Version 1.2		PHP MySQL JavaScript
#	Copyright (c) 2009 http://www.fangbian123.com
#	Author: Li Zhixiao <English Name: Hawking E-mail:578731186@qq.com QQ:578731186>
#	Date: 2009/10/10
#	Modified by Li Zhixiao	2014/03/14
**************************************************/
include '../../../../common/php/config.ini.php';
include '../../config.ini.php';
include ROOTPATH.'lib/db.cls.php';
include ROOTPATH.'lib/user.cls.php';
include ROOTPATH.'lib/main.cls.php';

/**
*功能：处理管理面板信息
*/
{
	$main=new MAIN();
	
	$action=$_GET['action'];
	switch($action){
		case 'init':{
			$main->Init();
		};break;
		case 'logout':{
			$main->Logout();
		};break;
		case 'lck_scr':{
			$main->LockScreen();
		};break;
		case 'unlck_scr':{
			$main->Unlock();
		};break;
		case 'cur_user':{
			$main->getCuruser();	
		}
	}
}
?>