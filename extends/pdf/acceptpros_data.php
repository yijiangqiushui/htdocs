<?php
require_once __DIR__ . '/pdf.php';
include '../../common/php/config.ini.php';
include '../../common/php/lib/db.cls.php';
include '../../modules/php/action/class/acceptance/project.cls.php';

session_start();

$project_id = $_SESSION['project_id'];
$org_code = $_SESSION['org_code']; 
$project = new Project();

$arr1=$project->findProjectSummary_pdf($project_id, 'project_summary', 'project_id');
//var_dump($arr1);
datatopdf('acceptpros_data', $arr1);