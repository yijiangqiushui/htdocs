<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/middle_solution/middle_solution.css" rel="stylesheet" type="text/css" />
<link  rel="stylesheet" type="text/css"  href="../../../../common/html/plugin/easyui/themes/default/easyui.css" />
<link rel="stylesheet" type="text/css"  href="../../../../common/html/plugin/easyui/themes/icon.css" />
<link href="../css/button.css" rel="stylesheet" type="text/css" />
<script src="../../../../common/html/lib/js/jquery-2.1.0.min.js"></script>
<script type="text/javascript" src="../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>
<script src="../../../../common/html/js/piccommon.js"></script>
<script src="../../../../common/html/js/attachcommon.js"></script>
<script type="text/javascript" src="../js/middle_solution.js"></script>
 <script type="text/javascript" src="../../../../center/html/view/js/ukeycommon.js"></script>
<script type="text/javascript" src="../../../../center/html/view/js/NTClientJavascript.js"></script>
 

</head>
<body>
   <!-- “实施阶段”的汇总页面 项目中期报告 -->
	<div class="wrapper">
		<div class="body">
			<div class="func-bar">
			</div>
			<div class="menusNiframe">
			   <div class="menus-scroll-hidden">
				<div class="menus">
					<ul>
						<div class="menu-bar">
						<div style="font-size:14px;">
						项目中期报告</div>
						</div>
						
						<li class="menu menu-unselected middle clearfix">项目进展情况<div class="right pic hide"></div></li>
						<li class="menu menu-unselected funnd clearfix">经费使用情况<div class="right pic hide"></div></li>
						<li class="menu menu-unselected problem clearfix">存在问题及采取措施<div class="right pic hide"></div></li>
						<li class="menu menu-unselected imp_plan clearfix">附件上传<div class="right pic hide"></div></li>
						<li class="menu menu-unselected check clearfix">审核意见<div class="right pic hide"></div></li>
						
						<li class="menu submit" id="sub" onclick="execute();">提交项目中期报告</li>
					</ul>
				</div>
				</div>
				<div class="switch-bar"><div class="switch-bar-arrow" id="swich2"></div></div>
				<div class="iframe"><iframe name="subframe" src="Implement/middle.php" frameborder="0"></iframe></div>
			  
			</div>
		</div>
	</div>
</body>
</html>
