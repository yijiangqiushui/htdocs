<?php
session_start();
	class APPLY
	{

		/**
		 * 附件4 项目信息
		 */                
		function pro4_info($pro_info4,$project_id, $pro_org4, $modify_apply,  $org_code){
			$db=new DB();
			$result1=$db->UpdateTabData('project_info',$project_id,$pro_info4,'project_id' );
			//echo $result1;
		
			$result2=$db->UpdateTabData('org_info', $org_code, $pro_org4, 'org_code');
			//echo $result2;
			
			$result3=$db->UpdateTabData('modify_apply',$project_id,$modify_apply,'project_id');
			$db->Close();
		}
		
		
		/**
		 * 附件4 项目信息
		 */
		function org4_info($legal4, $org_info4, $org_code,$linkmanInfo,$project_id){
			$db=new DB();
			$result = $db->UpdateTabData('project_info', $project_id, $linkmanInfo, 'project_id');
			$result1=$db->UpdateTabData('legal_person', $org_code, $legal4,'org_code');
			$result2=$db->UpdateTabData('org_info', $org_code, $org_info4,'org_code');
			$db->Close();
		}
		
		
		function find4OrgInfo1($org_code,$project_id){
		    $db = new DB();
		    $re1 = $db->GetInfo1($org_code, 'org_info', 'org_code');
		    $re3 = $db->GetInfo1($org_code, 'legal_person', 'org_code');
		
		    
		    $re4 = $db->GetInfo1($org_code, 'org_info', 'org_code');
		    $re5 = $db->GetInfo1($project_id, 'modify_apply','project_id');
		    $re6 = $db->GetInfo1($project_id, 'project_info','project_id');
		    $login_info= $db->GetInfo1 ( $re6["user_id"], 'login_info', 'id' );
		    $linkman="";
		    $linkman_contact="";
		    $linkman_email="";
		    if($project_info["linkman"]==null){
		    	$linkman=$login_info["realname"];
		    }
		    if($project_info["linkman_contact"]==null){
		    	$linkman_contact=$login_info["celphone"];
		    }
		    if($project_info["linkman_email"]==null){
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
		
		        'legal_name'=>$re3['legal_name'],
		        'legal_id'=>$re3['legal_id'],
		        'legal_phone'=>$re3['legal_phone'],
		        
		        
		        
		        'company_summary'=>$re4['company_summary'],
		        
		        'start_end'=>$re5['start_end'],
		         
		        'project_name'=>$re6['project_name'],
		        'department'=>$re6['department'],
		        'project_fund'=>$re6['project_fund'],
		        'support_fund'=>$re6['support_fund'],
		        'support_way'=>$re6['support_way'],
		        'allocate_time'=>$re6['allocate_time'],
		        'property_name'=>$re6['property_name'],
		        'project_main'=>$re6['project_main'],
		
		    );
		    	
		    //$_SESSION['attach4_org_info']=$appJSON;
		    return $appJSON;
		
		}
		
		
		
		/**
		 * 单位基本信息 附件4;
		 *
		 * */
		function find4OrgInfo($org_code,$project_id){
			$db = new DB();
			$re1 = $db->GetInfo1($org_code, 'org_info', 'org_code');
			$re3 = $db->GetInfo1($org_code, 'legal_person', 'org_code');
			$re5 = $db->GetInfo1($project_id, 'project_info', 'project_id');
			$login_info = $db->GetInfo1($_SESSION["user_id"], 'login_info', 'id');
			
			$linkman=$re5["linkman"];    
			$linkman_contact=$re5["linkman_contact"];
			$linkman_email=$re5["linkman_email"];
			 
			if($linkman==null||$linkman==""){
				$linkman=$login_info["realname"] ;
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
					 
					'legal_name'=>$re3['legal_name'],
					'legal_id'=>$re3['legal_id'],
					'legal_phone'=>$re3['legal_phone']
		
			);
			
			$_SESSION['attach4_org_info']=$appJSON;
			$project_id=$_SESSION['project_id'];
			$sql = "SELECT table_status FROM table_status WHERE project_id = '$project_id' and table_name ='通州区支持承担市级以上科技项目申报书'";
			$result = $db->Select($sql);
				
			if($result[0]['table_status']==1 || $result[0]['table_status']==3) {
			    $appJSON ['save_display'] = 1;
			   
			
			} else {
			    $appJSON ['save_display'] = 0;
			}
			echo json_encode($appJSON);
			$db->Close();
		}
		
	
		
		
		function find4ProInfo($project_id,$org_code){
			$db = new DB();
		
			/*$query = "select org_code from project_info where project_id = '$project_id'";
			 $array = mysql_query($query);
			$org_code = $array[0]->org_code; 
						
			$array =$db->Select($query);
			$org_code = $array[0]['org_code'];*/
			//$org_code = $array['org_code'];
			//如果直接取，是取不到的，应该去找这个结果集数组的第一个变量，
			//赋值给$org_code，这就是结果集数组，》》》 $results = mysql_query($sql,$this->conn);
			
			$re1 = $db->GetInfo1($org_code, 'org_info', 'org_code');
// 			$re2 = $db->GetInfo1($project_id, 'modify_apply','project_id');
			$re3 = $db->GetInfo1($project_id, 'project_info','project_id');
			
			$start = date("Y/m/d",$re3['start_time']);
			$end = date("Y/m/d",$re3['end_time']);
			
			$appJSON=array(
					'company_summary'=>$re1['company_summary'],
					 
			         'start_time' => $start,
					'end_time' => $end,
					'project_name'=>$re3['project_name'],
					'department'=>$re3['department'],
					'project_fund'=>$re3['project_fund'],
					'support_fund'=>$re3['support_fund'],
					'support_way'=>$re3['support_way'],
					'allocate_time'=>$re3['allocate_time'],
					'property_name'=>$re3['property_name'],
					'project_main'=>$re3['project_main'],
			    
					
		
			);
			$sql = "SELECT table_status FROM table_status WHERE project_id = '$project_id' and table_name ='通州区支持承担市级以上科技项目申报书'";
			$result = $db->Select($sql);
			
			if($result[0]['table_status']==1 || $result[0]['table_status']==3) {
			    $appJSON ['save_display'] = 1;
			    	
			    	
			} else {
			    $appJSON ['save_display'] = 0;
			}
			echo json_encode($appJSON);
			$db->Close();
		 
		
	}
}
?>