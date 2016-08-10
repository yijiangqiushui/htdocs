<?php
require_once __DIR__ . '/pdf.php';

// require_once '../../modules/php/action/page/applycation/apply9.act.php';
require_once '../../modules/php/action/class/applycation/apply3.cls.php';
require_once '../../modules/php/action/class/projectapp/projectapp.cls.php';

require_once '../../common/php/config.ini.php';
require_once '../../common/php/lib/db.cls.php';
//datatopdf('demo', array('title' => 'aa'));
$apply = new APPLY ();
$org_code = $_SESSION ['org_code'];
$project_id = $_SESSION ['project_id'];

//org_info 
$org_info=$apply->find3OrgInfo ( $org_code,"pdf" );
$project_info=$apply->find3ProInfo ( $project_id,"pdf" );

$arr1=array_merge($org_info,$project_info);

//approve
$ProjectApp = new ProjectApp ();
$approve=$ProjectApp->findOpin (  $project_id, 'project_info', 'project_id',"pdf" );
datatopdf('attach3',array_merge($arr1,$approve));