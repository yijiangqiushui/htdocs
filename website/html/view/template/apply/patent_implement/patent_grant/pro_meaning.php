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

<script
	src="../../../../../../../common/html/plugin/datapicker/jquery.daterangepicker.js"></script>
	<script type="text/javascript" src="../../../../../../../common/html/js/tablecommon.js"></script>
<script type="text/javascript" src="../../../../js/apply/patent_grant/pro_meaning.js"></script>

</head>

<body>
	<form id="pro_meaning" method="post">
		<div class="project_content">
			<div class="table_title clearfix">
				<div class="title_pic left">实施主要内容及意义</div>
				<div class="right back_pic" id="back"></div>
			</div>
			<div class="table_content back-long">
				<div class="basic_info bg_blue">

					<p class="title_top p-b10">项目实施主要内容及意义</p>
					<p class="subtitle">
						（包括项目中专利的基本情况、项目的主要内容、关键技术及创新点、技术水平、采取的技术路线或方法、及社会经济意义、实施过程中产生专利的情况等）

					</p>

					<div class="text_wrap">
						<textarea name="project_meaning" id="project_meaning" class="text_content"></textarea>
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
