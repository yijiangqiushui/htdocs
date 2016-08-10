<?php
include '../../../../../common/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';
include '../../class/log/log.cls.php';
include '../../class/file/seal.cls.php';

$log=new LOGINFO();
switch($_GET['action']){
	case 'saveApply':
		if(strpos($_SESSION['priviledges'],'seal_add')>0||$_SESSION['priviledges']=='super'){
			$applyInfo=array();
			$applyInfo['total']=$_POST['total'];
			$applyInfo['use_time']=$_POST['use_time'];
			if(!empty($_POST['end_time']))
				$applyInfo['end_time']=$_POST['end_time'];
			$applyInfo['category']=$_GET['category'];
			$applyInfo['reason']=$_POST['reason'];
			$applyInfo['content']=$_POST['content'];
			$applyInfo['user']=$_SESSION['realname'];
			$applyInfo['dept']=$_POST['dept'];
			$apply=new Apply();
			$apply->saveApply($applyInfo);
			//$log->addLog('申请印章使用',$_SESSION['admin_name'],date('Y-m-d H:i:s',time()));
		}
		break;
	case 'getDetail':
		if(strpos($_SESSION['priviledges'],'seal_query')>0||$_SESSION['priviledges']=='super'){
			$apply=new Apply();
			$apply->getDetail($_POST['id']);
		}
		break;
	case 'getDateGrid':
		if(strpos($_SESSION['priviledges'],'seal_query')>0||$_SESSION['priviledges']=='super'){
			$apply=new Apply();
			$apply->getDateGrid($_POST['page'],$_POST['rows'],$_POST['upper_cat'],$_POST['beginDate'],$_POST['endDate'],$_POST['person'],$_POST['reason'],$_POST['file_no'],$_POST['file_content'],$_POST['datacat_id']);
		}
		break;
	case 'editApply':
		if(strpos($_SESSION['priviledges'],'seal_edit')>0||$_SESSION['priviledges']=='super'){
			$applyInfo=array();
			$applyInfo['total']=$_POST['total'];
			$applyInfo['use_time']=$_POST['use_time'];
			if(!empty($_POST['end_time'])){
				$applyInfo['end_time']=$_POST['end_time'];
			}else{
				$applyInfo['end_time']=null;
			}
			$applyInfo['reason']=$_POST['reason'];
			$applyInfo['content']=$_POST['content'];
			$applyInfo['dept']=$_POST['dept'];
			$applyInfo['reject']=0;
			echo json_encode($applyInfo);
			$apply=new Apply();
			$apply->editApply($applyInfo,$_GET['id']);
			//$log->addLog('修改印章使用申请',$_SESSION['admin_name'],date('Y-m-d H:i:s',time()));
		}
		break;
	case 'delApply':
		if(strpos($_SESSION['priviledges'],'seal_del')>0||$_SESSION['priviledges']=='super'){
			$apply=new Apply();
			$apply->delApply($_POST['idList']);
			//$log->addLog('删除印章使用申请',$_SESSION['admin_name'],date('Y-m-d H:i:s',time()));
		}
		break;
	case 'setForbidden':
		$apply=new Apply();
		$apply->setForbidden($_POST['idList'],$_POST['val']);
		break;
	case 'checkInfo':
		$apply=new Apply();
		$apply->checkInfo($_GET['id']);
		break;
	case 'setCheck':
		$apply=new Apply();
		$apply->setCheck($_POST['idList']);
		break;
	case 'getStatus':
		$apply=new Apply();
		$apply->getStatus($_POST['id']);
		break;
	case 'updStatus':
		if(strpos($_SESSION['priviledges'],'seal_status')>0||$_SESSION['priviledges']=='super'){
			$apply=new Apply();
			$apply->updStatus($_GET['id'],$_GET['status']);
		}
		break;
	case 'fileTotal':
		$apply=new Apply();
		$addtime=date('Y-m-d',time());
		$apply->fileTotal($addtime);
		break;
	case 'addFileNo':
		if(strpos($_SESSION['priviledges'],'seal_getNo')>0||$_SESSION['priviledges']=='super'){
			$apply=new Apply();
			$addtime=date('Y-m-d',time());
			$apply->addFileNo($_POST['id'],$_POST['file_no'],$addtime);	
		}
		break;
	case "getDept":
		$apply=new Apply();
		$result=$apply->getDept();
		echo json_encode($result);
		break;
	case "setReject":
		if(strpos($_SESSION['priviledges'],'seal_reject')>0||$_SESSION['priviledges']=='super'){
			$apply=new Apply();
			$apply->setReject($_POST['id']);
		}
		break;
	case 'treeData':
		$apply=new Apply();
		$up_id=$_GET['up_id'];
		$datacat_id=$_GET['datacat_id'];
		$apply->treeData($up_id,$datacat_id);//,$_GET['contentID']);
		break;
	case 'cancelSeal':
		$apply=new Apply();
		$id=$_POST['id'];
		$apply->cancelSeal($id);//,$_GET['contentID']);
		break;
	default:;
}//$temp=explode(' ',trim(str_replace('.',' ','.91.')));print_r($temp);
?>