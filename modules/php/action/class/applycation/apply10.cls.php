<?php

/**
 author:黎明
 date:2015-11-11
 */
class APPLY {
	/**
	 * 附件10单位基本情况
	 */
	function org_info10($org10_info, $shareholder_info, $org_code,$linkmanInfo,$project_id ){
		$db = new DB ();
// 		print_r($shareholder_info);
// 		print_r($org10_info);
		$result= $db->updateInfo4 ( 'project_info', 'project_id',$project_id, $linkmanInfo  );
		$result1 = $db->updateInfo4 ( 'org_info', 'org_code',$org_code, $org10_info  );
		$result3 = $db->Delete ( "delete from shareholder_info  where org_code = '$org_code' " );
		foreach ( $shareholder_info as $tem ) {
			$result2 = $db->InsertData ( 'shareholder_info', $tem );
		}
		$db->Close ();
	}
	/**
	 * service_team_info
	 */
	function service_team_info($service_team_info, $project_id) {
		$db = new DB ();	
		$result1 = $db->UpdateTabData ( "team_form", $project_id, $service_team_info, 'project_id' );
	
		$db->Close ();
	}
	function find_ser_job($project_id,$flag) {
	    $db = new DB ();
	    $res1 = $db->GetInfo1 ( $project_id, 'support_scitec', 'project_id' );
	    $appJSON = array (
	        'service_job' => $res1 ['service_job']
	    );
	    if($flag=="pdf"){
	        $db->Close ();
	        return $appJSON;
	    }else{
	        echo json_encode ( $appJSON );
	    }
	    $db->Close ();
	}
	
	function find_ab($project_id,$flag) {
	    $db = new DB ();
	    $res1 = $db->GetInfo1 ( $project_id, 'support_scitec', 'project_id' );
	    $appJSON = array (
	        'abstract' => $res1 ['abstract']
	    );
	    if($flag=="pdf"){
	        $db->Close ();
	        return $appJSON;
	    }else{
	        echo json_encode ( $appJSON );
	    }
	    $db->Close ();
	}
	/**
	 * 10manager_info
	 */
	function manager_info($manager_info, $org_code) {
		$db = new DB ();
		
		foreach ( $manager_info as $tem ) {
// 			print_r($tem);
			$result1 = $db->UpdateTabData2 ( 'run_status', $org_code, $tem, 'project_id', $tem ['the_year'], "the_year" );
		}
		$db->Close ();
	}
	// 回显表单10orginfo的内容
	function find10orgInfo($org_code,$project_id,$flag) {
		$db = new DB ();
		// 参数分别是： 主键值 数据库表明 主键名
		$result = $db->GetInfo1 ( $org_code, 'org_info', 'org_code' );
		$res2 = $db->GetInfo1 ( $org_code, 'legal_person', 'org_code' );
		// $result2 = $db->GetInfo1($org_code, 'shareholder_info', 'org_code');如果不是动态加载 就把结果从这里传过去 如果是那就在html页面直接加载
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
		
		$appJSON = array (
				'org_name' => $result ['org_name'],
				'org_type' => $result ['org_type'],
				
				'service_type' => $result ['service_type'],
				'org_address' => $result ['org_address'],
				'org_leader' => $result ['org_leader'],
				'leader_contact' => $result ['leader_contact'],
				'linkman' => $linkman,
				'manager' => $result ['manager'],
				'linkman_contact' => $linkman_contact,
				'phone' => $result ['phone'],
				'website' => $result ['website'],
				'email' => $result ['email'],
				'register_address' => $result ['register_address'],
				'register_time' => $result ['register_time'],
				'register_fund' => $result ['register_fund'],
				'asset_total' => $result ['asset_total'],
				'fax' => $result ['fax'] ,
				'investment' => $result ['investment'],
		        'legal_person' => $res2 ['legal_name'],
		        'legal_tel' => $res2 ['legal_phone'],
				'business_id'=> $res5 ['business_id'] 
		);
         if($flag=="pdf"){
         	$db->Close();
         	return $appJSON;
         }
		echo json_encode ( $appJSON );
		$db->close ();
	}
	// 回显表单10service_team的内容
	function find10service_team($project_id,$flag) {
		$db = new DB ();
		// 参数分别是： 主键值 数据库表明 主键名
		$result = $db->GetInfo1 ( $project_id, 'team_form', 'project_id' );
		$appJSON = array (
				'manage_num' => $result ['manage_num'],
				'service_num' => $result ['service_num'],
				'doctor_num' => $result ['doctor_num'],
				'doctor_ratio' => $result ['doctor_ratio'],
				'master_num' => $result ['master_num'],
				'master_ratio' => $result ['master_ratio'],
				'college_num' => $result ['college_num'],
				'college_ratio' => $result ['college_ratio'],
				'junior_num' => $result ['junior_num'],
				'junior_ratio' => $result ['junior_ratio'] 
		);
		if($flag=="pdf"){
			$db->Close();
			return $appJSON;
		}
		echo json_encode ( $appJSON );
		$db->close ();
	}
	function find10manager_fm($org_code,$flag) {
		$db = new DB ();
		// 参数分别是： 主键值 数据库表明 主键名
		// 得到当前年
		$the_year = date ( "Y" );
		$result1 = $result = $db->GetInfo2 ( $org_code, "run_status", "project_id", $the_year+2, "the_year" );
		$result2 = $result = $db->GetInfo2 ( $org_code, "run_status", "project_id", $the_year+1, "the_year" );
		$result3 = $result = $db->GetInfo2 ( $org_code, "run_status", "project_id", $the_year, "the_year" );
		
		$appJSON = array (
				'the_year[0]' => $result1 ['the_year'],
				'the_year[1]' => $result2 ['the_year'],
				'the_year[2]' => $result3 ['the_year'],
				'total_income[0]' => $result1 ['total_income'],
				'total_income[1]' => $result2 ['total_income'],
				'total_income[2]' => $result3 ['total_income'],
				'prof_tech[0]' => $result1 ['prof_tech'],
				'prof_tech[1]' => $result2 ['prof_tech'],
				'prof_tech[2]' => $result3 ['prof_tech'],
				'other_income[0]' => $result1 ['other_income'],
				'other_income[1]' => $result2 ['other_income'],
				'other_income[2]' => $result3 ['other_income'],
				'profit[0]' => $result1 ['profit'],
				'profit[1]' => $result2 ['profit'],
				'profit[2]' => $result3 ['profit'],
				'hand_tax[0]' => $result1 ['hand_tax'],
				'hand_tax[1]' => $result2 ['hand_tax'],
				'hand_tax[2]' => $result3 ['hand_tax'],
				'public_inve_sum[0]' => $result1 ['public_inve_sum'],
				'public_inve_sum[1]' => $result2 ['public_inve_sum'],
				'public_inve_sum[2]' => $result3 ['public_inve_sum'],
				'public_service_income[0]' => $result1 ['public_service_income'],
				'public_service_income[1]' => $result2 ['public_service_income'],
				'public_service_income[2]' => $result3 ['public_service_income'] ,
				'the_year[0]' => '2016',
				'the_year[1]' => '2017',
				'the_year[2]' => '2018'
		);
		if($flag=="pdf"){
			$db->Close();
			return $appJSON;
		}
		echo json_encode ( $appJSON );
		$db->close ();
	}
	
	
	function find_service_thing($project_id,$flag) {
	    $db = new DB ();
	    $res1 = $db->GetInfo1 ( $project_id, 'support_scitec', 'project_id' );
	    $appJSON = array (
	        'service_thing' => $res1 ['service_thing']
	    );
	    if($flag=="pdf"){
	        $db->Close ();
	        return $appJSON;
	    }else{
	        echo json_encode ( $appJSON );
	    }
	    $db->Close ();
	}
	
	
	function find_sp($project_id,$flag) {
	    $db = new DB ();
	    $res1 = $db->GetInfo1 ( $project_id, 'support_scitec', 'project_id' );
	    $appJSON = array (
	        'special' => $res1 ['special']
	    );
	    if($flag=="pdf"){
	        $db->Close ();
	        return $appJSON;
	    }else{
	        echo json_encode ( $appJSON );
	    }
	    $db->Close ();
	}
	
	
}

?>