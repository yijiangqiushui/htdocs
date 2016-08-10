<?php
session_start ();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>企业信息完善</title>
<style type="text/css">
.input {
	width: 400px;
	height: 50px;
}

.input1 {
	height: 44px;
}
</style>
<link rel="stylesheet" type="text/css"
	href="../../../../../common/html/plugin/easyui/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css"
		href="../../../../../common/html/plugin/easyui/themes/icon.css">
		<script type="text/javascript"
			src="../../../../../common/html/plugin/easyui/jquery.min.js"></script>
		<script type="text/javascript"
			src="../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
		<script type="text/javascript"
			src="../../../../../common/html/plugin/jquery-hlui-2.0/js/hlui.js"></script>
		<script type="text/javascript"
			src="../../../../../common/html/plugin/jquery-hlui-2.0/js/form.js"></script>
		<script type="text/javascript"
			src="../../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>
		<script type="text/javascript" src="../../js/main/complete_info.js"></script>
		<link rel="stylesheet" type="text/css" href="../../css/table.css">
			<link rel="stylesheet" type="text/css" href="../../css/button.css">

</head>

<body>
	<div class="easyui-panel" style="border: 0;" title="企业信息完善"
		collapsible="false">
		<form method="post" action="" id="complete_info">
			<table border="1" cellspacing="0" cellpadding="0" width="945"
				class="table">
				<tr>
					<td width="37"><p align="center">单位类型</p></td>
					<td colspan="3" valign="top"><label><input name="org_type"
							type="radio" value="0" />事业单位</label> <label><input
							name="org_type" type="radio" value="1" />国有独资企业</label> <label><input
							name="org_type" type="radio" value="2" />国有资本控股的有限公司</label> <label><input
							name="org_type" type="radio" value="3" />民营资本为主的有限公司</label></td>
					<td width="83" valign="top"><p align="center">单位地址</p></td>
					<td width="400" colspan="3" valign="top"><input name="org_address"
						class="input" /></td>
				</tr>
				<tr>
					<td width="37"><p align="center">注册地所属乡镇</p></td>
					<td colspan="3" valign="top"><input name="register_town"
						class="input" /></td>
					<td width="83" valign="top"><p align="center">注册时间</p></td>
					<td colspan="3" valign="top"><input name="register_time"
						class="input" /></td>
				</tr>
				<tr>
					<td width="37"><p align="center">邮政编码</p></td>
					<td colspan="3" valign="top"><input name="postal" class="input" /></td>
					<td width="83" valign="top"><p align="center">单位传真</p></td>
					<td colspan="3" valign="top"><input name="fax" class="input" /></td>
				</tr>
			</table>
			<input type='button' value='保  存' onclick='completeInfo();'
				class='save' />&nbsp;&nbsp;&nbsp;&nbsp; <input type='reset'
				value='重   置' class='save' />;
		</form>
	</div>
</body>
</html>
