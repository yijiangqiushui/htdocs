<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>

<link rel="stylesheet" type="text/css"
	href="../../../../../../common/html/plugin/easyui/themes/default/easyui.css" />
<link rel="stylesheet" type="text/css"
	href="../../../../../../common/html/plugin/easyui/themes/icon.css" />
<script type="text/javascript"
	src="../../../../../../center/html/view/js/jquery-1.11.2.min.js"></script>
<script type="text/javascript"
	src="../../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript"
	src="../../../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>

<script type="text/javascript"
	src="../../../js/apply/iprproject1_2/material_list.js"></script>
<link rel="stylesheet" type="text/css"
	href="../../../../../../website/html/view/css/tablestyle.css" />
<style type="text/css">
input {
	width: 99.5%;
	border: 1px;
}

td {
	height: 35px;
	text-align: left;
}

body {
	font-family: "微软雅黑";
	margin: auto 0;
	font-size: 16px;
}

div {
	text-align: center;
	margin: auto 0;
	line-height: 100%;
}

table {
	margin: 0 auto;
	border: 1px solid black;
	font-size: 14px;
	width: 50%;
}

table table {
	width: 100%;
}
</style>
</head>

<body>
	<div class="easyui-panel" style="border: 0;">
		<form method="post" id="material_list">
			<table width="500" border="1" cellspacing="0">
				<tr>
					<td colspan="3"><h2>五、单位提供相关材料清单</h2></td>
				</tr>
				<tr>
					<td width="20">序号</td>
					<td width="150">材料名称</td>
					<td width="20">操作</td>
				</tr>
				<tr>
					<td colspan="3">
						<table width="100%" border="1" cellspacing="0"
							style="margin-bottom: 0;" id="addtable">
		    		
		<?php
		// $org_code = $_SESSION['org_code'];
		$org_code = '01234567';
		// $$project_id = $_SESSION['$project_id'];
		$project_id = '121212';
		$sql = "Select * from material_list where project_id=$project_id";
		$conn = mysql_connect ( "david", "FRED", "123456" );
		mysql_select_db ( "project", $conn );
		$result = mysql_query ( $sql, $conn );
		$tableRow = mysql_num_rows ( $result );
		
		if ($tableRow) {
			$count = 0;
			for($i = 0; $i < $tableRow; $i ++) {
				$count = $i + 1;
				$row = mysql_fetch_object ( $result );
				echo "<tr>";
				echo "<td width='20' ><input type='text'  value='$count'/></td>";
				echo "<td width='150'><input type='text' name='name[$i]' value='$row->name'/></td>";
				echo "<td width='20' ><input type='button' value='删除' onclick='delLine(this)'/></td>";
				echo "</tr>";
			}
		} else {
			echo "<tr>";
			echo "<td width='110'><input type='text' value='1'/></td>";
			echo "<td width='267'><input type='text'name='name[0]'/></td>";
			echo "<td width='40' ><input type='button' value='删除' onclick='delLine(this)'/></td>";
			echo "</tr>";
		}
		?>
		    	</table>
					</td>
				</tr>
				<tr>
					<td colspan="9" height="25"><input type="button" value="添加"
						onclick="addLine()" /></td>
					<!-- 没有字段-->
				</tr>
			</table>
			<a href="javascript:void(0);" class="easyui-linkbutton"
				iconcls="icon-ok" onclick="submitdata()">确定</a> <a
				href="javascript:void(0);" class="easyui-linkbutton"
				iconcls="icon-no" onclick="reset()">重置</a>
		</form>
	</div>

</body>
</html>
