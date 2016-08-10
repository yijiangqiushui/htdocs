<?php


class APPLY
{
	/**
	 * 附件11单位基本情况
	 */     //          $org_code, $org11_info, $org11_legal, $technical_contract, $org11_award
	function org_info11($org_code, $org11_info, $org11_legal, $technical_contract, $org11_award,$linkmanInfo,$project_id){
	    $db = new DB();
	    $result = $db->UpdateTabData('project_info', $project_id, $linkmanInfo, 'project_id');
	    $result1 = $db->UpdateTabData('org_info', $org_code, $org11_info,'org_code');
	    $result2 = $db->UpdateTabData('legal_person', $org_code, $org11_legal,'org_code');
	    $result4 = $db->UpdateTabData('apply_award', $org_code, $org11_award,'org_code');
	    
	    $result3= $db->Delete("delete from technical_contract  where org_code=$org_code");
	    foreach ($technical_contract as $tem) {
	        $result5 = $db->InsertData('technical_contract',$tem);
	}
	$db->Close();
	}
    
function find11orgInfo($org_code,$project_id,$flag)
{
    $db = new DB();
    // 参数分别是： 主键值   数据库表明   主键名
    $result1 = $db->GetInfo1($org_code, 'org_info', 'org_code');
    $result2 = $db->GetInfo1($org_code, 'legal_person', 'org_code');
    $result3 = $db->GetInfo1($org_code, 'apply_award', 'org_code');
    
    
    $result5 = $db->GetInfo1 ( $project_id, 'project_info', 'project_id' );
    
    
    $login_info = $db->GetInfo1($_SESSION["user_id"], 'login_info', 'id');
    
    $linkman=$result5["linkman"];
    $linkman_contact=$result5["linkman_contact"];
    $linkman_email=$result5["linkman_email"];
    	
    if($linkman==null||$linkman==""){
    	$linkman=$login_info["realname"];
    }
    if($linkman_email==null||$linkman_email==""){
    	$linkman_email=$login_info["linkman_email"];
    }
    if($linkman_contact==null||$linkman_contact==""){
    	$linkman_contact=$login_info["celphone"];
    }
       $appJSON = array(
        'org_name' => $result1['org_name'],
       'register_address' => $result1['register_address'],
        'register_fund' => $result1['register_fund'],
       'contact_address'=> $result1['contact_address'],
        'linkman' => $linkman,
       'linkman_email' =>$linkman_email,
        'linkman_contact' => $linkman_contact,
       'org_type' => $result1['org_type'],
      'org_trade' => $result1['org_trade'],
        'postal' => $result1['postal'],
        'org_bank' => $result1['org_bank'],
        'username' => $result1['username'],
        'account'=> $result1['account'],
           
        'legal_name' =>$result2['legal_name'], 
        'legal_id' =>$result2['legal_id'],
        'legal_phone' =>$result2['legal_phone'],
        
        'award_level' =>$result3['award_level'],
        'expect_contractNums' =>$result3['expect_contractNums'],
        'expect_contractMoney' =>$result3['expect_contractMoney'],
        'previous_taxes' =>$result3['previous_taxes'],
        'check_amount' =>$result3['check_amount'],
        'contractMoney'=>$result3['contractMoney'] ,
       		'business_id'=> $res5['business_id']
        
     
    );
//        echo $org_code;
//        print_r($appJSON);
       
       if($flag=="pdf"){
       	$db->Close();
       	return $appJSON;
       }
    echo json_encode($appJSON);
    $db->close();
}


}
// 回显表单10service_team的内容
?>



