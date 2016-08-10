<?php
require_once __DIR__ . '/pdf.php';

// require_once '../../modules/php/action/page/applycation/apply9.act.php';
require_once '../../modules/php/action/class/applycation/apply10.cls.php';
require_once '../../common/php/config.ini.php';
require_once '../../common/php/lib/db.cls.php';
//datatopdf('demo', array('title' => 'aa'));
$apply = new APPLY ();
$org_code = $_SESSION ['org_code'];
//org_info
$org_info=$apply->find10orgInfo ( $org_code,"pdf" );
$manager_team=$apply->find10service_team ( $org_code,"pdf" );
$findman_state=$apply->find10manager_fm ( $org_code,"pdf" );
$arr1=array_merge($org_info,$manager_team);
// print_r(array_merge($arr1,$findman_state));
// array_merge($a1,$a2) 合并数组
datatopdf('attach10',array_merge($arr1,$findman_state));