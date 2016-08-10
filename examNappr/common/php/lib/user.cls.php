<?php
/**************************************************
#	Version 1.3		PHP MySQL JavaScript
#	Copyright (c) 2009 http://www.fangbian123.com
#	Author: Li Zhixiao <English Name: Hawking E-mail:578731186@qq.com QQ:578731186>
#	Date: 2009/10/10
#	Modified by Li Zhixiao	2014/03/24
#	Modified by Gao Xue  	2014/04/28
#	Modified by Wang Le  	2014/09/06
#	Modified by Gao Xue  	2015/03/19
**************************************************/

/**
 * 功能：用户相关操作
 * 使用示例：$usr=new USER();
 */
class USER{
	public function __constructor(){}
	
	/**
	* 功能：密码加密方法
	*/
	public function EncriptPWD($pwd){
		$a='lee';
		$b='hawking';
		return sha1(sha1($a).sha1($pwd).sha1($b));
	}

	/**
	* 功能：验证登录
	* 参数：$code-验证码,$ntid-设备ID
	*/
	public function CheckLogin($ntid,$digest,$flag,$usr,$userpin,$code){
		$db=new DB();
		if($_SESSION['validate_code']!=strtolower($code)){
			echo 'code_err';
		}
		else{
			if($flag==0){
				$admin_pwd=$userpin;
				$userpin=$this->EncriptPWD($userpin);
				$sql="SELECT * FROM admininfo WHERE usr='$usr' and pwd='$userpin'";
// 				echo $sql;
			}else{
				$sql="SELECT * FROM admininfo WHERE ntid='$ntid'";
			}
			$rs=$db->Select($sql);
			$result=empty($rs)?'incorrect':(!isset($rs[0]['isForbidden'])?'data_err':($rs[0]['isForbidden']>0?'forbidden':($rs[0]['isDel']>0?'delete':'success')));
			if($result=='success'){
				if($flag==0){
					$_SESSION['admin_pwd']=$admin_pwd;
				}else{
					$_SESSION['NTID']=$ntid;
					$_SESSION['Digest']=$digest;
					$_SESSION['userPin']=$userpin;
					$_SESSION['server_seed']=$rs[0]['seed'];
				}
				$_SESSION['admin_id']=$rs[0]['id'];
				$_SESSION['admin_name']=$rs[0]['usr'];
				$_SESSION['realname']=$rs[0]['realname'];
				$_SESSION['addedDate']=$rs[0]['addedDate'];
				$_SESSION['lastIP']=$rs[0]['lastIP'];
				$_SESSION['category']=$rs[0]['category'];
				$_SESSION['lastLoginTime']=$rs[0]['lastLoginTime'];
				$_SESSION['flag']=$flag;
				//$_SESSION['exclusive_name']=$rs[0]['exclusive_name'];
			
				//add：heyangyang 向session中存储权限
			
				$cat=$rs[0]['category'];
				if($rs[0]['id']==1){
					$_SESSION['priviledges']='super';
					$_SESSION['exclusive_name']='super';
					$_SESSION['catName']='超级管理员';
				}else{
				
					$cat=substr($cat,0,strlen($cat)-1);
					$cat=strrchr($cat,'.');
					$catid=intval(substr($cat,1));
					//$sql='SELECT catName,userPrivileges FROM admincat WHERE id='.$catid;
					$sql='SELECT catName FROM admincat WHERE id='.$catid;
					$sql1='SELECT userPrivileges,exclusive_name FROM admininfo WHERE id='.$rs[0]['id'];
		
					$res=$db->Select($sql);
					$res1=$db->Select($sql1);
		
					$_SESSION['exclusive_name']=$res1[0]['exclusive_name'];
					$_SESSION['priviledges']=$res1[0]['userPrivileges'];
					$_SESSION['catName']=$res[0]['catName'];
						
				}
				
				$cmn=new COMMON();
				$db->Update("UPDATE admininfo SET lastIP='".$cmn->IP()."',lastLoginTime='".date('Y-m-d H:i:s',time())."' where id='".$_SESSION['admin_id']."'");
				//其他操作
				$rs_time=$db->Select("select lastLoginTime from admininfo where id='".$_SESSION['admin_id']."'");
				$_SESSION['thisLoginTime']=$rs_time[0]['lastLoginTime'];
			}
			echo $result;
		}
		$db->Close();
	}	
	
	/**
	* 功能：验证屏幕解锁
	* 参数：$pwd-密码
	*/
	public function CheckUnlock($pwd){
		$data_arr=array();

		$db=new DB();
		$pwd=$this->EncriptPWD($pwd);
		//这个是数据库连接的问题需要统一服务器。
		$rs=$db->Select("SELECT * FROM admininfo WHERE id=".$_SESSION['user_id']." and password='$pwd'");
		$data_arr['type']=empty($rs)?'incorrect':(!isset($rs[0]['isForbidden'])?'data_err':($rs[0]['isForbidden']>0?'forbidden':'success'));
		$result=empty($rs)?'incorrect':(!isset($rs[0]['isForbidden'])?'data_err':($rs[0]['isForbidden']>0?'forbidden':($rs[0]['isDel']>0?'delete':'success')));
		
		$_SESSION['username']=$rs[0]['username'];
		$db->Close();
		
		echo json_encode($data_arr); 
	}
	
	/**
	* 功能：得到用户信息
	* 参数：$username-用户名
	*/
	/*public function getUsr(){
		$db=new DB();
		if($username=='super'){
			echo '超级管理员';
		}else{
			$result=$db->Select("SELECT ntid,category FROM admininfo WHERE usr='$username'");
			$rs0=empty($result)?'incorrect':'success';
			if($rs0=='success'){
				$arr=explode(".",$result[0]['category']);
				$rs=$db->Select("SELECT catName FROM admincat WHERE id =$arr[1]");
				echo $rs[0]['catName'];
			}else{
				echo 'incorrect';
			}
		
	}}*/
}
?>
