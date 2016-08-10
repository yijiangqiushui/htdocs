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
$oDel=new upFile();

/**
* 在该部分判断管理员身份，非管理员不进行处理
**/
//预留位置

$idArr=$_POST['idArr'];

$sql="select filePath from contentInfo where id in ($idArr)";
$dataArr=$contentCls->getBatchInfo($sql);

if($contentCls->delBatchInfo($idArr)){
	for($i=0;$i<count($dataArr);$i++){
		$oDel->delFile(ROOTPATH.$dataArr[$i][filePath]);
	}
}
	//echo "1"; 这个返回值好像有问题
?>