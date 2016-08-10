<?php
include '../../../../../common/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';
include '../../../../../modules/php/action/class/lmcheck_material/check_material.cls.php';
include '../../../../../common/php/plugin/fenci_v1.0_utf8/checkduplicate.cls.php';
include '../../../../../modules/php/action/class/projectapp/util.cls.php';
include __DIR__ . '/../../../../../extends/common/common.php';

$action = $_GET ['action'];
$name = $_GET ['name'];

$project_id = $_SESSION ['project_id'];
$org_code = $_SESSION ['org_code'];

/**
 * util_info
 */
// 项目负责人
$project_principal ['project_id'] = $project_id;
$project_principal ['leader_name'] = $_POST ['leader_name'];
$project_principal ['leader_job'] = $_POST ['leader_job'];
$project_principal ['tech_pos'] = $_POST ['tech_pos'];
// 专利
$shareholder_name = ( array ) $_POST ["shareholder_name"];
$stock_ratio = ( array ) $_POST ["stock_ratio"];
$shareholder_info = array ();
$count = 0;
foreach ( $shareholder_name as $val ) {
	$shareholder_info [$count] ["project_id"] = $project_id;
	$shareholder_info [$count] ["patent_name"] = $shareholder_name [$count];
	$shareholder_info [$count] ["patent_code"] = $stock_ratio [$count];
	$shareholder_info [$count] ["is_new"] =0;
	$count ++;
}
// 产品执行标准
$check_material ["project_id"] = $project_id;
$check_material ["product_standard"] = $_POST ["product_standard"];
$check_material ["identify_date"] = strtotime ( $_POST ["identify_date"] );
$check_material ["host_org"] = $_POST ["host_org"];
//项目名称
$project_name["project_id"]=$project_id;
$project_name["project_name"]=$_POST["project_name"];

//产品获奖情况
$award_name=(array)$_POST["award_name"];
$award_dep=(array)$_POST["award_dep"];
$award_level=(array)$_POST["award_level"];
$count=0;
$produce_award = array();
foreach ($award_dep  as $val ){
	$produce_award[$count]['project_id']=$project_id;
	$produce_award[$count]['award_name']=$award_name[$count];
	$produce_award[$count]['award_dep']=$award_dep[$count];
	$produce_award[$count]['award_level']=$award_level[$count];
	$count++;}

/**
 * org_info
 */
// org_info
$org_info ["org_code"] = $org_code;
$org_info ["register_address"] = $_POST ["register_address"];
/*
 * $org_info["linkman"]=$_POST["linkman"];
 * $org_info["phone"]=$_POST["phone"];
 */

$linkmanInfo ["linkman"] = $_POST ["linkman"];
$linkmanInfo ["linkman_contact"] = $_POST ["phone"];
// staff_info
$staff_info ["org_code"] = $org_code;
$staff_info ["staff_num"] = $_POST ["staff_num"];
$staff_info ["middel_pos"] = $_POST ["middel_pos"];
// profit_tax
$profit_tax ["org_code"] = $org_code;
$profit_tax ["year_income"] = $_POST ["year_income"];
$profit_tax ["year_profit"] = $_POST ["year_profit"];
$profit_tax ["year_tax"] = $_POST ["year_tax"];
$projectapp = new ProjectApp ();
/**
 * authent
 */
$authent ["quality_approve"] = $_POST ["quality_approve"];
$authent ["project_id"] = $project_id;
/**
 * spread
 */
// $company_scale
$receiver = ( array ) $_POST ["receiver"];
$company_scale = ( array ) $_POST ["company_scale"];
$count = 0;
$tech_transfer = array ();
foreach ( $receiver as $val ) {
	$tech_transfer [$count] ["project_id"] = $project_id;
	$tech_transfer [$count] ["receiver"] = $receiver [$count];
	$tech_transfer [$count] ["company_scale"] = $company_scale [$count];
	$count ++;
}
// $co_construct
$partner_name = ( array ) $_POST ["partner_name"];
$company_scale_t = ( array ) $_POST ["company_scale1"];
$count = 0;
$co_construct = array ();
foreach ( $receiver as $val ) {
	$co_construct [$count] ["project_id"] = $project_id;
	$co_construct [$count] ["partner_name"] = $partner_name [$count];
	$co_construct [$count] ["company_scale"] = $company_scale_t [$count];
	$count ++;
}
$market_open ["market_open"] = $_POST ["market_open"];
$market_open ["project_id"] = $project_id;

/**
 * develop
 */
$patent_name = ( array ) $_POST ["patent_name"];
$patent_type = ( array ) $_POST ["patent_type"];
$patent_state = ( array ) $_POST ["patent_state"];
$count = 0;
$patent_list = array ();
foreach ( $patent_name as $val ) {
	$patent_list [$count] ["project_id"] = $project_id;
	$patent_list [$count] ["patent_name"] = $patent_name [$count];
	$patent_list [$count] ["patent_type"] = $patent_type [$count];
	$patent_list [$count] ["patent_state"] = $patent_state [$count];
	$patent_list [$count] ["is_new"] =1;
	$count ++;
}

$produce_name = ( array ) $_POST ["produce_name"];
$produce_level = ( array ) $_POST ["produce_level"];
$count = 0;
$produce = array ();
foreach ( $produce_name as $val ) {
	$produce [$count] ["project_id"] = $project_id;
	$produce [$count] ["produce_name"] = $produce_name [$count];
	$produce [$count] ["produce_level"] = $produce_level [$count];
	$count ++;
}
/**
 * takent_
 */
$talent ["project_id"] = $project_id;
$talent ["tec_num"] = $_POST ["tec_num"];
$talent ["tec_hour"] = $_POST ["tec_hour"];
$talent ["manage_num"] = $_POST ["manage_num"];
$talent ["manage_hour"] = $_POST ["manage_hour"];
$talent ["total_class"] = $_POST ["total_class"];
$talent ["total_person"] = $_POST ["total_person"];
/**
 * improve
 */
$equipment_name = ( array ) $_POST ["equipment_name"];
$equipment_num = ( array ) $_POST ["equipment_num"];
$equipment_price = ( array ) $_POST ["equipment_price"];
$equipment_fund = ( array ) $_POST ["equipment_fund"];
$count = 0;
$equipment_list = array ();
foreach ( $equipment_name as $val ) {
	$equipment_list [$count] ["project_id"] = $project_id;
	$equipment_list [$count] ["equipment_name"] = $equipment_name [$count];
	$equipment_list [$count] ["equipment_num"] = $equipment_num [$count];
	$equipment_list [$count] ["equipment_price"] = $equipment_price [$count];
	$equipment_list [$count] ["equipment_fund"] = $equipment_fund [$count];
	$count ++;
}

$test_name = ( array ) $_POST ["test_name"];
$test_num = ( array ) $_POST ["test_num"];
$test_price = ( array ) $_POST ["test_price"];
$test_fund = ( array ) $_POST ["test_fund"];
$count = 0;
$instrument_list = array ();
foreach ( $test_name as $val ) {
	$instrument_list [$count] ["project_id"] = $project_id;
	$instrument_list [$count] ["test_name"] = $test_name [$count];
	$instrument_list [$count] ["test_num"] = $test_num [$count];
	$instrument_list [$count] ["test_price"] = $test_price [$count];
	$instrument_list [$count] ["test_fund"] = $test_fund [$count];
	$count ++;
}

$improve ["project_id"] = $project_id;
$improve ["factory_area"] = $_POST ["factory_area"];
$improve ["factory_sum"] = $_POST ["factory_sum"];
$improve ["rebuild_area"] = $_POST ["rebuild_area"];
$improve ["rebuild_sum"] = $_POST ["rebuild_sum"];

/*
 * unit_opinion
 */
$save_unit_opinion ["project_id"] = $project_id;
$save_unit_opinion ["org_suggest"] = $_POST ["org_suggest"];
/*
 * final_opinion
 */
$save_final_opinion ["project_id"] = $project_id;
$save_final_opinion ["final_opinion"] = $_POST ["final_opinion"];
/*
 * index_complete
 */

$index_complete ["project_id"] = $project_id;
$index_complete ["expectation_target_year"] = $_POST ["expectation_target_year"];
$index_complete ["expectation_target_icome"] = $_POST ["expectation_target_icome"];
$index_complete ["expectation_target_profit"] = $_POST ["expectation_target_profit"];
$index_complete ["expectation_target_tax"] = $_POST ["expectation_target_tax"];
$index_complete ["expectation_target_earning"] = $_POST ["expectation_target_earning"];
$index_complete ["previous_year_year"] = $_POST ["previous_year_year"];
$index_complete ["previous_year_icome"] = $_POST ["previous_year_icome"];
$index_complete ["previous_year_profit"] = $_POST ["previous_year_profit"];
$index_complete ["previous_year_tax"] = $_POST ["previous_year_tax"];
$index_complete ["previous_year_earning"] = $_POST ["previous_year_earning"];
$index_complete ["after_year_year"] = $_POST ["after_year_year"];
$index_complete ["after_year_icome"] = $_POST ["after_year_icome"];
$index_complete ["after_year_profit"] = $_POST ["after_year_profit"];
$index_complete ["after_year_tax"] = $_POST ["after_year_tax"];
$index_complete ["after_year_earning"] = $_POST ["after_year_earning"];
switch ($action) {
 	 case 'save_unit_info':
        $projectapp->save_unit_info($org_code,$project_id, $project_principal,$shareholder_info,$check_material,$produce_award,$project_name);
        break;
	 case 'save_org_info':
        $projectapp->save_org_info($org_code,$org_info,$staff_info,$profit_tax,$linkmanInfo,$project_id);
        break;
	 case 'save_authent':
        $projectapp->save_authent($project_id,$authent);
        break;
	 case 'save_spread':
        $projectapp->save_spread($project_id,$tech_transfer,$co_construct,$market_open);
        break;
	 case 'save_develop':
        $projectapp->save_develop($project_id,$patent_list,$produce);
        break;
	 case 'save_talent_training':
        $projectapp->save_talent_training($project_id,$talent);
        break;
	 case 'save_improve':
        $projectapp->save_improve($project_id,$equipment_list,$instrument_list,$improve);
        break;
	 case 'save_unit_opinion':
        $projectapp->save_unit_opinion($project_id,$save_unit_opinion);
        break;
	 case 'save_final_opinion':
        $projectapp->save_final_opinion($project_id,$save_final_opinion);
        break;
	 case 'save_index_complete':
        $projectapp->save_index_complete($project_id,$index_complete);
        break;
	 case 'find_unit_info':
	 	$projectapp->find_unit_info($project_id,"");
	 	break;
	 case 'find_authent':
	 	$projectapp->find_authent($project_id,"");
	 	break;
	 case 'find_org_info':
	 	$projectapp->find_org_info($org_code,$project_id,"");
	 	break;
	 case 'find_spread':
	 	$projectapp->find_spread($project_id,"");
	 	break;
	 case 'find_talent_training':
	 	$projectapp->find_talent_training($project_id,"");
	 	break;
	 case 'find_improve':
	 	$projectapp->find_improve($project_id,"");
	 	break;
	 case 'find_unit_opinion':
	 	$projectapp->find_unit_opinion($project_id,"");
	 	break;
	 case 'find_final_opinion':
	 	$projectapp->find_final_opinion($project_id,"");
	 	break;
	 case 'find_index_complete':
	 	$projectapp->find_index_complete($project_id,"");
	 	break;
/* =======	case 'save_unit_info' :
		$projectapp->save_unit_info ( $org_code, $project_id, $project_principal, $shareholder_info, $check_material, $produce_award );
		break;
	case 'save_org_info' :
		$projectapp->save_org_info ( $org_code, $org_info, $staff_info, $profit_tax, $linkmanInfo, $project_id );
		break;
	case 'save_authent' :
		$projectapp->save_authent ( $project_id, $authent );
		break;
	case 'save_spread' :
		$projectapp->save_spread ( $project_id, $tech_transfer, $co_construct, $market_open );
		break;
	case 'save_develop' :
		$projectapp->save_develop ( $project_id, $patent_list, $produce );
		break;
	case 'save_talent_training' :
		$projectapp->save_talent_training ( $project_id, $talent );
		break;
	case 'save_improve' :
		$projectapp->save_improve ( $project_id, $equipment_list, $instrument_list, $improve );
		break;
	case 'save_unit_opinion' :
		$projectapp->save_unit_opinion ( $project_id, $save_unit_opinion );
		break;
	case 'save_final_opinion' :
		$projectapp->save_final_opinion ( $project_id, $save_final_opinion );
		break;
	case 'save_index_complete' :
		$projectapp->save_index_complete ( $project_id, $index_complete );
		break;
	case 'find_unit_info' :
		$projectapp->find_unit_info ( $project_id, "" );
		break;
	case 'find_authent' :
		$projectapp->find_authent ( $project_id, "" );
		break;
	case 'find_org_info' :
		$projectapp->find_org_info ( $org_code, $project_id, "" );
		break;
	case 'find_spread' :
		$projectapp->find_spread ( $project_id, "" );
		break;
	case 'find_talent_training' :
		$projectapp->find_talent_training ( $project_id, "" );
		break;
	case 'find_improve' :
		$projectapp->find_improve ( $project_id, "" );
		break;
	case 'find_unit_opinion' :
		$projectapp->find_unit_opinion ( $project_id, "" );
		break;
	case 'find_final_opinion' :
		$projectapp->find_final_opinion ( $project_id, "" );
		break;
	case 'find_index_complete' :
		$projectapp->find_index_complete ( $project_id, "" );
		break;
>>>>>>> .theirs */
}
?>