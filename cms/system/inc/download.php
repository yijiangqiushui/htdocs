<?php
/************************************************************************************************************
#	PHP Version 1.2   MySQL  JavaScript
#	Copyright (c) 2009 http://www.cnalog.com
#	Author: Li Zhixiao <English Name: Hawking E-mail:lzxbit2008@yahoo.com.cn QQ:578731186>
#	Date: 2009/10/10
************************************************************************************************************/

require_once('../../config.ini.php');
require_once(ROOTPATH.'system/class/user.cls.php');

$userCls=new user();

/**
* 在该部分判断管理员身份，非管理员不进行处理
**/
$type='content';

if(empty($_COOKIE['uid']) && $_SESSION['S_A_ID']==''){
	echo '<script type="text/javascript">alert("提示：对不起，游客无权下载该文件，请先登录！");window.opener=null;window.close();</script>';
	exit;
}
//预留位置

$id=intval($_GET['id']);

if($id>0){
	$sql="select filePath from ".$type."Info where id=$id";
	$r=$userCls->select($sql);
	$file_path='../..'.$r[0][filePath];
	$fileArr=explode('/',$file_path);
	$file_name=$fileArr[count($fileArr)-1];
	header("Content-type:application/octet-stream;charset=utf8");
	header("Accept-Ranges:bytes");
	header("Accept-Length:".filesize($file_path));
	header("Content-Disposition:attachment;filename=".$file_name);
 ob_clean();  
  flush();  
	$fp=fopen($file_path,"r");
	echo fread($fp,filesize($file_path));
	fclose($fp);
}
else
	echo '<script type="text/javascript">alert("提示：页面发生错误，无法下载！");window.opener=null;window.close();</script>';
?>