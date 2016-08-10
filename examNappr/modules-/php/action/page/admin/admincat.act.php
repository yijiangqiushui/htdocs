<?php
/**
*author:贺央央
*Modified by Gao Xue  2014/04/30  function treeData
*Modified by Ma Jun Wei 2014/09/05 把该类拆分为act和cls
**/
include '../../../../../common/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';
include '../../class/log/log.cls.php';

include '../../class/admin/admincat.cls.php';


switch($_GET['action']){

	case 'treeData':
			{
				$userCat = new USERCAT();
				$up_id=$_GET['up_id'];
				$table_name=$_GET['table_name'];
				$userCat->treeData($up_id,$table_name);
			}
			break;
	case 'show':
			{	
				$role['upperID']=intval($_POST['upperID']);
				$role['catName']=$_POST['catName'];
				$role['userPrivileges']=$_POST['userPrivileges'];
				$role['isForbidden']=$_POST['isForbidden'];
				//$role['lab_school']=intval($_POST['lab_school']);
				$upid=$_POST['upid'];
				$page=$_POST['page'];
				$rows=$_POST['rows'];
				
				$userCat = new USERCAT();
				$userCat->show($_GET['isDel'],$role, $upid, $page, $rows);	
			}
			break;
	case 'add':
			{
				$role['upperID']=intval($_POST['upperID']);
				$role['catName']=$_POST['catName'];
				$role['exclusive_name']=$_POST['exclusive_name'];
				$role['userPrivileges']='priviliges,concats_,admincats_';
				$userCat = new USERCAT();
				$userCat->add($role);
				$log=new LOGINFO();
				$log->addLog('添加用户分组',$_SESSION['realname'],date('Y-m-d H:i:s',time()));
			}
			break;
	case 'findbyid':
			{
				$id=intval($_GET['id']);
				
				$userCat = new USERCAT();
				$userCat->findbyid($id);
			}
			break;
	case 'delEle':
			{
				$id=intval($_GET['id']);
				
				$userCat = new USERCAT();
				$userCat->delEle($id);
				$log=new LOGINFO();
				$log->addLog('删除用户分组',$_SESSION['realname'],date('Y-m-d H:i:s',time()));
			}
			break;
	case 'delByIdList':
			{
				$idlist=$_GET['idlist'];
				
				$userCat = new USERCAT();
				$userCat->delByIdList($idlist);
				$log=new LOGINFO();
				$log->addLog('删除用户分组',$_SESSION['realname'],date('Y-m-d H:i:s',time()));
			}
			break;
	case 'saveEdtEle':
			{
				$role['upperID']=intval($_POST['pritree']);
				$role['catName']=$_POST['catName'];
				$role['exclusive_name']=$_POST['exclusive_name'];
				//$role['userPrivileges']=$_POST['userPrivileges'];
				//$role['isForbidden']=$_POST['isForbidden'];
				//$role['lab_school']=intval($_POST['lab_school']);
				
				$id=intval($_GET['id']);
				
				$userCat = new USERCAT();
				$userCat->saveEdtEle($id,$role);
				$log=new LOGINFO();
				$log->addLog('修改用户分组',$_SESSION['realname'],date('Y-m-d H:i:s',time()));
			}
			break;
	case 'disableEle':
			{
				$idlist=$_GET['idlist'];
				$flag=intval($_GET['flag']);
				
				$userCat = new USERCAT();
				$userCat->disableEle($idlist, $flag);	
				$log=new LOGINFO();
				$log->addLog('启用/禁用用户分组',$_SESSION['realname'],date('Y-m-d H:i:s',time()));
			}
			break;
	case 'adminCat':
			{
				$userCat = new USERCAT();
				$userCat->adminCat();
			}
			break;
	case 'content_tree':
			{
				$upid=$_GET['up_id'];
				$table_name=$_GET['table_name'];
				$conCat = new USERCAT();
//				$conCat->content_tree($upid,'contentcat');
				$conCat->content_tree($upid,$table_name);
			}
			break;
	case 'get_content_tree':
			{
				$upid=$_GET['up_id'];
				$table_name=$_GET['table_name'];
				$conCat = new USERCAT();
//				$conCat->content_tree($upid,'contentcat');
				$conCat->get_content_tree($upid,$table_name);
			}
			break;
	case 'tree':
			{
				$upid=$_GET['up_id'];
				$table_name=$_GET['table_name'];
				$conCat = new USERCAT();
				$conCat->tree($upid,$table_name);
			}
			break;
	case 'uptisDel':
			{
				$id=intval($_GET['id']);
				$userCat = new USERCAT();
				$userCat->uptisDel($id);
				$log=new LOGINFO();
				$log->addLog('恢复删除的用户分组',$_SESSION['realname'],date('Y-m-d H:i:s',time()));
			}
			break;
	case 'uptisDelList':
			{
				$idlist=$_GET['idlist'];
				
				$userCat = new USERCAT();
				$userCat->uptisDelList($idlist);
				$log=new LOGINFO();
				$log->addLog('恢复删除的用户分组',$_SESSION['realname'],date('Y-m-d H:i:s',time()));
			}
			break;
	default:;
	
}
?>