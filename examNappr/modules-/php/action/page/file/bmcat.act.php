<?php
/**
author:Wang Le
date:2015-06-01
*/

include '../../../../../common/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';
include '../../class/file/bmcat.cls.php';
include '../../class/log/log.cls.php';

switch($_GET['action']){
	case 'treeData':
		$cat=new BmCat();
		$up_id=$_GET['up_id'];
		$cat->treeData($up_id);//,$_GET['contentID']);
		break;
	case 'getAllCat':
		$cat=new BmCat();
		$cat->getAllCat($_GET['up_id']);
		break;
	default:;
}
?>