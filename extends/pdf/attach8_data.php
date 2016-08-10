<?php
require_once __DIR__ . '/pdf.php';
require_once '../../common/php/lib/db.cls.php';
require_once '../../common/php/config.ini.php';
require_once '../../modules/php/action/class/applycation/apply8.cls.php';

session_start();
$org_code=$_SESSION['org_code'];
$project_id=$_SESSION['project_id'];

$apply=new APPLY();
//$arr=$apply->find_org_info6_pdf($org_code);  
$arr=$apply->find_org_info8($org_code,$project_id); 

//$arr=$_SESSION['attach4_org_info'];
//datatopdf('attach8', $arr); 
datatopdf('attach8', json_decode($arr,true)); 




?>



