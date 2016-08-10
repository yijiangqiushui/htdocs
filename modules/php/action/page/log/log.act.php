<?php
/**
author:Gao Xue
date:2014-04-28
*/

include '../../../../../center/php/config.ini.php';
include '../../../../../common/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';
include '../../class/log/log.cls.php';

$action=$_GET['action'];

$loginfo['opt']=$_POST['option'];
$loginfo['username']=$_SESSION['admin_name'];
$loginfo['timedata']=date('Y-m-d H:i:s',time());

$page=$_POST['page'];
$rows=$_POST['rows'];

$log=new LOGINFO();

switch($action){
	case 'addLog':
		$log->addLog($loginfo);
		break;
	case 'queryLog':
		$log->queryLog($page,$rows);
		break;
	default:;
}

/*function addLog($loginfo){
	$log=new LOGINFO();
	$log->addLog($loginfo);
}

function queryLog($page,$rows){
	$log=new LOGINFO();
	$log->queryLog($page,$rows);
}*/
?>