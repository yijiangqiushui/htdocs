<?php

  $project_id = $_SESSION['project_id'];
  $user_type = $_SESSION['user_type'];
  $sql = "Select * from table_status where project_id = '$project_id' and table_name = '通州区支持技术输出能力提升项目申报书' ";
   $result = $db->SelectOri($sql);
  $result_table = mysql_fetch_object($result);
  $table_status = $result_table -> table_status; 
   $result = $db->SelectOri($sql);
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

<link rel="stylesheet" type="text/css" href="../../../../../common/html/plugin/easyui/themes/default/easyui.css" />
<link rel="stylesheet" type="text/css" href="../../../../../common/html/plugin/easyui/themes/icon.css" />
<script type="text/javascript" src="../../../../../common/html/plugin/easyui/jquery.min.js"></script>
<script type="text/javascript" src="../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="../../../../../common/html/plugin/jquery-hlui-2.0/js/hlui.js"></script>
<script type="text/javascript" src="../../../../../common/html/plugin/jquery-hlui-2.0/js/form.js"></script>
<!-- <script type="text/javascript" src="../../../../../ommon/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script> -->

<!-- <script type="text/javascript" src="../../../js/apply/attach_3/attach3_main.js"></script> -->
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
<!--     <label>通州区支持科技成果转化项目申报书<span></span></label> -->
   <!-- <li><a href="org_info.html?status=<?php echo $table_status?>">&nbsp;&nbsp;&nbsp;&nbsp;1.1 申报单位基本情况</a><span></span></li>
    <li><a href="project_info.html?status=<?php echo $table_status?>">&nbsp;&nbsp;&nbsp;&nbsp;1.2 项目基本情况</a><span></span></li>
    <li><a target="center" href="/center/php/action/page/check_opinion.php?status=<?php echo $table_status;?>&table_name='通州区支持科技成果转化项目申报书'">审核意见</a></li>-->s
    
  
<!--   </ul> -->
<!-- </div> -->
<!-- </div> -->
    
    <div class="easyui-layout" style="width:100%;height:2500px;">
	<div region="west" split="true" title="申报阶段审核" style="width:300px;">
	    <h3>通州区支持技术输出能力提升项目申报书</h3>
		<ul style="padding-left:50px;">
             <li><a target="center" href="/website/html/view/template/apply/attach_7/org_info.html?status=<?php echo $table_status?>">&nbsp;&nbsp;&nbsp;&nbsp;通州区支持技术输出能力提升项目申报书</a><span></span></li>
             <li><a target="center" href="/center/php/action/page/check_opinion.php?status=<?php echo $table_status;?>&table_name='通州区支持技术输出能力提升项目申报书'">审核意见</a></li>
		</ul>
	</div>
	<div id="content" region="center" >
		<iframe width="100%" height="100%" frameborder="0" name="center">
		</iframe>
	</div>
</div>
</body>
</html>
