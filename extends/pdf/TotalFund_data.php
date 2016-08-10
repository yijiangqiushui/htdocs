<?php
require_once __DIR__ . '/pdf.php';
include '../../modules/php/action/class/projectapp/util.cls.php';
require_once '../../modules/php/action/class/projectapp/projectapp.cls.php';
require_once '../../common/php/config.ini.php';
require_once '../../common/php/lib/db.cls.php';
//datatopdf('demo', array('title' => 'aa'));
$project_id = $_SESSION ['project_id'];
$projectapp = new ProjectApp ();
$arr=$projectapp->findTotalFund($project_id, "pdf");
datatopdf('Totalfund',$arr);