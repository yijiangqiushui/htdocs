<?php
session_start ();
$project_id = $_SESSION ['project_id'];
$user_type = $_SESSION ['user_type'];
$sql = "Select * from table_status where project_id = '$project_id' and table_name = '项目经费总决算表' ";
$conn = mysql_connect ( "192.168.1.125", "FRED", "123456" );
mysql_select_db ( "project", $conn );
$result = mysql_query ( $sql, $conn );
$result_table = mysql_fetch_object ( $result );
$table_status = $result_table->table_status;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link rel="stylesheet" type="text/css"
	href="../../../../website/html/view/css/tablestyle.css" />
<script type="text/javascript"
	src="../../../../common/html/plugin/jquery-hlui-2.0/js/jquery-2.1.0.min.js"></script>
<script type="text/javascript"
	src="../../../../common/html/plugin/jquery-hlui-2.0/js/jquery-ui.js"></script>
<!-- <script type="text/javascript" src="../../../../common/html/plugin/jquery-hlui-2.0/js/jquery.cookie.js"></script> -->
<script type="text/javascript"
	src="../../../../common/html/plugin/easyui/jquery.min.js"></script>
<script type="text/javascript"
	src="../../../../common/html/plugin/jquery-hlui-2.0/js/hlui.js"></script>
<script type="text/javascript"
	src="../../../../common/html/plugin/jquery-hlui-2.0/js/layout.js"></script>
<link
	href="../../../../common/html/plugin/jquery-hlui-2.0/css/layout.css"
	rel="stylesheet" type="text/css" />

<script type="text/javascript" src="../js/execute_solution.js"></script>
<link href="../css/main.css" rel="stylesheet" type="text/css" />
</head>

<body>
	<div class="default_left">
		<div class="menus">
			<h1>立项阶段</h1>
			<ul class="apply">
				<label>项目经费总决算表<span></span></label>
				<li><a
					href="apply/attach_2/org_info.php?status=<?php echo $table_status?>">&nbsp;&nbsp;&nbsp;&nbsp;1.1
						申报单位基本情况</a><span></span></li>
				<li><a
					href="apply/attach_2/coorg_info.php?status=<?php echo $table_status?>">&nbsp;&nbsp;&nbsp;&nbsp;1.2
						合作单位基本情况</a><span></span></li>
				<li><a
					href="apply/attach_2/project_info.php?status=<?php echo $table_status?>">&nbsp;&nbsp;&nbsp;&nbsp;1.3
						相关行业、领域国内外研究发展现状、趋势以及本单位在相关领域的工作基础</a><span></span></li>
    <?php
				if ($user_type == 0) {
					if ($table_status > 2) {
						// echo "<li><a href=\"Projectapp/project_check_opinion.php?status=". $table_status."&table_name="."项目实施方案"."\"".">&nbsp;&nbsp;&nbsp;&nbsp;1.14 审核意见</a><span></span></li>";
						echo "<li><a href=..\..\"check_opinion.php?status=" . $table_status . "&table_name='项目经费总决算表'\">&nbsp;&nbsp;&nbsp;&nbsp;审核意见</a><span></span></li>";
					}
				} else {
					// echo "<li><a href=\"Projectapp/project_check_opinion.php?status=". $table_status."&table_name="."项目实施方案"."\"".">&nbsp;&nbsp;&nbsp;&nbsp;1.14 审核意见</a><span></span></li>";
					echo "<li><a href=..\..\"check_opinion.php?status=" . $table_status . "&table_name='项目经费总决算表'\">&nbsp;&nbsp;&nbsp;&nbsp;审核意见</a><span></span></li>";
				}
				echo "</ul>";
				if ($user_type == 0) {
					if ($table_status == 1 || $table_status == 3) {
						echo "<h1>提交申请书</h1>";
						echo "<ul class='apply'>";
						echo "<li><a href='#' onclick='execute();'>&nbsp;&nbsp;&nbsp;&nbsp;提交通州区支持产学研合作项目申请书</a></li>";
					}
    }
  ?>
  
  </ul>
		</div>
	</div>
</body>
</html>
