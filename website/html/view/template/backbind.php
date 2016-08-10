<?php 	
	include '../../../../common/php/config.ini.php';
	include '../../../../common/php/lib/db.cls.php';
	
	$code = '0';
	$db  = new DB();
	$username = $_SESSION['username'];
	$project_id = $_SESSION['project_id'];
	$result = $db -> GetInfo1($username, 'admininfo', 'username');
    if(!empty($result)){
    	$code = '1';
    }
    $data = array(
    	'code' => $code
    );
    $db->Close();
    echo json_encode($data);