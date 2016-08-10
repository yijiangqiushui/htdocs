<?php
/**
 author:Gao Xue
 date:2014-05-23
 */
include '../../../../../center/php/config.ini.php';
include '../../../../../common/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';
include '../../class/userrole_info.cls.php';
include '../../../../../common/php/plugin/fenci_v1.0_utf8/checkduplicate.cls.php';

$department = $_SESSION ['department'];
$user_type = $_SESSION['user_type'];

$action = $_GET['action'];
$departmentuser = $_GET['department'];

$apply = new APPLY ();
// $apply->checklist ( $page, $rows, $department, $min_status, $max_status, $project_type,$state );
$page = $_POST ['page'];
$rows = $_POST ['rows'];
//echo "$page";exit;
// $apply->userrole($page,$rows);

	switch ($action){
		case 'userrole_all':
			if($user_type == 3){
				$apply->userroleall($page,$rows);
			}
			else {
				$apply->userrole($page, $rows, $department);
			}
			break;
	   case 'userrole':
	   		$apply->userrole($page, $rows, $departmentuser);
	   		break;
		default:break;
	}
?>