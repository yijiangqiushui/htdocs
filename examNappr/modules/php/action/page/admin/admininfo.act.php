<?php
/**
author:Gao Xue
date:2014-04-30
Modified by Ma Jun Wei 2014/09/05
*/

include '../../../../../common/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';
include '../../../../../common/php/lib/user.cls.php';
include '../../class/log/log.cls.php';
// include '../../class/admin/admininfo.cls.php';
include '../../class/admin/admin.cls.php';


switch($_GET['action']){
	case 'saveAdmin':{
				$admin=new ADMININFO();
				$user=new USER();
				$admininfo['category']=$_POST['category'];
				$upperID=$_POST['upperID'];
				$admininfo['usr']=$_POST['usr'];
				$admininfo['exclusive_name']=$_POST['exclusiveName'];
				$admininfo['realname']=$_POST['realname'];
				$admininfo['isManager']=$_POST['isManager'];
				$admininfo['managerMoreBm']=$_POST['managerMoreBm'];
				$admininfo['seed']=$_POST['seed'];
				$admininfo['ntid']=$_POST['ntid'];
				$admininfo['pwd']=$user->EncriptPWD($_POST['pwd']);
				$admininfo['phone']=$_POST['phone'];
				$admininfo['email']=$_POST['email'];
				$admininfo['qq']=$_POST['qq'];
				$admininfo['userPrivileges']=$_POST['userPrivileges'];
				$admininfo['isForbidden']=$_POST['isForbidden'];
				$admininfo['addedDate']=date('Y-m-d H:i:s',time());
				$admininfo['lastIP']=$admin->getIP();
				$admin->saveAdmin($admininfo,$upperID);
				$log=new LOGINFO();
				$log->addLog('添加用户信息',$_SESSION['realname'],date('Y-m-d H:i:s',time()));
	}
	break;
	case 'queryAdmin':{
				$page=$_POST['page'];
				$rows=$_POST['rows'];
				$upCatory=$_POST['upCagory'];
				$usr=$_POST['usr'];
				$isForbidden=$_POST['isForbidden'];// modify:Ma Jun Wei
				//$isForbidden=intval($_POST['isForbidden']);
				$admin=new ADMININFO();
				$admin->queryAdmin($_GET['isDel'],$page,$rows,$upCatory,$usr,$isForbidden);
			}
			break;
	case 'getAdmin':{
				$id=$_GET['id'];
				$admin=new ADMININFO();
				$admin->getAdmin($id);
			}
			break;
	case 'getPri':{
				$id=$_GET['id'];
				$admin=new ADMININFO();
				$admin->getPri($id,$_GET['newEdit']);
			}
			break;
	case 'delAdmin':{
				$id=$_GET['id'];
				$admin=new ADMININFO();
				$admin->delAdmin($id);
				$log=new LOGINFO();
				$log->addLog('删除用户信息',$_SESSION['realname'],date('Y-m-d H:i:s',time()));
			}
			break;
	case 'delArrAdmin':{
				$arrId=$_GET['arrId'];
				$admin=new ADMININFO();
				$admin->delArrAdmin($arrId);
				$log=new LOGINFO();
				$log->addLog('删除用户信息',$_SESSION['realname'],date('Y-m-d H:i:s',time()));
			}
			break;	
	case 'updateAdmin':{
				$user=new USER();
				$id=$_GET['id'];
				if(!empty($_POST['upCat']))
				$upAdmin['category']=$_POST['upCat'];
				$upper_id=$_GET['upper_id'];
				$upAdmin['usr']=$_POST['usr'];
				$upAdmin['exclusive_name']=$_POST['exclusiveName'];
				$upAdmin['realname']=$_POST['realname'];
				$upAdmin['isManager']=$_POST['isManager'];
				$upAdmin['managerMoreBm']=$_POST['managerMoreBm'];
				$upAdmin['phone']=$_POST['phone'];
				$upAdmin['email']=$_POST['email'];
				$upAdmin['qq']=$_POST['qq'];
				$upAdmin['isForbidden']=$_POST['isForbidden'];
				$upAdmin['seed']=$_POST['seed'];
				$upAdmin['ntid']=$_POST['ntid'];
				$upAdmin['userPrivileges']=$_POST['userPrivileges'];
				if(!empty($_POST['newpwd'])){
					$upAdmin['pwd']=$user->EncriptPWD($_POST['newpwd']);
				}/***/
				$admin=new ADMININFO();
				$admin->updateAdmin($id,$upAdmin,$upper_id);
				$log=new LOGINFO();
				$log->addLog('修改用户信息',$_SESSION['realname'],date('Y-m-d H:i:s',time()));
			}
			break;
	case 'disableAdmin':{
				$list=$_GET['idlist'];
				$flag=$_GET['flag'];
				$admin=new ADMININFO();
				$admin->disableAdmin($list,$flag);
				$log=new LOGINFO();
				$log->addLog('启用/禁用用户信息',$_SESSION['realname'],date('Y-m-d H:i:s',time()));
			}
			break;
	case 'getOthers':{
				$admin=new ADMININFO();
				$admin->getOthers();
			}
			break;
	case 'getOthersList':{
				$admin=new ADMININFO();
				$admin->getOthersList();
			}
			break;
	case 'uptisDel':
			{
				$id=intval($_GET['id']);
				
				$admin=new ADMININFO();
				$admin->uptisDel($id);
				$log=new LOGINFO();
				$log->addLog('恢复删除的用户信息',$_SESSION['realname'],date('Y-m-d H:i:s',time()));
			}
			break;
	case 'uptisDelList':
			{
				$idlist=$_GET['idlist'];
				
				$admin=new ADMININFO();
				$admin->uptisDelList($idlist);
				$log=new LOGINFO();
				$log->addLog('恢复删除的用户信息',$_SESSION['realname'],date('Y-m-d H:i:s',time()));
			}
			break;
	default:;
}
?>