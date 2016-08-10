<?php
	include '../../../../../center/php/config.ini.php';
	include '../../../../../common/php/config.ini.php';
	include '../../../../../common/php/lib/db.cls.php';
	include '../../class/applycation/apply4.cls.php';
	
	include '../../../../../common/php/plugin/fenci_v1.0_utf8/checkduplicate.cls.php';
	
	$action = $_GET['action'];
	$page = $_POST['page'];
	$rows = $_POST['rows'];
	
	$project_id = $_SESSION['project_id'];
	//$project_id = '012';
	$org_code = $_SESSION['org_code'];
	//$org_code = '012';
	
	/* org_info   附件4*/
	$org_info4['org_code'] = $org_code;
	$org_info4['register_fund'] = $_POST['register_fund'];
	$org_info4['register_address'] = $_POST['register_address'];
	$org_info4['contact_address'] = $_POST['contact_address'];
	$org_info4['org_type'] = $_POST['org_type'];
	$org_info4['postal'] = $_POST['postal'];
/* 	$org_info4['linkman'] = $_POST['linkman'];
	$org_info4['linkman_email'] = $_POST['linkman_email'];
	$org_info4['linkman_contact'] = $_POST['linkman_contact']; */
	$org_info4['org_name'] = $_POST['org_name'];
	$org_info4['org_name'] = $_POST['postal'];
	
	
	$linkmanInfo["linkman"]= $_POST ['linkman'];
	$linkmanInfo["linkman_email"]= $_POST ['linkman_email'];
	$linkmanInfo["linkman_contact"]= $_POST ['linkman_contact'];
	
	
	$legal4['org_code'] = $org_code;
	$legal4['legal_name'] = $_POST['legal_name'];
	$legal4['legal_id'] = $_POST['legal_id'];
	$legal4['legal_phone'] = $_POST['legal_phone'];
	
	
	/* project_info  附件4 */
	$pro_info4['project_id'] = $project_id;
	$pro_info4['project_name'] = $_POST['project_name'];
	$pro_info4['department'] = $_POST['department'];
	$pro_info4['project_fund'] = $_POST['project_fund'];
	$pro_info4['support_way'] = $_POST['support_way'];
	$pro_info4['support_fund'] = $_POST['support_fund'];
	$pro_info4['allocate_time'] = $_POST['allocate_time'];
	$pro_info4['property_name'] = $_POST['property_name'];
	$pro_info4['project_main'] = $_POST['project_main'];
	$pro_info4['start_time'] = $_POST['start_time'];
	$pro_info4['end_time'] = $_POST['end_time'];

	
	$pro_org4['org_code'] = $org_code;
	$pro_org4['company_summary'] = $_POST['company_summary'];//这个是不是没有字段，。
	
	$modify_apply['project_id'] = $project_id;
	$modify_apply['start_end'] = strtotime($pro_info4['start_time'].'~'.$pro_info4['end_time']);
	
	$apply = new APPLY();
	switch ($action) {
		case 'org4Info':
	        $apply->org4_info($legal4, $org_info4, $org_code,$linkmanInfo,$project_id);
	        break;
   	 	case 'pro4Info':
	        $apply->pro4_info($pro_info4,$project_id, $pro_org4,$modify_apply, $org_code);
	        break;
        case 'find4OrgInfo':
        	$apply->find4OrgInfo($org_code,$project_id);
        	break;
        case 'find4ProInfo':
        	$apply->find4ProInfo($project_id,$org_code);
        	break;
		default:;
	}
?>