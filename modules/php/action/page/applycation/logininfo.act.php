<?php


include '../../class/projectapp/projectapp.cls.php';
// include '../../../../../center/php/config.ini.php';
include '../../../../../common/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';
include '../../class/applycation/logininfo.cls.php';

include '../../../../../common/php/plugin/fenci_v1.0_utf8/checkduplicate.cls.php';

$action = $_GET['action'];
// project_id and org_id
$project_id = $_SESSION['project_id'];
//  $project_id = '0123456';
$org_code = $_SESSION['org_code'];
//  $org_code = 'woshihaoren';
 //用户登录后用户id会记录到session
 $user_id=$_SESSION['user_id'];
 
 //获取logininfo值
 //$loginInfo['org_code']=$_POST['org_code'];
 $loginInfo['username']=$_POST['username'];
 //$loginInfo['password']=$_POST['password'];
 //$loginInfo['org_code']=$_POST['org_code'];
 //$loginInfo['isForbidden']=$_POST['isForbidden'];
 //$loginInfo['lastIP']=$_POST['lastIP'];
 //$loginInfo['addDate']=$_POST['addDate'];
 //$loginInfo['user_type']=$_POST['user_type'];
// $loginInfo['department']=$_POST['department'];
 $loginInfo['realname']=$_POST['realname'];
// $loginInfo['address']=$_POST['address'];
 $loginInfo['phone']=$_POST['phone'];//将celphone和phone调换一下位置;
 $loginInfo['email']=$_POST['email'];
 $loginInfo['celphone']=$_POST['celphone'];
 
 $loginInfo2['org_code']=$_POST['org_code'];
 $re_email = $_POST['re_email'];
 $token = $_POST['token'];
 
 $apply=new APPLY();
 switch($action){
     case 'logininfo':
         $apply->login_info($user_id, $loginInfo);
       //$apply->login_info2($org_code, $loginInfo2);
         break;
     case 'findlogininfo':
         $apply->find_login_info($user_id);
         break;
     case 'resetpwd':
     	$apply->resetpwd($re_email);
     	break;
     case 'checktoken':
     	$apply->checktoken($token);
     	break;
     case 'checkemail':
     	$apply->checkemail( $loginInfo['email']);
     	break;
     default:;
         
 }

