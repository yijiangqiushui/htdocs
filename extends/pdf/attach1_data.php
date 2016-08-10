<?php

require_once __DIR__ . '/pdf.php';
include '../../common/php/config.ini.php';
include '../../common/php/lib/db.cls.php';

include '../../modules/php/action/class/projectapp/projectapp.cls.php';

$org_code = $_SESSION['org_code'];
// $org_code = bjqskj001;
$project_id = $_SESSION['project_id'];
// $project_id = kno1450916699;

$projectApp = new ProjectApp();

$res1 = $projectApp->findProOrg($org_code, $project_id, 'pdf');
$res2 = $projectApp->findProjectMean($project_id, 'project_info', 'project_id', 'pdf');
$res3 = $projectApp->findProStatus($project_id, 'project_info' , 'project_id' , 'pdf');
$res4 = $projectApp->findProTarget($project_id,'project_info', 'project_id', 'pdf');
$res5 = $projectApp->findProContent($project_id, 'project_info', 'project_id', '', 'pdf');
$res6 = $projectApp->findProTech($project_id, 'project_info', 'project_id', '', 'pdf');
$res7 = $projectApp->findProAnn('project_ann_plan',$project_id, 'project_id', '', 'pdf');
$res8 = $projectApp->findprojectmoney($project_id,'pdf');
$res9 = $projectApp->findProRisk($project_id,'project_info', 'project_id','pdf');
$res10 = $projectApp->findProExpert($project_id, 'project_info', 'project_id', '','pdf');
$res11 = $projectApp->findProEconomy($project_id, 'project_info', 'project_id','pdf');
$res12 = $projectApp->findProMember($org_code, 'org_info', 'org_code', $project_id,'pdf');

$res1['project_meaning']=$res2['project_meaning'];
$res1['project_status']=$res3['project_status'];
$res1['project_mission']=$res4['project_mission'];
$res1['project_aim']=$res4['project_aim'];
$res1['project_kpi']=$res4['project_kpi'];
$res1['project_content']=$res5['project_content'];
$res1['tech_way']=$res6['tech_way'];
$res1['project_manage']=$res6['project_manage'];
$res1['delegation_task']=$res6['delegation_task'];
$res1 = array_merge($res1,$res7);
$res1 = array_merge($res1,$res8);
$res1['project_risk']=$res9['project_risk'];
$res1['project_expect']=$res10['project_expect'];
$res1['project_effect']=$res11['project_effect'];
$res12['pro_orgname']=$res12['org_name'];
$res12['pro_leadername']=$res12['leader_name'];
$res12['pro_leaderphone']=$res12['leader_phone'];

foreach ($res12 as $key=>$value){
	if($key == 'org_name'||$key == 'leader_name'||$key == 'leader_phone'){
		$res12 = $projectApp->array_remove($res12, $key);
	}
}

$res1 = array_merge($res1,$res12);

// var_dump($res12);
datatopdf('attach1', $res1);
