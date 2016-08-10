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
	href="../../../../../../../common/html/plugin/easyui/themes/default/easyui.css" />
<link rel="stylesheet" type="text/css"
	href="../../../../../../../common/html/plugin/easyui/themes/icon.css" />
<link rel="stylesheet" type="text/css" href="../../../../css/table.css" />
<link rel="stylesheet" type="text/css" href="../../../../css/button.css" />
<link rel="stylesheet"
	href="../../../../../../../common/html/lib/css/datapicker/daterangepicker.css" />

<script src="../../../../../../../common/html/lib/js/jquery-1.11.2.min.js"></script>
<script
	src="../../../../../../../common/html/plugin/datapicker/moment.min.js"></script>

<script type="text/javascript"
	src="../../../../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>
<script type="text/javascript"
	src="../../../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript"
	src="../../../../../../../common/html/plugin/easyui/jquery.cookie.js"></script>
<script type="text/javascript"
	src="../../../../../../../common/html/plugin/jquery-hlui-2.0/js/hlui.js"></script>
<script type="text/javascript"
	src="../../../../../../../common/html/plugin/jquery-hlui-2.0/js/form.js"></script>

<script
	src="../../../../../../../common/html/plugin/datapicker/jquery.daterangepicker.js"></script>
	<script type="text/javascript" src="../../../../../../../common/html/js/tablecommon.js"></script>
<script type="text/javascript" src="../../../../js/apply/patent_grant/pro_doing.js"></script>
<style type="">
table{line-height: 33px;}
input{text-align: center;}
</style>
</head>

<body>
	<form id="pro_doing" method="post">
		<div class="project_content">
			<div class="table_title clearfix">
				<div class="title_pic left">实施计划和阶段任务</div>
				<div class="right back_pic" id="back"></div>
			</div>

			<div class="table_content back-long">
				<table cellspacing="0" cellpadding="0" class="basic_info">
					<tr>
						<td colspan="6" class="border_left_none"
							style="background-color: #7AB5ED;">
							<div class="title_top p-b10">项目实施计划和阶段任务</div>
						</td>
					</tr>
					<tr>
						<th><p align="center"><input class="fix_width" type="text" name="year" readonly/>年度</p></th>

						<th><p align="center">分年度目标和实施内容（按季度填写计划进度与阶段目标）</p></th>
					</tr>
					<tr>
						<th><p align="center">一季度</p></th>
						<td><textarea rows="9" cols="10" name="sessionone" class="add_gap back_color1"></textarea></td>
					</tr>
					<tr>
						<th><p align="center">二季度</p></th>
						<td><textarea rows="9" cols="10" name="sessiontwo" class="add_gap back_color2"></textarea></td>
					</tr>
					<tr>
						<th><p align="center">三季度</p></th>
						<td><textarea rows="9" cols="10" name="sessionthree" class="add_gap back_color3"></textarea></td>
					</tr>
					<tr>
						<th><p align="center">四季度</p></th>
						<td><textarea rows="9" cols="10" name="sessionfour" class="add_gap back_color4"></textarea></td>
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
