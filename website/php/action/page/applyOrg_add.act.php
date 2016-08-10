<?php

/**
 * 文件描述
 * @author david <david55555.hi@gmail.com>
 * @date 2015年11月20日 上午9:49:03
 * @version 1.0.0
 * @copyright  david
 * @function 
 * 1:正常
 * 0：发生错误
 */
include '../../../../common/php/config.ini.php';
include '../../../../common/php/lib/db.cls.php';
include '../../../../common/php/lib/file.cls.php';
include '../../../../common/php/lib/user.cls.php';


$user = new USER ();
$org_code = $_SESSION['org_code'];
$legalPerson ['legal_name'] = $_POST ['legalPerson'];
$legalPerson ['org_code']= $org_code;
$legalPerson ['legal_phone'] = $_POST ['legal_phone'];


$org_info ['org_code'] = $org_code;
$org_info ['org_name'] = $_POST ['org_name'];
$_SESSION['org_name'] = $org_info ['org_name'];

$org_info ['register_address'] = $_POST ['register_address'];
$org_info ['contact_address'] = $_POST ['contact_address'];
$org_info ['phone'] = $_POST ['phone'];
$org_info ['email'] = $_POST ['email'];
$folder = date("Y-m-d");
// Define a destination
$targetFolder = '/website/html/upload/legal/'.$folder; // Relative to the root
$org_info ['legal_pub_pic'] = mysql_escape_string($targetFolder."/".$_POST ['file1']);
$org_info ['legal_reg_pic'] = mysql_escape_string($targetFolder."/".$_POST ['file']);

$db=new DB();
//有企业的信息则更新，没有则插入企业的信息
$data = array();
$result = $db -> UpdateTabData('org_info', $org_code, $org_info, 'org_code');

// echo $result;
$result_person = $db -> UpdateTabData('legal_person', $org_code, $legalPerson, 'org_code');
if ($result != 0) {
	$data ['code'] = 1;
} else {
	$data ['code'] = 0;
}
echo json_encode ( $data );

$db->Close ();

?>