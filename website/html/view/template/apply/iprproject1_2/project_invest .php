<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>

<link rel="stylesheet" type="text/css"
	href="../../../../../../common/html/plugin/easyui/themes/default/easyui.css" />
<link rel="stylesheet" type="text/css"
	href="../../../../../../common/html/plugin/easyui/themes/icon.css" />
<script type="text/javascript"
	src="../../../../../../center/html/view/js/jquery-1.11.2.min.js"></script>
<script type="text/javascript"
	src="../../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript"
	src="../../../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>

<script type="text/javascript"
	src="../../../js/apply/iprproject1_2/project_invest.js"></script>
<style type="text/css">
input class ="easyui-validatebox" required ="true"{
	width: 99.5%;
	border: 1px;
}

td {
	height: 35px;
	text-align: left;
}

body {
	font-family: "微软雅黑";
	margin: auto 0;
	font-size: 16px;
}

div {
	text-align: center;
	margin: auto 0;
	line-height: 100%;
}

table {
	margin: 0 auto;
	border: 1px solid black;
	font-size: 14px;
	width: 50%;
}

table table {
	width: 100%;
}
</style>
</head>

<body>
	<div class="easyui-panel" style="border: 0;">
		<form method="post" id="project_invest">
			<table width="500" height="291" border="1" cellspacing="0">
				<tr>
					<td colspan="6"><h2>三、项目资金情况</h2></td>
				</tr>
				<tr>
					<td width="71" rowspan="4"><p>计划</p>
						<p>投资</p>
						<p>总额</p></td>
					<td width="94" rowspan="4"><input class="easyui-validatebox"
						required="true" type="text" name="invest_total" /></td>
					<td width="98" rowspan="2">已完成投资</td>
					<td width="85" rowspan="2"><input class="easyui-validatebox"
						required="true" type="text" name="invested" /></td>
					<td width="95" height="35">其中银行贷款</td>
					<td width="131"><input class="easyui-validatebox" required="true"
						type="text" name="invested_bank" /></td>
				</tr>
				<tr>
					<td height="35">其中政府资助</td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="invested_gov" /></td>
				</tr>
				<tr>
					<td rowspan="2" height="35">计划新增投资额</td>
					<td rowspan="2" height="35"><input class="easyui-validatebox"
						required="true" type="text" name="planadd" /></td>
					<td height="35">固定资产</td>
					<td height="35"><input class="easyui-validatebox" required="true"
						type="text" name="planadd_bank" /></td>
				</tr>
				<tr>
					<td height="35">流动资金投资</td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="planadd_gov" /></td>
				</tr>
				<tr>
					<td rowspan="4">计划新增投资来源</td>
					<td height="35">企业自有</td>
					<td colspan="2"><input class="easyui-validatebox" required="true"
						type="text" name="planaddsrc_com" /></td>
					<td>银行贷款</td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="planaddsrc_bank" /></td>
				</tr>
				<tr>
					<td rowspan="2">政府拨款</td>
					<td rowspan="2"><input class="easyui-validatebox" required="true"
						type="text" name="planaddsrc_fin" /></td>
					<td colspan="2" height="35">其中专利实施资金</td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="planaddsrc_finpat" /></td>
				</tr>
				<tr>
					<td colspan="2" height="35">其他财政拨款</td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="planaddsrc_finother" /></td>
				</tr>
				<tr>
					<td>其他</td>
					<td colspan="4" height="35"><input class="easyui-validatebox"
						required="true" type="text" name="planaddsrc_other" /></td>
				</tr>
				<tr>
					<td height="66">申请专利实施资金主要用途</td>
					<td colspan="5"><input class="easyui-validatebox" required="true"
						type="radio" name="patent_use" value="0">1.新产品开发及试制 </input class="easyui-validatebox" required="true">
						<input class="easyui-validatebox" required="true" type="radio"
						name="patent_use" value="1"> 2.购置生产用配套仪器设备</input class="easyui-validatebox" required="true">
						<input class="easyui-validatebox" required="true" type="radio"
						name="patent_use" value="2">3.贷款贴息 </input class="easyui-validatebox" required="true">
						<input class="easyui-validatebox" required="true" type="radio"
						name="patent_use" value="3">4.知识产权费用</input class="easyui-validatebox" required="true">
					</td>
				</tr>
			</table>
			<a href="javascript:void(0);" class="easyui-linkbutton"
				iconcls="icon-ok" onclick="submitdata()">确定</a> <a
				href="javascript:void(0);" class="easyui-linkbutton"
				iconcls="icon-no" onclick="reset()">重置</a>
		</form>
	</div>

</body>
</html>
