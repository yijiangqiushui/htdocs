<?php
require_once __DIR__ . '/pdf.php';

// require_once '../../modules/php/action/page/applycation/apply9.act.php';
require_once '../../modules/php/action/class/applycation/apply11.cls.php';
require_once '../../common/php/config.ini.php';
require_once '../../common/php/lib/db.cls.php';
//datatopdf('demo', array('title' => 'aa'));
$apply = new APPLY ();
$org_code = $_SESSION ['org_code'];
//org_info
$org_info=$apply->find11orgInfo ( $org_code,"pdf" );

datatopdf('attach11',$org_info);