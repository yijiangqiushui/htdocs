<?php
/**
 author:Gao Xue
 date:2014-05-23
 */
include '../../../../../common/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';
include '../../class/applycation/apply10.cls.php';

include '../../../../../common/php/plugin/fenci_v1.0_utf8/checkduplicate.cls.php';

$action = $_GET ['action'];   
$page = $_POST ['page'];
$rows = $_POST ['rows'];

// 申请单位基本信息
// project_id and org_id
$project_id = $_SESSION['project_id']; 
$org_code = $_SESSION['org_code'];  

/* 10org_info 附件10 */
// org_info表
$org10_info ['org_code'] = $org_code;
$org10_info ['org_name'] = $_POST ['org_name'];
$org10_info ['org_type'] = $_POST ['org_type'];
$org10_info ['investment'] = $_POST ['investment'];
$org10_info ['service_type'] = $_POST ['service_type'];
$org10_info ['org_address'] = $_POST ['org_address'];
$org10_info ['manager'] = $_POST ['manager'];
$org10_info ['leader_contact'] = $_POST ['leader_contact'];
/* $org10_info ['linkman'] = $_POST ['linkman'];
$org10_info ['linkman_contact'] = $_POST ['linkman_contact']; */
$org10_info ['fax'] = $_POST ['fax'];
$org10_info ['phone'] = $_POST ['phone'];
$org10_info ['website'] = $_POST ['website'];
$org10_info ['email'] = $_POST ['email'];
$org10_info ['register_address'] = $_POST ['register_address'];
$org10_info ['register_time'] = $_POST ['register_time'];
$org10_info ['register_fund'] = $_POST ['register_fund'];
$org10_info ['asset_total'] = $_POST ['asset_total'];
$org10_info ['service_type'] = $_POST ['service_type'];

$linkmanInfo["linkman"]= $_POST ['linkman'];
$linkmanInfo["linkman_contact"]= $_POST ['linkman_contact'];

$shareholder_name = ( array ) $_POST ['shareholder_name'];
$stock_ratio = ( array ) $_POST ['stock_ratio'];
$length = 0;
while ( list ( $key, $val ) = each ( $shareholder_name ) ) {
	$shareholder_info [$length] ['org_code'] = $org_code;
	$shareholder_info [$length] ['shareholder_name'] = $shareholder_name [$key];
	$shareholder_info [$length] ['stock_ratio'] = $stock_ratio [$key];
	$length = $length + 1;
}

/* service_team 数据库的名字是team_form */
$service_team_info ['project_id'] = $project_id;
$service_team_info ['manage_num'] = $_POST ['manage_num'];

$service_team_info ['service_num'] = $_POST ['service_num'];
$service_team_info ['doctor_num'] = $_POST ['doctor_num'];
$service_team_info ['doctor_ratio'] = $_POST ['doctor_ratio'];
$service_team_info ['master_num'] = $_POST ['master_num'];
$service_team_info ['master_ratio'] = $_POST ['master_ratio'];
$service_team_info ['college_num'] = $_POST ['college_num'];
$service_team_info ['college_ratio'] = $_POST ['college_ratio'];
$service_team_info ['junior_num'] = $_POST ['junior_num'];
$service_team_info ['junior_ratio'] = $_POST ['junior_ratio'];

/* manager.html 数据库的名字是run_status */
$the_year = (array) $_POST ['the_year']; 
$total_income =(array)  $_POST ['total_income'];
$prof_tech = (array) $_POST ['prof_tech'];
$other_income = (array) $_POST ['other_income'];
$profit = (array) $_POST ['profit'];
$hand_tax = (array) $_POST ['hand_tax'];
$public_inve_sum = (array) $_POST ['public_inve_sum'];
$public_service_income = (array) $_POST ['public_service_income'];


$length = 0;
foreach ( $the_year as $val ) {
	$manager_info [$length] ['project_id'] = $org_code;
	$manager_info [$length] ['the_year'] = $the_year [$length];
	$manager_info [$length] ['total_income'] = $total_income [$length];
	$manager_info [$length] ['prof_tech'] = $prof_tech [$length];
	$manager_info [$length] ['other_income'] = $other_income [$length];
	$manager_info [$length] ['profit'] = $profit [$length];
	$manager_info [$length] ['hand_tax'] = $hand_tax [$length];
	$manager_info [$length] ['public_inve_sum'] = $public_inve_sum [$length];
	$manager_info [$length] ['public_service_income'] = $public_service_income [$length];
	$length ++;
}




$apply = new APPLY ();
switch ($action) {
	case '10orgInfo' :
		$apply->org_info10 ( $org10_info, $shareholder_info, $org_code,$linkmanInfo,$project_id );
		break;
	case '10service_team' :
		$apply->service_team_info ( $service_team_info, $project_id );
		break;
	case '10manager_fm' :
		$apply->manager_info ( $manager_info, $org_code );
		break;
	case 'find10orgInfo' : // 自动加载数据（回显）
		$apply->find10orgInfo ( $org_code,$project_id,"" );
		break;
	case 'find10service_team' : // 自动加载数据（回显）
		$apply->find10service_team ( $project_id,"" );
		break;
	case 'find10manager_fm' : // 自动加载数据（回显）
		$apply->find10manager_fm ($org_code ,"");
		break;
	default :
		;
}

?>