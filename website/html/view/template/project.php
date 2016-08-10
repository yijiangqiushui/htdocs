<?php
session_start ();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<script type="text/javascript"
	src="../../../../common/html/plugin/jquery-hlui-2.0/js/jquery-2.1.0.min.js"></script>
<script type="text/javascript"
	src="../../../../common/html/plugin/jquery-hlui-2.0/js/jquery-ui.js"></script>
<!-- <script type="text/javascript" src="../../../../common/html/plugin/jquery-hlui-2.0/js/jquery.cookie.js"></script> -->

<script type="text/javascript"
	src="../../../../common/html/plugin/jquery-hlui-2.0/js/hlui.js"></script>
<script type="text/javascript"
	src="../../../../common/html/plugin/jquery-hlui-2.0/js/layout.js"></script>
<link
	href="../../../../common/html/plugin/jquery-hlui-2.0/css/layout.css"
	rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css"
	href="../../../../common/html/plugin/easyui/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css"
		href="../../../../common/html/plugin/easyui/themes/icon.css">
		<script type="text/javascript"
			src="../../../../common/html/plugin/easyui/jquery.min.js"></script>
		<script type="text/javascript"
			src="../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
		<script type="text/javascript"
			src="../../../../common/html/plugin/jquery-hlui-2.0/js/hlui.js"></script>
		<script type="text/javascript"
			src="../../../../common/html/plugin/jquery-hlui-2.0/js/form.js"></script>
		<script type="text/javascript"
			src="../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>

		<script type="text/javascript" src="../js/project.js"></script>
		<link href="../css/main.css" rel="stylesheet" type="text/css" />

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
	<div class="easyui-layout" style="width: 1000px; height: 800px;">
		<div region="west" split="true" title="申报阶段审核" style="width: 300px;">
			<h3>通州区支持产学研合作项目申请书</h3>
			<ul style="padding-left: 50px;">
				<li><a
					href="../../Projectapp/org_info.php?status=<?php echo $table_status?>">&nbsp;&nbsp;&nbsp;&nbsp;1.1
						项目承担单位基本信息</a><span></span></li>
				<li><a
					href="../../Projectapp/project_meaning.php?status=<?php echo $table_status?>">&nbsp;&nbsp;&nbsp;&nbsp;1.2
						项目的目的、意义及必要性</a><span></span></li>
				<li><a
					href="../../Projectapp/project_status.php?status=<?php echo $table_status?>">&nbsp;&nbsp;&nbsp;&nbsp;1.3
						相关行业、领域国内外研究发展现状、趋势以及本单位在相关领域的工作基础</a><span></span></li>
				<li><a
					href="../../Projectapp/project_target.php?status=<?php echo $table_status?>">&nbsp;&nbsp;&nbsp;&nbsp;1.4
						项目任务与目标、考核指标</a><span></span></li>
				<li><a
					href="../../Projectapp/project_content.php?status=<?php echo $table_status?>">&nbsp;&nbsp;&nbsp;&nbsp;1.5
						项目研究开发内容</a><span></span></li>
				<li><a
					href="../../Projectapp/project_techway.php?status=<?php echo $table_status?>">&nbsp;&nbsp;&nbsp;&nbsp;1.6
						项目技术方案与技术路线</a><span></span></li>
				<li><a
					href="../../Projectapp/project_ann_plan.php?status=<?php echo $table_status?>">&nbsp;&nbsp;&nbsp;&nbsp;1.7
						项目各年度任务目标、考核指标及研究开发内容完成的计划进度</a><span></span></li>
				<li><a href="../../total_fund.php">&nbsp;&nbsp;&nbsp;&nbsp;1.8
						项目经费预算</a><span></span></li>
				<li><a
					href="../../Projectapp/project_risk.php?status=<?php echo $table_status?>">&nbsp;&nbsp;&nbsp;&nbsp;1.9
						项目实施的风险分析及规避预案</a><span></span></li>
				<li><a
					href="../../Projectapp/project_expert_form.php?status=<?php echo $table_status?>">&nbsp;&nbsp;&nbsp;&nbsp;1.10
						预期成果形式、知识产权归属与管理</a><span></span></li>
				<li><a
					href="../../Projectapp/project_economy_effect.php?status=<?php echo $table_status?>">&nbsp;&nbsp;&nbsp;&nbsp;1.11
						项目完成后的经济社会效益分析与成果推广方案</a><span></span></li>
				<li><a
					href="../../Projectapp/project_member.php?status=<?php echo $table_status?>">&nbsp;&nbsp;&nbsp;&nbsp;1.12
						项目承担单位、参加单位、项目负责人、项目研究人员</a><span></span></li>
				<li><a
					href="../../Projectapp/project_opinion_promise.php?status=<?php echo $table_status?>">&nbsp;&nbsp;&nbsp;&nbsp;1.13
						签署意见及承诺</a><span></span></li>
			</ul>
			<input type="button" value="同意" onclick="agree()" />
		</div>
		<div id="content" region="center">
			<iframe width="100%" height="100%" frameborder="0" name="center"> </iframe>
		</div>
	</div>
</body>
</html>
