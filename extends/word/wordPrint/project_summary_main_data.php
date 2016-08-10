<?php 
require_once  '../../../extends/Table/TableData.php';
require_once __DIR__ . '/../word.php';
include '../../../common/php/config.ini.php';
include '../../../website/php/action/class/projectFile.cls.php';

$data = array();
$org_code = $_SESSION ['org_code'];
$project_id=$_SESSION['project_id'];
$table_status = $_GET['table_status'];

$TableData = TableData::get($project_id, 31);
$temp = $TableData['data'];

$data['project_name'] = $temp['project_name'];
$data['business_id'] = $temp['business_id'];
$data['start_end_time'] = $temp['start_time']."到".$temp['end_time'];
$data['org_name'] = $temp['org_name'];
$data['bgt_fund_total'] = $temp['bgt_fund_total'];
$data['actualsrc_fund_total'] = $temp['actualsrc_fund_total'];

foreach ($temp['bgt_fund'] as $key => $value){
	$bgt_fund['bgt_fund'.$key] = $value;
}
$data = array_merge($data , $bgt_fund);
foreach ($temp['actual_fund1'] as $key => $value){
	$actual_fund1['actual_fund1'.$key] = $value;
}
$data = array_merge($data , $actual_fund1);
foreach ($temp['actual_fund'] as $key => $value){
	$actual_fund['actual_fund'.$key] = $value;
}
$data = array_merge($data , $actual_fund);
foreach ($temp['budget_fund'] as $key => $value){
	$budget_fund['budget_fund'.$key] = $value;
}
$data = array_merge($data , $budget_fund);
foreach ($temp['patent_out'] as $key => $value){
	$patent_out['patent_out'.$key] = $value;
}
$data = array_merge($data , $patent_out);
foreach ($temp['total'] as $key => $value){
	$total['total'.$key] = $value;
}
$data = array_merge($data , $total);

//获取附件信息
$project_file_obj = new projectFile();
$project_file_obj = $project_file_obj->get_attach_lists($project_id,26);
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

/* 封皮上日期用阿拉伯数字显示当前年月
 * $time = showtime(); */

/* 封皮上日期用中文显示当前年月 */
$time = show_font_time();

$data = array_merge($data,$time);
$db = new DB();
$project_type = $_GET['project_type'];
$sql = "Select * from table_type_relative where project_type_id = $project_type and table_type_id = 1 group by table_type_id";
$result = $db->Select($sql);
$db -> Close();
if($table_status == 4 || $result[0]['not_check']==1){
    echo datatoword($data, '26.docx', 26);
}else{
    echo datatoword($data, '260.docx', 26);
}
