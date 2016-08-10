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
	src="../../../../js/check_material/spread.js"></script>


</head>

<body>
	<form id="spread" method="post">
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
							<div class="title_top p-b10">项目（产品）推广扩散情况</div>
						</td>
					</tr>
					
					<tr>
						<td colspan="3">
						<table id="tech_transfer">
						<tr>
						<th><p align="center">技术转让</p></th>
						<th><p align="center">受 让 方 名 称</p></th>
						<th><p align="center">企 业 规 模</p></th>
						<th><p align="center">操作</p></th>
					</tr>
		<?php
		$project_id = $_SESSION['project_id'];
		$sql = "Select * from tech_transfer where project_id='$project_id'";
		$db = new DB ();
		$result = $db->SelectOri ( $sql );
		$tableRow = mysql_num_rows ( $result );
		if ($tableRow) {
			for($i = 0; $i < $tableRow; $i ++) {
				$row = mysql_fetch_object ( $result );
				$count=$i+1;
				echo "<tr>";
				echo "<td><p>$count</p></td>";
				echo "<td><input type='text' name='receiver[$i]' value='$row->receiver'/></td>";
				echo "<td><input type='text' name='company_scale[$i]'    value='$row->company_scale'/></td>";
				echo "<td><input type='button' value='删除' class=\"pointer\" onclick='deleteRow(this)'/></td>";
				echo "</tr>";
			}
		} else {
			echo "<tr>";
			echo "<td width='110'><p>1</p></td>";
			echo "<td width='267'><input type='text'  name='receiver[0]'/></td>";
			echo "<td width='267'><input type='text'  name='company_scale[0]'/></td>";
			echo "<td width='40' ><input type='button' value='删除' class=\"pointer\" onclick='deleteRow(this)'/></td>";
			echo "</tr>";
		}
		?>
		
		</table  >
						</td>
					</tr>
					<tr>
		<th colspan="4">
		<input type="button"  onclick="addLine()" class="pointer" value="添加"/>
		</th>
		</tr>
					 
					<tr>
						<td colspan="3">
						<table id="co_construct">
						<tr>
						<th><p align="center">合作建厂</p></th>
						<th><p align="center">合  作  方  名  称</p></th>
						<th><p align="center">企 业 规 模</p></th>
						<th><p align="center">操作</p></th>
					</tr>
		<?php
		$project_id = $_SESSION['project_id'];
		$sql = "Select * from co_construct where project_id='$project_id'";
		$db = new DB ();
		$result = $db->SelectOri ( $sql );
		$tableRow = mysql_num_rows ( $result );
		if ($tableRow) {
			for($i = 0; $i < $tableRow; $i ++) {
				$count=$i+1;
				$row = mysql_fetch_object ( $result );
				echo "<tr>";
				echo "<td><p>$count</p></td>";
				echo "<td><input type='text' name='partner_name[$i]' value='$row->partner_name'/></td>";
				echo "<td><input type='text' name='company_scale1[$i]'     value='$row->company_scale'/></td>";
				echo "<td><input type='button' value='删除' class=\"pointer\" onclick='deleteRow(this)'/></td>";
				echo "</tr>";
			}
		} else {
			echo "<tr>";
			echo "<td width='110'><p>1</p></td>";
			echo "<td width='267'><input type='text'  name='partner_name[0]'/></td>";
			echo "<td width='267'><input type='text'  name='company_scale1[0]'/></td>";
			echo "<td width='40' ><input type='button' class=\"pointer\" value='删除' onclick='deleteRow(this)'/></td>";
			echo "</tr>";
		}
		?>
		
		
		</table>
						</td>
					</tr>
					<tr>
		<th colspan="4">
		<input type="button"  onclick="addLine2()" class="pointer" value="添加"/>
		</th>
		</tr>
		<tr>
						<th>市场开拓、占有情况</th>
						
					</tr>
					<tr>
						<td colspan="3"><textarea style="margin:8px; width:98%;" name="market_open" ></textarea></td>
						
					</tr>
				</table>
				<div class="button_wrapper clearfix d-n">
					<div class="save" style="left: auto">保存</div>
					<!-- <div class="reset" >重置</div> -->
				</div>
			</div>

		</div>
	</form>


</body>
</html>
