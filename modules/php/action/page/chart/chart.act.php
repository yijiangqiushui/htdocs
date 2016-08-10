<?php
/*
author:Hao xiaoqiang
date:2014-06-10
*/
include '../../../../../common/php/config.ini.php';
include '../../../config.ini.php';
include '../../../../../common/php/lib/db.cls.php';

include '../../class/chart/chart.cls.php';

$action=$_GET['action'];	
$chart=new Chart();
	
switch($action){
	case 'type_comm':		
		$chart->getTypeData_comm();
		break;
	case 'address_comm':		
		$chart->getAddressData_comm();
		break;
	case 'address_app':		
		$chart->getAddressData_app();
		break;
	case 'economic':		
		$chart->getEconomic();
		break;
	case 'source':		
		$chart->getSource();
		break;	
	case 'science':		
		$chart->getScience();
		break;		
		
		
		
		
		
		
		
		
		
	
	default:;	
}
	
?>