<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>无标题文档</title>
<link type="text/css" rel="stylesheet" href="../../css/style.css" />
<link rel="stylesheet" type="text/css"
	href="../../../../../common/html/plugin/easyui/themes/default/easyui.css" />
<link rel="stylesheet" type="text/css"
	href="../../../../../common/html/plugin/easyui/themes/icon.css" />
<script type="text/javascript"
	src="../../../../../common/html/plugin/easyui/jquery.min.js"></script>
<script type="text/javascript"
	src="../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript"
	src="../../../../../common/html/plugin/jquery-hlui-2.0/js/hlui.js"></script>
<script type="text/javascript"
	src="../../../../../common/html/plugin/jquery-hlui-2.0/js/form.js"></script>
<script type="text/javascript"
	src="../../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>
<script type="text/javascript" src="../../../../../common/html/js/tablecommon.js"></script>
<script type="text/javascript"
	src="../../js/acceptance/project_org_suggest.js"></script>
<link rel="stylesheet" type="text/css" href="../../css/table.css" />
<link rel="stylesheet" type="text/css" href="../../css/button.css" />
</head>
<body>
	<form id="project_org_suggest" method="post" action="">

		<div class="project_content" />
		<div class="table_title clearfix">
			<div class="title_pic left">项目总结报告填写</div>
			<div class="right back_pic" id="back"></div>
		</div>
		<div class="table_content back-long">
			<div class="basic_info bg_blue">
				<p class="title_top p-b10">单位意见</p>
				<div class="text_wrap">
					<textarea name="project_org_suggest" id="project_org_suggest"
						class="text_content" placeholder="1.项目主持单位意见
2.项目主持单位意见"></textarea>
				</div>
				<input type="hidden" name="save_display" id="save_display" />
				<div class="button_wrapper clearfix d-n">
					<div class="save">保存</div>
					<!-- <div class="reset" >重置</div> --> 
				</div>
			</div>

		</div>
	</form>
</body>
</html>
