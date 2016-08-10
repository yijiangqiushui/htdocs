<?php
include '../../../../../common/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';
//include '../../class/projectapp/projectapp.cls.php';
include '../../../../../modules/php/action/class/center/center.cls.php';
include '../../../../../common/php/plugin/fenci_v1.0_utf8/checkduplicate.cls.php';
include __DIR__ . '/../../../../../extends/common/common.php';
include '../../../../../common/php/lib/log.cls.php';

$action = $_GET ['action'];
$name = $_GET ['name'];
// project_id值设置
$project_id = $_SESSION ['project_id'];

 //echo $project_id;
$org_code = $_SESSION ['org_code'];

//对勾 



//后台approve 修改项目基本信息
// $changeOk['project_id'] = $project_id;
$changeOk['project_name'] = $_POST['project_name'];
$changeOk['tech_area'] = $_POST['tech_area'];
$changeOk['project_engineer'] = $_POST['project_engineer'];

$updateinfo['project_id'] = $_POST['project_id'];
$updateinfo['project_name'] = $_POST['project_name'];
$updateinfo['tech_area'] = $_POST['tech_area'];
$updateinfo['project_engineer'] = $_POST['project_engineer'];
$updateinfo['start_time'] = strtotime($_POST['start_time']);
$updateinfo['end_time'] = strtotime($_POST['end_time']);


/* org_info */
$applyinfo ['org_code'] = $org_code;
$applyinfo ['org_name'] = $_POST ['org_name'];
$applyinfo ['org_code'] = $_POST ['org_code'];
$applyinfo ['relationship'] = $_POST ['relationship'];
$applyinfo ['legal_person'] = $_POST ['legal_person'];
$applyinfo ['org_type'] = $_POST ['org_type'];
$applyinfo ['contact_address'] = $_POST ['contact_address'];
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

$linkmanInfo["linkman"]= $_POST ['linkman'];
$linkmanInfo["linkman_contact"]=$_POST ['linkman_contact'];

$project_principle ['project_id'] = $project_id;
$project_principle ['leader_name'] = $_POST ['leader_name']; // !!!!
$project_principle ['leader_phone'] = $_POST ['leader_phone'];

/* project_mean */
$project_mean ['project_id'] = $project_id;
// $project_mean ['project_meaning'] = str_replace('<br />', '\r\n',nl2br($_POST ['project_meaning']));

$project_mean ['project_meaning'] = $_POST ['project_meaning'];

$project_mean ['org_code'] = $org_code;
/* project_status */
$project_status ['project_id'] = $project_id;
$project_status ['project_status'] = $_POST ['project_status'];
$project_status ['org_code'] = $org_code;

/* project_target */
$project_target ['project_id'] = $project_id;
$project_target ['project_mission'] = $_POST ['project_mission'];
$project_target ['project_aim'] = $_POST ['project_aim'];
$project_target ['project_kpi'] = $_POST ['project_kpi'];
$project_target ['org_code'] = $org_code;


/*task_project_target */
$task_project_target ['project_id'] = $project_id;
$task_project_target ['task_project_mission'] = $_POST ['project_mission'];
$task_project_target ['task_project_aim'] = $_POST ['project_aim'];
$task_project_target ['task_project_kpi'] = $_POST ['project_kpi'];


/* project_content */
$project_content ['project_id'] = $project_id;
$project_content ['project_content'] = $_POST ['project_content'];
$project_content ['org_code'] = $org_code;

/*task_project_content */
$task_project_content ['project_id'] = $project_id;
$task_project_content ['task_project_content'] = $_POST ['project_content'];

/* project_techway */
$project_techway ['project_id'] = $project_id;
$project_techway ['tech_way'] = $_POST ['tech_way'];
$project_techway ['project_manage'] = $_POST ['project_manage'];
$project_techway ['delegation_task'] = $_POST ['delegation_task'];
$project_techway ['org_code'] = $org_code;

/* task_project_techway */
$task_project_techway ['project_id'] = $project_id;
$task_project_techway ['task_tech_way'] = $_POST ['tech_way'];
$task_project_techway ['task_project_manage'] = $_POST ['project_manage'];
$task_project_techway ['task_delegation_task'] = $_POST ['delegation_task'];


/* project_ann */
$project_ann [0] ['project_id'] = $project_id;
$project_ann [0] ['plan_year'] = $_POST ['plan_year1'];
$project_ann [0] ['plan_content'] = $_POST ['plan_content1'];
$project_ann [1] ['project_id'] = $project_id;
$project_ann [1] ['plan_year'] = $_POST ['plan_year2'];
$project_ann [1] ['plan_content'] = $_POST ['plan_content2'];
$project_ann [2] ['project_id'] = $project_id;
$project_ann [2] ['plan_year'] = $_POST ['plan_year3'];
$project_ann [2] ['plan_content'] = $_POST ['plan_content3'];

/* project_risk */
$project_risk ['project_id'] = $project_id;
$project_risk ['project_risk'] = $_POST ['project_risk'];
$project_risk ['org_code'] = $org_code;

/* project_expect */
$project_expect ['project_id'] = $project_id;
$project_expect ['project_expect'] = $_POST ['project_expect'];

/*task_project_expect */
$task_project_expect['project_id'] = $project_id;
$task_project_expect['task_project_expect'] = $_POST ['project_expect'];

/* project_effect */
$project_effect ['project_id'] = $project_id;
$project_effect ['project_effect'] = $_POST ['project_effect'];

/* project_member */
$project_joinorg [0] ['project_id'] = $project_id;
$project_joinorg [0] ['org_name'] = $_POST ['org_name0'];
$project_joinorg [0] ['org_duty'] = $_POST ['org_mission0'];
$project_joinorg [1] ['project_id'] = $project_id;
$project_joinorg [1] ['org_name'] = $_POST ['org_name1'];
$project_joinorg [1] ['org_duty'] = $_POST ['org_mission1'];
$project_joinorg [2] ['project_id'] = $project_id;
$project_joinorg [2] ['org_name'] = $_POST ['org_name2'];
$project_joinorg [2] ['org_duty'] = $_POST ['org_mission2'];

$project_leader ['project_id'] = $project_id;
$project_leader ['leader_name'] = $_POST ['leader_name']; // !!!
$project_leader ['leader_sex'] = $_POST ['leader_sex'];
$project_leader ['leader_birth'] = $_POST ['leader_birth'];
$project_leader ['leader_ID'] = $_POST ['leader_ID'];
// $project_leader['tech_pos'] = $_POST['tech_pos']; 2015.09.29注释
$project_leader ['leader_edu'] = $_POST ['leader_edu'];
$project_leader ['leader_major'] = $_POST ['leader_major'];
$project_leader ['leader_job'] = $_POST ['leader_job'];
$project_leader ['leader_phone'] = $_POST ['leader_phone'];
$project_leader ['leader_address'] = $_POST ['leader_address'];
$project_leader ['leader_postal'] = $_POST ['leader_postal'];
$project_leader ['leader_fax'] = $_POST ['leader_fax'];
$project_leader ['leader_tele'] = $_POST ['leader_tele'];
$project_leader ['leader_achieve'] = $_GET ['leader_achieve'];

$project_org ['project_id'] = $project_id;
$project_org ['org_name'] = $_POST ['org_name']; // 项目承担单位编号暂时没有入库


$task_project_org ['task_project_id'] = $project_id;
$task_project_org ['task_org_name'] = $_POST ['org_name']; // 项目承担单位编号暂时没有入库



$project_researcher [0] ['project_id'] = $project_id;
$project_researcher [0] ['researcher_name'] = $_POST ['researcher_name'];
$project_researcher [0] ['researcher_sex'] = $_POST ['researcher_sex'];
$project_researcher [0] ['researcher_birth'] = $_POST ['researcher_birth'];
$project_researcher [0] ['researcher_ID'] = $_POST ['researcher_ID'];
$project_researcher [0] ['researcher_pos'] = $_POST ['researcher_pos'];
$project_researcher [0] ['researcher_job'] = $_POST ['researcher_job'];
$project_researcher [0] ['researcher_edu'] = $_POST ['researcher_edu'];
$project_researcher [0] ['researcher_major'] = $_POST ['researcher_major'];
$project_researcher [0] ['researcher_work'] = $_POST ['researcher_work'];
$project_researcher [0] ['researcher_org'] = $_POST ['researcher_org'];

$project_researcher [1] ['project_id'] = $project_id;
$project_researcher [1] ['researcher_name'] = $_POST ['researcher_name1'];
$project_researcher [1] ['researcher_sex'] = $_POST ['researcher_sex1'];
$project_researcher [1] ['researcher_birth'] = $_POST ['researcher_birth1'];
$project_researcher [1] ['researcher_ID'] = $_POST ['researcher_ID1'];
$project_researcher [1] ['researcher_pos'] = $_POST ['researcher_pos1'];
$project_researcher [1] ['researcher_job'] = $_POST ['researcher_job1'];
$project_researcher [1] ['researcher_edu'] = $_POST ['researcher_edu1'];
$project_researcher [1] ['researcher_major'] = $_POST ['researcher_major1'];
$project_researcher [1] ['researcher_work'] = $_POST ['researcher_work1'];
$project_researcher [1] ['researcher_org'] = $_POST ['researcher_org1'];

$project_researcher [2] ['project_id'] = $project_id;
$project_researcher [2] ['researcher_name'] = $_POST ['researcher_name2'];
$project_researcher [2] ['researcher_sex'] = $_POST ['researcher_sex2'];
$project_researcher [2] ['researcher_birth'] = $_POST ['researcher_birth2'];
$project_researcher [2] ['researcher_ID'] = $_POST ['researcher_ID2'];
$project_researcher [2] ['researcher_pos'] = $_POST ['researcher_pos2'];
$project_researcher [2] ['researcher_job'] = $_POST ['researcher_job2'];
$project_researcher [2] ['researcher_edu'] = $_POST ['researcher_edu2'];
$project_researcher [2] ['researcher_major'] = $_POST ['researcher_major2'];
$project_researcher [2] ['researcher_work'] = $_POST ['researcher_work2'];
$project_researcher [2] ['researcher_org'] = $_POST ['researcher_org2'];

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

$appDetail ['id'] = $_POST ['id'];
$appDetail ['advice4'] = $_POST ['checkAdvice'];
$appDetail ['state4'] = $_POST ['isCheck'];

$appRecommend ['id'] = $_POST ['id'];
$appRecommend ['advice9'] = $_POST ['checkAdvice'];
$appRecommend ['state9'] = $_POST ['isCheck'];

// 签署意见及承诺
$project_opin ['leader_opinion'] = $_POST ['leader_opinion'];
$org_opinion ['org_opinion'] = $_POST ['org_opinion'];

// 审核意见
$project_check ['office_opinion'] = $_POST ['office_opinion'];
$project_check ['head_opinion'] = $_POST ['head_opinion'];
$project_check ['director_opinion'] = $_POST ['director_opinion'];

// 其他条款
$project_other ['project_id'] = $project_id;
$project_other ['other_condition'] = $_POST ['other_condition'];

// 其他条款
$task_project_other ['project_id'] = $project_id;
$task_project_other ['other_condition'] = $_POST ['other_condition'];



// 任务书各方

$plan_parties_t ['org_code'] = $org_code;
$plan_parties_t ['org_name'] = $_POST ['org_name'];
$plan_parties_t ['postal'] = $_POST ['postal'];
$plan_parties_t ['linkman'] = $_POST ['linkman'];
$plan_parties_t ['contact_address'] = $_POST ['contact_address'];
$plan_parties_t ['phone'] = $_POST ['phone'];
$plan_parties_t ['fax'] = $_POST ['fax'];
$plan_parties_t ['email'] = $_POST ['email'];


$plan_parties_tw ['project_id'] = $project_id;
$plan_parties_tw ['account_name'] = $_POST ['username'];
$plan_parties_tw ['account_bank'] = $_POST ['org_bank'];
$plan_parties_tw ['account_number'] = $_POST ['account'];

$plan_parties_legal ['org_code'] = $org_code;
$plan_parties_legal ['legal_code'] = $_POST ['legal_code'];
// var_dump($plan_parties_legal);
//task 


// 任务书各方
$task_plan_parties ['org_name'] = $_POST ['org_name'];
$task_plan_parties ['task_org_address'] = $_POST ['org_address'];
$task_plan_parties ['task_phone'] = $_POST ['phone'];
$task_plan_parties ['task_fax'] = $_POST ['fax'];
$task_plan_parties ['task_email'] = $_POST ['email'];

$task_plan_parties_t ['task_org_name'] = $_POST ['org_name1'];
$task_plan_parties_t ['task_org_address'] = $_POST ['org_address1'];
$task_plan_parties_t ['task_phone'] = $_POST ['phone1'];
$task_plan_parties_t ['task_fax'] = $_POST ['fax1'];
$task_plan_parties_t ['task_email'] = $_POST ['email1'];
$task_plan_parties_t ['task_leader_code'] = $_POST ['leader_code'];
$task_plan_parties_t ['task_postal'] = $_POST ['postal'];
$task_plan_parties_t ['task_linkman'] = $_POST ['linkman'];
$task_plan_parties_t ['task_username'] = $_POST ['username'];
$task_plan_parties_t ['task_org_bank'] = $_POST ['org_bank'];
$task_plan_parties_t ['task_account'] = $_POST ['account'];


$project_summary ['project_id'] = $project_id;
$project_summary ['project_name'] = $_POST ['project_name'];

$project_summary ['start_time'] =  strtotime($_POST ['start_time']);
$project_summary ['end_time'] =  strtotime($_POST ['end_time']);
$project_summary ['org_code'] = $org_code;
// $project_summary['department'] = $_POST['department'];
// $project_summary['project_start'] = $_POST['project_start'];
// $project_end['project_end'] = $_POST['project_end'];
$tech_area = $_POST ['tech_area'];

if($tech_area == null){
	$project_summary ['tech_area'] = '其他';
}else{
	$project_summary ['tech_area'] = $tech_area;
}
// $project_summary ['tech_area'] = $tech_area_other?$tech_area_other:$teach_area;


//人才

$project_summary_genious ['project_id'] = $project_id;
$project_summary_genious ['project_name'] = $_POST ['genious_name'];
$project_summary_genious ['department'] = $_POST ['department'];
$project_summary_genious ['tech_area'] = $_POST ['tech_area'];
$project_summary_genious ['org_code'] = $org_code;



/*********************************************/
//user_project.php
$user_project['project_id'] = $project_id;

$user_project['project_name'] = $_POST ['project_name'];
$user_project['project_id'] =  $_POST ['project_id'];

$user_project['department'] = $_POST['department'];
$user_project['project_engineer'] = $_POST ['project_engineer'];

$user_project['project_start'] = $_POST['project_start'];
$user_project['project_end'] = $_POST['project_end'];

$user_project['undertake_id'] = $_POST ['undertake_id'];
$user_project['tech_area'] = $_POST ['tech_area'];

$user_project['project_type'] = $_POST ['project_type'];


/*********************************************/

$table_name = $_GET ['table_name'];
$table_encode_name = $_GET ['table_name'];


// 禁止项目启动
$prohibit_name = $_POST ['project_name'];
$prohibit ['apply_end'] = $_POST ['end_time'];
$prohibit ['apply_status'] = $_POST ['apply_status'];

// 接受修改项目状态的参数值
$project_id2 = $_POST ['project_id'];
$value = $_POST ['value'];
// exit();

// project_money.php
// fund_src 经费来源
$year=$_POST['year'];

$total1_fund = ( array ) $_POST ['total1_fund'];
$total2_fund = ( array ) $_POST ['total2_fund'];
$total3_fund = ( array ) $_POST ['total3_fund'];
// var_dump($total1_fund);
// var_dump($total2_fund);
// var_dump($total3_fund);
// exit();
$total_fund=array();
$count = 0;
// print_r($total1_fund);
foreach ( $total1_fund as $val ) {
	
	$total_fund [$count] ['total1_fund'] = $total1_fund [$count];
	$total_fund [$count] ['total2_fund'] = $total2_fund [$count];
	$total_fund [$count] ['total3_fund'] = $total3_fund [$count];
	$count ++;
}
// task  fund_src 经费来源
$total1_fund = ( array ) $_POST ['total1_fund'];
$total2_fund = ( array ) $_POST ['total2_fund'];
$total3_fund = ( array ) $_POST ['total3_fund'];
$count = 0;
foreach ( $total1_fund as $val ) {
    $task_total_fund [$count] ['total1_fund'] = $total1_fund [$count];
    $task_total_fund [$count] ['total2_fund'] = $total2_fund [$count];
    $task_total_fund [$count] ['total3_fund'] = $total3_fund [$count];
    $count ++;
}


// 项目经费支出
$t_1 = ( array ) $_POST ['teach1_fund'];
$t_2 = ( array ) $_POST ['teach2_fund'];
$t_3 = ( array ) $_POST ['teach3_fund'];
$o_1 = ( array ) $_POST ['other1_fund'];
$o_2 = ( array ) $_POST ['other2_fund'];
$o_3 = ( array ) $_POST ['other3_fund'];

// var_dump($t_1);
// var_dump($t_2);
// var_dump($t_3);
// var_dump($o_1);
// var_dump($o_2);
// var_dump($o_3);
// exit();

// 主要设备equipment
$eqpt_name = ( array ) $_POST ['eqpt_name'];
$eqpt_model = ( array ) $_POST ['eqpt_model'];
$plan_money = ( array ) $_POST ['plan_money'];
$actual_num = ( array ) $_POST ['actual_num'];
$actual_pay = ( array ) $_POST ['actual_pay'];
$fund_src = ( array ) $_POST ['fund_src'];
$buy_time = ( array ) $_POST ['buy_time'];
$main_use = ( array ) $_POST ['main_use'];
$equipment = array();
$count = 0;
foreach ( $eqpt_name as $val ) {
	$equipment [$count] ['project_id'] = $project_id;
	$equipment [$count] ['eqpt_name'] = $eqpt_name [$count];
	$equipment [$count] ['eqpt_model'] = $eqpt_model [$count];
	$equipment [$count] ['plan_money'] = $plan_money [$count];
	$equipment [$count] ['actual_num'] = $actual_num [$count];
	$equipment [$count] ['actual_pay'] = $actual_pay [$count];
	$equipment [$count] ['fund_src'] = $fund_src [$count];
	$equipment [$count] ['buy_time'] = $buy_time [$count];
	$equipment [$count] ['main_use'] = $main_use [$count];
	$count ++;
}



// 主要设备 task equipment
$eqpt_name = ( array ) $_POST ['eqpt_name'];
$eqpt_model = ( array ) $_POST ['eqpt_model'];
$plan_money = ( array ) $_POST ['plan_money'];
$actual_num = ( array ) $_POST ['actual_num'];
$actual_pay = ( array ) $_POST ['actual_pay'];
$fund_src = ( array ) $_POST ['fund_src'];
$buy_time = ( array ) $_POST ['buy_time'];
$main_use = ( array ) $_POST ['main_use'];
$count = 0;
foreach ( $eqpt_name as $val ) {
    $task_equipment [$count] ['task_project_id'] = $project_id;

    $task_equipment [$count] ['eqpt_name'] = $eqpt_name [$count];
    $task_equipment [$count] ['eqpt_model'] = $eqpt_model [$count];
    $task_equipment [$count] ['plan_money'] = $plan_money [$count];
    $task_equipment [$count] ['actual_num'] = $actual_num [$count];
    $task_equipment [$count] ['actual_pay'] = $actual_pay [$count];
    $task_equipment [$count] ['fund_src'] = $fund_src [$count];
    $task_equipment [$count] ['buy_time'] = $buy_time [$count];
    $task_equipment [$count] ['main_use'] = $main_use [$count];
    $count ++;
}
$project_info['project_match'] = $_POST ['project_match'];
$task_project_info['project_match'] = $_POST ['project_match'];
// total_fund.php
// fund_src 表
$bgt_fund = $_POST ['bgt_fund'];
$reduce_fund = $_POST ['reduce_fund'];
$actual_fund = $_POST ['actual_fund'];

// project_fund_other project_fund_tech
$teach_budget_fund = $_POST ['teach_budget_fund'];
$teach_reduce_fund = $_POST ['teach_reduce_fund'];
$teach_adjust_fund = $_POST ['teach_adjust_fund'];
$teach_actual_fund = $_POST ['teach_actual_fund'];

$other_budget_fund = $_POST ['other_budget_fund'];
$other_reduce_fund = $_POST ['other_reduce_fund'];
$other_adjust_fund = $_POST ['other_adjust_fund'];
$other_actual_fund = $_POST ['other_actual_fund'];
//经费表中增加的 字段
$project_fund_tech['budget_fund_total']=$_POST['budget_fund_total'];
$project_fund_tech['reduce_fund_total']=$_POST['reduce_fund_total'];
$project_fund_tech['adjust_fund_total']=$_POST['adjust_fund_total'];
$project_fund_tech['actual_fund_total']=$_POST['actual_fund_total'];
$project_fund_tech['fund_tech_total']=$_POST['fund_tech_total'];
$project_fund_tech['fund_other_total']=$_POST['fund_other_total'];

$fund_src_add['bgt_fund_total']=$_POST['bgt_fund_total'];
$fund_src_add['reduce_fund_total']=$_POST['reduce_fund_total'];
$fund_src_add['actual_fund_total']=$_POST['actualsrc_fund_total'];


//专利实施
 $patent3_orginfo['org_code'] = $org_code;
$patent3_orginfo['register_time'] = $_POST['register_time'];
 $patent3_orginfo['contact_address'] = $_POST['contact_address'];
$patent3_orginfo['postal'] = $_POST['postal'];
/* $patent3_orginfo['email'] = $_POST['email'];
 $patent3_orginfo['linkman'] = $_POST['linkman'];
 $patent3_orginfo['linkman_contact'] = $_POST['linkman_contact']; */
// $patent3_orginfo['fax'] = $_POST['fax'];
/* $patent3_orginfo['org_bank'] = $_POST['org_bank'];
$patent3_orginfo['account'] = $_POST['account'];
$patent3_orginfo['credit_rate'] = $_POST['credit_rate']; */
$patent3_orginfo['org_trade'] = $_POST['org_trade'];
$patent3_orginfo['register_fund'] = $_POST['register_fund'];
$patent3_orginfo['local_foreign'] = $_POST['local_foreign'];
$patent3_orginfo['org_type'] = $_POST['org_type'];

$linkmanInfo3["linkman"]= $_POST['linkman'];
$linkmanInfo3["linkman_fax"]= $_POST['fax'];
$linkmanInfo3["linkman_contact"]= $_POST['linkman_contact'];
$linkmanInfo3["account_bank"]= $_POST['org_bank'];
$linkmanInfo3["account_number"]= $_POST['account'];
$linkmanInfo3["credit_rate"]= $_POST['credit_rate'];

/* $patent3_projectinfo['org_bank'] = $_POST['org_bank'];
 $patent3_projectinfo['account'] = $_POST['account'];
 $patent3_projectinfo['credit_rate'] = $_POST['credit_rate']; */

$temp = array();
for($i=0 ; $i<6 ; $i++){
	$temp[$i] = $_POST['checkbox'.$i.''];
}
$patent3_orginfo['feature'] = json_encode($temp);
// var_dump($patent3_orginfo['feature']);exit;

$patent3_legal['legal_sex'] = $_POST['legal_sex'];
$legal_year = $_POST['legal_year'];
$legal_month = $_POST['legal_month'];
$patent3_legal['legal_birth'] = $legal_year.'-'.$legal_month;
$patent3_legal['legal_edu'] = $_POST['legal_edu'];
$patent3_legal['legal_time'] = $_POST['legal_time'];
$patent3_legal['legal_phone'] = $_POST['legal_phone'];
$patent3_legal['legal_name'] = $_POST['legal_name'];

$patent3_staff['org_code'] = $org_code;
$patent3_staff['staff_num'] = $_POST['staff_num'];
$patent3_staff['junior'] = $_POST['junior'];
$patent3_staff['researcher_num'] = $_POST['researcher_num'];

$patent3_intellectual['org_code'] = $org_code;
$patent3_intellectual['patent_num'] = $_POST['patent_num'];
$patent3_intellectual['invent_patent'] = $_POST['invent_patent'];

$patent3_profit['org_code'] = $org_code;
$patent3_profit['lasthalf_profit'] = $_POST['lasthalf_profit'];
$patent3_profit['lasthalf_tax'] = $_POST['lasthalf_tax'];
$patent3_profit['last_totalincome'] = $_POST['last_totalincome'];
$patent3_profit['last_industrytax'] = $_POST['last_industrytax'];
$patent3_profit['last_industryadd'] = $_POST['last_industryadd'];
$patent3_profit['last_industrycreative'] = $_POST['last_industrycreative'];
$patent3_profit['last_productsale'] = $_POST['last_productsale'];
$patent3_profit['last_techexpend'] = $_POST['last_techexpend'];
$patent3_product = (array)$_POST['main_product'];
$patent3_ratio = (array)$_POST['sale_ratio'];
$patent_prora = array();
for($i=0 ; $i<count($patent3_product) ; $i++){
	$patent_prora[$i]['org_code'] = $org_code;
	$patent_prora[$i]['main_product'] = $patent3_product[$i];
	$patent_prora[$i]['sale_ratio'] = $patent3_ratio[$i];
}
//patent3 project
$patent3_project['project_id'] = $project_id;
$patent3_project['project_name'] = $_POST['project_name'];
$patent3_project['tech_area'] = $_POST['tech_area'];
$patent3_project['planfinish_time'] = $_POST['planfinish_time'];
$patent3_project['coproject_summary'] = $_POST['coproject_summary'];
// $patent3_project['legal_edu'] = $_POST['legal_edu'];
$patent3_project['tech_level'] = $_POST['tech_level'];
$patent3_project['project_step'] = $_POST['project_step'];

$checkbox = array();
for ($i=0 ; $i<5 ; $i++){
	$checkbox[$i] = $_POST['checkbox'.$i.''];
}
// var_dump(json_encode($checkbox));
// exit();
$patent3_project['project_advantage'] = json_encode($checkbox);


$patent3_principle['project_id'] = $project_id;
$patent3_principle['leader_name']=$_POST['leader_name'];
$patent3_principle['leader_sex']=$_POST['leader_sex'];
$leader_year = $_POST['leader_year'];
$leader_month = $_POST['leader_month'];
$patent3_principle['leader_birth']=$leader_year.'-'.$leader_month;
$patent3_principle['leader_edu']=$_POST['leader_edu'];
//var_dump($patent3_principle);exit;

$patent3_patent['project_id'] = $project_id;
$patent3_patent['patent_num'] = $_POST['patent_num'];
$patent3_patent['invent_num'] = $_POST['invent_num'];
$patent3_patent['function_patent'] = $_POST['function_patent'];
$patent3_patent['patent_design'] = $_POST['patent_design'];



// 专利名称
$patent3_list_name = ( array ) $_POST ['patent_name'];
$patent3_list_code = ( array ) $_POST ['patent_code'];

$count = 0;
foreach ( $patent3_list_name as $val ) {
	$patent3_list [$count]['project_id'] = $project_id;
	$patent3_list [$count]['patent_name'] = $patent3_list_name[$count];
	$patent3_list [$count]['patent_code'] = $patent3_list_code[$count];
	$count ++;
}
//var_dump($patent3_list);exit;


$patent3_last['project_id'] = $project_id;
$patent3_last['employ_num'] = $_POST['lemploy_num'];
$patent3_last['year_profit'] = $_POST['lyear_profit'];
$patent3_last['industry_num'] = $_POST['lindustry_num'];
$patent3_last['tax_sum'] = $_POST['ltax_sum'];
$patent3_last['industry_add'] = $_POST['lindustry_add'];
$patent3_last['foreign_tax'] = $_POST['lforeign_tax'];
$patent3_last['sell_sum'] = $_POST['lsell_sum'];
$patent3_last['market_share'] = $_POST['lmarket_share'];

$patent3_finish['project_id'] = $project_id;
$patent3_finish['employ_num'] = $_POST['employ_num1'];
$patent3_finish['year_profit'] = $_POST['year_profit1'];
$patent3_finish['industry_num'] = $_POST['industry_num1'];
$patent3_finish['tax_sum'] = $_POST['tax_sum1'];
$patent3_finish['industry_add'] = $_POST['industry_add1'];
$patent3_finish['foreign_tax'] = $_POST['foreign_tax1'];
$patent3_finish['sell_sum'] = $_POST['sell_sum1'];
$patent3_finish['market_share'] = $_POST['market_share1'];
//
$user_type = $_SESSION['user_type'];
$user_id = $_SESSION['user_id'];
$table_id = $_GET['table_id'];
$projectapp = new ProjectApp ();

$log=new LOGINFO();

switch ($action) {
	case 'findPlanPart' :
		$projectapp->findPlanPart ( $org_code,$project_id, "org_info", "org_code","" );
		break;
	case 'saveTotalFund' :
		$projectapp->saveTotalFund ($project_fund_tech,$fund_src_add, $equipment, $bgt_fund, $reduce_fund, $actual_fund, $teach_budget_fund, $teach_reduce_fund, $teach_adjust_fund, 

		$teach_actual_fund, $other_budget_fund, $other_reduce_fund, $other_adjust_fund, $other_actual_fund, $project_id );
		break;
	case 'findTotalFund' :
		$projectapp->findTotalFund ( $project_id ,"");
		break;
	case 'saveprojectmoney' :
		
		$p_m_year=$_POST['p_m_year'];
		$projectapp->saveprojectmoney ( $project_info, $equipment, $total_fund,$year, $p_m_year,$t_1, $t_2, $t_3, $o_1, $o_2, $o_3, $project_id );
		break;
	case 'task_saveprojectmoney' :
		$p_m_year=$_POST['p_m_year'];
		$projectapp->task_saveprojectmoney ( $task_project_info, $task_equipment, $task_total_fund, $year, $p_m_year,$t_1, $t_2, $t_3, $o_1, $o_2, $o_3, $project_id);
		    break;
	case 'findprojectmoney' :
		$projectapp->findprojectmoney ( $project_id,'' );
		break;
	case 'findtask_project_money' :
			$projectapp->findtask_projectmoney ( $project_id,'' );
			break;
	case 'project_summary' :
		$projectapp->project_summary ( 'project_info', $project_id, $project_summary );
		break;
	case 'project_summary_genious' :
		$projectapp->project_summary_genious ( $project_id, $project_summary_genious );
		break;
	case 'saveApplication' :
		$projectapp->org_info ( $org_code, $project_id, $project_principle, $applyinfo,$linkmanInfo );
		break;
	
	case 'project_mean' :
		$projectapp->project_mean ( 'project_info', $project_id, $project_mean );
		break;
	
	case 'project_status' :
		$projectapp->project_status ( 'project_info', $project_id, $project_status );
		break;
	
	case 'project_target' :
		$projectapp->project_target ( 'project_info', $project_id, $project_target );
		break;
	case 'task_project_target' :
	    $projectapp->task_project ( 'project_info', $project_id, $task_project_target );
	    break;
	case 'project_content' :
		$projectapp->project_content ( 'project_info', $project_id, $project_content );
		break;
	case 'task_project_content':
	    $projectapp->task_project( 'project_info', $project_id, $task_project_content );
	    break;
	case 'task_project_techway' :
		$projectapp->task_project( 'project_info', $project_id, $task_project_techway );
		break;
	
	case 'project_techway' :
		$projectapp->project_techway ( 'project_info', $project_id, $project_techway );
		break;
// 	case 'task_project_techway' :
// 		$projectapp->project_techway ( 'project_info', $project_id, $tasK_project_techway );
// 		break;
	case 'project_ann' :
		$projectapp->project_ann ( 'project_ann_plan', $project_id, $project_ann );
		break;
	case 'project_risk' :
		$projectapp->project_risk ( 'project_info', $project_id, $project_risk );
		break;
	case 'project_effect' :
		$projectapp->project_effect ( 'project_info', $project_id, $project_effect );
		break;
	
	case 'project_expect' :
		$projectapp->project_expect ( 'project_info', $project_id, $project_expect );
		break;
	case 'task_project_expect' :
	    $projectapp->project_expect ( 'project_info', $project_id, $task_project_expect);
	    break;
		
	case 'project_member' :
		$projectapp->project_member ( 'project_org', 'researchers', $project_id, $project_joinorg, $project_leader, $project_researcher );
		break;
	
	case 'saveOpinPromise' :
		$projectapp->saveOpinPromise ($project_id, $project_opin,$org_opinion );
		break;
	
	case 'saveOtherCondition' ://方法没了  有了  这个也不知道谁调用的   还有一个check_opnion 估计这个不用了 几先不写了    ---黎明
		$projectapp->saveOtherCondition ( 'project_info', $project_id, $project_other );
		break;
	
	case 'task_saveOtherCondition' ://方法没了  有了  这个也不知道谁调用的   还有一个check_opnion 估计这个不用了 几先不写了    ---黎明
		$projectapp->saveOtherCondition ( 'project_info', $project_id, $task_project_other );
		break;
	
	case 'savePlanParties' ://方法没了
		$projectapp->savePlanParties ( $org_code,$project_id, $plan_parties_t,$plan_parties_legal,$plan_parties_tw);
		break;
	case 'task_savePlanParties' ://方法没了
	    $projectapp->savePlanParties ( 'org_info', $project_id, $task_plan_parties, $task_plan_parties_t );
	    break;
		
	case 'findOpinion' :
		$projectapp->findOpinInfo ( $project_id, 'project_info', 'project_id',"" );
		break;
	
	case 'findProjectMean' :
		$projectapp->findProjectMean ( $project_id, 'project_info', 'project_id' ,'');
		break;
	case 'findProStatus' :
		$projectapp->findProStatus ( $project_id, 'project_info', 'project_id','' );
		break;
	case 'findProTarget' :
		$projectapp->findProTarget ( $project_id, 'project_info', 'project_id' ,'');
		break;
	case 'findtask_ProTarget' :
		$projectapp->findtask_ProTarget ( $project_id, 'project_info', 'project_id',"" );
		break;
	case 'findProContent' :
		$projectapp->findProContent ( $project_id, 'project_info', 'project_id','','');
		break;
	case 'findtask_ProContent' :
		$projectapp->findtask_ProContent ( $project_id, 'project_info', 'project_id',"" );
		break;
	case 'findProTech' :
		$projectapp->findProTech ( $project_id, 'project_info', 'project_id','' ,'');
		break;
	case 'findtask_ProTech' :
		$projectapp->findtask_ProTech ( $project_id, 'project_info', 'project_id',"" );
		break;
	case 'findProRisk' :
		$projectapp->findProRisk ( $project_id, 'project_info', 'project_id' ,'');
		break;
	case 'findProExpert' :
		$projectapp->findProExpert ( $project_id, 'project_info', 'project_id','','' );
		break;
	case 'findtask_ProExpert' :
		$projectapp->findtask_ProExpert ( $project_id, 'project_info', 'project_id' ,"");
		break;
	case 'findProEconomy' :
		$projectapp->findProEconomy ( $project_id, 'project_info', 'project_id','' );
		break;
	case 'findProCheck' :
		$projectapp->findProCheck ( $project_id, 'project_info', 'project_id' );
		break;
	case 'findOtherCondition' :
		$projectapp->findOthCondition ( $project_id, 'project_info', 'project_id',"" );
		break;
	case 'findProOrg' :
		$projectapp->findProOrg ( $org_code, $project_id, '' );
		break;
	case 'findProSum' :
		$project_type_id = $_REQUEST['id'];
		$result = $projectapp->findProSummary ($user_id, $project_type_id);
		ob_clean();
		json_out($result);
		break;
	case 'findProSum_genious' :
		$project_type_id = $_REQUEST['id'];
		$result = $projectapp->findProSummary_genious ($user_id, $project_type_id);
		break;
	case 'findProInfo' :
		 $projectapp->findProInfo ( $project_id);
		break;
	case 'findProInfoB' :
		$projectapp->findProInfoB ( $_GET['project_id']);
		break;
	case 'saveProInfo':
		$projectapp->saveProInfo($updateinfo);
		
		break;
   // 2016.02.20 加入;
	case 'sendEmailandSms':
	    $center = new Center();
	    $db = new DB();
	    $title = "科委通知";
	   // $project_id = $updateinfo['project_id'];
	    $project_id = $_GET['project_id_emsm'];
	    $result = $db -> GetInfo1($project_id, 'project_info', 'project_id');
	    $project_name = $result['project_name'];
	    $str = "您的项目 " . $project_name . "已经开始立项，请及时登录系统，填写立项相关文件。";
	    $center->email_send($project_id,$title,$str);
	    break;
	    
	case 'findProAnn' :
		$projectapp->findProAnn ( 'project_ann_plan', $project_id, 'project_id','','');
		break;
	case 'findTaskProAnn' :
		$projectapp->findProAnn ( 'project_ann_plan', $project_id, 'task_project_id','task_','');
		break;
	case 'setupPro' :
		$projectapp->setupProject ( $project_id );
		break;
	case 'execute' :		
		$projectapp->executeSolution ( $name,$project_id );
		break;
	case 'isFinish' :
		$projectapp->isfinish( $name,$project_id );
		break;
/* 	case 'assignment' :
		$projectapp->assignment ($name,$project_id);
		break; */
/* 	case 'execute_solution' :
		$projectapp->execute_solution ( $project_id );
		break; */
/* 	case 'expert_solution' :

		$projectapp->expert_solution ($name,$project_id);
		break; */
	
/* 	case 'modify_solution' :

		$projectapp->modify_solution ($name,$project_id);
		break; */
	
/* 	case 'middle_solution' :

		$projectapp->middle_solution ($name,$project_id);
		break; */
	
/* 	case 'expertProAccept' :

		$projectapp->expertProAccept ($name,$project_id);
		break; */
	
	case 'check_opinion' :
		$name = $_GET ['table_name'];
		$check_opinion ['approval_opinion'] = $_POST ['approval_opinion'];
		$projectapp->check_opinion ( $name, $check_opinion );
		break;
	
/* 	case 'acceptSummary' :

		$projectapp->acceptSummary ($name,$project_id);
		break; */
	
	case 'prohibit' :
		$projectapp->prohibit ( 'project_type', $prohibit, $prohibit_name );
		break;
	case 'setsavestage':
	    $project_id = $_GET['project_id'];
		$projectapp->setsavestage($project_id);
		$center = new Center();
		$db = new DB();
		$title = "科委通知";
// 		$project_id = $_POST['project_id'];
		$result = $db -> GetInfo1($project_id, 'project_info', 'project_id');
		$project_name = $result['project_name'];
		$str = "您的项目 " . $project_name . " 已经被储备。";
		$center->email_send($project_id,$title,$str);
		break;
	case 'findProMember' :
		$projectapp->findProMember($org_code, 'org_info', 'org_code', $project_id ,'');
		break;
	case 'findtask_ProMember' :
		$projectapp->findtask_ProMember ( $org_code, 'org_info', 'org_code', $project_id ,"");
		break;
	case 'findExpertSigns' :
		$projectapp->findExpertSigns ( 'project_info', $project_id, 'project_id',$project_id );
		break;

// 	case 'findOrgInfo':
// 	 $projectapp->findOrgInfo($org_code);
// 	break;

	case 'findCoorgInfo' :
		$projectapp->findCoorgInfo ( $org_code );
		break;
	case 'ischeck' :
		$projectapp->isCheck ( $project_id2, $value );
		break;
	case 'changeOk':
		$projectapp->changeOk($project_id , $changeOk);
		break;
	case 'attach1_org_info':
	    $projectapp->find_attach1_info($project_id,$user_type,$table_name);
	    break;
	case 'check_repeat':
	    $projectapp->modify_repeat($project_id);
	    break;
	case 'delete_repeat':
	    $projectapp->failrepeat($project_id);
	    break;
    case 'isComplete2':
	    	$length = $_GET['length'];
	    	$position = $_GET['position'];
	    	$table_id = $_GET['table_name'];
	    	$table_name = urldecode($table_encode_name);
	    	$projectapp->isComplete2($length,$position,$table_name,$project_id,$complete);
	    	break;
	case 'isComplete':
		$length = $_GET['length'];
		$position = $_GET['position'];
		$table_id = $_GET['table_name'];
		$projectapp->isComplete($length,$position,$table_id,$project_id);
		break;
	case 'update_stage':
		$length = $_GET['length'];
		$position = $_GET['position'];
		$table_id = $_GET['table_name'];
		$projectapp->update_stage($length,$position,$table_id,$project_id);
		break;
		
	case 'patent3_orginfo':
	    $projectapp->patent3_orginfo($org_code,$patent3_orginfo,$patent3_legal,$patent3_staff,$patent3_intellectual,$patent3_profit ,$patent_prora,$linkmanInfo3,$project_id);
	    break;
	case 'findpatent3_org':
	    $projectapp->find_patent3_orginfo($org_code,$project_id,"");
	    break;
	case 'patent3_projectinfo':
	    $projectapp->patent3_projectinfo($project_id,$patent3_project,$patent3_principle,$patent3_patent,$patent3_last,$patent3_finish,$patent3_list);
	    break;
    case 'findpatent3_pro':
        $projectapp->find_patent3_projectinfo($project_id,"");
        break;
    case 'projectMeg':
        $projectapp->projectMeg($project_id);
        break;
    case 'checkOpp':
        $table_id = $_GET['name'];
        
        $projectapp->checkOpp($project_id,$table_id);
        break;
    case 'find_opnion':
        $projectapp->find_opnion($project_id);
        break;
    case 'findLogInfo':
    	$page = $_POST ['page'];
    	$rows = $_POST ['rows'];
    	$projectapp->findLogInfo($page,$rows);
	default :
		;
}