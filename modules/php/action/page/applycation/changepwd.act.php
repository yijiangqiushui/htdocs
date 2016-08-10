<?php
/**
 author:wangyi
 date:2015-11-11
 */

include '../../class/projectapp/projectapp.cls.php';
include '../../../../../center/php/config.ini.php';
include '../../../../../common/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';
include '../../class/applycation/changepwd.cls.php';

include '../../../../../common/php/plugin/fenci_v1.0_utf8/checkduplicate.cls.php';

$action = $_GET['action'];
// project_id and org_id
//$project_id = $_SESSION['project_id'];
//$user_id=97;
 //用户的id在登录的时候存到session
$inoldpwd=$_POST['pwd'];
$newpwd=$_POST['newPwd'];
$user_id=$_SESSION['user_id'];
$id = $_POST['id'];
$forget_pwd = $_POST['new_pwd'];
$apply=new APPLY();
 switch($action){
     case 'getoldpwd':
         $apply->find_old_pwd($user_id,$inoldpwd);
         break;
     case 'updatepwd':
         $apply->update_pwd($user_id,$newpwd);
         break;
     case 'setnewpass':
         $apply->update_pwd($id,$forget_pwd);
         $apply->clear_token($id);
         break;
     default:;
         
 }

