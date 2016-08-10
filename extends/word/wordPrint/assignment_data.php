<?php
include '../../../common/php/config.ini.php';
include '../../../common/php/lib/db.cls.php';
require_once __DIR__ . '/../word.php';
include WWWPATH . 'extends/Table/TableData.php';
include '../../../modules/php/action/class/projectapp/projectapp.cls.php';
include '../../../website/php/action/class/projectFile.cls.php';


$org_code = $_SESSION['org_code'];
$project_id = $_SESSION['project_id'];
$user_id = $_SESSION['user_id'];

$db = new DB();
$projectApp = new ProjectApp();
$data = array();
//项目承担单位基本信息
$res1 = $projectApp->findProOrg($org_code, $project_id, 'pdf', $user_id);
if(!empty($res1)){
$data = array_merge($data , $res1);
}

//项目任务与目标、考核指标
$res2 = $projectApp->findtaskProjectTarget($project_id, 'project_info', 'project_id', 'pdf');
if(!empty($res2)){
$data = array_merge($data , $res2);
}
// 主要研究开发内容

$res3 = $projectApp->findtaskProjectContent($project_id, 'project_info', 'project_id', 'pdf');
if(!empty($res3)){
$data = array_merge($data , $res3);
}
// var_dump($res2);
// exit();
//、项目技术方案与技术路线
$res4 = $projectApp->findtaskProjectTech($project_id, 'project_info', 'project_id', 'pdf');
if(!empty($res4)){
$data = array_merge($data , $res4);
}
//经费
$res5 = $projectApp->findprojectmoney($project_id, 'pdf');
if(!empty($res5)){
$data = array_merge($data , $res5);
}

//预期成果形式、知识产权归属与管理
$res6 = $projectApp->findtask_ProjectExpert($project_id, 'project_info', 'project_id', 'pdf');
if(!empty($res6)){
$data = array_merge($data , $res6);
}

//其他条款
$res7 = $projectApp->findOtherCondition($project_id, 'project_info', 'project_id', "pdf");
if(!empty($res7)){
$data = array_merge($data , $res7);
}


//项目各年度任务目标、考核指标及研究开发内容完成的计划进度
$TBL1 = $db -> getDyData('project_ann_plan', 'task_project_id', $project_id);
if(!empty($TBL1)){
	$data['TBL1'] = $TBL1;
}
//项目承担单位、参加单位、主要研究人员 org_name  leader_name leader_phone
$res8 = $projectApp->findtask_ProMember($org_code, 'org_info', 'org_code', $project_id, "pdf");
//print_r($res8);exit();
$arr9 = array(
    'pro_orgname' => $res8 ['org_name'],
    'pro_leader_name' => $res8 ['leader_name'],
    'leader_sex' => $res8 ['leader_sex'] == 0 ? '男' : '女',
    'leader_birth' => $res8 ['leader_birth'],
    'leader_ID' => $res8 ['leader_ID'],
    'tech_pos' => $res8 ['tech_pos'],
    'leader_edu' => $res8 ['leader_edu'],
    'leader_major' => $res8 ['leader_major'],
    'leader_job' => $res8 ['leader_job'],
    'pro_leader_phone' => $res8 ['leader_phone'],
    'leader_address' => $res8 ['leader_address'],
    'leader_postal' => $res8 ['leader_postal'],
    'leader_fax' => $res8 ['leader_fax'],
    'leader_email' => $res8 ['leader_email'],
    'leader_tele' => $res8 ['leader_tele'],
    'leader_achieve' => $res8 ['leader_achieve'],
    'main_division' => $res8 ['main_division'],
    'work_org' => $res8 ['work_org'],
);
if(!empty($arr9)){
$data = array_merge($data , $arr9);
}
//任务书各方
 $res28 = $projectApp->findPlanPartiesevery($org_code,$project_id, "org_info", "org_code","pdf" );
 if(!empty($res28)){
 $data = array_merge($data , $res28);
 } 





// //项目经费预算
//仪器设备购置费用明细
$tableData = TableData::get($project_id, 18);
$temp = $tableData['data'];
if(!empty($temp['eqpt_name'])){
$TBL2 = array(
    'eqpt_name' => $temp['eqpt_name'],
    'eqpt_model' => $temp['eqpt_model'],
    'actual_num' => $temp['actual_num'],
    'actual_pay' => $temp['actual_pay'],
    'fund_src' => $temp['fund_src'],
    'buy_time' => $temp['buy_time'],
    'main_use' => $temp['main_use']
);}
if(!empty($TBL2)){
$data['TBL2'] = $TBL2;
}

//项目参加单位
$TBL3 = $db -> getDyData('project_org', 'task_project_id', $project_id);
if(!empty($TBL3)){
$data['TBL3'] = $TBL3;
}
//主要研究人员
$TBL4 = $db -> getDyData('researchers', 'task_project_id', $project_id);
if(!empty($TBL4)){

$data['TBL4'] =$TBL4;
}
//项目经费预算
$tableData2 = TableData::get($project_id, 18);
$temp2 = $tableData2['data'];

if(!empty($temp2['year'])){
foreach ($temp2['year'] as $key => $value){
    $res13['year'.$key] = $value;
}}

if(!empty($res13)){
$data = array_merge($data , $res13);
}

if(!empty($temp2['total1_fund'])){
foreach ($temp2['total1_fund'] as $key => $value){
    $res14['total1_fund'.$key] = $value;
}}

if(!empty($res14)){
$data = array_merge($data , $res14);
}


if(!empty($res14)){
foreach ($temp2['total2_fund'] as $key => $value){
    $res15['total2_fund'.$key] = $value;
}}

if(!empty($res15)){
$data = array_merge($data , $res15);
}

if(!empty($temp2['total3_fund'])){
foreach ($temp2['total3_fund'] as $key => $value){
    $res16['total3_fund'.$key] = $value;
}}

if(!empty($res16)){
$data = array_merge($data , $res16);
}

if(!empty($temp2['year_total'])){
foreach ($temp2['year_total'] as $key => $value){
    $res17['year_total'.$key] = $value;
}}


if(!empty($res17)){
$data = array_merge($data , $res17);
}


if(!empty($temp2['year_total'])){
foreach ($temp2['year_total'] as $key => $value){
    $res17['year_total'.$key] = $value;
}}

if(!empty($res17)){
$data = array_merge($data , $res17);
}


$res17['total_total'] = $temp['total_total'];

if(!empty($res18['p_m_year'])){
foreach ($temp2['p_m_year'] as $key => $value){
    $res18['p_m_year'.$key] = $value;
}}

if(!empty($res18)){
$data = array_merge($data , $res18);
}


if(!empty($temp2['teach1_fund'])){
foreach ($temp2['teach1_fund'] as $key => $value){
    $res19['teach1_fund'.$key] = $value;
}}

if(!empty($res19)){
$data = array_merge($data , $res19);}


if(!empty($temp2['teach2_fund'])){
foreach ($temp2['teach2_fund'] as $key => $value){
    $res20['teach2_fund'.$key] = $value;
}}

if(!empty($res20)){
$data = array_merge($data , $res20);}


if(!empty($temp2['teach3_fund'])){
foreach ($temp2['teach3_fund'] as $key => $value){
    $res21['teach3_fund'.$key] = $value;
}}

if(!empty($res21)){
$data = array_merge($data , $res21);}


if(!empty($temp2['other1_fund'])){
foreach ($temp2['other1_fund'] as $key => $value){
    $res22['other1_fund'.$key] = $value;
}}


if(!empty($res22)){
$data = array_merge($data , $res22);}



if(!empty($temp2['other2_fund'])){
foreach ($temp2['other2_fund'] as $key => $value){
    $res23['other2_fund'.$key] = $value;
}}

if(!empty($res23)){
$data = array_merge($data , $res23);
}


if(!empty($temp2['other3_fund'])){
foreach ($temp2['other3_fund'] as $key => $value){
    $res24['other3_fund'.$key] = $value;
}}
 
if(!empty($res24)){
$data = array_merge($data , $res24);}


if(!empty($temp2['teach_actual_fund'] )){
foreach ($temp2['teach_actual_fund'] as $key => $value){
    $res25['teach_actual_fund'.$key] = $value;
}}

if(!empty($res25)){
$data = array_merge($data , $res25);}


//获取附件信息
$project_file_obj = new projectFile();
$project_file_obj = $project_file_obj->get_attach_lists($project_id,12);
$attach = array();
if(!empty($project_file_obj)){
	foreach($project_file_obj as $item){
		foreach($item as $key => $value){
			$attach[$key][] = $value;
		}
	}
}
if(!empty($attach)){
	$count=0;
	foreach ($attach["introduction"] as $val){ 
		$attach["introduction"][$count]=($val==null?"无":$val);
		$count++;
	}
	$data['ATTACH'] = $attach;
}

	
for($i=1 ; $i<=5 ; $i++){
    $res26['total'.$i] = $temp2['total'.$i];
}
$res26['total_other'] = $temp2['total_other'];
$res26['project_match'] = $temp2['project_match'];
$res26['total_total'] = $temp2['total_total'];

if(!empty($res26)){
    $data = array_merge($data , $res26);
}


//添加封皮儿内容

$res27=$projectApp->getProjectInfo($project_id);
if(!empty($res27)){
	$data = array_merge($data , $res27);
}



echo datatoword($data, '12.docx', 12);
