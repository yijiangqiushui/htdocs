<?php
/**
 * 文件描述
 * 此页面用来获取后台用户完善的个人信息并且返回该用户所在公司的基本信息
 * @author david <david55555.hi@gmail.com>
 * @date 2015年11月19日 下午4:32:40
 * @version 1.0.0
 * @copyright  david
 * 
 */
include '../../../../common/php/config.ini.php';
//include '../../../../modules/php/config.ini.php';
include '../../../../common/php/lib/db.cls.php';
include '../../../../common/php/lib/file.cls.php';
include '../../../../common/php/lib/user.cls.php';

$action = $_REQUEST ['action'];
$user_id = $_SESSION ['user_id']; // 获取用户的id
$org_code = $_POST ['orgCode'];
$user_info ['email'] = $_POST ['email'];
$user_info ['realname'] = $_POST ['name'];
$user_info ['phone'] = $_POST ['phone'];
$user_info ['address'] = $_POST ['address'];
$user_info ['org_code'] = $org_code;
// $user_info ['user_type'] = 0;

// echo $_POST['email'];

$user = new USER ();
switch ($action) {
	case 'userComplete' :
		$user->userComplete ( $org_code, $user_info, $user_id );
		break;
}