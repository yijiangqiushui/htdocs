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
$res1=array();
$res1 = $projectApp->findProOrg($org_code, $project_id, 'pdf');
$res2 = $projectApp->findProjectMean($project_id, 'project_info', 'project_id', 'pdf');
$res3 = $projectApp->findProStatus($project_id, 'project_info' , 'project_id' , 'pdf');
$res4 = $projectApp->findProTarget($project_id,'project_info', 'project_id', 'pdf');
$res5 = $projectApp->findProContent($project_id, 'project_info', 'project_id', '', 'pdf');
$res6 = $projectApp->findProTech($project_id, 'project_info', 'project_id', '', 'pdf');
$res7 = $projectApp->findProAnn('project_ann_plan',$project_id, 'project_id', '', 'pdf');
// $res8 = $projectApp->findprojectmoney($project_id,'pdf');

$res9 = $projectApp->findProRisk($project_id,'project_info', 'project_id','pdf');
$res10 = $projectApp->findProExpert($project_id, 'project_info', 'project_id', '','pdf');
$res11 = $projectApp->findProEconomy($project_id, 'project_info', 'project_id','pdf');
$res12 = $projectApp->findProMember($org_code, 'org_info', 'org_code', $project_id,'pdf');
$res27 = $projectApp->findOpinInfo($project_id,'project_info','project_id','pdf');



$TBL1 = $db-> getDyData('project_ann_plan', 'project_id', $project_id);
$tableData = TableData::get($project_id, 17);
$temp = $tableData['data'];


$TBL2 = array();
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


// var_dump($temp['year']);
if(!empty($temp['year'])){
foreach ($temp['year'] as $key => $value){
	   $res13['year'.$key] = $value;
}}

if(!empty($temp['total1_fund'])){
foreach ($temp['total1_fund'] as $key => $value){
	   $res14['total1_fund'.$key] = $value;
}}

if(!empty($temp['total2_fund'])){
foreach ($temp['total2_fund'] as $key => $value){
	$res15['total2_fund'.$key] = $value;
}}

if(!empty($temp['total3_fund'])){
foreach ($temp['total3_fund'] as $key => $value){
	$res16['total3_fund'.$key] = $value;
}}

if(!empty($temp['year_total'])){
foreach ($temp['year_total'] as $key => $value){
	$res17['year_total'.$key] = $value;
}}

if(!empty($temp['year_total'])){
foreach ($temp['year_total'] as $key => $value){
	$res17['year_total'.$key] = $value;
}}


$res17['total_total'] = $temp['total_total'];

if(!empty($temp['p_m_year'])){
foreach ($temp['p_m_year'] as $key => $value){
	$res18['p_m_year'.$key] = $value;
}}

if(!empty($temp['teach1_fund'])){
foreach ($temp['teach1_fund'] as $key => $value){
	$res19['teach1_fund'.$key] = $value;
}}

if(!empty($temp['teach2_fund'])){
foreach ($temp['teach2_fund'] as $key => $value){
	$res20['teach2_fund'.$key] = $value;
}}

if(!empty($temp['teach3_fund'])){
foreach ($temp['teach3_fund'] as $key => $value){
	$res21['teach3_fund'.$key] = $value;
}}

if(!empty($temp['other1_fund'])){
foreach ($temp['other1_fund'] as $key => $value){
	$res22['other1_fund'.$key] = $value;
}}

if(!empty($temp['other2_fund'])){
foreach ($temp['other2_fund'] as $key => $value){
	$res23['other2_fund'.$key] = $value;
}}

if(!empty($temp['other3_fund'])){
foreach ($temp['other3_fund'] as $key => $value){
	$res24['other3_fund'.$key] = $value;
}}

if(!empty($temp['teach_actual_fund'])){
foreach ($temp['teach_actual_fund'] as $key => $value){
	$res25['teach_actual_fund'.$key] = $value;
}}


for($i=1 ; $i<=5 ; $i++){
	$res26['total'.$i] = $temp['total'.$i];
}
$res26['total_other'] = $temp['total_other'];
$res26['project_match'] = $temp['project_match'];
$res28 = $projectApp->opinion($project_id);


$TBL3 = $db -> getDyData('project_org', 'project_id', $project_id);
$TBL = $db -> getDyData('researchers','project_id',$project_id);

// $res1['project_meaning']=$res2['project_meaning'];
$res1['project_meaning']="aaaaa \r\n bbbb";
$res1['business_id']=$res2['business_id'];

$res1['project_status']=$res3['project_status'];
$res1['project_mission']=$res4['project_mission'];
$res1['project_aim']=$res4['project_aim'];
$res1['project_kpi']=$res4['project_kpi'];
$res1['project_content']=$res5['project_content'];
$res1['tech_way']=$res6['tech_way'];
$res1['project_manage']=$res6['project_manage'];
$res1['delegation_task']=$res6['delegation_task'];
if(!empty($res7)){
$res1 = array_merge($res1,$res7);
}
// $res1 = array_merge($res1,$res8);
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
if(!empty($res12)){
$res1 = array_merge($res1,$res12);
}
if(!empty($TBL1)){$res1['TBL1'] = $TBL1;}
if(!empty($TBL2)){$res1['TBL2'] = $TBL2;}
if(!empty($TBL3)){$res1['TBL3'] = $TBL3;}
if(!empty($TBL)){$res1['TBL'] = $TBL;}


//获取附件信息
$project_file_obj = new projectFile();
$project_file_obj = $project_file_obj->get_attach_lists($project_id,1);//记得修改$project_id,1，不同的表参数不一样，否则查询不到附件信息
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
	$res1['ATTACH'] = $attach; }

// 	include '../../../website/php/action/class/projectFile.cls.php';
	

 
if(!empty($res13)){
$res1 = array_merge($res1,$res13);
}

if(!empty($res14)){
$res1 = array_merge($res1,$res14);
}

if(!empty($res15)){
$res1 = array_merge($res1,$res15);
}
if(!empty($res16)){
$res1 = array_merge($res1,$res16);
}

if(!empty($res17)){
$res1 = array_merge($res1,$res17);
}

if(!empty($res18)){
$res1 = array_merge($res1,$res18);
}

if(!empty($res19)){
$res1 = array_merge($res1,$res19);
}

if(!empty($res20)){
$res1 = array_merge($res1,$res20);}


if(!empty($res21)){
$res1 = array_merge($res1,$res21);}

if(!empty($res22)){
$res1 = array_merge($res1,$res22);}


if(!empty($res23)){
$res1 = array_merge($res1,$res23);}

if(!empty($res24)){
$res1 = array_merge($res1,$res24);}

if(!empty($res25)){
$res1 = array_merge($res1,$res25);}

if(!empty($res26)){
$res1 = array_merge($res1,$res26);} 


$res1['leader_opinion'] = $res27['leader_opinion'];
$res1['org_opinion'] = $res27['org_opinion'];
//var_dump($res1);exit;
if(!empty($res28)){
$res1 = array_merge($res1,$res28);
}
//封皮儿
$res30=$projectApp->findProjectInfo($project_id);

if(!empty($res30)){
	$res1 = array_merge($res1,$res30);
}
/* 封皮上日期用阿拉伯数字显示当前年月
 * $time = showtime(); */

/* 封皮上日期用中文显示当前年月 */
$time = show_font_time();

 $res1 = array_merge($res1,$time);
//  echo ($res1);exit();
$table_status = $_GET['table_status'];
$project_type = $_GET['project_type'];
$sql = "Select * from table_type_relative where project_type_id = $project_type and table_type_id = 1 group by table_type_id";
$result = $db->Select($sql);
$db -> Close();
if($table_status == 4 || $result[0]['not_check']==1){
    echo datatoword($res1, '1.docx', 1);
}else{
    echo datatoword($res1, '100.docx', 1);
}






