<?php
// heyangyang
include '../class/app.cls.php';
include '../../../../common/php/lib/file.cls.php';

$action = $_GET ['action'];
$id = intval ( $_GET ['id'] );
$flag = $_GET ['flag'];
$idlist = $_GET ['idlist'];
$aid = intval ( $_GET ['aid'] );

switch ($action) {
	// --------------------经济效益---------------------------
	case 'queryBenefit' :
		showBen ( $aid, $flag );
		break;
	case 'printBen' :
		printBen ( $aid, $flag );
		break;
	case 'findBenById' :
		findBenById ( $id );
		break;
	case 'addBen' :
		$benefit ['year'] = intval ( $_POST ['year'] );
		$benefit ['income'] = floatval ( $_POST ['income'] );
		$benefit ['profit'] = floatval ( $_POST ['profit'] );
		$benefit ['tax'] = floatval ( $_POST ['tax'] );
		$benefit ['foreignCurrency'] = floatval ( $_POST ['foreignCurrency'] );
		$benefit ['totalSavings'] = floatval ( $_POST ['totalSavings'] );
		
		addBen ( $benefit, $aid );
		break;
	case 'updateBen' :
		$benefit ['year'] = intval ( $_POST ['year'] );
		$benefit ['income'] = floatval ( $_POST ['income'] );
		$benefit ['profit'] = floatval ( $_POST ['profit'] );
		$benefit ['tax'] = floatval ( $_POST ['tax'] );
		$benefit ['foreignCurrency'] = floatval ( $_POST ['foreignCurrency'] );
		$benefit ['totalSavings'] = floatval ( $_POST ['totalSavings'] );
		updateBen ( $id, $benefit );
		break;
	case 'deleteBen' :
		deleteBen ( $id );
		break;
	case 'delBen' :
		delBen ( $aid );
		break;
	
	// --------------------项目详细内容-----------------------------
	case 'show' :
		show ( $aid );
		break;
	case 'add' :
		$det ['background'] = $_POST ['background'];
		$det ['scienceCon'] = $_POST ['scienceCon'];
		$det ['extend'] = $_POST ['extend'];
		$det ['effect'] = $_POST ['effect'];
		$det ['invest'] = floatval ( $_POST ['invest'] );
		$det ['recoverDate'] = floatval ( $_POST ['recoverDate'] );
		$det ['casculBasis'] = $_POST ['casculBasis'];
		$det ['economicBenefit'] = $_POST ['economicBenefit'];
		$det ['socialeffect'] = $_POST ['socialeffect'];
		
		add ( $det );
		break;
	case 'update' :
		$det ['background'] = $_POST ['background'];
		$det ['scienceCon'] = $_POST ['scienceCon'];
		$det ['extend'] = $_POST ['extend'];
		$det ['effect'] = $_POST ['effect'];
		$det ['invest'] = floatval ( $_POST ['invest'] );
		$det ['recoverDate'] = floatval ( $_POST ['recoverDate'] );
		$det ['casculBasis'] = $_POST ['casculBasis'];
		$det ['economicBenefit'] = $_POST ['economicBenefit'];
		$det ['socialeffect'] = $_POST ['socialeffect'];
		
		update ( $det, $aid );
		break;
	// --------------------添加审核意见------------------------
	case 'addrecommend' :
		addrecommend ( $_POST ['checkAdvice'], $aid );
		break;
	default :
		;
}

// --------------------------------经济效益-----------------------------
function showBen($aid, $flag) {
	global $page;
	global $rows;
	$act = new App ();
	
	if ($flag != '0') {
		$id = ($aid !== 0) ? intval ( $aid ) : $_SESSION ['app_id'];
		$sql = 'SELECT * FROM economic_benefit WHERE app_id=' . $id . ' ORDER BY id';
		$sql_cou = 'select count(id) as "count" from economic_benefit WHERE app_id=' . $id;
		
		$cou = $act->getCount ( $sql_cou );
		$arr = $act->getListBySql ( $sql );
		$json = $act->toJsonBen ( $arr, $cou );
	} else {
		if ($_SESSION ['app_benefit'] != null && $_SESSION ['app_benefit'] != '') {
			$sql = 'SELECT * FROM economic_benefit WHERE app_id=' . $id . ' ORDER BY id';
			$sql_cou = 'select count(id) as "count" from economic_benefit WHERE app_id=' . $id;
			
			$cou = $act->getCount ( $sql_cou );
			$arr = $act->getListBySql ( $sql );
			$json = $act->toJsonBen ( $arr, $cou );
		} else {
			$json = '{"total":0,"rows":[]}';
		}
	}
	echo $json;
}
function printBen($aid, $flag) {
	global $page;
	global $rows;
	$act = new App ();
	
	if ($flag != '0') {
		$id = ($aid !== 0) ? intval ( $aid ) : $_SESSION ['app_id'];
		$sql = 'SELECT * FROM economic_benefit WHERE app_id=' . $id . ' ORDER BY id desc';
		$sql_cou = 'select count(id) as "count" from economic_benefit WHERE app_id=' . $id;
		
		$cou = $act->getCount ( $sql_cou );
		$arr = $act->getListBySql ( $sql );
		$json = $act->toJsonArrayBen ( $arr, $cou );
	} else {
		if ($_SESSION ['app_benefit'] != null && $_SESSION ['app_benefit'] != '') {
			$sql = 'SELECT * FROM economic_benefit WHERE app_id=' . $id . ' ORDER BY id desc';
			$sql_cou = 'select count(id) as "count" from economic_benefit WHERE app_id=' . $id;
			
			$cou = $act->getCount ( $sql_cou );
			$arr = $act->getListBySql ( $sql );
			$json = $act->toJsonArrayBen ( $arr, $cou );
		} else {
			$json = '[]';
		}
	}
	echo $json;
}
function findBenById($id) {
	$act = new App ();
	$o = $act->findbyid ( $id, 'economic_benefit' );
	$json = $act->toJson2Ben ( $o );
	echo $json;
}
function addBen($benefit, $aid) {
	$benefit ['app_id'] = ($aid !== 0) ? intval ( $aid ) : $_SESSION ['app_id'];
	// $benefit['app_id']=$aid;
	
	$act = new App ();
	$id = $act->addData ( 'economic_benefit', $benefit );
	if ($id != 0) {
		$_SESSION ['app_benefit'] = 'success';
	}
}
function updateBen($id, $benefit) {
	// $aid=1;
	// $benefit['app_id']=$aid;
	$act = new App ();
	$act->updateData ( 'economic_benefit', $benefit, $id );
}
function deleteBen($id) {
	$act = new App ();
	$act->deleteData ( 'economic_benefit', $id );
}
function delBen($aid) {
	// $aid=1;
	$act = new App ();
	$sql = 'delete from economic_benefit where app_id=' . $aid;
	$act->deleteBySql ( $sql );
}

// -----------------------------------------------项目详细内容------------------------------------
function add($det) {
	$act = new App (); // 详细信息添加技术方案
	$sqlQuery = 'select * from application_detail where app_id=' . $_SESSION ['app_id'];
	$result = $act->getListBySql ( $sqlQuery );
	
	if (count ( $result ) == '1') {
		if ($_FILES ['file'] ['error'] == 0) {
			$oldPath = SP_BASEPATH . $act->getPath ( $id );
			$time = time ();
			$y = date ( 'Y', $time );
			$m = date ( 'm', $time );
			$d = date ( 'd', $time );
			
			$savepath = 'upload/' . $y . '/' . $m . '/' . $d . '/'; // 获取新文件存储路
			$vars = array (
					'file' => 'file',
					'limit_size' => 50 * 1024 * 1024,
					'savepath' => $savepath,
					'rootpath' => SP_BASEPATH,
					'old_file' => $oldPath,
					'allowed_ext' => '' 
			);
			
			$file = new FILE ( $vars );
			$det ['filename'] = $file->get_savepath () . $file->get_auto_filename ();
		}
		$result = $act->updateData ( 'application_detail', $det, $result [0] ['id'] );
	} else {
		$det ['app_id'] = $_SESSION ['app_id'];
		if (! ($_FILES ['file'] ['error'])) {
			$time = time ();
			$y = date ( 'Y', $time );
			$m = date ( 'm', $time );
			$d = date ( 'd', $time );
			
			$rootpath = SP_BASEPATH;
			$savepath = 'upload/' . $y . '/' . $m . '/' . $d . '/';
			
			$vars = array (
					'file' => 'file',
					'limit_size' => 50 * 1024 * 1024,
					'savepath' => $savepath,
					'rootpath' => $rootpath,
					'allowed_ext' => '' 
			);
			$file = new FILE ( $vars );
			$det ['filename'] = $file->get_savepath () . $file->get_auto_filename ();
		}
		$act->addData ( 'application_detail', $det );
	}
}
function show($aid) {
	$act = new App ();
	$sql = 'select * from application_detail where app_id=' . $aid;
	// echo $sql.'--------------';
	$a = $act->getListBySql ( $sql );
	$obj = $a [0];
	if ($obj != '' || $obj != null) {
		$json = $act->toJsonDet ( $obj );
		echo $json;
	} else {
		echo '0';
	}
}
function update($det, $aid) { // 需要改
	$act = new App ();
	
	$sqlQuery = 'select * from application_detail where app_id=' . $aid;
	$result = $act->getListBySql ( $sqlQuery );
	
	if (count ( $result ) == '1') {
		if ($_FILES ['file'] ['error'] == 0) {
			$oldPath = SP_BASEPATH . $act->getPath ( $id );
			$time = time ();
			$y = date ( 'Y', $time );
			$m = date ( 'm', $time );
			$d = date ( 'd', $time );
			
			$savepath = 'upload/' . $y . '/' . $m . '/' . $d . '/'; // 获取新文件存储路
			$vars = array (
					'file' => 'file',
					'limit_size' => 50 * 1024 * 1024,
					'savepath' => $savepath,
					'rootpath' => SP_BASEPATH,
					'old_file' => $oldPath,
					'allowed_ext' => '' 
			);
			
			$file = new FILE ( $vars );
			$det ['filename'] = $file->get_savepath () . $file->get_auto_filename ();
		}
		$result = $act->updateData ( 'application_detail', $det, $result [0] ['id'] );
	} else {
		$det ['app_id'] = $aid;
		if (! ($_FILES ['file'] ['error'])) {
			$time = time ();
			$y = date ( 'Y', $time );
			$m = date ( 'm', $time );
			$d = date ( 'd', $time );
			
			$rootpath = SP_BASEPATH;
			$savepath = 'upload/' . $y . '/' . $m . '/' . $d . '/';
			
			$vars = array (
					'file' => 'file',
					'limit_size' => 50 * 1024 * 1024,
					'savepath' => $savepath,
					'rootpath' => $rootpath,
					'allowed_ext' => '' 
			);
			$file = new FILE ( $vars );
			$det ['filename'] = $file->get_savepath () . $file->get_auto_filename ();
		}
		$result = $act->addData ( 'application_detail', $det );
	}
	echo $result;
}
// ------------------------审核意见--------------------------
function addrecommend($rec, $aid) {
	$sql = 'update application_detail set checkAdvice = "' . $rec . '" where app_id=' . $aid;
	$act = new App ();
	$act->updateBySql ( $sql );
}

?>