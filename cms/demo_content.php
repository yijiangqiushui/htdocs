<?php
/************************************************************************************************************
#	PHP Version 1.2   MySQL  JavaScript
#	Copyright (c) 2009 http://www.cnalog.com
#	Author: Li Zhixiao <English Name: Hawking E-mail:lzxbit2008@yahoo.com.cn QQ:578731186>
#	Date: 2009/10/10
************************************************************************************************************/

require_once('../common/php/config.ini.php');

require_once(ROOTPATH.'../../cms/class/content.cls.php');
require_once(ROOTPATH.'../../cms/system/class/page.cls.php');
require_once(ROOTPATH.'../../cms/system/func/special.inc.php');

/*!-- 类声明 start --*/
$contentCls=new content();

/*!-- 类声明 end --*/

$nowDate = date('Y-m-d H:i:s');//记下现在的时刻

/**
* 在该部分判断管理员身份，非管理员不进行处理
**/
/*!-- 预留位置 start --*/
$id=$_GET['id'];

$querySQL=" id=".$id;
//echo $category;




/*!-- 获取列表信息 start --*/
$sql="select ci.* from contentInfo ci where $querySQL";
$info=$contentCls->getBatchInfo($sql);

/*!-- 获取列表信息 end --*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="/cms/system/css/table/table.css" type="text/css" rel="stylesheet" />
<link href="/cms/system/css/form/form.css" type="text/css" rel="stylesheet" />
<link href="/cms/system/css/page/page_1.css" type="text/css" rel="stylesheet" />

<link href="../../css/common.css" type="text/css" rel="stylesheet" />
<link href="../../css/view.css" type="text/css" rel="stylesheet" />


</script>

</head>

<body>
<div id="container">




		<?php
					 echo '标题：'.$info[0][title];

					 echo "<br><br>内容：";

					 echo $info[0][content];

					  echo "<br><br>";

					 echo $info[0][releaseTime];
		?>

				


  </div>
<hr>


</body>
</html>