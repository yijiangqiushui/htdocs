<?php
/**
 author:wangyi
 date:2015-11-11
 */

include '../../class/projectapp/projectapp.cls.php';
include '../../../../../center/php/config.ini.php';
include '../../../../../common/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';
include '../../class/applycation/apply6.cls.php';

include '../../../../../common/php/plugin/fenci_v1.0_utf8/checkduplicate.cls.php';

$action = $_GET['action'];
// project_id and org_id
$project_id = $_SESSION['project_id'];
 //$project_id = '0123456';2015/11/26修改过来
$org_code = $_SESSION['org_code'];
 //$org_code = '012345678';
 // 附件6 org_info.html
 
 $registerInfo['org_code']=$org_code;
 $registerInfo['org_name'] = $_POST['app_com_name'];
 $registerInfo['register_address'] = $_POST['com_reg_add'];
 $registerInfo['register_fund'] = $_POST['app_com_fund'];
 $registerInfo['contact_address'] = $_POST['com_com_add'];
 $registerInfo['postal'] = $_POST['app_com_post'];
/*  $registerInfo['linkman'] = $_POST['com_contact_name'];
 $registerInfo['linkman_email'] = $_POST['com_contact_email'];
 $registerInfo['linkman_contact '] = $_POST['com_contact_tel']; */
 $registerInfo['org_type'] = $_POST['reg_type'];
 $registerInfo['org_trade'] = $_POST['com_trade'];
 $registerInfo['org_bank'] = $_POST['com_bank'];
 $registerInfo['username'] = $_POST['bank_name'];
 $registerInfo['account'] = $_POST['com_trade'];
 
 $linkmanInfo["linkman"]= $_POST ['com_contact_name'];
 $linkmanInfo["linkman_email"]= $_POST ['com_contact_email'];
 $linkmanInfo["linkman_contact"]= $_POST ['com_contact_tel'];
 
 
 
 $registerLegal['org_code']=$org_code;
 $registerLegal['legal_name'] = $_POST['com_legal_name'];
 $registerLegal['legal_id'] = $_POST['com_legal_ID'];
 $registerLegal['legal_phone'] = $_POST['com_legao_tel'];
 
 $applyAward['org_code']=$org_code;
 $applyAward['expect_contractNums'] = $_POST['execpt_cont_num'];
 $applyAward['expect_contractMoney'] = $_POST['execpt_cont_fund'];
 $applyAward['previous_taxes'] = $_POST['first_tax'];
 $applyAward['check_amount'] = $_POST['check_fund'];
 $applyAward['award_level'] = $_POST['reward_level'];
 $applyAward['sc_opinion'] = $_POST['sc_opinion'];
 $applyAward['contractMoney']=$_POST['contractMoney'];
 
 //获取动态列表的数据
 $contract_code = (array)$_POST['contract_code'];
 $project_name = (array)$_POST['project_sname'];
 $affirm_time = (array)$_POST['affirm_time'];
 $contract_price = (array)$_POST['contract_price'];
 
 $technical_contract = array();
 $length = 0;
 //foreach($stock_ratio as $key=>$value){
 while (list($key, $val) = each($contract_code)) {
     $technical_contract[$length]['org_code'] = $org_code;
     $technical_contract[$length]['contract_code'] = $contract_code[$key];
     $technical_contract[$length]['project_name'] = $project_name[$key];
     $technical_contract[$length]['affirm_time'] = $affirm_time[$key];
     $technical_contract[$length]['contract_price'] = $contract_price[$key];
     $length = $length + 1;
 }
 
 
 $apply=new APPLY();
 switch($action){
     case '6orgInfo':
         $apply->org_info6($org_code, $registerInfo, $registerLegal, $applyAward,$technical_contract,$linkmanInfo,$project_id);
         break;
     case '6findOrgInfo':
         $apply->find_org_info6($org_code,$project_id);
         break;
     default:;
         
 }