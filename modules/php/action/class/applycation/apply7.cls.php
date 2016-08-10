<?php
class APPLY {
	function org_info7($project_id,$project_info,$org_code, $arrData1, $staff_info, $arrData2, $arrData3, $arrData4,$linkmanInfo,$project_id) {
		$db = new DB ();
		$result = $db->UpdateTabData('project_info', $project_id, $linkmanInfo, 'project_id');
		$db->UpdateTabData ( 'org_info', $org_code, $arrData1, 'org_code' );
		$db->UpdateTabData ( 'legal_person', $org_code, $arrData2, 'org_code' );
		$db->UpdateTabData ( 'intellectual_property', $org_code, $arrData3, 'org_code' );
		$db->UpdateTabData ( 'profit_tax', $org_code, $arrData4, 'org_code' );
		$db->UpdateTabData ( "staff_info", $org_code, $staff_info, "org_code" );
		$db->UpdateTabData ( "project_info", $project_id, $project_info, "project_id" );
		$db->Close ();
	}
	
	
	function find_org_info7_pdf($org_code,$project_id) {
	    $db = new DB ();
	    $res1 = $db->GetInfo1 ( $org_code, 'org_info', 'org_code' );
	    $res2 = $db->GetInfo1 ( $org_code, 'legal_person', 'org_code' );
	    $res3 = $db->GetInfo1 ( $org_code, 'intellectual_property', 'org_code' );
	    $res4 = $db->GetInfo1 ( $org_code, 'profit_tax', 'org_code' );
	    $res5 = $db->GetInfo1 ( $org_code, 'staff_info', 'org_code' );
	    $res6 = $db->GetInfo1 ( $project_id, 'project_info', 'project_id' );
	    $appJSON = array (
	        'app_com_name' => $res1 ['org_name'],
	        'app_com_code' => $res1 ['org_code'],
	        'app_com_fund' => $res1 ['register_fund'],
	        'com_reg_add' => $res1 ['register_address'],
	        'com_type' => $res1 ['org_type'],
	        'com_com_add' => $res1 ['contact_address'],
	        'com_post' => $res1 ['postal'],
	        'linkman' => $res1 ['linkman'],
	        'linkman_email' => $res1 ['linkman_email'],
	        'linkman_contact' => $res1 ['linkman_contact'],
	        'last_contractNum' => $res1 ['last_contractNum'],
	        'listed' => $res1 ['listed'],
	        'listed_code' => $res1 ['listed_code'],
	        'last_contractPrice' => $res1 ['last_contractPrice'],
	        'predict_contractNum' => $res1 ['predict_contractNum'],
	        'predict_contractPrice' => $res1 ['predict_contractPrice'],
	        'com_is_public' => $res1 ['listed'],
	        'com_public_cdkey' => $res1 ['listed_code'],
	        'org_trade' => $res1 ['org_trade'],
	        'main_product' => $res1 ['main_product'],
	        'com_legal_name' => $res2 ['legal_name'],
	        'com_legal_ID' => $res2 ['legal_id'],
	        'com_legal_tel' => $res2 ['legal_phone'],
	        'patent_num' => $res3 ['patent_num'],
	        'patent_invent' => $res3 ['invent_patent'],
	        'patent_new' => $res3 ['functional_patent'],
	        'patent_design' => $res3 ['patent_design'],
	        'other_patent_num' => $res3 ['other_patent'],
	        'first_income' => $res4 ['lastmarket_income'],
	        'first_tax' => $res4 ['last_tax'],
	        'first_profit' => $res4 ['last_profit'],
	        'predict_income' => $res4 ['predict_income'],
	        'predict_tax' => $res4 ['predict_tax'],
	        'expect_profit' => $res4 ['predict_profit'],
	        'staff_num' => $res5 ['staff_num'],
	        'junior' => $res5 ['junior'],
	        'researcher_num' => $res5 ['researcher_num'] ,
	        'project_summary' => $res6 ['project_summary'] ,
	    	'business_id'=> $res6 ['business_id'] ,
	
	    );
	    return $appJSON;
	}
	
	
	
	
	function find_org_info7($org_code,$project_id) {
		$db = new DB ();
		$res1 = $db->GetInfo1 ( $org_code, 'org_info', 'org_code' );
		$res2 = $db->GetInfo1 ( $org_code, 'legal_person', 'org_code' );
		$res3 = $db->GetInfo1 ( $org_code, 'intellectual_property', 'org_code' );
		$res4 = $db->GetInfo1 ( $org_code, 'profit_tax', 'org_code' );
		$res5 = $db->GetInfo1 ( $org_code, 'staff_info', 'org_code' );
		$res6 = $db->GetInfo1 ( $project_id, 'project_info', 'project_id' );
		

		$login_info = $db->GetInfo1($_SESSION["user_id"], 'login_info', 'id');
		
		$linkman=$res6["linkman"];
		$linkman_contact=$res6["linkman_contact"];
		$linkman_email=$res6["linkman_email"];
		 
		if($linkman==null||$linkman==""){
			$linkman=$login_info["realname"];
		}
		 
		if($linkman_contact==null||$linkman_contact==""){
			$linkman_contact=$login_info["celphone"];
		}
		
		if($linkman_email==null||$linkman_email==""){
			$linkman_email=$login_info["email"];
		}
		$appJSON = array (
				'app_com_name' => $res1 ['org_name'],
				'app_com_code' => $res1 ['org_code'],
				'app_com_fund' => $res1 ['register_fund'],
				'com_reg_add' => $res1 ['register_address'],
				'com_type' => $res1 ['org_type'],
				'com_com_add' => $res1 ['contact_address'],
				'com_post' => $res1 ['postal'],
			'linkman'=>$linkman,
					'linkman_email'=>$linkman_email,
					'linkman_contact'=>$linkman_contact,
				'last_contractNum' => $res1 ['last_contractNum'],
				'listed' => $res1 ['listed'],
				'listed_code' => $res1 ['listed_code'],
				'last_contractPrice' => $res1 ['last_contractPrice'],
				'predict_contractNum' => $res1 ['predict_contractNum'],
				'predict_contractPrice' => $res1 ['predict_contractPrice'],
				'com_is_public' => $res1 ['listed'],
				'com_public_cdkey' => $res1 ['listed_code'],
				'org_trade' => $res1 ['org_trade'],
				'main_product' => $res1 ['main_product'],
				'com_legal_name' => $res2 ['legal_name'],
				'com_legal_ID' => $res2 ['legal_id'],
				'com_legal_tel' => $res2 ['legal_phone'],
				'patent_num' => $res3 ['patent_num'],
				'patent_invent' => $res3 ['invent_patent'],
				'patent_new' => $res3 ['functional_patent'],
				'patent_design' => $res3 ['patent_design'],
				'other_patent_num' => $res3 ['other_patent'],
				'first_income' => $res4 ['lastmarket_income'],
				'first_tax' => $res4 ['last_tax'],
				'first_profit' => $res4 ['last_profit'],
				'predict_income' => $res4 ['predict_income'],
				'predict_tax' => $res4 ['predict_tax'],
				'expect_profit' => $res4 ['predict_profit'],
				'staff_num' => $res5 ['staff_num'],
				'junior' => $res5 ['junior'],
				'researcher_num' => $res5 ['researcher_num'] ,
				'project_summary' => $res6 ['project_summary'] ,
				
		);
		
		$sql = "SELECT table_status FROM table_status WHERE project_id = '$project_id' and table_name ='通州区支持技术输出能力提升项目申报书'";
		$result = $db->Select($sql);
		

		if($result[0]['table_status']==1 || $result[0]['table_status']==3) {
		    $appJSON ['save_display'] = 1;
		    	
		    	
		} else {
		    $appJSON ['save_display'] = 0;
		}
		
		
		echo json_encode ( $appJSON );
		$db->Close ();
	}
	
function   findProjectInfo($project_id,$org_code){
 	$db = new DB();
 	$result = $db->GetInfo1($project_id, 'project_info', 'project_id');
 	$result2 = $db->GetInfo1($org_code, 'org_info', 'org_code');
 	$ret=array(
 			"project_name"=>$result["project_name"],
 			"org_name"=>$result2["org_name"],
 			
 	);
 	return $ret;
 }
}
?>