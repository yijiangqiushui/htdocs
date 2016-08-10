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
//项目承担单位基本信息
$res1 = $projectApp->findProOrg($org_code, $project_id, 'pdf');
//

// $res2 = $projectApp->findProjectMean($project_id, 'project_info', 'project_id', 'pdf');
// $res3 = $projectApp->findProStatus($project_id, 'project_info' , 'project_id' , 'pdf');

//项目任务与目标、考核指标
$res2 = $projectApp->findtaskProjectTarget($project_id,'project_info', 'project_id', 'pdf');
// 主要研究开发内容
$res3 = $projectApp->findtaskProjectContent($project_id, 'project_info', 'project_id',  'pdf');

//、项目技术方案与技术路线
$res4 = $projectApp->findtaskProjectTech($project_id, 'project_info', 'project_id',  'pdf');


//经费
$res5 = $projectApp->findprojectmoney($project_id,'pdf');

//预期成果形式、知识产权归属与管理
$res6 = $projectApp->findtask_ProjectExpert($project_id, 'project_info', 'project_id','pdf');
//其他条款
$res7 = $projectApp->findOtherCondition ( $project_id, 'project_info', 'project_id',"pdf" );
 //项目承担单位、参加单位、主要研究人员 org_name  leader_name leader_phone
$res8=$projectApp->findtask_ProMember ( $org_code, 'org_info', 'org_code', $project_id ,"pdf");
$arr9 = array (
		'pro_orgname' => $res8 ['org_name'],
		'pro_leader_name' => $res8  ['leader_name'],
		'leader_sex' => $res8  ['leader_sex']==0?'男':'女',
		'leader_birth' => $res8 ['leader_birth'],
		'leader_ID' => $res8 ['leader_ID'],
		'tech_pos' => $res8  ['tech_pos'],
		'leader_edu' => $res8  ['leader_edu'],
		'leader_major' => $res8 ['leader_major'],
		'leader_job' => $res8  ['leader_job'],
		'pro_leader_phone' => $res8 ['leader_phone'],
		'leader_address' => $res8  ['leader_address'],
		'leader_postal' => $res8  ['leader_postal'],
		'leader_fax' => $res8  ['leader_fax'],
		'leader_email' => $res8 ['leader_email'],
		'leader_tele' => $res8  ['leader_tele'],
		'leader_achieve' => $res8 ['leader_achieve'],
		// 				'org_name0' => $result_prorg [0] ['org_name'],
// 				'org_name1' => $result_prorg [1] ['org_name'],
// 				'org_name2' => $result_prorg [2] ['org_name'],
// 				'org_mission0' => $result_prorg [0] ['org_duty'],
// 				'org_mission1' => $result_prorg [1] ['org_duty'],
// 				'org_mission2' => $result_prorg [2] ['org_duty']
);
$arr=array_merge(array_merge($res1,$res2),$res3);
$arr["project_mission"]=$res4['project_mission'];
$arr["project_aim"]=$res4['project_aim'];
$arr["project_kpi"]=$res4['project_kpi'];
$arr =array_merge($arr,$res5);
$arr=array_merge($arr,$res6);
$arr=array_merge($arr,$res7);
$arr=array_merge($arr,$arr9);
datatopdf('assignment', $arr);
