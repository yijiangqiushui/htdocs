<?php
require_once __DIR__ . '/pdf.php';
include '../../common/php/config.ini.php';
include '../../common/php/lib/db.cls.php';
include '../../modules/php/action/class/acceptance/expert.cls.php';

session_start();

$project_id = $_SESSION['project_id'];
$org_code = $_SESSION['org_code']; 
$expert = new Expert();

$arr2=$expert->findProjectExpert_pdf($project_id, 'project_info', 'project_id');
$arr1=$expert->finds_pdf($project_id, 'project_info', 'project_id');
 $arr1['project-name']=$arr2['project-name'];
 $arr1['expert_arguments']=$arr2['expert_arguments'];
//var_dump($arr1);
datatopdf('expertPro_data', $arr1);