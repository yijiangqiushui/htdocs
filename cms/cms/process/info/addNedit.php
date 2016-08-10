<?php
/************************************************************************************************************
#	PHP Version 1.2   MySQL  JavaScript
#	Copyright (c) 2009 http://www.cnalog.com
#	Author: Li Zhixiao <English Name: Hawking E-mail:lzxbit2008@yahoo.com.cn QQ:578731186>
#	Date: 2009/10/10
************************************************************************************************************/

require_once('../../../../common/php/config.ini.php');
require_once(ROOTPATH.'../../cms/class/content.cls.php');
require_once(ROOTPATH.'../../cms/system/class/upFile.cls.php');

$contentCls=new content();
$oUpload=new upFile();

/**
* 在该部分判断管理员身份，非管理员不进行处理
**/
//预留位置

$id=$_GET['id'];
$page = $_REQUEST['page'];

$data=array();
$data[category]=$_POST['category'];
$data[title]=$_POST['title'];
$data[content]=$_POST['content'];
// $data[briefIntro]=''; //  朱俭注释掉 简介这一块 $_POST['briefIntro'];
$data[operator]=$_POST['operator'];
// $data[source]=$_POST['source'];
/*$data[releaseTime]=date('Y-m-d H:i:s'); 这里mysql本来有个默认时间的。*/ 
$data[releaseTime]=$_POST['releaseTime'];

$fileInput='uploadFile';
$fileFolder='/uploadFiles/contentFiles/'.date('Ym').'/';
$savePath=ROOTPATH.'uploadFiles/contentFiles/'.date('Ym').'/';
$limitSize=0.2*1024*1024*1024;
$returnStr=$oUpload->uploadFile($fileInput,$savePath,$limitSize,$originalFile);


if($returnStr){
	$data[filePath]=$fileFolder.$returnStr;
}


if(!$id){
	$infoid=  $contentCls->addInfo($data);	
}
else{
	$infoid =  $id;
	if($contentCls->editInfo($id,$data)){	}
}

/*记录开始*/
$logdata[user] = $_SESSION['S_A_name'];
$logdata[infoId] = $infoid;
	/*	start	通过任务infoid查找所属的项目类别category*/
	$rs1=$contentCls->getInfo($logdata[infoId]);
	// $category = $rs1['category'];
	/*	end	通过任务infoid查找所属的项目类别category*/
// $logdata[category] =$category;
// $logdata[logtime] =date('Y-m-d H:i:s');
// /*记录结束*/
// /*记录开始*/
// if($id)
// 	{
// 		$logdata[motion] ='修改任务：'.strip_tags($data[content]);
// 		echo $contentCls->addLog($logdata);

// 		}
// else
// 	{
// 		$logdata[motion] ='发布任务：'.strip_tags($data[content]);
// 		echo $contentCls->addLog($logdata);		
// 		}	
/*记录结束*/
echo '<script type="text/javascript">';
	echo "parent.window.location.href='../../frame/list.php?category=".$_POST['category']."&page=".$page."'";
echo '</script>';
?>