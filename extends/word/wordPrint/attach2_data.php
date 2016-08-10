<?php

require_once '../../../modules/php/action/class/applycation/apply2.cls.php';
require_once '../../../modules/php/action/class/projectapp/projectapp.cls.php';
require_once '../../../common/php/config.ini.php';
require_once '../../../common/php/lib/db.cls.php';
require_once __DIR__ . '/../word.php';
include '../../../website/php/action/class/projectFile.cls.php';


//datatopdf('demo', array('title' => 'aa'));
$apply = new APPLY ();
$org_code = $_SESSION ['org_code'];
$project_id = $_SESSION ['project_id'];
// $project_id = dev1452061335 ;
//org_info 
$org_info=$apply->find2OrgInfo ( $org_code,$project_id,"pdf" );
$coorg_info=$apply->find2CoorgInfo ( $org_code,"pdf" );
$coor_info_rep= array(
		'coorg_name' => $coorg_info ['coorg_name'],
		'coorg_code' => $coorg_info ['coorg_code'],
		'co_register_fund' => $coorg_info ['register_fund'],//
		'co_register_address' => $coorg_info ['register_address'],//
		'co_org_type' => $coorg_info ['org_type'],//
		'co_contact_address' => $coorg_info ['contact_address'],//
		'co_postal' => $coorg_info ['postal'],//
		'co_linkman' => $coorg_info ['linkman'],//
		'co_linkman_email' => $coorg_info ['linkman_email'],//
		'co_linkman_contact' => $coorg_info ['linkman_contact'],//
		'co_coorg_summary' => $coorg_info ['coorg_summary'],//
		
		'co_legal_name' => $coorg_info ['legal_name'],//
		'co_legal_id' => $coorg_info ['legal_id'],//
		'co_legal_phone' => $coorg_info ['legal_phone'],//
		
		'co_patent_num' => $coorg_info ['patent_num'],//
		'co_invent_patent' => $coorg_info ['invent_patent'],//
		'co_functional_patent' => $coorg_info ['functional_patent'],//
		'co_patent_design' => $coorg_info ['patent_design'],//
		'co_other_patent' => $coorg_info ['other_patent']//
		
);
$arr1=array_merge($org_info,$coor_info_rep);
$project_info=$apply->find2ProInfo ( $project_id,"pdf" );
$arr2=array_merge($arr1,$project_info);
$ProjectApp = new ProjectApp ();
$approve=$ProjectApp->findOpin (  $project_id, 'project_info', 'project_id',"pdf" );
if(!empty($approve)){
	$data = array_merge($arr2,$approve);
	$data['business_id'] = $approve['business_id'];
}

$temp = $ProjectApp->find_material($project_id);

foreach ($temp as $key => $value){
	$intel_property[$key] = $value['intel_property'];
}
foreach ($temp as $key => $value){
	$type[$key] = $value['type'];
}
foreach ($temp as $key => $value){
	$auth_code[$key] = $value['auth_code'];
}
$TBL1 = array(
		'intel_property' => $intel_property,
		'type' => $type,
		'auth_code' => $auth_code
);


$data['TBL1'] = $TBL1;
// var_dump($data);
// exit();
if($data["listed"]==1){
	$data["listed"]="是";
}else{
	$data["listed"]="否";
}

//获取附件信息
$project_file_obj = new projectFile();
$project_file_obj = $project_file_obj->get_attach_lists($project_id,2);
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

$data = array_merge($data,$time);

$table_status = $_GET['table_status'];
$project_type = $_GET['project_type'];
$db = new DB();
$sql = "Select * from table_type_relative where project_type_id = $project_type and table_type_id = 1 group by table_type_id";
$result = $db->Select($sql);
$db -> Close();

if($table_status == 4 || $result[0]['not_check']==1){
    echo datatoword($data,'2.docx' , 2);
}else{
    echo datatoword($data,'200.docx' , 2);
}