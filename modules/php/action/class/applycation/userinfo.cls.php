<?php

class APPLY
{
    /*
     * userinfo  信息添加或者更新
     *
     * */
    function user_info($org_code,$arrData,$userlegal){
        $db=new DB();
        $db->UpdateTabData('org_info', $org_code, $arrData, 'org_code');
        $db->UpdateTabData('legal_person', $org_code, $userlegal, 'org_code');
        $db->Close();
    
    }
    
    function user_info2($org_code,$arrData){
        $db=new DB();
        $db->UpdateTabData('login_info', $org_code, $arrData, 'org_code');
        $db->Close();
    
    }
    /*
     * 附件6 org_info.html获取表
     *
     * */ 
    function find_user_info($org_code){
        $db=new DB();
        $res1=$db->GetInfo1($org_code, 'org_info', 'org_code');
        $res2=$db->GetInfo1($org_code, 'legal_person', 'org_code');
        
        $appJSON=array(
            'org_code'=>$res1['org_code'],
            'org_name'=>$res1['org_name'],
            'legal_name'=>$res2['legal_name'],
            'linkman_contact'=>$res1['linkman_contact'],
            'legal_phone'=>$res2['legal_phone'],
            'linkman'=>$res1['linkman'],
            'email'=>$res1['email'],    
            'contact_address'=>$res1['contact_address'],
            'register_address'=>$res1['register_address'],
            'phone' => $res1['phone']         
        );
        ob_clean();
        echo json_encode($appJSON);
        $db->Close();
    
    }
    
     
    
}
?>