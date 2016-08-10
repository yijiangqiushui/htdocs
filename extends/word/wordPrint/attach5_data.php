<?php
require_once '../../../common/php/config.ini.php';
require_once '../../../common/php/lib/db.cls.php';
require_once __DIR__ . '/../word.php';
require_once '../../../modules/php/action/class/applycation/apply5.cls.php';
include '../../../website/php/action/class/projectFile.cls.php';

session_start();
$org_code=$_SESSION['org_code'];
$project_id=$_SESSION['project_id'];
//$org_code = 'zgf001';
$apply=new APPLY();
$db = new DB();
$arr=$apply->find5OrgInfo1($org_code,$project_id); 
$sql = "SELECT business_id FROM project_info WHERE project_id='$project_id'"; 
$business_id = $db->Select($sql);
$arr['business_id'] = $business_id[0]['business_id'];

//获取附件信息
$project_file_obj = new projectFile();
$project_file_obj = $project_file_obj->get_attach_lists($project_id,5);
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

$table_status = $_GET['table_status'];
$project_type = $_GET['project_type'];
$sql = "Select * from table_type_relative where project_type_id = $project_type and table_type_id = 1 group by table_type_id";
$result = $db->Select($sql);
$db -> Close();

if($table_status == 4 || $result[0]['not_check']==1){
    echo datatoword($arr, '5.docx',5);
}else{
    echo datatoword($arr, '500.docx',5);
}
?>


