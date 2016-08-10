<?php
class ProjectApp {
	function save_unit_info($org_code,$project_id, $project_principal, $shareholder_info, $check_material, $produce_award,$project_name) {
		$db = new DB ();
		$db->updateInfo4 ( "project_info", "project_id", $project_id, $project_name );
		// $project_principal
		$db->updateInfo4 ( "project_principal", "project_id", $project_id, $project_principal );
		// $shareholder_info
		$db->Delete ( "delete  from patent_list where project_id = '$project_id' and  is_new = 0 "  );
		foreach ( $shareholder_info as $tem ) {
			$db->InsertData ( "patent_list", $tem );
		}
		// $check_material
		$db->updateInfo4 ( "check_material", "project_id", $project_id, $check_material );
		// $produce_award
		$db->Delete ( "delete  from produce_award where project_id = '$project_id'" );
		foreach ( $produce_award as $tem ) {
			$db->InsertData ( "produce_award", $tem );
		}
		$db->Close ();
	}
	function find_unit_info($project_id,$flag) {
		$db = new DB ();
		$project_info = $db->GetInfo1 ( $project_id, "project_info", "project_id" );
		$project_principal = $db->GetInfo1 ( $project_id, "project_principal", "project_id" );
		$check_material = $db->GetInfo1 ( $project_id, "check_material", "project_id" );
		$retArray = array (
				"project_name" => $project_info ["project_name"],
				"leader_name" => $project_principal ["leader_name"],
				"leader_job" => $project_principal ["leader_job"],
				"tech_pos" => $project_principal ["tech_pos"],
				"product_standard" => $check_material ["product_standard"],
				"identify_date" =>$check_material ["identify_date"] ==null?"": date ( "Y-m-d", ( float ) $check_material ["identify_date"] ),
				"host_org" => $check_material ["host_org"] 
		);
		if($flag=="pdf"){
			$db->Close();
			return $retArray;
		}
		echo json_encode ( $retArray );
	}
	function save_org_info($org_code, $org_info, $staff_info, $profit_tax,$linkmanInfo,$project_id) {
		$db = new DB ();
		print_r($linkmanInfo);
		$db->updateInfo4 ( "project_info", "project_id", $project_id, $linkmanInfo );
		$db->updateInfo4 ( "org_info", "org_code", $org_code, $org_info );
		$db->updateInfo4 ( "staff_info", "org_code", $org_code, $staff_info );
		$db->updateInfo4 ( "profit_tax", "org_code", $org_code, $profit_tax );
		
		$db->Close ();
	}
	function find_org_info($org_code,$project_id,$flag) {
		$db = new DB ();
		$org_info = $db->GetInfo1 ( $org_code, "org_info", "org_code" );
		$linkman = $db->GetInfo1 ( $org_code, "login_info", "org_code" );
		$staff_info = $db->GetInfo1 ( $org_code, "staff_info", "org_code" );
		$profit_tax = $db->GetInfo1 ( $org_code, "profit_tax", "org_code" );
		$result5 = $db->GetInfo1 ( $project_id, 'project_info', 'project_id' );
		$login_info = $db->GetInfo1($_SESSION["user_id"], 'login_info', 'id');
		$linkman=$result5["linkman"];  
		$linkman_contact=$result5["linkman_contact"];
		
		if($linkman==null||$linkman==""){
			$linkman=$login_info["realname"];
		}
		if($linkman_contact==null||$linkman_contact==""){
			$linkman_contact=$login_info["celphone"];
		}
			
		$resArray = array (
				"register_address" => $org_info ["register_address"],
				"linkman" => $linkman,
				"phone" =>$linkman_contact,
				"staff_num" => $staff_info ["staff_num"],
				"middel_pos" => $staff_info ["middel_pos"],
				"year_income" => $profit_tax ["year_income"],
				"year_profit" => $profit_tax ["year_profit"],
				"year_tax" => $profit_tax ["year_tax"] 
		);
		if($flag=="pdf"){
			$db->Close();
			return $resArray;
		}
		echo json_encode ( $resArray );
	}
	function save_authent($project_id, $authent) {
		$db=new DB();
		$db->updateInfo4("check_material", "project_id", $project_id, $authent);
		$db->Close();
	}

	function find_authent($project_id,$flag){
		$db=new DB();
		$authent=$db->GetInfo1($project_id, "check_material", "project_id");
		$resArray=array(
			"quality_approve"	=>$authent["quality_approve"]
		);
		if($flag=="pdf"){
			$db->Close();
			return $resArray;
		}
		echo json_encode ( $resArray );
		$db->Close();
	}
	function save_spread($project_id,$tech_transfer,$co_construct,$market_open){
		$db=new DB();
		//check_material
		$db->updateInfo4("check_material", "project_id", $project_id, $market_open);
		//$tech_transfer
		$db->Delete("delete from tech_transfer where project_id='$project_id'");
		foreach ($tech_transfer as $tem){
			$db->InsertData("tech_transfer", $tem);
		}
		//$co_construct
		$db->Delete("delete from co_construct where project_id='$project_id'");
		foreach ($co_construct as $tem){
			$db->InsertData("co_construct", $tem);
		}
		$db->Close();
		
	}
	function find_spread($project_id,$flag){
		$db=new DB();
		$market_open=$db->GetInfo1($project_id, "check_material", "project_id");
		$res=array(
			"market_open"=>$market_open["market_open"]	
		);
		if($flag=="pdf"){
			$db->Close();
			return $res;
		}
		echo json_encode ( $res );
		$db->Close();
	}
	function save_develop($project_id,$patent_list,$produce){
		$db=new DB();
		$db->Delete("delete from patent_list where  project_id ='$project_id' and  is_new = 1  ");
		foreach ($patent_list as $val){
			$db->InsertData("patent_list", $val);
		}
		$db->Delete("delete from produce where  project_id ='$project_id' ");
		foreach ($produce as $val){
			$db->InsertData("produce", $val);
		}
		$db->Close();
	}
	function save_talent_training($project_id,$talent){
		$db=new DB();
		$db->updateInfo4("check_material", "project_id", $project_id, $talent);
		$db->Close();
	}
	function  find_talent_training($project_id,$flag){
		$db=new DB();
		$talent =$db->GetInfo1($project_id, "check_material", "project_id");
		$res=array(
			"tec_num"=>	$talent["tec_num"],
			"tec_hour"=>	$talent["tec_hour"],
			"manage_num"=>	$talent["manage_num"],
			"manage_hour"=>	$talent["manage_hour"],
			"total_class"=>	$talent["total_class"],
			"total_person"=>$talent["total_person"]
		);
		if($flag=="pdf"){
			$db->Close();
			return $res;
		}
		echo json_encode($res);
		$db->Close();
	}
	function save_improve($project_id,$equipment_list,$instrument_list,$improve){
		$db=new DB();
		//$equipment_list
		$db->Delete("delete from equipment_list where project_id ='$project_id'");
		foreach ($equipment_list as $tem){
			$db->InsertData("equipment_list", $tem);
		}
		//$instrument_list
		$db->Delete("delete from instrument_list where project_id ='$project_id'");
		foreach ($instrument_list as $tem){
			$db->InsertData("instrument_list", $tem);
		}
		//$improve
		$db->updateInfo4("check_material", "project_id", $project_id, $improve);
		$db->Close();
		
		
	}
	function find_improve($project_id,$flag){
			$db=new DB();
		$talent =$db->GetInfo1($project_id, "check_material", "project_id");
		$res=array(
			"factory_area"=>	$talent["factory_area"],
			"factory_sum"=>	$talent["factory_sum"],
			"rebuild_area"=>	$talent["rebuild_area"],
			"rebuild_sum"=>	$talent["rebuild_sum"]
		);
		if($flag=="pdf"){
			$db->Close();
			return $res;
		}
		echo json_encode($res);
		$db->Close();
	}
	function save_unit_opinion($project_id,$save_unit_opinion){
		
		$db=new DB();
		//unit_opinion
		$db->updateInfo4("check_material", "project_id", $project_id, $save_unit_opinion);
		$db->Close();
	}
	function find_unit_opinion($project_id,$flag){
		$db=new DB();
		$talent =$db->GetInfo1($project_id, "check_material", "project_id");
		$res=array(
				"org_suggest"=>	$talent["org_suggest"]
		);
		if($flag=="pdf"){
			$db->Close();
			return $res;
		}
		echo json_encode($res);
		$db->Close();
	}
	
	function save_final_opinion($project_id,$save_final_opinion){
		$db=new DB();
		//unit_opinion
		$db->updateInfo4("check_material", "project_id", $project_id, $save_final_opinion);
		$db->Close();
		
	}
	
	function find_final_opinion($project_id,$flag){
		$db=new DB();
		$talent =$db->GetInfo1($project_id, "check_material", "project_id");
		$res=array(
				"final_opinion"=>	$talent["final_opinion"]
		);
		if($flag=="pdf"){
			$db->Close();
			return $res;
		}
		echo json_encode($res);
		$db->Close();
	}
	function save_index_complete($project_id,$index_co){
		$db=new DB();
		$db->updateInfo4("project_assessment", "project_id", $project_id, $index_co);
		$db->Close();
	}
	function find_index_complete($project_id,$flag){
		$db=new DB();
		$res=$db->GetInfo1($project_id, "project_assessment", "project_id");
		$resArray=array(
		"expectation_target_year"=>$res["expectation_target_year"],
		"expectation_target_icome"=>$res["expectation_target_icome"],
		"expectation_target_profit"=>$res["expectation_target_profit"],
		"expectation_target_tax"=>$res["expectation_target_tax"],
		"expectation_target_earning"=>$res["expectation_target_earning"],
		"previous_year_year"=>$res["previous_year_year"],
		"previous_year_icome"=>$res["previous_year_icome"],
		"previous_year_profit"=>$res["previous_year_profit"],
		"previous_year_tax"=>$res["previous_year_tax"],
		"previous_year_earning"=>$res["previous_year_earning"],
		"after_year_year"=>$res["after_year_year"],
		"after_year_icome"=>$res["after_year_icome"],
		"after_year_profit"=>$res["after_year_profit"],
		"after_year_tax"=>$res["after_year_tax"],
		"after_year_earning"=>$res["after_year_earning"]
		);
		if($flag=="pdf"){
			$db->Close();
			return $resArray;
		}
		echo json_encode($resArray);
		$db->Close();
	}
	function find_project_time($project_id){
	    $db=new DB();
	    $res=$db->GetInfo1($project_id, "project_info", "project_id");
	    $resArray=array(
	        "project_name"=>$res['project_name']
	        
	    );
	    $db->Close();
	    return $resArray;
	    
	}
	function findother_info($project_id){
		$db=new DB();
		$res=$db->GetInfo1($project_id, 'project_info', 'project_id');
		$arrjson=array(
			"business_id"=>$res["business_id"]
		);
		$db->Close();
		return $arrjson;
	}
	function findOrg_info($org_code){
		$db=new DB();
		$res=$db->GetInfo1($org_code, 'org_info', 'org_code');
		$arrjson=array(
			"org_name"=>$res["org_name"]
		);
		$db->Close();
		return $arrjson;
	}

}

?>