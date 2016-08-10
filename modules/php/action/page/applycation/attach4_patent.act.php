<?php
/**
 author:LI ming
 date:2014-05-23
 */
include '../../../../../common/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';
include '../../class/applycation/attach4_patent.cls.php';

include '../../../../../common/php/plugin/fenci_v1.0_utf8/checkduplicate.cls.php';
 
$action = $_GET['action'];
$project_id = $_SESSION ['project_id'];
/**
 * Abstract
 */
$Abstract["project_id"]=$project_id;
$Abstract["project_summary"]=$_POST["project_summary"];
$Abstract["social_mean"]=$_POST["social_mean"];
$Abstract["advan_risks"]=$_POST["advan_risks"];
$Abstract["plan_target"]=$_POST["plan_target"];

/**
 * org_info
 */
$org_info['project_id']=$project_id;
$org_info['org_info']=$_POST['org_info'];
/**
 * tec_invalid_ana
 */
$techOrg['project_id']=$project_id;
$techOrg['basic_principle']=$_POST['basic_principle'];
$techOrg['foreign_patents']=$_POST['foreign_patents'];
$techOrg['coop_org']=$_POST['coop_org'];
/**
 * project_extent
 */
$project_extent["project_id"] =$project_id;
$project_extent["patent_tort"] =$_POST["patent_tort"];
$project_extent["results_ident"] =$_POST["results_ident"];
$project_extent["quality_stable"] =$_POST["quality_stable"];
/**
 * market_situation
 */
$market_situation['project_id']=$project_id;
$market_situation['domestic_market']=$_POST['domestic_market'];
$market_situation['international_market']=$_POST['international_market'];
/**
 * invest_analysis
 */
$invest_analy['project_id']=$project_id;
$invest_analy['invest_estimate']=$_POST['invest_estimate'];
$invest_analy['financing_scheme']=$_POST['financing_scheme'];
$invest_analy['invest_use_plan']=$_POST['invest_use_plan'];
/**
 * economy_profit
 */
$economy_profit['project_id']=$project_id;
$economy_profit['thing_estimate']=$_POST['thing_estimate'];
$economy_profit['financial_analysis']=$_POST['financial_analysis'];
$economy_profit['un_analy']=$_POST['un_analy'];
$economy_profit['finan_analy']=$_POST['finan_analy'];
$economy_profit['social_results']=$_POST['social_results'];
/**
 * project_effect
 */
$project_effect['project_id']=$project_id;
$project_effect['project_schedule']=$_POST["project_schedule"];

$apply = new APPLY ();
switch ($action) {
	case 'saveAbstract' :
		$apply->saveAbstract( $project_id,$Abstract );
		break;
	case 'find_Abstract' :
		$apply->find_Abstract($project_id,"");
		break;
	case 'save_orginfo' :
		$apply->save_orginfo( $project_id,$org_info );
		break;
	case 'find_org_info' :
		$apply->find_orginfo($project_id,"");
		break;
	case 'save_techOrg' :
		$apply->save_techOrg( $project_id,$techOrg );
		break;
	case 'find_techOrg' :
		$apply->find_techOrg($project_id,"");
		break;
	case 'save_extent' :
		$apply->save_extent( $project_id,$project_extent );
		break;
	case 'find_extent' :
		$apply->find_extent($project_id,"");
		break;
	case 'save_market' :
		$apply->save_market( $project_id,$market_situation );
		break;
	case 'find_market':
		$apply->find_market($project_id,"");
		break;
	case 'save_invest' :
		$apply->save_invest( $project_id,$invest_analy );
		break;
	case 'find_invest':
		$apply->find_invest($project_id,"");
		break;
	case 'save_economy' :
		$apply->save_economy( $project_id,$economy_profit );
		break;
	case 'find_economy':
		$apply->find_economy($project_id,"");
		break;
	case 'save_effect' :
		$apply->save_effect( $project_id,$project_effect );
		break;
	case 'find_effect':
		$apply->find_effect($project_id,"");
		break;
	default :
		;
}

?>