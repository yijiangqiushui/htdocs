<?php
	include '../../../../../center/php/config.ini.php';
	include '../../../../../common/php/config.ini.php';
	include 'devprojectapp.cls.php';
	
	include '../../../../../common/php/plugin/fenci_v1.0_utf8/checkduplicate.cls.php';
	
	$project_id = $_SESSION['project_id'];
	//$project_id = 'dev1447641248';
	
	$name = $_GET['name'];
	$action = $_GET['action'];
	
	
	$agreeapp = new AgreeApp();
	
	switch ($action){
		case 'Attach1':
			$agreeapp->attach($name,$project_id);
			break;
		case 'Attach2':
			$agreeapp->attach($name,$project_id);
			break;
		case 'devExecute':
			$agreeapp->execute_solution($name,$project_id);
			break;
		case 'devMiddle':
			$agreeapp->middle_solution($name,$project_id);
			break;
		case 'devExpert':
			$agreeapp->expertproaccept($name,$project_id);
			break;
// 		case 'devSummary':
// 			$agreeapp->accept_project_summary($name,$project_id);
// 			break;
		default:;
	}

?>