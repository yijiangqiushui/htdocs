<?php 
	require_once '../../../../common/php/config.ini.php';
	require_once '../../../../common/php/lib/db.cls.php';
	$db = new DB();
	$project_id = $_SESSION['project_id'];
	$sql = "SELECT project_type FROM project_info WHERE project_id = '$project_id'";
	$res = $db -> Select($sql);
	$id = $res[0]['project_type'];
	$sql2 = "SELECT attatch_name FROM project_type WHERE id = '$id'";
	$res2 = $db -> Select($sql2);
	$resturn = '1';
	if($res2[0]['attatch_name'] == '19' || $res2[0]['attatch_name'] == '20'){
		$resturn = '1';
	}else{
		$resturn = '0';
	}
	echo $resturn;
