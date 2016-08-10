<?php

if(!class_exists("util")){
	include '../../../../../modules/php/action/class/projectapp/util.cls.php';
}

class APPLY {
	/*
	 * 附件9中org_info.html的 数据入库
	 */
	function org_info9($org_code, $arrData1, $arrData2, $arrData3,$linkmanInfo,$project_id) {
		$db = new DB ();

		$result = $db->UpdateTabData('project_info', $project_id, $linkmanInfo, 'project_id');

		$sql = "delete from shareholder_info where org_code = '$org_code' ";
		$db->Delete ( $sql );
		foreach ( $arrData3 as $tmp ) {
			$result = $db->InsertData ( 'shareholder_info', $tmp );
		}
		
		$db->UpdateTabData ( 'org_info', $org_code, $arrData1, 'org_code' );
		$db->UpdateTabData ( 'legal_person', $org_code, $arrData2, 'org_code' );
		/*
		 * foreach ($arrData3 as $tmp){
		 * $result = $db -> InsertData('shareholder_info',$tmp);
		 * }
		 */
		$db->Close ();
	}
	
	/*
	 * 附件9 manager_team.html
	 *
	 */
	function manager_team9($arrData, $project_id) {
		$db = new DB ();
		$db->UpdateTabData ( 'hatch_team', $project_id, $arrData, 'project_id' );
		$db->Close ();
	}
	
	/*
	 * 附件9中hatch.html的 数据入库
	 */
	function hatch($project_id, $arrData1) {
		$db = new DB ();
		$db->UpdateTabData ( 'hatch_result', $project_id, $arrData1, 'project_id' );
		$db->Close ();
	}
	
	function special($project_id, $arrData1) {
	    $db = new DB ();
	    $db -> UpdateTabCoor('incubator', $project_id, $arrData1, 'project_id');
	    $db->Close ();
	}
	function influence($org_code, $arrData1) {
		$db = new DB ();
		$sql ="DELETE FROM influ_event WHERE  org_code = '$org_code'";
		$db->Delete($sql);
		foreach ($arrData1 as $key => $value)
		{
			$db->InsertData("influ_event", $value);
		}
		$db->Close ();
	}
	
	
	function attach10($project_id, $arrData1) {
	    $db = new DB ();
	    $db->UpdateTabData ( 'support_scitec', $project_id, $arrData1, 'project_id' );
	    $db->Close ();
	}
	/*
	 * 附件9中manage_state.html的 数据入库(没有写)
	 */
	function manage_state($project_id, $arrData1) {
		$db = new DB ();
		$sql="delete  from run_status where  project_id ='$project_id' ";
		$db->Delete($sql);
		foreach ( $arrData1 as $tmp ) {
			// $result = $db->InsertData('run_status', $tmp);
			// 获取近三年 自动获取
			$db->UpdateTabData2 ( 'run_status', $project_id, $tmp, 'project_id', $tmp ['the_year'], 'the_year' );
		}
		
		$db->Close ();
	}
	
	/*
	 * 附件9 hatch.html 从数据库自动获取
	 */
	function find_hatch($project_id,$flag) {
		$db = new DB ();
		$res1 = $db->GetInfo1 ( $project_id, 'hatch_result', 'project_id' );
		$appJSON = array (
				'Finish_Com_num' => $res1 ['finish_com_num'],
				'Acquire_num' => $res1 ['acquire_num'],
				'List' => $res1 ['list_num'],
				'Tec_product_num' => $res1 ['tec_product_num'],
				'Overseas' => $res1 ['overseas'],
				'Qr_Genious_num' => $res1 ['qr_genious_num'],
				'Mainboard' => $res1 ['mainboard'],
				'Hj_num' => $res1 ['hj_num'],
				'Mid_num' => $res1 ['mid_num'],
				'Gj_num' => $res1 ['gj_num'],
				'Risk_inv_num' => $res1 ['risk_inv_num'],
				'Risk_inv_sum' => $res1 ['risk_inv_sum'],
				'High_sal_num' => $res1 ['high_sal_num'],
				'Zgc_tech_num' => $res1 ['zgc_tech_num'],
				'Settle_com_num' => $res1 ['settle_com_num'],
				'Hatch_com_num' => $res1 ['hatch_com_num'],
				'Overseas_enter_nums' => $res1 ['overseas_enter_nums'],
				'Settle_com_profit' => $res1 ['settle_com_profit'],
				'Settle_com_tax' => $res1 ['settle_com_tax'],
				'Overthousand_com_num' => $res1 ['overthousand_com_num'],
				'Com_know_num' => $res1 ['com_know_num'],
				'Position_num' => $res1 ['position_num'],
				'Research_fund' => $res1 ['research_fund'],
				'Research_num' => $res1 ['research_num'],
				'Finance_num' => $res1 ['finance_num'],
				'Finance_limit' => $res1 ['finance_limit'] 
		);
		if($flag=="pdf"){
			$db->Close ();
			return $appJSON;
		}else{
		echo json_encode ( $appJSON );
		}
		$db->Close ();
	}
	/*  attach10  的 textarea們 */
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
	
	
	
	
	
	/*  attach9  的 textarea們 */
	function find_special($project_id,$flag) {
	    $db = new DB ();
	    $res1 = $db->GetInfo1 ( $project_id, 'incubator', 'project_id' );
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
	
	function find_running($project_id,$flag) {
	    $db = new DB ();
	    $res1 = $db->GetInfo1 ( $project_id, 'incubator', 'project_id' );
	    $appJSON = array (
	     'running' => $res1 ['running'],
	    );
	    if($flag=="pdf"){
	        $db->Close ();
	        return $appJSON;
	    }else{
	        echo json_encode ( $appJSON );
	    }
	    $db->Close ();
	}
	function find_influence($project_id,$flag) {
	    $db = new DB ();
	    $res1 = $db->GetInfo1 ( $project_id, 'incubator', 'project_id' );
	    $appJSON = array (
	     'influence' => $res1 ['influence']
	    );
	    if($flag=="pdf"){
	        $db->Close ();
	        return $appJSON;
	    }else{
	        echo json_encode ( $appJSON );
	    }
	    $db->Close ();
	}
	function find_service_job($project_id,$flag) {
	    $db = new DB ();
	    $res1 = $db->GetInfo1 ( $project_id, 'incubator', 'project_id' );
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
	function find_abstract($project_id,$flag) {
	    $db = new DB ();
	    $res1 = $db->GetInfo1 ( $project_id, 'incubator', 'project_id' );
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
	/*
	 * 附件9 manager_team.html 从数据库自动获取
	 */
	function find_manager_team($project_id,$flag) {
		$db = new DB ();
		$res1 = $db->GetInfo1 ( $project_id, 'hatch_team', 'project_id' );
		$appJSON = array (
				'hatch_total_area' => $res1 ['total_area'],
				'work_total_area' => $res1 ['office_area'],
				'hatch_house_area' => $res1 ['hatch_area'],
				'public_service_area' => $res1 ['public_area'],
				'rent_pay' => $res1 ['avg_rent'],
				'manager_total_num' => $res1 ['manage_num'],
				'doctor_num' => $res1 ['doctor_num'],
				'master_num' => $res1 ['master_num'],
				'graduate_num' => $res1 ['college_num'],
				'associate_num' => $res1 ['junior_num'],
				'doctor_ratio' => $res1 ['doctor_ratio'],
				'master_ratio' => $res1 ['master_ratio'],
				'graduate_ratio' => $res1 ['college_ratio'],
				'associate_ratio' => $res1 ['junior_ratio'] 
		);
		if($flag=="pdf"){
			$db->Close ();
			return $appJSON;
		}else{
			echo json_encode ( $appJSON );
		}
		
		$db->Close ();
	}
	
	/*
	 * 附件9 manage_state.html 从数据库自动获取
	 */
	function findman_state($project_id,$flag) {
		$db = new DB ();
		$appJSON = array ();
		// 自动生成 最近三年 放到year[]中 下边直接调用就ok了
// 		$year = array (
// 				util::gettime ( - 2 ),
// 				util::gettime ( - 1 ),
// 				util::gettime ( 0 ) 
// 		);
// 		for($i = 0; $i < 3; $i ++) {
// 			$res1 = $db->GetInfo3 ( $project_id, 'run_status', 'project_id', $year [$i], 'the_year' );
			$sql = "SELECT * FROM run_status WHERE project_id = '$project_id'";
			$res1 = $db->Select($sql);
			foreach ($res1 as $key => $value){
				$appJSON ["the_year[" . $key . "]"] = $value['the_year'];
				$appJSON ["sum_income[" . $key . "]"] = $value ['total_income'];
				$appJSON ["house_income[" . $key . "]"] = $value ['rent_income'];
				$appJSON ["propert_income[" . $key . "]"] = $value ['property_income'];
				$appJSON ["invest_income[" . $key . "]"] = $value ['invest_income'];
				$appJSON ["public_income[" . $key . "]"] = $value ['public_tec_income'];
				$appJSON ["plat_invest[" . $key . "]"] = $value ['other_income'];
				$appJSON ["profit[" . $key . "]"] = $value ['profit'];
				$appJSON ["hand_tax[" . $key . "]"] = $value ['hand_tax'];
				$appJSON ["seed_total_fund[" . $key . "]"] = $value ['seed_total_fund'];
				$appJSON ["seed_invest_fund[" . $key . "]"] = $value ['seed_inve_sum'];
				$appJSON ["hatch_com_num[" . $key . "]"] = $value ['hatch_com_num'];
				$appJSON ["public_service_fund[" . $key . "]"] = $value ['public_inve_sum'];
				$appJSON ["public_service_sum[" . $key . "]"] = $value ['public_service_income'];
			}
// 		}
		if($flag=="pdf"){
			$db->Close ();
			return $appJSON;
		}else{
			echo json_encode ( $appJSON );
		}
		$db->Close ();
	}
	
	/*
	 * 附件9 org_info.html 从数据库自动获取
	 */
	function findorg_info9($org_code,$project_id,$flag) {
		$db = new DB ();
		$res1 = $db->GetInfo1 ( $org_code, 'org_info', 'org_code' );
		$res2 = $db->GetInfo1 ( $org_code, 'legal_person', 'org_code' );
		$result5 = $db->GetInfo1 ( $project_id, 'project_info', 'project_id' );


		$login_info = $db->GetInfo1($_SESSION["user_id"], 'login_info', 'id');
		
		$linkman=$result5["linkman"];
		$linkman_contact=$result5["linkman_contact"];
		$linkman_phone=$result5["linkman_phone"];
		$linkman_fax=$result5["linkman_fax"];
		 
		if($linkman==null||$linkman==""){
			$linkman=$login_info["realname"];
		}
		 
		if($linkman_contact==null||$linkman_contact==""){
			$linkman_contact=$login_info["celphone"];
		}
		if($linkman_phone==null||$linkman_phone==""){
			$linkman_phone=$login_info["phone"];
		}
		if($linkman_fax==null||$linkman_fax==""){
			$linkman_fax=$login_info["phone"];
		}
		 
		$appJSON = array (
				'org_name' => $res1 ['org_name'],
				'org_type' => $res1 ['org_type'],
		        'investment' => $res1 ['investment'],
		        'service_type' => $res1 ['service_type'],
				'org_address' => $res1 ['org_address'],
				'legal_name' => $res1 ['legal_name'],
				'legal_phone' => $res1 ['legal_phone'],
		        'linkman'=>$linkman,
				'manager' => $res1 ['manager'],
				'fax' =>$linkman_fax,
				'phone' => $linkman_phone,
				'telephone' => $linkman_contact,
				'website' => $res1 ['website'],
				'email' => $res1 ['email'],
				'register_address' => $res1 ['register_address'],
				'register_time' => $res1 ['register_time'],
				'register_fund' => $res1 ['register_fund'],
				'total_fund' => $res1 ['asset_total'],
				'legal_person' => $res2 ['legal_name'],
				'legal_tel' => $res2 ['legal_phone'] ,
	    		'business_id'=> $res5 ['business_id'] ,
				//新加的
				'maked_name' => $res1 ['maked_name'],
				'ismake' => $res1 ['ismake']
		);
		if($flag=="pdf"){
			$db->Close ();
			return $appJSON;
		}else{
		echo json_encode ( $appJSON );
		}
		$db->Close ();
		return $appJSON;
	}
	//find project name
	function find_project_name($project_id){
	    $db = new DB ();
	    $res1 = $db->GetInfo1 ( $project_id, 'project_info', 'project_id');
	    $appJSON = array (
	        "project_name"=>$res1['project_name']
	    );
	    $db->Close ();
	    return $appJSON;
	    
	}
}