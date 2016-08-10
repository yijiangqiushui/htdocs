<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link  rel="stylesheet" type="text/css"  href="../../../../common/html/plugin/easyui/themes/default/easyui.css" />
<link rel="stylesheet" type="text/css"  href="../../../../common/html/plugin/easyui/themes/icon.css" />
<link href="../css/modify_solution/modify_solution.css" rel="stylesheet" type="text/css" />
<link href="../css/button.css" rel="stylesheet" type="text/css" />
<script src="../../../../common/html/lib/js/jquery-1.11.2.min.js"></script>
<script type="text/javascript"  src="../../../../common/html/plugin/jquery-hlui-2.0/js/hlui.js"></script>
<script type="text/javascript" src="../../../../common/html/plugin/jquery-hlui-2.0/js/form.js"></script>
<script type="text/javascript" src="../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>
<script src="../../../../common/html/js/piccommon.js"></script>
<script src="../../../../common/html/js/attachcommon.js"></script>
<script type="text/javascript" src="../js/modify_solution.js"></script>
<script type="text/javascript" src="../../../../center/html/view/js/ukeycommon.js"></script>
<script type="text/javascript" src="../../../../center/html/view/js/NTClientJavascript.js"></script>
 <style>
.menu{ 
 position: relative; 
 } </style>
 
</head>

<body>
  <!-- “实施阶段”的汇总页面 调整申请表 -->
	<div class="wrapper">
		<div class="body">
			<div class="func-bar"></div>
			<div class="menusNiframe">
              <div class="menus-scroll-hidden">
				<div class="menus">
					<ul>
						<div class="menu-bar">
							<div>项目调整申请表</div></div>
						<li class="menu menu-unselected org_info clearfix">项目调整申请信息<div class="right pic hide"></div></li>
						<li class="menu menu-unselected imp_plan clearfix">附件上传<div class="right pic hide"></div></li>
						<li class="menu menu-unselected check clearfix" id="opinion">审核意见</li>
						<li class="menu submit" id="sub" onclick="execute();">提交项目调整申请表</li>
					</ul>
				</div>
				</div>
				<div class="switch-bar">
					<div class="switch-bar-arrow" id="swich2"></div>
				
				</div>
			<div class="iframe">
					<iframe name="subframe" src="Implement/modify_apply.php" frameborder="0"></iframe>
				</div>
				
			</div>
			<!--menusNiframe-->
		</div>
		<!--body-->
	</div>
</body>
</html>
