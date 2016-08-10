<?php
include 'verifyInfo.php';

$table_name = $_POST['table_name'];
$action = $_POST['action'];
$project_id =$_POST['project_id'];
$approval_opinion = $_POST['approval_opinion'];
$verify = new Verify();
switch($action){
    case 'check_pass':
        $verify->updateStatus($table_name,$approval_opinion);
        break;
    case 'check_deny':
        $verify->returnModify($table_name);
        break;
    case 'nopass':
    	$verify->nopass($project_id,$table_name);
    	break;
}