<?php
/**
author:Gao Xue
date:2014-04-28
Modified：Wang Le  	
data：2014/09/06
*/

/*include '../../../../../common/php/config.ini.php';
include '../../../config.ini.php';
include '../../../../../common/php/lib/db.cls.php';
include '../../../../../common/php/lib/user.cls.php';*/

class USERINFO{
	
	function getUser(){
		$db=new DB();
		$rs=$db->GetInfo($_SESSION['admin_id'],'admininfo');

		$userarr=array(
			'id'=>$_SESSION['admin_id'],
			'username'=>$rs['usr'],
			'phone'=>$rs['phone'],
			'email'=>$rs['email'],
			'qq'=>$rs['qq'],
			'addedDate'=>$rs['addedDate'],
			//'lastLoginTime'=>$rs['lastLoginTime'],
			'lastLoginTime'=>$_SESSION['lastLoginTime'],
			'lastIP'=>$rs['lastIP']
		);
		echo json_encode($userarr);
		$db->Close();
	}
	
	function checkOldPwd($pwd){
		$db=new DB();
		$user=new USER();
		$sql="select id from admininfo where id=".$_SESSION['admin_id']." and pwd='".$user->EncriptPWD($pwd)."' limit 0,1";
		$rs=$db->Select($sql);
		if(is_array($rs) && sizeof($rs)>0){
			echo  json_encode(array('retflag'=>'success'));
		}
		else{
			echo json_encode(array('retflag'=>'wrong'.is_array($rs)));
		}
		$db->Close();
	}
	
	function updateUser($id,$phone,$email,$qq){
		$sql=' update admininfo set ';
		$db=new DB();
		
		$strPhone=($phone!==null&&$phone!='')?'phone='."'".$phone."'":'';
		$strEmail=($email!==null&&$email!='')?'email='."'".$email."'":'';
		$strQq=($qq!==null&&$qq!='')?'qq='."'".$qq."'":'';
		
		if($strPhone!==''){
			$sql=$sql.$strPhone;
		}
		if($strEmail!==''){
			if(strlen($sql)!==22){
				$sql=$sql.",".$strEmail;
			}else{
				$sql=$sql.$strEmail;
			}
		}
		if($strQq!==''){
			if(strlen($sql)!==22){
				$sql=$sql.",".$strQq;
			}else{
				$sql=$sql.$strQq;
			}
		}
		$strSql=$sql.' where id='.$id;

		$result=$db->Update($strSql);
		echo $result;
		$db->Close();
	}
	
	function updatePwd($pwd){
		$user=new USER();
		$password=$user->EncriptPWD($pwd);
		
		$sql=' update admininfo set pwd ='."'".$password."'".' where id='.$_SESSION['admin_id'];
		
		$db=new DB();
		$result=$db->Update($sql);
		echo $result;
		$db->Close();
	}
}
?>
