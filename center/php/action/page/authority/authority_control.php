<?php
include 'authority.act.php';
$action = $_REQUEST['action'];
$type_id = $_POST['type_id'];
$departmentauth = $_GET['$departmentauth'];
$id = $_GET['id'];
$isForbidden = $_GET['isForbidden'];

//更新时间信息;
$start_time = $_POST['start_date'];
$end_time = $_POST['end_date'];
/* $alltime = explode(" ", $time);
$start_time = $alltime[0];
$end_time = $alltime[2]; */
/* $openProject['apply_start'] = strtotime(date('Y-m-d',$start_time));
$openProject['apply_end'] = strtotime(date('Y-m-d',$end_time)) + 24 * 60 * 60; */

$openProject['apply_start'] = strtotime($start_time);
if($end_time!='未指定'){
    $openProject['apply_end'] = strtotime($end_time) + 24 * 60 * 60 - 1;
}
else{
    $openProject['apply_end'] = null;
}
$openProject['apply_status'] = 1;


$user_type = $_SESSION['user_type'];
$department = $_SESSION['department'];


// $department = 0;
$authorityapp = new authorityapp();
// echo $action."22".$type_id;
switch($action){
    case 'close':
        $authorityapp -> closeProject($type_id);
        break;
    case 'open':
        $authorityapp ->openProject($type_id,$openProject);
        var_dump($openProject);exit;
        break;
    case 'queryAdminAll':
        $page = $_POST['page'];
        $rows = $_POST['rows'];
		if($user_type ==  3){
       		 $authorityapp -> queryAdminAll($page,$rows);
		}
		else{
			$authorityapp -> queryAdmin($page,$rows,$department);
		}
        break;
    case 'queryAdmin':
        $page = $_POST['page'];
        $rows = $_POST['rows'];
        $authorityapp -> queryAdmin($page,$rows,$departmentauth);
        break;
    case 'queryUsers';
        $authorityapp -> queryUsers($department);
        break;
    case 'updateUser';
    	$data = array(
    		'isForbidden' => $isForbidden	
    	);
    	$authorityapp ->updateUser($id, $data);
    	break;
    case 'deleteUser';
    	$authorityapp ->deleteUser($id);
    	break;
}