<?php
// heyangyang
/**
 * Modified by Gao Xue 2014/06/19
 * Modified by Gao Xue 2014/06/20
 */
include '../class/apply5.cls.php';

$action = $_GET ['action'];
$id = intval ( $_GET ['id'] );
$flag = $_GET ['flag'];
$idlist = $_GET ['idlist'];

$page = $_POST ['page'];
$rows = $_POST ['rows'];
$awd ['name'] = $_POST ['name'];
$awd ['awardName'] = $_POST ['awardName'];
$awd ['awardTime'] = $_POST ['awardTime'];
$awd ['awardGrade'] = $_POST ['awardGrade'];
$awd ['depart'] = $_POST ['depart'];

switch ($action) {
	
	case 'query' :
		show ( $id, $flag );
		break;
	case 'printAdward' :
		printAdward ( $id );
		break;
	case 'add' :
		add ( $awd, $id );
		break;
	case 'findbyid' :
		findbyid ( $id );
		break;
	case 'update' :
		update ( $awd, $id );
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
	// echo 'APP_ID:'.$_SESSION['app_id'].' '.'APP_AWARD:'.$_SESSION['app_award'];
	// $appid=$_SESSION['app_id'];
	global $page;
	global $rows;
	$act = new ApplicationAwardCls ();
	if ($flag != '0') {
		$id = ($id !== 0) ? intval ( $id ) : $_SESSION ['app_id'];
		$sql = 'SELECT * FROM application_award WHERE app_id=' . $id . ' ORDER BY id DESC';
		$sql_cou = 'select count(id) as "count" from application_award where app_id=' . $id;
		
		$cou = $act->getCountByCon ( $sql_cou );
		$arr = $act->pageListByCon ( $page, $rows, $cou, $sql );
		$json = $act->toJson ( $arr, $cou );
	} else {
		if ($_SESSION ['app_award'] != null && $_SESSION ['app_award'] != '') {
			$sql = 'SELECT * FROM application_award WHERE app_id=' . $_SESSION ['app_id'] . ' ORDER BY id DESC';
			$sql_cou = 'select count(id) as "count" from application_award where app_id=' . $_SESSION ['app_id'];
			
			$cou = $act->getCountByCon ( $sql_cou );
			$arr = $act->pageListByCon ( $page, $rows, $cou, $sql );
			$json = $act->toJson ( $arr, $cou );
		} else {
			$json = '{"total":0,"rows":[]}';
		}
	}
	echo $json;
}
function printAdward($id) {
	$act = new ApplicationAwardCls ();
	$sql = 'SELECT * FROM application_award WHERE app_id=' . $id . ' ORDER BY id DESC';
	
	$json = $act->printAdward ( $sql );
	
	echo $json;
}
function add($awd, $id) {
	$awd ['app_id'] = ($id !== 0) ? intval ( $id ) : $_SESSION ['app_id'];
	$act = new ApplicationAwardCls ();
	$id = $act->addData ( 'application_award', $awd );
	if ($id != 0) {
		$_SESSION ['app_award'] = 'success';
	}
	findbyid ( $id );
}
function findbyid($id) {
	$act = new ApplicationAwardCls ();
	$obj = $act->findbyid ( $id, 'application_award' );
	$res = $act->toJson2 ( $obj );
	echo $res;
}
function update($awd, $id) {
	$act = new ApplicationAwardCls ();
	$act->updateData ( 'application_award', $awd, $id );
	findbyid ( $id );
}
function delete($id) {
	$act = new ApplicationAwardCls ();
	$act->deleteData ( 'application_award', $id );
}
function deletelist($idlist) {
	$act = new ApplicationAwardCls ();
	$act->deleteList ( 'application_award', $idlist );
}
?>