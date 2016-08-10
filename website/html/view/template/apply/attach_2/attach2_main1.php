<?php
include '../../../../../../center/php/config.ini.php';
include '../../../../../../common/php/config.ini.php';
include '../../../../../../common/php/lib/db.cls.php';
session_start ();
$db = new DB ();
$project_id = $_SESSION ['project_id'];
$user_type = $_SESSION ['user_type'];
$sql = "Select * from table_status where project_id = '$project_id' and table_name = '通州区支持产学研合作项目申请书' ";
/*
 * $conn = mysql_connect("david","FRED","123456");
 * mysql_select_db("project",$conn);
 */
$result = $db->SelectOri ( $sql );
$result_table = mysql_fetch_object ( $result );
$table_status = $result_table->table_status;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<script type="text/javascript"
	src="../../../../../../common/html/plugin/jquery-hlui-2.0/js/jquery-2.1.0.min.js"></script>
<script type="text/javascript"
	src="../../../../../../common/html/plugin/jquery-hlui-2.0/js/jquery-ui.js"></script>
<!-- <script type="text/javascript" src="../../../../common/html/plugin/jquery-hlui-2.0/js/jquery.cookie.js"></script> -->
<script type="text/javascript"
	src="../../../../../../common/html/plugin/easyui/jquery.min.js"></script>
<script type="text/javascript"
	src="../../../../../../common/html/plugin/jquery-hlui-2.0/js/hlui.js"></script>
<script type="text/javascript"
	src="../../../../../../common/html/plugin/jquery-hlui-2.0/js/layout.js"></script>
<link
	href="../../../../../../common/html/plugin/jquery-hlui-2.0/css/layout.css"
	rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css"
	href="../../../../../../website/html/view/css/tablestyle.css" />
<script type="text/javascript"
	src="../../../js/apply/attach_2/attach2_main.js"></script>
<link href="../../../css/main.css" rel="stylesheet" type="text/css" />
</head>

<body>
	<div class="default_left">
		<div class="menus">
			<h1>申报阶段</h1>
			<ul class="apply">
				<label>一、通州区支持产学研合作项目申请书<span></span></label>
				<li><a href="org_info.php?status=<?php echo $table_status?>">&nbsp;&nbsp;&nbsp;&nbsp;1.1
						申报单位基本情况</a><span></span></li>
				<li><a href="coorg_info.php?status=<?php echo $table_status?>">&nbsp;&nbsp;&nbsp;&nbsp;1.2
						合作单位基本情况</a><span></span></li>
				<li><a href="project_info.php?status=<?php echo $table_status?>">&nbsp;&nbsp;&nbsp;&nbsp;1.3
						项目基本情况</a><span></span></li>
    <?php
				if ($user_type == 0) {
					if ($table_status > 2) {
						echo "<li><a href=\"../../check_opinion.php?status=" . $table_status . "&table_name='通州区支持产学研合作项目申请书'\">&nbsp;&nbsp;&nbsp;&nbsp;审核意见</a><span></span></li>";
					}
				} else {
					echo "<li><a href=\"/website/html/view/template/check_opinion.php?status=" . $table_status . "&table_name='通州区支持产学研合作项目申请书'\">&nbsp;&nbsp;&nbsp;&nbsp;审核意见</a><span></span></li>";
				}
				echo "</ul>";
				if ($user_type == 0) {
					if ($table_status == 1 || $table_status == 3) {
						echo "<h1>审核</h1>";
						echo "<ul class='apply'>";
						// $name = "通州区支持产学研合作项目申请书";
						echo "<li><a href='#' onclick='execute();'>&nbsp;&nbsp;&nbsp;&nbsp;提交通州区支持产学研合作项目申请书</a></li>";
					}
				}
				?>
  
  </ul>
		</div>
	</div>
</body>
</html>
