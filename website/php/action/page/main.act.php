<?php
include '../../../../common/php/config.ini.php';
include ROOTPATH.'lib/db.cls.php';
include ROOTPATH.'lib/user.cls.php';
include '../class/main.cls.php';

$action = $_GET['action'];
$main = new MAIN();
switch($action){
    case 'logout':
        $main->logout();
        break;
    case 'c_user':
        $main->get_user();
        break;
    case 'checklogin':
        $main->checklogin();
        break;
}

