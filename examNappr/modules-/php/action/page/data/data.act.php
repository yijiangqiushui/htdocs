<?php
/**
author:Gao Xue
date:2014-04-28
modify:Wang Le
date:2014-09-05
*/
include '../../../../../common/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';

include '../../class/data/data.cls.php';
include '../../class/log/log.cls.php';

switch($_GET['action']){
	case 'backup':
		$data=new DATA();
		$log=new LOGINFO();
		
		$dataname=$_POST['dataname'];
		$data->backup($dataname);
		
		//$log->addLog('数据库备份',$_SESSION['admin_name'],date('Y-m-d H:i:s',time()));
		$log->addLog('数据库备份',$_SESSION['realname'],date('Y-m-d H:i:s',time()));
		break;
	case 'saveBackup':
		$data=new DATA();
		$log=new LOGINFO();
		
		$backup['dbname']=$_POST['dbname'];
		//$backup['optname']=$_SESSION['admin_name'];
		$backup['optname']=$_SESSION['realname'];
		$backup['optdate']=date('Y-m-d H:i:s',time());
		
		$data->saveBackup($backup);
		break;
	case 'queryBackup':
		$data=new DATA();
		$log=new LOGINFO();
	
		$page=$_POST['page'];
		$rows=$_POST['rows'];
		
		$data->queryBackup($page,$rows);
		break;
	case 'restoreData':
		$data=new DATA();
		$log=new LOGINFO();
		
		$dbname=$_POST['dbname'];
		$data->restoreData($dbname);
		//$log->addLog('数据库还原',$_SESSION['admin_name'],date('Y-m-d H:i:s',time()));
		$log->addLog('数据库还原',$_SESSION['realname'],date('Y-m-d H:i:s',time()));
		break;
	default:;
}

?>