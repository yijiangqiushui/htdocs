<?php
/**
author:Gao Xue
date:2014-06-30
*/

include '../../../../common/php/config.ini.php';
include'../../../../common/php/lib/db.cls.php';
include '../class/log/log.cls.php';

include '../class/model.cls.php';

$action=$_GET['action'];

//$loginfo['opt']=$_POST['option'];
//$loginfo['username']=$_SESSION['admin_name'];
//$loginfo['timedata']=date('Y-m-d H:i:s',time());

$page=$_POST['page'];
$rows=$_POST['rows'];

$nodeId=$_POST['upid'];

$mo['sqlQuery']=$_POST['sqlQuery'];
$mo['fileName']=$_POST['fileName'];
$mo['fileType']=$_POST['fileType'];
$mo['fileFolder']=$_POST['fileFolder'];

$id=$_GET['id'];

$model=new MODELINFO();
$log=new LOGINFO();
switch($action){
	case 'queryModel':
		$model->queryModel($page,$rows);
		$log->addLog('查询模块信息',$_SESSION['admin_name'],date('Y-m-d H:i:s',time()));
		break;
	case 'getModel':
		$model->getModel($id);
		break;
	case 'updateModel':
		$model->updateModel($id,$mo);
		break;
	case 'delModel':
		$model->delModel($id);
		break;
	case 'treeData':
		$model->treeData();
		break;
	default:;
}
?>