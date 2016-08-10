<?php
/**
author:Ma Jun wei
date:2015-02-27
*/
include '../../../../../common/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';
include '../../class/log/log.cls.php';
include '../../class/csv/csv_list.cls.php';
switch($_GET['action']){
	case 'import':
		{
			$admin_id=$_GET['admin_id'];
			$isRecovery=$_GET['isRecovery'];
			//$admin_id=$_SESSION['admin_id'];
			$csv=new CSVList();
			$csv->import_list($admin_id,$isRecovery);
			//$log=new LOGINFO();
			//$log->addLog('导入通讯录',$_SESSION['admin_name'],date('Y-m-d H:i:s',time()));
		}
		break;
	case 'export':
		{
			$csv=new CSVList();
			$csv->export_list($_GET['admin_id'],$_GET['category'],$_GET['otherListID'],$_GET['admin_other']);
			//$log=new LOGINFO();
			//$log->addLog('导出通讯录',$_SESSION['admin_name'],date('Y-m-d H:i:s',time()));
		}
		break;
	default:;
}
?>
