<?php
require_once __DIR__ . '/pdf.php';
require_once '../../common/php/lib/db.cls.php';
require_once '../../common/php/config.ini.php';
require_once '../../modules/php/action/class/applycation/apply4.cls.php';

session_start();
$org_code=$_SESSION['org_code'];
$project_id=$_SESSION['project_id'];

//datatopdf('demo', array('title' => 'aa'));
$apply=new APPLY();
$arr=$apply->find4OrgInfo1($org_code,$project_id); 
//$arr=$_SESSION['attach4_org_info'];
datatopdf('attach4', $arr); 




?>


