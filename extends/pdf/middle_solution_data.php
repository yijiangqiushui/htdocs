<?php

require_once __DIR__ . '/pdf.php';
include '../../common/php/config.ini.php';
include '../../common/php/lib/db.cls.php';
include '../../modules/php/action/class/implement/middle.cls.php';

session_start();

$project_id = $_SESSION['project_id'];

$middle = new Middle(); 

$arr1=$middle->findProMiddle_pdf($project_id,'project_middle', 'project_id'); 
$arr2=$middle->findProjectFund_pdf($project_id,'project_middle', 'project_id');
$arr3=$middle->findProProble_pdf($project_id, 'project_middle', 'project_id');

$arr1['fund_use']=$arr2['fund_use'];
$arr1['problem_action']=$arr3['problem_action'];
// var_dump($arr1);
 datatopdf('middle_solution_data', $arr1);