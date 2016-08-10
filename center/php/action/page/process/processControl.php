<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>权限</title>
<link rel="stylesheet" type="text/css" href="../../../../../common/html/plugin/easyui/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="../../../../../common/html/plugin/easyui/themes/icon.css">
<script type="text/javascript" src="../../../../../common/html/lib/js/jquery-2.1.0.min.js"></script>
<script type="text/javascript" src="../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="../../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>

<script type="text/javascript" src="../../../../html/view/js/new_process_Control.js"></script>
<script type="text/javascript" src="../../../../../center/html/view/js/common.js"></script>
</head>
<body class='easyui-layout'>
<!-- 对树结构添加右键事件-->   
<!--表结构-->
<div id="west" data-options="region:'west',title:'部门分类',sqlit:'true'" style="width:200px;padding:5px;" >
			<ul class="easyui-tree">
			<li>
				<span>部门分类</span>
						<span>部门分类</span>
						<ul>
							<li>
								<span><a href="#" onclick="loadPage(0)">发展计划科</a></span>
							</li>
							<li>
								<span><a href="#" onclick="loadPage(2)">科技综合科</a></span>
							</li>
							<li>
								<span><a href="#" onclick="loadPage(1)">知识产权科</a></span>
							</li>
						</ul>
					</li>
			</ul>
	</div>
	<div id='center' data-options="region:'center',split:true" style="padding:5px;">
	<form class="easyui-panel" id="project_process" method="post" action="">
	  <table id="processControl">
	  </table>
	  <button type="button" onclick="processCon();" style="width:100px;margin-top:10px;margin-left:85%;" >提交</button>
	  </form>
	</div>  
</body>
</html>
