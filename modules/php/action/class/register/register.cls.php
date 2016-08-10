<?php

class Register{
    function findOrg($org_code){
        $db = new DB();
        if($org_code != null){
            $result_org = $db->GetInfo1($org_code,'org_info','org_code');  //公司的基本信息
            $result_legal = $db->GetInfo1($org_code,'legal_person','org_code');  //公司法人信息
            $registerJSON=array(
            		'orgCode'=>$result_org['org_code'],
                'org_name'=>$result_org['org_name'],
                'phone'=>$result_org['phone'],
                'email'=>$result_org['email'],
                'legalPerson'=>$result_legal['legal_name'],
            	'legal_phone'=>$result_legal['legal_phone'],
            	'register_address'=>$result_org['register_address'],
            	'contact_address'=>$result_org['contact_address'],
                
            );
        }
        echo json_encode($registerJSON);
        $db->close();
    }
}