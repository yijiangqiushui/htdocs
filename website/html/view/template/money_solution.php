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

		<script type="text/javascript" src="../js/fruits.js"></script>
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
					href="/website/html/view/template/apply/attach_2/org_info.html"
					target="center">1.1 申报单位基本情况</a></li>
				<li><a
					href="/website/html/view/template/apply/attach_2/coorg_info.html"
					target="center">1.2 合作单位基本情况</a></li>
				<li><a
					href="/website/html/view/template/apply/attach_2/project_info.html"
					target="center">1.3 项目基本情况</a></li>
			</ul>
			<input type="button" value="同意" onclick="agree()" />
		</div>
		<div id="content" region="center">
			<iframe width="100%" height="100%" frameborder="0" name="center"> </iframe>
		</div>
	</div>
</body>
</html>
