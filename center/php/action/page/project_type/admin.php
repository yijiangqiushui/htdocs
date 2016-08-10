<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>项目类型管理</title>
<link rel="stylesheet" type="text/css" href="../../../../../common/html/plugin/easyui/themes/default/easyui.css"/>
<link rel="stylesheet" type="text/css" href="../../../../../common/html/plugin/easyui/themes/icon.css"/>
<script type="text/javascript" src="../../../../../common/html/lib/js/jquery-2.1.0.min.js"></script>
<script type="text/javascript" src="../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="../../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>
<script type="text/javascript" src="../../../../html/view/js/project_type.js"></script>
<script type="text/javascript" src="../../../../../center/html/view/js/common.js"></script>
<script type="text/javascript" src="../../../../../center/html/view/js/ukeycommon.js"></script>
<script type="text/javascript" src="../../../../../center/html/view/js/NTClientJavascript.js"></script>
</head>
<body class='easyui-layout'>
	<div id="mm" class="easyui-menu" style="width:120px;">
	  <div onclick="newCat()" class="add_cat" data-options="iconCls:'icon-add'">添加分组</div>
	  <div onclick="editCat()" class="edit_cat" data-options="iconCls:'icon-edit'">编辑分组</div>
	  <div onclick="delCat()" class="remove_cat" data-options="iconCls:'icon-remove'">移除分组</div>
	  <div onclick="get_isDel_cat()" class="reload_cat" data-options="iconCls:'icon-reload'">恢复分组</div>
	</div>
	<!--表结构-->
	<div id="west" data-options="region:'west',title:'部门分类',sqlit:'true'" style="width:200px;padding:5px;" >
		<div style="margin:20px 0;"></div>
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
	<div id='center' data-options="region:'center',split:true" style="padding:0px;">
	  <table id="admingrid" value="">
	  </table>
	  <div id="toolbar">  
		<a href="/center/php/action/page/project_type/control.php" class="easyui-linkbutton" iconcls="icon-add" plain="true" >添加</a> 
		<a href="javascript:void(0)" class="easyui-linkbutton" iconcls="icon-remove" plain="true" onclick="delArrAdmin()">批量删除</a> 
		<a href="javascript:void(0)" class="easyui-linkbutton" iconcls="icon-reload" plain="true" onclick="renew()">恢复删除项目</a>
		  <?php if($xjadmin){ ?>
		  <a href="javascript:void(0)" class="easyui-linkbutton" iconcls="icon-ok" plain="true" onclick="setPub()">发布</a>
		  <a href="javascript:void(0)" class="easyui-linkbutton" iconcls="icon-ok" plain="true" onclick="priSet()">项目权限设置</a>
		  <a href="javascript:void(0)" class="easyui-linkbutton" iconcls="icon-ok" plain="true" onclick="priCheckSet()">审批权限设置</a>
		<?php }else{ ?>
		  <!--  <a href="javascript:void(0)" class="easyui-linkbutton" iconcls="icon-ok" plain="true" onclick="priTransfer()">审批权限转让</a> -->
		  <?php  } ?>
		<!-- <a href="javascript:void(0)" id="muti_back" class="easyui-linkbutton" iconcls="icon-ok" style="display:none" plain="true">批量恢复</a> -->
	  </div>
	  
	<div id="dlg" class="easyui-dialog" style="width: 300px; height: 220px; padding: 10px 20px" closed="true" buttons="#dlg-buttons">
		<form id="fm" method="post" novalidate>
		开启时间：<input id='start'  class="easyui-datebox"  required="true" /><br/><br/>
		截止时间：<input id='end'  class="easyui-datebox"/><br/><br/>
                 受理人：&nbsp;&nbsp;&nbsp;&nbsp;<input id='acceptor'  class="easyui-combobox"/>
		</form>
	</div>
	
	<div id="dlg-renew" class="easyui-dialog" closed="true" style="width:1000px;height:470px;">
	   <table id=delprojectgrid class= "easyui-datagrid" value=""></table>
	</div>
	
    <div id="dlg-buttons" style='text-align: center;'>
		<a href="#" class="easyui-linkbutton" iconCls="icon-ok"onclick="setdate()">确认</a> 
		<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')">取消</a>
	</div>
	</div>
	
	<div id="proPriDlg" title="项目权限设置" data-options="iconCls:'icon-save'" 
	style="width:600px;height:400px;padding:10px">
	  <div id="proPri"></div>
    </div>

	<div id="checkPriDlg" title="审批权限转让" data-options="iconCls:'icon-save'" style="width:600px;height:400px;padding:10px">
		<div id="checkPri"></div>
        <div id="checkPri-linkbutton" style="text-align:center; display:none; margin-top:5px;">
		<a href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="checkPartForDialog()">确认</a> 
        <a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#checkPriDlg').dialog('close')">取消</a>
        </div>
	</div>
	
	<div id="ccdlg" title="查重设置" data-options="iconCls:'icon-save'" style="width:600px;height:400px;padding:10px">
	  <table id="tg" style="width:750px;"></table>
    </div>
    
    <div id="setCheck" class="easyui-dialog" title="审批设置" data-options="iconCls:'icon-save',resizable:true,modal:true" closed="true" style="width: 900px; height: 300px;">
			<table id='editSetCheck' style="width:885px; height:260px;"></table>
	</div>
</body>
</html>