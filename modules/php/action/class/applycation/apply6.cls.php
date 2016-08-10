<?php

class APPLY
{
    /*
     * 附件6 org_info.html入库
     *
     * */
    function org_info6($org_code,$arrData1,$arrData2,$arrData3,$arrData4,$linkmanInfo,$project_id){
        $db=new DB();
        $result = $db->UpdateTabData('project_info', $project_id, $linkmanInfo, 'project_id');
        $sql = "delete from technical_contract where org_code = '$org_code' ";
        $db->Delete($sql);
        foreach( $arrData4 as $tmp){
            $result =  $db->InsertData('technical_contract', $tmp);
        }
        $db->UpdateTabData('org_info', $org_code, $arrData1, 'org_code');
        $db->UpdateTabData('legal_person', $org_code, $arrData2,'org_code');
        $db->UpdateTabData('apply_award', $org_code, $arrData3, 'org_code');
        
        $db->Close();
    
    }
    
    function find_org_info6_pdf($org_code){
        $db=new DB();
        $res1=$db->GetInfo1($org_code, 'org_info', 'org_code');
        $res2=$db->GetInfo1($org_code, 'legal_person', 'org_code');
        $res3=$db->GetInfo1($org_code, 'apply_award', 'org_code');
        $appJSON=array(
            'app_com_name'=>$res1['org_name'],
            'com_reg_add'=>$res1['register_address'],
            'app_com_fund'=>$res1['register_fund'],
            'com_com_add'=>$res1['contact_address'],
            'app_com_post'=>$res1['postal'],
            'com_contact_name'=>$res1['linkman'],
            'com_contact_email'=>$res1['linkman_email'],
            'com_contact_tel'=>$res1['linkman_contact'],
            'reg_type'=>$res1['org_type'],
            'com_trade'=>$res1['org_trade'],
            'com_bank'=>$res1['org_bank'],
            'bank_name'=>$res1['username'],
            'com_trade'=>$res1['account'],
            'com_legal_name'=>$res2['legal_name'],
            'com_legal_ID'=>$res2['legal_id'],
            'com_legal_tel'=>$res2['legal_phone'],
            'execpt_cont_num'=>$res3['expect_contractNums'],
            'contractMoney'=>$res3['contractMoney'],
            'execpt_cont_fund'=>$res3['expect_contractMoney'],
            'first_tax'=>$res3['previous_taxes'],
            'check_fund'=>$res3['check_amount'],
            'reward_level'=>$res3['award_level'],
            'sc_opinion'=>$res3['sc_opinion']
        );
        return $appJSON;
        
    }
    
    
    
    /*
     * 附件6 org_info.html获取表
     *
     * */
    function find_org_info6($org_code,$project_id){
        $db=new DB();
        $res1=$db->GetInfo1($org_code, 'org_info', 'org_code');
        $res2=$db->GetInfo1($org_code, 'legal_person', 'org_code');
        $res3=$db->GetInfo1($org_code, 'apply_award', 'org_code');
        
        $res5=$db->GetInfo1($project_id, 'project_info', 'project_id');
        $login_info = $db->GetInfo1($_SESSION["user_id"], 'login_info', 'id');
        
        $linkman=$res5["linkman"]; 
        $linkman_contact=$res5["linkman_contact"];
        $linkman_email=$res5["linkman_email"];
         
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
            'app_com_name'=>$res1['org_name'],
            'com_reg_add'=>$res1['register_address'],
            'app_com_fund'=>$res1['register_fund'],
            'com_com_add'=>$res1['contact_address'],
            'app_com_post'=>$res1['postal'],
            'com_contact_name'=>$linkman,
            'com_contact_email'=>$linkman_email,
            'com_contact_tel'=>$linkman_contact,
            'reg_type'=>$res1['org_type'],
            'com_trade'=>$res1['org_trade'],
            'com_bank'=>$res1['org_bank'],
            'bank_name'=>$res1['username'],
            'com_trade'=>$res1['account'],
            'com_legal_name'=>$res2['legal_name'],
            'com_legal_ID'=>$res2['legal_id'],
            'com_legao_tel'=>$res2['legal_phone'],
            'execpt_cont_num'=>$res3['expect_contractNums'],
        	'contractMoney'=>$res3['contractMoney'],
            'execpt_cont_fund'=>$res3['expect_contractMoney'],
            'first_tax'=>$res3['previous_taxes'],
            'check_fund'=>$res3['check_amount'],
            'reward_level'=>$res3['award_level'],
            'sc_opinion'=>$res3['sc_opinion']
        );
        
        $project_id=$_SESSION['project_id'];
        $sql = "SELECT table_status FROM table_status WHERE project_id = '$project_id' and table_name ='通州区技术合同登记奖励资金申报表'";
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