<?php

class Attach1
{
    function find_attach_info($project_id,$user_type,$table_id)
    {
        $db = new DB();
        $sql = "select * from table_status where project_id = '$project_id' and table_name = '$table_id'";
   //   echo $sql;
        $result = $db -> Select($sql);
    //  $object = mysql_fetch_object($result);
        
        $json = array(
            'table_status'=>$result[0]['table_status'],
            'user_type'=>$user_type,
            'project_id'=>$project_id,
            'iscomplete'=>$result[0]['iscomplete']
        );
        echo json_encode($json);
        $db->Close();
    }
    
    function find_genious_award($project_id,$user_type,$table_id)
    {
        $db = new DB();
        $sql = "select * from table_status where project_id = '$project_id' and table_name = '$table_id'";
        $result = $db -> SelectOri($sql);
        $object = mysql_fetch_object($result);
        $json = array(
            'table_status'=>$object->table_status,
            'user_type'=>$user_type,
            'project_id'=>$project_id,
            'iscomplete'=>$object->iscomplete,
        );
        echo json_encode($json);
        $db->Close();
    }
}