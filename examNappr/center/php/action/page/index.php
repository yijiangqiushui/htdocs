<?php
/**************************************************
#	Version 1.2		PHP MySQL JavaScript
#	Copyright (c) 2009 http://www.fangbian123.com
#	Author: Li Zhixiao <English Name: Hawking E-mail:578731186@qq.com QQ:578731186>
#	Date: 2009/10/10
#	Modified by Li Zhixiao	2014/03/14
**************************************************/
include '../../../../common/php/config.ini.php';
include '../../../../common/php/lib/common.cls.php';
include '../../../../common/php/lib/db.cls.php';
include '../../../../common/php/lib/user.cls.php';
/**
*功能：处理登录信息
*/
{
	$usr=new USER();
	$usr->CheckLogin($_POST['NTID'],$_POST['Digest'],$_POST['flag'],$_POST['usr'],$_POST['userPin'],$_POST['validateCode']);
}
?>