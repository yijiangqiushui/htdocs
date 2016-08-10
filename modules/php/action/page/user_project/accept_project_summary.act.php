<?php
include '../../../../../center/php/config.ini.php';
include '../../../../../common/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';
include '../../class/user_project/accept_project_summary.cls.php';

include '../../../../../common/php/plugin/fenci_v1.0_utf8/checkduplicate.cls.php';

$action = $_GET['action'];
$project_id = $_SESSION['project_id'];
$org_code = $_SESSION ['org_code'];
$user_type = $_SESSION['user_type'];

$table_name = $_GET['table_name'];

$attach = new accept_project_summary();

switch($action)
{
    case 'attach_attr':
	    $attach->find_attach_info($project_id,$user_type,$table_name);
        break;
}