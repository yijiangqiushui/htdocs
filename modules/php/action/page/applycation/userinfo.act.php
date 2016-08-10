<?php
/**
 author:wangyi
 date:2015-11-11
 */

include '../../class/projectapp/projectapp.cls.php';
include '../../../../../center/php/config.ini.php';
include '../../../../../common/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';
include '../../class/applycation/userinfo.cls.php';

include '../../../../../common/php/plugin/fenci_v1.0_utf8/checkduplicate.cls.php';

$action = $_GET['action'];
// project_id and org_id
$project_id = $_SESSION['project_id'];
 //$project_id = '0123456';
$org_code = $_SESSION['org_code'];
 //$org_code = 'woshihaoren';
 
 
 //获取userinfo值
 //$userInfo['org_code']=$org_code;
$userInfo['org_code']=$org_code;
 $userInfo['org_name']=$_POST['org_name'];
//  $userInfo['linkman_contact']=$_POST['linkman_contact'];
//  $userInfo['linkman']=$_POST['linkman'];
 $userInfo['email']=$_POST['email'];
 $userInfo['contact_address']=$_POST['contact_address'];
 $userInfo['legal_person']=$_POST['legal_name'];
 $userInfo['register_address']=$_POST['register_address'];
 $userInfo['phone']=$_POST['phone'];
 
 $userlegal['org_code']=$org_code;
 $userlegal['legal_name']=$_POST['legal_name'];
 $userlegal['legal_phone']=$_POST['legal_phone'];
 

 
 $userInfo2['org_code']=$_POST['org_code'];
 
 $apply=new APPLY();
 switch($action){
     case 'userinfo':
         $apply->user_info($org_code, $userInfo,$userlegal);
         
        // $apply->user_info2($org_code, $userInfo2);
         break;
     case 'findUserInfo':
         $apply->find_user_info($org_code); 
     default:;
         
 }
