<?php
class APPLY {
	
	/**
	 * 附件2 合作单位基本情况
	 */
	function coorg2_info($coorg_info, $coorg_legal, $coorg_patent, $org_code, $coorg_code) {
		$db = new DB ();
		$db->Delete ( "delete from coorg_info where org_code='$org_code'  " );
		$result1 = $db->UpdateTabData2 ( 'coorg_info', $org_code, $coorg_info, 'org_code', $coorg_code, "coorg_code" );
		$result2 = $db->UpdateTabCoor ( 'legal_person', $coorg_code, $coorg_legal, 'org_code' );
		$result3 = $db->UpdateTabCoor ( 'intellectual_property', $coorg_code, $coorg_patent, 'org_code' );
		$db->Close ();
	}
	/**
	 * 附件2 单位基本情况
	 */
	function org2_info($org2_info, $project_id,$org2_legal, $org2_patent, $org2_staff, $org2_profit, $org_code,$linkmanInfo) {
		$db = new DB ();
		$result = $db->UpdateTabData ( 'project_info', $project_id, $linkmanInfo, 'project_id' );
		$result1 = $db->UpdateTabData ( 'org_info', $org_code, $org2_info, 'org_code' );
		$result2 = $db->UpdateTabData ( 'legal_person', $org_code, $org2_legal, 'org_code' );
		$result3 = $db->UpdateTabData ( 'intellectual_property', $org_code, $org2_patent, 'org_code' );
		$result4 = $db->UpdateTabData ( 'staff_info', $org_code, $org2_staff, 'org_code' );
		$result5 = $db->UpdateTabData ( 'profit_tax', $org_code, $org2_profit, 'org_code' );
	   
		$db->Close ();
	}
	
	/**
	 * 附件2 项目基本情况
	 */
	function project2_info($project_id, $tech_material, $project2_info, $project2_invest, $project_id) {
		$db = new DB ();
		$result1 = $db->UpdateTabData ( 'project_info', $project_id, $project2_info, 'project_id' );
		$result2 = $db->UpdateTabData ( 'project_invest', $project_id, $project2_invest, 'project_id' );
		$db->Delete ( "delete from  tech_material where  project_id= '$project_id' " );
		foreach ( $tech_material as $val ) {
			$db->InsertData ( "tech_material", $val );
		}
		$db->Close ();
	}
	
	/**
	 * 查询合作单位基本情况 附件2
	 */
	function find2OrgInfo($org_code,$project_id,$flag) {
		$db = new DB ();

		$res_org = $db->GetInfo1 ( $org_code, 'org_info', 'org_code' );
		$res_legal = $db->GetInfo1 ( $org_code, 'legal_person', 'org_code' );
		$res_patent = $db->GetInfo1 ( $org_code, 'intellectual_property', 'org_code' );
		$res_staff = $db->GetInfo1 ( $org_code, 'staff_info', 'org_code' );
		$res_profit = $db->GetInfo1 ( $org_code, 'profit_tax', 'org_code' );
		$project_info= $db->GetInfo1 ( $project_id, 'project_info', 'project_id' );
		 $login_info = $db->GetInfo1($_SESSION["user_id"], 'login_info', 'id');
		
	   $linkman=$project_info["linkman"];
          $linkman_contact=$project_info["linkman_contact"];
 	  $linkman_email=$project_info["linkman_email"];
         
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
				'org_name' => $res_org ['org_name'],
				'org_code' => $res_org ['org_code'],
				'register_fund' => $res_org ['register_fund'],
				'register_address' => $res_org ['register_address'],
				'org_type' => $res_org ['org_type'],
				'contact_address' => $res_org ['contact_address'],
				'postal' => $res_org ['postal'],
				'linkman' => $linkman,
				'linkman_email' =>$linkman_email,
				'linkman_contact' => $linkman_contact,
				'listed' => $res_org ['listed'],
				'listed_code' => $res_org ['listed_code'],
				'org_trade' => $res_org ['org_trade'],
				'main_product' => $res_org ['main_product'],
				
				'legal_name' => $res_legal ['legal_name'],
				'legal_id' => $res_legal ['legal_id'],
				'legal_phone' => $res_legal ['legal_phone'],
				
				'patent_num' => $res_patent ['patent_num'],
				'invent_patent' => $res_patent ['invent_patent'],
				'functional_patent' => $res_patent ['functional_patent'],
				'patent_design' => $res_patent ['patent_design'],
				'other_patent' => $res_patent ['other_patent'],
				
				'staff_num' => $res_staff ['staff_num'],
				'junior' => $res_staff ['junior'],
				'researcher_num' => $res_staff ['researcher_num'],
				
				'lasthalf_income' => $res_profit ['lasthalf_income'],
				'lasthalf_tax' => $res_profit ['lasthalf_tax'],
				'lasthalf_profit' => $res_profit ['lasthalf_profit'],
				'predict_tax' => $res_profit ['predict_tax'],
				'predict_inspectax' => $res_profit ['predict_inspectax'],
				'predict_profit' => $res_profit ['predict_profit'] 
		);
		if($flag=="pdf"){
			$db->Close();
			return $appJSON;
		}
		echo json_encode ( $appJSON );
		$db->Close ();
	}
	
	/**
	 * 合作单位基本情况 附件2;
	 */
	function find2CoorgInfo($org_code,$flag) {
		$db = new DB ();
		
		$sql = "select coorg_code from coorg_info where org_code='$org_code'";
		
		$res = $db->Select ( $sql );
		$coorg_code = $res [0] ['coorg_code'];

		$result = $db->GetInfo1 ( $coorg_code, 'coorg_info', 'coorg_code' );
		$result2 = $db->GetInfo1 ( $coorg_code, 'legal_person', 'org_code' );
		$result3 = $db->GetInfo1 ( $coorg_code, 'intellectual_property', 'org_code' );
		
		$appJSON = array (
				'coorg_name' => $result ['coorg_name'],
				'coorg_code' => $result ['coorg_code'],
				'register_fund' => $result ['register_fund'],
				'register_address' => $result ['register_address'],
				'org_type' => $result ['org_type'],
				'contact_address' => $result ['contact_address'],
				'postal' => $result ['postal'],
				'linkman' => $result ['linkman'],
				'linkman_email' => $result ['linkman_email'],
				'linkman_contact' => $result ['linkman_contact'],
				'coorg_summary' => $result ['coorg_summary'],
				
				'legal_name' => $result2 ['legal_name'],
				'legal_id' => $result2 ['legal_id'],
				'legal_phone' => $result2 ['legal_phone'],
				
				'patent_num' => $result3 ['patent_num'],
				'invent_patent' => $result3 ['invent_patent'],
				'functional_patent' => $result3 ['functional_patent'],
				'patent_design' => $result3 ['patent_design'],
				'other_patent' => $result3 ['other_patent'] 
		);
		if($flag=="pdf"){
			$db->Close();
			return $appJSON;
		}
		echo json_encode ( $appJSON );
		$db->Close ();
	}
	
	/**
	 * 项目基本情况 附件2;
	 */
	function find2ProInfo($project_id,$flag) {
		$db = new DB ();
		
		$re = $db->GetInfo1 ( $project_id, 'project_info', 'project_id' );
		$re1 = $db->GetInfo1 ( $project_id, 'project_invest', 'project_id' );
		
		$appJSON = array (
				'others_material'=> $re ['others_material'],
				'project_name' => $re ['project_name'],
				'project_place' => $re ['project_place'],
				'tech_area' => $re ['tech_area'],
				'tech_level' => $re ['tech_level'],
				'coproject_summary' => $re ['coproject_summary'],
				'tech_achieve' => $re ['tech_achieve'],
				'social_benefit' => $re ['social_benefit'],
				
				'invest_total' => $re1 ['invest_total'],
				'invested' => $re1 ['invested'],
				'fixed_invest' => $re1 ['fixed_invest'] 
				
		);
		if($flag=="pdf"){
			$db->Close();
			return $appJSON;
		}
		echo json_encode ( $appJSON );
		$db->Close ();
	}
}
?>