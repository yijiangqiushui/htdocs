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
	href="../../../../../../common/html/plugin/easyui/themes/default/easyui.css" />
<link rel="stylesheet" type="text/css"
	href="../../../../../../common/html/plugin/easyui/themes/icon.css" />
<link rel="stylesheet" type="text/css" href="../../../css/table.css" />
<link rel="stylesheet" type="text/css" href="../../../css/button.css" />
<link rel="stylesheet"
	href="../../../../../../common/html/lib/css/datapicker/daterangepicker.css" />

<script src="../../../../../../common/html/lib/js/jquery-1.11.2.min.js"></script>
<script
	src="../../../../../../common/html/plugin/datapicker/moment.min.js"></script>

<script type="text/javascript"
	src="../../../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>
<script type="text/javascript"
	src="../../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript"
	src="../../../../../../common/html/plugin/easyui/jquery.cookie.js"></script>
<script type="text/javascript"
	src="../../../../../../common/html/plugin/jquery-hlui-2.0/js/hlui.js"></script>
<script type="text/javascript"
	src="../../../../../../common/html/plugin/jquery-hlui-2.0/js/form.js"></script>

<script
	src="../../../../../../common/html/plugin/datapicker/jquery.daterangepicker.js"></script>
<script type="text/javascript" src="../../../../../../common/html/js/tablecommon.js"></script>
<script type="text/javascript"
	src="../../../js/projectapp/genious_info.js"></script>

</head>
<body>
	<div class="wt_box">

		<div style="width: 100%; height: 100%; border: 1px;">
			<form method="post" id="total_funds">

				<div class="project_content">
					<div class="table_title clearfix">
						<div class="title_pic left">专利验收报告书</div>
						<div class="right back_pic" id="back"></div>
					</div>
					<div class="table_content back-long">
						<table cellspacing="0" cellpadding="0" class="basic_info">
							<tr>
								<td colspan=10 style="background-color: #7AB5ED; height: 20px;">
									<div class="title_top p-b10">项目经费总预算
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 单位：万元</div>
								</td>
							</tr>
							<tr>
								<th colspan="2">实施年度</th>
								<th colspan="2">年</th>
								<th colspan="2">年</th>
								<th colspan="2">年</th>
								<th colspan="1">合 计</th>
							</tr>
							<tr>
								<th colspan="2">经费总额</th>
								<td colspan="2" class=""><input name="" class="" type="text" /></td>
								<td colspan="2" class=""><input name="" class="" type="text" /></td>
								<td colspan="2" class=""><input name="" class="" type="text" /></td>
								<td colspan="1" class=""><input name="" class="" type="text" /></td>
							</tr>
							<tr>
								<th colspan="9">1、项目经费来源与支出&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;单位：万元</th>
							</tr>
							<tr>
								<th colspan="3">(1)项目经费来源：</th>
								<th colspan="1" class="" style="width: 150px">年</th>
								<th colspan="1" class="" style="width: 150px">年</th>
								<th colspan="1" class="" style="width: 150px">年</th>
								<th colspan="3" class="" style="width: 150px">合 计</th>
							</tr>
							<tr>
								<th colspan="3">区专利实施经费</th>
								<td colspan="1" class=""><input name="" class="" type="text" /></td>
								<td colspan="1" class=""><input name="" class="" type="text" /></td>
								<td colspan="1" class=""><input name="" class="" type="text" /></td>
								<td colspan="3" class=""><input name="" class="" type="text" /></td>
							</tr>
							<tr>
								<th rowspan="4" colspan="2">其他来源</th>
								<th rowspan="1">市级以上</th>
								<td colspan="1" class=""><input name="" class="" type="text" /></td>
								<td colspan="1" class=""><input name="" class="" type="text" /></td>
								<td colspan="1" class=""><input name="" class="" type="text" /></td>
								<td colspan="3" class=""><input name="" class="" type="text" /></td>
							</tr>
							<tr>
								<th rowspan="1">单位自筹</th>
								<td colspan="1" class=""><input name="" class="" type="text" /></td>
								<td colspan="1" class=""><input name="" class="" type="text" /></td>
								<td colspan="1" class=""><input name="" class="" type="text" /></td>
								<td colspan="3" class=""><input name="" class="" type="text" /></td>
							</tr>
							<tr>
								<th rowspan="1">银行贷款</th>
								<td colspan="1" class=""><input name="" class="" type="text" /></td>
								<td colspan="1" class=""><input name="" class="" type="text" /></td>
								<td colspan="1" class=""><input name="" class="" type="text" /></td>
								<td colspan="3" class=""><input name="" class="" type="text" /></td>
							</tr>
							<tr>
								<th rowspan="1">其他</th>
								<td colspan="1" class=""><input name="" class="" type="text" /></td>
								<td colspan="1" class=""><input name="" class="" type="text" /></td>
								<td colspan="1" class=""><input name="" class="" type="text" /></td>
								<td colspan="3" class=""><input name="" class="" type="text" /></td>
							</tr>
							<tr>
								<th colspan="3">合计</th>
								<td colspan="1" class=""><input name="" class="" type="text" /></td>
								<td colspan="1" class=""><input name="" class="" type="text" /></td>
								<td colspan="1" class=""><input name="" class="" type="text" /></td>
								<td colspan="3" class=""><input name="" class="" type="text" /></td>
							</tr>
							<tr>
								<th colspan="9">（2）项目经费支出：</th>
							</tr>
							<tr>
								<th colspan="4" style="width: 400px">科 目</th>
								<th>经费来源</th>
								<th>年</th>
								<th>年</th>
								<th>年</th>
								<th>合计</th>
							</tr>
							<tr>
								<th rowspan="2" colspan="4">设备费</th>
								<th>区财政科技经费</th>
								<td><input type="text" name="teach_budget_fund[0]"
									datatype="float" /></td>
								<td><input type="text" name="teach_reduce_fund[0]"
									datatype="float" /></td>
								<td><input type="text" name="teach_adjust_fund[0]"
									datatype="float" /></td>
								<td><input type="text" name="teach_actual_fund[0]"
									datatype="float" /></td>
							</tr>
							<tr>
								<th>其他来源</th>
								<td><input type="text" name="other_budget_fund[0]"
									datatype="float" /></td>
								<td><input type="text" name="other_reduce_fund[0]"
									datatype="float" /></td>
								<td><input type="text" name="other_adjust_fund[0]"
									datatype="float" /></td>
								<td><input type="text" name="other_actual_fund[0]"
									datatype="float" /></td>
							</tr>
							<tr>
								<th rowspan="2" colspan="4">材料费</th>
								<th>区财政科技经费</th>
								<td><input type="text" name="teach_budget_fund[1]"
									datatype="float" /></td>
								<td><input type="text" name="teach_reduce_fund[1]"
									datatype="float" /></td>
								<td><input type="text" name="teach_adjust_fund[1]"
									datatype="float" /></td>
								<td><input type="text" name="teach_actual_fund[1]"
									datatype="float" /></td>
							</tr>
							<tr>
								<th>其他来源</th>
								<td><input type="text" name="other_budget_fund[1]"
									datatype="float" /></td>
								<td><input type="text" name="other_reduce_fund[1]"
									datatype="float" /></td>
								<td><input type="text" name="other_adjust_fund[1]"
									datatype="float" /></td>
								<td><input type="text" name="other_actual_fund[1]"
									datatype="float" /></td>
							</tr>
							<tr>
								<th rowspan="2" colspan="4">测试化验加工费</th>
								<th>区财政科技经费</th>
								<td><input type="text" name="teach_budget_fund[2]"
									datatype="float" /></td>
								<td><input type="text" name="teach_reduce_fund[2]"
									datatype="float" /></td>
								<td><input type="text" name="teach_adjust_fund[2]"
									datatype="float" /></td>
								<td><input type="text" name="teach_actual_fund[2]"
									datatype="float" /></td>
							</tr>
							<tr>
								<th>其他来源</th>
								<td><input type="text" name="other_budget_fund[2]"
									datatype="float" /></td>
								<td><input type="text" name="other_reduce_fund[2]"
									datatype="float" /></td>
								<td><input type="text" name="other_adjust_fund[2]"
									datatype="float" /></td>
								<td><input type="text" name="other_actual_fund[2]"
									datatype="float" /></td>
							</tr>
							<tr>
								<th rowspan="2" colspan="4">燃料动力费</th>
								<th>区财政科技经费</th>
								<td><input type="text" name="teach_budget_fund[3]"
									datatype="float" /></td>
								<td><input type="text" name="teach_reduce_fund[3]"
									datatype="float" /></td>
								<td><input type="text" name="teach_adjust_fund[3]"
									datatype="float" /></td>
								<td><input type="text" name="teach_actual_fund[3]"
									datatype="float" /></td>
							</tr>
							<tr>
								<th>其他来源</th>
								<td><input type="text" name="other_budget_fund[3]"
									datatype="float" /></td>
								<td><input type="text" name="other_reduce_fund[3]"
									datatype="float" /></td>
								<td><input type="text" name="other_adjust_fund[3]"
									datatype="float" /></td>
								<td><input type="text" name="other_actual_fund[3]"
									datatype="float" /></td>
							</tr>
							<tr>
								<th rowspan="2" colspan="4">国际合作与交流费</th>
								<th>区财政科技经费</th>
								<td><input type="text" name="teach_budget_fund[4]"
									datatype="float" /></td>
								<td><input type="text" name="teach_reduce_fund[4]"
									datatype="float" /></td>
								<td><input type="text" name="teach_adjust_fund[4]"
									datatype="float" /></td>
								<td><input type="text" name="teach_actual_fund[4]"
									datatype="float" /></td>
							</tr>
							<tr>
								<th>其他来源</th>
								<td><input type="text" name="other_budget_fund[4]"
									datatype="float" /></td>
								<td><input type="text" name="other_reduce_fund[4]"
									datatype="float" /></td>
								<td><input type="text" name="other_adjust_fund[4]"
									datatype="float" /></td>
								<td><input type="text" name="other_actual_fund[4]"
									datatype="float" /></td>
							</tr>
							<tr>
								<th rowspan="2" colspan="4">差旅费</th>
								<th>区财政科技经费</th>
								<td><input type="text" name="teach_budget_fund[5]"
									datatype="float" /></td>
								<td><input type="text" name="teach_reduce_fund[5]"
									datatype="float" /></td>
								<td><input type="text" name="teach_adjust_fund[5]"
									datatype="float" /></td>
								<td><input type="text" name="teach_actual_fund[5]"
									datatype="float" /></td>
							</tr>
							<tr>
								<th>其他来源</th>
								<td><input type="text" name="other_budget_fund[5]"
									datatype="float" /></td>
								<td><input type="text" name="other_reduce_fund[5]"
									datatype="float" /></td>
								<td><input type="text" name="other_adjust_fund[5]"
									datatype="float" /></td>
								<td><input type="text" name="other_actual_fund[5]"
									datatype="float" /></td>
							</tr>
							<tr>
								<th rowspan="2" colspan="4">会议费</th>
								<th>区财政科技经费</th>
								<td><input type="text" name="teach_budget_fund[6]"
									datatype="float" /></td>
								<td><input type="text" name="teach_reduce_fund[6]"
									datatype="float" /></td>
								<td><input type="text" name="teach_adjust_fund[6]"
									datatype="float" /></td>
								<td><input type="text" name="teach_actual_fund[6]"
									datatype="float" /></td>
							</tr>
							<tr>
								<th>其他来源</th>
								<td><input type="text" name="other_budget_fund[6]"
									datatype="float" /></td>
								<td><input type="text" name="other_reduce_fund[6]"
									datatype="float" /></td>
								<td><input type="text" name="other_adjust_fund[6]"
									datatype="float" /></td>
								<td><input type="text" name="other_actual_fund[6]"
									datatype="float" /></td>
							</tr>
							<tr>
								<th rowspan="2" colspan="4">档案出版、文献信息传播、知识产权事务费</th>
								<th>区财政科技经费</th>
								<td><input type="text" name="teach_budget_fund[7]"
									datatype="float" /></td>
								<td><input type="text" name="teach_reduce_fund[7]"
									datatype="float" /></td>
								<td><input type="text" name="teach_adjust_fund[7]"
									datatype="float" /></td>
								<td><input type="text" name="teach_actual_fund[7]"
									datatype="float" /></td>
							</tr>
							<tr>
								<th>其他来源</th>
								<td><input type="text" name="other_budget_fund[7]"
									datatype="float" /></td>
								<td><input type="text" name="other_reduce_fund[7]"
									datatype="float" /></td>
								<td><input type="text" name="other_adjust_fund[7]"
									datatype="float" /></td>
								<td><input type="text" name="other_actual_fund[7]"
									datatype="float" /></td>
							</tr>
							<tr>
								<th rowspan="2" colspan="4">劳务费</th>
								<th>区财政科技经费</th>
								<td><input type="text" name="teach_budget_fund[8]"
									datatype="float" /></td>
								<td><input type="text" name="teach_reduce_fund[8]"
									datatype="float" /></td>
								<td><input type="text" name="teach_adjust_fund[8]"
									datatype="float" /></td>
								<td><input type="text" name="teach_actual_fund[8]"
									datatype="float" /></td>
							</tr>
							<tr>
								<th>其他来源</th>
								<td><input type="text" name="other_budget_fund[8]"
									datatype="float" /></td>
								<td><input type="text" name="other_reduce_fund[8]"
									datatype="float" /></td>
								<td><input type="text" name="other_adjust_fund[8]"
									datatype="float" /></td>
								<td><input type="text" name="other_actual_fund[8]"
									datatype="float" /></td>
							</tr>
							<tr>
								<th rowspan="2" colspan="4">专家咨询费</th>
								<th>区财政科技经费</th>
								<td><input type="text" name="teach_budget_fund[9]"
									datatype="float" /></td>
								<td><input type="text" name="teach_reduce_fund[9]"
									datatype="float" /></td>
								<td><input type="text" name="teach_adjust_fund[9]"
									datatype="float" /></td>
								<td><input type="text" name="teach_actual_fund[9]"
									datatype="float" /></td>
							</tr>
							<tr>
								<th>其他来源</th>
								<td><input type="text" name="other_budget_fund[9]"
									datatype="float" /></td>
								<td><input type="text" name="other_reduce_fund[9]"
									datatype="float" /></td>
								<td><input type="text" name="other_adjust_fund[9]"
									datatype="float" /></td>
								<td><input type="text" name="other_actual_fund[9]"
									datatype="float" /></td>
							</tr>
							<tr>
								<th rowspan="2" colspan="4">其他费用</th>
								<th>区财政科技经费</th>
								<td><input type="text" name="teach_budget_fund[10]"
									datatype="float" /></td>
								<td><input type="text" name="teach_reduce_fund[10]"
									datatype="float" /></td>
								<td><input type="text" name="teach_adjust_fund[10]"
									datatype="float" /></td>
								<td><input type="text" name="teach_actual_fund[10]"
									datatype="float" /></td>
							</tr>
							<tr>
								<th>其他来源</th>
								<td><input type="text" name="other_budget_fund[10]"
									datatype="float" /></td>
								<td><input type="text" name="other_reduce_fund[10]"
									datatype="float" /></td>
								<td><input type="text" name="other_adjust_fund[10]"
									datatype="float" /></td>
								<td><input type="text" name="other_actual_fund[10]"
									datatype="float" /></td>
							</tr>
							<tr>
								<th colspan="5"><strong>合 计</strong></th>
								<td><input type="text" name="all_fund_tech_total"
									datatype="float" /></td>
								<td><input type="text" name="teach_reduce_fund_total"
									datatype="float" /></td>
								<td><input type="text" name="adjust_fund_total" datatype="float" /></td>
								<td><input type="text" name="teach_actual_fund_total"
									datatype="float" /></td>
							</tr>
							<tr>
								<th colspan="4">其他来源总计</th>
								<td><input type="text" name="fund_tech_total" datatype="float" /></td>
								<th colspan="3">其他来源总合计</th>
								<td><input type="text" name="fund_other_total" datatype="float" /></td>
							</tr>
							<tr>
								<th colspan="9">（3）仪器设备购置费用明细：（单价在5万元以上，含5万元）</th>
							</tr>
							<tr>
								<th>名 称</th>
								<th>型 号</th>
								<th>数 量</th>
								<th>金 额（万元）</th>
								<th>经费 来源</th>
								<th>购买时间</th>
								<th colspan="3">主要用途</th>
							</tr>
							<tr>
								<td><input name="" class="" /></td>
								<td><input name="" class="" /></td>
								<td><input name="" class="" /></td>
								<td><input name="" class="" /></td>
								<td><input name="" class="" /></td>
								<td><input name="" class="" /></td>
								<td colspan="3"><input name="" class="" /></td>
							</tr>
							<tr>
								<th colspan="9">2、项目实施所需的其他配套条件和解决办法：</th>
							</tr>
							<tr>
								<td colspan="9"><textarea name="" class=""></textarea></td>
							</tr>



						</table>
						<div class="button_wrapper clearfix">
							<div class="submit">提交</div>
							<div class="save">保存</div>
							<!-- <div class="reset" >重置</div> -->
						</div>
					</div>
				</div>
			</form>
		</div>

	</div>
</body>
</html>

