<?php
/**
author:Gao Xue
date:2014-04-28
Modified：Wang Le  	
data：2014/09/06
*/

include '../../../../../common/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';
include '../../../../../common/php/lib/user.cls.php';
include '../../../../../center/php/action/class/NT199ServerScript.php';

include '../../class/panel/user.cls.php';
include '../../class/log/log.cls.php';

{
	//修改用户信息时提交的表单值
	
	switch($_GET['action']){
		case 'getUser':
			$user=new USERINFO();
			$user->getUser();
			break;
			
		case 'checkold':
			$user=new USERINFO();
			$user->checkOldPwd($_POST['pwd']);
		break;
		case 'updateUser':
			$id=$_POST['id'];
			$phone=$_POST['phone'];
			$email=$_POST['email'];
			$qq=$_POST['qq'];
			
			$user=new USERINFO();
			$user->updateUser($id,$phone,$email,$qq);
			
			$log=new LOGINFO();
			$log->addLog('修改用户信息',$_SESSION['realname'],date('Y-m-d H:i:s',time()));
			break;
		case 'updatePwd':
			$id=$_POST['id'];
			$pwd=$_POST['newPwd'];
	
			$user=new USERINFO();
			$user->updatePwd($pwd);

			$log=new LOGINFO();
			$log->addLog('修改密码',$_SESSION['realname'],date('Y-m-d H:i:s',time()));
			break;
		case 'uptPwd':
			$user=new USERINFO();
			$user->uptPwd();
			break;
		default:;
	}

}
?>