<?php
require_once '../../../modules/php/action/class/projectapp/projectapp.cls.php';
require_once '../../../modules/php/action/class/genious/genious.cls.php';
require_once '../../../common/php/config.ini.php';
require_once '../../../common/php/lib/db.cls.php';
include WWWPATH . 'extends/Table/TableData.php';
require_once __DIR__ . '/../word.php';
include '../../../website/php/action/class/projectFile.cls.php';
$projectapp = new ProjectApp();
$genious_cls = new Genious();

$org_code = $_SESSION ['org_code'];
$project_id = $_SESSION ['project_id'];
$username = $_SESSION ['username'];
$data = array();
//1
$res1=$projectapp->findinfo_award($org_code,$project_id,0,"pdf",$username);
//2
$res2=$projectapp->findwork_product($project_id,0,"pdf");
//3
$res3=$projectapp->findhonor_title($project_id,0,"pdf");
//4
$res4=$projectapp->findsituation($project_id,0,"pdf");
//5
$res5=$genious_cls->findStateMent($project_id,array("flag"=>0 ),"pdf");
//6
$res6=$projectapp->findunit_opinion($project_id,0,"pdf");
//7
$res7=$projectapp->findfirst_opinion($project_id,0,"pdf");
//8
$res8=$projectapp->findreview_opinion($project_id,0,"pdf");
//9
$res9=$projectapp->findfinal_opinion($project_id,0,"pdf");
$data=array_merge($data,$res1);
$data=array_merge($data,$res2);
$data=array_merge($data,$res3);
$data=array_merge($data,$res4);
$data=array_merge($data,$res5);
$data=array_merge($data,$res6);
$data=array_merge($data,$res7);
$data=array_merge($data,$res8);
$data=array_merge($data,$res9);

//获取附件信息
$project_file_obj = new projectFile();
$project_file_obj = $project_file_obj->get_attach_lists($project_id,20);
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
$last_year = lastyear();
$data = array_merge($data,$time);
$data = array_merge($data,$last_year);
$table_status = $_GET['table_status'];
$project_type = $_GET['project_type'];
$db = new DB();
$sql = "Select * from table_type_relative where project_type_id = $project_type and table_type_id = 1 group by table_type_id";
$result = $db->Select($sql);
$db -> Close();
if($table_status == 4 || $result[0]['not_check']==1){
    echo datatoword($data,'20.docx',20);
}else{
    echo datatoword($data,'201.docx',20);
}