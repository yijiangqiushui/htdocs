<?php
include '../../../../../center/php/config.ini.php';
include '../../../../../common/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';
include '../../class/applycation/apply.cls.php';

include '../../../../../common/php/plugin/fenci_v1.0_utf8/checkduplicate.cls.php';

$action = $_GET ['action'];
$page = $_POST ['page'];
$rows = $_POST ['rows'];

// 申请单位基本信息
// project_id and org_id
$project_id = $_SESSION ['project_id'];
// $project_id = '0123456';
$org_code = $_SESSION ['org_code'];

$applyinfo ['org_name'] = $_POST ['org_name'];
//var_dump($applyinfo ['org_name']);exit;
$applyinfo ['org_code'] = $org_code;
$applyinfo ['relationship'] = $_POST ['relationship'];
$applyinfo ['legal_person'] = $_POST ['legal_person'];
$applyinfo ['org_type'] = $_POST ['org_type'];
$applyinfo ['org_address'] = $_POST ['org_address'];
$applyinfo ['register_town'] = $_POST ['register_town'];
$applyinfo ['register_time'] = $_POST ['register_time'];
$applyinfo ['postal'] = $_POST ['postal'];
$applyinfo ['fax'] = $_POST ['fax'];
$applyinfo ['email'] = $_POST ['email'];
$applyinfo ['certi_code'] = $_POST ['certi_code'];
$applyinfo ['develop_area'] = $_POST ['develop_area'];
$applyinfo ['org_leader'] = $_POST ['org_leader'];
$applyinfo ['leader_contact'] = $_POST ['leader_contact'];
$applyinfo ['dev_leader'] = $_POST ['dev_leader'];
$applyinfo ['dev_contact'] = $_POST ['dev_contact'];
$applyinfo ['finance_leader'] = $_POST ['finance_leader'];
$applyinfo ['finance_contact'] = $_POST ['finance_contact'];
$applyinfo ['linkman'] = $_POST ['linkman'];
$applyinfo ['linkman_contact'] = $_POST ['linkman_contact'];
$applyinfo ['ratification_num'] = $_POST ['ratification_num'];

$shareholder_info ['org_code'] = $_POST ['org_code'];
$shareholder_info ['shareholder_name'] = $_POST ['shareholder_name'];
$shareholder_info ['stock_ratio'] = $_POST ['stock_ratio'];

/* service_team 数据库的名字是team_form */

/* project_mean */
$project_mean ['project_id'] = $project_id;
$project_mean ['project_meaning'] = $_POST ['project_meaning'];

/* project_status */
$project_status ['project_id'] = $project_id;
$project_status ['project_status'] = $_POST ['project_status'];

/* project_target */
$project_target ['project_id'] = $project_id;
$project_target ['project_mission'] = $_POST ['project_mission'];
$project_target ['project_aim'] = $_POST ['project_aim'];
$project_target ['project_kpi'] = $_POST ['project_kpi'];

/* project_content */
$project_content ['project_id'] = $project_id;
$project_content ['project_content'] = $_POST ['project_content'];

/* project_techway */
$project_techway ['project_id'] = $project_id;
$project_techway ['tech_way'] = $_POST ['tech_way'];
$project_techway ['project_manage'] = $_POST ['project_manage'];
$project_techway ['delegation_task'] = $_POST ['delegation_task'];

/* equipment_list */
$equipment_list ['project_id'] = $equipment_list;
$equipment_list ['equipment_name'] = $_POST ['equipment_name'];
$equipment_list ['equipment_num'] = $_POST ['equipment_num'];
$equipment_list ['equipment_price'] = $_POST ['equipment_price'];
$equipment_list ['equipment_fund'] = $_POST ['equipment_fund'];

/* instrument_list */
$instrument_list ['project_id'] = $equipment_list;
$instrument_list ['test_name'] = $_POST ['test_name'];
$instrument_list ['test_num'] = $_POST ['test_num'];
$instrument_list ['test_price'] = $_POST ['test_price'];
$instrument_list ['test_fund'] = $_POST ['test_fund'];

/* check_material */
$check_material ['project_id'] = $check_material;
$check_material ['factory_area'] = $_POST ['factory_area'];
$check_material ['factory_sum'] = $_POST ['factory_sum'];
$check_material ['rebuild_area'] = $_POST ['rebuild_area'];
$check_material ['rebuild_sum'] = $_POST ['rebuild_sum'];



/* project_ann */
$project_ann = array ();
$plan_year = ( array ) $_POST ['plan_year'];
$plan_content = ( array ) $_POST ['plan_content'];
$count=0;
foreach ($plan_year as $val){
	$project_ann [$count] ['project_id'] = $project_id;
	$project_ann [$count] ['plan_year'] = $plan_year [$count];
	$project_ann [$count] ['plan_content'] = $plan_content [$count];
	$count++;
}
//print_r ( $project_ann )
/* task_project_ann */
$task_project_ann = array ();
$plan_year = ( array ) $_POST ['plan_year'];
$plan_content = ( array ) $_POST ['plan_content'];
$count =0;
foreach ($plan_year as $val){
    $task_project_ann [$count] ['task_project_id'] = $project_id;
    $task_project_ann [$count] ['task_plan_year'] = $plan_year [$count];
    $task_project_ann [$count] ['task_plan_content'] = $plan_content [$count];
    $count++;
}


/* project_risk */
$project_risk ['project_id'] = $project_id;
$project_risk ['project_risk'] = $_POST ['project_risk'];

/* project_expect */
$project_expect ['project_id'] = $project_id;
$project_expect ['project_expect'] = $_POST ['project_expect'];

/* project_effect */
$project_effect ['project_id'] = $project_id;
$project_effect ['project_effect'] = $_POST ['project_effect'];

/*  project_member   不知道为什么改成readonly了  所以就那个什么吧   不入库了
// 主要承担单位 ？
$bear_org_name ['project_id'] = $project_id;
$bear_org_name ['bear_org_name'] = $_POST ['bear_org_name']; // 项目承担单位编号暂时没有入库

//task_project_member
// 主要承担单位 ？
$bear_org_name ['project_id'] = $project_id;
$task_bear_org_name ['task_bear_org_name'] = $_POST ['bear_org_name']; // 项目承担单位编号暂时没有入库
    
 */


// 参与单位 // project_org 表4、项目研究人员
$org_name = (array)$_POST ['org_name'];
$org_mission = (array)$_POST ['org_mission'];

$length = 0;

foreach ( $org_name as $val ) {
	$project_org [$length] ['project_id'] = $project_id;
	$project_org [$length] ['org_name'] = $org_name [$length];
	$project_org [$length] ['org_duty'] = $org_mission [$length];
	$length ++;
}


// 参与单位 // project_org 表4、项目研究人员
// $org_name = (array)$_POST ['org_name'];
// $org_mission = (array)$_POST ['org_mission'];

// $length = 0;
// foreach ( $org_name as $val ) {
// 	$task_project_org [$length] ['task_project_id'] = $project_id;
// 	$task_project_org [$length] ['org_name'] = $org_name [$length];
// 	$task_project_org [$length] ['org_duty'] = $org_mission [$length];
// 	$length ++;
// }


$project_leader ['project_id'] = $project_id;
$project_leader ['leader_name'] = $_POST ['leader_name'];
$project_leader ['leader_sex'] = $_POST ['leader_sex'];
$leader_year = $_POST['leader_year'];
$leader_month = $_POST['leader_month'];
$leader_birth = $leader_year.'-'.$leader_month;
$project_leader ['leader_birth'] = $leader_birth;
$project_leader ['leader_ID'] = $_POST ['leader_ID'];
$project_leader['tech_pos'] = $_POST['tech_pos']; 
$project_leader['leader_edu'] = $_POST['leader_edu'];
$project_leader['leader_major'] = $_POST['leader_major'];
$project_leader['leader_job'] = $_POST['leader_job'];
$project_leader['leader_phone'] = $_POST['leader_phone'];
$project_leader['leader_address'] = $_POST['leader_address'];
$project_leader['leader_postal'] = $_POST['leader_postal'];
$project_leader['leader_fax'] = $_POST['leader_fax'];
$project_leader['leader_tele'] = $_POST['leader_tele'];
$project_leader['leader_achieve'] = $_POST['leader_achieve'];
$project_leader['leader_email'] = $_POST['leader_email'];


$task_project_leader ['task_project_id'] = $project_id;
$task_project_leader ['leader_name'] = $_POST ['leader_name'];
$task_project_leader ['leader_sex'] = $_POST ['leader_sex'];
$task_project_leader ['leader_birth'] = $leader_birth;;
$task_project_leader['leader_edu'] = $_POST['leader_edu'];
$task_project_leader['leader_job'] = $_POST['leader_job'];
$task_project_leader['leader_major'] = $_POST['leader_major'];
$task_project_leader['main_division'] = $_POST['main_division'];
$task_project_leader['work_org'] = $_POST['work_org'];
// var_dump($project_leader);
// exit();


// task_参与单位 // project_org 表
$org_name = (array)$_POST ['org_name'];
$org_mission = (array)$_POST ['org_mission'];

$length = 0;
foreach ( $org_name as $val ) {
	$task_project_org [$length] ['task_project_id'] = $project_id;
	$task_project_org [$length] ['org_name'] = $org_name [$length];
	$task_project_org [$length] ['org_duty'] = $org_mission [$length];
	$length ++;
}
//var_dump($project_org);

/* 
//task_4、项目研究人员
$task_project_leader ['project_id'] = $project_id;
$task_project_leader ['leader_name'] = $_POST ['leader_name'];
$task_project_leader ['leader_sex'] = $_POST ['leader_sex'];
$task_project_leader ['leader_birth'] = $_POST ['leader_birth'];
$task_project_leader ['leader_ID'] = $_POST ['leader_ID'];
$task_project_leader['tech_pos'] = $_POST['tech_pos'];
$task_project_leader['leader_edu'] = $_POST['leader_edu'];
$task_project_leader['leader_major'] = $_POST['leader_major'];
$task_project_leader['leader_job'] = $_POST['leader_job'];
$task_project_leader['leader_phone'] = $_POST['leader_phone'];
$task_project_leader['leader_address'] = $_POST['leader_address'];
$task_project_leader['leader_postal'] = $_POST['leader_postal'];
$task_project_leader['leader_fax'] = $_POST['leader_fax'];
$task_project_leader['leader_tele'] = $_POST['leader_tele'];
$task_project_leader['leader_achieve'] = $_POST['leader_achieve'];
$task_project_leader['leader_email'] = $_POST['leader_email'];
$task_project_leader ['leader_achieve'] = $_POST ['leader_achieve'];
 */


// 获取当前专家的人数
$researcher_num = $_POST ['txtTRLastIndex'];

// 获取当前的列表信息
$researcher_name = ( array ) $_POST ['researcher_name'];
$researcher_sex = ( array ) $_POST ['researcher_sex'];
$year = (array)$_POST['year'];
$month = (array)$_POST['month'];
// $researcher_birth = ( array ) $_POST ['researcher_birth'];
$researcher_ID = ( array ) $_POST ['researcher_ID'];
$researcher_pos = ( array ) $_POST ['researcher_pos'];
$researcher_job = ( array ) $_POST ['researcher_job'];
$researcher_edu = ( array ) $_POST ['researcher_edu'];
$researcher_major = ( array ) $_POST ['researcher_major'];
$researcher_work = ( array ) $_POST ['researcher_work'];
$researcher_org = ( array ) $_POST ['researcher_org'];
$project_researcher = array ();
$researcher_num = 0;
global $global_sex;
global $global_edu;
foreach ( $researcher_name as $val ) {
	$project_researcher [$researcher_num] ['project_id'] = $project_id;
	$project_researcher [$researcher_num] ['researcher_name'] = $researcher_name [$researcher_num];
	$project_researcher [$researcher_num] ['researcher_sex'] = $researcher_sex[$researcher_num];
// 	$project_researcher [$researcher_num] ['researcher_birth'] = $researcher_birth [$researcher_num];
	$project_researcher [$researcher_num] ['researcher_birth'] = $year[$researcher_num].'-'.$month[$researcher_num];
	$project_researcher [$researcher_num] ['researcher_ID'] = $researcher_ID [$researcher_num];
	$project_researcher [$researcher_num] ['researcher_pos'] = $researcher_pos [$researcher_num];
	$project_researcher [$researcher_num] ['researcher_job'] = $researcher_job [$researcher_num];
	$project_researcher [$researcher_num] ['researcher_edu'] = $researcher_edu [$researcher_num];
	$project_researcher [$researcher_num] ['researcher_major'] = $researcher_major [$researcher_num];
	$project_researcher [$researcher_num] ['researcher_work'] = $researcher_work [$researcher_num];
	$project_researcher [$researcher_num] ['researcher_org'] = $researcher_org [$researcher_num];
	$researcher_num = $researcher_num + 1;
}
//var_dump($project_researcher);exit;

// task_ 获取当前的列表信息
$researcher_num = 0;
$task_project_researcher = array ();
foreach ( $researcher_name as $val ) {
	$task_project_researcher [$researcher_num] ['task_project_id'] = $project_id;
	$task_project_researcher [$researcher_num] ['researcher_name'] = $researcher_name [$researcher_num];
	$task_project_researcher [$researcher_num] ['researcher_sex'] = $researcher_sex [$researcher_num];
	$task_project_researcher [$researcher_num] ['researcher_birth'] = $year[$researcher_num].'-'.$month[$researcher_num];
	$task_project_researcher [$researcher_num] ['researcher_ID'] = $researcher_ID [$researcher_num];
	$task_project_researcher [$researcher_num] ['researcher_pos'] = $researcher_pos [$researcher_num];
	$task_project_researcher [$researcher_num] ['researcher_job'] = $researcher_job [$researcher_num];
	$task_project_researcher [$researcher_num] ['researcher_edu'] = $researcher_edu [$researcher_num];
	$task_project_researcher [$researcher_num] ['researcher_major'] = $researcher_major [$researcher_num];
	$task_project_researcher [$researcher_num] ['researcher_work'] = $researcher_work [$researcher_num];
	$task_project_researcher [$researcher_num] ['researcher_org'] = $researcher_org [$researcher_num];
	$researcher_num = $researcher_num + 1;
}

// expert_sign
$expert_list = array ();
$expert_name = ( array ) $_POST ['expert_name'];
$expert_divide = ( array ) $_POST ['expert_divide'];
$expert_org = ( array ) $_POST ['expert_org'];
$expert_id = ( array ) $_POST ['expert_id'];
$expert_job = ( array ) $_POST ['expert_job'];
$expert_major = ( array ) $_POST ['expert_major'];
$expert_phone = ( array ) $_POST ['expert_phone'];
$expert_sign = ( array ) $_POST ['expert_sign'];
$expert_num = 0;
foreach ( $expert_name as $val ) {
	$expert_list [$expert_num] ['project_id'] = $project_id;
	$expert_list [$expert_num] ['expert_name'] = $val;
	$expert_list [$expert_num] ['expert_divide'] = $expert_divide [$expert_num];
	$expert_list [$expert_num] ['expert_org'] = $expert_org [$expert_num];
	$expert_list [$expert_num] ['expert_id'] = $expert_id [$expert_num];
	$expert_list [$expert_num] ['expert_job'] = $expert_job [$expert_num];
	$expert_list [$expert_num] ['expert_major'] = $expert_major [$expert_num];
	$expert_list [$expert_num] ['expert_phone'] = $expert_phone [$expert_num];
	$expert_list [$expert_num] ['expert_sign'] = $expert_sign [$expert_num];
	$expert_num = $expert_num + 1;
}

//这几个就先不存储了  暂时没有字段
$project_info['project_name']=$_POST['project_name'];
//$project_info['project_id']=$_POST['project_id'];
//$project_info['project_org']=$_POST['project_org'];
$project_info['project_leader']=$_POST['project_leader'];
$project_info['project_zxzj_name']=$_POST['project_money'];
$project_info['project_lzsj']=$_POST['project_argument_time'];
$project_info['org_code']=$org_code;
//project_argument_time 论证时间  ，  project_money    所属资金专项名称


// $applyinfo['year']=$_POST['year'];

$score ['creative'] = $_POST ['creative'];
$score ['scientific'] = $_POST ['scientific'];
$score ['difficulty'] = $_POST ['difficulty'];
$score ['advanced'] = $_POST ['advanced'];
$score ['benefits'] = $_POST ['benefits'];
$score ['effectiveness'] = $_POST ['effectiveness'];
$score ['prospect'] = $_POST ['prospect'];
$score ['popularize'] = $_POST ['popularize'];
$score ['closes'] = $_POST ['closes'];
$score ['affect'] = $_POST ['affect'];
$score ['property'] = $_POST ['property'];
$score ['technology'] = $_POST ['technology'];
$score ['expertId'] = $_SESSION ['admin_id'];

$brief ['proBrief'] = $_POST ['proBrief'];
$brief ['app_id'] = $_SESSION ['app_id'];

$create ['proCreat'] = $_POST ['proCreat'];
$create ['app_id'] = $_SESSION ['app_id'];

$upper_cat = $_POST ['upper_cat'];
$con_cat = $_GET ['con_cat'];
$num = $_POST ['num'];

$id = $_GET ['id'];
$str = $_GET ['str'];
$flag = $_GET ['flag'];
$applyId = $_GET ['applyId'];
$proState ['proState'] = $_POST ['proState'];
$proState ['checkAdvice'] = $_POST ['checkAdvice'];

$appInfo ['id'] = $_POST ['id'];
$appInfo ['advice'] = $_POST ['checkAdvice'];
$appInfo ['state'] = $_POST ['isCheck'];
$appInfo ['advice5'] = $_POST ['advice_award'];
$appInfo ['state5'] = $_POST ['isCheck_award'];
$appInfo ['advice6'] = $_POST ['advice_unit'];
$appInfo ['state6'] = $_POST ['isCheck_unit'];
$appInfo ['advice7'] = $_POST ['advice_peo'];
$appInfo ['state7'] = $_POST ['isCheck_peo'];
$appInfo ['advice8'] = $_POST ['advice_proof'];
$appInfo ['state8'] = $_POST ['isCheck_proof'];
$appInfo ['advice10'] = $_POST ['advice_attpf'];
$appInfo ['state10'] = $_POST ['isCheck_attpf'];

$appBrief ['id'] = $_POST ['id'];
$appBrief ['advice2'] = $_POST ['checkAdvice'];
$appBrief ['state2'] = $_POST ['isCheck'];

$appCreate ['id'] = $_POST ['id'];
$appCreate ['advice3'] = $_POST ['checkAdvice'];
$appCreate ['state3'] = $_POST ['isCheck'];
$apply = new APPLY ();
switch ($action) {
	case 'saveApplication' :
		$apply->org_info ( 'org_info', $applyinfo, $org_code, 'org_code' );
		break;
	case 'project_mean' :
		$apply->project_mean ( 'project_info', $project_id, $project_mean );
		break;
	case 'project_status' :
		$apply->project_status ( 'project_info', $project_id, $project_status );
		break;
	case 'project_target' :
		$apply->project_target ( 'project_info', $project_id, $project_target);
		break;
	case 'project_content' :
		$apply->project_content ( 'project_info', $project_id, $project_content);
		break;
	case 'project_techway' :
		$apply->project_techway ( 'project_info', $project_id, $project_techway);
	case 'project_ann' :
		$apply->project_ann ( 'project_ann_plan', $project_id, $project_ann);
		break;
	case 'task_project_ann' :
	    $apply->task_project_ann ( 'project_ann_plan', $project_id, $task_project_ann);
	    break;
	case 'project_risk' :
		$apply->project_risk ( 'project_info', $project_id, $project_risk);
		break;
	case 'project_effect' :
		$apply->project_effect ( 'project_info', $project_id, $project_effect);
		break;
	
	case 'saveSign' :
		//saveSign 
		$apply->expert_sign ( 'experts', $project_id, $expert_list,$project_info);
		break;
	
	case 'project_expect' :
		$apply->project_expect ( 'project_info', $project_id, $project_expect);
		break;
	
	case 'project_member' :
		
		// $apply->project_member('project_org','researchers',$project_id,$project_joinorg,$project_leader,$project_researcher);
		$apply->project_member (  'researchers',$project_leader, $project_id, $project_researcher,  $project_org );
		break;
	case 'task_project_member' :
		    // $apply->project_member('project_org','researchers',$project_id,$project_joinorg,$project_leader,$project_researcher);
		  $apply->task_project_member (  'researchers',$task_project_leader, $project_id, $task_project_researcher,  $task_project_org );
		    break;
	case 'umit_provement':
		$apply->unit_provement ( '', $check_material, $instrument_list, $equipment_list );
	
	case 'uptApply' :
		$apply->uptApply ( $applyinfo, $id, $flag );
		break;
	case 'saveBrief' :
		$apply->saveBrief ( $brief );
		break;
	case 'uptBrief' :
		$apply->uptBrief ( $brief, $id, $flag );
		break;
	case 'saveCreate' :
		$apply->saveCreate ( $create );
		break;
	case 'uptCreate' :
		$apply->uptCreate ( $create, $id );
		break;
	case 'queryApply' :
		$apply->queryApply ( $applyinfo );
		break;
	case 'checkApply' :
		$apply->checkApply ( $id );
		break;
	case 'scoreApply' :
		$apply->scoreApply ( $id, $score );
		break;
	case 'getScore' :
		$apply->getScore ( $applyId );
		break;
	case 'queryScore' :
		$apply->queryScore ( $id );
		break;
	case 'queryRecOrg' :
		$apply->queryRecOrg ();
		break;
	case 'findApply' :
		$apply->findApply ( $id );
		break;
	case 'findBrief' :
		$apply->findBrief ( $id );
		break;
	case 'findCreate' :
		$apply->findCreate ( $id );
		break;
	case 'findDetail' :
		$apply->findDetail ( $id );
		break;
	case 'findRecommend' :
		$apply->findRecommend ( $id );
		break;
	case 'checkAppInfo' :
		$apply->checkAppInfo ( $appInfo );
		break;
	case 'checkBrief' :
		$apply->checkBrief ( $appBrief );
		break;
	case 'checkCreate' :
		$apply->checkCreate ( $appCreate );
		break;
	case 'checkAward' :
		$apply->checkAward ( $appInfo );
		break;
	case 'checkUnit' :
		$apply->checkUnit ( $appInfo );
		break;
	case 'checkPeople' :
		$apply->checkPeople ( $appInfo );
		break;
	case 'checkProof' :
		$apply->checkProof ( $appInfo );
		break;
	case 'checkDetail2' :
		$apply->checkDetail2 ( $appInfo );
		break;
	case 'findApplyInfo' :
		$apply->findApplyInfo ();
		break;
	case 'findBriefInfo' :
		$apply->findBriefInfo ();
		break;
	case 'findCreatInfo' :
		$apply->findCreatInfo ();
		break;
	case 'findDetailInfo' :
		$apply->findDetailInfo ();
		break;
	case 'resetCheck' :
		$apply->resetCheck ( $id, $str );
		break;
	case 'uptProState' :
		$apply->uptProState ( $id, $proState );
		break;
	case 'queryExpertList' :
		$apply->queryExpertList ();
		break;
	case 'queryYear' :
		$apply->queryYear ();
		break;
	case 'queryScience' :
		$apply->queryScience ();
		break;
	case 'queryEconomic' :
		$apply->queryEconomic ();
		break;
	case 'arrClassify' :
		$idlist = $_GET ['idlist'];
		$expertTeam = $_GET ['expertTeam'];
		$apply->arrClassify ( $idlist, $expertTeam );
		break;
	case 'queryRepeat' :
		$id = $_GET ['id'];
		$page = $_POST ['page'];
		$rows = $_POST ['rows'];
		
		$apply->queryRepeat ( $id, $page, $rows );
		break;
	case 'queryScoreCat' :
		$expertCat = $_POST ['expertCat'];
		$apply->queryScoreCat ( $expertCat );
		break;
	
	    
}

?>