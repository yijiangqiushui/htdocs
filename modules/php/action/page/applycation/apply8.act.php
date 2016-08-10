<?php
/**
 author:wangyi
 date:2015-11-11
 */

include '../../class/projectapp/projectapp.cls.php';
include '../../../../../center/php/config.ini.php';
include '../../../../../common/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';
include '../../class/applycation/apply8.cls.php';

include '../../../../../common/php/plugin/fenci_v1.0_utf8/checkduplicate.cls.php';

$action = $_GET['action'];
// project_id and org_id
$project_id = $_SESSION['project_id'];
 //$project_id = '0123456';
$org_code = $_SESSION['org_code'];
 //$org_code = '012345678';
 
 // 附件8 org_info.html(是否可以与重复的部分合并)（对应一下4个表）
 $orgInfo8['org_code']=$org_code;
 $orgInfo8['org_name'] = $_POST['app_com_name'];
 $orgInfo8['org_code '] = $_POST['app_com_code'];
 $orgInfo8['register_fund'] = $_POST['app_com_fund'];
 $orgInfo8['register_address'] = $_POST['com_reg_add'];
 $orgInfo8['org_type'] = $_POST['com_type'];
 $orgInfo8['contact_address'] = $_POST['com_com_add'];
 $orgInfo8['postal'] = $_POST['com_post'];
 $orgInfo8['listed'] = $_POST['listed'];
 $orgInfo8['listed_code'] = $_POST['listed_code'];
 $orgInfo8['main_product'] = $_POST['main_product'];
 
/*  $orgInfo8['linkman'] = $_POST['linkman'];
 $orgInfo8['linkman_contact'] = $_POST['linkman_contact'];
 $orgInfo8['linkman_email'] = $_POST['linkman_email']; */
 $linkmanInfo["linkman"]= $_POST ['linkman'];
 $linkmanInfo["linkman_email"]= $_POST ['linkman_email'];
 $linkmanInfo["linkman_contact"]= $_POST ['linkman_contact'];
 
 $orgInfo8['last_contractNum'] = $_POST['last_contractNum'];
 $orgInfo8['last_contractPrice'] = $_POST['last_contractPrice'];
 $orgInfo8['predict_contractNum'] = $_POST['predict_contractNum'];
 $orgInfo8['predict_contractPrice'] = $_POST['predict_contractPrice'];
 $orgInfo8['org_trade'] = $_POST['org_trade'];
 
 
 
 $staff_info ['org_code'] = $org_code;
 $staff_info ['staff_num'] = $_POST ['staff_num'];
 $staff_info ['junior'] = $_POST ['junior'];
 $staff_info ['researcher_num'] = $_POST ['researcher_num'];
 
 
 
 $legalDelegate['org_code']=$org_code;
 $legalDelegate['legal_name'] = $_POST['com_legal_name'];
 $legalDelegate['legal_id'] = $_POST['com_legal_ID'];
 $legalDelegate['legal_phone'] = $_POST['com_legal_tel'];
 
 
 $profitTax['org_code']=$org_code;
 $profitTax['lastmarket_income']=$_POST['first_income'];
 $profitTax['last_tax']=$_POST['first_tax'];
 $profitTax['last_profit']=$_POST['first_profit'];
 $profitTax['predict_income']=$_POST['expect_income'];
 $profitTax['predict_tax']=$_POST['expect_tax'];
 $profitTax['predict_profit']=$_POST['expect_profit'];
 
 $intelProperty['org_code']=$org_code;
 $intelProperty['patent_num'] = $_POST['patent_num'];
 $intelProperty['invent_patent'] = $_POST['patent_invent'];
 $intelProperty['functional_patent'] = $_POST['patent_new'];
 $intelProperty['patent_design'] = $_POST['patent_design'];
 $intelProperty['other_patent'] = $_POST['other_patent_num'];
 
 $project_info['project_summary']=$project_id;
 $project_info['project_summary']=$_POST['project_summary'];
 
 $apply=new APPLY();
 switch($action){ 
     case '8orgInfo':
         $apply->org_info8($project_id,$project_info,$org_code,$staff_info, $orgInfo8, $legalDelegate, $intelProperty, $profitTax,$linkmanInfo,$project_id);
         break;
     case "8findOrgInfo":
        
         $apply->find_org_info8($org_code,$project_id);
         break;
     default:;
 }
 
 