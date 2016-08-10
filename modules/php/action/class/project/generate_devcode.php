<?php
class Pro_Code{
    public function dev_code($name,$attch_name,$stage,$setup,$carry,$check,$first_stage,$user_id){
//         $db=new DB();
//         $result = $db->RowNum("project_type");

           $org_code = $_SESSION['org_code'];
           $time = strtotime("now");
           $project_id = "dev".$time;
           $result['code'] = $project_id;
//         $result['code'] = "dev".$result['code'];
           $_SESSION['project_id'] = $project_id;
            //需要在table_status里面增加相应的表单信息
            
           $db = new DB();
           if(strpos($stage,'1') > -1){
               foreach($setup as $tmp){
                   $tmp['project_id'] = $project_id;
                   $insert_table = $db->InsertData('table_status',$tmp);
               }
           }
           
           if(strpos($stage,'2') > -1){
               foreach($carry as $tmp){
                   $tmp['project_id'] = $project_id;
                   $insert_table = $db->InsertData('table_status',$tmp);
               }
           }
           
           if(strpos($stage,'3') > -1){
               foreach($check as $tmp){
                   $tmp['project_id'] = $project_id;
                   $insert_table = $db->InsertData('table_status',$tmp);
               }
           }
           if(strpos($stage,'0') > -1){
               $attach = explode(",", $attch_name);
               $data1 = array();
               for($i=0;$i<count($attach);$i++)
               {
                   $data1[$i]['table_name'] = $attach[$i];
                   $data1[$i]['last_modify'] = $time;
                   $data1[$i]['table_status'] = 1;
                   $data1[$i]['project_id'] = $project_id;
                   $data1[$i]['project_stage'] = 0;
               }
               foreach($data1 as $tmp){
                $insert_table = $db->InsertData('table_status',$tmp);
               }
           }
           
           $project_data['project_id'] = $project_id;
           $project_data['project_type'] = $name;
           $project_data['department'] = "发展计划科";
           $project_data['project_stage'] = $first_stage;
           $project_data['org_code'] = $org_code;
           $project_data['user_id'] = $user_id;
           $project_data['stage_process'] = $stage;
           $project_data['create_time'] = $time;
           $insert_status = $db->InsertData('project_info',$project_data);
           echo json_encode($result);
    }
    
    public function know_code($name,$attch_name,$stage,$setup,$carry,$check,$first_stage,$user_id){
        $time = strtotime("now");
        $project_id = "kno".$time;
        $result['code'] = $project_id;
        $_SESSION['project_id'] = $project_id;
        $org_code = $_SESSION['org_code'];
        $db = new DB();
           if(strpos($stage,'1') > -1){
               foreach($setup as $tmp){
                   $tmp['project_id'] = $project_id;
                   $insert_table = $db->InsertData('table_status',$tmp);
               }
           }
           
           if(strpos($stage,'2') > -1){
               foreach($carry as $tmp){
                   $tmp['project_id'] = $project_id;
                   $insert_table = $db->InsertData('table_status',$tmp);
               }
           }
           
           if(strpos($stage,'3') > -1){
               foreach($check as $tmp){
                   $tmp['project_id'] = $project_id;
                   $insert_table = $db->InsertData('table_status',$tmp);
               }
           }
           if(strpos($stage,'0') > -1){
               $attach = explode(",", $attch_name);
               $data1 = array();
               for($i=0;$i<count($attach);$i++)
               {
                   $data1[$i]['table_name'] = $attach[$i];
                   $data1[$i]['last_modify'] = $time;
                   $data1[$i]['table_status'] = 1;
                   $data1[$i]['project_id'] = $project_id;
                   $data1[$i]['project_stage'] = 0;
               }
               foreach($data1 as $tmp){
                $insert_table = $db->InsertData('table_status',$tmp);
               }
           }
           $project_data['project_id'] = $project_id;
           $project_data['project_type'] = $name;
           $project_data['department'] = "知识产权科";
           $project_data['project_stage'] = $first_stage;
           $project_data['org_code'] = $org_code;
           $project_data['user_id'] = $user_id;
           $project_data['stage_process'] = $stage;
           $project_data['create_time'] = $time;
           $insert_status = $db->InsertData('project_info',$project_data);
           echo json_encode($result);
    }
    public function comprehensive($name,$attch_name,$stage,$setup,$carry,$check,$first_stage,$user_id){
        $time = strtotime("now");
        $project_id = "com".$time;
        $result['code'] = $project_id;
        $_SESSION['project_id'] = $project_id;
        $org_code = $_SESSION['org_code'];
        $db = new DB();
           if(strpos($stage,'1') > -1){
               foreach($setup as $tmp){
                   $tmp['project_id'] = $project_id;
                   $insert_table = $db->InsertData('table_status',$tmp);
               }
           }
           
           if(strpos($stage,'2') > -1){
               foreach($carry as $tmp){
                   $tmp['project_id'] = $project_id;
                   $insert_table = $db->InsertData('table_status',$tmp);
               }
           }
           
           if(strpos($stage,'3') > -1){
               foreach($check as $tmp){
                   $tmp['project_id'] = $project_id;
                   $insert_table = $db->InsertData('table_status',$tmp);
               }
           }
           if(strpos($stage,'0') > -1){
               $attach = explode(",", $attch_name);
               $data1 = array();
               for($i=0;$i<count($attach);$i++)
               {
                   $data1[$i]['table_name'] = $attach[$i];
                   $data1[$i]['last_modify'] = $time;
                   $data1[$i]['table_status'] = 1;
                   $data1[$i]['project_id'] = $project_id;
                   $data1[$i]['project_stage'] = 0;
               }
               foreach($data1 as $tmp){
                $insert_table = $db->InsertData('table_status',$tmp);
               }
           }
           $project_data['project_id'] = $project_id;
           $project_data['project_type'] = $name;
           $project_data['department'] = "科技综合科";
           $project_data['project_stage'] = $first_stage;
           $project_data['org_code'] = $org_code;
           $project_data['user_id'] = $user_id;
           $project_data['create_time'] = $time;
           $project_data['stage_process'] = $stage;
           $insert_status = $db->InsertData('project_info',$project_data);
           echo json_encode($result);
    }
}
    