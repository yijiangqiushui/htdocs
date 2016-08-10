<?php



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
	* 参数：$code-验证码,$usr-用户名,$pwd-密码
	*/
	public function CheckLogin($ntid,$digest,$flag,$code,$username,$password){
		$db=new DB();
/* 		echo strtolower($code);
		echo $_SESSION['validate_code'];
		exit(); */
		if($_SESSION['validate_code'] != strtolower($code)){
			$data['result'] = 'code_err';
			echo json_encode($data);
		}
		else{
		    if($flag==0){
		        $userpin=$password;
		        $sql="SELECT * FROM admininfo WHERE username='$username' and password='$password'";
		    }else{
		        //这个应该是ukey的判断
		        $sql="SELECT * FROM admininfo WHERE ntid='$ntid'";
		    }
			/*$admin_pwd=$pwd;
			$pwd=$this->EncriptPWD($pwd);
			$rs=$db->Select("SELECT * FROM login_info WHERE usr='$usr' and pwd='$pwd'");
			$result=empty($rs)?'incorrect':(!isset($rs[0]['isForbidden'])?'data_err':($rs[0]['isForbidden']>0?'forbidden':'success'));
			if($result=='success'){
				$_SESSION['admin_id']=$rs[0]['id'];
				$_SESSION['admin_name']=$rs[0]['usr'];
				$_SESSION['admin_pwd']=$admin_pwd;
				$_SESSION['addedDate']=$rs[0]['addedDate'];
				$_SESSION['lastIP']=$rs[0]['lastIP'];
				//add：heyangyang 向session中存储权限
				$cat=$rs[0]['category'];
				if($rs[0]['id']==1){
					$_SESSION['priviledges']='super';
					$_SESSION['catName']='超级管理员';
				}else{
					$cat=substr($cat,0,strlen($cat)-1);
					$cat=strrchr($cat,'.');
					$catid=intval(substr($cat,1));
					$sql='SELECT catName,userPrivileges FROM admincat WHERE id='.$catid;
					$res=$db->Select($sql);
					$_SESSION['priviledges']=$res[0]['userPrivileges'];
					$_SESSION['catName']=$res[0]['catName'];
				}
				$cmn=new COMMON();
				$db->Update("UPDATE admininfo SET lastIP='".$cmn->IP()."'");
				//其他操作
			}
			echo $result; */
		    $res = array();
		    $rs=$db->Select($sql);
		    $user_type = $rs[0]['user_type'];
		    $user_id = $rs[0]['id'];
		    $result=empty($rs)?'incorrect':(!isset($rs[0]['isForbidden'])?'data_err':($rs[0]['isForbidden']>0?'forbidden':'success'));
		    if($result == 'success'){
		      if($flag==0){
// 		          $_SESSION['admin_pwd']=$admin_pwd;
				$_SESSION['password']=$rs[0]['password'];
				$data['password'] = $rs[0]['password'];
			  }
			  else{
			      $_SESSION['NTID']=$ntid;
			      $_SESSION['Digest']=$digest;
			      $_SESSION['userPin']=$password;
			      $_SESSION['server_seed']=$rs[0]['seed'];
			  }
		        $_SESSION['username']=$rs[0]['username'];
		        $_SESSION['password']=$rs[0]['password'];
		        $_SESSION['user_type']=$rs[0]['user_type'];//判断用户的类型
		        $_SESSION['realname'] = $rs[0]['realname'];
		        $_SESSION['department']=$rs[0]['department'];
		        $_SESSION['user_id'] = $rs[0]['id'];        //用户的id 
		        $_SESSION['flag']=$flag;
		        $data['username']=$rs[0]['username'];
		        $data['password']=$rs[0]['password'];
		        $data['user_type']=$rs[0]['user_type'];//判断用户的类型
		        $data['realname'] = $rs[0]['realname'];
		        $data['department']=$rs[0]['department'];
		        $data['user_id'] = $rs[0]['id'];        //用户的id
		        $data['flag']=$flag;
		        
// 		        $result = $rs[0]['department'];
                //判断当前的用户是否为超级管理员 3为超级管理员
                if($rs[0]['user_type'] == 3){
                    $_SESSION['priviledges']='super';
                    $_SESSION['exclusive_name']='super';
                    $_SESSION['catName']='超级管理员';
                    
                    $data['priviledges']='super';
                    $data['exclusive_name']='super';
                    $data['catName']='超级管理员';
                }
                $cmn=new COMMON();
                $db->Update("UPDATE admininfo SET lastIP='".$cmn->IP()."',lastLoginTime='".date('Y-m-d H:i:s',time())."' where id='".$_SESSION['user_id']."'");
                $rs_time=$db->Select("select lastLoginTime from admininfo where id='".$_SESSION['user_id']."'");
                $_SESSION['thisLoginTime']=$rs_time[0]['lastLoginTime'];
		    }
		    $data['result'] = $result;
		    $data['user_type'] = $user_type;
		    echo json_encode($data);
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
		$rs=$db->Select("SELECT id,usr,isForbidden FROM admininfo WHERE id=".$_SESSION['user_id']." and password='$pwd'");
		$data_arr['type']=empty($rs)?'incorrect':(!isset($rs[0]['isForbidden'])?'data_err':($rs[0]['isForbidden']>0?'forbidden':'success'));
		$_SESSION['username']=$rs[0]['usr'];
		$db->Close();
		
		echo json_encode($data_arr); 
	}
	
	
	/**
	* 文件描述
	* 用来更新用户信息
	* @author david <david55555.hi@gmail.com>
	* @date 2015年11月19日 下午4:43:05
	* @version 1.0.0
	* @copyright  david
	* 
	* 0: 不存在
	* 1： 存在
	* @function 
	*/
	public function userComplete($org_code,$user_info,$user_id){
// 	    echo "hahah".$user_id;
	    $db = new DB();
	    $data = array();
	    $stat_org = $db->GetInfo1($org_code,'org_info','org_code');
	    $org_name = $stat_org['org_name'];
// 	    echo "user:".$user['email'];
	    //更新用户的信息
	    $result_update = $db -> UpdateData1('login_info',$user_id,$user_info,'id');
	    //查找这个企业的信息
	    if(empty($stat_org)){
	        $data['org'] = 0;
	    }
	    else{
	        $data['org'] = 1;
	        $data['org_name'] = $org_name;
	        $_SESSION['org_name'] = $org_name;
	    }
	    $db->Close();
	    echo json_encode($data);
	}

}
?>
