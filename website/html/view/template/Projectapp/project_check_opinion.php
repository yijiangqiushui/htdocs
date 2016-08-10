<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="../../css/style.css" />
<title>无标题文档</title>
<link rel="stylesheet" type="text/css"
	href="../../../../../common/html/plugin/easyui/themes/default/easyui.css" />
<link rel="stylesheet" type="text/css"
	href="../../../../../common/html/plugin/easyui/themes/icon.css" />
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
<script type="text/javascript" src="../../../../../common/html/js/tablecommon.js"></script>
<script type="text/javascript"
	src="../../js/projectapp/project_check_opinion.js"></script>
<link rel="stylesheet" type="text/css" href="../../css/table.css" />
<link rel="stylesheet" type="text/css" href="../../css/button.css" />
<style>
p {
	font-size: 16px;
}
</style>
</head>

<body>
	<div class="easyui-panel" style="border: 0;" title="审核意见"
		collapsible="false">
		<form id="project_check_opinion" method="post" action="#">
			<table border="1" cellspacing="0" cellpadding="0" width="560"
				class="table">
				<tr>
					<td width="560" valign="top"><p style="vertical-align: middle;"
							align="center">
							<strong>十三、审核意见    </strong>
						</p></td>
				</tr>
				<tr>
					<td width="560" valign="top"><p>
							<strong>区科委主管科室意见： </strong><br />
						</p> <textarea class="easyui-validatebox" required="true"
							id="office_opinion" name="office_opinion" class="td1"></textarea>
						<p>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;科长：（签字）
							<br /> <br />
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;年   
							月    日
						</p></td>
				</tr>
				<tr>
					<td width="560" valign="top"><p>
							<strong>区科委主管主任意见： </strong><br />
						</p> <textarea class="easyui-validatebox" required="true"
							id="head_opinion" name="head_opinion" class="td1"></textarea>
						<p>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;主管主任：（签字）
							<br /> <br />
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;年   
							月    日<strong> </strong>
						</p></td>
				</tr>
				<tr>
					<td width="560" valign="top"><p>
							<strong>区科委主任意见： </strong><br />
						</p> <textarea class="easyui-validatebox" required="true"
							id="director_opinion" name="director_opinion" class="td1"></textarea>

						<p>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;主任：（签字）
							<br />
							<br />
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;（公章）
							<br />
							<br />
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							年    月    日
						</p></td>
				</tr>
			</table>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php
$table_status = $_GET ['status'];
$user_type = $_SESSION ['user_type'];
if ($user_type > 0) {
	if ($table_status == 1) {
		echo "<input type='button' value='保  存' onclick='saveCheckOpin();' class='save'/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp";
        echo "<input type='reset' value='重   置' class='save'/>";
        }
	}
    
?>
</form>
	</div>
</body>
</html>
