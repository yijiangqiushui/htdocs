<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>权限</title>
<link rel="stylesheet" type="text/css" href="../../../../../common/html/plugin/easyui/themes/default/easyui.css" />
<link rel="stylesheet" type="text/css" href="../../../../../common/html/plugin/easyui/themes/icon.css" />
<script type="text/javascript" src="../../../../../common/html/lib/js/jquery-2.1.0.min.js"></script>
<script type="text/javascript" src="../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="../../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>
<script type="text/javascript" src="../../../../html/view/js/user_role.js"></script>
<style>
</style>
</head>
<body class="easyui-layout">
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
								<span><a href="#" onclick="loadPage(1)">科技综合科</a></span>
							</li>
							<li>
								<span><a href="#" onclick="loadPage(2)">知识产权科</a></span>
							</li>
						</ul>
					</li>
		</ul>
	</div>
	<div id='center' data-options="region:'center',split:true" >
		<table id="userrole" class="easyui-datagrid" style="height: auto">
		</table>
		<br> <a href='../project_list/main.php' target="main_center" style='text-decoration: none; float: left; margin: 0 0 0 500px'>
		<!-- <input type='button' value='确认并返回' style="width: 150px; height: 35px; font-family: 黑体; font-size: 1em;" /></a> -->
    </div>  
		<div id="dlg" class="easyui-dialog"
			style="width: 300px; height: 200px; padding: 10px 20px" closed="true"
			buttons="#dlg-buttons">
			<form id="fm" method="post" novalidate>
			开启时间：<input id='start'  class="easyui-datebox"  required="true" /><br/><br/>
			截止时间：<input id='end'  class="easyui-datebox"/>
			</form>
		</div>
    <div id="dlg-buttons">
		<a href="#" class="easyui-linkbutton" iconCls="icon-ok"
			onclick="setdate()">确认</a> <a href="#" class="easyui-linkbutton"
			iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')">取消</a>
	</div>
</body>
</html>
