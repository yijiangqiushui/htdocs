<?php
/**
author:Gao Xue
date:2014-05-07
*/

include '../../../../../common/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';
include '../../../../../common/php/lib/file.cls.php';
include '../../../../../common/php/lib/img.cls.php';
include '../../class/content/contentinfo.cls.php';

switch($_GET['action']){
	case 'infoGrid':
		$info=new CONTENTINFO();
		$page=$_POST['page'];
		$rows=$_POST['rows']; 
		$upper_cat=$_POST['upper_cat'];
		$title=$_POST['title'];
		//$tags=$_POST['tags'];
		//$content=$_POST['content'];
		$add_time=$_POST['add_time'];
		//$end_time=$_POST['edit_time'];
		$info->infoGrid($upper_cat,$page,$rows,$title,$add_time);
		break;
	case 'saveInfo':
		$info=new CONTENTINFO();
		$conInfo['cat_id']=$_POST['cat_id'];
		$conInfo['category']=$_POST['category'];
		$conInfo['admin_id']=$_SESSION['admin_id'];
		$conInfo['title']=$_POST['title'];
		$conInfo['type']=intval($_POST['type']);
		$conInfo['exclusive_name']=$_POST['exclusive_name'];
		$conInfo['recOption']=$_POST['recOption'];
		//$conInfo['base']=$_POST['base'];
		$conInfo['brief_title']=$_POST['brief_title'];
		$conInfo['tags']=$_POST['tags'];
		$conInfo['content']=$_POST['content'];
		$conInfo['brief_ctnt']=$_POST['brief_ctnt'];
		$proInfo['edit_time']=$_POST['edit_time']==''?date('Y-m-d H:i:s'):$_POST['edit_time'];
		$conInfo['source']=$_POST['info_source'];
		$conInfo['thumbnails_size']=$_POST['thumbnails_size'];
		
		$info->saveInfo($conInfo);
		break;
	case 'getAttach':
		$info=new CONTENTINFO();
		$id=$_GET['id'];
		$info->getAttach($id);
		break;
	case 'updInfo':
		$info=new CONTENTINFO();
		$id=$_GET['id'];
		$conInfo['cat_id']=$_POST['cat_id'];
		$conInfo['category']=$_POST['category'];
		$conInfo['title']=$_POST['title'];
		$conInfo['admin_id']=$_SESSION['admin_id'];
		$conInfo['type']=intval($_POST['type']);
		$conInfo['exclusive_name']=$_POST['exclusive_name'];
		$conInfo['recOption']=$_POST['recOption'];
		//$conInfo['base']=$_POST['base'];
		$conInfo['brief_title']=$_POST['brief_title'];
		$conInfo['tags']=$_POST['tags'];
		$conInfo['content']=$_POST['content'];
		$conInfo['brief_ctnt']=$_POST['brief_ctnt'];
		$proInfo['edit_time']=$_POST['edit_time']==''?date('Y-m-d H:i:s'):$_POST['edit_time'];
		$conInfo['source']=$_POST['info_source'];
		$conInfo['thumbnails_size']=$_POST['thumbnails_size'];
		
		$info->updInfo($id,$conInfo);
		break;
	case 'delInfo':
		$info=new CONTENTINFO();
		$id=$_GET['id'];
		$info->delInfo($id);
		break;
	case 'delArrInfo':
		$info=new CONTENTINFO();
		$arrId=$_GET['arrId'];
		$info->delArrInfo($arrId);
		break;
	case 'disableInfo':
		$info=new CONTENTINFO();
		$list=$_GET['idlist'];
		$flag=$_GET['flag'];
		$info->disableInfo($list,$flag);
		break;
	case 'checkInfo':
		$info=new CONTENTINFO();
		$id=$_GET['id'];
		$info->checkInfo($id);
		break;
	case 'saveComment':
		$info=new CONTENTINFO();
		$comment['comment']=$_POST['comment'];
		$comment['comment_grade']=$_POST['comment_grade'];
		$comment['member_id']=1;//$_SESSION['member_id'];
		$id=$_GET['id'];
		$info->saveComment($comment,$id);
		break;
	case 'load':	
		$info=new CONTENTINFO();
		$id=$_GET['id'];
		$attach['brief_ctnt']=$_POST['brief_ctnt'];
		$info->load($id,$attach);
		break;
	case 'attachGrid':	
		$info=new CONTENTINFO();
		$id=$_GET['id'];
		$page=$_POST['page'];
		$rows=$_POST['rows'];
		$info->attachGrid($id,$page,$rows);
		break;
	case 'delAttach':
		$info=new CONTENTINFO();
		$id=$_GET['id'];	
		$info->delAttach($id);
		break;
	case 'delArrAttach':
		$info=new CONTENTINFO();
		$arrId=$_GET['arrId'];
		$info->delArrAttach($arrId);
		break;
	case 'commentGrid':	
		$info=new CONTENTINFO();
		$id=$_GET['id'];
		$page=$_POST['page'];
		$rows=$_POST['rows'];
		$info->commentGrid($id,$page,$rows);
		break;
	case 'delComment':	
		$info=new CONTENTINFO();
		$id=$_GET['id'];
		$info->delComment($id);
		break;
	case 'delArrComment':	
		$info=new CONTENTINFO();
		$arrId=$_GET['arrId'];
		$info->delArrComment($arrId);
		break;
	case 'getData':
		$info=new CONTENTINFO();
		$info->getData();//heyangyang
		break;
	case 'findById':
		$info=new CONTENTINFO();
		$id=$_POST['id'];
		$info->findById($id);
		break;
	case 'uptComment':
		$info=new CONTENTINFO();
		$id=$_GET['id'];
		$comment['comment']=$_POST['comment'];
		$comment['comment_grade']=$_POST['comment_grade'];
		$info->uptComment($id,$comment);
		break;
	case 'getPath':
		$info=new CONTENTINFO();
		$id=$_POST['id'];
		$info->getPath($id);
		break;
	case 'getInfoById':
		$id=$_GET['id'];
		$info=new CONTENTINFO();
		$info->getInfoById($id);
		break;			
	default:;
}
?>