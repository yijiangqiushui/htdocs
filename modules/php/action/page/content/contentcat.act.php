<?php
/**
author:Gao Xue
date:2014-05-06
*/

include '../../../config.ini.php';
include '../../../../../common/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';
include '../../class/content/contentcat.cls.php';

$cat=new CONTENTCAT();

$action=$_GET['action'];

//treeData parame:up_id
$up_id=$_GET['up_id'];

//datagrid param:page,rows,upid
$page=$_POST['page'];
$rows=$_POST['rows'];
$upid=$_POST['upid'];

//saveCat
$catInfo['upper_id']=$_POST['upper_id'];
$catInfo['upper_cat']=$_POST['upper_cat'];
$catInfo['exclusive_name']=$_POST['exclusive_name'];
$catInfo['cat_name']=$_POST['cat_name'];
$catInfo['is_forbidden']=$_POST['is_forbidden'];
$catInfo['is_recommend']=$_POST['is_recommend'];

//delCat
$id=intval($_GET['id']);
$idlist=$_GET['idlist'];

switch($action){
	case 'treeData':
		$cat->treeData();
		break;
	case 'catGrid':
		$cat->catGrid();
		break;
	case 'saveCat':
		$cat->saveCat();
		break;
	case 'findCat':
		$cat->findCat($id);
		break;
	case 'saveEdtEle':
		$cat->saveEdtEle($id,$catInfo);
		break;
	case 'delCat':
		$cat->delCat($id);
		break;
	case 'delArrCat':
		$cat->delArrCat();
		break;
	default:;
}
?>