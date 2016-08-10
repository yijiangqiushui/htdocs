<?php

// include '../../../../../center/php/config.ini.php';
include '../../../../../common/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';
include '../../../../../common/php/lib/pri.cls.php';
include '../../class/checkinfo.cls.php';
include '../../../../../common/php/plugin/fenci_v1.0_utf8/checkduplicate.cls.php';

$action = $_GET ['action'];
$page = $_POST ['page'];
$rows = $_POST ['rows'];
$sort = $_POST['sort'];
$order = $_POST['order'];


$department = $_GET ['department'];
$min_status = empty ( $_GET ['min'] ) ? 0 : $_GET ['min'];
$max_status = empty ( $_GET ['max'] ) ? PHP_INT_MAX : $_GET ['max'];
$project_type = $_GET ['project_type'];
$state = $_GET ['state'];
$project_id = $_POST ['project_id'];
$project_info ['project_name'] = $_POST ['project_name'];
$project_info ['project_id'] = $_POST ['project_id'];
$project_info ['project_engineer'] = $_POST ['project_engineer'];
$project_info ['tech_area'] = $_POST ['tech_area'];
// $project_info ['org_name'] = $_POST ['org_name'];
$project_info ['project_type'] = $_POST ['project_type'];
$project_info ['department'] = $_POST ['department'];
$project_time ['apply_start'] = $_POST ['project_start'];
$project_time ['apply_end'] = $_POST ['project_end'];
$classes=$_GET['classes'];
$apply = new APPLY ();
switch ($action) {
	case 'findchecklist':
		$apply->findchecklist ($page, $rows, $department, $min_status, $max_status, $project_type,$classes);
		break;
	case 'checklist' :
	    
// 		$apply->checklist ( $page, $rows, $department, $min_status, $max_status, $project_type,$classes,$project_name,$project_id,$project_engineer,$leader_name,$start_time,$end_time);
		$apply->projectList($sort,$order,$page,$rows,$project_type,$classes);
//		$apply->projectList($page,$rows,$project_type,$classes,$project_name, $leader_name,$project_id,$project_engineer,$start_time,$end_time);
		break;
	case 'saveproject_info' :
		$apply->saveproject_info ( $project_id, $project_info,$project_time );
		break;
	case 'filterData':
	     $project_name = urldecode($_GET['project_name']);
	     $leader_name = urldecode($_GET['leader_name']);
	     $project_id = $_GET['project_id'];
	     $project_engineer = urldecode($_GET['project_engineer']);
	     $start_time = $_GET['start_time'];
	     $end_time = $_GET['end_time'];
	     $apply->filterData($page, $rows, $project_type,$project_name, $leader_name, $project_id, $project_engineer, $start_time, $end_time,$department);
	    break;
	case 'recoverProject':
	    $apply->recoverProject($project_id);
	    break;
	case 'closeAccept':
	    $apply->closeAccept($project_id);
	    break;
	case 'treedata':
	    $index = $_GET['index'];
	  //  print_r("类型为".$project_type);
	    $apply->unfoldTree($index,$project_type);
	    break; 
	case 'findTreeData':
	    $project_type = $_GET['project_type'];
	    $year = $_GET['year'];
	    $project_stage = $_GET['project_stage'];
	    $apply -> findTreeData($page, $rows, $project_type, $year, $project_stage);
	    break;
}

?>