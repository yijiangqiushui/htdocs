<?php
require_once '../../../website/html/view/template/apply/patent_implement/attach3_patent/attach3_patent.cls.php';
require_once '../../../modules/php/action/class/acceptance/expert.cls.php';
require_once '../../../common/php/config.ini.php';
require_once '../../../common/php/lib/db.cls.php';
include WWWPATH . 'extends/Table/TableData.php';
require_once __DIR__ . '/../word.php';
include '../../../website/php/action/class/projectFile.cls.php';
$apply = new Expert ();
$db = new DB();
$data = array();
 $org_code = $_SESSION ['org_code'];
 $project_id = $_SESSION ['project_id'];

$res1 = TableData::get($project_id, 47);
$res2 = TableData::get($project_id, 46);
$res3 = TableData::get($project_id, 45);
$res4 = TableData::get($project_id, 44);
$res5 = TableData::get($project_id, 42);
$res6 = TableData::get($project_id, 43);

//get start_time and end_time
$app=new ProjectApp();
$res=$app->find_start_end_time($project_id);

//$sql = "SELECT business_id FROM project_info WHERE project_id = '$project_id'";

//$business_id = $db->Select($sql);
$bu=$apply->getbusiness_id($project_id);
$data['business_id'] = $bu["business_id"];
$data['project_name']=$res['project_name'];
$data['start_time']=date('Y-m-d',$res['start_time']);
$data['end_time']=date('Y-m-d',$res['end_time']);

//项目立项背景和基本情况
if(!empty($res1["data"])){
	$data['project_back1'] = $res1['data']['project_back1'];
	$data['project_back2'] = $res1['data']['project_back2'];
}
if(!empty($res2["data"])){
	$data['project_detail1'] = $res2['data']['project_detail1'];
}
if(!empty($res3["data"])){
	$data['project_target1'] = $res3['data']['project_target1'];
}
if(!empty($res4["data"])){
	$data['item_profit1'] = $res4['data']['item_profit1'];
}

if(!empty($res5["data"])){
	$data['item_fund1'] = $res5['data']['item_fund1'];
}
if(!empty($res6["data"])){
	$data['item_plan1'] = $res6['data']['item_plan1'];
}
//获取附件信息
$project_file_obj = new projectFile();
$project_file_obj = $project_file_obj->get_attach_lists($project_id,25);
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
//获取公司名称
$res11=$app->findOrg_info($org_code);
$data["org_name"]=$res11["org_name"];


$table_status = $_GET['table_status'];
$project_type = $_GET['project_type'];
$sql = "Select * from table_type_relative where project_type_id = $project_type and table_type_id = 1 group by table_type_id";
$result = $db->Select($sql);
$db -> Close();

if($table_status == 4 || $result[0]['not_check']==1){
    echo datatoword($data,'25.docx',25);
}else{
    echo datatoword($data,'250.docx',25);
}