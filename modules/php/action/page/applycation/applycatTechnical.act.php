<?php
/**
author:Gao Xue 
date:2014-05-24
*/

include '../../../../../center/php/config.ini.php';
include '../../../../../common/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';
include '../../class/applycation/applycatTechnical.cls.php';

$action=$_GET['action'];
$page=$_POST['page'];
$rows=$_POST['rows'];

$upper_id=$_GET['upper_id'];
$upperid=$_POST['upperid'];

$cat['upper_id']=$_POST['upper_id'];
$cat['upper_cat']=$_POST['upper_cat'];
$cat['cat_name']=$_POST['cat_name'];

$id=$_GET['id'];
$edtid=$_GET['id'];
$list=$_GET['idlist'];
$flag=$_GET['flag'];

$applycat=new APPLYCAT();
switch($action){
	case 'treeData':
		$applycat->treeData($flag,$upper_id);
		break;
	case 'gridData':
		$applycat->gridData();
		break;
	case 'saveCat':
		$applycat->saveCat($cat);
		break;
	case 'findCat':
		$applycat->findCat($id);
		break;
	case 'saveEdtCat':
		$applycat->saveEdtCat($edtid,$cat);
		break;
	case 'delCat':
		$applycat->delCat($id);
		break;
	case 'delCatlist':
		$applycat->delCatlist($list);
		break;
	case 'disableCat':
		$applycat->disableCat($list,$flag);
		break;
	case 'loadExpertTree':
		$applycat->loadExpertTree($upper_id);
	default:;
}



?>