<?php
include '../../../../center/php/config.ini.php';
include '../../../../common/php/config.ini.php';
include '../../../../common/php/lib/db.cls.php';
session_start ();
$db = new DB ();
$project_id = $_SESSION ['project_id'];
$user_type = $_SESSION ['user_type'];
$sql = "Select * from table_status where project_id = '$project_id' and table_name = '项目实施方案' ";
$result = $db->SelectOri ( $sql );
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
<style>
p {
	font-size: 16px;
}
</style>
</head>

<body>
	<div class="default_left">
		<div class="menus">
			<h1>修改用户及企业信息</h1>
			<ul class="apply">
				<label><span></span></label>
				<!-- <li><a href="Projectapp/project_summary.html">&nbsp;&nbsp;&nbsp;&nbsp;1.1 项目基本信息</a><span></span></li> -->
				<li><a href="./userinfo/logininfo.html">&nbsp;&nbsp;&nbsp;&nbsp;用户信息</a><span></span></li>
				<li><a href="./userinfo/changpwd.html">&nbsp;&nbsp;&nbsp;&nbsp;修改密码</a><span></span></li>
				<li><a href="./userinfo/userinfo.html">&nbsp;&nbsp;&nbsp;&nbsp;企业信息</a><span></span></li>
			</ul>
		</div>
	</div>
	<!--default_left-->
</body>
</html>
