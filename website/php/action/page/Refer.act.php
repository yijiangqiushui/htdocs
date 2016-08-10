<?php
/**
 author:Gao Xue
 date:2014-07-07
 */
include '../../../../center/php/config.ini.php';
include '../../../../common/php/config.ini.php';
include '../../../../common/php/lib/db.cls.php';
include '../class/Refer.cls.php';

$action = $_GET ['action'];
$id = $_GET ['id'];
$flag = $_GET ['flag'];

$refer = new REFER ();

switch ($action) {
	case 'commitRec' :
		$refer->commitRec ( $id, $flag );
		break;
	default :
		;
}
?>