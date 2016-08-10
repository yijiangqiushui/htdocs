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
	src="../../../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript"
	src="../../../../../../../common/html/plugin/easyui/jquery.cookie.js"></script>
<script type="text/javascript"
	src="../../../../../../../common/html/plugin/jquery-hlui-2.0/js/hlui.js"></script>
<script type="text/javascript"
	src="../../../../../../../common/html/plugin/jquery-hlui-2.0/js/form.js"></script>
<script type="text/javascript" src="../../../../../../../common/html/js/validation.js"></script>
<script type="text/javascript"
	src="../../../../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>
<script type="text/javascript" src="../../../../../../../common/html/js/tablecommon.js"></script>
	<script type="text/javascript"
	src="../../../../js/check_material/talent_training.js"></script>

</head>

<body>
	<form id="talent_training" method="post">
		<div class="project_content">
			<div class="table_title clearfix">
				<div class="title_pic left">专利实施验收报告书</div>
				<div class="right back_pic" id="back"></div>
			</div>

			<div class="table_content back-long">
				<table cellspacing="0" cellpadding="0" class="basic_info">
					<tr>
						<td colspan="6" class="border_left_none"
							style="background-color: #7AB5ED;">
							<div class="title_top p-b10">项目实施过程中企业研发新专利、开发新产品情况</div>
						</td>
					</tr>
					<tr>
						<th></th>
						<th><p align="center">技术培训</p></th>
						<th><p align="center">管理培训</p></th>
						<th><p align="center">合计</p></th>
					</tr>

					<tr>
						<th ><p align="center">人数（人次）</p></th>
						<td><input name="tec_num" id="tec_num"  datatype="number" placeholder='请输入整数'/></td>
						<td><input name="manage_num" id="manage_num"  datatype="number" placeholder='请输入整数'/></td>
						<td><input  id="total_person" name="total_person" placeholder='无需输入，自动计算' readonly="readonly" /></td>
					</tr>
					<tr>
						<th ><p align="center">课时数</p></th>
						<td><input name=tec_hour id="tec_hour" datatype="number" placeholder='请输入整数'/></td>
						<td><input name="manage_hour"  id="manage_hour" datatype="number" placeholder='请输入整数'/></td>
						<td><input name="total_class" name="total_class" placeholder='无需输入，自动计算' readonly="readonly" /></td>
					</tr>
				</table>
				<div class="button_wrapper clearfix d-n">
					<div class="save">保存</div>
					<!-- <div class="reset" >重置</div> -->
				</div>
			</div>

		</div>
	</form>
<script type="application/javascript">
	$('#tec_num').bind('input propertychange', do_change);
	$('#manage_num').bind('input propertychange', do_change);
	$('#tec_hour').bind('input propertychange', do_change);
	$('#manage_hour').bind('input propertychange', do_change);


	function do_change() {
		$("input[name='total_person']").val(wt_add($('#tec_num').val(), $('#manage_num').val()));
		$("input[name='total_class']").val(wt_add($('#tec_hour').val(), $('#manage_hour').val()));
	}
</script>

</body>
</html>
