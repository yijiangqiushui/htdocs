<?php
include '../../../../../modules/php/action/class/checkReport/checkReport.cls.php';
$action = $_GET ['action'];
// $project_id = $_SESSION ['project_id'];
$project_id = $_GET['project_id'];
$main = new checkReport ();
switch ($action) {
	case 'find' :
		$main->findCheck ( $project_id );
		break;
	case 'checkStatus' :
	    $isPass = $_GET['ispass'];
	    $opinion = $_GET['opinion'];
	    $url = $_GET['url'];
	    $main->checkStatus($project_id,$isPass,$opinion,$url);
	    break;
}