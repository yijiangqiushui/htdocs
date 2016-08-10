<?php
require_once '../../../common/php/lib/db.cls.php';
require_once '../../../common/php/config.ini.php';
require_once '../../../modules/php/action/class/applycation/apply6.cls.php';
require_once __DIR__ . '/../word.php';
include '../../../website/php/action/class/projectFile.cls.php';


session_start();
$org_code=$_SESSION['org_code'];
$project_id=$_SESSION['project_id'];
$apply=new APPLY();
$arr=$apply->find_org_info6_pdf($org_code); 
$db = new db ();
/* $result=$db->GetInfo_word($org_code, 'technical_contract', 'org_code');
$tableRow = mysql_num_rows($result);
 for($i = 0; $i < $tableRow; $i++){
  
     $arr['TBL1']=$result[$i];
}  */

$TBL1= $db -> getDyData('technical_contract', 'org_code', $org_code);
/* $param=array(
    "contract_code",
    "project_name",
    "affirm_time",
    "contract_price",
    
);
$arr['TBL1']= $db->getAppointField('technical_contract', 'org_code', $org_code,$param); */
$arr['TBL1']=$TBL1;
$sql = "SELECT business_id FROM project_info WHERE project_id = '$project_id'";
$business_id = $db->Select($sql);
$arr['business_id'] = $business_id[0]['business_id'];

$project_file_obj = new projectFile();
$project_file_obj = $project_file_obj->get_attach_lists($project_id,6);
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
    echo datatoword($arr, '6.docx',6);
}else{
    echo datatoword($arr, '600.docx',6);
}
?>



