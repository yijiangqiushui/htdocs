<?php
session_start ();
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
input {
	height: 100%;
	width: 99.5%;
	border: 0px;
}

textarea {
	height: 100%;
	width: 99.5%;
	border: 0px;
}

td {
	height: 35px;
}
</style>
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
	src="../../../js/apply/unit_improvement.js"></script>
<title>项目单位能力改善提高情况</title>

</head>
<body>
	<form id="unit_fm" method="post">
		<table width="600" height="862" border="1" cellspacing="0">
			<tr>
				<td colspan="5"><h2>九、项目单位能力改善提高情况 单位：台、套、平方、万元</h2></td>
			</tr>
			<tr>
				<td colspan="5">购置生产设备明细（单台套5万元及以上）</td>
			</tr>
			<tr>
				<td>设备、工装、模具名称</td>
				<td width="97">数量</td>
				<td width="88">单价</td>
				<td width="95">合计金额</td>
			</tr>
			<!--*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~我是华丽的分割线~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*-->
			<tr>
				<td colspan="8">
					<table width="570" border="1" cellspacing="0"
						style="margin-bottom: 0;" id="equipment_list">
		<?php
		// $org_code = $_SESSION['org_code'];
		$org_code = '01234567';
		$sql = "Select * from equipment_list where project_id = '$project_id' ";
		$conn = mysql_connect ( "david", "FRED", "123456" );
		mysql_select_db ( "project", $conn );
		$result = mysql_query ( $sql, $conn );
		$tableRow = mysql_num_rows ( $result );
		
		if ($tableRow) {
			for($i = 0; $i < $tableRow; $i ++) {
				$row = mysql_fetch_object ( $result );
				echo "<tr>";
				echo "<td><input type='text' name='equipment_name[$i]' value='$row->equipment_name'/></td>";
				echo "<td><input type='text' name='equipment_num[$i]' value='$row->equipment_num'/></td>";
				echo "<td><input type='text' name='equipment_price[$i]' value='$row->equipment_price'/></td>";
				echo "<td><input type='text' name='equipment_fund[$i]' value='$row->equipment_fund'/></td>";
				echo "<td><input type='button' value='删除' onclick='delLine(this)'/></td>";
				echo "</tr>";
			}
		} else {
			echo "<tr>";
			echo "<td width='110'><input type='text' name='equipment_name[0]'/></td>";
			echo "<td width='65'> <input type='text' name='equipment_num[0]'/></td>";
			echo "<td width='60'> <input type='text' name='equipment_price[0]'/></td>";
			echo "<td width='70'> <input type='text' name='equipment_fund[0]'/></td>";
			echo "<td width='65' ><input type='button' value='删除' onclick='delLine(this)'/></td>";
			echo "</tr>";
		}
		
		?>
		    	</table>
				</td>
				<!-- 没有字段-->
			</tr>
			<tr>
				<td colspan="9" height="25"><input type="button" value="添加"
					onclick="addLine_equ()" /></td>
				<!-- 没有字段-->
			</tr>

			<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~我是华丽的分割线~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

			<tr>
				<td colspan="5">购置检测仪器明细（单台5万元及以上）</td>
			</tr>
			<tr>

				<td>检测仪器名称</td>
				<td>数量</td>
				<td>单价</td>
				<td>合计金额</td>
			</tr>

			<!--*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~我是华丽的分割线~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*-->
			<tr>
				<td colspan="8">
					<table width="570" border="1" cellspacing="0"
						style="margin-bottom: 0;" id="test_list">
		    		
		    		<?php
								// $project_id = $_SESSION['project_id'];
								
								$project_id = '012';
								
								$conn = mysql_connect ( "david", "FRED", "123456" );
								
								mysql_select_db ( "project", $conn );
								
								$sql = "select * from instrument_list where project_id = '$project_id' ";
								
								$result = mysql_query ( $sql );
								
								$tableRow = mysql_num_rows ( $result );
								
								if ($tableRow) {
									for($i = 0; $i < $tableRow; $i ++) {
										$row = mysql_fetch_object ( $result );
										echo "<tr>";
										echo "<td><input type='text' name='test_name[$i]' value='$row->test_name'/></td>";
										echo "<td><input type='text' name='test_num[$i]' value='$row->test_num'/></td>";
										echo "<td><input type='text' name='test_price[$i]' value='$row->test_price'/></td>";
										echo "<td><input type='text' name='test_fund[$i]' value='$row->test_fund'/></td>";
										echo "<td><input type='button' value='删除' onclick='delLine(this)'/></td>";
										echo "</tr>";
									}
								} else {
									echo "<tr>";
									echo "<td width='110'> <input type='text' name='test_name[0]'/></td>";
									echo "<td width='65'> <input type='text'  name='test_num[0]'/></td>";
									echo "<td width='60'> <input type='text'  name='test_price[0]'/></td>";
									echo "<td width='70'> <input type='text'  name='test_fund[0]'/></td>";
									echo "<td width='65' ><input type='button' value='删除' onclick='delLine(this)'/></td>";
									echo "</tr>";
								}
								
								?>
		    	</table>
				</td>
				<!-- 没有字段-->
			</tr>
			<tr>
				<td colspan="9" height="25"><input type="button" value="添加"
					onclick="addLine_test()" /></td>
				<!-- 没有字段-->
			</tr>

			<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~我是华丽的分割线~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

			<tr>
				<td colspan="5">厂房、场地改善情况</td>
			</tr>
			<tr>
				<td>新建厂房面积</td>
				<td><input class="easyui-validatebox" required="true" type="text"
					name="factory_area" /></td>
				<td colspan="2">合计金额</td>
				<td><input class="easyui-validatebox" required="true" type="text"
					name="factory_sum" /></td>
			</tr>
			<tr>
				<td>改扩建厂房面积</td>
				<td><input class="easyui-validatebox" required="true" type="text"
					name="rebuild_area" /></td>
				<td colspan="2">合计金额</td>
				<td><input class="easyui-validatebox" required="true" type="text"
					name="rebuild_sum" /></td>
			</tr>

		</table>

		<a href="#" class="easyui-linkbutton" iconcls="icon-ok"
			onclick="submitdata()">确定</a> <a href="#" class="easyui-linkbutton"
			iconcls="icon-no" onclick="reset()">重置</a>
	</form>
</body>
</html>