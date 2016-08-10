<?php

// include '../../../../center/php/config.ini.php';
include '../../../../common/php/config.ini.php';
include '../../../../common/php/lib/db.cls.php';
include '../class/approve.cls.php';
include '../../../../common/php/plugin/fenci_v1.0_utf8/checkduplicate.cls.php';
include '../../../../modules/php/action/class/projectapp/util.cls.php';


$action = $_GET ['action'];
$page = $_POST ['page'];
$rows = $_POST ['rows'];
$project_id=$_SESSION['project_id'];

$apply = new APPLY ();
switch ($action) {
	case 'approveinfo' :
		$apply->approveinfo ( $page, $rows,$project_id);
		break;
}

?>