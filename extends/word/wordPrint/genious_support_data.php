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
$username = $_SESSION['username'];
//1
$res1=$projectapp->findinfo_award($org_code,$project_id,1,"pdf",$username);
//2
$res2=$projectapp->findwork_product($project_id,1,"pdf");
//3
$res3=$projectapp->findhonor_title($project_id,1,"pdf");
//4
$res4=$projectapp->findsituation($project_id,1,"pdf");
//5
$res5=$genious_cls->findStateMent($project_id,array("flag"=>1 ),"pdf");
//6
$res6=$projectapp->findunit_opinion($project_id,1,"pdf");
//7
$res7=$projectapp->findfirst_opinion($project_id,1,"pdf");
//8
$res8=$projectapp->findreview_opinion($project_id,1,"pdf");
//9
$res9=$projectapp->findfinal_opinion($project_id,1,"pdf");


$res1=array_merge($res1,$res2);
$res1=array_merge($res1,$res3);
$res1=array_merge($res1,$res4);
$res1=array_merge($res1,$res5);
$res1=array_merge($res1,$res6);
$res1=array_merge($res1,$res7);
$res1=array_merge($res1,$res8);
$res1=array_merge($res1,$res9);
/* 封皮上日期用阿拉伯数字显示当前年月
 * $time = showtime(); */

/* 封皮上日期用中文显示当前年月 */
$time = show_font_time();
$last_year = lastyear();

$res1 = array_merge($res1,$time);
$res1 = array_merge($res1,$last_year);


//获取附件信息
$project_file_obj = new projectFile();
$project_file_obj = $project_file_obj->get_attach_lists($project_id,19);
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

$table_status = $_GET['table_status'];
$project_type = $_GET['project_type'];
$db = new DB();
$sql = "Select * from table_type_relative where project_type_id = $project_type and table_type_id = 1 group by table_type_id";
$result = $db->Select($sql);
$db -> Close();

if($table_status == 4 || $result[0]['not_check']==1){
    echo datatoword($res1,'19.docx',19);
}else{
    echo datatoword($res1,'190.docx',19);
}