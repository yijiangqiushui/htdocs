
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>实施方案</title>
<link  rel="stylesheet" type="text/css"  href="../../../../../../../common/html/plugin/easyui/themes/default/easyui.css" />
<link href="../../../../css/apply/project_summary/project_summary.css" rel="stylesheet" type="text/css" />
<link href="../../../../css/button.css" rel="stylesheet" type="text/css" />
<script src="../../../../../../../common/html/lib/js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="../../../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="../../../../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>
<script src="../../../../js/apply/app_comon.js"></script>
<script src="../../../../../../../common/html/js/piccommon.js"></script>
<script src="../../../../../../../common/html/js/attachcommon.js"></script>
<script src="../../../../js/apply/patent_implement/project_summary.js"></script>
<script type="text/javascript" src="../../../../../../../center/html/view/js/ukeycommon.js"></script>
<script type="text/javascript" src="../../../../../../../center/html/view/js/NTClientJavascript.js"></script>
<style>

.menu{
	position:relative;
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
                	<div class="menu-bar"><div>专利实施经费总决算表</div></div>
					<li class="menu menu-unselected project_fund clearfix">专利实施项目经费总决算表<div class="right pic hide"></div></li>
                    <li class="menu menu-unselected check clearfix">审核意见</li>	
                    <li class="menu menu-selected submit" id="sub" onclick="execute()">提交专利经费总决算表</li>
				</ul>
			</div>
			</div>
			<div class="switch-bar" id="swich2"><div class="switch-bar-arrow"></div></div>
			<div class="iframe"><iframe name="subframe" src="project_fund.php" frameborder="0" id="iframe2"></iframe></div>
		  
		</div><!--menusNiframe-->
	</div><!--body-->
</div><!--wrapper-->
</body>
</html>

