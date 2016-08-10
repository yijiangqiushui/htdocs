<?php
include '../../../../../common/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';
include '../../class/project/generate_devcode.php';

include '../../../../../common/php/plugin/fenci_v1.0_utf8/checkduplicate.cls.php';

include __DIR__ . '/../../../../../extends/project_type/ProjectType.php';
    
$user_id = $_SESSION['user_id'];   //用户的id
$project_type_id = $_POST['id'];
$stage = $_POST['stage'];

$db = new DB();
$result = $db->GetInfo($project_type_id, 'project_type');
$name = $result['name'];
$attach_name = $result['attach_name'];
$dep_type = $result['dep_type'];

// $code = new Pro_Code();
$process = explode(",", $stage);
$attach_id = explode(",",$attach_name);
$time = strtotime('now');

switch($dep_type){
    case 0:
      $dep_type = "dev";break;
    case 1:
      $dep_type = "sci";break;
    case 2:
      $dep_type = "kno";break;
}
$project_id = $dep_type.$time;
$result['code'] = $project_id;

$_SESSION['project_id'] = $project_id;

ProjectType::createTableStatus($project_id, $project_type_id, $stage);

 