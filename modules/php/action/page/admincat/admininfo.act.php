<?php
/**
author:Gao Xue
date:2014-04-30
*Modified by GaoXue	2014/05/23
*/
include '../../../../../center/php/config.ini.php';
include '../../../../../common/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';

include '../../class/admin/admininfo.cls.php';
include '../../../../../common/php/lib/user.cls.php';

$action=$_GET['action'];
$user=new USER();

$page=$_POST['page'];
$rows=$_POST['rows'];

$upCatory=$_POST['upCagory'];

$id=$_GET['id'];
$arrId=$_GET['arrId'];

$usr=$_POST['usr'];
$isForbidden=$_POST['isForbidden'];

$list=$_GET['idlist'];
$flag=$_GET['flag'];

$admininfo['category']=$_POST['category'];
$admininfo['usr']=$_POST['usr'];
$admininfo['realname']=$_POST['realname'];
$admininfo['pwd']=$user->EncriptPWD($_POST['pwd']);
$admininfo['phone']=$_POST['phone'];
$admininfo['email']=$_POST['email'];
$admininfo['qq']=$_POST['qq'];
$admininfo['isForbidden']=$_POST['isForbidden'];
$admininfo['addedDate']=date('Y-m-d H:i:s',time());
$admininfo['lastIP']=getIP();
$admininfo['company']=$_POST['company'];
$admininfo['title']=$_POST['title'];
$admininfo['cardID']=$_POST['cardID'];
$admininfo['cellphone']=$_POST['cellphone'];

$upAdmin['category']=$_POST['category'];
$upAdmin['usr']=$_POST['usr'];
$upAdmin['realname']=$_POST['realname'];
$upAdmin['pwd']=$_POST['pwd'];
$upAdmin['phone']=$_POST['phone'];
$upAdmin['email']=$_POST['email'];
$upAdmin['qq']=$_POST['qq'];
$upAdmin['isForbidden']=$_POST['isForbidden'];
$upAdmin['company']=$_POST['company'];
$upAdmin['title']=$_POST['title'];
$upAdmin['cardID']=$_POST['cardID'];
$upAdmin['cellphone']=$_POST['cellphone'];


$admin=new ADMININFO();

switch($action){
	case 'saveAdmin':
		$admin->saveAdmin($admininfo);
		break;
	case 'queryAdmin':
		$admin->queryAdmin($page,$rows,$upCatory,$usr,$isForbidden);
		break;
	case 'getAdmin':
		$admin->getAdmin($id);
		break;
	case 'delAdmin':
		$admin->delAdmin($id);
		break;
	case 'delArrAdmin':
		$admin->delArrAdmin($arrId);
		break;
	case 'updateAdmin':
		$admin->updateAdmin($id,$upAdmin);
		break;
	case 'disableAdmin':
		$admin->disableAdmin($list,$flag);
		break;
	default:;
}

/*function saveAdmin($admininfo){
	$admin=new ADMININFO();
	$admin->saveAdmin($admininfo);
}

function queryAdmin($page,$rows,$upCatory,$usr,$isForbidden){
	$admin=new ADMININFO();
	$admin->queryAdmin($page,$rows,$upCatory,$usr,$isForbidden);
}

function getAdmin($id){
	$admin=new ADMININFO();
	$admin->getAdmin($id);
}

function delAdmin($id){
	$admin=new ADMININFO();
	$admin->delAdmin($id);
}

function delArrAdmin($arrId){
	$admin=new ADMININFO();
	$admin->delArrAdmin($arrId);
}

function updateAdmin($id,$upAdmin){
	$admin=new ADMININFO();
	$admin->updateAdmin($id,$upAdmin);
}

function disableAdmin($list,$flag){
	$admin=new ADMININFO();
	$admin->disableAdmin($list,$flag);
}*/

function getIP(){
	if(getenv('HTTP_CLIENT_IP')){
		$onlineip = getenv('HTTP_CLIENT_IP');
	}
	elseif(getenv('HTTP_X_FORWARDED_FOR')){
		$onlineip = getenv('HTTP_X_FORWARDED_FOR');
	}
	elseif(getenv('REMOTE_ADDR')){
		$onlineip = getenv('REMOTE_ADDR');
	}
	else{
		$onlineip = $HTTP_SERVER_VARS['REMOTE_ADDR'];
	}
	return $onlineip;
}
?>