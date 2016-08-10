<?php
include '../../../modules/php/action/class/projectapp/util.cls.php';
require_once '../../../modules/php/action/class/applycation/apply10.cls.php';
require_once '../../../common/php/config.ini.php';
require_once '../../../common/php/lib/db.cls.php';
require_once __DIR__ . '/../word.php';
include '../../../website/php/action/class/projectFile.cls.php';
//datatopdf('demo', array('title' => 'aa'));
$apply = new APPLY ();
$org_code = $_SESSION ['org_code'];
$project_id=$_SESSION['project_id'];
//org_info1
$org_info=$apply->find10orgInfo ( $org_code,$project_id,"pdf" );

//1动态列表
$db=new DB();
$TBL1= $db -> getDyData('shareholder_info', 'org_code', $org_code);

//2
$manager_team=$apply->find10service_team ( $project_id,"pdf" );
//3没成功
$findman_state=$apply->find10manager_fm ( $org_code,"pdf" );
/* $TBL2=array(
    'the_year0'=>$findman_state['the_year[0]'],
    'the_year1'=>$findman_state['the_year[1]'],
    'the_year2'=>$findman_state['the_year[2]'] 
); */
for($i=0 ; $i<3 ; $i++){
    $the_year['the_year'.$i] = $findman_state["the_year[$i]"];
    $the_year['total_income'.$i] = $findman_state["total_income[$i]"];
    $the_year['prof_tech'.$i] = $findman_state["prof_tech[$i]"];
    $the_year['other_income'.$i] = $findman_state["other_income[$i]"];
    $the_year['profit'.$i] = $findman_state["profit[$i]"];
    $the_year['hand_tax'.$i] = $findman_state["hand_tax[$i]"];
    $the_year['public_inve_sum'.$i] = $findman_state["public_inve_sum[$i]"];
    $the_year['public_service_income'.$i] = $findman_state["public_service_income[$i]"]; 
}
$arr1=array_merge($org_info,$manager_team);
// print_r(array_merge($arr1,$findman_state));
// array_merge($a1,$a2) 合并数组
//4没入库

//5
$arr5=$apply->find_sp($project_id,"pdf");
//6
$arr6=$apply->find_service_thing($project_id ,"pdf");
//7
$arr7=$apply->find_ser_job ( $project_id ,"pdf");
//8
$arr8=$apply->find_ab ( $project_id ,"pdf");

$arr2=array_merge($arr5,$arr6,$arr7,$arr8);
$arr=array_merge($arr1,$arr2,$the_year);
$arr['TBL1']=$TBL1;

//获取附件信息
$project_file_obj = new projectFile();
$project_file_obj = $project_file_obj->get_attach_lists($project_id,10);
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
    echo datatoword($arr, '10.docx',10);
}else{
    echo datatoword($arr, '101.docx',10);
}