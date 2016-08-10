<?php
/**
author:Gao Xue
date:2014-04-28
modify:Wang Le
date:2014-09-05
*/
include '../../../../../common/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';

include '../../class/log/log.cls.php';

switch($_GET['action']){
	case 'addLog':
		$log=new LOGINFO();
		
		$loginfo['opt']=$_POST['option'];
		//$loginfo['username']=$_SESSION['admin_name'];
		$loginfo['username']=$_SESSION['realname'];
		$loginfo['timedata']=date('Y-m-d H:i:s',time());
		
		$log->addLog($loginfo);
		break;
	case 'queryLog':
		$log=new LOGINFO();
		
		$page=$_POST['page'];
		$rows=$_POST['rows'];
		
		$log->queryLog($page,$rows);
		break;
	default:;
}
?>