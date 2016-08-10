<?php
// heyangyang
/*
 * Modified By Gao Xue 2014-07-07
 * Modified By Gao Xue 2014-07-12
 */
include '../class/app.cls.php';
include '../../../../common/php/lib/file.cls.php';

$action = $_GET ['action'];
$id = intval ( $_GET ['id'] );
$idlist = $_GET ['idlist'];
$pro = $_GET ['pro'];
$pid = intval ( $_GET ['pid'] );
$str = $_GET ['str'];

$page = $_POST ['page'];
$rows = $_POST ['rows'];

$att ['title'] = $_POST ['title'];
$att ['descrip'] = $_POST ['descrip'];

switch ($action) {
	
	case 'query' :
		show ( $pro, $pid );
		break;
	case 'add' :
		add ( $pro, $pid, $att, $id );
		break;
	case 'findbyid' :
		findById ( $id );
		break;
	case 'update' :
		update ( $att, $id );
		break;
	case 'delete' :
		delete ( $id );
		break;
	case 'deletelist' :
		deletelist ( $idlist );
		break;
	case 'queryAdvice' :
		queryAdvice ( $id, $str );
		break;
	default :
		;
}
function show($pro, $pid) {
	global $page;
	global $rows;
	
	$act = new App ();
	$sql = 'SELECT * FROM attach_proof WHERE pro= "' . $pro . '" and pro_id= ' . $pid . ' ORDER BY id DESC';
	$sql_cou = 'select count(id) as "count" from attach_proof where pro= "' . $pro . '" and pro_id= ' . $pid;
	
	$cou = $act->getCount ( $sql_cou );
	
	$arr = $act->getListByCon ( $page, $rows, $cou, $sql );
	$json = $act->toJsonAtt ( $arr, $cou );
	echo $json;
}
function add($pro, $pid, $att, $id) {
	$att ['pro'] = $pro;
	$att ['pro_id'] = $pid;
	$att ['app_id'] = ($id !== 0) ? intval ( $id ) : $_SESSION ['app_id'];
	if ($_FILES ['file'] ['type'] != 'image/jpeg' && $_FILES ['file'] ['type'] != 'application/pdf') {
		echo - 3;
		return;
	}
	$db = new DB ();
	$arr = $db->Select ( "select * from attach_proof where app_id = " . $att ['app_id'] );
	$db->Close ();
	if (count ( $arr ) >= 45) {
		echo - 2;
		return;
	} else {
		$file_size = 0;
		for($i = 0; $i < count ( $arr ); $i ++) {
			$file_size += $arr [$i] ['file_size'];
		}
		if ($file_size + $_FILES ['file'] ['size'] > 15 * 1024 * 1024) {
			echo - $file_size;
			return;
		}
	}
	if ($_FILES ['file'] ['error'] == 0) {
		$time = time ();
		$y = date ( 'Y', $time );
		$m = date ( 'm', $time );
		$d = date ( 'd', $time );
		
		$rootpath = CUR_ROOTPATH;
		
		$savepath = 'upload/proof/' . $y . '/' . $m . '/' . $d . '/';
		
		$vars = array (
				'file' => 'file',
				'limit_size' => MAX_SIZE,
				'savepath' => $savepath,
				'rootpath' => $rootpath,
				'allowed_ext' => '' 
		);
		
		$file = new FILE ( $vars );
		$att ['file_size'] = $file->get_filesize ();
		$att ['autoname'] = $file->get_auto_filename ();
		$att ['attname'] = $file->get_filename ();
		$att ['savepath'] = $file->get_savepath ();
	}
	
	$act = new App ();
	$r = $act->addData ( 'attach_proof', $att );
	if ($r != 0) {
		$_SESSION ['app_proof'] = 'success';
	}
	echo $r;
}
function findById($id) {
	$act = new App ();
	$u = $act->findbyid ( $id, 'attach_proof' );
	$json = $act->toJson2Att ( $u );
	echo json_encode ( $json );
}
function update($att, $id) {
	$act = new App ();
	
	if ($_FILES ['file'] ['error'] == 0) {
		$oldAtt = $act->findbyid ( $id, 'attach_proof' );
		$old_path = CUR_ROOTPATH . $oldAtt ['savepath'] . $oldAtt ['autoname'];
		
		$time = time ();
		$y = date ( 'Y', $time );
		$m = date ( 'm', $time );
		$d = date ( 'd', $time );
		
		$savepath = 'upload/proof/' . $y . '/' . $m . '/' . $d . '/';
		
		$vars = array (
				'file' => 'file',
				'limit_size' => MAX_SIZE,
				'savepath' => $savepath,
				'rootpath' => CUR_ROOTPATH,
				'old_file' => $old_path,
				'allowed_ext' => '' 
		);
		
		$file = new FILE ( $vars );
		
		$att ['autoname'] = $file->get_auto_filename ();
		$att ['attname'] = $file->get_filename ();
		$att ['savepath'] = $file->get_savepath ();
	}
	
	$act->updateData ( 'attach_proof', $att, $id );
	findById ( $id );
}
function delete($id) {
	$act = new App ();
	$att = $act->findbyid ( $id, 'attach_proof' );
	if (! ($att ['autoname'] === null || $att ['autoname'] === '')) {
		$path = CUR_ROOTPATH . $att ['savepath'] . $att ['autoname'];
		$file = new FILE ();
		$file->del_file ( $path );
	}
	$act->deleteData ( 'attach_proof', $id );
}
function deletelist($idlist) {
	$idarray = explode ( ',', $idlist );
	for($i = 0; $i < count ( $idarray ); $i ++) {
		delete ( $idarray [$i] );
	}
}
function queryAdvice($id, $str) {
	$act = new App ();
	$result = $act->queryAdvice ( $id, $str );
	echo $result;
}

?>