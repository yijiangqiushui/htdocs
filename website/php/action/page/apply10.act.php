<?php
// heyangyang
include '../class/app.cls.php';
include '../../../../common/php/lib/file.cls.php';

$id = $_GET ['id'];
$flag = $_GET ['flag'];
$page = $_POST ['page'];
$rows = $_POST ['rows'];

$act = new App ();
if ($flag != '0') {
	$id = ($id !== 0) ? intval ( $id ) : $_SESSION ['app_id'];
	$sql = 'SELECT * FROM attach_proof WHERE app_id=' . $id . ' ORDER BY pro';
	$sql_cou = 'select count(id) as "count" from attach_proof where app_id=' . $id;
	$cou = $act->getCount ( $sql_cou );
	
	$arr = $act->getListByCon ( $page, $rows, $cou, $sql );
	$json = $act->toJsonAtt ( $arr, $cou );
	$json = str_replace ( 'proof1', '知识产权证明', $json );
	$json = str_replace ( 'proof2', '主要技术评价证明', $json );
	$json = str_replace ( 'proof3', '产品技术标准', $json );
	$json = str_replace ( 'proof4', '产品检测报告证明', $json );
	$json = str_replace ( 'proof5', '国家法律法规要求的行业审批文件', $json );
	$json = str_replace ( 'proof6', '应用证明', $json );
	$json = str_replace ( 'proof7', '其他证明', $json );
} else {
	if ($_SESSION ['app_proof'] != null && $_SESSION ['app_proof'] != '') {
		$sql = 'SELECT * FROM attach_proof WHERE app_id=' . $_SESSION ['app_id'] . ' ORDER BY pro';
		$sql_cou = 'select count(id) as "count" from attach_proof where app_id=' . $_SESSION ['app_id'];
		$cou = $act->getCount ( $sql_cou );
		
		$arr = $act->getListByCon ( $page, $rows, $cou, $sql );
		$json = $act->toJsonAtt ( $arr, $cou );
		$json = str_replace ( 'proof1', '知识产权证明', $json );
		$json = str_replace ( 'proof2', '主要技术评价证明', $json );
		$json = str_replace ( 'proof3', '产品技术标准', $json );
		$json = str_replace ( 'proof4', '产品检测报告证明', $json );
		$json = str_replace ( 'proof5', '国家法律法规要求的行业审批文件', $json );
		$json = str_replace ( 'proof6', '应用证明', $json );
		$json = str_replace ( 'proof7', '其他证明', $json );
	} else {
		$json = '{"total":0,"rows":[]}';
	}
}
echo $json;
?>