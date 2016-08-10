<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>自定义项目类型</title>
<link rel="stylesheet" type="text/css" href="../../../../../common/html/plugin/easyui/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="../../../../../common/html/plugin/easyui/themes/icon.css">
<!--
<script type="text/javascript" src="../../../../../common/html/plugin/easyui/jquery.min.js"></script>
<script type="text/javascript" src="../../js/admin/admin.config.js"></script>
-->
<script type="text/javascript" src="../../../../../common/html/lib/js/jquery-2.1.0.min.js"></script>
<script type="text/javascript" src="../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="../../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>

<script type="text/javascript" src="../../../../html/view/js/subtable.js"></script>
<script type="text/javascript" src="../../../../../center/html/view/js/common.js"></script>
<!-- <script type="text/javascript" src="../../../../../center/html/view/js/NTClientJavascript.js"></script> -->

<!-- <link rel="stylesheet" type="text/css" href="../../css/admininfo.css"/> -->
</head>
<body class='easyui-layout'>
	<div id="mm" class="easyui-menu" style="width:120px;">
	  <div onclick="newCat()" class="add_cat" data-options="iconCls:'icon-add'">添加分组</div>
	  <div onclick="editCat()" class="edit_cat" data-options="iconCls:'icon-edit'">编辑分组</div>
	  <div onclick="delCat()" class="remove_cat" data-options="iconCls:'icon-remove'">移除分组</div>
	  <div onclick="get_isDel_cat()" class="reload_cat" data-options="iconCls:'icon-reload'">恢复分组</div>
	</div>
	<!--表结构-->
	<div id="west" data-options="region:'west',title:'可编辑文件',sqlit:'true'" style="width:200px;padding:5px;" >
		<ul id="stwest" >
		</ul>
	</div>
	<div id='center' data-options="region:'center',split:true">
		<div id="stdefine" class="easyui-panel" title="表格自定义" style="width:500px;height:150px;padding:10px;background:#fafafa;" data-options="collapsible:true,fit:true">
		  <!-- <div id="toolbar"> 
    		<a href="javascript:void(0)" class="easyui-linkbutton" iconcls="icon-search" plain="true" onclick="queryAdmin()">查询</a> 
    	  </div> -->
		  <iframe id="stframe" style="width:100%;height:100%;border:0px"></iframe>
		</div>
		
	</div>  
</body>
</html>