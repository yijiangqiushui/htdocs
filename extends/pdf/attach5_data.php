<?php
require_once __DIR__ . '/pdf.php';
require_once '../../common/php/lib/db.cls.php';
require_once '../../common/php/config.ini.php';
require_once '../../modules/php/action/class/applycation/apply5.cls.php';

session_start();
$org_code=$_SESSION['org_code'];

$apply=new APPLY();
$arr=$apply->find5OrgInfo1($org_code);  
//$arr=$_SESSION['attach4_org_info'];
datatopdf('attach5', $arr); 




?>


