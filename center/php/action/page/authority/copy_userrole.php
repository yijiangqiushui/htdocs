<?php
session_start ();

$department_type = $_SESSION ['department'];
switch ($department_type) {
	case 0 :
		$department = "发展计划科";
		break;
	case 1 :
		$department = "知识产权科";
		break;
	case 2 :
		$department = "科技综合科";
		break;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>权限</title>
<link rel="stylesheet" type="text/css"
	href="../../../../../common/html/plugin/easyui/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css"
		href="../../../../../common/html/plugin/easyui/themes/icon.css">
		<!--      <script type="text/javascript" src="../../../../../common/html/plugin/easyui/jquery.min.js"></script> -->
		<script type="text/javascript"
			src="../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
		<script type="text/javascript"
			src="../../../../html/view/js/user_role.js"></script>
		<link rel="stylesheet"
			href="../../../../html/view/css/daterangepicker.css" />
		<script src="../../../../html/view/js/moment.min.js"></script>
		<script src="../../../../html/view/js/jquery-1.11.2.min.js"></script>
		<script src="../../../../html/view/js/jquery.daterangepicker.js"></script>
		<script src="../../../../html/view/js/user_role.js"></script>

</head>

<style>
table {
	background: #000;
}

table th {
	background: #FFFAF0;
	font-family: 黑体;
	font-size: 1.3em;
	height: 35px;
}

table tr td {
	background: #FFFAF0;
	font-family: 微软雅黑;
	font-size: 1em;
	height: 35px;
	text-align: center
}

body {
	margin: auto 0;
	padding: 0;
}

body {
	margin: auto 0;
}
</style>
<body>

	<div style="background: #A2B5CD; text-align: center; height: 50px;">
		<h1>项目申请开放时间</h1>
	</div>
	<div title=<?php echo $department."项目权限设置" ?> border="0">
		<table width="1111" border="1" cellpadding="0" cellspacing="1">
			<tr>
				<!-- <td colspan="3"><h3>1.支持科技研发及成果转化专项资金</h3></td> -->
				<th>序号</th>
				<th>项目类别</th>
				<th colspan="2">项目开放/关闭</th>
				<th colspan="2">项目开启/截止时间</th>
			</tr>
  <?php
		include '../../../../../center/php/config.ini.php';
		include '../../../../../common/php/config.ini.php';
		include '../../../../../common/php/lib/db.cls.php';
		$db = new DB ();
		$sql = "Select * from project_type where isfather=1";
		/*
		 * $conn = mysql_connect("david","FRED","123456");
		 * mysql_select_db("project",$conn);
		 */
		$result = $db->SelectOri ( $sql );
		$row_n = mysql_num_rows ( $result );
		$num = 0;
		for($i = 1; $i <= $row_n; $i ++) {
			$father = mysql_fetch_object ( $result );
			
			// 用来判断当前的父节点是否存在子节点
			
			$id = $father->id;
			// 当前父节点中子节点的个数
			$sql1 = "Select * from project_type where father='$id' and dep_type =" . $department_type;
			$result1 = $db->SelectOri ( $sql1 );
			$row_m = mysql_num_rows ( $result1 );
			if ($row_m != 0) {
				$num = $num + 1;
				echo "<tr>";
				echo "<td width='80' align='center'><strong>" . $num . "</strong></td>";
				echo "<td width='400' align='center'><strong>" . $father->name . "</strong></td>";
				if ($father->id == $father->father) {
					// 若当前是正在申报的状态则显示当前的时间以及将按钮自动到开启的上面
					if ($father->apply_status == 1) {
						echo "<td width='100' align='center'><input type='radio'  name='$id' onclick='closeProject(this);'/><span>关闭</span></td>";
						echo "<td width='100' align='center'><input type='radio'  checked='true' name='$id'/><span>开启</span></td>";
						$start_time = date ( 'Y/m/d', $father->apply_start );
						if ($father->apply_end != null) {
							$end_time = date ( 'Y/m/d', $father->apply_end );
						} else {
							$end_time = '未指定';
						}
						echo "<td width='300' v><div id='$id' style='visibility:visible;'>" . $start_time . "——" . $end_time;
						echo "</div></td>";
					} else {
						echo "<td width='100' align='center'><input type='radio'  checked='true' name='$id' onclick='closeProject(this);'/><span>关闭</span></td>";
						echo "<td width='100' align='center'><input type='radio'  name='$id' onclick='show(this);'/><span>开启</span></td>";
						// 这个地方需要修改，这里是个日期的控件
						$start_tmp = ($father->name) . "_start";
						$end_tmp = ($father->name) . "_end";
						echo "<td width='400' align='center'><div id='$id' style='visibility:hidden;'>
                    <input id='$start_tmp' style='width:30%;height:25px;font-size:0.8em;text-align:center;' class='dataRange' />  至  ";
						echo "<input id='$end_tmp' style='width:30%;height:25px;font-size:0.8em;text-align:center;' class='dataRange' />";
						echo "<input name='$father->name' type='button' value='确定' style='font-size:0.8em;height:25px;' onclick='openProject(this);'/></div></td>";
					}
				} else {
					echo "<td></td>";
					echo "<td></td>";
					echo "<td></td>";
					// echo "<td></td>";
				}
				echo "</tr>";
				
				for($j = 1; $j <= $row_m; $j ++) {
					$children = mysql_fetch_object ( $result1 );
					
					if ($children->father != $children->id) {
						echo "<tr>";
						echo "<div class='$children->name'>";
						echo "<td  align='center'>" . $num . "." . $j . "</td>";
						echo "<td  align='center'>" . $children->name . "</td>";
						if ($children->apply_status == 1) {
							echo "<td align='center'><input type='radio'  name='$children->id' onclick='closeProject(this);'/><span>关闭</span></td>";
							echo "<td align='center'><input type='radio'  checked='true' name='$children->id';'/><span>开启</span></td>";
							$start_time = date ( 'Y/m/d', $children->apply_start );
							if ($children->apply_end != null) {
								$end_time = date ( 'Y/m/d', $children->apply_end );
							} else {
								$end_time = '未指定';
							}
							
							echo "<td align='center'><div id='$children->id' style='visibility:visible;'>" . $start_time . "——" . $end_time;
							echo "</div></td>";
						} else {
							echo "<td align='center'><input type='radio'  checked='true' name='$children->id' onclick='closeProject(this);'/><span>关闭</span></td>";
							echo "<td align='center'><input type='radio'  name='$children->id' onclick='show(this);'/><span>开启</span></td>";
							// 这个地方需要修改，这里是个日期的控件
							$start_tmp = ($children->name) . "_start";
							$end_tmp = ($children->name) . "_end";
							echo "<td align='center'><div id='$children->id' style='visibility:hidden;'>
                    <input id='$start_tmp' style='width:30%;height:25px;font-size:0.8em;text-align:center;' class='dataRange' />  至   ";
							echo "<input id='$end_tmp' style='width:30%;height:25px;font-size:0.8em;text-align:center;' class='dataRange' />   ";
							echo "<input type='button' id='$children->name' name='$children->name' value='确定' style='font-size:0.8em;height:25px;' onclick='openProject(this);'/></div></td>";
						}
						echo "</div>";
						echo "</tr>";
					}
				}
			}
		}
		?>
</table>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<br> <a href='../project_list/main.php' target="main_center"
			style='text-decoration: none; float: left; margin: 0 0 0 500px'><input
				type='button' value='确认并返回'
				style="width: 150px; height: 35px; font-family: 黑体; font-size: 1em;" /></a>
	
	</div>


	<table id="userrole" class="easyui-datagrid" style="height: auto">
		<tr>
			<th>序号</th>
			<th>项目类别</th>
			<th colspan="2">项目开放/关闭</th>
			<th>项目开启/截止时间</th>
		</tr>
	</table>
</body>
</html>
