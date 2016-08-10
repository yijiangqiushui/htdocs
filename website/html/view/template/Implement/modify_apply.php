<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link type="text/css" rel="stylesheet" href="../../css/style.css"/>
<link rel="stylesheet" type="text/css" href="../../../../../common/html/plugin/easyui/themes/default/easyui.css" />
<link rel="stylesheet" type="text/css" href="../../../../../common/html/plugin/easyui/themes/icon.css" />
<link rel="stylesheet" type="text/css" href="../../css/table.css" />
<link rel="stylesheet" type="text/css" href="../../css/button.css" />

<script type="text/javascript" src="../../../../../common/html/js/datecommon.js"></script>

<script type="text/javascript" src="../../../../../common/html/plugin/easyui/jquery.cookie.js"></script>
<!-- <script src="../../../../../common/html/lib/js/jquery-1.11.2.min.js"></script> -->
<script type="text/javascript"
	src="../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript"
	src="../../../../../common/html/plugin/jquery-hlui-2.0/js/hlui.js"></script>
<script type="text/javascript"
	src="../../../../../common/html/plugin/jquery-hlui-2.0/js/form.js"></script>
<script type="text/javascript"
	src="../../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>
<script type="text/javascript" src="../../../../../common/html/js/validation.js"></script>
 <script type="text/javascript" src="../../../../../common/html/js/tablecommon.js"></script>
<script type="text/javascript" src="../../js/implement/modify_apply.js"></script>

<style type="text/css">
td {
	text-align: center;
	border: 1px solid #ffffff;
	line-height: 30px;
}

.text_content {
	width: 90%;
	height: 200px;
	margin-top: 10px;
	margin-bottom: 10px;
	font-size:14px;
}
</style>

</head>

<body>
	<form id="modify_apply" method="post">
		<div class="project_content">
			<div class="table_title clearfix">
				<div class="title_pic left">项目调整申请填写</div>
				<div class="right back_pic" id="back"></div>
			</div>

			<div class="table_content back-long">
				<table cellspacing="0" cellpadding="0" class="basic_info">
					<tr>
						<td colspan="5" class="border_left_none"
							style="background-color: #7AB5ED;">
							<div class="title_top p-b10">项目调整申请信息</div>
						</td>
					</tr>
					<tr>
						<th><p align="center">项目名称</p></th>
						<td colspan="4"><input name="project_name" type="text" /></td>
					</tr>
<!-- 					 <tr>
						<th><p align="center">承担单位</p></th>
						<td colspan="4"><input name="org_name" type="text" readonly /></td>
					</tr> -->
					<tr>
						<th><p align="center">开始时间</p></th>
						<td ><input name="start_time" id="start_time" class='dateplu' readonly/></td>
						<th style='text-align: center; width:190px;'>结束时间</th>
						<td colspan="3"><input name="end_time" id="end_time" class='dateplu' readonly/></td>
					</tr>
					<tr>
						<th rowspan="2">项目经费</th>
						<th rowspan="2">总经费</th>
						<td rowspan="2" ><input type="text" style="width: 70%;float: left" name="project_money" placeholder="无需填写" class="float" readonly/>万元 </td>
						<th>财政经费</th>
						<td><input type="text"  name="finmoney" style="width: 70%;float: left" datatype="float"　 class="tofixed"   class='border_none'/>万元 </td>
					</tr>
					<tr>
						<th>其它经费</th>
						<td><input type="text"  name="othermoney" datatype="float" style="width: 70%;float: left" 　class="tofixed"     class='border_none'/>万元 </td>
					</tr>
					<tr>
						<th><p align="center">申请调整内容</p></th>
						<td colspan="4"><textarea name="modify_content" class="text_content" placeholder="该栏目由调整申请单位填写！" ></textarea></td>
					</tr>
					<tr>
						<th><p align="center">调整理由说明</p></th>
						<td colspan="4"><textarea name="modify_reason" class="text_content" placeholder="该栏目由调整申请单位填写！" ></textarea> </td>
					</tr>
					<tr>
						<th><p align="center">承担单位意见</p></th>
						<td colspan="4"><textarea name="org_suggest" id="no" class="text_content" 
							></textarea> <!-- 	placeholder="该栏目由审批单位填写，项目调整申请人勿填！"  -->
					</tr>
					<tr>
						<th><p align="center">备注</p></th>
						<td colspan="4"><textarea name="remark" class="text_content"
								placeholder="若无备注信息请填写:无备注事项"></textarea></td>
					</tr>
				</table>

				<input type="hidden" name="save_display" id="save_display" />
				<div class="button_wrapper clearfix d-n">
					<div class="save" onclick='saveApplys();'>保存</div>
				</div>
			</div>

		</div>
	</form>
<script type="application/javascript">
	$finmoney = $("input[name='finmoney']");
	$othermoney = $("input[name='othermoney']");
	$project_money = $("input[name='project_money']");

	$finmoney.change(function() {
		do_change();
	});
	$othermoney.change(function() {
		do_change();
	});

	function do_change() {
		$project_money.val(wt_add($finmoney.val(), $othermoney.val()));
	}

</script>
</body>
</html>
