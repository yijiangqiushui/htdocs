<?php
include '../../../../common/php/config.ini.php';
include '../../config.ini.php';
include ROOTPATH.'lib/common.cls.php';
include ROOTPATH.'lib/db.cls.php';
include ROOTPATH.'lib/user.cls.php';


/*
 * 修改session中project_id的值
 */
$project_id = $_GET['project_id'];
$org_code = $_GET['org_code'];
// echo $project_id;
// echo $org_code;
$_SESSION['project_id'] = $project_id;
$_SESSION['org_code'] = $org_code;
echo 0;