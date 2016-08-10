<?php
include '../../../../../common/php/lib/common.cls.php';
class APPLY
{
    /*
     * userinfo  信息添加或者更新
     *
     * */
    function login_info($user_id,$arrData){
        $db=new DB();
        $db->UpdateTabData('login_info',$user_id, $arrData, 'id');
        $db->Close();
    
    }
    
    
    function login_info2($org_code,$arrData){
        $db=new DB();
        $db->UpdateTabData('org_info',$org_code, $arrData, 'org_code');
        $db->Close();
    
    }
    
    /*
     * 附件6 org_info.html获取表
     *
     * */
    function find_login_info($user_id){
        $db=new DB();
        $res1=$db->GetInfo1($user_id, 'login_info', 'id');
        $appJSON=array(
            'username'=>$res1['username'],//用户名;
            'password'=>$res1['password'],//密码;
            'org_code'=>$res1['org_code'],//公司组织代码
            'org_type'=>$res1['org_type'],//公司类型
            'isForbidden'=>$res1['isForbidden'],//用户是否禁止
            'lastIP'=>$res1['lastIP'],//最后一次登陆
            'addDate'=>$res1['addDate'],//用户添加时间
            'user_type'=>$res1['user_type'],//用户类型
            'department'=>$res1['department'],//用户所属部门
            'realname'=>$res1['realname'],//用户真实姓名
            'address'=>$res1['address'],//
            'phone'=>$res1['phone'],//座机
            'email'=>$res1['email'], //电子邮箱     
            'celphone'=>$res1['celphone']//移动电话
           
        );
    
        echo json_encode($appJSON);
        $db->Close();
    
    }
    /**
     * 发邮件重置密码
     * @param unknown $email
     */
    function resetpwd($email){
    	$db=new DB();
    	$token = md5(microtime(true));
    	$sql = "UPDATE login_info SET token='$token' WHERE email='$email'";
    	$db->update($sql);
    	$host = $_SERVER['SERVER_NAME'];
		$port = $_SERVER['SERVER_PORT'];
    	$common=new COMMON();
		$sql = "select * from login_info where email = '$email' limit 1";
		$result = $db->Select($sql);
		$db->Close();
    	$common->email_send($email,'重置密码链接','尊敬的 '.$result[0]['realname'].' 用户，这是您的重置密码链接：<a target="_blank" href="http://'.$host.':'.$port.'/website/html/view/template/userinfo/resetpwd.php?token='.$token.'">http://'. $host .':'.$port. '/website/html/view/template/userinfo/resetpwd.php?token='.$token.'</a>');
    }
     
    function checktoken($token) {
    	$db=new DB();
    	$sql = "SELECT id FROM login_info WHERE token='$token'";
    	$result = $db->Select($sql);
    	if($result) {
    		echo $result[0]['id'];
    	} else {
    		echo 0;
    	}
    	$db->Close();
    }
    
    function checkemail($email) {
    	$db=new DB();
    	$sql = "SELECT * FROM login_info WHERE email='$email'";
    	$result = $db->Select($sql);
    	if($result) {
    		echo 1;
    	} else {
    		echo 0;
    	}
    	$db->Close();
    }
}
?>