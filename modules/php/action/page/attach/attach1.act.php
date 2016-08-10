<?php
include '../../../../../center/php/config.ini.php';
include '../../../../../common/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';
include '../../class/attach/attach1.cls.php';

include '../../../../../common/php/plugin/fenci_v1.0_utf8/checkduplicate.cls.php';

$action = $_GET['action'];
$project_id = $_SESSION['project_id'];
$org_code = $_SESSION['org_code'];
$user_type = $_SESSION['user_type'];

$table_id = $_GET['table_id'];
$attach = new Attach1();

switch ($action) {
    case 'attach_attr':
        $attach->find_attach_info($project_id, $user_type, $table_id);
        break;
    case 'genious_award':
        $attach->find_genious_award($project_id, $user_type, $table_id);
        break;
}