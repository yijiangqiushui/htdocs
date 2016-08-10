<?php
/**
author:Gao Xue
date:2014-08-26
*Modified by Zhao Xiaogang  2014/09/09
Modified by Gao Xue 2015/04/08

*/

include '../../../../../common/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';
include '../../class/log/log.cls.php';
include '../../class/smslist/smslistcat.cls.php';

switch($_GET['action']){
	case 'treeData':
		$cat=new SMSLISTCAT();
		$up_id=$_GET['up_id'];
		$cat->treeData($up_id);//,$_GET['contentID']);
		break;
	case 'catGrid':
		$cat=new SMSLISTCAT();
		$page=$_POST['page'];
		$rows=$_POST['rows'];
		$upid=$_POST['upid'];
		$cat->catGrid($page,$rows,$upid);
		break;
	case 'saveCat':
		$cat=new SMSLISTCAT();
		$catInfo['upper_id']=$_POST['upper_id'];
		$catInfo['upper_cat']=$_POST['upper_cat'];
		$catInfo['catname_all']='';
		$catInfo['exclusive_name']='';
		$catInfo['cat_name']=$_POST['cat_name'];
		//$catInfo['is_forbidden']=$_POST['is_forbidden'];
		$catInfo['user_id']=$_SESSION['admin_id'];
		$cat->saveCat($catInfo);
		$log=new LOGINFO();
		$log->addLog('添加通讯录分组',$_SESSION['realname'],date('Y-m-d H:i:s',time()));
		break;
	case 'findCat':
		$cat=new SMSLISTCAT();
		$id=intval($_GET['id']);
		$cat->findCat($id);
		break;
	case 'saveEdtEle':
		$cat=new SMSLISTCAT();
		$id=intval($_GET['id']);
		$catInfo['upper_id']=$_POST['upper_id'];
		$catInfo['upper_cat']=$_POST['upper_cat'];
		$catInfo['catname_all']='';
		$catInfo['exclusive_name']='';
		$catInfo['cat_name']=$_POST['cat_name'];
		//$catInfo['is_forbidden']=$_POST['is_forbidden'];
		$catInfo['user_id']=$_SESSION['admin_id'];
		$cat->saveEdtEle($id,$catInfo);
		$log=new LOGINFO();
		$log->addLog('修改通讯录分组',$_SESSION['realname'],date('Y-m-d H:i:s',time()));
		break;
	case 'delCat':
		$cat=new SMSLISTCAT();
		$id=intval($_GET['id']);
		$cat->delCat($id);
		$log=new LOGINFO();
		$log->addLog('删除通讯录分组',$_SESSION['realname'],date('Y-m-d H:i:s',time()));
		break;
	case 'delArrCat':
		$cat=new SMSLISTCAT();
		$idlist=$_GET['idlist'];
		$cat->delArrCat($idlist);
		$log=new LOGINFO();
		$log->addLog('删除通讯录分组',$_SESSION['realname'],date('Y-m-d H:i:s',time()));
		break;
	case 'disableCat':
		$cat=new SMSLISTCAT();
		$idlist=$_GET['idlist'];
		$flag=$_GET['flag'];
		$cat->disableCat($idlist,$flag);
		$log=new LOGINFO();
		$log->addLog('启用/禁用通讯录分组',$_SESSION['realname'],date('Y-m-d H:i:s',time()));
		break;
	case 'getAllCat':
		$cat=new SMSLISTCAT();
		$cat->getAllCat($_GET['up_id']);
		break;
	default:;
}
?>