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

$peo ['sort'] = intval ( $_POST ['sort'] );
$peo ['name'] = $_POST ['name'];
$peo ['sex'] = $_POST ['sex'];
$peo ['nation'] = $_POST ['nation'];
$peo ['birthplace'] = $_POST ['birthplace'];
$peo ['birthdate'] = $_POST ['birthdate'];
$peo ['idNumber'] = $_POST ['idNumber'];
$peo ['eduLeval'] = $_POST ['eduLeval'];
$peo ['graduateTime'] = $_POST ['graduateTime'];
$peo ['isHomecoming'] = intval ( $_POST ['isHomecoming'] );
$peo ['company'] = $_POST ['company'];
$peo ['phone'] = $_POST ['phone'];
$peo ['email'] = $_POST ['email'];
$peo ['tel'] = $_POST ['tel'];
$peo ['address'] = $_POST ['address'];
$peo ['graduateSchool'] = $_POST ['graduateSchool'];
$peo ['major'] = $_POST ['major'];
$peo ['degree'] = $_POST ['degree'];
$peo ['profession'] = $_POST ['profession'];
$peo ['techTitle'] = $_POST ['techTitle'];
$peo ['adminPost'] = $_POST ['adminPost'];
$peo ['familiarSubject'] = $_POST ['familiarSubject'];
$peo ['techAward'] = $_POST ['techAward'];
$peo ['startTime'] = $_POST ['startTime'];
$peo ['endTime'] = $_POST ['endTime'];
$peo ['contribute'] = $_POST ['contribute'];

switch ($action) {
	
	case 'query' :
		show ( $id, $flag );
		break;
	case 'printPeople' :
		printPeople ( $id );
		break;
	case 'add' :
		add ( $peo, $id );
		break;
	case 'findbyid' :
		findById ( $id );
		break;
	case 'update' :
		update ( $peo, $id );
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
	global $page;
	global $rows;
	
	$act = new App ();
	if ($flag != '0') {
		$id = ($id !== 0) ? intval ( $id ) : $_SESSION ['app_id'];
		$sql = 'SELECT * FROM application_people WHERE app_id=' . $id . ' ORDER BY id DESC';
		$sql_cou = 'select count(id) as "count" from application_people where app_id=' . $id;
		
		$cou = $act->getCount ( $sql_cou );
		$arr = $act->getListByCon ( $page, $rows, $cou, $sql );
		$json = $act->toJsonPeo ( $arr, $cou );
	} else {
		if ($_SESSION ['app_people'] != null && $_SESSION ['app_people'] != '') {
			$sql = 'SELECT * FROM application_people WHERE app_id=' . $_SESSION ['app_id'] . ' ORDER BY id DESC';
			$sql_cou = 'select count(id) as "count" from application_people where app_id=' . $_SESSION ['app_id'];
			
			$cou = $act->getCount ( $sql_cou );
			$arr = $act->getListByCon ( $page, $rows, $cou, $sql );
			$json = $act->toJsonPeo ( $arr, $cou );
		} else {
			$json = '{"total":0,"rows":[]}';
		}
	}
	echo $json;
}
function printPeople($id) {
	$sql = 'SELECT * FROM application_people WHERE app_id=' . $id . ' ORDER BY sort ASC';
	$act = new App ();
	$json = $act->printPeople ( $sql );
	echo $json;
}
function add($peo, $id) {
	$peo ['app_id'] = ($id !== 0) ? intval ( $id ) : $_SESSION ['app_id'];
	$act = new App ();
	$r = $act->addData ( 'application_people', $peo );
	if ($r != 0) {
		$_SESSION ['app_people'] = 'success';
	}
	findById ( $r );
}
function findById($id) {
	$act = new App ();
	$u = $act->findbyid ( $id, 'application_people' );
	$json = $act->toJson2Peo ( $u );
	echo $json;
}
function update($peo, $id) {
	$act = new App ();
	$act->updateData ( 'application_people', $peo, $id );
	findbyid ( $id );
}
function delete($id) {
	$act = new App ();
	$act->deleteData ( 'application_people', $id );
}
function deletelist($idlist) {
	$act = new App ();
	$act->deleteList ( 'application_people', $idlist );
}

?>