<?php
include '../../class/user_project/modify_solution.cls.php';
$action = $_GET['action'];
$project_id = $_SESSION['project_id'];
$org_code = $_SESSION ['org_code'];
$user_type = $_SESSION['user_type'];

$table_encode_name = $_GET['table_name'];
$table_name = urldecode($table_encode_name);
$attach = new modify_solution();

switch($action)
{        
    case 'attach_attr':
        $table_name = urldecode($table_name);
	    $attach->find_attach_info($project_id,$user_type,$table_name);
        break;
}