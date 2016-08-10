<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>申报单位基本情况</title>

<link rel="stylesheet" type="text/css" href="../../../../../../../common/html/plugin/easyui/themes/default/easyui.css"></link>
<link rel="stylesheet" type="text/css" href="../../../../../../../common/html/plugin/easyui/themes/icon.css" />
<link rel="stylesheet" type="text/css" href="../../../../css/table.css"/>
<link rel="stylesheet" type="text/css" href="../../../../css/button.css" />

<script type="text/javascript" src="../../../../../../../common/html/plugin/easyui/jquery.min.js"></script>
<script type="text/javascript" src="../../../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="../../../../../../../common/html/plugin/jquery-hlui-2.0/js/hlui.js"></script>
<script type="text/javascript" src="../../../../../../../common/html/plugin/jquery-hlui-2.0/js/form.js"></script>
<script type="text/javascript" src="../../../../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>

<script type="text/javascript" src="../../../../../../../common/html/js/validation.js"></script>
<script type="text/javascript" src="../../../../../../../common/html/js/tablecommon.js"></script>
<script type="text/javascript" src="../../../../js/apply/attach3_patent/project_fund.js"></script>
<style>
select{
	font-family: "Helvetica Neue", Helvetica, Arial, sans-serif !important;
	font-size: 14px;
	margin: auto 0;
	text-align: center;
	width:100%;
	float:left;
	height:99%;
	margin: 0 auto;
	padding: 0 auto ;
	background-color: #D1E4F3;
	
}

tr:nth-child(even) select {
	font-family: "Helvetica Neue", Helvetica, Arial, sans-serif !important;
	font-size: 14px;
	margin: auto 0;
	text-align: center;
	width:100%;
	float:left;
	height:99%;
	margin: 0 auto;
	padding: 0 auto ;
	background-color: #EAF3FA;
}
option {
	font-style:inherit;
	font-size:16px;
	margin: 0 auto;
	padding: 0 auto ;
	background-color: #EAF3FA;
}
</style>

</head>
<body>
	<form method="post" id="project_fund">
	<div class="project_content">
		<div class="table_title clearfix">
			<div class="title_pic left">专利实施项目申报书</div>
			<div class="right back_pic" id="back"></div>
		</div>
			<div class="table_content back-long">
            <table cellspacing="0" cellpadding="0" class="basic_info">
				<tr>
                    <td colspan="6" class="border_left_none" style="background-color:#7AB5ED;">
                        <div class="title_top p-b10">三、项目资金情况</div>
					</td>
				</tr>
				
				<tr>
					<th rowspan="4"><p align="center">计划投资总额（万元）</p></th>
					<td rowspan="4"><input name="invest_total" type="text" datatype="float" placeholder="计划投资总额为后两项之和" /></td>
				    <th rowspan="2"><p align="center">已完成投资额（万元）</p></th>
					<td rowspan="2" width='200px'><input name="invested" type="text" datatype="float" placeholder="已完成投资额需大于后两项之和"     /></td>
					<th ><p align="center">其中银行贷款（万元）</p></th>
					<td ><input name="invested_bank" type="text"  datatype="float" value='0' class="change" placeholder="请输入整数或小数" /></td>
				</tr>
				
				<tr>
					<th ><p align="center">其中政府资助（万元）</p></th>
					<td ><input name="invested_gov" type="text" datatype="float" value='0'  class="change"  placeholder="请输入整数或小数" /></td>
				</tr>
				
				<tr>
				    <th rowspan="2"><p align="center">计划新增投资额（万元）</p></th>
					<td rowspan="2"><input name="planadd" type="text" datatype="float"  placeholder="计划新增投资额为后两项之和"    /></td>
					<th ><p align="center">固定资产投资（万元）</p></th>
					<td ><input name="planadd_bank" type="text" datatype="float" value='0'   class="change" placeholder="请输入整数或小数"  /></td>
				</tr>
				
				<tr>
					<th ><p align="center">流动资金投资（万元）</p></th>
					<td ><input name="planadd_gov" type="text" datatype="float" value='0'  class="change" placeholder="请输入整数或小数" /></td>
				</tr>
				
				
				<tr>
					<th rowspan="5"><p align="center">计划新增投资来源<br/>(“企业自有,银行贷款,财政拨款,其他 ”四项之和应与计划新增投资额相等)</p></th>
					<th ><p align="center">企业自有（万元）</p></th>
					<td colspan="4"><input name="planaddsrc_com" type="text" datatype="float" value='0'  placeholder="请输入整数或小数"  /></td>
				</tr>
				
				<tr>
					<th ><p align="center">银行贷款（万元）</p></th>
					<td colspan="4"><input name="planaddsrc_bank" type="text" datatype="float" value='0'  placeholder="请输入整数或小数"  /></td>
				</tr>
				
				<tr>
					<th rowspan="2"><p align="center">财政拨款（万元）</p></th>
					<td rowspan="2"><input name="planaddsrc_fin" type="text" datatype="float" placeholder="财政拨款为后两项之和"  /></td>
					<th colspan="2"><p align="center">其中专项实施资金（万元）</p></th>
					<td ><input name="planaddsrc_finpat" type="text" datatype="float" value='0'  placeholder="请输入整数或小数"  /></td>
				</tr>

				<tr>
					<th colspan="2"><p align="center">其他财政拨款（万元）</p></th>
					<td ><input name="planaddsrc_finother" type="text" datatype="float" value='0'  placeholder="请输入整数或小数"  /></td>
				</tr>
				<tr>
					<th ><p align="center">其他（万元）</p></th>
					<td colspan="4"><input name="planaddsrc_othe" type="text" datatype="float" value='0'  placeholder="请输入整数或小数"  /></td>
				</tr>
				
				
				<tr>
					<th ><p align="center">申请专利实施资金主要用途</p></th>
<!-- 					<td > -->
<!-- 						<select name="patent_use" > -->
<!-- 							<option value="知识产权费用">知识产权费用</option> -->
<!-- 							<option value="新产品开发及试制"  >新产品开发及试制</option> -->
<!-- 							<option value="购置生产用配套仪器设备">购置生产用配套仪器设备</option> -->
<!-- 							<option value="贷款贴息">贷款贴息</option> -->

<!-- 						</select> -->
<!-- 					</td> -->
<!-- 					<td colspan="4"> -->
<!-- 					</td> -->
					<td><input type="checkbox"  name = 'checkbox1' value = '知识产权费用' style='width:20px;'/><p style = 'width:120px; margin-top:10px;'>知识产权费用</p></td>
					<td><input type="checkbox"  name = 'checkbox2' value = '新产品开发及试制' style='width:20px;'/><p style = 'width:150px; margin-top:10px;'>新产品开发及试制</p></td>
					<td><input type="checkbox"  name = 'checkbox3' value = '购置生产用配套仪器设备' style='width:20px;'/><p style = 'margin-top:10px;'>购置生产用配套仪器设备</p></td>
					<td><input type="checkbox"  name = 'checkbox4' value = '贷款贴息' style='width:20px;'/><p style = 'width:100px; margin-top:10px;'>贷款贴息</p ></td>
					<td></td>
				</tr>
	
			</table>
			 <div class="button_wrapper clearfix">
       			<div class="save">保存</div>
       			<!-- <div class="reset" >重置</div> -->
			</div> 
		</div>
		</div>
		</form>
<script type="application/javascript">
	$invested_bank = $("input[name='invested_bank']");
	$invested_gov = $("input[name='invested_gov']");
	$planadd_bank = $("input[name='planadd_bank']");
	$planadd_gov = $("input[name='planadd_gov']");

	$invest_total = $("input[name='invest_total']");
	$invested = $("input[name='invested']");
	$planadd = $("input[name='planadd']");

	$invested_bank.change(function() {
		do_change1();
	});
	$invested_gov.change(function() {
		do_change1();
	});
	$planadd_bank.change(function() {
		do_change1();
	});
	$planadd_gov.change(function() {
		do_change1();
	});

	$invested.change(do_change1);

	function do_change1() {
		var total1 = $invested.val();
		var total2 = wt_add($planadd_bank.val(), $planadd_gov.val());
		$invested.val(total1);
		$planadd.val(total2);
		var total = wt_add(total1, total2);
		$invest_total.val(total);
	}


	$planaddsrc_finpat = $("input[name='planaddsrc_finpat']");
	$planaddsrc_finother = $("input[name='planaddsrc_finother']");
	$planaddsrc_fin = $("input[name='planaddsrc_fin']");

	$planaddsrc_finpat.change(do_change2);
	$planaddsrc_finother.change(do_change2);

	function do_change2() {
		$planaddsrc_fin.val(wt_add($planaddsrc_finpat.val(), $planaddsrc_finother.val()));
	}
</script>
</body>
</html>
