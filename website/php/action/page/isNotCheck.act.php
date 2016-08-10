<?php
/**
 author:Gao Xue
 date:2014-06-16
 */
include '../../../../center/php/config.ini.php';
include '../../../../common/php/config.ini.php';
include '../../../../common/php/lib/db.cls.php';
include '../class/isNotCheck.cls.php';

$action = $_GET ['action'];
$page = $_POST ['page'];
$rows = $_POST ['rows'];

$flag = $_GET ['flag'];

$notcheck = new ISNOTCHECK ();

switch ($action) {
	case 'queryNotCheck' :
		$notcheck->queryNotCheck ( $flag );
		break;
	default :
		;
}
?>