<?php
require_once '../../../modules/php/action/class/applycation/apply11.cls.php';
require_once '../../../common/php/config.ini.php';
require_once '../../../common/php/lib/db.cls.php';
require_once __DIR__ . '/../word.php';
include '../../../website/php/action/class/projectFile.cls.php';

//datatopdf('demo', array('title' => 'aa'));
$apply = new APPLY ();
$org_code = $_SESSION ['org_code'];
$project_id=$_SESSION['project_id'];
//org_info
$org_info=$apply->find11orgInfo ( $org_code,$project_id,"pdf" );
//动态列表
$db=new DB();
$TBL1= $db -> getDyData('technical_contract', 'org_code', $org_code);
$org_info['TBL1']=$TBL1;
/* 封皮上日期用阿拉伯数字显示当前年月
 * $time = showtime(); */

/* 封皮上日期用中文显示当前年月 */
$time = show_font_time();

$table_status = $_GET['table_status'];
$project_type = $_GET['project_type'];
$sql = "Select * from table_type_relative where project_type_id = $project_type and table_type_id = 1 group by table_type_id";
$result = $db->Select($sql);
$db -> Close();

//获取附件信息
$project_file_obj = new projectFile();
$project_file_obj = $project_file_obj->get_attach_lists($project_id,11);
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
    $org_info['ATTACH'] = $attach; }

$org_info = array_merge($org_info,$time);
if($table_status == 4 || $result[0]['not_check']==1){
    echo datatoword($org_info, '11.docx',11);
}else{
    echo datatoword($org_info, '110.docx',11);
}
