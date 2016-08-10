<?php
	class APPLY
	{
		/**
		 * 附件5单位基本情况
		 */     
		function org5_info($org5_info, $aptitude_name,$org5_legal,$org5_patent,$org5_staff,$org5_profit,$org_code,$linkmanInfo,$project_id){
			$db = new DB();
			$result = $db->UpdateTabData('project_info', $project_id, $linkmanInfo, 'project_id');
			$result1 = $db->UpdateTabData('org_info', $org_code, $org5_info, 'org_code');
			$result2 = $db->UpdateTabData('aptitude_name', $org_code, $aptitude_name, 'org_code');
			$result3 = $db->UpdateTabData('legal_person', $org_code, $org5_legal, 'org_code');
			$result4 = $db->UpdateTabData('intellectual_property', $org_code, $org5_patent, 'org_code');
			$result5 = $db->UpdateTabData('staff_info', $org_code, $org5_staff, 'org_code');
			$result6 = $db->UpdateTabData('profit_tax', $org_code, $org5_profit, 'org_code');
		}
		
		
		/*
		 * 
		 * org_code:company code
		 * @return array*/
		
		function find5OrgInfo1($org_code,$project_id){
		   
		    $db = new DB();
		
		    $re1 = $db->GetInfo1($org_code, 'org_info', 'org_code');
		    $re2 = $db->GetInfo1($org_code, 'profit_tax', 'org_code');
		    $re3 = $db->GetInfo1($org_code, 'legal_person', 'org_code');
		    $re4 = $db->GetInfo1($org_code, 'intellectual_property', 'org_code');
		    $re5 = $db->GetInfo1($org_code, 'staff_info', 'org_code');
		    $re6 = $db->GetInfo1($org_code, 'aptitude_name', 'org_code');
		   $re8 = $db->GetInfo1($project_id, 'project_info', 'project_id');
			$re7 = $db->GetInfo1($re8["user_id"], 'login_info', 'id');
// 			$sql = "SELECT * FROM login_info WHERE user_id = 'id' ";
		    $appJSON=array(
		        'org_name'=>$re1['org_name'],
		        'org_code'=>$re1['org_code'],
		        'register_fund'=>$re1['register_fund'],
		        'register_address'=>$re1['register_address'],
		        'org_type'=>$re1['org_type'],
		        'contact_address'=>$re1['contact_address'],
		        'postal'=>$re1['postal'],
		      /*   'linkman'=>$re1['linkman'],
		        'linkman_email'=>$re1['linkman_email'],
		        'linkman_contact'=>$re1['linkman_contact'], */
		        'org_trade'=>$re1['org_trade'],
		        'main_product'=>$re1['main_product'],
		        'research_content'=>$re1['research_content'],
		
		        'lasthalf_income'=>$re2['lasthalf_income'],
		        'lasthalf_tax'=>$re2['lasthalf_tax'],
		        'lasthalf_profit'=>$re2['lasthalf_profit'],
		        'predict_income'=>$re2['predict_income'],
		        'predict_tax'=>$re2['predict_tax'],
		        'predict_profit'=>$re2['predict_profit'],
		        
		        
		        'patent_num'=>$re4['patent_num'],
		        'invent_patent'=>$re4['invent_patent'],
		        'functional_patent'=>$re4['functional_patent'],
		        'patent_design'=>$re4['patent_design'],
		        'other_patent'=>$re4['other_patent'],
		
		        'legal_name'=>$re3['legal_name'],
		        'legal_id'=>$re3['legal_id'],
		        'legal_phone'=>$re3['legal_phone'],
		
		        'staff_num'=>$re5['staff_num'],
		        'junior'=>$re5['junior'],
		        'researcher_num'=>$re5['researcher_num'],
		
		        'approve_org'=>$re6['approve_org'],
		        'name'=>$re6['name'],
		        'validity'=>$re6['validity'],
		        'aptitude_code'=>$re6['aptitude_code'],
		    		
					'linkman'=>$re7['realname'],
					'linkman_email'=>$re7['email'],
					'linkman_contact'=>$re7['celphone']
		
		    );
		    return $appJSON;
		}

		/**
		 * 单位基本信息 附件5;
		 *
		 * */
		function find5OrgInfo($org_code,$project_id){
		  
			$db = new DB();
			 
			$re1 = $db->GetInfo1($org_code, 'org_info', 'org_code');
			$re2 = $db->GetInfo1($org_code, 'profit_tax', 'org_code');
			$re3 = $db->GetInfo1($org_code, 'legal_person', 'org_code');
			$re4 = $db->GetInfo1($org_code, 'intellectual_property', 'org_code');
			$re5 = $db->GetInfo1($org_code, 'staff_info', 'org_code');
			$re6 = $db->GetInfo1($org_code, 'aptitude_name', 'org_code');
			$re8 = $db->GetInfo1($project_id, 'project_info', 'project_id');
		
			 $login_info = $db->GetInfo1($_SESSION["user_id"], 'login_info', 'id');
           $linkman=$re8["linkman"];
          $linkman_contact=$re8["linkman_contact"];
 	  $linkman_email=$re8["linkman_email"];
         
  	if($linkman==null||$linkman==""){ 
        $linkman=$login_info["realname"]; 
        }
       
	 if($linkman_contact==null||$linkman_contact==""){
        $linkman_contact=$login_info["celphone"];
        }
 	
	if($linkman_email==null||$linkman_email==""){
        $linkman_email=$login_info["email"];
        }
			$appJSON=array(
					'org_name'=>$re1['org_name'],
					'org_code'=>$re1['org_code'],
					'register_fund'=>$re1['register_fund'],
					'register_address'=>$re1['register_address'],
					'org_type'=>$re1['org_type'],
					'contact_address'=>$re1['contact_address'],
					'postal'=>$re1['postal'],
					'org_trade'=>$re1['org_trade'],
					'main_product'=>$re1['main_product'],
					'research_content'=>$re1['research_content'],
		
					'lasthalf_income'=>$re2['lasthalf_income'],
					'lasthalf_tax'=>$re2['lasthalf_tax'],
					'lasthalf_profit'=>$re2['lasthalf_profit'],
                    'predict_income'=>$re2['predict_income'],
			        'predict_tax'=>$re2['predict_tax'],
			        'predict_profit'=>$re2['predict_profit'],
			    
			    
					'patent_num'=>$re4['patent_num'],
					'invent_patent'=>$re4['invent_patent'],
					'functional_patent'=>$re4['functional_patent'],
					'patent_design'=>$re4['patent_design'],
					'other_patent'=>$re4['other_patent'],
		
					'legal_name'=>$re3['legal_name'],
					'legal_id'=>$re3['legal_id'],
					'legal_phone'=>$re3['legal_phone'],
					 
					'staff_num'=>$re5['staff_num'],
					'junior'=>$re5['junior'],
			        'researcher_num'=>$re5['researcher_num'],
		
					'approve_org'=>$re6['approve_org'],
					'name'=>$re6['name'],
					'validity'=>$re6['validity'],
					'aptitude_code'=>$re6['aptitude_code'],
					
				'linkman'=>$linkman,
					'linkman_email'=>$linkman_email,
					'linkman_contact'=>$linkman_contact
					 
			);
			echo json_encode($appJSON);
			$db->Close();
		}
		
	}
?>