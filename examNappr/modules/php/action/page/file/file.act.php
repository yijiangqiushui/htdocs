<?php
/**
author:Zhao Xiaogang
date:2014-12-19
*/

include '../../../../../common/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';
include '../../../../../common/php/lib/file.cls.php';
include '../../class/file/makefile.cls.php';
include '../../class/log/log.cls.php';

$log=new LOGINFO();
switch($_GET['action']){
	case 'get_dapart':
		$file=new makeFile();
		$file->get_depart();
		break;			
	case 'save':
		$file=new makeFile();
		$Info['addedDate']=$_POST['addedDate'];
		$Info['types']=$_POST['types'];
		$Info['file_level']=$_POST['file_level'];
		$Info['file_name']=$_POST['file_name'];
		$Info['file_content']=$_POST['file_content'];
		$Info['number']=$_POST['number'];
		$file->save($Info,$_SESSION['admin_id'],$_POST['attach_name'],$_POST['file_auto_name']);
		$log->addLog('创建制发文件',$_SESSION['realname'],date('Y-m-d H:i:s',time()));
		break;
	case 'getDateGrid':
	 	if(strpos($_SESSION['priviledges'],'file_self')){
			$file_self='1';
		}else{
			$file_self=$_POST['file_self'];
		}
		$file=new makeFile();
		$file->getDateGrid($_POST['page'],$_POST['rows'],$_POST['upper_cat'],$_POST['is_zero'],$_POST['beginDate'],$_POST['endDate'],$_POST['file_name'],$_POST['file_no'],$_POST['flag1'],$file_self,$_POST['file_type'],$_POST['author']);	
		//$file->getDateGrid($_POST['page'],$_POST['rows'],$_POST['upper_cat'],$_POST['beginDate'],$_POST['endDate'],$_POST['file_name'],$_POST['file_no'],$_POST['flag1'],$_POST['file_self'],$_POST['file_type']);	
		break;
	case 'getDetail':
		$file=new makeFile();
		$file->getDetail($_POST['id']);
		break;
	case 'editFile':
		$file=new makeFile();
		$file->editFile($Info,$_GET['id'],$_POST['addedDate'],$_POST['types'],$_POST['file_level'],$_POST['file_name'],$_POST['file_content'],$_POST['number']);
		$log->addLog('修改文件',$_SESSION['realname'],date('Y-m-d H:i:s',time()));
		break;	
	case 'setCheck':
		$file=new makeFile();
		$file->setCheck($_POST['idList']);
		break;
	case 'delFile':
		$file=new makeFile();
		$file->delFile($_POST['idList']);
		$log->addLog('删除文件',$_SESSION['realname'],date('Y-m-d H:i:s',time()));
		break;
	case 'setForbidden':
		$file=new makeFile();
		$file->setForbidden($_POST['idList'],$_POST['val']);
		$log->addLog('启用/禁用制发文件',$_SESSION['realname'],date('Y-m-d H:i:s',time()));
		break;
	case 'attachGrid':
		$id=$_POST['id'];
		$file=new makeFile();
		$file->attachGrid($id);
		break;
	case 'getInfoById':
		$id=$_GET['id'];
		$file=new makeFile();
		$file->getInfoById($id);
		break;
	case 'fileTotal':
		$file=new makeFile();
		$addtime=date('Y-m-d',time());
		$file->fileTotal($addtime);	
		break;		
	case 'addFileNo':
		$file=new makeFile();
		$addtime=date('Y-m-d',time());
		$file->addFileNo($_POST['id'],$_POST['file_no'],$addtime);	
		$log->addLog('保存文件编号',$_SESSION['realname'],date('Y-m-d H:i:s',time()));
		break;		
	case 'load':	
		$file=new makeFile();
		$id=$_GET['id'];
		$isred=$_GET['isred'];
		$i=$_GET['i'];
		$attach['brief_ctnt']=$_POST['brief_ctnt'];
		$file->load($id,$isred,$attach);
		break;
	case 'checkAttach':
		$file=new makeFile();
		$file->checkAttach($_GET['attach']);
		break;
	case 'checkRed':
		$file=new makeFile();
		$file->checkRed($_POST['id']);
		break;
	case 'redAttachGrid':	
		$file=new makeFile();
		$id=$_GET['id'];
		$page=$_POST['page'];
		$rows=$_POST['rows'];
		$file->redAttachGrid($id,$page,$rows);
		break;
	case 'makeRed':
		$file=new makeFile();
		$file->makeRed($_POST['id'],$_POST['ismake']);
		$log->addLog('通知制作/重制作红头文件',$_SESSION['realname'],date('Y-m-d H:i:s',time()));
		break;
	case 'makeOpen':
		$file=new makeFile();
		$file->makeOpen($_POST['id']);
		break;
	case 'find_maker_flag':
		$file = new makeFile();
		$file->find_maker_flag($_POST['id']);	
		break;
	case 'find_usr_flag':
		$file = new makeFile();
		$file->find_usr_flag($_POST['id']);	
		break;
	case 'cancelInfo':
		$file = new makeFile();
		$file->cancelInfo($_GET['id'],$_GET['flag']);	
		break;
	case 'treeData':
		$file = new makeFile();
		$file->treeData($_GET['up_id'],$_GET['is_zero']);
		break;
	case 'delAttach':
		$file = new makeFile();
		$id=$_GET['id'];	
		$file->delAttach($id);
		$log->addLog('删除制发文件附件',$_SESSION['realname'],date('Y-m-d H:i:s',time()));
		break;
	case 'cancelFile':
		$file = new makeFile();
		$file->cancelFile($_GET['id']);	
		break;
	default:;
}
?>