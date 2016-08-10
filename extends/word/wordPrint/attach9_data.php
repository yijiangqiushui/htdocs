<?php
// require_once '../../modules/php/action/page/applycation/apply9.act.php';
include '../../../modules/php/action/class/projectapp/util.cls.php';
require_once '../../../modules/php/action/class/applycation/apply9.cls.php';
require_once '../../../common/php/config.ini.php';
require_once '../../../common/php/lib/db.cls.php';
include WWWPATH . 'extends/Table/TableData.php';
require_once __DIR__ . '/../word.php';
include '../../../website/php/action/class/projectFile.cls.php';


$org_code = $_SESSION ['org_code'];
$project_id=$_SESSION['project_id'];
$db=new DB();
$arr=array();
$apply = new APPLY ();
//1
$org_info=$apply->findorg_info9 ( $org_code,$project_id,"pdf" );

$TBL1= $db -> getDyData('shareholder_info', 'org_code', $org_code);

$manager_team = $apply->find_manager_team($project_id,"pdf");  
$TBL2= $db -> getDyData('run_status', 'project_id', $project_id);
$TBL3= $db -> getDyData('influ_event', 'org_code', $org_code);
//4没有入库
//5
$hatch=$apply->find_hatch ( $project_id,"pdf" );


$arr1=array_merge($org_info,$hatch,$manager_team);

// $arr1=array_merge($org_info,$hatch);
$findman_state=$apply->findman_state ( $project_id,"pdf" ); 

for($i=0 ; $i<3 ; $i++){
    $the_year['the_year'.$i] = $findman_state["the_year[$i]"];
    $the_year['sum_income'.$i] = $findman_state["sum_income[$i]"];
    $the_year['house_income'.$i] = $findman_state["house_income[$i]"];
    $the_year['propert_income'.$i] = $findman_state["propert_income[$i]"];
    $the_year['invest_income'.$i] = $findman_state["invest_income[$i]"];
    $the_year['public_income'.$i] = $findman_state["public_income[$i]"];
    $the_year['plat_invest'.$i] = $findman_state["plat_invest[$i]"];
    $the_year['profit'.$i] = $findman_state["profit[$i]"];
    $the_year['hand_tax'.$i] = $findman_state["hand_tax[$i]"];
    $the_year['seed_total_fund'.$i] = $findman_state["seed_total_fund[$i]"];
    $the_year['seed_invest_fund'.$i] = $findman_state["seed_invest_fund[$i]"];
    $the_year['hatch_com_num'.$i] = $findman_state["hatch_com_num[$i]"];
    $the_year['public_service_fund'.$i] = $findman_state["public_service_fund[$i]"];
    $the_year['public_service_sum'.$i] = $findman_state["public_service_sum[$i]"];
    
}


//6
$arr6=$apply->find_special($project_id,"pdf");
//7
$arr7=$apply->find_running($project_id, "pdf");
//8
$arr8=$apply->find_influence($project_id, "pdf");
//9
$arr9=$apply->find_service_job($project_id,"pdf");
//10
$arr10=$apply->find_abstract($project_id, "pdf");



$arr2=array_merge($arr6,$arr7,$arr8,$arr9,$arr10);
$arr=array_merge($arr1,$arr2);
$arr['TBL1']=$TBL1;
$arr['TBL2']=$TBL2;
$arr['TBL3']=$TBL3;

$arr = array_merge($arr,$the_year);

$temp = TableData::get($project_id, 1929);
$data = (array)$temp['data'];

$arr = array_merge($arr,$data);
// var_dump($data);
// exit();

//修改是否
//getAttr函数移植到word.php里了
$arr = getAttr("business_register","business_register1","business_register2","business_register3","business_register4",$arr);
$arr =getAttr("staff_agent","staff_agent1","staff_agent2","staff_agent3","staff_agent4",$arr);
$arr =getAttr("staff_recruit","staff_recruit1","staff_recruit2","staff_recruit3","staff_recruit4",$arr);
$arr =getAttr("fund_declare","fund_declare1","fund_declare2","fund_declare3","fund_declare4",$arr);
$arr =getAttr("tax_agent","tax_agent1","tax_agent2","tax_agent3","tax_agent4",$arr);
$arr =getAttr("law_ser","law_ser1","law_ser2","law_ser3","law_ser4",$arr);
$arr =getAttr("right_agent","right_agent1","right_agent2","right_agent3","right_agent4",$arr);
$arr =getAttr("publictech_plat","publictech_plat1","publictech_plat2","publictech_plat3","publictech_plat4",$arr);
$arr =getAttr("bsy_input","bsy_input1","bsy_input2","bsy_input3","bsy_input4",$arr);
$arr =getAttr("financ_assure","financ_assure1","financ_assure2","financ_assure3","financ_assure4",$arr);
$arr =getAttr("mode_reform","mode_reform1","mode_reform2","mode_reform3","mode_reform4",$arr);
$arr =getAttr("info_ask","info_ask1","info_ask2","info_ask3","info_ask4",$arr);
$arr =getAttr("info_consult","info_consult1","info_consult2","info_consult3","info_consult4",$arr);
$arr =getAttr("bsy_lecture","bsy_lecture1","bsy_lecture2","bsy_lecture3","bsy_lecture4",$arr);
$arr =getAttr("trade_comm","trade_comm1","trade_comm2","trade_comm3","trade_comm4",$arr);
$arr =getAttr("product_stru","product_stru1","product_stru2","product_stru3","product_stru4",$arr);
$arr =getAttr("market_expand","market_expand1","market_expand2","market_expand3","market_expand4",$arr);
//获取附件信息
$project_file_obj = new projectFile();
$project_file_obj = $project_file_obj->get_attach_lists($project_id,9);
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

$res=$apply->find_project_name($project_id);
$arr['project_name']=$res['project_name'];
ob_clean();
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
    echo datatoword($arr, '9.docx',9);
}else{
    echo datatoword($arr, '900.docx',9);
}