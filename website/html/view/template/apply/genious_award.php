 <?php
include dirname(__FILE__)."/../common.php";
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>实施方案</title>
<script src="../../../../../common/html/lib/js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
<script src="../../js/apply/app_comon.js"></script>
<script src="../../js/apply/genious_award/genious_award.js"></script>
<script src="../../../../../common/html/js/attachcommon.js"></script>

<link href="../../css/apply/genious_award/genious_award.css" rel="stylesheet" type="text/css" />
<style>
#sub{width:199px;
     height:33px; 
     background-image:url(../../../img/main-xmsbxt/manage.png); 
     float:left;
     color:#ffffff;
     font-size:20px;
 }
</style>
</head>
<body>
	<div class="wrapper">
	<div class="body">
	<div class="func-bar">
	</div>
		<div class="menusNiframe">
			<div class="menus">
				<ul style="list-style: none">
                	<div class="menu-bar"><div>申报推荐表</div></div>
				
					<li class="menu menu-unselected org_info clearfix">基本情况<div class="right pic hide"></div></li>
					<li class="menu menu-unselected work_product clearfix">2014年度主要工作实绩<div class="right pic hide"></div></li>
					<li class="menu menu-unselected honor_title clearfix">2014年度突出贡献及获得的荣誉称号情况<div class="right pic hide"></div></li>
					<li class="menu menu-unselected situation clearfix">申报科技创新人才奖励项目情况阐述<div class="right pic hide"></div></li>
					<li class="menu menu-unselected statement clearfix">填表声明<div class="right pic hide"></div></li>
					<li class="menu menu-unselected unit_opinion clearfix">推荐单位意见<div class="right pic hide"></div></li>
					<li class="menu menu-unselected first_opinion clearfix">区科学技术委员会初审意见<div class="right pic hide"></div></li>
					<li class="menu menu-unselected review_opinion clearfix">评审意见<div class="right pic hide"></div></li>   <!-- 这个需要更改一下 -->
					<li class="menu menu-unselected final_opinion clearfix">区人才工作领导小组审批意见<div class="right pic hide"></div></li>

                    <li class="menu menu-unselected check clearfix">审核意见</li>
					
                    <li class="menu menu-unselected submit" id="sub" onclick="execute()">提交实施方案</li>
				</ul>
			</div>
			<div class="switch-bar" id="swich2"><div class="switch-bar-arrow"></div></div>
			<div class="iframe"><iframe name="subframe" src="../../Projectapp/org_info.php" frameborder="0" id="iframe2"></iframe></div>
		</div><!--menusNiframe-->
	</div><!--body-->
</div><!--wrapper-->
</body>
</html>
