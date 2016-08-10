<?php
session_start();
include '../../../../../../../common/php/config.ini.php';
include '../../../../../../../common/php/lib/db.cls.php';
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
	src="../../../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript"
	src="../../../../../../../common/html/plugin/easyui/jquery.cookie.js"></script>
<script type="text/javascript"
	src="../../../../../../../common/html/plugin/jquery-hlui-2.0/js/hlui.js"></script>
<script type="text/javascript"
	src="../../../../../../../common/html/plugin/jquery-hlui-2.0/js/form.js"></script>

<script
	src="../../../../../../../common/html/plugin/datapicker/jquery.daterangepicker.js"></script>
<script type="text/javascript" src="../../../../../../../common/html/js/validation.js"></script>
<script type="text/javascript"
	src="../../../../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>
<script type="text/javascript" src="../../../../../../../common/html/js/tablecommon.js"></script>
	<script type="text/javascript"
	src="../../../../js/check_material/improve.js"></script>

	

</head>

<body>
	<form id="improve" method="post">
		<div class="project_content">
			<div class="table_title clearfix">
				<div class="title_pic left">专利实施验收报告书</div>
				<div class="right back_pic" id="back"></div>
			</div>

			<div class="table_content back-long">
				<table cellspacing="0" cellpadding="0" class="basic_info">
					<tr>
						<td colspan="6" class="border_left_none"
							style="background-color: #7AB5ED;">
							<div class="title_top p-b10">项目单位能力改善提高情况</div>
						</td>
					</tr>
					<tr>
						<th colspan="5"><p align="center">购置生产设备明细（单台套5万元及以上）</p></th>
					</tr>
					<tr>
					<td colspan="5">
					<table id="equipment_list">
					<tr>
						<th rowspan="1"><p align="center">序号</p></th>
						<th rowspan="1"><p align="center">设备、工装、模具名称</p></th>
						<th rowspan="1"><p align="center">数量</p></th>
						<th rowspan="1"><p align="center">单价</p></th>
						<th rowspan="1"><p align="center">合计金额</p></th>
						<th rowspan="1"><p align="center">操作</p></th>
					</tr>
					<?php
		$project_id = $_SESSION['project_id'];
		$sql = "Select * from equipment_list where project_id='$project_id'";
		//
// 		echo $sql;
		$db = new DB ();
		$result = $db->SelectOri ( $sql );
		$tableRow = mysql_num_rows ( $result );
		if ($tableRow) {
			for($i = 0; $i < $tableRow; $i ++) {
				$row = mysql_fetch_object ( $result );
				$count=$i+1;
				echo "<tr>";
				echo "<th ><p align='center'>$count</p></th>";
				echo "<td><input type='text' name='equipment_name[$i]'     value='$row->equipment_name'/></td>";
				echo "<td><input type='text' name='equipment_num[$i]'    datatype='number' placeholder='请输入整数' value='$row->equipment_num'/></td>";
				echo "<td><input type='text' name='equipment_price[$i]'   datatype='float' placeholder='请输入整数或小数'    value='$row->equipment_price'/></td>";
				echo "<td><input type='text' name='equipment_fund[$i]'   readonly placeholder='无需填写,自动计算,数量*单价'  value='$row->equipment_fund'/></td>";
				echo "<td><input type='button' value='删除' class='pointer'  onclick='deleteRow(this)'/></td>";
				echo "</tr>";
			}
		} else {
			echo "<tr>";
			echo "<th width='110'>1</th>";
			echo "<td width='267'><input type='text'   name='equipment_name[0]'/></td>";
			echo "<td width='267'><input type='text'   datatype='number' placeholder='请输入整数' name='equipment_num[0]'/></td>";
			echo "<td width='267'><input type='text'  datatype='float' placeholder='请输入整数或小数'  name='equipment_price[0]'/></td>";
			echo "<td width='267'><input type='text'  readonly placeholder='无需填写,自动计算,数量*单价'  name='equipment_fund[0]'/></td>";
			 
			echo "<td width='40' ><input type='button' value='删除' class='pointer'  onclick='deleteRow(this)'/></td>";
			echo "</tr>";
		}
		?>
					</table>
					</td>
					</tr>
				<tr>
						<th colspan="5"><input type="button"  value="添加"  class='pointer' onclick="addLine()"></input></th>
					</tr>	
					<tr>
						<th colspan="5"><p align="center">购置检测仪器明细（单台5万元及以上）</p></th>
					</tr>
					<tr>
						<td colspan="5">	
						<table id="instrument_list">
						<tr>
						<th rowspan="1"><p align="center">序号</p></th>
						<th rowspan="1"><p align="center">检测仪器名称</p></th>
						<th rowspan="1"><p align="center">数量</p></th>
						<th rowspan="1"><p align="center">单价</p></th>
						<th rowspan="1"><p align="center">合计金额</p></th>
						<th rowspan="1"><p align="center">操作</p></th>
					</tr>
					<?php
		$project_id = $_SESSION['project_id'];
		$sql = "Select * from instrument_list where project_id='$project_id'";
		//
// 		echo $sql;
		$db = new DB ();
		$result = $db->SelectOri ( $sql );
		$tableRow = mysql_num_rows ( $result );
		if ($tableRow) {
			for($i = 0; $i < $tableRow; $i ++) {
				$row = mysql_fetch_object ( $result );
				$count=$i+1;
				echo "<tr>";
				echo "<th ><p align='center'>$count</p></th>";
				echo "<td><input type='text' name='test_name[$i]'    value='$row->test_name'/></td>";
				echo "<td><input type='text' name='test_num[$i]'     datatype='number' placeholder='请输入整数'  value='$row->test_num'/></td>";
				echo "<td><input type='text' name='test_price[$i]'   datatype='float' placeholder='请输入整数或小数'   value='$row->test_price'/></td>";
				echo "<td><input type='text' name='test_fund[$i]'    readonly placeholder='无需填写,自动计算,数量*单价'    value='$row->test_fund'/></td>";
				echo "<td><input type='button' value='删除' class='pointer'  onclick='deleteRow(this)'/></td>";
				echo "</tr>";
			}
		} else {
			echo "<tr>";
			echo "<th width='110'>1</th>";
			echo "<td width='267'><input type='text'  name='test_name[0]'/></td>";
			echo "<td width='267'><input type='text'  datatype='number'  placeholder='请输入整数' name='test_num[0]'/></td>";
			echo "<td width='267'><input type='text'  datatype='float' placeholder='请输入整数或小数'  name='test_price[0]'/></td>";
			echo "<td width='267'><input type='text'  readonly placeholder='无需填写,自动计算,数量*单价'  name='test_fund[0]'/></td>";
			 
			echo "<td width='40' ><input type='button' value='删除' class='pointer'   onclick='deleteRow(this)'/></td>";
			echo "</tr>";
		}
		?>
						</table>
					</td>
					
					</tr>
					<tr>
						<th colspan="5"><input type="button"  value="添加" class='pointer' onclick="addLine2()"></input></th>
					</tr>
					
					<tr>
						<th colspan="5"><p align="center">厂房、场地改善情况</p></th>
					</tr>
					<tr>
						<th><p align="center">新建厂房面积</p></th>
						<td><input name="factory_area"  datatype='float' placeholder='请输入整数或小数'  /></td>
						<th><p align="center">合计金额</p></th>
						<td colspan="2"><input name="factory_sum"  datatype='float'   /></td>
					</tr>
					<tr>
						<th><p align="center">改扩建厂房面积</p></th>
						<td><input name="rebuild_area"   datatype='float' placeholder='请输入整数或小数'  /></td>
						<th><p align="center">合计金额</p></th>
						<td colspan="2"><input name="rebuild_sum"  datatype='float'   /></td>
					</tr>
				</table>
				<div class="button_wrapper clearfix d-n">
					<div class="save">保存</div>
					<!-- <div class="reset" >重置</div> -->
				</div>
			</div>

		</div>
	</form>
<script type="text/javascript">
	$('#equipment_list').delegate('input', 'input propertychange', do_change1);
	$('#instrument_list').delegate('input', 'input propertychange', do_change2);

	function do_change1() {
		$equipment_price = $("input[name^='equipment_price[']");
		$equipment_num = $("input[name^='equipment_num[']");
		$equipment_fund = $("input[name^='equipment_fund[']");

		$equipment_price.each(function(i) {
			var total = $equipment_price[i].value * $equipment_num[i].value;
			$equipment_fund[i].value = total;
		});
	}

	function do_change2() {
		$test_price = $("input[name^='test_price[']");
		$test_num = $("input[name^='test_num[']");
		$test_fund = $("input[name^='test_fund[']");

		$test_price.each(function(i) {
			var total = $test_price[i].value * $test_num[i].value;
			$test_fund[i].value = total;
		});
	}

</script>
</body>
</html>
