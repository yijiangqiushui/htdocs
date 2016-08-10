<?php
	include '../../../../../center/php/config.ini.php';
	include '../../../../../common/php/config.ini.php';
	include '../../../../../common/php/lib/db.cls.php';
	include '../../class/applycation/apply5.cls.php';
	
	include '../../../../../common/php/plugin/fenci_v1.0_utf8/checkduplicate.cls.php';
	
	$action = $_GET['action'];
	$page = $_POST['page'];
	$rows = $_POST['rows'];
	
	$project_id = $_SESSION['project_id'];
	 //$project_id = '012';
	$org_code = $_SESSION['org_code'];
	$username = $_SESSION['username'];
	// $org_code = '012';
	
	/* org_info 附件5 */
	$org5_info['org_code'] = $org_code;
	$org5_info['org_name'] = $_POST['org_name'];
	$org5_info['register_fund'] = $_POST['register_fund'];
	$org5_info['register_address'] = $_POST['register_address'];
	$org5_info['org_type'] = $_POST['org_type'];
	$org5_info['contact_address'] = $_POST['contact_address'];
	$org5_info['postal'] = $_POST['postal'];
/* 	$org5_info['linkman'] = $_POST['linkman'];
	$org5_info['linkman_email'] = $_POST['linkman_email'];
	$org5_info['linkman_contact'] = $_POST['linkman_contact']; */
	$org5_info['org_trade'] = $_POST['org_trade'];
	$org5_info['main_product'] = $_POST['main_product'];
	$org5_info['research_content'] = $_POST['research_content'];
	
	$org5_logininfo['org_code'] = $org_code;
/* 	$org5_logininfo['linkman'] = $_POST['linkman'];
	$org5_logininfo['linkman_email'] = $_POST['linkman_email'];
	$org5_logininfo['linkman_contact'] = $_POST['linkman_contact']; */
	$linkmanInfo["linkman"]= $_POST ['linkman'];
	$linkmanInfo["linkman_email"]= $_POST ['linkman_email'];
	$linkmanInfo["linkman_contact"]= $_POST ['linkman_contact'];
	
	$org5_legal['org_code'] = $org_code;
	$org5_legal['legal_name'] = $_POST['legal_name'];
	$org5_legal['legal_id'] = $_POST['legal_id'];
	$org5_legal['legal_phone'] = $_POST['legal_phone'];
	
	$aptitude_name['org_code'] = $org_code;
	$aptitude_name['project_id'] = $_POST['project_id'];
	$aptitude_name['approve_org'] = $_POST['approve_org'];
	$aptitude_name['name'] = $_POST['name'];
	$aptitude_name['validity'] = $_POST['validity'];
	$aptitude_name['aptitude_code'] = $_POST['aptitude_code'];
	
	$org5_patent['org_code'] = $org_code;
	$org5_patent['patent_num'] = $_POST['patent_num'];
	$org5_patent['invent_patent'] = $_POST['invent_patent'];
	$org5_patent['functional_patent'] = $_POST['functional_patent'];
	$org5_patent['patent_design'] = $_POST['patent_design'];
	$org5_patent['other_patent'] = $_POST['other_patent'];
	
	$org5_staff['org_code'] = $org_code;
	$org5_staff['staff_num'] = $_POST['staff_num'];
	$org5_staff['junior'] = $_POST['junior'];
	$org5_staff['researcher_num'] = $_POST['researcher_num'];
	
	$org5_profit['org_code'] = $org_code;
	$org5_profit['lasthalf_income'] = $_POST['lasthalf_income'];
	$org5_profit['lasthalf_tax'] = $_POST['lasthalf_tax'];
	$org5_profit['lasthalf_profit'] = $_POST['lasthalf_profit'];
	
	$org5_profit['predict_income'] = $_POST['predict_income'];
	$org5_profit['predict_tax'] = $_POST['predict_tax'];
	$org5_profit['predict_profit'] = $_POST['predict_profit'];

	$apply = new APPLY();
	switch ($action) {
		case 'org5Info':
	        $apply->org5_info($org5_info, $aptitude_name, $org5_legal, $org5_patent, $org5_staff, $org5_profit, $org_code,$linkmanInfo,$project_id);
	        break;
        case 'find5OrgInfo':
        	$apply->find5OrgInfo($org_code,$project_id);
//         	 print("$apply"); 
        	break;
		default:
			;
	}
?>