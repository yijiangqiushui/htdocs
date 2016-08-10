<?php
/**
 author:mach
 date:2015-11-17
 */

include '../../class/projectapp/projectapp.cls.php';
include '../../../../../center/php/config.ini.php';
include '../../../../../common/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';
include '../../class/applycation/apply.cls.php';

include '../../../../../common/php/plugin/fenci_v1.0_utf8/checkduplicate.cls.php';


$action = $_GET['action'];
$page = $_POST['page'];
$rows = $_POST['rows'];

// project_id and org_id
// $project_id = $_SESSION['project_id'];
$project_id = '132';
// $org_code = $_SESSION['org_code'];
$org_code = '01234567';

/* check_material */
$check_material['project_id'] = $check_material;
$check_material['factory_area'] = $_POST['factory_area'];
$check_material['factory_sum'] = $_POST['factory_sum'];
$check_material['rebuild_area'] = $_POST['rebuild_area'];
$check_material['rebuild_sum'] = $_POST['rebuild_sum'];

/* equipment_list 列表 
$equipment_list['project_id'] = $equipment_list;
$equipment_list['equipment_name'] = $_POST['equipment_name'];
$equipment_list['equipment_num'] = $_POST['equipment_num'];
$equipment_list['equipment_price'] = $_POST['equipment_price'];
$equipment_list['equipment_fund'] = $_POST['equipment_fund'];
 */
$equipment_name = (array) $_POST['equipment_name'];
$equipment_num = (array) $_POST['equipment_num'];
$equipment_price = (array) $_POST['equipment_price'];
$equipment_fund = (array) $_POST['equipment_fund'];
$length = 0;
foreach ( $equipment_name as $val ) {
    $equipment_list [$length] ['project_id'] = $project_id;
    $equipment_list [$length] ['equipment_name'] = $equipment_name [$length];
    $equipment_list [$length] ['equipment_num'] = $equipment_num [$length];
    $equipment_list [$length] ['equipment_price'] = $equipment_price [$length];
    $equipment_list [$length] ['equipment_fund'] = $equipment_fund [$length];
    $length = $length + 1;
}
/*
 instrument_list 
$instrument_list['project_id'] = $instrument_list;
$instrument_list['test_name'] = $_POST['test_name'];
$instrument_list['test_num'] = $_POST['test_num'];
$instrument_list['test_price'] = $_POST['test_price'];
$instrument_list['test_fund'] = $_POST['test_fund'];
*/
$test_name = (array) $_POST['test_name'];
$test_num = (array) $_POST['test_num'];
$test_price = (array) $_POST['test_price'];
$test_fund = (array) $_POST['test_fund'];
$length = 0;
foreach ( $test_name as $val ) {
    $instrument_list [$length] ['project_id'] = $project_id;
    $instrument_list [$length] ['test_name'] = $test_name [$length];
    $instrument_list [$length] ['test_num'] = $test_num [$length];
    $instrument_list [$length] ['test_price'] = $test_price [$length];
    $instrument_list [$length] ['test_fund'] = $test_fund [$length];
    $length = $length + 1;
}
$apply=new APPLY();
 switch($action){   
	case'unit_provement';
	$apply->unit_provement($project_id,$check_material,$instrument_list,$equipment_list);
	break;
	
 }


?>