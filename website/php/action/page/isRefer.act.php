<?php
/**
 author:Gao Xue
 date:2014-06-16
 */
include '../../../../center/php/config.ini.php';
include '../../../../common/php/config.ini.php';
include '../../../../common/php/lib/db.cls.php';
include '../class/isRefer.cls.php';

$action = $_GET ['action'];
$page = $_POST ['page'];
$rows = $_POST ['rows'];

$notrefer = new ISREFER ();

switch ($action) {
	case 'queryRefer' :
		$notrefer->queryRefer ();
		break;
	default :
		;
}
?>