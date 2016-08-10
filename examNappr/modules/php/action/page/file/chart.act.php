<?php
/*
author:Zhao Xiaogang
date:2015-03-18
Modify by: Ma Jun wei
date:2015-03-19
*/
include '../../../../../common/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';
include '../../class/log/log.cls.php';

include '../../class/file/chart.cls.php';

$action=$_GET['action'];	
$chart=new Chart();
	
switch($action){
	case 'type_comm':		
		$chart->getTypeData_comm();
		break;
	case 'dept_comm':		
		$chart->getDeptData_comm();
		break;
	case 'level_comm':		
		$chart->getLevelData_comm();
		break;
	case 'addedDate_comm':		
		$chart->getaddedData_comm();
		break;
	case 'getBorrowDataTotal':
		$chart->getBorrowDataTotal();
		break;
	case 'getUseTimeDataTotal':
		$chart->getUseTimeDataTotal();
		break;
	case 'getDeptDataTotal':
		$chart->getDeptDataTotal();
		break;
	case 'getConDataTotal':
		$chart->getConDataTotal();
		break;
	case 'addedDate_sms':		
		$chart->getaddedData_sms();
		break;
	default:;	
}
	
?>