<?php
include '../../../../common/php/config.ini.php';
include '../../../../common/php/lib/db.cls.php';
include '../../../../common/php/plugin/fenci_v1.0_utf8/checkduplicate.cls.php';



$project_id = $_GET['project_id'];
$_SESSION['project_id'] = $project_id;
$data['code'] = 1;
$data['genious'] = 1;
if($_SESSION['project_id'] == $project_id){
    $data['code'] = 1;
    $db = new DB();
    $sql = "SELECT table_name FROM table_status WHERE project_id = '$project_id'";
    $result = $db -> Select($sql);
    
    if($result[0]['table_name'] == '19' || $result[0]['table_name'] == '20'){
    	$data['genious'] = 1;
    }else{
    	$data['genious'] = 0;
    }
}
else{
    $data['code'] = 0;
}

echo json_encode($data);


