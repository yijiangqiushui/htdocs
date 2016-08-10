<?php
/**
author:Gao Xue
date:2014-05-07
Modified by Zhao Xiaogang 2015/03/02 
Modified by Gao Xue 2015/04/08
*/

include '../../../../../common/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';
include '../../../../../common/php/lib/file.cls.php';
include '../../../../../common/php/lib/img.cls.php';
include '../../class/log/log.cls.php';
include '../../class/smslist/smslistinfo.cls.php';

switch($_GET['action']){
	case 'treeData':
		$info=new SMSLISTINFO();
		$up_id=$_GET['up_id'];
		$info->treeData($up_id);//,$_GET['contentID']);
		break;
	case 'otherTreeData':
		$info=new SMSLISTINFO();
		$up_id=$_GET['up_id'];
		$info->otherTreeData($up_id,$_GET['otherID'],$_GET['listID']);//,$_GET['contentID']);
		break;
	case 'infoGrid':
		$info=new SMSLISTINFO();
		$page=$_POST['page'];
		$rows=$_POST['rows']; 
		$upper_cat=$_POST['upper_cat'];
		$listID=$_POST['listID'];
		$name=$_POST['name'];
		$tel=$_POST['tel'];
		$company=$_POST['company'];
		$add_time=$_POST['add_time'];
		$info->infoGrid($upper_cat,$page,$rows,$name,$tel,$company,$add_time,$_POST['upid'],$_POST['admin_id'],$listID);
		break;
	case 'saveInfo':
		$info=new SMSLISTINFO();
		$conInfo['category']=$_POST['category'];
		$conInfo['name']=$_POST['name'];
		$conInfo['tel']=$_POST['tel'];
		$conInfo['company']=$_POST['company'];
		$conInfo['job']=$_POST['job'];
		$conInfo['admin_id']=$_SESSION['admin_id'];
		
		$info->saveInfo($conInfo);
		$log=new LOGINFO();
		$log->addLog('添加通讯录信息',$_SESSION['realname'],date('Y-m-d H:i:s',time()));
		break;
	case 'getAttach':
		$info=new SMSLISTINFO();
		$id=$_GET['id'];
		$info->getAttach($id);
		break;
	case 'updInfo':
		$info=new SMSLISTINFO();
		$id=$_GET['id'];
		$conInfo['name']=$_POST['name'];
		$conInfo['tel']=$_POST['tel'];
		$conInfo['company']=$_POST['company'];
		$conInfo['job']=$_POST['job'];
		$conInfo['category']=$_POST['category'];
		$conInfo['admin_id']=$_SESSION['admin_id'];
		
		$info->updInfo($id,$conInfo);
		$log=new LOGINFO();
		$log->addLog('修改通讯录信息',$_SESSION['realname'],date('Y-m-d H:i:s',time()));
		break;
	case 'delInfo':
		$info=new SMSLISTINFO();
		$id=$_GET['id'];
		$info->delInfo($id);
		$log=new LOGINFO();
		$log->addLog('删除通讯录信息',$_SESSION['realname'],date('Y-m-d H:i:s',time()));
		break;
	case 'delArrInfo':
		$info=new SMSLISTINFO();
		$arrId=$_GET['arrId'];
		$info->delArrInfo($arrId);
		$log=new LOGINFO();
		$log->addLog('删除通讯录信息',$_SESSION['realname'],date('Y-m-d H:i:s',time()));
		break;
	case 'getCurrentID':
		$info=new SMSLISTINFO();
		$info->getCurrentID();
		break;
	case 'setOthers':
		$info=new SMSLISTINFO();
		$info->setOthers($_GET['ids'],$_GET['list']);
		break;
	case 'importList':
		$info=new SMSLISTINFO();
		$info->importList($_GET['ids']);
		break;
	case 'getSession':
		echo $_SESSION['admin_id'];
		break;
	case 'getMyList':
		$upid=$_GET['up_id'];
		$table_name=$_GET['table_name'];
		$info=new SMSLISTINFO();
		$info->getMyList($upid,$table_name);
		break;
	case 'getOtherIds':
		$info=new SMSLISTINFO();
		$info->getOtherIds($_POST['otherId']);
		break;
	case 'importSmsList':
		$log=new LOGINFO();
		$log->addLog('导入通讯录',$_SESSION['realname'],date('Y-m-d H:i:s',time()));
		break;
	default:;
}
?>