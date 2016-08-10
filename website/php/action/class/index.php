<?php

class Index{
	public function check_login($username,$password){
		$db=new DB();		
		$rs=$db->Select("SELECT * FROM login_info WHERE username='$username' and password='$password'");
// 		echo $rs;
		$user_type = $rs[0]['user_type'];
		$user_id = $rs[0]['id'];
		
		$org_code = $rs[0]['org_code'];
		$result_org = $db->GetInfo1($org_code,'org_info', 'org_code');
	    /*if(empty($result_org['org_name'])){
		    $result = 'alert';
		    $_SESSION['org_code']=$rs[0]['org_code'];
		}else */ 
		if(empty($rs)){
		    $result = 'incorrect';
		} else {
		    if(!isset($rs[0]['isForbidden'])){
		    $result = 'data_err';
		   }else{
    	       if($rs[0]['isForbidden']>0){
    	           $result = 'forbidden';
    	       }
    	       else{
    	           $result = 'success';
    	       }
		   }
		}
//		$result=empty($rs)?'incorrect':(!isset($rs[0]['isForbidden'])?'data_err':($rs[0]['isForbidden']>0?'forbidden':'success'));
//  		$result=$result=='success'?($rs[0]['is_checked']==0?'not_check':($rs[0]['is_checked']==2?'unchecked':'success')):$result;
		if($result=='success'){
			$_SESSION['username']=$rs[0]['username'];
			$_SESSION['org_code']=$rs[0]['org_code'];
			$_SESSION['password']=$rs[0]['password'];
			$_SESSION['isForbidden']=$rs[0]['isForbidden'];
			$_SESSION['user_type']=$rs[0]['user_type'];   //�ж��û�������
			$_SESSION['user_id'] = $rs[0]['id'];
			
			$re_org = $db->GetInfo1($rs[0]['org_code'], 'org_info', 'org_code');
			$_SESSION['org_name'] = $re_org['org_name'];
			/* $_SESSION['contact']=$rs[0]['contact'];
			$_SESSION['phone']=$rs[0]['phone'];
			$_SESSION['telphone']=$rs[0]['telphone'];
			$_SESSION['address']=$rs[0]['address'];
			$_SESSION['email']=$rs[0]['email'];
			$_SESSION['isForbidden']=$rs[0]['isForbidden']; */
		} 
		$data['result'] = $result;
		$data['user_type'] = $user_type;
		//用来判断 用户是否已经完善单位信息
		$data['org_code'] = $rs[0]['org_code'];
		$data['org_name'] = $result_org['org_name'];
		echo json_encode($data);
		$db->Close();
	}
}
?>