<?php
/**
author:Gao Xue
date:2014-09-09
*/

include '../../../../../common/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';
include '../../class/sms/sms.cls.php';
include '../../class/log/log.cls.php';

switch($_GET['action']){
	case 'treeData':
		$sms=new SMS();
		$up_id=$_GET['up_id'];
		$sms->treeData($up_id);//,$_GET['contentID']);
		break;
	case 'otherTreeData':
		$sms=new SMS();
		$up_id=$_GET['up_id'];
		$sms->otherTreeData($up_id,$_GET['otherID'],$_GET['listID']);//,$_GET['contentID']);
		break;
	case 'gridData':
		$sms=new SMS();
		$page=$_POST['page'];
		$rows=$_POST['rows'];
		//$sms->gridData($page,$rows);
		$sms->gridData($_GET['flag'],$page,$rows);
		break;
		
	case 'sendSms':
		$sms=new SMS();
		$log=new LOGINFO();
		$smsPhone=$_POST['smsPhone'];
		/*
		$smsPhone_str=$_POST['smsPhone'];
		$smsPhone_all_arr=explode(";",$smsPhone_str);
		$smsPhone_arr=array_unique($smsPhone_all_arr);
		$smsPhone=implode(";",$smsPhone_arr);
		*/
		$smsinfo['content']=$_POST['content'];
		$smsinfo['admin_id']=$_SESSION['admin_id'];
		$sms->sendSms($smsPhone,$smsinfo);
		$log->addLog('发送短消息',$_SESSION['realname'],date('Y-m-d H:i:s',time()));
		break;
	
	case 'getProgress':
		$sms=new SMS();
		$smsPhonestr=$_POST['smsPhonestr'];
		$sms->getProgress($_POST['id'],$smsPhonestr);
		break;
		
	case 'findById':
		$sms=new SMS();
		$id=$_POST['id'];
		$sms->findById($id);
		break;
		
	case 'editSms':
		$sms=new SMS();
		$log=new LOGINFO();
		$id=$_GET['id'];
		$smsinfo['smsPhone']=$_POST['smsPhone'];
		$smsinfo['content']=$_POST['content'];
		$sms->edit($id,$smsinfo);
		$log->addLog('修改短消息',$_SESSION['realname'],date('Y-m-d H:i:s',time()));
		break;
	case 'delSms':
		$sms=new SMS();
		$log=new LOGINFO();
		$id=$_POST['id'];
		$sms->delSms($id);
		$log->addLog('删除短消息',$_SESSION['realname'],date('Y-m-d H:i:s',time()));
		break;
	case 'delArrSms':
		$sms=new SMS();
		$log=new LOGINFO();
		$idlist=$_GET['idlist'];
		$sms->delArrSms($idlist);
		$log->addLog('删除短消息',$_SESSION['realname'],date('Y-m-d H:i:s',time()));
		break;
	case 'getCommunicate':
		$sms=new SMS();
		$sms->getCommunicate();
		break;
	case 'get_comm_list':
		$sms=new SMS();
		$sms->get_comm_list($_POST['group_id']);
		break;
	case 'get_replySms':
		$sms=new SMS();
		$sms->get_replySms($_GET['id']);
		break;
	case 'getSmsTotal':
		$sms=new SMS();
		$content=$_POST['content'];
		$isReply=$_POST['isReply'];
		$inscribe=$_POST['inscribe'];
		$smsPhone=$_POST['smsPhone'];
		/*
		$content=$_GET['content'];
		$isReply=$_GET['isReply'];
		$inscribe=$_GET['inscribe'];
		$smsPhone=$_GET['smsPhone'];
		*/
		/*
		$smsPhone_all_arr=explode(";",$smsPhone_str);
		$smsPhone_arr=array_unique($smsPhone_all_arr);
		if($smsPhone_arr[count($smsPhone_arr)-1]==''){
			array_pop($smsPhone_arr);
		}
		$smsPhone=implode(";",$smsPhone_arr);
		*/
		$sms->getSmsTotal($content,$isReply,$inscribe,$smsPhone);
		break;
	case 'adminSendSms':
		$sms=new SMS();
		$sms->adminSendSms($_POST['id']);//$_POST['id']);
		break;
	case 'reSendFaileSms':
		$sms=new SMS();
		$sms->reSendFaileSms($_POST['id'],$_POST['failePhone']);//$_POST['id']);
		break;
	case 'reload_reply':
		$sms=new SMS();
		$sms->reload_reply();
		break;
	case 'getOtherReply':
		$sms=new SMS();
		$id=$_GET['id'];
		$phoneStr=$_GET['phoneStr'];
		$sendtime=$_GET['sendtime'];
		$page=$_POST['page'];
		$rows=$_POST['rows'];
		$sms->getOtherReply($id,$phoneStr,$sendtime,$page,$rows);
		break;
	case 'exportReply':
		$sms=new SMS();
		$id=$_POST['id'];
		$phoneStr=$_POST['phoneStr'];
		$sendtime=$_POST['sendtime'];
		$sms->exportReply($id,$phoneStr,$sendtime);
		break;
	case 'getSession':
		$flag=$_SESSION['flag'];
		echo $flag;
		break;
	case 'getYE':
		$sms=new SMS();
		$sms->getYE();
		break;
	case 'getReplyContent':
		$sms=new SMS();
		$id=$_GET['id'];
		$sms->getReplyContent($id);
		break;
	case 'getAllSmsList':
		$sms=new SMS();
		$sms->getAllSmsList($_GET['phone']);
		break;
	case 'updInfo':
		$sms=new SMS();
		$conInfo['name']=$_POST['name'];
		$conInfo['tel']=$_POST['tel'];
		$conInfo['company']=$_POST['company'];
		$conInfo['job']=$_POST['job'];
		$conInfo['category']=$_POST['category'];
		$conInfo['admin_id']=$_SESSION['admin_id'];
		$sms->updInfo($_GET['id'],$_GET['phone'],$conInfo);
		$log=new LOGINFO();
		$log->addLog('修改通讯录信息',$_SESSION['realname'],date('Y-m-d H:i:s',time()));
		break;
	case 'sendToPhone':
		$sms=new SMS();
		$id=$_POST['id'];
		$admin_id=$_POST['admin_id'];
		$smsPhone=$_POST['smsPhone'];
		//$content=$_POST['content'];
		$isSent=$_POST['isSent'];
		$sms->sendToPhone($id,$admin_id,$smsPhone,$isSent);
		$log=new LOGINFO();
		$log->addLog('发送短信息',$_SESSION['realname'],date('Y-m-d H:i:s',time()));
		break;
	case 'editSmsPhone':
		$sms=new SMS();
		$id=$_GET['id'];
		$phone=$_GET['phone'];
		$smsphone=$_GET['smsphone'];
		$sms->editSmsPhone($id,$phone,$smsphone);
		$log=new LOGINFO();
		$log->addLog('修改收件人号码',$_SESSION['realname'],date('Y-m-d H:i:s',time()));
		break;
	case 'getSearch':
		$sms=new SMS();
		$sms->getSearch($_POST['condition'],$_POST['catList']);
		break;
	default:;
}
?>