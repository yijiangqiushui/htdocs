<?php
/**
author:Gao Xue
date:2014-08-26
*Modified by Zhao Xiaogang  2014/09/09

*/

include '../../../../../common/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';
include '../../class/content/contentcat.cls.php';
include '../../class/log/log.cls.php';
include '../../class/admin/admincat.cls.php';

switch($_GET['action']){
	case 'treeData':
		$cat=new CONTENTCAT();
		$up_id=$_GET['up_id'];
		$cat->treeData($up_id);//,$_GET['contentID']);
		break;
	case 'treeData_dept':
		$cat=new CONTENTCAT();
		$up_id=$_GET['up_id'];
		$cat->treeData_dept($up_id);//,$_GET['contentID']);
		break;
	case 'catGrid':
		$cat=new CONTENTCAT();
		$page=$_POST['page'];
		$rows=$_POST['rows'];
		$upid=$_POST['upid'];
		$cat->catGrid($_GET['isDel'],$page,$rows,$upid);
		break;
	case 'saveCat':
		$cat=new CONTENTCAT();
		$catInfo['upper_id']=$_POST['upper_id'];
		$catInfo['upper_cat']=$_POST['upper_cat'];
		$catInfo['catname_all']=$_POST['catname_all'];
		$catInfo['exclusive_name']=$_POST['exclusive_name'];
		$catInfo['cat_name']=$_POST['cat_name'];
		$catInfo['is_forbidden']=$_POST['is_forbidden'];
		$catInfo['is_recommend']=$_POST['is_recommend'];
		$cat->saveCat($catInfo);
		$log=new LOGINFO();
		$log->addLog('添加部门分组',$_SESSION['realname'],date('Y-m-d H:i:s',time()));
		break;
	case 'findCat':
		$cat=new CONTENTCAT();
		$id=intval($_GET['id']);
		$cat->findCat($id);
		break;
	case 'saveEdtEle':
		$cat=new CONTENTCAT();
		$id=intval($_GET['id']);
		$catInfo['upper_id']=$_POST['upper_id'];
		$catInfo['upper_cat']=$_POST['upper_cat'];
		$catInfo['catname_all']=$_POST['catname_all'];
		$catInfo['exclusive_name']=$_POST['exclusive_name'];
		$catInfo['cat_name']=$_POST['cat_name'];
		$catInfo['is_forbidden']=$_POST['is_forbidden'];
		$catInfo['is_recommend']=$_POST['is_recommend'];
		$cat->saveEdtEle($id,$catInfo);
		$log=new LOGINFO();
		$log->addLog('修改部门分组',$_SESSION['realname'],date('Y-m-d H:i:s',time()));
		break;
	case 'delCat':
		$cat=new CONTENTCAT();
		$id=intval($_GET['id']);
		$cat->delCat($id);
		$log=new LOGINFO();
		$log->addLog('删除部门分组',$_SESSION['realname'],date('Y-m-d H:i:s',time()));
		break;
	case 'delArrCat':
		$cat=new CONTENTCAT();
		$idlist=$_GET['idlist'];
		$log=new LOGINFO();
		$log->addLog('删除部门分组',$_SESSION['realname'],date('Y-m-d H:i:s',time()));
		$cat->delArrCat($idlist);
		break;
	case 'disableCat':
		$cat=new CONTENTCAT();
		$idlist=$_GET['idlist'];
		$flag=$_GET['flag'];
		$cat->disableCat($idlist,$flag);
		$log=new LOGINFO();
		$log->addLog('启用/禁用部门分组',$_SESSION['realname'],date('Y-m-d H:i:s',time()));
		break;
	case 'getAllCat':
		$cat=new CONTENTCAT();
		$cat->getAllCat($_GET['up_id']);
		break;
	case 'uptisDel':
		$id=intval($_GET['id']);
		
		$cat = new CONTENTCAT();
		$cat->uptisDel($id);
		$log=new LOGINFO();
		$log->addLog('恢复删除的部门分组',$_SESSION['realname'],date('Y-m-d H:i:s',time()));
		break;
	case 'uptisDelList':
		$idlist=$_GET['idlist'];
		
		$cat = new CONTENTCAT();
		$cat->uptisDelList($idlist);
		$log=new LOGINFO();
		$log->addLog('恢复删除的部门分组',$_SESSION['realname'],date('Y-m-d H:i:s',time()));
		break;
	default:;
}
?>