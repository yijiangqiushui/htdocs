<?php
include '../../../../common/php/config.ini.php';
// include '../../../../center/php/config.ini.php';

include '../../../../common/php/lib/db.cls.php';
include '../../../../common/php/lib/user.cls.php';
include '../class/index.php';

// 	session_start();
	$user = new USER ();
	$index = new Index ();
	switch ($_GET ['action']) {
		case 'login' :
			// 处理登录
			if ($_SESSION['validate_code'] != strtolower($_POST ['validateCode'])){
                 
			    $data['result'] = 'code_err';
				echo json_encode($data);
			} else {
				$index->check_login ( $_POST ['username'], $user->EncriptPWD ( $_POST ['password'] ) ); // 加密传送
			}
			break;
		case 'org_code':
			$username = $_POST['username'];
			$db = new DB();
			$res = $db -> GetInfo1($username, 'login_info', 'username');
			echo $res['org_code'];
			break;
	}

