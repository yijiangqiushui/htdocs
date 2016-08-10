<?php
require_once __DIR__ . '/pdf.php';

// require_once '../../modules/php/action/page/applycation/apply9.act.php';
require_once '../../modules/php/action/class/acceptance/expert.cls.php';
require_once '../../common/php/config.ini.php';
require_once '../../common/php/lib/db.cls.php';
//datatopdf('demo', array('title' => 'aa'));
$apply = new Expert ();
$org_code = $_SESSION ['org_code'];
$project_id = $_SESSION ['project_id'];
//org_info
$arguments=$apply->findProjectExpert ($project_id, 'project_info', 'project_id',"pdf" );
$sign=$apply->finds ($project_id, 'project_info', 'project_id',"pdf");


// print_r(array_merge($arguments,$sign));
datatopdf('expert_solution',array_merge($arguments,$sign));