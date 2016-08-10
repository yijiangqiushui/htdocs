<?php
require_once '../../../website/html/view/template/apply/patent_implement/attach3_patent/attach3_patent.cls.php';
require_once '../../../common/php/config.ini.php';
require_once '../../../common/php/lib/db.cls.php';
include WWWPATH . 'extends/Table/TableData.php';
require_once __DIR__ . '/../word.php';
include '../../../website/php/action/class/projectFile.cls.php';

$apply = new ProjectApp ();
$db = new DB();
$data = array();
$org_code = $_SESSION ['org_code'];
$project_id=$_SESSION['project_id']; 

//企业基本情况
$arr1=$apply->find_patent3_orginfo($org_code,$project_id,"pdf");

if(!empty($arr1)){
	$data = array_merge($data,$arr1);
}
// print_r($arr1);exit();

$feature="";
$count=1;
if($arr1["checkbox0"]!=null){
	$feature=$feature.$count.".高新技术企业  ";
	$count++;
}
if($arr1["checkbox1"]!=null ){
	$feature=$feature.$count.".大专院校办的企业  ";
	$count++;
}
if($arr1["checkbox2"]!=null){
	$feature=$feature.$count.".科研院所办的企业  ";
	$count++;
}
if($arr1["checkbox3"]!=null){
	$feature=$feature.$count.".留学人员办的企业  ";
	$count++;
}
if($arr1["checkbox4"]!=null){
	$feature=$feature.$count.".科研院所整体专制企业  ";
	$count++;
}
if($arr1["checkbox5"]!=null){
	$feature=$feature.$count."其他  ";
	$count++;
}

$data["feature"]=$feature;
// print_r($arr1); exit();
//项目基本情况
$arr2=$apply->find_patent3_projectinfo($project_id,"pdf");
if(!empty($arr2)){
	$data = array_merge($data,$arr2);
}
$advantage="";
$count=1;
if($arr2["checkbox0"]!=null ){
	$advantage=$advantage.$count.".市场发展前景好    ";
	$count++;
}
if($arr2["checkbox1"]!=null ){
	$advantage=$advantage.$count.".产品或工艺创新突出  ";
	$count++;
}
if($arr2["checkbox2"]!=null){
	$advantage=$advantage.$count.".经济效益显著    ";
	$count++;
}
if($arr2["checkbox3"]!=null){
	$advantage=$advantage.$count.".社会效益显著  ";
	$count++;
}
if($arr2["checkbox4"]!=null){
	$advantage=$advantage.$count."其他  ";
	$count++;
}


$data["advantage"]=$advantage;
//项目资金情况
$arr3=$apply->findattach3_patent_fund($project_id,'pdf');
$patent_use = '';
$count = 1;
if($arr3['checkbox1'] != null){
	$patent_use = $patent_use.$count.'.知识产权费用  ';
	$count++;
}
if($arr3['checkbox2'] != null){
	$patent_use = $patent_use.$count.'.新产品开发及试制  ';
	$count++;
}
if($arr3['checkbox3'] != null){
	$patent_use = $patent_use.$count.'.新产品开发及试制  ';
	$count++;
}
if($arr3['checkbox4'] != null){
	$patent_use = $patent_use.$count.'.贷款贴息  ';
	$count++;
}

$data['patent_use'] = $patent_use;

if(!empty($arr3)){
	$data = array_merge($data,$arr3);
}

$tableData = TableData::get($project_id, 27);
$temp = $tableData['data'];



if(!empty($temp['eqpt_name'])){
	$TBL1 = array(
			'eqpt_name' => $temp['eqpt_name'],
			'sex' => $temp['sex'],
			'age' => $temp['age'],
			'rule' => $temp['rule'],
			'major' => $temp['major'],
			'depart' => $temp['depart'],
			'task' => $temp['task']
	);
}
if(!empty($TBL1)){
$data['TBL1']=$TBL1;
}
//5
$tableData1 = TableData::get($project_id, 28);
$temp2 = $tableData1['data'];
if(!empty($temp2['serial_number'])){
	$TBL2 = array(
			'serial_number' => $temp2['serial_number'],
			'stuff_name' => $temp2['stuff_name']
	);
}

// print_r($TBL2);exit();
if(!empty($TBL2)){
$data['TBL2']=$TBL2;
}

$data['comment'] = $temp2['comment'];

$TBL = $db->getDyData('patent_list', 'project_id', $project_id);
$data['TBL'] = $TBL;
$TBL3 = $db->getDyData('main_product', 'org_code', $org_code);
if(!empty($TBL3)){
    $data['TBL3']=$TBL3;
}



//6不需要
//7
$arr7=$apply->findcommunity_opinion($project_id,"pdf");
if(!empty($arr7)){
	$data = array_merge($data,$arr7);
}


switch ($data["org_type"]) {
	case 1:$data["org_type"]="集体企业";
	break;
	case 2:$data["org_type"]="股份合作企业";
	break;
	case 3:$data["org_type"]="联营企业";
	break;
	case 4:$data["org_type"]="有限责任公司";
	break;
	case 5:$data["org_type"]="股份有限公司";
	break;
	case 6:$data["org_type"]="私营企业";
	break;
	case 7:$data["org_type"]="港、澳、台商投资企业";
	break;
	case 8:$data["org_type"]="外商投资企业";
	break;
	case 9:$data["org_type"]="其他企业";
	break;
}
/*switch ($data["patent_use"]) {
	case 1:$data["patent_use"]="新产品开发及试制";
	break;
	case 2:$data["patent_use"]="购置生产用配套仪器设备";
	break;
	case 3:$data["patent_use"]="贷款贴息";
	break;
	case 4:$data["patent_use"]="知识产权费用";
	break;}
 */
if($data["legal_sex"]==0){
	$data["legal_sex"]="男";
}
if($data["legal_sex"]==1){
	$data["legal_sex"]="女";
}
//获取附件信息
$project_file_obj = new projectFile();
$project_file_obj = $project_file_obj->get_attach_lists($project_id,21);
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
    $data['ATTACH'] = $attach;}
/* 封皮上日期用阿拉伯数字显示当前年月
 * $time = showtime(); */

/* 封皮上日期用中文显示当前年月 */
$time = show_font_time();

$data = array_merge($data,$time);
//起止时间
$start=$apply->findStart_time($project_id);
$start_time=array(
		start_time=>$start["start_time"]
);
$data = array_merge($data,$start_time);
$table_status = $_GET['table_status'];
$project_type = $_GET['project_type'];
$sql = "Select * from table_type_relative where project_type_id = $project_type and table_type_id = 1 group by table_type_id";
$result = $db->Select($sql);
$db -> Close();
if($table_status == 4 || $result[0]['not_check']==1){
    echo datatoword($data, '21.docx',21);
}else{
    echo datatoword($data, '210.docx',21);
}