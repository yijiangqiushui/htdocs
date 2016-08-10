<?php
/************************************************************************************************************
#	PHP Version 1.2   MySQL  JavaScript
#	Copyright (c) 2009 http://www.cnalog.com
#	Author: Li Zhixiao <English Name: Hawking E-mail:lzxbit2008@yahoo.com.cn QQ:578731186>
#	Date: 2009/10/10
************************************************************************************************************/

class user extends DBSQL{
	
	public function __construct(){
		parent::__construct();
	}

	/*!- 用户类型相关 start --*/	
	public function isTypeExist($roleId,$catName){
		$sql="select id from userRole where id<>$roleId and catName='$catName'";
		$r = $this->select($sql);
		return $r[0][0];
	}
	
	public function addType($data){
		if(!$this->isTypeExist(-1,$data[catName]))
			return $this->insertData('userRole',$data);
		else
			return 0;
	}
	
	public function editType($roleId,$data){
		if(!$this->isTypeExist($roleId,$data[catName]))
			return $this->updateData('userRole',$roleId,$data);
		else
			return 0;
	}
	
	public function deleteType($roleId){
		return $this->delData($roleId,'userRole');
	}
	
	public function getType($roleId){
		$data=array();
		$sql="select * from userRole where id=$roleId";
		$r = $this->select($sql);
		return $r[0];
	}
	
	public function getBatchType($sql){
		$r=$this->select($sql);
		return $r;
	}
	
	public function delBatchType($idArr){
		$arr=split(',',$idArr);
		for($i=0;$i<count($arr);$i++){
			$sql="delete from userInfo where roleId=".$arr[$i]." and id<>1";
			$this->delete($sql);
		}
		return $this->delArrIdData($idArr,'userRole');
	}
	
	public function getPriviledges($userId){
		$sql="select ur.* from userRole ur,userInfo ui where ui.roleId=ur.id and ui.id=$userId";
		$r=$this->select($sql);
		return $r[0];
	}

	/*!- 用户类型相关 end --*/	

	/*!- 用户信息相关 start --*/	
	public function isUserExist($userId,$userName){
		$sql="select id from userInfo where id<>$userId and userName='$userName'";
		$r = $this->select($sql);
		return $r[0][0];
	}
	
	public function isEmailExist($email){
		$sql="select id from userInfo where email='$email'";
		$r = $this->select($sql);
		return $r[0][0];
	}
	
	public function isLoginAllowed($userName,$password){
		$sql="select id from userInfo where userName='$userName' and password='$password'";
		$r = $this->select($sql);
		return $r[0][0];
	}
	
	public function chkUsrNmNEml($userName,$email){
		$sql="select id from userInfo where userName='$userName' and email='$email'";
		$r = $this->select($sql);
		return $r[0][0];
	}
	
	public function isPwdCorrect($userId,$password){
		$sql="select id from userinfo where id=$userId and password='$password'";
		$r = $this->select($sql);
		return $r[0][0];
	}
	
	public function addUser($data){
		if(!$this->isUserExist(-1,$data[userName]))
			return $this->insertData('userInfo',$data);
		else
			return 0;
	}
	
	public function editUser($userId,$data){
		if(!$this->isUserExist($userId,$data[userName]))
			return $this->updateData('userInfo',$userId,$data);
		else
			return 0;
	}
	
	public function deleteUser($userId,$data){
		return $this->delData($userId,'userInfo');
	}
	
	public function getUserInfo($userId){
		$sql="select ui.*,ur.roleName from userInfo ui,userRole ur where ui.roleId=ur.id and ui.id=$userId";
		$r = $this->select($sql);
		return $r[0];
	}
	
	public function getBatchUser($sql){
		$r=$this->select($sql);
		return $r;
	}
	
	public function delBatchUser($idArr){
		return $this->delArrIdData($idArr,'userInfo');
	}
	/*!- 用户信息相关 end --*/	
}
?>