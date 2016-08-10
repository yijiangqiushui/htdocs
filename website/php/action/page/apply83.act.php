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

$sta ['name'] = $_POST ['name'];
$sta ['category'] = $_POST ['category'];
$sta ['standardNo'] = $_POST ['standardNo'];

switch ($action) {
	
	case 'query' :
		show ( $id, $flag );
		break;
	case 'printProof3' :
		printProof3 ( $id );
		break;
	case 'add' :
		add ( $sta, $id );
		break;
	case 'findbyid' :
		findById ( $id );
		break;
	case 'update' :
		update ( $sta, $id );
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
	
	// $appid=1;
	global $page;
	global $rows;
	
	$act = new App ();
	if ($flag != '0') {
		$id = ($id !== 0) ? intval ( $id ) : $_SESSION ['app_id'];
		$sql = 'SELECT * FROM application_proof3 WHERE app_id=' . $id . ' ORDER BY id DESC';
		$sql_cou = 'select count(id) as "count" from application_proof3 where app_id=' . $id;
		
		$cou = $act->getCount ( $sql_cou );
		$arr = $act->getListByCon ( $page, $rows, $cou, $sql );
		$json = $act->toJsonSta ( $arr, $cou );
	} else {
		if ($_SESSION ['app_proof3'] != null && $_SESSION ['app_proof3'] != '') {
			$sql = 'SELECT * FROM application_proof3 WHERE app_id=' . $_SESSION ['app_id'] . ' ORDER BY id DESC';
			$sql_cou = 'select count(id) as "count" from application_proof3 where app_id=' . $_SESSION ['app_id'];
			
			$cou = $act->getCount ( $sql_cou );
			$arr = $act->getListByCon ( $page, $rows, $cou, $sql );
			$json = $act->toJsonSta ( $arr, $cou );
		} else {
			$json = '{"total":0,"rows":[]}';
		}
	}
	echo $json;
}
function printProof3($id) {
	$sql = 'SELECT * FROM application_proof3 WHERE app_id=' . $id . ' ORDER BY id DESC';
	$act = new App ();
	$json = $act->printProof3 ( $sql );
	echo $json;
}
function add($sta, $id) {
	
	// $app_id=$_SESSION['app_id'];
	
	// $sta['app_id']=$app_id;
	$sta ['app_id'] = ($id !== 0) ? intval ( $id ) : $_SESSION ['app_id'];
	
	$act = new App ();
	$r = $act->addData ( 'application_proof3', $sta );
	/**
	 * *********2014-07-07 Modefied By Gao Xue*******************
	 */
	if ($r != 0) {
		$_SESSION ['app_proof3'] = 'success';
	}
	findById ( $r );
}
function findById($id) {
	$act = new App ();
	$u = $act->findbyid ( $id, 'application_proof3' );
	$json = $act->toJson2Sta ( $u );
	echo $json;
}
function update($sta, $id) {
	$act = new App ();
	$act->updateData ( 'application_proof3', $sta, $id );
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
	
	$act->deleteData ( 'application_proof3', $id );
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
	
	$act->deleteList ( 'application_proof3', $idlist );
}

?>