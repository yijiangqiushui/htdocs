<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>

<link rel="stylesheet" type="text/css"
	href="../../../../../../../common/html/plugin/easyui/themes/default/easyui.css" />
<link rel="stylesheet" type="text/css"
	href="../../../../../../../common/html/plugin/easyui/themes/icon.css" />
<link rel="stylesheet" type="text/css" href="../../../../css/table.css" />
<link rel="stylesheet" type="text/css" href="../../../../css/button.css" />
<link rel="stylesheet"
	href="../../../../../../../common/html/lib/css/datapicker/daterangepicker.css" />

<script src="../../../../../../../common/html/lib/js/jquery-1.11.2.min.js"></script>
<script
	src="../../../../../../../common/html/plugin/datapicker/moment.min.js"></script>

<script type="text/javascript"
	src="../../../../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>
<script type="text/javascript"
	src="../../../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript"
	src="../../../../../../../common/html/plugin/easyui/jquery.cookie.js"></script>
<script type="text/javascript"
	src="../../../../../../../common/html/plugin/jquery-hlui-2.0/js/hlui.js"></script>
<script type="text/javascript"
	src="../../../../../../../common/html/plugin/jquery-hlui-2.0/js/form.js"></script>

<scriptm src="../../../../../../../common/html/plugin/datapicker/jquery.daterangepicker.js"></script>
<script type="text/javascript" src="../../../../../../../common/html/js/piccommon.js"></script>
<script type="text/javascript" src="../../../../../../../common/html/js/attachcommon.js"></script>
<script type="text/javascript" src="../../../../../../../common/html/js/tablecommon.js"></script>
<script type="text/javascript" src="../../../../js/apply/patent_grant/pro_belong.js"></script>

</head>

<body>
	<form id="pro_belong" method="post">
		<div class="project_content">
			<div class="table_title clearfix">
				<div class="title_pic left">成果形式和产权归属</div>
				<div class="right back_pic" id="back"></div>
			</div>
			<div class="table_content back-long">
				<div class="basic_info bg_blue">

					<p class="title_top p-b10">项目预期成果提供形式、知识产权归属</p>
					

					<div class="text_wrap">
						<textarea name="task_project_expect" id="task_project_expect" class="text_content"></textarea>
					</div>
					<input type="hidden" name="save_display" id="save_display" />
					<div class="button_wrapper clearfix d-n">
						<div class="save">保存</div>
						<!-- <div class="reset" >重置</div> -->
					</div>
				</div>
			</div>
		</div>

	</form>


</body>
</html>
