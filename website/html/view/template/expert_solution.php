<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link  rel="stylesheet" type="text/css"  href="../../../../common/html/plugin/easyui/themes/default/easyui.css" />
<link rel="stylesheet" type="text/css"  href="../../../../common/html/plugin/easyui/themes/icon.css" />
<link href="../css/expert_solution/expert_solution.css" rel="stylesheet" type="text/css" />
<link href="../css/button.css" rel="stylesheet" type="text/css" />
<script src="../../../../common/html/lib/js/jquery-1.11.2.min.js"></script>
<script type="text/javascript"  src="../../../../common/html/plugin/jquery-hlui-2.0/js/hlui.js"></script>
<script type="text/javascript" src="../../../../common/html/plugin/jquery-hlui-2.0/js/form.js"></script>
<script type="text/javascript" src="../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>
<script src="../../../../common/html/js/piccommon.js"></script>
<script src="../../../../common/html/js/attachcommon.js"></script>
<script type="text/javascript" src="../js/expert_solution.js"></script>
<script type="text/javascript" src="../../../../center/html/view/js/ukeycommon.js"></script>
<script type="text/javascript" src="../../../../center/html/view/js/NTClientJavascript.js"></script>
</head>
<body>
<!-- "立项阶段"的汇总页面 专家组论证意见 -->
<div class="wrapper">
	<div class="body">
	<div class="func-bar">
	</div>	
		<div class="menusNiframe">
		  <div class="menus-scroll-hidden">
			<div class="menus"><div class="menu-bar"><div title ='项目任务书'>专家组论证意见</div></div>
				<ul style="list-style: none">
				<li class="menu menu-unselected expert_arguments clearfix">专家组论证意见<div class="right pic hide"></div></li>
				<li class="menu menu-unselected expert_sign clearfix">论证专家信息<div class="right pic hide"></div></li>
				<li class="menu menu-unselected check clearfix">审核意见<div class="right pic hide"></div></li>
				<li class="menu submit clearfix" id="sub" onclick="execute();">提交专家论证意见</li>
				</ul>
			</div>
			</div>
			<div class="switch-bar"><div class="switch-bar-arrow" id="swich2"></div></div>
			<div class="iframe"><iframe name="subframe"src="Projectapp/expert_arguments.php" frameborder="0"></iframe></div>
		  
		</div><!--menusNiframe-->
	</div><!--body-->
</div><!--wrapper-->
</body>
</html>


