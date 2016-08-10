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
//$category=$_GET['category'];
/*$category=1;
if($category!='')
	$querySQL=" and ci.category like '$category%'";
//echo $category;

	
//排序的参数，很重要， by 朱俭
$orderBy=" order by ci.isRecommend desc, ci.sortNo desc, ci.releaseTime desc ";
	


/*!-- 获取列表信息 start --*/
/*$sql="select ci.* from contentInfo ci where 1=1 $querySQL $orderBy limit 0,7 ";
$info=$contentCls->getBatchInfo($sql);
if($info)
	$recordCount=count($info);*/
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
<div class="wrapper">
 <form id="form1" name="form1" method="post" action="" class="hlui-form">
	<div class="head">
		<div class="logo"></div>
	</div><!--head-->
	<div class="body" > 
		<div class="block1"><div class="block1-name1"></div><div class="block1-word1">用户名：<input type="text" name="username" id="username" class="ui-form-validate ui-form-text" data-opt="required:true" /></div>
							<div class="block1-name2"></div><div class="block1-word2">密&nbsp;&nbsp;&nbsp;&nbsp;码：<input type="password" name="password" id="password" class="ui-form-validate ui-form-text" data-opt="required:true" /></div>
							<div class="block1-name3"></div><div class="block1-word3">验证码：<input type="text" name="validateCode" id="validateCode" style="width:80px;" class="ui-form-validate ui-form-text" data-opt="required:true" /></div>
							<div class="block1-validate"><img src="../../../../common/php/file/validateCode.png.php" alt="点击更换验证码" title="点击更换验证码" id="validateCodeImg"/></div>
							<div id="submitbtn"><div class="login" ></div><div class="login-word" id="submitbtn1">登 录</div> </div> <div><a href="register_1.php"><div class="register" ></div><div class="register-word" >注 册</div></a></div>
							<div class="forget-pwd"><a href="#" id="get_help">忘记密码</a></div>
							<div class="inform">通知通告</div>
							<div class="notice"> 
							<ul  class="ul1">
							<?php
								$category='通知公告';
								if($category!='')
									$querySQL=" and ci.category like '$category%' and ci.isForbidden <> 1";
								//echo $category;
								
								
								//排序的参数，很重要， by 朱俭
								$orderBy=" order by ci.isRecommend desc, ci.sortNo desc, ci.releaseTime desc ";
								
								
								
								/*!-- 获取列表信息 start --*/
								$sql="select ci.* from contentInfo ci where 1=1 $querySQL $orderBy limit 0,7 ";
								$info1=$contentCls->getBatchInfo($sql);
								if($info1)
									$recordCount1=count($info1);
								for($i=0;$i<$recordCount1;$i++){
							?>
							<li>>>
							<?php
					 			echo '<a href="demo_content.php?id='.$info1[$i]['id'].' ">'.$info1[$i]['title'].'</a>';
							?>
							<span>
							<?php echo substr($info1[0]['releaseTime'],0,10);?>
							</span>
							<br>
									
							<?php
								}
							?>

							<!-- david add  汇报用 -->
							
						    <li>>>关于转发《关于组织开展国家知识产权优势企业和示范企业申...》          <span>2015-06-04</span></li>
							<li>>>关于2015年度通州 区专利实施项目审评结果公示 的通知                              <span> 2015-05-21</span></li>
							<li>>>关于打击非法集资专项整治行动工作的通知                                                        <span> 2015-05-12</span></li>
							<li>>>关于开展第二届“通州科技创新人才奖”评选表彰活动的通知                           <span>2015-04-17</span></li>
							<li>>>推荐北京市科学技术奖候选项目公示                                                                    <span> 2015-04-16</span></li>
							<li>>>关于转发《关于申报2015年度北京专利十点单位的通知》...       <span>2015-03-11</span></li>
							<li>>>关于开展2015年度通州区支持科技创新专项申报工作的通...       <span>2015-03-10</span></li>	
							
							
							<li style="float: right;width:50px"><a style="font-weight:600;" href="demo_front_page.php?category=通知公告">更多>></a></li>
							</ul>
							</div>
							
		</div>
		<div class="block2" >
			<div class="block2-bleft">
			
			<div class="block2-ref"></div><div class="block2-word">重 要 提 示</div><div class="block2-word2"><a style="font-weight:600;" href="demo_front_page.php?category=重要提示">更多>></a></div>
			
			<div class="block2-left"></div>
			<div class="imp-inform">
			<ul class="ul2">
			
			<!-- david add  汇报用 -->
			
			<li>专利费用减缓申报指南</li>
			<li>通州区专利授权资助申报指南</li>
			<li>通州区专利奖励申报指南</li>
			<li>通州区专利实施项目申报指南</li>
			<li>关于印发《北京市科普基地管理办法》的通知</li>
			<li>专利费用减缓申报指南</li>
			<li>通州区专利授权资助申报指南</li>
			<li>通州区专项奖励申报指南</li>
			<?php
				$category='重要提示';
				if($category!='')
					$querySQL=" and ci.category like '$category%' and ci.isForbidden <> 1";
				//echo $category;
				
				
				//排序的参数，很重要， by 朱俭
				$orderBy=" order by ci.isRecommend desc, ci.sortNo desc, ci.releaseTime desc ";
				
				
				
				/*!-- 获取列表信息 start --*/
				$sql="select ci.* from contentInfo ci where 1=1 $querySQL $orderBy limit 0,8 ";
				$info2=$contentCls->getBatchInfo($sql);
				if($info2)
					$recordCount2=count($info2);
				for($i=0;$i<$recordCount2;$i++){
			?>
			
			
			<li><?php echo '<a href="demo_content.php?id='.$info2[$i][id].' ">'.$info2[$i][title].'</a>';?></li>
			<?php }?>
			</ul>
			</div>
			</div>
			<div class="block2-bright">
			<div class="block2-rightref"></div><div class="block2-rightword">公 示 公 告</div><div class="block2-rightword2"><a style="font-weight:600;" href="demo_front_page.php?category=公示公告">更多>></a></div>
			
			<div class="block2-right"></div>
			<div class="imp-inform2">
			<ul class="ul3">
			
			
			<!-- david add  汇报用 -->
			<li>专利费用减缓申报指南</li>
			<li>通州区专利授权资助申报指南</li>
			<li>通州区专利奖励申报指南</li>
			<li>通州区专利实施项目申报指南</li>
			<li>关于印发《北京市科普基地管理办法》的通知</li>
			<li>专利费用减缓申报指南</li>
			<li>通州区专利授权资助申报指南</li>
			<li>通州区专项奖励申报指南</li>
			
			<?php
				$category='公示公告';
				if($category!='')
					$querySQL=" and ci.category like '$category%' and ci.isForbidden <> 1";
				//echo $category;
				
				
				//排序的参数，很重要， by 朱俭
				$orderBy=" order by ci.isRecommend desc, ci.sortNo desc, ci.releaseTime desc ";
				
				
				
				/*!-- 获取列表信息 start --*/
				$sql="select ci.* from contentInfo ci where 1=1 $querySQL $orderBy limit 0,8 ";
				$info3=$contentCls->getBatchInfo($sql);
				if($info3)
					$recordCount3=count($info3);
				for($i=0;$i<$recordCount3;$i++){
			?>
			
			
			<li><?php echo '<a href="demo_content.php?id='.$info3[$i][id].' ">'.$info3[$i][title].'</a>';?></li>
			<?php }?>
			</ul>
			</div>
			</div>
			
			<div style="clear:both"></div>	
		</div>
		<div class="gap"></div>
		<div class="block3">
			<div class="block3-bleft">
			<div class="block3-ref"></div><div class="block3-word">申 报 指 南</div><div class="block3-word2"><a style="font-weight:600;" href="demo_front_page.php?category=申报指南">更多>></a></div>
			<div class="block3-left"></div>
			<div class="imp-inform3">
			<ul class="ul4">
			<?php
				$category='申报指南';
				if($category!='')
					$querySQL=" and ci.category like '$category%' and ci.isForbidden <> 1";
				//echo $category;
				
				
				//排序的参数，很重要， by 朱俭
				$orderBy=" order by ci.isRecommend desc, ci.sortNo desc, ci.releaseTime desc ";
				
				
				
				/*!-- 获取列表信息 start --*/
				$sql="select ci.* from contentInfo ci where 1=1 $querySQL $orderBy limit 0,8 ";
				$info4=$contentCls->getBatchInfo($sql);
				if($info4)
					$recordCount4=count($info4);
				for($i=0;$i<$recordCount4;$i++){
			?>
			<li><?php echo '<a href="demo_content.php?id='.$info4[$i][id].' ">'.$info4[$i][title].'</a>';?></li>
			<?php }?>
			</ul>
			</div>
			</div>
			
			<div class="block3-rightref"></div><div class="block3-rightword">申 报 解 读</div><div class="block3-rightword2"><a style="font-weight:600;" href="demo_front_page.php?category=申报解读">更多>></a></div>
			
			<div class="block3-bright"><div class="block3-right"></div>
			
			<div class="imp-inform4">
			<ul class="ul5">
			<?php
				$category='申报解读';
				if($category!='')
					$querySQL=" and ci.category like '$category%' and ci.isForbidden <> 1";
				//echo $category;
				
				
				//排序的参数，很重要， by 朱俭
				$orderBy=" order by ci.isRecommend desc, ci.sortNo desc, ci.releaseTime desc ";
				
				
				
				/*!-- 获取列表信息 start --*/
				$sql="select ci.* from contentInfo ci where 1=1 $querySQL $orderBy limit 0,8 ";
				$info5=$contentCls->getBatchInfo($sql);
				if($info5)
					$recordCount5=count($info5);
				for($i=0;$i<$recordCount5;$i++){
			?>
			<li><?php echo '<a href="demo_content.php?id='.$info5[$i][id].' ">'.$info5[$i][title].'</a>';?></li>
			<?php }?>
			</ul>
			</div>
			</div>
			<div style="clear:both"></div>	
		</div>
	</div><!--body-->
	<div class="gap"></div>
	<div class="foot"><div class="foot-img1"></div><div class="help1">帮</div><div class="help2">助</div><div class="help3">信</div><div class="help4">息</div>
	<div class="foot-img2"></div><div class="sys-pro">系统使用说明</div>
	<div class="foot-img3"></div><div class="file-down">文件下载专区</div><div class="foot-img4"></div><div class="com-pro">常见问题</div>
	<div class="foot-img5"></div><div class="top-line">服 务 热 线：010-0121212</div></div>
	</form>
</div><!--wrapper-->
</body>
</html>
