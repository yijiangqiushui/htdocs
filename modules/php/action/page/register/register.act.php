<?php
include '../../../../../center/php/config.ini.php';
include '../../../../../common/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';
include '../../class/register/register.cls.php';

include '../../../../../common/php/plugin/fenci_v1.0_utf8/checkduplicate.cls.php';

$action = $_GET['action'];
$org_code = $_GET['org_code'];

$register = new Register();
switch($action){
    case 'findOrg':
        $register->findOrg($org_code);
        break;
}