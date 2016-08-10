<?php 
session_start();
    $project_id = $_GET['project_id'];
    if($project_id != null){
        $_SESSION['project_id'] = $project_id;
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>无标题文档</title>
<link rel="stylesheet" type="text/css" href="../../../../common/html/plugin/easyui/themes/default/easyui.css" />
<link rel="stylesheet" type="text/css" href="../../../../common/html/plugin/easyui/themes/icon.css" />
<script type="text/javascript" src="../../../../common/html/plugin/easyui/jquery.min.js"></script>
<script type="text/javascript" src="../../../../common/html/plugin/easyui/jquery.cookie.js"></script>
<script type="text/javascript" src="../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="../../../../common/html/plugin/jquery-hlui-2.0/js/hlui.js"></script>
<script type="text/javascript" src="../../../../common/html/plugin/jquery-hlui-2.0/js/form.js"></script>
<script type="text/javascript" src="../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>
<script type="text/javascript" src="../../../html/view/js/approve.js"></script>
<script type="text/javascript" src="../../../../center/html/view/js/ukeycommon.js"></script>
<script type="text/javascript" src="../../../../center/html/view/js/NTClientJavascript.js"></script>
</head>
<body>
	<div data-options="region:'center',title:'信息',iconCls:'icon-ok',split:true">
	    <table id="approve"></table>
		<div id="toolbar" class="datagrid-toolbar">
				<!-- <a href="/center/php/action/page/project_list/check_list.html?min=1&max=4&" class="easyui-linkbutton" iconcls="icon-back" plain="true" >返回</a> -->
		     <a id="s_back" href="" class="easyui-linkbutton" iconcls="icon-back" plain="true" style="float:right;">返回</a>
	    </div>
	</div>
</body>
</html>
