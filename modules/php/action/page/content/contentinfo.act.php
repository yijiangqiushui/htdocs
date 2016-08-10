<?php
/**
author:Gao Xue
date:2014-05-07
*/

include '../../../config.ini.php';
include '../../../../../common/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';
include '../../../../../common/php/lib/file.cls.php';
include '../../class/content/contentinfo.cls.php';

$info=new CONTENTINFO();

$action=$_GET['action'];

$page=$_POST['page'];
$rows=$_POST['rows'];
$upper_cat=$_POST['upper_cat'];

//saveInfo
$conInfo['cat_id']=$_POST['cat_id'];
$conInfo['category']=$_POST['category'];
$conInfo['title']=$_POST['title'];
$conInfo['brief_title']=$_POST['brief_title'];
$conInfo['tags']=$_POST['tags'];
$conInfo['content']=$_POST['content'];
$conInfo['brief_ctnt']=$_POST['brief_ctnt'];
$conInfo['source']=$_POST['info_source'];

//delInfo or delArrInfo
$id=$_GET['id'];
$arrId=$_GET['arrId'];

//query
$title=$_POST['title'];
$tags=$_POST['tags'];
$content=$_POST['content'];

//saveAttach
$attach['brief_ctnt']=$_POST['brief_ctnt'];

switch($action){
	case 'infoGrid':
		$info->infoGrid();
		break;
	case 'saveInfo':
		$info->saveInfo();
		break;
	case 'getAttach':
		$info->getAttach();
		break;
	case 'updInfo':
		$info->updInfo();
		break;
	case 'delInfo':
		$info->delInfo();
		break;
	case 'delArrInfo':
		$info->delArrInfo();
		break;
	case 'load':	
		$info->load();
		break;
	case 'attachGrid':	
		$info->attachGrid();
		break;
	case 'delAttach':	
		$info->delAttach($id);
		break;
	case 'delArrAttach':	
		$info->delArrAttach();
		break;
	default:;
}
?>