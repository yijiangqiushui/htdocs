
<?php
include '../../../../../center/php/config.ini.php';
include '../../../../../common/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';
session_start();
$db = new DB();
  $project_id = $_SESSION['project_id'];
  $user_type = $_SESSION['user_type'];
 $sql = "select * from table_status where project_id='$project_id' and table_name = '通州区技术合同登记奖励资金申报表'";
// mysql_select_db("project");
// $result = mysql_query($sql);
 //$res = mysql_fetch_object($result);
 $result = $db -> SelectOri($sql);
  $result_table = mysql_fetch_object($result);
  $table_status = $result_table -> table_status; 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<script type="text/javascript" src="../../../../../common/html/plugin/jquery-hlui-2.0/js/jquery-2.1.0.min.js"></script>
<script type="text/javascript" src="../../../../../common/html/plugin/jquery-hlui-2.0/js/jquery-ui.js"></script>
<!-- <script type="text/javascript" src="../../../../common/html/plugin/jquery-hlui-2.0/js/jquery.cookie.js"></script> -->

<script type="text/javascript" src="../../../../../common/html/plugin/jquery-hlui-2.0/js/hlui.js"></script>
<script type="text/javascript" src="../../../../../common/html/plugin/jquery-hlui-2.0/js/layout.js"></script>
<link href="../../../../../common/html/plugin/jquery-hlui-2.0/css/layout.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css" href="../../../../../common/html/plugin/easyui/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="../../../../../common/html/plugin/easyui/themes/icon.css">
<script type="text/javascript" src="../../../../../common/html/plugin/easyui/jquery.min.js"></script>
<script type="text/javascript" src="../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="../../../../../common/html/plugin/jquery-hlui-2.0/js/hlui.js"></script>
<script type="text/javascript" src="../../../../../common/html/plugin/jquery-hlui-2.0/js/form.js"></script>
<!-- <script type="text/javascript" src="../../../../../ommon/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script> -->

<!-- <script type="text/javascript" src="attach_2.js"></script> -->
<link href="../../../../html/view/css/main.css" rel="stylesheet" type="text/css" />
<style type="text/css">
a{
	 text-decoration : none;
}
ul li{
	list-style:none;
	color:black;
}
</style>
</head>

<body>
<!-- <div class="default_left"> -->
<!-- <div class="menus"> -->
<!--   <h1>申报阶段</h1> -->
<!--   <ul class="apply"> -->
<!--     <li>项目经费总结算表<span></span></li> -->
<!--     <li><a href="Acceptance/">&nbsp;&nbsp;&nbsp;&nbsp; 项目承担单位基本信息</a><span></span></li> -->
<!--   </ul> -->
<!--   <h1>提交申报推荐书</h1> -->
<!--   <ul class="apply"> -->
<!--   <li><a href="#">&nbsp;&nbsp;&nbsp;&nbsp;提交推荐书</a></li> -->
<!--   </ul> -->
<!-- </div> -->
<!--</div> default_left-->
	<div class="easyui-layout" style="width:100%;height:2500px;">
	<div region="west" split="true" title="申报阶段审核" style="width:300px;">
	    <h3>通州区技术合同登记奖励资金申报表</h3>
		<ul style="padding-left:50px;">
			<li><a target="center" href="/website/html/view/template/apply/attach_6/org_info.php?status=<?php echo $table_status?>">&nbsp;&nbsp;&nbsp;&nbsp;通州区技术合同登记奖励资金申报表</a><span></span></li>
			<li><a target="center" href="/center/php/action/page/check_opinion.php?status=<?php echo $table_status;?>&table_name='通州区技术合同登记奖励资金申报表'">审核意见</a></li>
		</ul>
	</div>
	<div id="content" region="center" >
		<iframe width="100%" height="100%" frameborder="0" name="center">
		</iframe>
	</div>
</div>
</body>
</html>
