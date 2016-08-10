<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link  rel="stylesheet" type="text/css"  href="../../../../common/html/plugin/easyui/themes/default/easyui.css" /> 
<link rel="stylesheet" type="text/css"  href="../../../../common/html/plugin/easyui/themes/icon.css" />
<link rel="stylesheet" type="text/css"  href="../css/accept_project_summary/accept_project_summary.css" />
<link href="../css/button.css" rel="stylesheet" type="text/css" />
<script src="../../../../common/html/lib/js/jquery-1.11.2.min.js"></script>
<script type="text/javascript"  src="../../../../common/html/plugin/jquery-hlui-2.0/js/hlui.js"></script>
<script type="text/javascript" src="../../../../common/html/plugin/jquery-hlui-2.0/js/form.js"></script>
<script type="text/javascript" src="../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>
<link href="../../../../common/html/plugin/jquery-hlui-2.0/css/layout.css" rel="stylesheet" type="text/css" />
<script src="../../../../common/html/js/piccommon.js"></script>
<script src="../../../../common/html/js/attachcommon.js"></script>
<script type="text/javascript" src="../js/accept_project_summary.js"></script>
 <script type="text/javascript" src="../../../../center/html/view/js/ukeycommon.js"></script>
<script type="text/javascript" src="../../../../center/html/view/js/NTClientJavascript.js"></script>
<style>
.menu{ 
 position: relative; 
 } 
</style>
 
</head>
<body>
    <!-- “验收阶段”的汇总页面 项目任务书 -->
	<div class="wrapper">
		<div class="body">
		<div class="func-bar">
	</div>
			<div class="menusNiframe">
			 <div class="menus-scroll-hidden">
				<div class="menus">
					<ul ><div class="menu-bar" ><div align="center">项目总结报告书</div></div>
						<li class="menu menu-unselected project_goal clearfix">任务目标<div class="right pic hide"></div></li>
						<li class="menu menu-unselected project_kpi clearfix">考核指标<div class="right pic hide"></div></li>
						<li class="menu menu-unselected content clearfix">主要研究内容<div class="right pic hide"></div></li>
						<li class="menu menu-unselected achievement clearfix">成果信息<div class="right pic hide"></div></li>
						<li class="menu menu-unselected ther_suggest clearfix">其他说明及存在问题<div class="right pic hide"></div></li>
						<li class="menu menu-unselected generalize_plan clearfix">成果及推广应用计划<div class="right pic hide"></div></li>
						<li class="menu menu-unselected project_org_suggest clearfix">单位意见<div class="right pic hide"></div></li>
						<li class="menu menu-unselected imp_plan clearfix">附件上传<div class="right pic hide"></div></li>
						<li class="menu menu-unselected check">审核意见</li>
						<li class="menu submit" id="sub" onclick="execute();">提交项目总结报告书</li>
					</ul>
				</div>
				</div>
				<div class="switch-bar">
					<div class="switch-bar-arrow" id="swich2"></div>
				</div>
				<div class="iframe">
					<iframe name="subframe" src="Acceptance/project_goal.php" frameborder="0"></iframe>
				</div>
			  
			</div>
			<!--menusNiframe-->
		</div>
		<!--body-->
	</div>
</body>
</html>
