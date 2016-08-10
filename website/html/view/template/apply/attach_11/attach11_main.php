<?php
include '../../../../../../common/php/config.ini.php';
include '../../../../../../common/php/lib/db.cls.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<title>实施方案</title>
<link  rel="stylesheet" type="text/css"  href="../../../../../../common/html/plugin/easyui/themes/default/easyui.css" />
<link rel="stylesheet" type="text/css"  href="../../../../../../common/html/plugin/easyui/themes/icon.css" />
<link   href="../../../css/apply/attach11/attach11_main.css" rel="stylesheet" type="text/css" />
<link href="../../../css/button.css" rel="stylesheet" type="text/css" />
<script src="../../../../../../common/html/lib/js/jquery-1.11.2.min.js"></script>
<script type="text/javascript"  src="../../../../../../common/html/plugin/jquery-hlui-2.0/js/hlui.js"></script>
<script type="text/javascript" src="../../../../../../common/html/plugin/jquery-hlui-2.0/js/form.js"></script>
<script type="text/javascript" src="../../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="../../../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>
<script src="../../../../../../common/html/js/piccommon.js"></script>
<script src="../../../../../../common/html/js/attachcommon.js"></script>
<script  src="../../../js/apply/attach_11/attach11_main.js"></script>
<script type="text/javascript" src="../../../../../../center/html/view/js/ukeycommon.js"></script>
<script type="text/javascript" src="../../../../../../center/html/view/js/NTClientJavascript.js"></script>
</head>

<body>
	<div class="wrapper">
	<div class="body">
	<div class="func-bar">
	</div>
		<div class="menusNiframe">
        	<div class="menus-scroll-hidden">
			<div class="menus">
				<ul>
                	<div class="menu-bar"><div>资金申请书</div></div>
                    <li class="menu menu-unselected org_info clearfix">通州区高新技术企业认定服务机构资助资金申请表<div class="right pic hide"></div></li>
                    <li class="menu menu-unselected check">审核意见</li>
                    <li class="menu menu-unselected submit" id="sub" onclick="execute();" >提交申请书</li>
				</ul>
			</div>
			</div>
			<div class="switch-bar"><div class="switch-bar-arrow"></div></div>
			<div class="iframe"><iframe name="subframe"src="org_info.php" frameborder="0"></iframe></div>
		</div><!--menusNiframe-->
	</div><!--body-->
</div><!--wrapper-->
	
	
</body>
</html>
