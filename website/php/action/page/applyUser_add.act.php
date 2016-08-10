<?php

/**
 * 文件描述
 *
 * @author david <david55555.hi@gmail.com>
 * @date 2015年11月18日 下午4:06:02
 * @version 1.0.0
 * @copyright 
 */
include '../../../../common/php/config.ini.php';
include '../../../../common/php/lib/db.cls.php';
include '../../../../common/php/lib/file.cls.php';
include '../../../../common/php/lib/user.cls.php';
$user = new USER ();
session_start();


$login_info ['org_code'] = $_POST ['orgCode'];
$_SESSION['org_code']=$login_info ['org_code'];
$login_info ['username'] = $_POST ['username'];//用户名
$_SESSION['username']=$login_info ['username'];
$login_info ['password'] = $user->EncriptPWD ( $_POST ['pwd'] );//用户密码
// $login_info ['user_type'] = 0;//用户类型  user_type 可以不修改
$login_info ['realname'] = $_POST ['name'];//联系人姓名;
$login_info ['phone'] = $_POST ['phone'];//座机电话
$login_info ['celphone'] = $_POST ['celphone'];//联系人电话
$login_info ['address'] = $_POST ['address'];//地址 register1.php没有这个字段
$login_info ['email'] = $_POST ['email'];//电子邮箱

$org_info ['org_code'] = $_POST ['orgCode'];//公司组织代码
$org_info ['org_name'] = $_POST ['orgName'];//公司名字 register1.php没有这个字段
// 这里其实缺少公司code的判断
// $_SESSION['org_code'] = $org_info['org_code'];

$db = new DB ();
// 需要和数据库进行匹配
$stat_user = $db->GetInfo1 ( $_POST ['username'], 'login_info', 'username' );

$stat_email = $db->GetInfo1 ( $_POST ['email'], 'login_info', 'email' );

$stat_org = $db->GetInfo1 ( $_POST ['orgCode'], 'org_info', 'org_code' );

// $data['org_code'] = $org_info['org_code'];
$data ['org_name'] = $org_info ['org_name'];
/*
 * 0：不存在
 * 1：存在
 */

$data ['user_status'] = 1;
$data ['org_status'] = 1;
if(!empty($stat_email)){
	$data ['user_status'] = 2;
}else if (empty ( $stat_user['username'] ) || ($stat_user['username'] != null && $stat_user['org_code'] == null)) { // 如果用户的信息是不存在的则可以进行相应的操作 ，如果公司的信息是不存在的则进行插入的操作。
	if($stat_user['username'] != null && $stat_user['org_code'] == null){
		unset($login_info ['password']);
		$data ['user_status'] = 0;
		$update_login = $db->UpdateData1('login_info', $login_info ['username'], $login_info, 'username');
	}else{
		$data ['user_status'] = 0;
		$insert_login = $db->InsertData ( 'login_info', $login_info );
	}
	if (empty ( $stat_org )) { // 如果公司信息不存在的话，则将企业信息进行入库操作
		$insert_org = $db->InsertData ( 'org_info', $org_info );
		$data ['org_status'] = 0;
	}
	$data ['org_code'] = $stat_org ['org_code'];
	$data ['org_name'] = $stat_org ['org_name'];
	
	// 这里是文件上传的地方，暂时不需要
	/*
	 * if($insert_org>0){
	 * $time=time();
	 * $y=date('Y',$time);
	 * $m=date('m',$time);
	 * $d=date('d',$time);
	 *
	 * $savepath='upload/'.$y.'/'.$m.'/'.$d.'/';
	 *
	 * if($_FILES['file']['error']==0){
	 * $vars=array(
	 * 'file'=>'file',
	 * 'limit_size'=>LIMIT_SIZE,
	 * 'savepath'=>$savepath,
	 * 'rootpath'=>CUR_ROOTPATH,
	 * 'allowed_ext'=>''
	 * );
	 *
	 * $file=new FILE($vars);
	 *
	 * $att['autoname']=$file->get_auto_filename();
	 * $att['attname']=$file->get_filename();
	 * $att['savepath']=$file->get_savepath();
	 * $att['uptime']=date('Y-m-d',$time);
	 * $att['orgId']=$insertId;
	 * $att['mark']='税务登记证';
	 * $db->InsertData('attach_apply',$att);
	 * }
	 *
	 * if($_FILES['file1']['error']==0){
	 *
	 * $vars1=array(
	 * 'file'=>'file1',
	 * 'limit_size'=>LIMIT_SIZE,
	 * 'savepath'=>$savepath,
	 * 'rootpath'=>CUR_ROOTPATH,
	 * 'allowed_ext'=>''
	 * );
	 *
	 * $file1=new FILE($vars1);
	 *
	 * $att1['autoname']=$file1->get_auto_filename();
	 * $att1['attname']=$file1->get_filename();
	 * $att1['savepath']=$file1->get_savepath();
	 * $att1['uptime']=date('Y-m-d',$time);
	 * $att1['orgId']=$insertId;
	 * $att1['mark']='工商营业执照';
	 * $db->InsertData('attach_apply',$att1);
	 * }
	 *
	 * }
	 */
}
/*
 * else if(!empty($stat_org)){ //若企业信息不是空的 如果用户信息是存在的
 * $data[] =
 * $insert_login = $db->InsertData('login_info', $login_info);
 * $data['status'] = "orgexist";
 * }
 * else{
 * $insert_login = $db->InsertData('login_info', $login_info);
 * $data['status'] = "userexist";
 * }
 */

$res = $db->GetInfo1($login_info ['username'], 'login_info', 'username');
$_SESSION['user_id'] = $res['id'];
$_SESSION['user_type'] = $res['user_type'];
$db->Close ();
echo json_encode ( $data )?>

