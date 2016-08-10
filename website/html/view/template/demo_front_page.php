<?php
/************************************************************************************************************
#	PHP Version 1.2   MySQL  JavaScript
#	Copyright (c) 2009 http://www.cnalog.com
#	Author: Li Zhixiao <English Name: Hawking E-mail:lzxbit2008@yahoo.com.cn QQ:578731186>
#	Date: 2009/10/10
************************************************************************************************************/

require_once('../../../../common/php/config.ini.php');

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
$category=$_GET['category'];
if($category!='')
	$querySQL=" and ci.category like '$category%'";
//echo $category;

//排序的参数，很重要， by 朱俭
$orderBy=" order by ci.isRecommend desc, ci.sortNo desc, ci.releaseTime desc ";

	
/*!-- 分页 start --*/
$p_page=intval($_GET['page']);
if($p_page<1)
	$p_page=1;
$p_pageSize=15;
$baseCount=($p_page-1)*$p_pageSize;
$p_showNum=5;
$p_otherCondition='&category='.$category.'&title='.urlencode($title).'&operator='.urlencode($operator).'&content='.urlencode($content).'&releaseTime_s='.urlencode($releaseTime_s).'&releaseTime_e='.urlencode($releaseTime_e).'&queryStr='.urlencode($queryStr);//注意url汉字需要进行编码
	$p_otherCondition .='&getOrderBy='.$getOrderBy.'&getAscOrDesc='.$ascOrDesc;
	if($ascOrDesc=='asc')
		$ascOrDesc='desc';
	else
		$ascOrDesc='asc';
	$changeOrderByArr=split('&getOrderBy=',$p_otherCondition);

$p_getTotalSQL="select count(id) from contentInfo ci where 1=1 $querySQL";
$_PAGE=new page($p_page,$p_pageSize,$p_showNum,$p_getTotalSQL,$p_otherCondition);
$p_limitStart=$_PAGE->LimitStart();
/*!-- 分页 end --*/

	


/*!-- 获取列表信息 start --*/
$sql="select ci.* from contentInfo ci where 1=1 $querySQL $orderBy limit $p_limitStart,$p_pageSize";
$info=$contentCls->getBatchInfo($sql);
if($info)
	$recordCount=count($info);
/*!-- 获取列表信息 end --*/
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<link type="text/css" href="../css/qianlogin.css" rel="stylesheet">
<script type="text/javascript"
	src="../../../../common/html/lib/js/jquery-2.1.0.min.js"></script>
<script type="text/javascript"
	src="../../../../common/html/plugin/jquery-hlui-2.0/js/hlui.js"></script>
<script type="text/javascript"
	src="../../../../common/html/plugin/jquery-hlui-2.0/js/form.js"></script>

<link rel="stylesheet" type="text/css"
	href="../../../../common/html/plugin/easyui/themes/default/easyui.css" />
<link rel="stylesheet" type="text/css"
	href="../../../../common/html/plugin/easyui/themes/icon.css" />
<script type="text/javascript"
	src="../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="../js/config.js"></script>
<script type="text/javascript" src="../js/index.js"></script>

<link href="../../../../common/html/plugin/jquery-hlui-2.0/css/form.css"
	rel="stylesheet" type="text/css" />
</head>
<body>
	<div class="head">
		<div class="logo"></div>
	</div><!--head-->
	<div class="middle">
		<div class="m_title">
			<?php
				echo $info[0][category];
			?>
		</div> 
		<div id="container">

			<ul>
			<?php
				for($i=0;$i<$recordCount;$i++){
			?>
	
			<?php
						 echo '<li style="list-style:none"><a href="demo_content.php?id='.$info[$i][id].' ">'.$info[$i][title].'</a></li>';
			?>
			<br>
					
			<?php
					}
			?>
			</ul>
			<hr id="line">
	  		<div class="pageDvde"><?php $_PAGE->phpDevide()?></div>	
  		</div>
		
	</div><!--body-->
  	<div class="gap"></div>
	<div class="foot"><div class="foot-img1"></div><div class="help1">帮</div><div class="help2">助</div><div class="help3">信</div><div class="help4">息</div>
	<div class="foot-img2"></div><div class="sys-pro">系统使用说明</div>
	<div class="foot-img3"></div><div class="file-down">文件下载专区</div><div class="foot-img4"></div><div class="com-pro">常见问题</div>
	<div class="foot-img5"></div><div class="top-line">服 务 热 线：010-0121212</div></div>


</body>
</html>