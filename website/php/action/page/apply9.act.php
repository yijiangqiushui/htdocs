<?php
// heyangyang
include '../class/app.cls.php';

$action = $_GET ['action'];
$appid = $_GET ['appid'];

$id = $_GET ['id'];

$rec ['content'] = $_POST ['content'];

switch ($action) {
	
	case 'query' :
		show ( $id );
		break;
	case 'queryinfo' :
		showInfo ( $appid );
		break;
	case 'add' :
		add ( $rec, $appid );
		break;
	case 'update' :
		update ( $rec, $appid );
		break;
	default :
		;
}
function show($id) {
	$act = new App ();
	$sql = 'SELECT * FROM application_recommend WHERE app_id=' . $id;
	
	$arr = $act->getListBySql ( $sql );
	$json = $act->toJsonRec ( $arr [0] );
	echo $json;
}
function showInfo($appid) {
	$act = new App ();
	$sql = 'SELECT * FROM application_recommend WHERE app_id=' . $appid;
	
	$arr = $act->getListBySql ( $sql );
	if (count ( $arr ) == 0) {
		echo 'null';
	} else {
		$json = $act->toJsonRec ( $arr [0] );
		echo $json;
	}
}
function add($rec, $appid) {
	$rec ['app_id'] = $appid;
	$act = new App ();
	$act->addData ( 'application_recommend', $rec );
}
function update($rec, $appid) {
	$rec ['app_id'] = $appid;
	$act = new App ();
	$sql = 'update application_recommend set content = "' . $rec ['content'] . '" where app_id =' . $appid;
	$act->updateBySql ( $sql );
}

?>