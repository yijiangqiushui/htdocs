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
$p_pageSize=3;
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
			for($i=0;$i<$recordCount;$i++){
		?>

		<?php
					 echo '<a href="demo_content.php?id='.$info[$i][id].' ">'.$info[$i][title].'</a>';
		?>
<br>
				
		<?php
				}
		?>
		


  </div>
<hr>
  <div class="pageDvde"><?php $_PAGE->phpDevide()?></div>
  </div>





</body>
</html>