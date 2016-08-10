<?php 
    include 'user_approve.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理员信息</title>
<link rel="stylesheet" type="text/css" href="../../../../../common/html/plugin/easyui/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="../../../../../common/html/plugin/easyui/themes/icon.css">
<script type="text/javascript" src="../../../../../common/html/lib/js/jquery-2.1.0.min.js"></script>
<script type="text/javascript" src="../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="../../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>
<script type="text/javascript" src="../../../../html/view/js/users.js"></script>
<script type="text/javascript" src="../../../../../center/html/view/js/common.js"></script>
<script type="text/javascript" src="../../../../../center/html/view/js/ukeycommon.js"></script>
<script type="text/javascript" src="../../../../../center/html/view/js/NTClientJavascript.js"></script>
</head>
<body class='easyui-layout'>

<!-- 对树结构添加右键事件-->   
<div id="mm" class="easyui-menu" style="width:120px;">
  <div onclick="newCat()" class="add_cat" data-options="iconCls:'icon-add'">添加分组</div>
  <div onclick="editCat()" class="edit_cat" data-options="iconCls:'icon-edit'">编辑分组</div>
  <div onclick="delCat()" class="remove_cat" data-options="iconCls:'icon-remove'">移除分组</div>
  <div onclick="get_isDel_cat()" class="reload_cat" data-options="iconCls:'icon-reload'">恢复分组</div>
</div>
<!--添加分组-->
<div id="new_catDlg" class="easyui-dialog" style="width:380px;padding:10px 20px"
            closed="true" buttons="#new_catDlg-buttons">
  <form id="new_catfm" method="post">
    <table cellspacing="5">
      <input id="pid" name="upperID" type="hidden" />
      <tr>
        <td width="80">所属分类：</td>
        <td><input name="pritree1" id="pritree1" style="width:180px;" /></td>
      </tr>
      <tr>
        <td>用户组：</td>
        <td><input name="catName" style="width:180px;" class="easyui-validatebox" data-options="required:true,missingMessage:'该项为必填项'" /></td>
      </tr>
      <tr>
        <td>专有名称：</td>
        <td><input name="exclusive_name" style="width:180px;" class="easyui-validatebox" data-options="required:false,missingMessage:'该项为必填项'" /></td>
      </tr>
    </table>
  </form>
</div>

<div id="new_catDlg-buttons" style="text-align:center;padding:5px"> 
	<a href="javascript:void(0)" class="easyui-linkbutton" iconcls="icon-ok" onclick="saveNewCat()">确定 </a> 
	<a href="javascript:void(0)" class="easyui-linkbutton" iconcls="icon-cancel" onclick="javascript:$('#new_catDlg').dialog('close')">取消</a> 
</div>


<!--修改分组-->
<div id="edit_catDlg" class="easyui-dialog" style="width:380px;padding:10px 20px"
            closed="true" buttons="#edit_catDlg-buttons">
  <form id="edit_catform" method="post">
    <table>
      <tr>
        <td width="80">所属分类：</td>
        <td><input name="pritree" id="pritree" style="width:180px;" /></td>
      </tr>
      <tr>
        <td>用户组：</td>
        <td><input name="catName" style="width:180px;" class="easyui-validatebox" data-options="required:true,missingMessage:'该项为必填项'" /></td>
      </tr>
      <tr>
        <td>专有名称：</td>
        <td><input name="exclusive_name" style="width:180px;" class="easyui-validatebox" data-options="required:false,missingMessage:'该项为必填项'" /></td>
      </tr>
    </table>
  </form>
</div>
<div id="edit_catDlg-buttons" style="text-align:center;padding:5px"> 
	<a href="javascript:void(0)" class="easyui-linkbutton" iconcls="icon-ok" onclick="saveEditCat()">确定 </a> 
  <a href="javascript:void(0)" class="easyui-linkbutton" iconcls="icon-cancel" onclick="javascript:$('#edit_catDlg').dialog('close')">取消</a> 
</div>

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
							<li>
								<span><a href="#" onclick="loadPage(3)">监察科</a></span>
							</li>
						</ul>
					</li>
		</ul>
</div>
<div id='center' data-options="region:'center',split:true" style="padding:0px;">
  <table id="admingrid" class="easyui-datagrid">
  </table>
  <div id="toolbar"> 
    <a href="javascript:void(0)" class="easyui-linkbutton" iconcls="icon-ok" plain="true" onclick="disableAdmin(0)">启用</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconcls="icon-no" plain="true" onclick="disableAdmin(1)">禁用</a> 
    <a href="javascript:void(0)" id="muti_back" class="easyui-linkbutton" iconcls="icon-ok" style="display:none" plain="true">批量恢复</a> 
  	<a href="javascript:void(0)" class="easyui-linkbutton" iconcls="icon-search" plain="true" id="back_loadPage" onclick="init()">返回用户信息</a> 
  </div>
</div>
  <!--查看项目列表-->
<div id="gpldlg" class="easyui-dialog" tarPid="" closed="true" style="width:1000px;height:500px ;padding:0px 20px" buttons="#dlg-buttons1">
  <div id="proGpldlg"></div>
</div>
<!--修改用户-->
<div id="edtdlg" class="easyui-dialog" tarUid="" style="width:1300px;height:700px ;padding:0px 20px" closed="true" buttons="#dlg-buttons1">
  <div id="edtdlgfm" method="post">
        	<div style="margin:20px 0 10px 0;"></div>
        	<div class="easyui-tabs" style="width:1250px;height:540px">
            <?php if(!Pri::instance()->is_special) include(dirname(__FILE__)."/view/check_pri.php"); ?>
			<?php if(Pri::instance()->is_super || (Pri::instance()->admin_tag && Pri::instance()->is_special)) include(dirname(__FILE__)."/view/supervise.php"); ?>
			<?php if(Pri::instance()->admin_tag && !Pri::instance()->is_special) include(dirname(__FILE__)."/view/other.php"); ?>
  </div>
</div>
<!--  <div id="dlg-buttons1" style="text-align:center;padding:5px"> <a href="javascript:void(0)" class="easyui-linkbutton" iconcls="icon-ok" onclick="updateAdmin()">确定 </a> <a href="javascript:void(0)" class="easyui-linkbutton" iconcls="icon-cancel" onclick="javascript:$('#edtdlg').dialog('close')">取消</a> </div>-->
<!--查询用户-->
<div id="quedlg" class="easyui-dialog" style="width:400px;height:220px;padding:10px 20px"
            closed="true" buttons="#dlg-buttons2">
  <div class="ftitle">管理员信息</div>
  <form id="quefm" method="post" novalidate="novalidate">
  </form>
</div>

<!--<div id="dlg-buttons2" style="text-align:center;padding:5px"> <a href="javascript:void(0)" class="easyui-linkbutton" iconcls="icon-ok" onclick="findAdmin()">确定 </a> <a href="javascript:void(0)" class="easyui-linkbutton" iconcls="icon-cancel" onclick="javascript:$('#quedlg').dialog('close')">取消</a> </div>-->
</body>
</html>


