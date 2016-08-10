<?php
include '../../../../../../../common/php/config.ini.php';
include '../../../../../../../common/php/lib/db.cls.php';
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css"
	href="../../../../../../../common/html/plugin/easyui/themes/default/easyui.css" />
<link rel="stylesheet" type="text/css"
	href="../../../../../../../common/html/plugin/easyui/themes/icon.css" />
<link rel="stylesheet" type="text/css" href="../../../../css/table.css" />
<link rel="stylesheet" type="text/css" href="../../../../css/button.css" />

<script src="../../../../../../../common/html/js/datecommon.js"></script>

<script type="text/javascript"
	src="../../../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript"
	src="../../../../../../../common/html/plugin/easyui/jquery.cookie.js"></script>
<script type="text/javascript"
	src="../../../../../../../common/html/plugin/jquery-hlui-2.0/js/hlui.js"></script>
<script type="text/javascript"
	src="../../../../../../../common/html/plugin/jquery-hlui-2.0/js/form.js"></script>
<script type="text/javascript"
	src="../../../../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>
<script type="text/javascript" src="../../../../../../../common/html/js/tablecommon.js"></script>
<script type="text/javascript" src="../../../../js/check_material/unit_info.js"></script>
<script type="text/javascript" src="../../../../../../../common/html/js/validation.js"></script>

</head>

<body>
	<form id="unit_info" method="post">
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
							<div class="title_top p-b10">项目基本情况</div>
						</td>
					</tr>
					<tr>
						<th><p align="center">项目负责人</p></th> <!-- 这三个字段是从表 project_principal表中取出的-->
						<td><input name="leader_name" /></td>
						<th><p align="center">职务</p></th>
						<td><input name="leader_job" /></td>
						<th><p align="center">职称</p></th>
						<td><input name="tech_pos" /></td>
					</tr>
					<tr>
						<th><p align="center">项目名称</p></th>   <!-- 这个字段是从project_info中查询的 -->
						<td colspan="5"><input name="project_name"/></td>

					</tr>
					<tr>
						<th rowspan="2"><p align="center">所含专利名称</p></th> <!-- 这是从表patent_list中查询的 -->
						<td colspan="5">
						<table id="shareholder_info">
						<?php
		$project_id = $_SESSION['project_id'];
		$sql = "Select * from patent_list where project_id='$project_id' and  is_new = 0 ";
// 		echo $sql;
		$db = new DB ();
		$result = $db->SelectOri ( $sql );
		$tableRow = array();
		if($result != false){
			$tableRow = mysql_num_rows ( $result );
		}
		if ($tableRow) {
			for($i = 0; $i < $tableRow; $i ++) {
				$row = mysql_fetch_object ( $result );
				echo "<tr>";
				echo "<td><input type='text' name='shareholder_name[$i]' value='$row->patent_name'/></td>";
				echo "<th style='width:80px;'><p align='center'>专利号</p></th>";
				echo "<td><input type='text' name='stock_ratio[$i]'  datatype='baifenshu'   value='$row->patent_code'/></td>";
				echo "<td><input type='button' value='删除' class=\"pointer\"onclick='deleteRow(this)'/></td>";
				echo "</tr>";
			}
		} else {
			echo "<tr>";
			echo "<td width='110'><input type='text' name='shareholder_name[0]'/></td>";
			echo "<th style='width:80px;'><p align='center'>专利号</p></th>";
			echo "<td width='267'><input type='text' datatype='baifenshu' name='stock_ratio[0]'/></td>";
			echo "<td width='40' ><input type='button' value='删除' class=\"pointer\" onclick='deleteRow(this)'/></td>";
			echo "</tr>";
		}
		?>
						</table>
						
						</td>
						
						<!-- <input name="" placeholder="1、" /></td>
						<th><p align="center">专利号</p></th>
						<td colspan="3"><input name="" /> -->

					</tr>
				<tr>
		<th colspan="6"><input type="button" onclick="addLine()" class="pointer" value="添加"/></th>
		</tr>	 
					<tr>
						<th><p align="center">产品执行标准</p></th><!-- 以下三个字段是从表 check_material中查询的-->
						<td colspan="5"><input name="product_standard"  placeholder="产品执行标准是指项目开发或产业化执行的GB、QB、等标准，请填标准号"/></td>

					</tr>
					<tr>
						<th><p align="center">产品鉴定日期</p></th>
						<td colspan="5"><input name="identify_date" id="identify_date" class='dateplu' readonly/></td>

					</tr>
					<tr>
						<th><p align="center">主持鉴定单位</p></th>
						<td colspan="5"><input name="host_org" /></td>

					</tr>
					<tr>
						<th rowspan="3" ><p align="center">产品获奖情况</p></th><!-- 以下三个字段是从表produce_award中查询的 -->
						<td colspan="5">
						<table id="award">
						<tr>
						<th colspan="1"><p align="center">获奖名称</p></th>
						<th><p align="center">授奖部门</p></th>
						<th colspan="3" ><p align="center">获奖等级</p></th>
						</tr>
					 	<?php
		$project_id = $_SESSION['project_id'];
		$sql = "Select * from produce_award where project_id='$project_id'";
// 		echo $sql;
		$db = new DB ();
		$result = $db->SelectOri ( $sql );
		$tableRow = array();
		if($result != false){
			$tableRow = mysql_num_rows ( $result );
		}
		if ($tableRow) {
			for($i = 0; $i < $tableRow; $i ++) {
				$row = mysql_fetch_object ( $result );
				echo "<tr>";
				echo "<td><input type='text' name='award_name[$i]' value='$row->award_name'/></td>";
				echo "<td><input type='text' name='award_dep[$i]'     value='$row->award_dep'/></td>";
				echo "<td><input type='text' name='award_level[$i]'    value='$row->award_level'/></td>";
				echo "<td width='40'><input type='button' value='删除' onclick='deleteRowWithHead(this)'/></td>";
				echo "</tr>";
			}
		} else {
			echo "<tr>";
			echo "<td><input type='text' name='award_name[0]' /></td>";
			echo "<td><input type='text' name='award_dep[0]'    /></td>";
			echo "<td><input type='text' name='award_level[0]'    ></td>";
			echo "<td width='40' ><input type='button' value='删除' onclick='deleteRowWithHead(this)'/></td>";
			echo "</tr>";
		}
		?>
						</table>
						</td>
					</tr>
						<tr>
		<th colspan="6"><input type="button" onclick="addLine2()" class="pointer" value="添加"/></th>
		</tr>
				</table>
				<div class="button_wrapper clearfix d-n">
					<div class="save">保存</div>
					<!-- <div class="reset" >重置</div> -->
				</div>
			</div>

		</div>
	</form>


</body>
</html>
