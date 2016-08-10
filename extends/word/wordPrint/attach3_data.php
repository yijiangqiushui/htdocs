<?php
include '../../../common/php/config.ini.php';
include '../../../common/php/lib/db.cls.php';
require_once __DIR__ . '/../word.php';
require_once '../../../modules/php/action/class/projectapp/projectapp.cls.php';
require_once '../../../modules/php/action/class/applycation/apply3.cls.php';
include '../../../website/php/action/class/projectFile.cls.php';


$db=new DB();
$apply = new APPLY ();
$projectApp = new ProjectApp ();
$org_code = $_SESSION ['org_code'];
$project_id = $_SESSION ['project_id'];
// $org_code = 'zgf001';
// $project_id = 'dev1451718105';
$arr=array();
$org_info=$apply->find3OrgInfo ( $org_code,$project_id,"pdf" );

$project_info=$apply->find3ProInfo ( $project_id,"pdf" );
if(!empty($org_info)){
	$arr=array_merge($arr,$org_info);
}
if(!empty($project_info)){
	$arr = array_merge($arr,$project_info);
}

$ProjectApp = new ProjectApp ();
$approve=$ProjectApp->findOpin (  $project_id, 'project_info', 'project_id',"pdf" );

if(!empty($approve)){
	$arr = array_merge($arr,$approve);
	$data['business_id'] = $approve['business_id'];
}

if($arr["listed"]=="1"){
	$arr["listed"]="是";
}else{
	$arr["listed"]="否";
	
}

$TBL1=$db->getDyData("tech_material", "project_id", $project_id);
if(!empty($TBL1)){
	$arr["TBL1"]=$TBL1;
}
//获取附件信息
$project_file_obj = new projectFile();
$project_file_obj = $project_file_obj->get_attach_lists($project_id,3);
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
    echo datatoword($arr,'3.docx' , 3);
}else{
    echo datatoword($arr,'300.docx' , 3);
}