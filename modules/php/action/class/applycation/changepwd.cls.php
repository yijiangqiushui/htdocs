<?php
include "../../../../../common/php/lib/user.cls.php";

class APPLY
{
    /*
     * userinfo  信息添加或者更新
     *
     * */
    function update_pwd($user_id,$newpwd){
        $user=new USER();
        $mipwd=$user->EncriptPWD($newpwd);
        
        $sql='update login_info set password ='."'".$mipwd."'".' where id='.$user_id;
        
        $db=new DB();
        $result=$db->Update($sql);
        echo $result;
        
        $db->Close();
        
        
        
    
    }
    
    /*
     * changepwd.html
     *
     * */
    function find_old_pwd($user_id,$inoldpwd){
    	$user=new USER();
    	$mipwd=$user->EncriptPWD($inoldpwd);
		$db=new DB();
		$sql="select * from login_info where id=".$user_id." and password='".$mipwd."' limit 0,1";
		$rs=$db->Select($sql);
		
		if(is_array($rs) && sizeof($rs)>0){
			echo  json_encode(array('retflag'=>'success'));
		}
		else{
			echo json_encode(array('retflag'=>'wrong'.is_array($rs)));
		}
		$db->Close();
	
    
    }
    
     function clear_token($id) {
     	$db=new DB();
     	$sql = "UPDATE login_info SET token='' WHERE id='$id'";
    	$db->update($sql);
     }
    
}
?>