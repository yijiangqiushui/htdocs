<?php
require_once __DIR__ . '/pdf.php';

// require_once '../../modules/php/action/page/applycation/apply9.act.php';
include '../../modules/php/action/class/projectapp/util.cls.php';
require_once '../../modules/php/action/class/applycation/apply9.cls.php';
require_once '../../common/php/config.ini.php';
require_once '../../common/php/lib/db.cls.php';
//datatopdf('demo', array('title' => 'aa'));
$apply = new APPLY ();
$org_code = $_SESSION ['org_code'];
//org_info
$org_info=$apply->findorg_info9 ( $org_code,"pdf" );
$hatch=$apply->find_hatch ( $org_code,"pdf" );
$arr1=array_merge($org_info,$hatch);
//
$manager_team=$apply->find_manager_team ( $org_code,"pdf" );
$findman_state=$apply->findman_state ( $org_code,"pdf" );
$arr2=array_merge($manager_team,$findman_state);

// array_merge($a1,$a2) 合并数组
datatopdf('attach9',array_merge($arr1,$arr2));