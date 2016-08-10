<?php
include '../../../../../common/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';
include '../../class/sms/sms.cls.php';

$action = $_GET['action'];
$list = $_GET['list'];
$sms_context = $_GET['smscontext'];
$project_id = $_GET['project_id'];
$id = $_GET['id'];
$sms = new SMS();
switch ($action){
    case 'preSendSms':
        $sms -> findSmsInfo($list, $sms_context);                
        break;
    case 'sendmsg':
        $sms -> findInfo($project_id);
        break;
		case 'failSend':
		    $sms -> findFailInfo($id);
		    break;
}