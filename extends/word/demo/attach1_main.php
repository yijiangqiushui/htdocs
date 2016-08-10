<?php
include '../../../common/php/config.ini.php';
include '../../../common/php/lib/db.cls.php';
require_once __DIR__ . '/../word.php';
$db = new DB();
// $project_id = $_SESSION['project_id'];
$project_id = 'kno1451829230';

$db = new DB();
$TBL11 = $db -> getDyData('researchers','project_id',$project_id);

$data = array(
    'TBL'  => $TBL11, 
);
echo datatoword($data, '1.docx');
