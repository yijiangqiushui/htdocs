<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>

<link rel="stylesheet" type="text/css"
	href="../../../../../../common/html/plugin/easyui/themes/default/easyui.css" />
<link rel="stylesheet" type="text/css"
	href="../../../../../../common/html/plugin/easyui/themes/icon.css" />
<link rel="stylesheet" type="text/css" href="../../../css/table.css" />
<link rel="stylesheet" type="text/css" href="../../../css/button.css" />
<link rel="stylesheet"
	href="../../../../../../common/html/lib/css/datapicker/daterangepicker.css" />

<script src="../../../../../../common/html/lib/js/jquery-1.11.2.min.js"></script>
<script
	src="../../../../../../common/html/plugin/datapicker/moment.min.js"></script>

<script type="text/javascript"
	src="../../../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>
<script type="text/javascript"
	src="../../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript"
	src="../../../../../../common/html/plugin/easyui/jquery.cookie.js"></script>
<script type="text/javascript"
	src="../../../../../../common/html/plugin/jquery-hlui-2.0/js/hlui.js"></script>
<script type="text/javascript"
	src="../../../../../../common/html/plugin/jquery-hlui-2.0/js/form.js"></script>

<script
	src="../../../../../../common/html/plugin/datapicker/jquery.daterangepicker.js"></script>
<script src="../../../../../../common/html/js/tablecommon.js"></script>
<script type="text/javascript"
	src="../../../js/projectapp/genious_info.js"></script>

</head>

<body>
	<form id="org_info" method="post">
		<div class="project_content">
			<div class="table_title clearfix">
				<div class="title_pic left">专利验收报告书</div>
				<div class="right back_pic" id="back"></div>
			</div>

			<div class="table_content back-long">
				<table cellspacing="0" cellpadding="0" class="basic_info">
					<tr>
						<td colspan="6" class="border_left_none"
							style="background-color: #7AB5ED;">
							<div class="title_top p-b10">项目基本情况</div>
						</td>
					</tr>
					<tr>
						<th><p align="center">项目负责人</p></th>
						<td><input name="" /></td>
						<th><p align="center">职务</p></th>
						<td><input name="" /></td>
						<th><p align="center">职称</p></th>
						<td><input name="" /></td>
					</tr>
					<tr>
						<th><p align="center">项目名称</p></th>
						<td colspan="5"><input name="" /></td>

					</tr>
					<tr>
						<th rowspan="3"><p align="center">所含专利名称</p></th>
						<td><input name="" placeholder="1、" /></td>
						<th><p align="center">专利号</p></th>
						<td colspan="3"><input name="" /></td>

					</tr>
					<tr>
						
						<td><input name="" placeholder="2、" /></td>
						<th><p align="center">专利号</p></th>
						<td colspan="3"><input name="" /></td>

					</tr>
					<tr>
						
						<td><input name="" placeholder="3、" /></td>
						<th><p align="center">专利号</p></th>
						<td colspan="3"><input name="" /></td>

					</tr>
					<tr>
						<th><p align="center">产品执行标准</p></th>
						<td colspan="5"><input name="" /></td>

					</tr>
					<tr>
						<th><p align="center">产品鉴定日期</p></th>
						<td colspan="5"><input name="" /></td>

					</tr>
					<tr>
						<th><p align="center">主持鉴定单位</p></th>
						<td colspan="5"><input name="" /></td>

					</tr>
					<tr>
						<th rowspan="3"><p align="center">产品获奖情况</p></th>
						<th><p align="center">获奖名称</p></th>
						<th><p align="center">授奖部门</p></th>
						<th colspan="3"><p align="center">获奖等级</p></th>
					</tr>
					<tr>
						<td colspan="1"><input name="" /></td>
						<td colspan="1"><input name="" /></td>
						<td colspan="3"><input name="" /></td>

					</tr>
				</table>
				<input type="hidden" name="save_display" id="save_display" />
				<div class="button_wrapper clearfix d-n">
					<div class="save">保存</div>
					<!-- <div class="reset" >重置</div> -->
				</div>
			</div>

		</div>
	</form>


</body>
</html>
