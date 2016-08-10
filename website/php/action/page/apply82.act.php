<?php
// heyangyang
/**
 * Modified by Gao Xue 2014/06/19
 * 2014-07-07 Modefied By Gao Xue
 * 2014-07-12 Modefied By Gao Xue
 */
include '../class/app.cls.php';
include '../../../../common/php/lib/file.cls.php';

$action = $_GET ['action'];
$id = intval ( $_GET ['id'] );
$flag = $_GET ['flag'];
$idlist = $_GET ['idlist'];
$page = $_POST ['page'];
$rows = $_POST ['rows'];

$tech ['name'] = $_POST ['name'];
$tech ['evaluationForm'] = $_POST ['evaluationForm'];
$tech ['organizationUnit'] = $_POST ['organizationUnit'];
$tech ['evaluationTime'] = $_POST ['evaluationTime'];
$tech ['evaluationLevel'] = $_POST ['evaluationLevel'];

switch ($action) {
	
	case 'query' :
		show ( $id, $flag );
		break;
	case 'printProof2' :
		printProof2 ( $id );
		break;
	case 'add' :
		add ( $tech, $id );
		break;
	case 'findbyid' :
		findById ( $id );
		break;
	case 'update' :
		update ( $tech, $id );
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
		$sql = 'SELECT * FROM application_proof2 WHERE app_id=' . $id . ' ORDER BY id DESC';
		$sql_cou = 'select count(id) as "count" from application_proof2 where app_id=' . $id;
		
		$cou = $act->getCount ( $sql_cou );
		$arr = $act->getListByCon ( $page, $rows, $cou, $sql );
		$json = $act->toJsonTech ( $arr, $cou );
	} else {
		if ($_SESSION ['app_proof2'] != null && $_SESSION ['app_proof2'] != '') {
			$sql = 'SELECT * FROM application_proof2 WHERE app_id=' . $_SESSION ['app_id'] . ' ORDER BY id DESC';
			$sql_cou = 'select count(id) as "count" from application_proof2 where app_id=' . $_SESSION ['app_id'];
			
			$cou = $act->getCount ( $sql_cou );
			$arr = $act->getListByCon ( $page, $rows, $cou, $sql );
			$json = $act->toJsonTech ( $arr, $cou );
		} else {
			$json = '{"total":0,"rows":[]}';
		}
	}
	echo $json;
}
function printProof2($id) {
	$sql = 'SELECT * FROM application_proof2 WHERE app_id=' . $id . ' ORDER BY id DESC';
	$act = new App ();
	$json = $act->printProof2 ( $sql );
	echo $json;
}
function add($tech, $id) {
	$tech ['app_id'] = ($id !== 0) ? intval ( $id ) : $_SESSION ['app_id'];
	
	// $app_id=$_SESSION['app_id'];
	
	// $tech['app_id']=$app_id;
	
	$act = new App ();
	$r = $act->addData ( 'application_proof2', $tech );
	/**
	 * *********2014-07-07 Modefied By Gao Xue*******************
	 */
	if ($r != 0) {
		$_SESSION ['app_proof2'] = 'success';
	}
	findById ( $r );
}
function findById($id) {
	$act = new App ();
	$u = $act->findbyid ( $id, 'application_proof2' );
	$json = $act->toJson2Tech ( $u );
	echo $json;
}
function update($tech, $id) {
	$act = new App ();
	$act->updateData ( 'application_proof2', $tech, $id );
	findbyid ( $id );
}
function delete($id) {
	$act = new App ();
	$sql = 'select id,savepath,autoname from attach_proof where pro_id=' . $id;
	$arr = $act->getListBySql ( $sql );
	
	$file = new FILE ();
	
	for($i = 0; $i < count ( $arr ); $i ++) {
		if (! ($arr [$i] ['autoname'] === null || $arr [$i] ['autoname'] === '')) {
			$path = CUR_ROOTPATH . $arr [$i] ['savepath'] . $arr [$i] ['autoname'];
			$file->del_file ( $path );
		}
	}
	
	$sql_del = 'delete from attach_proof where pro_id=' . $id;
	$act->deleteBySql ( $sql_del );
	
	$act->deleteData ( 'application_proof2', $id );
}
function deletelist($idlist) {
	$act = new App ();
	$file = new FILE ();
	
	$idarr = explode ( ',', $idlist );
	for($i = 0; $i < count ( $idarr ); $i ++) {
		$sql = 'select id,savepath,autoname from attach_proof where pro_id=' . $idarr [$i];
		$att_arr = $act->getListBySql ( $sql );
		for($j = 0; $j < count ( $att_arr ); $j ++) {
			if (! ($att_arr [$i] ['autoname'] === null || $att_arr [$i] ['autoname'] === '')) {
				$path = CUR_ROOTPATH . $att_arr [$i] ['savepath'] . $att_arr [$i] ['autoname'];
				$file->del_file ( $path );
			}
		}
		$sql_del = 'delete from attach_proof where pro_id=' . $idarr [$i];
		$act->deleteBySql ( $sql_del );
	}
	
	$act->deleteList ( 'application_proof2', $idlist );
}

?>