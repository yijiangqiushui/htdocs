<?php
/**
author:Gao Xue
date:2014-04-28
*/
include '../../../../../center/php/config.ini.php';
include '../../../../../common/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';
include '../../class/data/data.cls.php';
include '../../class/log/log.cls.php';

$action=$_GET['action'];

$dataname=$_POST['dataname'];

$backup['dbname']=$_POST['dbname'];
$backup['optname']=$_SESSION['admin_name'];
$backup['optdate']=date('Y-m-d H:i:s',time());

$page=$_POST['page'];
$rows=$_POST['rows'];

$dbname=$_POST['dbname'];

$data=new DATA();
$log=new LOGINFO();

switch($action){
	case 'backup':
		$data->backup($dataname);
		$log->addLog('数据库备份',$_SESSION['admin_name'],date('Y-m-d H:i:s',time()));
		break;
	case 'saveBackup':
		$data->saveBackup($backup);
		break;
	case 'queryBackup':;
		$data->queryBackup($page,$rows);
		break;
	case 'restoreData':
		$data->restoreData($dbname);
		$log->addLog('数据库还原',$_SESSION['admin_name'],date('Y-m-d H:i:s',time()));
		break;
	default:;
}
?>