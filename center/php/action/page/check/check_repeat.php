<?php
include '../../../../../common/php/config.ini.php';
include '../../../config.ini.php';
include ROOTPATH.'lib/common.cls.php';
include ROOTPATH.'lib/db.cls.php';

$status = $_GET['status'];
$project_id = $_GET['project_id'];

if($status == 1){
    //审核通过是2
    $sql = "update table_status set check_repeat = 2 where project_id = '$project_id' and table_name = '北京市通州区科技计划项目实施方案'";
    $db = new DB();
    $result = $db->Update($sql);
    $db->close();
}
   //审核不通过3
else{
    $sql = "update table_status set check_repeat = 3 where project_id = '$project_id' and table_name = '北京市通州区科技计划项目实施方案'";
    $db = new DB();
    $result = $db->Update($sql);
    $db->close();
}