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
<link rel="stylesheet" type="text/css" href="../../../../css/apply/patent_grant/patent_grant.css"/>

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
	<script type="text/javascript" src="../../../../../../../common/html/js/tablecommon.js"></script>
<script type="text/javascript"
	src="../../../../js/apply/patent_grant/pro_target.js"></script>

</head>

<body>
	<form id="pro_target" method="post">
		<div class="project_content">
			<div class="table_title clearfix">
				<div class="title_pic left">实施目标及考核指标</div>
				<div class="right back_pic" id="back"></div>
			</div>
			<div class="table_content back-long">
				<div class="basic_info bg_blue">

					<p class="title_top p-b10">项目的实施目标及考核指标（具有明确的可考核性）</p>
					<div style="text-align: left" class="subtitle">
						〔包括  1、主要经济指标：如项目实施过程中所形成的市场规模、效益（包括销售收入、上缴税收、利润等）；
						          2、主要技术指标：如项目实施过程中形成的新专利、标准、论文专著等数量及其水平等；
						          3、项目实施过程所产生的社会效益；
						          4、其他指标〕
					</div>

					<div class="text_wrap">
						<textarea name="task_project_kpi" id="pro_target" class="text_content"></textarea>
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
