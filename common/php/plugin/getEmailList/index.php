<?php
require_once '../../../../common/php/config.ini.php';
require_once '../../../../common/php/lib/db.cls.php';

    $action = $_GET['action'];
    switch($action){
        case 'getEmails':
            getEmails();
            break;
        case 'updateStatus':
            updateStatus();
            break;
    }
    
    function getEmails(){
        $db = new DB();
        $sql = "Select * from emaillist where status = 0";
        $result = $db -> Select($sql);
        $dataArray = array();
        foreach($result as $item){
            $dataArray[] = array(
                "id" => $item['id'],
                "email" => $item["email"],
                "mailbody" => $item["mailbody"],
                "mailsubject" => $item["mailsubject"] 
            );
        }
        echo json_encode($dataArray);
    }
    
    function updateStatus(){
        $db = new DB();
        $ids = trim(urldecode($_GET['ids']),",");
        
        $update_sql = "Update emaillist set status = 1 where id IN ($ids)";
        $db -> Update($update_sql);
}
    
?>