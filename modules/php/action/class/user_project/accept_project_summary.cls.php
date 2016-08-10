<?php

class accept_project_summary
{
    function find_attach_info($project_id,$user_type,$table_name)
    {
        $db = new DB();
        $sql = "select * from table_status where project_id = '$project_id' and table_name = '$table_name'";
        $result = $db -> SelectOri($sql);
        $object = mysql_fetch_object($result);
        $json = array(
            'table_status'=>$object->table_status,
            'user_type'=>$user_type,
            'project_id'=>$project_id
        );
        echo json_encode($json);
        $db->Close();
    }
}