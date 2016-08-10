<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="../css/apply/attach1/attach1_main.css" rel="stylesheet" type="text/css" />
<script src="../../../../common/html/lib/js/jquery-2.1.0.min.js"></script>
<script type="text/javascript" src="../js/execute_solution.js"></script>
<style>
p {
	font-size: 16px;
}

body {
	height: 100%;
}

input {
	height: 100%;
	width: 100%;
}
</style>
</head>

<body>
<!-- “立项阶段汇总页面” 项目实施方案  -->
<div class="wrapper">
	<div class="body">
	<div class="func-bar">
	</div>
		<div class="menusNiframe">
			<div class="menus">
				<ul style="list-style:none">
                	<div class="menu-bar"><div>项目实施方案</div></div>
					<li class="menu menu-unselected org_info">1.1 项目承担单位基本信息</li>
					<li class="menu menu-unselected project_mean">1.2项目的目的、意义及必要性</li>
					<li class="menu menu-unselected work_base">1.3相关行业、领域国内外研究发展现状、趋势以及本单位在相关领域的工作基础</li>
					<li class="menu menu-unselected project_target">1.4项目任务与目标、考核指标</li>
					<li class="menu menu-unselected project_content">1.5项目研究开发内容</li>
					<li class="menu menu-unselected tech_route">1.6项目技术方案与技术路线</li>
					<li class="menu menu-unselected project_plan">1.7项目各年度任务目标、考核指标及研究开发内容完成的计划进度</li>
					<li class="menu menu-unselected project_budget">1.8项目经费预算</li>   <!-- 这个需要更改一下 -->
					<li class="menu menu-unselected project_risk">1.9项目实施的风险分析及规避预案</li>
					<li class="menu menu-unselected expect_manage">1.10预期成果形式、知识产权归属与管理</li>
					<li class="menu menu-unselected recommend_plan">1.11项目完成后的经济社会效益分析与成果推广方案</li>
					<li class="menu menu-unselected project_member">1.12项目承担单位、参加单位、项目负责人、项目研究人员</li>
					<li class="menu menu-unselected approve">1.13签署意见及承诺</li>
					<li class="menu menu-unselected imp_plan">1.14附件上传</li>
                    <li class="menu menu-unselected centercheck">1.15审核意见</li>
				</ul>
			</div>
			<div class="switch-bar"><div class="switch-bar-arrow"></div></div>
			<div class="iframe"><iframe name="subframe" frameborder="0"></iframe></div>
		</div><!--menusNiframe-->
	</div><!--body-->
</div><!--wrapper-->


<!-- 
	<div class="default_left">
		<div class="menus">
			<h1>立项阶段</h1>
			<ul class="apply">
				<label>一、项目实施方案<span></span></label>
				<!-- <li><a href="Projectapp/project_summary.html">&nbsp;&nbsp;&nbsp;&nbsp;1.1 项目基本信息</a><span></span></li>
				<li><a
					href="Projectapp/org_info.php?status=<?php echo $table_status?>">&nbsp;&nbsp;&nbsp;&nbsp;1.1
						项目承担单位基本信息</a><span></span></li>
				<li><a
					href="Projectapp/project_meaning.php?status=<?php echo $table_status?>">&nbsp;&nbsp;&nbsp;&nbsp;1.2
						项目的目的、意义及必要性</a><span></span></li>
				<li><a
					href="Projectapp/project_status.php?status=<?php echo $table_status?>">&nbsp;&nbsp;&nbsp;&nbsp;1.3
						相关行业、领域国内外研究发展现状、趋势以及本单位在相关领域的工作基础</a><span></span></li>
				<li><a
					href="Projectapp/project_target.php?status=<?php echo $table_status?>">&nbsp;&nbsp;&nbsp;&nbsp;1.4
						项目任务与目标、考核指标</a><span></span></li>
				<li><a
					href="Projectapp/project_content.php?status=<?php echo $table_status?>">&nbsp;&nbsp;&nbsp;&nbsp;1.5
						项目研究开发内容</a><span></span></li>
				<li><a
					href="Projectapp/project_techway.php?status=<?php echo $table_status?>">&nbsp;&nbsp;&nbsp;&nbsp;1.6
						项目技术方案与技术路线</a><span></span></li>
				<li><a
					href="Projectapp/project_ann_plan.php?status=<?php echo $table_status?>">&nbsp;&nbsp;&nbsp;&nbsp;1.7
						项目各年度任务目标、考核指标及研究开发内容完成的计划进度</a><span></span></li>
				<li><a href="total_fund.php">&nbsp;&nbsp;&nbsp;&nbsp;1.8 项目经费预算</a><span></span></li>
				<li><a
					href="Projectapp/project_risk.php?status=<?php echo $table_status?>">&nbsp;&nbsp;&nbsp;&nbsp;1.9
						项目实施的风险分析及规避预案</a><span></span></li>
				<li><a
					href="Projectapp/project_expert_form.php?status=<?php echo $table_status?>">&nbsp;&nbsp;&nbsp;&nbsp;1.10
						预期成果形式、知识产权归属与管理</a><span></span></li>
				<li><a
					href="Projectapp/project_economy_effect.php?status=<?php echo $table_status?>">&nbsp;&nbsp;&nbsp;&nbsp;1.11
						项目完成后的经济社会效益分析与成果推广方案</a><span></span></li>
				<li><a
					href="Projectapp/project_member.php?status=<?php echo $table_status?>">&nbsp;&nbsp;&nbsp;&nbsp;1.12
						项目承担单位、参加单位、项目负责人、项目研究人员</a><span></span></li>
						
				<li><a
					href="Projectapp/project_opinion_promise.php?status=<?php echo $table_status?>">&nbsp;&nbsp;&nbsp;&nbsp;1.13
						签署意见及承诺</a><span></span></li>
					<li><a href="Projectapp/uploadFile.php" > 上传相关附件</a><span></span></li>
  
  

			</ul>
		</div>
	</div>
 -->
</body>
</html>
