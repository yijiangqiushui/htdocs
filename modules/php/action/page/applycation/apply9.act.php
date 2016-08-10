<?php
/**
 author:wangyi
 date:2015-11-11
 */
include '../../../../../center/php/config.ini.php';
include '../../../../../common/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';
include '../../class/applycation/apply9.cls.php';

include '../../../../../common/php/plugin/fenci_v1.0_utf8/checkduplicate.cls.php';

$action = $_GET ['action'];
$project_id = $_SESSION ['project_id'];
$org_code = $_SESSION ['org_code'];

// 附件9 manager_team.html
$mngInfo ['project_id'] = $project_id;
$mngInfo ['total_area'] = $_POST ['hatch_total_area'];
$mngInfo ['office_area'] = $_POST ['work_total_area'];
$mngInfo ['hatch_area'] = $_POST ['hatch_house_area'];
$mngInfo ['public_area'] = $_POST ['public_service_area'];
$mngInfo ['avg_rent'] = $_POST ['rent_pay'];
$mngInfo ['manage_num'] = $_POST ['manager_total_num'];
$mngInfo ['doctor_num'] = $_POST ['doctor_num'];
$mngInfo ['master_num'] = $_POST ['master_num'];
$mngInfo ['college_num'] = $_POST ['graduate_num'];
$mngInfo ['junior_num'] = $_POST ['associate_num'];
$mngInfo ['doctor_ratio'] = $_POST ['doctor_ratio'];
$mngInfo ['master_ratio'] = $_POST ['master_ratio'];
$mngInfo ['college_ratio'] = $_POST ['graduate_ratio'];
$mngInfo ['junior_ratio'] = $_POST ['associate_ratio'];

// 附件9 org_info.html（对应2个表）
$orgInfo9 ['org_code'] = $org_code;
$orgInfo9 ['org_name'] = $_POST ['org_name'];
$orgInfo9 ['org_type'] = $_POST ['org_type'];
$orgInfo9 ['investment'] = $_POST['investment'];
$orgInfo9 ['service_type'] = $_POST['service_type'];
$orgInfo9 ['org_address'] = $_POST ['org_address'];
/*$orgInfo9 ['linkman'] = $_POST ['linkman'];
$orgInfo9 ['linkman_contact'] = $_POST ['linkman_contact'];*/

$linkmanInfo["linkman"]= $_POST ['linkman'];
$linkmanInfo["linkman_phone"]= $_POST ['phone'];
$linkmanInfo["linkman_contact"]= $_POST ['telephone'];
$linkmanInfo["linkman_fax"]= $_POST ['fax'];

$orgInfo9 ['manager'] = $_POST ['manager'];
// $orgInfo9 ['fax'] = $_POST ['fax'];
// $orgInfo9 ['phone'] = $_POST ['phone'];
$orgInfo9 ['website'] = $_POST ['website'];
$orgInfo9 ['email'] = $_POST ['email'];
$orgInfo9 ['register_address'] = $_POST ['register_address'];
$orgInfo9 ['register_time'] = $_POST ['register_time'];
$orgInfo9 ['register_fund'] = $_POST ['register_fund'];
$orgInfo9 ['asset_total'] = $_POST ['total_fund'];
//新加的，
$orgInfo9 ['ismake'] = $_POST ['ismake'];
$orgInfo9 ['maked_name'] = $_POST ['maked_name'];


$orgInfo9Legal ['org_code'] = $org_code;
$orgInfo9Legal ['legal_name'] = $_POST ['legal_person'];
$orgInfo9Legal ['legal_phone'] = $_POST ['legal_tel'];

// 附件9 hatch.html
$hatch ['project_id'] = $project_id;
$hatch ['finish_com_num'] = $_POST ['Finish_Com_num'];
$hatch ['acquire_num'] = $_POST ['Acquire_num'];
$hatch ['list_num'] = $_POST ['List'];
$hatch ['tec_product_num'] = $_POST ['Tec_product_num'];
$hatch ['overseas'] = $_POST ['Overseas'];
$hatch ['qr_genious_num'] = $_POST ['Qr_Genious_num'];
$hatch ['mainboard'] = $_POST ['Mainboard'];
$hatch ['hj_num'] = $_POST ['Hj_num'];
$hatch ['mid_num'] = $_POST ['Mid_num'];
$hatch ['gj_num'] = $_POST ['Gj_num'];
$hatch ['risk_inv_num'] = $_POST ['Risk_inv_num'];
$hatch ['risk_inv_sum'] = $_POST ['Risk_inv_sum'];
$hatch ['high_sal_num'] = $_POST ['High_sal_num'];
$hatch ['zgc_tech_num'] = $_POST ['Zgc_tech_num'];
$hatch ['settle_com_num'] = $_POST ['Settle_com_num'];
$hatch ['hatch_com_num'] = $_POST ['Hatch_com_num'];
$hatch ['overseas_enter_nums'] = $_POST ['Overseas_enter_nums'];
$hatch ['settle_com_profit'] = $_POST ['Settle_com_profit'];
$hatch ['settle_com_tax'] = $_POST ['Settle_com_tax'];
$hatch ['overthousand_com_num'] = $_POST ['Overthousand_com_num'];
$hatch ['com_know_num'] = $_POST ['Com_know_num'];
$hatch ['position_num'] = $_POST ['Position_num'];
$hatch ['research_fund'] = $_POST ['Research_fund'];
$hatch ['research_num'] = $_POST ['Research_num'];
$hatch ['finance_num'] = $_POST ['Finance_num'];
$hatch ['finance_limit'] = $_POST ['Finance_limit'];

// 附件9  后五個
$special['project_id']=$project_id;
$special['special']=$_POST['special'];

$running['project_id']=$project_id;
$running['running']=$_POST['running'];

$influence_name = (array)$_POST['name'];
$influence_time = (array)$_POST['time'];
$influence_place = (array)$_POST['place'];
$influence_theme = (array)$_POST['theme'];
$influence_effect = (array)$_POST['effect'];

$influence_array = array();
for($count=0 ; $count<count($influence_name) ; $count++){
	$influence[$count]['org_code'] = $org_code;
	$influence[$count]['name'] = $influence_name[$count];
	$influence[$count]['time'] = $influence_time[$count];
	$influence[$count]['place'] = $influence_place[$count];
	$influence[$count]['theme'] = $influence_theme[$count];
	$influence[$count]['effect'] = $influence_effect[$count];
}
//var_dump($influence);


$service_job['project_id']=$project_id;
$service_job['service_job']=$_POST['service_job'];

$abstract['project_id']=$project_id;
$abstract['abstract']=$_POST['abstract'];

// 附件10  后4個
$sp['project_id']=$project_id;
$sp['special']=$_POST['special'];

$service_thing['project_id']=$project_id;
$service_thing['service_thing']=$_POST['service_thing'];


$ser_job['project_id']=$project_id;
$ser_job['service_job']=$_POST['service_job'];

$abst['project_id']=$project_id;
$abst['abstract']=$_POST['abstract'];



// 附件9 manage_state.html
$manageState1 = ( array ) $_POST ['sum_income'];
$manageState2 = ( array ) $_POST ['house_income'];
$manageState3 = ( array ) $_POST ['propert_income'];
$manageState4 = ( array ) $_POST ['invest_income'];
$manageState5 = ( array ) $_POST ['public_income'];
$manageState6 = ( array ) $_POST ['plat_invest'];
$manageState7 = ( array ) $_POST ['profit'];
$manageState8 = ( array ) $_POST ['hand_tax'];
$manageState9 = ( array ) $_POST ['seed_total_fund'];
$manageState10 = ( array ) $_POST ['seed_invest_fund'];
$manageState11 = ( array ) $_POST ['hatch_com_num'];
$manageState12 = ( array ) $_POST ['public_service_fund'];
$manageState13 = ( array ) $_POST ['public_service_sum'];
$year = ( array ) $_POST ['the_year'];
$manageState = array ();
$length = 0;
foreach ( $manageState1 as $val ) {
	// 加上年份
	$manageState [$length] ['the_year'] = $year [$length];
	$manageState [$length] ['total_income'] = $manageState1 [$length];
	$manageState [$length] ['rent_income'] = $manageState2 [$length];
	$manageState [$length] ['property_income'] = $manageState3 [$length];
	$manageState [$length] ['invest_income'] = $manageState4 [$length];
	$manageState [$length] ['public_tec_income'] = $manageState5 [$length];
	$manageState [$length] ['other_income'] = $manageState6 [$length];
	$manageState [$length] ['profit'] = $manageState7 [$length];
	$manageState [$length] ['hand_tax'] = $manageState8 [$length];
	$manageState [$length] ['seed_total_fund'] = $manageState9 [$length];
	$manageState [$length] ['seed_inve_sum'] = $manageState10 [$length];
	$manageState [$length] ['hatch_com_num'] = $manageState11 [$length];
	$manageState [$length] ['public_inve_sum'] = $manageState12 [$length];
	$manageState [$length] ['public_service_income'] = $manageState13 [$length];
	$manageState [$length] ['project_id'] = $project_id;
	$length = $length + 1;
}

// 动态列表获取值
$shareholder_name = ( array ) $_POST ['shareholder_name'];
$stock_ratio = ( array ) $_POST ['stock_ratio'];

$shareholder_info = array ();
$length = 0;
// foreach($stock_ratio as $key=>$value){
foreach ( $shareholder_name as $val ) {
	$shareholder_info [$length] ['org_code'] = $org_code;
	$shareholder_info [$length] ['shareholder_name'] = $shareholder_name [$length];
	$shareholder_info [$length] ['stock_ratio'] = $stock_ratio [$length];
	$length = $length + 1;
}

$apply = new APPLY ();
switch ($action) {
/* 2016/1/4 新加入表單 */
    case '9special' :
        $apply->special ( $project_id, $special );
        break;
    case '9running' :
        $apply->special ( $project_id, $running );
        break;
    case '9influence' :
        $apply->influence ($org_code, $influence );
        break;
    case '9service_job' :
        $apply->special ( $project_id, $service_job );
        break;
    case '9abstract' :
        $apply->special ( $project_id, $abstract );
        break;
    case '10special' :
        $apply->attach10 ( $project_id, $sp );
        break;
    case '10service_thing' :
        $apply->attach10 ( $project_id, $service_thing );
        break;
    case '10service_job' :
        $apply->attach10 ( $project_id, $ser_job );
        break;
    case '10abstract' :
        $apply->attach10 ( $project_id, $abst );
        break;
        
        
        
/* 2016/1/4 以上為新加入表單 */
    case '9hatchFm' :
        $apply->hatch ( $project_id, $hatch );
        break;
    case '9managerTeam' :
		$apply->manager_team9 ( $mngInfo, $project_id );
		break;
	case '9orgInfo' :
		$apply->org_info9 ( $org_code, $orgInfo9, $orgInfo9Legal, $shareholder_info,$linkmanInfo,$project_id );
		break;
	case 'manage9_state' :
		$apply->manage_state ( $project_id, $manageState );
		break;
	case '9findHatchFm' :
		$apply->find_hatch ( $project_id ,"");
		break;
		case '9findspecial' :
	    $apply->find_special ( $project_id ,"");
		break;
	case '9findinfluence' :
	    $apply->find_influence ( $project_id ,"");
		break;
	case '9findservice_job' :
		$apply->find_service_job ( $project_id ,"");
		break;
	case '9findabstract' :
		$apply->find_abstract ( $project_id ,"");
		break;
	case '9findrunning' :
		$apply->find_running ( $project_id ,"");
		break;
		                    
	case '9findManagerTeam' :
		$apply->find_manager_team ( $project_id,"" );
		break;
	case '9findOrgInfo' :
		$apply->findorg_info9 ( $org_code ,$project_id,"");
		break;
	case '9findManageState' :
		$apply->findman_state ( $project_id,"");
		break;
		
		
		/* attach10的textarea回寫 */
	case '10findabstract' :
		$apply->find_ab ( $project_id ,"");
		break;		
    case '10findsp' :
		$apply->find_sp ( $project_id ,"");
	    break;
	case '10findservice_thing' :
		$apply->find_service_thing ( $project_id ,"");
	    break;
    case '10findservice_job' :
	    $apply->find_ser_job ( $project_id ,"");
	    break;
		
		
}

?>
