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
	src="../../../js/apply/iprproject1_2/project_member.js"></script>
<style type="text/css">
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
	border-collapse: collapse;
	font-size: 14px;
	width: 50%;
}

td {
	text-align: left;
}
</style>

</head>

<body>
	<div class="easyui-panel" style="border: 0;">
		<form method="post" id="project_member">
			<table width="500" height="291" border="1" cellspacing="0">
				<tr>
					<td colspan="8"><h2>四、项目主要参加人员登记表</h2></td>
				</tr>

				<tr>
					<td colspan="8">
						<table width="570" border="1" cellspacing="0"
							style="margin-bottom: 0;" id="addtable">
							<tr>
								<td width="45">姓名</td>
								<td width="45">性别</td>
								<td width="45">年龄</td>
								<td width="81">职称（职务）</td>
								<td width="85">专业</td>
								<td width="122">单位</td>
								<td width="147">在本项目中分担的任务</td>
								<td width="40">操作</td>
							</tr>
		<?php
		// $org_code = $_SESSION['org_code'];
		$org_code = '01234567';
		// $project_id = $_SESSION['project_id'];
		$project_id = "121212";
		
		$sql = "Select * from project_member where project_id=$project_id";
		$conn = mysql_connect ( "david", "FRED", "123456" );
		mysql_select_db ( "project", $conn );
		$result = mysql_query ( $sql, $conn );
		$tableRow = mysql_num_rows ( $result );
		
		if ($tableRow) {
			for($i = 0; $i < $tableRow; $i ++) {
				$row = mysql_fetch_object ( $result );
				echo "<tr>";
				echo "<td><input type='text' name='name[$i]' value='$row->name'/></td>";
				echo "<td><input type='text' name='sex[$i]' value='$row->sex'/></td>";
				echo "<td><input type='text' name='age[$i]' value='$row->age'/></td>";
				echo "<td><input type='text' name='job[$i]' value='$row->job'/></td>";
				echo "<td><input type='text' name='major[$i]' value='$row->major'/></td>";
				echo "<td><input type='text' name='org[$i]' value='$row->org'/></td>";
				echo "<td><input type='text' name='mission[$i]' value='$row->mission'/></td>";
				echo "<td><input type='button' value='删除' onclick='delLine(this)'/></td>";
				echo "</tr>";
			}
		} else {
			echo "<tr>";
			echo "<td width='110'><input type='text' name='name[0]'/></td>";
			echo "<td width='267'><input type='text'name='sex[0]'/></td>";
			echo "<td width='267'><input type='text'name='age[0]'/></td>";
			echo "<td width='267'><input type='text'name='job[0]'/></td>";
			echo "<td width='267'><input type='text'name='major[0]'/></td>";
			echo "<td width='267'><input type='text'name='org[0]'/></td>";
			echo "<td width='267'><input type='text'name='mission[0]'/></td>";
			echo "<td width='100' ><input type='button' value='删除' onclick='delLine(this)'/></td>";
			echo "</tr>";
		}
		?>
        
		    	</table>
					</td>
					<!-- 没有字段-->
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
