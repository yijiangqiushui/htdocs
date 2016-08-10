<?php
include '../../../modules/php/action/class/implement/middle.cls.php';
require_once '../../../common/php/config.ini.php';
require_once '../../../common/php/lib/db.cls.php';
include WWWPATH . 'extends/Table/TableData.php';
require_once __DIR__ . '/../word.php';
include '../../../website/php/action/class/projectFile.cls.php';
session_start();
$project_id = $_SESSION['project_id'];
$middle = new Middle(); 

$arr1=$middle->findProMiddle_pdf($project_id,'project_middle', 'project_id'); 
$arr2=$middle->findProjectFund_pdf($project_id,'project_middle', 'project_id');
$arr3=$middle->findProProble_pdf($project_id, 'project_middle', 'project_id');
$arr1['fund_use']=$arr2['fund_use'];
$arr1['problem_action']=$arr3['problem_action'];

//获取附件信息
$project_file_obj = new projectFile();
$project_file_obj = $project_file_obj->get_attach_lists($project_id,15);
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
    $arr1['ATTACH'] = $attach; }
/* 封皮上日期用阿拉伯数字显示当前年月
 * $time = showtime(); */

/* 封皮上日期用中文显示当前年月 */
$time = show_font_time();

$arr1 = array_merge($arr1,$time);
echo datatoword($arr1,'15.docx',15);