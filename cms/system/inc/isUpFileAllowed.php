<?php
/************************************************************************************************************
#	PHP Version 1.2   MySQL  JavaScript
#	Copyright (c) 2009 http://www.cnalog.com
#	Author: Li Zhixiao <English Name: Hawking E-mail:lzxbit2008@yahoo.com.cn QQ:578731186>
#	Date: 2009/10/10
************************************************************************************************************/

require_once('../../config.ini.php');
require_once(ROOTPATH.'system/class/fileType.cls.php');

$catId=$_POST['catId'];
$fileExt=$_POST['fileExt'];

$dataArr=array();

$fileTypeCls=new fileType();

$sql="select id from fileTypeInfo where catId=$catId and fileTypeName='$fileExt'";
$dataArr=$fileTypeCls->select($sql);

echo $dataArr[0][0];
?>