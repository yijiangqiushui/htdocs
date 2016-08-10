<?php
include '../../../../center/php/config.ini.php';
include '../../../../common/php/config.ini.php';
include '../../../../common/php/lib/db.cls.php';
include '../../../../common/php/plugin/fenci_v1.0_utf8/checkduplicate.cls.php';

$project_id = $_SESSION ['project_id'];
$db = new DB ();
// $sql = "Select * from project_info where project_id='$project_id'";
$result = $db->GetInfo1 ( $project_id, 'project_info', 'project_id' );
$appJSON = array (
		'project_id' => $result ['project_id'],
		'project_name' => $result ['project_name'] 
);

echo json_encode ( $appJSON );
$db->Close ();

