<?php
/**
author:Gao Xue
date:2014-04-28
Modified：Wang Le  	
data：2014/09/06
*/

include '../../../../../common/php/config.ini.php';
include '../../../../../center/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';
include '../../../../../common/php/lib/user.cls.php';

include '../../class/user/user.cls.php';
include '../../class/log/log.cls.php';

{
    $action=$_GET['action'];
//     $org_code = $_SESSION['org_code'];
    $org_code = $_SESSION['org_code'];
    $org_info['org_type'] = $_POST['org_type'];
    $org_info['org_address'] = $_POST['org_address'];
    $org_info['register_town'] = $_POST['register_town'];
    $org_info['register_time'] = $_POST['register_time'];
    $org_info['postal'] = $_POST['postal'];
    $org_info['fax'] = $_POST['fax'];
    $org_info['org_code'] = $org_code;
	//修改用户信息时提交的表单值
    $user=new USERINFO();
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
			$log->addLog('修改用户信息',$_SESSION['admin_name'],date('Y-m-d H:i:s',time()));
			break;
		case 'updatePwd':
			$id=$_POST['id'];
			$pwd=$_POST['newPwd'];
	
			$user=new USERINFO();
			$user->updatePwd($pwd);

			$log=new LOGINFO();
			$log->addLog('修改密码',$_SESSION['admin_name'],date('Y-m-d H:i:s',time()));
			break;
			
		case 'complete_info':
		    $user->completeInfo($org_info,$org_code);
		    break;
		default:;
	}

}
?>