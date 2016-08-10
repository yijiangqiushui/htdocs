<?php

require_once __DIR__ . '/pdf.php';
 include '../../common/php/config.ini.php';
include '../../common/php/lib/db.cls.php';
include '../../modules/php/action/class/implement/middle.cls.php';

session_start();
$project_id = $_SESSION['project_id'];
$middle = new Middle(); 
$arr=$middle->findModifyApp1($project_id);  
datatopdf('modify_solution_data', $arr);
