<?php
	class APPLY
	{
		/**
		 * 附件3单位基本情况
		 */
		function org3_info($org3_info,$org3_legal,$org3_patent,$org3_staff,$org3_profit,$org_code){
			$db = new DB();
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
		function project3_info($project3_info,$project3_invest3,$project3_material,$project_id){
		
			$db = new DB();
			$sql = "delete from tech_material where project_id = '$project_id'";
			$result_del = $db->Delete($sql);
			// 	    echo count($project_researcher);将项目研究人员的基本信息进行入库的操作
			foreach ($project3_material as $tmp){
				$result = $db -> InsertData('tech_material',$tmp);
			}
			$result1 = $db->UpdateTabData('project_info', $project_id, $project3_info, 'project_id');
			$result2 = $db->UpdateTabData('project_invest', $project_id, $project3_invest, 'project_id');
			$db->Close();
		}
		

		/**
		 * 单位基本信息  附件3;
		 *
		 * */
		function find3OrgInfo($org_code){
			$db = new DB();
		
			$re1 = $db->GetInfo1($org_code, 'org_info', 'org_code');
			$re2 = $db->GetInfo1($org_code, 'profit_tax', 'org_code');
			$re3 = $db->GetInfo1($org_code, 'legal_person', 'org_code');
			$re4 = $db->GetInfo1($org_code, 'intellectual_property', 'org_code');
			$re5 = $db->GetInfo1($org_code, 'staff_info', 'org_code');
		
			$appJSON=array(
					'org_name'=>$re1['org_name'],
					'org_code'=>$re1['org_code'],
					'register_fund'=>$re1['register_fund'],
					'register_address'=>$re1['register_address'],
					'org_type'=>$re1['org_type'],
					'contact_address'=>$re1['contact_address'],
					'postal'=>$re1['postal'],
					'linkman'=>$re1['linkman'],
					'linkman_email'=>$re1['linkman_email'],
					'linkman_contact'=>$re1['linkman_contact'],
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
			echo json_encode($appJSON);
			$db->Close();
		}
		 
		 
		/**
		 * 项目基本情况 附件3;
		 *
		 * */
		function find3ProInfo($project_id){
			$db = new DB();
			 
			$re = $db->GetInfo1($project_id, 'project_info', 'project_id');
			$re1 = $db->GetInfo1($project_id, 'project_invest', 'project_id');
			 
			$appJSON=array(
					'project_name'=>$re['project_name'],
					'project_place'=>$re['project_place'],
					'tech_area'=>$re['tech_area'],
					'tech_level'=>$re['tech_level'],
					'coproject_summary'=>$re['coproject_summary'],
					'tech_achieve'=>$re['tech_achieve'],
					'social_benefit'=>$re['social_benefit'],
					 
					'invest_total'=>$re1['invest_total'],
					'invested'=>$re1['invested'],
					'fixed_invest'=>$re1['fixed_invest']
			);
			echo json_encode($appJSON);
			$db->Close();
		}
		 
		
	}
?>