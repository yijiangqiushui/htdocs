<?php
/************************************************************************************************************
#	PHP Version 1.2   MySQL  JavaScript
#	Copyright (c) 2009 http://www.cnalog.com
#	Author: Li Zhixiao <English Name: Hawking E-mail:lzxbit2008@yahoo.com.cn QQ:578731186>
#	Date: 2009/10/10
************************************************************************************************************/

require_once('../../../common/php/config.ini.php');

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
switch ($category) {
	case '1':
		$category = '通知公告';
		break;
	case '2':
		$category = '重要提示';
		break;
	case '3':
		$category = '公示公告';
		break;
	case '4':
		$category = '申报指南';
		break;
	case '5':
		$category = '申报解读';
		break;
	
	default:
		# code...
		break;
}

//echo $category;

// $priviledges=$userCls->getPriviledges($_SESSION['S_A_ID']);
// if($priviledges[id]!=1 && (!$priviledges[contentInfoP] || $priviledges[contentCat]=='none')){
// 	exit;
// }
// if($priviledges[id]!=1 && ($category && $priviledges[contentCat] && strpos($category,$priviledges[contentCat],0)===0))
// 	exit;
/*!-- 预留位置 end --*/

/*!-- 获取值 start --*/
if($category!='')
	$querySQL=" and ci.category like '$category%'";
// elseF
// 	$querySQL=" and ci.category like '".$priviledges[contentCat]."%'";

if($_POST['title'])
	$title=$_POST['title'];
else
	$title=urldecode($_GET['title']);//注意url汉字需要进行解码
if($title!='')//不空的时候添加关键字查询
	$querySQL .= " and ci.title like '%$title%'";
	
if($_POST['operator'])
	$operator=$_POST['operator'];
else
	$operator=urldecode($_GET['operator']);
if($operator!='')
	$querySQL .= " and ci.operator like '%$operator%'";

//echo '<br>判断任务权限contentInfoP的：'.$priviledges[id];
// if($priviledges[id]==2)
// 	$querySQL .= ' and ci.source like "%'.$_SESSION['S_A_name'].'%"';

	
if($_POST['content'])
	$content=$_POST['content'];
else
	$content=urldecode($_GET['content']);
if($content!='')
	$querySQL .= " and ci.content like '%$content%'";
	
if($_POST['releaseTime_s'])
	$releaseTime_s=formatDate($_POST['releaseTime_s']);
else
	$releaseTime_s=urldecode($_GET['releaseTime_s']);
if($releaseTime_s!='')
	$querySQL .= " and ci.releaseTime>='$releaseTime_s'";
	
if($_POST['releaseTime_e'])
	$releaseTime_e=formatDate($_POST['releaseTime_e']);
else
	$releaseTime_e=urldecode($_GET['releaseTime_e']);
if($releaseTime_e!='')
	$querySQL .= " and date_sub(ci.releaseTime,interval 1 day)<'$releaseTime_e'";

$ascOrDesc=$_GET['getAscOrDesc'];
$getOrderBy=$_GET['getOrderBy'];
if($getOrderBy==''){
	$orderBy=" order by ci.isRecommend desc, ci.sortNo desc, ci.releaseTime desc ";
}
else 
	$orderBy=" order by CONVERT($getOrderBy USING GBK) $ascOrDesc ";
/*!-- 获取值 end --*/

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

/*--编辑信息开始--*/
if($_GET['editMode']){
	for($i=0;$i<$_POST['totalRecord'];$i++){
		 $setValSQL='';
		// $setValSQL='sortNo='.$_POST['sortNo_'.$i];
		if(($_POST['isForbidden_'.$i]))
		{	$mark=1;
			$setValSQL .= 'isForbidden=1';
		}else{	
			$mark=0;
			$setValSQL .= 'isForbidden=0';
		}		
		if($_POST['isRecommend_'.$i])
			$setValSQL .= ',isRecommend=1';
		else
			$setValSQL .= ',isRecommend=0';
	
		
		
		
		$rs1_tmp=$contentCls->getInfo($_POST['hiddenId_'.$i]); //注意这是子任务的函数， 任务的函数是 getInfo
		$isForbidden = $rs1_tmp['isForbidden'];
		
	$aa = 'mark:'.$mark.'_isForbidden:'.$isForbidden.'<br>';



		$contentCls->update("update contentInfo set ".$setValSQL." where id=".$_POST['hiddenId_'.$i]);
		$contentCls->update("update contentInfo set releaseTime='".$_POST['releaseTime_'.$i]."' where id=".$_POST['hiddenId_'.$i]);
//除非以后有更好的方法				
	// echo "update contentInfo set ".$setValSQL." where id=".$_POST['hiddenId_'.$i];
			
		
		
	}

$flag .= $aa.'<br>';
		
//	echo '<script type="text/javascript">window.location.href="?page='.$p_page.$p_otherCondition.'";</script>';
}
/*--编辑信息结束--*/

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
<title>无标题文档</title>

<link href="../../system/css/table/table.css" type="text/css" rel="stylesheet" />
<link href="../../system/css/form/form.css" type="text/css" rel="stylesheet" />
<link href="../../system/css/page/page_1.css" type="text/css" rel="stylesheet" />

<link href="../../css/common.css" type="text/css" rel="stylesheet" />
<link href="../../css/view.css" type="text/css" rel="stylesheet" />
<link href="../../css/listStyle.css" type="text/css" rel="stylesheet" />

<script type="text/javascript" src="../..//system/js/table.js"></script>
<script type="text/javascript" src="../../system/js/setCheckbox.js"></script>
<script type="text/javascript" src="../../system/js/checkFunc.js"></script>
<script type="text/javascript" src="../../system/js/aidFunc.js"></script>
<script type="text/javascript" src="../../system/js/ajax.js"></script>
<script type="text/javascript" src="../../system/js/jquery-1.2.4a.js" charset="utf-8"></script>
<script type="text/javascript" src="../../system/js/ui.base.min.js" charset="utf-8"></script>
<script type="text/javascript" src="../../system/js/ui.draggable.min.js" charset="utf-8"></script>
<script type="text/javascript" src="../../system/js/calendar.js"></script>
<script type="text/javascript" src="../../system/js/jquery-2.1.0.min.js"></script>


</head>

<body>
<div class="side_t">公告分类</div>
<div class="side">
		<ul class="easyui-tree">

		<li>
			<span><a href="/cms/cms/frame/list.php?category=1" >通知公告</a></span>
		</li>
		<li>
			<span><a href="/cms/cms/frame/list.php?category=2" >重要提示</a></span>
		</li>
		<li>
			<span><a href="/cms/cms/frame/list.php?category=3" >公示公告</a></span>
		</li>
		<li>
			<span><a href="/cms/cms/frame/list.php?category=4" >申报指南</a></span>
		</li>
		<li>
			<span><a href="/cms/cms/frame/list.php?category=5" >申报解读</a></span>
		</li>
	</ul>		
</div>
<div class="container_t"><?php echo $category;?></div>
<div id="container">
  <form id="myForm" name="myForm" method="post" action="?editMode=1&page=<?php echo $p_page.$p_otherCondition;?>">
	<div id="infoList">
	<div id="funcDiv_top">
	<input name="queryBtn" type="button" class="buttonStyle" id="queryBtn" value="信息查询" onclick="showQueryDlg('<?php echo $showQueryDlg;?>');" />
    <?php if($category!='s208e' && $category!='s1es126e' && $category!='s1es171e' && $category!='s1es172e' && $category!='s1e' && $category!='s1es177e' && strpos($category,'s1es205e')===false && strpos($category,'s1es10e')===false)  { ?>      <? }  ?>
	<input name="addButton" type="button" class="buttonStyle" id="addButton" value="添加信息" <?php echo ' onclick="showAddNEditDlg(\''.$category.'\',0);" ';?> />

	</div>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" id="table_showData_1">
		<caption>信息管理</caption>
		<thead>
			<tr class="table_th_tr">
				<td width="30" class="table_th_td_f">编号</td>
				<td width="30" class="table_th_td">选择</td>
				<td width="280" class="table_th_td" onclick="window.location.href='?page=<?php echo $p_page.$changeOrderByArr[0].'&getOrderBy=ci.title&getAscOrDesc='.$ascOrDesc;?>';" style="cursor:pointer;">信息</td>
				<td width="65" class="table_th_td" onclick="window.location.href='?page=<?php echo $p_page.$changeOrderByArr[0].'&getOrderBy=ci.operator&getAscOrDesc='.$ascOrDesc;?>';" style="cursor:pointer;">发布人</td>
				<td width="90" class="table_th_td" onclick="window.location.href='?page=<?php echo $p_page.$changeOrderByArr[0].'&getOrderBy=ci.releaseTime&getAscOrDesc='.$ascOrDesc;?>';" style="cursor:pointer;">发布时间</td>
				<td width="30" class="table_th_td">置顶</tpd>
				<td width="30" class="table_th_td" title="勾选上表示在首页里不显示该条信息">废弃</td>
				<td width="30" class="table_th_td_l">操作</td>

			</tr>
		</thead>
		<tbody>
		<?php 
			for($i=0;$i<$recordCount;$i++){
		?>
			<?php
				// if($priviledges[id]==1 || $priviledges[contentInfoP]>4)  是否有双击修改信息的权限
					echo '<tr class="table_tb_tr" ondblclick="showAddNEditDlg(\''.$category.'\','.$info[$i][id].');">';
				// else
				 	//echo '<tr class="table_tb_tr">';
			?>
				<td class="table_tb_td_f"><?php echo ($baseCount+$i+1);?>.</td>
				<td class="table_tb_td">
				<?php
					echo '<input name="hiddenId_'.$i.'" type="hidden" value="'.$info[$i][id].'" />';
					echo '<input name="itemArr" type="checkbox" value="'.$info[$i][id].'" />';
				?></td>
				<td class="table_tb_td">
                
				<?php
					 echo '<a href="javascript:showViewDlg('.$info[$i][id].');">'.$info[$i][title].'</a>';
				?>
				</td>
				<td class="table_tb_td"><?php echo $info[$i][operator];?></td>
				<td class="table_tb_td"> <input name="releaseTime_<?php echo $i;?>" type="text" id="releaseTime_<?php echo $i;?>" value="<?php echo $info[$i][releaseTime];?>"  ></td>
<td class="table_tb_td"><?php 
					if($info[$i][isRecommend])
						echo '<input name="isRecommend" type="checkbox" id="isRecommend" value="'.$info[$i][id].'" checked="checked" />';
					else
						echo '<input name="isRecommend" type="checkbox" id="isRecommend" value="'.$info[$i][id].'" />';
				?></td>
				<td class="table_tb_td"><?php 
					if($info[$i][isForbidden])
						echo '<input name="isForbidden_'.$i.'" type="checkbox" id="isForbidden" value="'.$info[$i][id].'" checked="checked" />';
					else
						echo '<input name="isForbidden_'.$i.'" type="checkbox" id="isForbidden" value="'.$info[$i][id].'" />';
				?></td>

	
				<?php
					echo '<td class="table_tb_td_l"><a href="javascript:showAddNEditDlg(\''.$category.'\','.$info[$i][id].');">编辑</a></td>';

			echo "</tr>";
	}
		?>
		</tbody>
	</table>
    <input id="page" type="hidden" value="<?php echo $p_page;?>" />
	<input name="totalRecord" type="hidden" value="<?php echo $recordCount;?>">
	<input name="reloadPage" type="hidden" value="<?php echo '?page='.$p_page.$p_otherCondition;?>" />
  <div id="funcDiv_btm">
    <input name="Input" type="button" value="全选" onclick="setCheckbox(1);" class="buttonStyle" <?php if(!$recordCount) echo 'disabled="disabled"';?> />
    <input name="Input" type="button" value="反选" onclick="setCheckbox(-1);" class="buttonStyle" <?php if(!$recordCount) echo 'disabled="disabled"';?> />
	<?php
	// if($priviledges[id]==1){
		echo '<input name="deleteAll_btm" type="button" value="删除所选" onclick="delOperation();" class="buttonStyle" /> ';
	// }
	// else
		// echo '<input name="deleteAll_btm" type="button" value="本项目不能删除" onclick="delOperation();" class="buttonStyle" disabled="disabled" title ="本项目不能删除" /> ';
	

	//if($recordCount && ($priviledges[id]==1 || $priviledges[contentInfoP]>4))
echo '<input name="submitBtn" type="submit" class="buttonStyle" id="submitBtn" value="更新信息状态" />';

	?>
  </div>
  <div class="pageDvde"><?php $_PAGE->phpDevide()?></div>
  </div>
  </form>
</div>

<br>
<div class="noteBlue">
<?php 
	if(strstr($category,'s1es173e'))
		echo '提示:'; 

/*	else if(strstr($category,'s1es171e'))//注意链接也是在附件里（横幅图片里）
		echo '提示：填写链接地址格式必须以http://开头，例如http://www.baidu.com <br> 首页底部链接的图片尺寸：宽83px高32px，请上传到横幅图片。'; //首页标题图片
	else if(strstr($category,'s1es177e'))//前锋微博,只有地址的指向
		echo '提示：填写链接地址格式必须以http://开头，例如http://www.baidu.com，修改本栏目指向的地址即可。'; 
	else if(strstr($category,'s1es10es11e')||strstr($category,'s1es10es12e'))//前锋微博,只有地址的指向
		echo '提示：。'; 
	else if(strstr($category,'s1es205e'))
		echo '提示：首页三张标题图片尺寸：宽318px高110px，请上传到横幅图片。<br>填写指向的链接地址格式必须以http://开头'; //首页三张教育类图片
	else if(strstr($category,'s208e'))
		echo '提示：二级页面标题图尺寸：宽960px高110px，请上传到横幅图片。'; //首页三张教育类图片		
	else if(strstr($category,'s120es66e') ) 
		echo '提示：视频新闻需要的标题图尺寸：宽100px高87px，请上传到视频标题图。'; // 123 112
	else if( strstr($category,'s121es123e')) 
		echo '提示：视频新闻需要的标题图尺寸：宽125px高110px，请上传到视频标题图。'; //  
	else if(strstr($category,'s121es122e'))
		echo '提示：文档资源支持word、zip和rar格式，请上传到附件。'; //
	else if(strstr($category,'s121es89e'))
		echo '提示：软件支持zip和rar压缩格式，请上传到附件'; //
	else if(strstr($category,'s157es159e')||strstr($category,'s157es160e'))
		echo '提示：本栏目添加内容或编辑内容后，需要点击<input name="updatePageBtn" type="button" class="buttonStyle" id="updatePageBtn" value="更新九处锋彩的首页" onclick="window.location.href=\'../process/info/updatePage.php\';" />，首页才会完成发布状态。'; 
	else if(strstr($category,'s157es161e'))
		echo '提示：本栏目的图片，请上传到图片墙。'; 
*/		
?>

</div>

<script type="text/javascript" src="../js/info.js"></script>


</body>
</html>