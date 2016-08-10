<?php
include '../../../modules/php/action/class/projectapp/util.cls.php';
include '../../../extends/Table/TableData.php';
require_once '../../../modules/php/action/class/projectapp/projectapp.cls.php';
require_once '../../../common/php/config.ini.php';
require_once '../../../common/php/lib/db.cls.php';
require_once __DIR__ . '/../word.php';
include '../../../website/php/action/class/projectFile.cls.php';

$project_id = $_SESSION ['project_id'];
// $project_id = 'dev1451718105';
$arr = array();
function myarray_merge($arr1,$arr2){
	if(empty($arr2)){
		return $arr1;
	}else{
		return array_merge($arr1,$arr2);
	}
}
$tableData = TableData::get($project_id, 1954);
$data = $tableData['data'];

 

if(!empty($data["bgt_fund"])){
foreach ($data["bgt_fund"] as $key => $value){
	$bgt_fund['bgt_fund'.$key] =  $value;
}}

if(!empty($data["reduce_fund"])){
foreach ($data["reduce_fund"] as $key => $value){
	$reduce_fund['reduce_fund'.$key] =  $value;
}}

if(!empty($data["actual_fund"])){
foreach ($data["actual_fund"] as $key => $value){
	$actual_fund['actual_fund'.$key] =  $value;
}}

if(!empty($data["teach_budget_fund"])){
foreach ($data["teach_budget_fund"] as $key => $value){
	$teach_budget_fund['teach_budget_fund'.$key] =  $value;
}}

if(!empty($data["other_budget_fund"])){
foreach ($data["other_budget_fund"] as $key => $value){
	$other_budget_fund['other_budget_fund'.$key] =  $value;
}}

if(!empty($data["teach_reduce_fund"])){
foreach ($data["teach_reduce_fund"] as $key => $value){
	$teach_reduce_fund['teach_reduce_fund'.$key] =  $value;
}}

if(!empty($data["other_reduce_fund"])){
foreach ($data["other_reduce_fund"] as $key => $value){
	$other_reduce_fund['other_reduce_fund'.$key] =  $value;
}}

if(!empty($data["teach_adjust_fund"])){
foreach ($data["teach_adjust_fund"] as $key => $value){
	$teach_adjust_fund['teach_adjust_fund'.$key] =  $value;
}}

if(!empty($data["other_adjust_fund"])){
foreach ($data["other_adjust_fund"] as $key => $value){
	$other_adjust_fund['other_adjust_fund'.$key] =  $value;
}}

if(!empty($data["teach_actual_fund"])){
foreach ($data["teach_actual_fund"] as $key => $value){
	$teach_actual_fund['teach_actual_fund'.$key] =  $value;
}}

if(!empty($data["other_actual_fund"])){
foreach ($data["other_actual_fund"] as $key => $value){
	$other_actual_fund['other_actual_fund'.$key] =  $value;
}}

$arr = myarray_merge($arr,$bgt_fund);
$arr['bgt_fund_total'] = $data["bgt_fund_total"];
$arr = myarray_merge($arr,$reduce_fund);
$arr['reduce_fund_total'] = $data["reduce_fund_total"];
$arr = myarray_merge($arr,$actual_fund);
$arr['actual_fund_total'] = $data["actual_fund_total"];

$arr = myarray_merge($arr,$teach_budget_fund);
$arr = myarray_merge($arr,$other_budget_fund);
$arr = myarray_merge($arr,$teach_reduce_fund);
$arr = myarray_merge($arr,$other_reduce_fund);
$arr = myarray_merge($arr,$teach_adjust_fund);
$arr = myarray_merge($arr,$other_adjust_fund);
$arr = myarray_merge($arr,$teach_actual_fund);
$arr = myarray_merge($arr,$other_actual_fund);

$arr['all_fund_tech_total'] = $data["all_fund_tech_total"];
$arr['teach_reduce_fund_total'] = $data["teach_reduce_fund_total"];
$arr['adjust_fund_total'] = $data["adjust_fund_total"];
$arr['teach_actual_fund_total'] = $data["teach_actual_fund_total"];
$arr['fund_tech_total'] = $data["fund_tech_total"];
$arr['fund_other_total'] = $data["data[fund_other_total"];

$TBL1 = array(
		'eqpt_name' => $data['eqpt_name'],
		'eqpt_model' => $data['eqpt_model'],
		'plan_money' => $data['plan_money'],
		'actual_num' => $data['actual_num'],
		'actual_pay' => $data['actual_pay'],
		'fund_src' => $data['fund_src'],
		'buy_time' => $data['buy_time'],
		'main_use' => $data['main_use'],
); 
if(!empty($TBL1)){
	$arr['TBL1'] =$TBL1;
}
//获取附件信息
$project_file_obj = new projectFile();
$project_file_obj = $project_file_obj->get_attach_lists($project_id,17);
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
    $arr['ATTACH'] = $attach; }

/* 封皮上日期用阿拉伯数字显示当前年月
 * $time = showtime(); */

/* 封皮上日期用中文显示当前年月 */
$time = show_font_time();

$arr = array_merge($arr,$time);
echo datatoword($arr,'17.docx',17);