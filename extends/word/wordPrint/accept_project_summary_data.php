<?php
require_once '../../../modules/php/action/class/acceptance/project.cls.php';
require_once '../../../common/php/config.ini.php';
require_once '../../../common/php/lib/db.cls.php';
include WWWPATH . 'extends/Table/TableData.php';
require_once __DIR__ . '/../word.php';
//datatopdf('demo', array('title' => 'aa'));
$apply = new Project ();
$db = new DB();
$org_code = $_SESSION ['org_code'];
$project_id = $_SESSION ['project_id'];
//org_info
$res1=$apply->findProjectArchieve($project_id, 'project_summary', 'project_id',"pdf");
$res2=$apply->findProjectChiefContent($project_id, 'project_summary', 'project_id',"pdf");
//3
$res3=$apply->findProjectPlan($project_id, 'project_summary', 'project_id',"pdf");
//4
$res4=$apply->findProjectKpi($project_id, 'project_summary', 'project_id',"pdf");
//5
$res5=$apply->findOrgSuggest($project_id, 'project_summary', 'project_id',"pdf");
//6
$res6=$apply->findOtherSuggest($project_id, 'project_summary', 'project_id',"pdf");
$res7=$apply->findProjectSummary($project_id, 'project_summary', 'project_id',"pdf");

$res1=array_merge($res1,$res2);
$res1=array_merge($res1,$res3);
$res1=array_merge($res1,$res4);
$res1=array_merge($res1,$res5);
$res1=array_merge($res1,$res6);
$res1=array_merge($res1,$res7);
echo datatoword($res1,'18.docx',18);