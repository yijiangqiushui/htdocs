<?php
require_once '../../../modules/php/action/class/applycation/attach4_patent.cls.php';
require_once '../../../common/php/config.ini.php';
require_once '../../../common/php/lib/db.cls.php';
include WWWPATH . 'extends/Table/TableData.php';
require_once __DIR__ . '/../word.php';
include '../../../website/php/action/class/projectFile.cls.php';
//datatopdf('demo', array('title' => 'aa'));
$org_code = $_SESSION ['org_code'];
$project_id = $_SESSION ['project_id'];
$apply = new APPLY ();
//
$res1=$apply->find_Abstract($project_id,"pdf");
$res2=$apply->find_orginfo($project_id,"pdf");
$res3=$apply->find_techOrg($project_id,"pdf");
$res4=$apply->find_extent($project_id,"pdf");
$res8=$apply->find_invest($project_id,"pdf");
$res5=$apply->find_market($project_id,"pdf");
$res6=$apply->find_economy($project_id,"pdf");
$res7=$apply->find_effect($project_id,"pdf");

$res1=array_merge($res1,$res2);
$res1=array_merge($res1,$res3);
$res1=array_merge($res1,$res4);
$res1=array_merge($res1,$res5);
$res1=array_merge($res1,$res6);
$res1=array_merge($res1,$res7);
$res1=array_merge($res1,$res8);


//获取附件信息
$project_file_obj = new projectFile();
$project_file_obj = $project_file_obj->get_attach_lists($project_id,22);
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
    
    
/* 封皮上日期用阿拉伯数字显示当前年月
 * $time = showtime(); */

/* 封皮上日期用中文显示当前年月 */
$time = show_font_time();

$res1 = array_merge($res1,$time);

$table_status = $_GET['table_status'];
$project_type = $_GET['project_type'];
$db = new DB();
$sql = "Select * from table_type_relative where project_type_id = $project_type and table_type_id = 1 group by table_type_id";
$result = $db->Select($sql);
$db -> Close();

if($table_status == 4 || $result[0]['not_check']==1){
    echo datatoword($res1,'22.docx',22);
}else{
    echo datatoword($res1,'220.docx',22);
}