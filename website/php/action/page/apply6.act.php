<?php
// heyangyang
/**
 * Modified by Gao Xue 2014/06/19
 * Modified by Gao Xue 2014/06/20
 */
include '../class/app.cls.php';

$action = $_GET ['action'];
$id = intval ( $_GET ['id'] );
$flag = $_GET ['flag'];
$idlist = $_GET ['idlist'];
$page = $_POST ['page'];
$rows = $_POST ['rows'];

$unit ['name'] = $_POST ['name'];
$unit ['sort'] = intval ( $_POST ['sort'] );
$unit ['contribute'] = $_POST ['contribute'];
$unit ['address'] = $_POST ['address'];
$unit ['postcode'] = $_POST ['postcode'];
$unit ['nature'] = $_POST ['nature'];
$unit ['type'] = $_POST ['type'];
$unit ['isSeparateLegal'] = intval ( $_POST ['isSeparateLegal'] );
$unit ['registeNum'] = $_POST ['registeNum'];
$unit ['organizationCode'] = $_POST ['organizationCode'];
$unit ['zone'] = $_POST ['zone'];
$unit ['web'] = $_POST ['web'];
$unit ['contact'] = $_POST ['contact'];
$unit ['phone'] = $_POST ['phone'];
$unit ['fax'] = $_POST ['fax'];
$unit ['tel'] = $_POST ['tel'];
$unit ['email'] = $_POST ['email'];
$unit ['proContact'] = $_POST ['proContact'];
$unit ['proTel'] = $_POST ['proTel'];
$unit ['proEmail'] = $_POST ['proEmail'];

switch ($action) {
	
	case 'query' :
		show ( $id, $flag );
		break;
	case 'printUnit' :
		printUnit ( $id );
		break;
	case 'add' :
		add ( $unit, $id );
		break;
	case 'findbyid' :
		findById ( $id );
		break;
	case 'update' :
		update ( $unit, $id );
		break;
	case 'delete' :
		delete ( $id );
		break;
	case 'deletelist' :
		deletelist ( $idlist );
		break;
	default :
		;
}
function show($id, $flag) {
	// $appid=$_SESSION['app_id'];
	global $page;
	global $rows;
	$act = new App ();
	if ($flag != '0') {
		$id = ($id != 0) ? intval ( $id ) : $_SESSION ['app_id'];
		$sql = 'SELECT * FROM application_unit WHERE app_id=' . $id . ' ORDER BY id DESC';
		$sql_cou = 'select count(id) as "count" from application_unit where app_id=' . $id;
		
		$cou = $act->getCount ( $sql_cou );
		$arr = $act->getListByCon ( $page, $rows, $cou, $sql );
		$json = $act->toJson ( $arr, $cou );
	} else {
		if ($_SESSION ['app_unit'] != null && $_SESSION ['app_unit'] != '') {
			$sql = 'SELECT * FROM application_unit WHERE app_id=' . $_SESSION ['app_id'] . ' ORDER BY id DESC';
			$sql_cou = 'select count(id) as "count" from application_unit where app_id=' . $_SESSION ['app_id'];
			
			$cou = $act->getCount ( $sql_cou );
			$arr = $act->getListByCon ( $page, $rows, $cou, $sql );
			$json = $act->toJson ( $arr, $cou );
		} else {
			$json = '{"total":0,"rows":[]}';
		}
	}
	echo $json;
}
function printUnit($id) {
	$sql = 'SELECT * FROM application_unit WHERE app_id=' . $id . ' ORDER BY sort ASC';
	$act = new App ();
	$json = $act->printUnit ( $sql );
	echo $json;
}

/**
 * 修改如果appid不存在，返回0；
 */
function add($unit, $id) {
	$unit ['app_id'] = ($id !== 0) ? intval ( $id ) : $_SESSION ['app_id'];
	$act = new App ();
	$r = $act->addData ( 'application_unit', $unit );
	if ($r != 0) {
		$_SESSION ['app_unit'] = 'success';
		findById ( $r );
	} else {
		echo 0;
	}
}
function findById($id) {
	$act = new App ();
	$u = $act->findbyid ( $id, 'application_unit' );
	$json = $act->toJson2 ( $u );
	echo $json;
}
function update($unit, $id) {
	$act = new App ();
	$act->updateData ( 'application_unit', $unit, $id );
	findbyid ( $id );
}
function delete($id) {
	$act = new App ();
	$act->deleteData ( 'application_unit', $id );
}
function deletelist($idlist) {
	$act = new App ();
	$act->deleteList ( 'application_unit', $idlist );
}

?>