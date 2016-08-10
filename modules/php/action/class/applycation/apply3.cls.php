<?php
	class APPLY
	{
		/**
		 * 附件3单位基本情况
		 */
		function org3_info($org3_info,$org3_legal,$org3_patent,$org3_staff,$org3_profit,$org_code,$linkmanInfo,$project_id){
			$db = new DB();
			$result = $db->UpdateTabData('project_info', $project_id, $linkmanInfo, 'project_id');
			$result1 = $db->UpdateTabData('org_info', $org_code, $org3_info, 'org_code');
			$result2 = $db->UpdateTabData('legal_person', $org_code, $org3_legal, 'org_code');
			$result3 = $db->UpdateTabData('intellectual_property', $org_code, $org3_patent, 'org_code');
			$result4 = $db->UpdateTabData('staff_info', $org_code, $org3_staff, 'org_code');
			$result5 = $db->UpdateTabData('profit_tax', $org_code, $org3_profit, 'org_code');
			$db->Close();
		}
		
		/**
		 * 附件3 项目基本情况
		 */
		function project3_info($project3_info,$project3_invest,$project3_material,$project3_profit1,$project3_profit2,$project3_profit3,$project_id){
		
			$db = new DB();
			$sql = "delete from tech_material where project_id = '$project_id'";
			$result_del = $db->Delete($sql);
// 			echo $project3_material;
			foreach ($project3_material as $tmp){
// 				echo $temp;
				$result = $db -> InsertData('tech_material',$tmp);
			}
			$result1 = $db->UpdateTabData('project_info', $project_id, $project3_info, 'project_id');
			$result2 = $db->UpdateTabData('project_invest', $project_id, $project3_invest, 'project_id');
			$db -> UpdateTabData('project_benefit', 1, $project3_profit1, 'yaer');
			$db -> UpdateTabData('project_benefit', 2, $project3_profit2, 'year');
			$db -> UpdateTabData('project_benefit', 3, $project3_profit3, 'year');
			$db->Close();
		}
		

		/**
		 * 单位基本信息  附件3;
		 *
		 * */
		function find3OrgInfo($org_code,$project_id,$flag){
			$db = new DB();
		
			$re1 = $db->GetInfo1($org_code, 'org_info', 'org_code');
			$re2 = $db->GetInfo1($org_code, 'profit_tax', 'org_code');
			$re3 = $db->GetInfo1($org_code, 'legal_person', 'org_code');
			$re4 = $db->GetInfo1($org_code, 'intellectual_property', 'org_code');
			$re5 = $db->GetInfo1($org_code, 'staff_info', 'org_code');
			
			
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
			$appJSON=array(
					'org_name'=>$re1['org_name'],
					'org_code'=>$re1['org_code'],
					'register_fund'=>$re1['register_fund'],
					'register_address'=>$re1['register_address'],
					'org_type'=>$re1['org_type'],
					'contact_address'=>$re1['contact_address'],
					'postal'=>$re1['postal'],
					'linkman'=>$linkman,
					'linkman_email'=>$linkman_email,
					'linkman_contact'=>$linkman_contact,
					'listed'=>$re1['listed'],
					'listed_code'=>$re1['listed_code'],
					'org_trade'=>$re1['org_trade'],
					'main_product'=>$re1['main_product'],
		
					'lasthalf_income'=>$re2['lasthalf_income'],
					'lasthalf_tax'=>$re2['lasthalf_tax'],
					'lasthalf_profit'=>$re2['lasthalf_profit'],
					'predict_tax'=>$re2['predict_tax'],
					'predict_inspectax'=>$re2['predict_inspectax'],
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
					'researcher_num'=>$re5['researcher_num']
			);
			if($flag=="pdf"){
				$db->Close();
				return $appJSON;
			}
			echo json_encode($appJSON);
			$db->Close();
		}
		 
		 
		/**
		 * 项目基本情况 附件3;
		 *
		 * */
		function find3ProInfo($project_id,$flag){
			$db = new DB();
			 
			$re = $db->GetInfo1($project_id, 'project_info', 'project_id');
			$re1 = $db->GetInfo1($project_id, 'project_invest', 'project_id');
			$result1 = $db->GetInfo2($project_id, 'project_benefit', 'project_id', 1 , 'year');
			$result2 = $db->GetInfo2($project_id, 'project_benefit', 'project_id', 2 , 'year');
			$result3 = $db->GetInfo2($project_id, 'project_benefit', 'project_id', 3 , 'year');
			$appJSON=array(
					'project_name'=>$re['project_name'],
					'project_place'=>$re['project_place'],
					'tech_area'=>$re['tech_area'],
					'others_material'=>$re['others_material'],
					'tech_level'=>$re['tech_level'],
					'coproject_summary'=>$re['coproject_summary'],
					'tech_achieve'=>$re['tech_achieve'],
					'social_benefit'=>$re['social_benefit'],
					 
					'invest_total'=>$re1['invest_total'],
					'invested'=>$re1['invested'],
					'fixed_invest'=>$re1['fixed_invest'],
					
					'output1' => $result1['output'],
					'sale_income1' => $result1['sale_income'],
					'tax1' => $result1['tax'],
					'profit1' => $result1['profit'],
					'foreign_income1' => $result1['foreign_income'],
					'new_member1' => $result1['new_member'],
					
					'output2' => $result2['output'],
					'sale_income2' => $result2['sale_income'],
					'tax2' => $result2['tax'],
					'profit2' => $result2['profit'],
					'foreign_income2' => $result2['foreign_income'],
					'new_member2' => $result2['new_member'],
					
					'output3' => $result3['output'],
					'sale_income3' => $result3['sale_income'],
					'tax3' => $result3['tax'],
					'profit3' => $result3['profit'],
					'foreign_income3' => $result3['foreign_income'],
					'new_member3' => $result3['new_member']
			);
			if($flag=="pdf"){
				$db->Close();
				return $appJSON;
			}
			echo json_encode($appJSON);
			$db->Close();
		}
		 
		
	}
?>