<?php
include '../../../modules/php/action/class/lmcheck_material/check_material.cls.php';
require_once '../../../common/php/config.ini.php';
require_once '../../../common/php/lib/db.cls.php';
include WWWPATH . 'extends/Table/TableData.php';
include '../../../website/php/action/class/projectFile.cls.php';
require_once __DIR__ . '/../word.php';
session_start();
$project_id = $_SESSION['project_id'];
$org_code = $_SESSION['org_code'];
$projectapp = new ProjectApp();
$db=new DB();
$data = array();

//项目单位基本情况
$arr2=$projectapp->find_org_info($org_code,$project_id,"pdf");
if(!empty($arr2)){
	$data = array_merge($data , $arr2);
}

//项目基本情况
$arr1=$projectapp->find_unit_info($project_id,"pdf");
if(!empty($arr1)) {
	$data = array_merge($data, $arr1);
}
$temp1=$db->getDyDataTwo("patent_list","project_id",$project_id,0);
if(!empty($temp1['patent_name'])) {
$TBL1 = array(
		'shareholder_name' => $temp1['patent_name'],
		'stock_ratio' => $temp1['patent_code']
);}

if(!empty($TBL1)) {
$data['TBL1'] = $TBL1;
}

//产品获奖情况
$temp2=$db->getDyData("produce_award","project_id",$project_id);
if(!empty($temp2['award_name'])) {
$TBL2 = array(
		'award_name' => $temp2['award_name'],
		'award_dep' => $temp2['award_dep'],
		'award_level' => $temp2['award_level']
);}

if(!empty($TBL2)) {
$data['TBL2'] = $TBL2;
}

//项目实施过程中企业通过质量认证情况
$arr3=$projectapp->find_authent($project_id,"pdf");
if(!empty($arr3)) {
	$data = array_merge($data, $arr3);
}

//项目经济考核指标及完成情况
$arr4=$projectapp->find_index_complete($project_id,"pdf");
if(!empty($arr4)) {
	$data = array_merge($data, $arr4);
}

//项目（产品）推广扩散情况
//技术转让
$temp3=$db->getDyData("tech_transfer","project_id",$project_id);
$length = count($temp3['id']);
for ($i = 1 ; $i <= $length ; $i++){
	$order[$i] = $i;
}
$temp3['order'] = $order;
$TBL3 = array(
	'receiver' => $temp3['receiver'],
	'company_scale'	=> $temp3['company_scale'],
	'order' => $temp3['order']
);
if(!empty($TBL3)) {
$data['TBL3'] = $TBL3;
}

//合作建厂
$temp4=$db->getDyData("co_construct","project_id",$project_id);
$length2 = count($temp4['id']);
for ($i = 1 ; $i <= $length2 ; $i++){
	$order1[$i] = $i;
}
$temp4['order'] = $order1;
$TBL4 = array(
	'partner_name' => $temp4['partner_name'],
	'company_scale' => $temp4['company_scale'],
	'order' => $temp4['order']
);
if(!empty($TBL4)) {
	$data['TBL4'] = $TBL4;
}

//市场开拓、占有情况
$arr5=$projectapp->find_spread($project_id,"pdf");
if(!empty($arr5)) {
	$data = array_merge($data, $arr5);
}

//项目实施过程中企业研发新专利、开发新产品情况
$temp5=$db->getDyDataTwo("patent_list","project_id",$project_id,1);
$length5 = count($temp5['id']);
for ($i = 1 ; $i <= $length5 ; $i++){
	$order5[$i] = $i;
}
 
$temp5['order'] = $order5;
$TBL5 = array(
	'patent_name' => $temp5['patent_name'],
	'patent_state' => $temp5['patent_state'],
	'patent_type' => $temp5['patent_type'],
	'order' => $temp5['order']
);
if(!empty($TBL5)) {
	$data['TBL5'] = $TBL5;
}
$temp6=$db->getDyData("produce","project_id",$project_id);
$length6 = count($temp6['produce_name']);
for ($i = 1 ; $i <= $length6 ; $i++){
	$order6[$i] = $i;
}
$temp6['order'] = $order6;
$TBL6 = array(
	'produce_name' => $temp6['produce_name'],
	'produce_level' => $temp6['produce_level'],
	'order' => $temp6['order']
);
if(!empty($TBL6)) {
$data['TBL6'] = $TBL6;
}

//项目实施过程中人才培训情况
$arr6=$projectapp->find_talent_training($project_id,"pdf");
if(!empty($arr6)) {
$data = array_merge($data , $arr6);
}


//get project_name
$res=$projectapp->find_project_time($project_id);
$data['projet_name']=$res['project_name'];

//项目单位能力改善提高情况
//购置生产设备明细
$temp7=$db->getDyData("equipment_list","project_id",$project_id);
$length7 = count($temp7['equipment_name']);
for ($i = 1 ; $i <= $length7 ; $i++){
	$order7[$i] = $i;
}
$temp7['order'] = $order7;
$TBL7 = array(
	'order' => $temp7['order'],
	'equipment_name' => $temp7['equipment_name'],
	'equipment_price' => $temp7['equipment_price'],
	'equipment_num' => $temp7['equipment_num'],
	'equipment_fund' => $temp7['equipment_fund'],
);
if(!empty($TBL7)) {
	$data['TBL7'] = $TBL7;
}

//购置检测仪器明细
$temp8=$db->getDyData("instrument_list","project_id",$project_id);
$length8 = count($temp8['test_name']);
for ($i = 1 ; $i <= $length8 ; $i++){
	$order8[$i] = $i;
}
$temp8['order'] = $order8;
$TBL8 = array(
	'order' => $temp8['order'],
	'test_name' => $temp8['test_name'],
	'test_num' => $temp8['test_num'],
	'test_fund' => $temp8['test_fund'],
	'test_price' => $temp8['test_price']
);
if(!empty($TBL8)) {
$data['TBL8'] = $TBL8;
}

//厂房、场地改善情况
$arr7=$projectapp->find_improve($project_id,"pdf");
if(!empty($arr7)) {
	$data = array_merge($data, $arr7);
}

//项目单位意见
$arr8=$projectapp->find_unit_opinion($project_id,"pdf");
if(!empty($arr8)) {
	$data = array_merge($data, $arr8);
}

$arr9=$projectapp->find_final_opinion($project_id,"pdf");
if(!empty($arr9)) {
	$data = array_merge($data, $arr9);
}


$temp = TableData::get($project_id, 48);

	$arr10 = (array)$temp['data'];


if(!empty($arr10)){
    if(!empty($arr10['year']))
    {
        foreach($arr10['year'] as $key => $value){
            $year_patent['year'.$key] = $value;
        }
    }

    if(!empty($arr10['year_patent']))
    {
    	foreach($arr10['year_patent'] as $key => $value){
    		$year_patent['year_patent'.$key] = $value;
    	}
    }

    if(!empty($arr10['city']))
    {
    	foreach($arr10['city'] as $key => $value){
    		$city['city'.$key] = $value;
    	}
    }

    if(!empty($arr10['org']))
    {
    	foreach($arr10['org'] as $key => $value){
    		$org['org'.$key] = $value;
    	}
    }
    if(!empty($arr10['bank']))
    {
    	foreach($arr10['bank'] as $key => $value){
    		$bank['bank'.$key] = $value;
    	}
    }
    if(!empty($arr10['other']))
    {
    	foreach($arr10['other'] as $key => $value){
    		$other['other'.$key] = $value;
    	}
    }
     if(!empty($arr10['year_total']))
    {
    	$data['year_total'] = $arr10['year_total'];
    }else{
    	$data['year_total'] = 0;
    }
     if(!empty($arr10['city_total']))
    {
    	$data['city_total'] = $arr10['city_total'];
    }else{
    	$data['city_total'] = 0;
    }
    
     if(!empty($arr10['org_total']))
    {
    	$data['org_total'] = $arr10['org_total'];
    }else{
    	$data['org_total'] = 0;
    }
     if(!empty($arr10['bank_total']))
    {
    	$data['bank_total'] = $arr10['bank_total'];
    }else{
    	$data['bank_total'] = 0;
    }
     if(!empty($arr10['other_sub_total']))
    {
    	$data['other_sub_total'] = $arr10['other_sub_total'];
    }else{
    	$data['other_sub_total'] = 0;
    }

    if(!empty($arr10['p_m_year']))
    {
    	foreach($arr10['p_m_year'] as $key => $value){
    		$p_m_year['p_m_year'.$key] = $value;
    	}
    }
    if(!empty($arr10['teach1_fund']))
    {
    	foreach($arr10['teach1_fund'] as $key => $value){
    		$teach1_fund['teach1_fund'.$key] = $value;
    	}
    }
    if(!empty($arr10['other1_fund']))
    {
    	foreach($arr10['other1_fund'] as $key => $value){
    		$other1_fund['other1_fund'.$key] = $value;
    	}
    }
    if(!empty($arr10['teach2_fund']))
    {
    	foreach($arr10['teach2_fund'] as $key => $value){
    		$teach2_fund['teach2_fund'.$key] = $value;
    	}
    }
    if(!empty($arr10['other2_fund']))
    {
    	foreach($arr10['other2_fund'] as $key => $value){
    		$other2_fund['other2_fund'.$key] = $value;
    	}
    }
    if(!empty($arr10['teach3_fund']))
    {
    	foreach($arr10['teach3_fund'] as $key => $value){
    		$teach3_fund['teach3_fund'.$key] = $value;
    	}
    }
	if(!empty($arr10['other3_fund']))
	{
    	foreach($arr10['other3_fund'] as $key => $value){
    		$other3_fund['other3_fund'.$key] = $value;
    	}
	}
	if(!empty($arr10['teach_total']))
	{
    	foreach($arr10['teach_total'] as $key => $value){
    		$teach_total['teach_total'.$key] = $value;
    	}
	}
	if(!empty($arr10['other_total']))
	{
    	foreach($arr10['other_total'] as $key => $value){
    		$other_total['other_total'.$key] = $value;
    	}
	}
 	if(!empty($arr10['sum']))
	{
		
    	foreach($arr10['sum'] as $key => $value){
    		$sum['sum'.$key] = $value;
    	}
	}
 	if(!empty($arr10['total']))
	{
    	foreach($arr10['total'] as $key => $value){
    		$total['total'.$key] = $value;
    	}
	}
	if(!empty($total))
	{
	   $data = array_merge($data,$total);
	}
	if(!empty($teach_total))
	{
	   $data = array_merge($data,$teach_total);
	}
	if(!empty($other_total))
	{
	   $data = array_merge($data,$other_total);
	}
	if(!empty($year_patent))
	{
	   $data = array_merge($data,$year_patent);
	}
	if(!empty($city))
	{
	 $data = array_merge($data,$city);
	}
	if(!empty($org))
	{
	$data = array_merge($data,$org);
	}
	if(!empty($bank))
	{
	$data = array_merge($data,$bank);
	}

	if(!empty($other))
	{
	$data = array_merge($data,$other);
	}
	if(!empty($year_total))
	{
	$data = array_merge($data,$year_total);
	}
	if(!empty($total))
	{
	$data = array_merge($data,$total);
	}
	if(!empty($p_m_year))
	{
	$data = array_merge($data,$p_m_year);
	}
	if(!empty($teach1_fund))
	{
	$data = array_merge($data,$teach1_fund);
	}
	if(!empty($other1_fund))
	{
	$data = array_merge($data,$other1_fund);
	}
	if(!empty($teach2_fund))
	{
	$data = array_merge($data,$teach2_fund);
	}
	if(!empty($other2_fund))
	{
	$data = array_merge($data,$other2_fund);
	}
	if(!empty($teach3_fund))
	{
	$data = array_merge($data,$teach3_fund);
	}
	if(!empty($other3_fund))
	{
	$data = array_merge($data,$other3_fund); 
	}
	if(!empty($sum))
	{
		$data = array_merge($data,$sum);
	}
	
}
//获取项目编号
$res10=$projectapp->findother_info($project_id);
//获取公司名称
$res11=$projectapp->findOrg_info($org_code);

$data["business_id"]=$res10["business_id"];
$data["org_name"]=$res11["org_name"];

//获取附件信息
$project_file_obj = new projectFile();
$project_file_obj = $project_file_obj->get_attach_lists($project_id,24);
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
    $data['ATTACH'] = $attach; }
//var_dump($data['ATTACH']);exit;

/* 封皮上日期用阿拉伯数字显示当前年月
 * $time = showtime(); */
/* 封皮上日期用中文显示当前年月 */
$time = show_font_time();

$data = array_merge($data,$time);

$table_status = $_GET['table_status'];
$project_type = $_GET['project_type'];
$sql = "Select * from table_type_relative where project_type_id = $project_type and table_type_id = 1 group by table_type_id";
$result = $db->Select($sql);
$db -> Close();
if($table_status == 4 || $result[0]['not_check']==1){
    echo datatoword($data,'24.docx',24);
}else{
    echo datatoword($data,'240.docx',24);
}



