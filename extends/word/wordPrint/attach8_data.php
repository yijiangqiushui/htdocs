<?php
require_once '../../../common/php/lib/db.cls.php';
require_once '../../../common/php/config.ini.php';
require_once '../../../modules/php/action/class/applycation/apply8.cls.php';
require_once __DIR__ . '/../word.php';
include '../../../website/php/action/class/projectFile.cls.php';

session_start();
$org_code=$_SESSION['org_code'];
$project_id=$_SESSION['project_id']; 

$apply=new APPLY();
$arr=$apply->find_org_info8_pdf($org_code,$project_id); 
//封皮儿
$res30=$apply->findProjectInfo($project_id,$org_code);



if(!empty($res30)){
	$arr = array_merge($arr,$res30);
}
//获取附件信息
$project_file_obj = new projectFile();
$project_file_obj = $project_file_obj->get_attach_lists($project_id,8);
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
$db = new DB();
$sql = "Select * from table_type_relative where project_type_id = $project_type and table_type_id = 1 group by table_type_id";
$result = $db->Select($sql);
$db -> Close();

if($table_status == 4 || $result[0]['not_check']==1){
    echo datatoword($arr, '8.docx',8);
}else{
    echo datatoword($arr, '800.docx',8);
}



?>



