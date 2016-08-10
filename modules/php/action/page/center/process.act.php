<?php
include '../../../../../center/php/config.ini.php';
include '../../../../../common/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';
include '../../class/center/process.cls.php';

include '../../../../../common/php/plugin/fenci_v1.0_utf8/checkduplicate.cls.php';

$action = $_GET['action'];

$department_type = $_GET['dep'];
$project_id = $_SESSION['project_id'];
// $project_id = '0123456';
$org_code = $_SESSION['org_code'];
/*
// $department_type=$_SESSION['department_type'];
$db = new DB();
// $project_sql = "select * from project_type where apply_status >=0 and dep_type = $department_type";
if($department_type == 4||$department_type == 3){
    $project_sql = "select * from project_type where apply_status >=0";
}
else{
    $project_sql = "select * from project_type where apply_status >=0 and dep_type=$department_type";
}
// $project_sql = "select * from project_type where apply_status >=0 and dep_type=0";
$project_list = $db -> Select($project_sql);
$db ->Close();


*/
$project_array = array();
/*foreach($project_list as $project){
    $project_array[$project['id']] = $_POST[$project['id']];
    $project_array[$project['id']] = $_POST[$project['id']];
    
    
}
*/

foreach ($_POST as $key => $value){
	if (is_numeric($key)){
		$project_array[$key] = $value;
	}
	if(strstr($key,"radiorev")){
		if($value =="on"){
			$temp = explode("_",$key);
			if(!is_array($_POST[$temp[0]])){
				$project_array[$temp[0]] = array(0,0,0,0);
			}
		}
	}
}


//var_dump($_POST);
//var_dump($project_array);
//exit;//不明白开关功能为什么要写的这么复杂？！！看的晕啊,还各种BUG

$process=new Process();
switch($action){
    case 'project_process':
        $process-> projectProcess($department_type,$project_array);
        break;
    case 'find_process':
        $process->findProcess($department_type);
        break;
}
