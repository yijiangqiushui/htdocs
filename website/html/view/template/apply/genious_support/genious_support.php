<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>实施方案</title>
<link  rel="stylesheet" type="text/css"  href="../../../../../../common/html/plugin/easyui/themes/default/easyui.css" />
<link rel="stylesheet" type="text/css"  href="../../../../../../common/html/plugin/easyui/themes/icon.css" />
<link href="../../../css/apply/genious_support/genious_support.css" rel="stylesheet" type="text/css" />
<link href="../../../css/button.css" rel="stylesheet" type="text/css" />
<script src="../../../../../../common/html/lib/js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="../../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="../../../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>
<script src="../../../../../../common/html/js/piccommon.js"></script>
<script src="../../../../../../common/html/js/attachcommon.js"></script>
<script src="../../../js/apply/app_comon.js"></script>
<script src="../../../js/apply/genious_support/genious_support.js"></script>
 <script type="text/javascript" src="../../../../../../center/html/view/js/ukeycommon.js"></script>
<script type="text/javascript" src="../../../../../../center/html/view/js/NTClientJavascript.js"></script>
<style>
 .menu{ 
 position: relative; 
 } 
</style>
</head>
<body>
	<div class="wrapper">
	<div class="body">
	<div class="func-bar">
	</div>
		<div class="menusNiframe">
		   <div class="menus-scroll-hidden">
			<div class="menus">
				<ul style="list-style: none">
                	<div class="menu-bar"><div >人才资助申报推荐表</div></div>
					<li class="menu menu-unselected genious_info clearfix">基本情况<div class="right pic hide"></div></li>
					<li class="menu menu-unselected work_product clearfix">主要工作实绩<div class="right pic hide"></div></li>
					<li class="menu menu-unselected honor_title clearfix"><?php $time = date("Y",time());echo ($time-1)?>年突出贡献及获得的荣誉称号情况<div class="right pic hide"></div></li>
					<li class="menu menu-unselected situation clearfix">申报科技创新人才资助项目情况阐述<div class="right pic hide"></div></li>
					<!-- <li class="menu menu-unselected statement clearfix">填表声明<div class="right pic hide"></div></li> -->
					<li class="menu menu-unselected unit_opinion clearfix">推荐单位意见<div class="right pic hide"></div></li>
					<!-- <li class="menu menu-unselected first_opinion clearfix">区科学技术委员会初审意见<div class="right pic hide"></div></li>
					<li class="menu menu-unselected review_opinion clearfix">评审意见<div class="right pic hide"></div></li>   <!-- 这个需要更改一下 -->
					<!-- <li class="menu menu-unselected final_opinion clearfix">区人才工作领导小组审批意见<div class="right pic hide"></div></li>-->
                    <li class="menu menu-unselected imp_plan clearfix">附件上传<div class="right pic hide"></div></li>
                    <li class="menu menu-unselected check clearfix">审核意见</li>
					
                    <li class="menu submit" id="sub" onclick="execute()">提交资助推荐表</li>
				</ul>
			</div>
			</div>
			<div class="switch-bar" id="swich2"><div class="switch-bar-arrow"></div></div>
			<div class="iframe"><iframe name="subframe" src="org_info.php" frameborder="0" id="iframe2"></iframe></div>
		  
		</div><!--menusNiframe-->
	</div><!--body-->
</div><!--wrapper-->
</body>
</html>
