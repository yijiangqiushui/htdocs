<?php
/**
 author:mac
 date:2015-11-24
 */
include '../../../../../common/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';
include '../../class/applycation/apply11.cls.php';

include '../../../../../common/php/plugin/fenci_v1.0_utf8/checkduplicate.cls.php';

$action = $_GET['action'];
$page = $_POST['page'];
$rows = $_POST['rows'];

// 申请单位基本信息
// project_id and org_id
$project_id = $_SESSION['project_id'];
// $project_id = '0123456';
$org_code = $_SESSION['org_code'];
//  $org_code = '012345678';

/* org_info 附件11 */
$org11_info['org_code'] = $org_code;
$org11_info['org_name'] = $_POST['org_name']; // org_info
$org11_info['register_address'] = $_POST['register_address']; // org_info
$org11_info['register_fund'] = $_POST['register_fund']; // org_info
$org11_info['contact_address'] = $_POST['contact_address']; // org_info
/* $org11_info['linkman'] = $_POST['linkman']; // org_info
$org11_info['linkman_email'] = $_POST['linkman_email']; // org_info
$org11_info['linkman_contact'] = $_POST['linkman_contact']; // org_info */
$org11_info['org_type'] = $_POST['org_type']; // org_info
$org11_info['org_trade'] = $_POST['org_trade'];
$org11_info['postal'] = $_POST['postal'];
$org11_info['org_bank'] = $_POST['org_bank']; // org_info
$org11_info['username'] = $_POST['username']; // org_info
$org11_info['account'] = $_POST['account']; // org_info

$linkmanInfo["linkman"]= $_POST['linkman'];
$linkmanInfo["linkman_email"]= $_POST['linkman_email'];
$linkmanInfo["linkman_contact"]= $_POST['linkman_contact'];



$org11_legal['org_code'] = $org_code;
$org11_legal['legal_name'] = $_POST['legal_name']; // legal_person
$org11_legal['legal_id'] = $_POST['legal_id']; // legal_person
$org11_legal['legal_phone'] = $_POST['legal_phone']; // legal_person

$org11_award['org_code'] = $org_code;
$org11_award['expect_contractNums'] = $_POST['expect_contractNums']; // apply_award
$org11_award['expect_contractMoney'] = $_POST['expect_contractMoney']; // apply_award
$org11_award['previous_taxes'] = $_POST['previous_taxes']; // apply_award
$org11_award['check_amount'] = $_POST['check_amount']; // apply_award
$org11_award['award_level'] = $_POST['award_level'];
$org11_award['contractMoney'] = $_POST['contractMoney'];


/*
 * $org11_and['org_code'] = $org_code;
 * $org11_and['contract_code'] = $_POST['contract_code'];//technical_contract
 * $org11_and['project_name'] = $_POST['project_name'];//technical_contract
 * $org11_and['affirm_time'] = $_POST['affirm_time'];//technical_contract
 * $org11_and['contract_price'] = $_POST['contract_price'];//technical_contract
 */

$contract_code = (array) $_POST['contract_code'];
$project_name = (array) $_POST['project_name'];
$affirm_time = (array) $_POST['affirm_time'];
$contract_price = (array) $_POST['contract_price'];
$length = 0;
while (list ($key, $val) = each($contract_code)) {
    $technical_contract[$length]['org_code'] = $org_code;
    $technical_contract[$length]['contract_code'] = $contract_code[$key];
    $technical_contract[$length]['project_name'] = $project_name[$key];
    $technical_contract[$length]['affirm_time'] = $affirm_time[$key];
    $technical_contract[$length]['contract_price'] = $contract_price[$key];
    $length = $length + 1;
}

$apply = new APPLY();
switch ($action) {
    case '11orgInfo':
        $apply->org_info11($org_code, $org11_info, $org11_legal, $technical_contract, $org11_award,$linkmanInfo,$project_id);
        break;
    case 'find11orgInfo': // 自动加载数据（回显）
        $apply->find11orgInfo($org_code,$project_id,"");
        break;
    default:
        ;
}

?>