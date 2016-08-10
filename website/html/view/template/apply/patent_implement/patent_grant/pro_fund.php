<?php
include '../../../../../../../common/php/config.ini.php';
include '../../../../../../../extends/Table/TableData.php';
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

<script type="text/javascript" src="../../../../../../../common/html/js/datecommon.js"></script>

<script type="text/javascript" src="../../../../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>
<script type="text/javascript"
	src="../../../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript"
	src="../../../../../../../common/html/plugin/easyui/jquery.cookie.js"></script>
<script type="text/javascript"
	src="../../../../../../../common/html/plugin/jquery-hlui-2.0/js/hlui.js"></script>
<script type="text/javascript"
	src="../../../../../../../common/html/plugin/jquery-hlui-2.0/js/form.js"></script>

	<script type="text/javascript" src="../../../../../../../common/html/js/tablecommon.js"></script>
	<script type="text/javascript" src="../../../../../../../common/html/js/validation.js"></script>

<script type="text/javascript" src="../../../../js/apply/patent_grant/pro_fund.js"></script>
<style>
#qi{
	text-align: center;
	margin-top: 5px;
	float: left;
}
</style>
</head>
<body>
	<div class="wt_box">

		<div style="width: 100%; height: 100%; border: 1px;">
			<form method="post" id="pro_fund">

				<div class="project_content">
					<div class="table_title clearfix">
						<div class="title_pic left">项目经费总预算</div>
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
								<th colspan="4" width="30%">实施年度</th>
								<th width="240px" ><input type="text" name="first_year" datatype="number" style="width: 50%;"/></><span id="qi">年</span></th>
								<th width="240px" ><input type="text"   name="second_year" style="width: 50%;" datatype="number"/></><span id="qi">年</span></th>
								<th width="240px" ><input type="text"   name="third_year" style="width: 50%;" datatype="number"/></><span id="qi">年</span></th>
								<th colspan="3" >合 计</th>
							</tr>
							<tr>
								<th colspan="4" width="150px">经费总额</th>
								<td ><input name="first_value[0]" class="" type="text" datatype="float"/></td>
								<td ><input name="second_value[0]" class="" type="text" datatype="float"/></td>
								<td ><input name="third_value[0]" class="" type="text" datatype="float"/></td>
								<td colspan="3"><input name="total[0]" class="" type="text" readonly="readonly" /></td>
							</tr>
							<tr>
								<th colspan="9">1、项目经费来源与支出&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;单位：万元</th>
							</tr>
							<tr>
								<th colspan="4">(1)项目经费来源：</th>
								<th  ><input name="first" style="width:60px" type="text" datatype="number"/></><span id="qi">年</span></th>
								<th ><input name="second" style="width:60px" type="text" datatype="number"/></><span id="qi">年</span></th>
								<th ><input name="third" style="width:60px" type="text" datatype="number"/></><span id="qi">年</span></th>
								<th colspan="3">合 计</th>
							</tr>
							<tr>
								<th colspan="4">区财政科技经费</th>
								<td ><input name="first_value[1]" class="" type="text" datatype="float"/></td>
								<td ><input name="second_value[1]" class="" type="text" datatype="float"/></td>
								<td ><input name="third_value[1]" class="" type="text" datatype="float"/></td>
								<td colspan="3"><input name="total[1]" class="" type="text" datatype="float" readonly="readonly" /></td>
							</tr>
							<tr>
								<th rowspan="4" colspan="3" >其他来源</th>
								<th  width="15%">市级以上</th>
								<td  ><input name="first_value[2]" class="" type="text" datatype="float"/></td>
								<td ><input name="second_value[2]" class="" type="text" datatype="float"/></td>
								<td ><input name="third_value[2]" class="" type="text" datatype="float"/></td>
								<td colspan="3"><input name="total[2]" class="" type="text" datatype="float" readonly="readonly" /></td>
							</tr>
							<tr>
								<th >单位自筹</th>
								<td ><input name="first_value[3]" class="" type="text" datatype="float"/></td>
								<td ><input name="second_value[3]" class="" type="text" datatype="float"/></td>
								<td ><input name="third_value[3]" class="" type="text" datatype="float"/></td>
								<td colspan="3"><input name="total[3]" class="" type="text" datatype="float" readonly="readonly" /></td>
							</tr>
							<tr>
								<th >银行贷款</th>
								<td ><input name="first_value[4]" class="" type="text" datatype="float"/></td>
								<td ><input name="second_value[4]" class="" type="text" datatype="float"/></td>
								<td ><input name="third_value[4]" class="" type="text" datatype="float"/></td>
								<td colspan="3"><input name="total[4]" class="" type="text" datatype="float" readonly="readonly" /></td>
							</tr>
							<tr>
								<th >其他</th>
								<td ><input name="first_value[5]" class="" type="text" datatype="float"/></td>
								<td ><input name="second_value[5]" class="" type="text" datatype="float"/></td>
								<td ><input name="third_value[5]" class="" type="text" datatype="float"/></td>
								<td colspan="3"><input name="total[5]" class="" type="text" datatype="float" readonly="readonly" /></td>
							</tr>
							<tr>
								<th colspan="4">合计</th>
								<td ><input name="total_queue[0]" class="" type="text" datatype="float" readonly="readonly" /></td>
								<td ><input name="total_queue[1]" class="" type="text" datatype="float" readonly="readonly" /></td>
								<td ><input name="total_queue[2]" class="" type="text" datatype="float" readonly="readonly" /></td>
								<td colspan="3"><input name="total_queue[3]" class="" type="text" datatype="float" readonly="readonly" /></td>
							</tr>
							<tr>
								<th colspan="4">(2)项目经费支出：</th>
								<th colspan="5"> </th>
							</tr>
							<tr>
								<th colspan="3" >科 目</th>
								<th>经费来源</th>
								<th><input type="text" style="width:60px;" name="out_year[0]" datatype="number"/><span id="qi">年</span></th>
								<th><input type="text" style="width:60px;" name="out_year[1]" datatype="number"/><span id="qi">年</span></th>
								<th colspan="2"><input type="text" style="width:60px;" name="out_year[2]" datatype="number"/><span id="qi">年</span></th>
								<th>合计</th>
							</tr>
							<tr>
								<th rowspan="2" colspan="3">设备费</th>
								<th>区财政科技经费</th>
								<td><input type="text" name="teach_budget_fund[0]"
									datatype="float" /></td>
								<td><input type="text" name="teach_reduce_fund[0]"
									datatype="float" /></td>
								<td colspan="2"><input type="text" name="teach_adjust_fund[0]"
									datatype="float" /></td>
								<td><input type="text" name="teach_actual_fund[0]"
									datatype="float"  readonly="readonly" /></td>
							</tr>
							<tr>
								<th>其他来源</th>
								<td><input type="text" name="other_budget_fund[0]"
									datatype="float" /></td>
								<td><input type="text" name="other_reduce_fund[0]"
									datatype="float" /></td>
								<td colspan="2"><input type="text" name="other_adjust_fund[0]"
									datatype="float" /></td>
								<td><input type="text" name="other_actual_fund[0]"
									datatype="float"  readonly="readonly" /></td>
							</tr>
							<tr>
								<th rowspan="2" colspan="3">材料费</th>
								<th>区财政科技经费</th>
								<td><input type="text" name="teach_budget_fund[1]"
									datatype="float" /></td>
								<td><input type="text" name="teach_reduce_fund[1]"
									datatype="float"/></td>
								<td colspan="2"><input type="text" name="teach_adjust_fund[1]"
									datatype="float" /></td>
								<td><input type="text" name="teach_actual_fund[1]"
									datatype="float" readonly="readonly"  /></td>
							</tr>
							<tr>
								<th>其他来源</th>
								<td><input type="text" name="other_budget_fund[1]"
									datatype="float" /></td>
								<td><input type="text" name="other_reduce_fund[1]"
									datatype="float" /></td>
								<td colspan="2"><input type="text" name="other_adjust_fund[1]"
									datatype="float" /></td>
								<td><input type="text" name="other_actual_fund[1]"
									datatype="float" readonly="readonly"  /></td>
							</tr>
							<tr>
								<th rowspan="2" colspan="3">测试化验加工费</th>
								<th>区财政科技经费</th>
								<td><input type="text" name="teach_budget_fund[2]"
									datatype="float"/></td>
								<td><input type="text" name="teach_reduce_fund[2]"
									datatype="float"/></td>
								<td colspan="2"><input type="text" name="teach_adjust_fund[2]"
									datatype="float" /></td>
								<td><input type="text" name="teach_actual_fund[2]"
									datatype="float" readonly="readonly"  /></td>
							</tr>
							<tr>
								<th>其他来源</th>
								<td><input type="text" name="other_budget_fund[2]"
									datatype="float" /></td>
								<td><input type="text" name="other_reduce_fund[2]"
									datatype="float" /></td>
								<td colspan="2"><input type="text" name="other_adjust_fund[2]"
									datatype="float" /></td>
								<td><input type="text" name="other_actual_fund[2]"
									datatype="float" readonly="readonly" /></td>
							</tr>
							<tr>
								<th rowspan="2" colspan="3">燃料动力费</th>
								<th>区财政科技经费</th>
								<td><input type="text" name="teach_budget_fund[3]"
									datatype="float" /></td>
								<td><input type="text" name="teach_reduce_fund[3]"
									datatype="float" /></td>
								<td colspan="2"><input type="text" name="teach_adjust_fund[3]"
									datatype="float" /></td>
								<td><input type="text" name="teach_actual_fund[3]"
									datatype="float" readonly="readonly"  /></td>
							</tr>
							<tr>
								<th>其他来源</th>
								<td><input type="text" name="other_budget_fund[3]"
									datatype="float" /></td>
								<td><input type="text" name="other_reduce_fund[3]"
									datatype="float" /></td>
								<td colspan="2"><input type="text" name="other_adjust_fund[3]"
									datatype="float" /></td>
								<td><input type="text" name="other_actual_fund[3]"
									datatype="float"  readonly="readonly" /></td>
							</tr>
							<tr>
								<th rowspan="2" colspan="3">国际合作与交流费</th>
								<th>区财政科技经费</th>
								<td><input type="text" name="teach_budget_fund[4]"
									datatype="float" /></td>
								<td><input type="text" name="teach_reduce_fund[4]"
									datatype="float" /></td>
								<td colspan="2"><input type="text" name="teach_adjust_fund[4]"
									datatype="float" /></td>
								<td><input type="text" name="teach_actual_fund[4]"
									datatype="float" readonly="readonly"  /></td>
							</tr>
							<tr>
								<th>其他来源</th>
								<td><input type="text" name="other_budget_fund[4]"
									datatype="float" /></td>
								<td><input type="text" name="other_reduce_fund[4]"
									datatype="float" /></td>
								<td colspan="2"><input type="text" name="other_adjust_fund[4]"
									datatype="float" /></td>
								<td><input type="text" name="other_actual_fund[4]"
									datatype="float" readonly="readonly"  /></td>
							</tr>
							<tr>
								<th rowspan="2" colspan="3">差旅费</th>
								<th>区财政科技经费</th>
								<td><input type="text" name="teach_budget_fund[5]"
									datatype="float" /></td>
								<td><input type="text" name="teach_reduce_fund[5]"
									datatype="float" /></td>
								<td colspan="2"><input type="text" name="teach_adjust_fund[5]"
									datatype="float" /></td>
								<td><input type="text" name="teach_actual_fund[5]"
									datatype="float"  readonly="readonly" /></td>
							</tr>
							<tr>
								<th>其他来源</th>
								<td><input type="text" name="other_budget_fund[5]"
									datatype="float" /></td>
								<td><input type="text" name="other_reduce_fund[5]"
									datatype="float" /></td>
								<td colspan="2"><input type="text" name="other_adjust_fund[5]"
									datatype="float" /></td>
								<td><input type="text" name="other_actual_fund[5]"
									datatype="float"  readonly="readonly" /></td>
							</tr>
							<tr>
								<th rowspan="2" colspan="3">会议费</th>
								<th>区财政科技经费</th>
								<td><input type="text" name="teach_budget_fund[6]"
									datatype="float" /></td>
								<td><input type="text" name="teach_reduce_fund[6]"
									datatype="float" /></td>
								<td colspan="2"><input type="text" name="teach_adjust_fund[6]"
									datatype="float" /></td>
								<td><input type="text" name="teach_actual_fund[6]"
									datatype="float" readonly="readonly"  /></td>
							</tr>
							<tr>
								<th>其他来源</th>
								<td><input type="text" name="other_budget_fund[6]"
									datatype="float" /></td>
								<td><input type="text" name="other_reduce_fund[6]"
									datatype="float" /></td>
								<td colspan="2"><input type="text" name="other_adjust_fund[6]"
									datatype="float" /></td>
								<td><input type="text" name="other_actual_fund[6]"
									datatype="float" readonly="readonly"  /></td>
							</tr>
							<tr>
								<th rowspan="2" colspan="3">档案出版、文献信息传播、知识产权事务费</th>
								<th>区财政科技经费</th>
								<td><input type="text" name="teach_budget_fund[7]"
									datatype="float" /></td>
								<td><input type="text" name="teach_reduce_fund[7]"
									datatype="float" /></td>
								<td colspan="2"><input type="text" name="teach_adjust_fund[7]"
									datatype="float" /></td>
								<td><input type="text" name="teach_actual_fund[7]"
									datatype="float"  readonly="readonly" /></td>
							</tr>
							<tr>
								<th>其他来源</th>
								<td><input type="text" name="other_budget_fund[7]"
									datatype="float" /></td>
								<td><input type="text" name="other_reduce_fund[7]"
									datatype="float" /></td>
								<td colspan="2"><input type="text" name="other_adjust_fund[7]"
									datatype="float" /></td>
								<td><input type="text" name="other_actual_fund[7]"
									datatype="float" readonly="readonly"  /></td>
							</tr>
							<tr>
								<th rowspan="2" colspan="3">劳务费</th>
								<th>区财政科技经费</th>
								<td><input type="text" name="teach_budget_fund[8]"
									datatype="float" /></td>
								<td><input type="text" name="teach_reduce_fund[8]"
									datatype="float" /></td>
								<td colspan="2"><input type="text" name="teach_adjust_fund[8]"
									datatype="float" /></td>
								<td><input type="text" name="teach_actual_fund[8]"
									datatype="float"  readonly="readonly" /></td>
							</tr>
							<tr>
								<th>其他来源</th>
								<td><input type="text" name="other_budget_fund[8]"
									datatype="float" /></td>
								<td><input type="text" name="other_reduce_fund[8]"
									datatype="float" /></td>
								<td colspan="2"><input type="text" name="other_adjust_fund[8]"
									datatype="float" /></td>
								<td><input type="text" name="other_actual_fund[8]"
									datatype="float" readonly="readonly"  /></td>
							</tr>
							<tr>
								<th rowspan="2" colspan="3">专家咨询费</th>
								<th>区财政科技经费</th>
								<td><input type="text" name="teach_budget_fund[9]"
									datatype="float" /></td>
								<td><input type="text" name="teach_reduce_fund[9]"
									datatype="float" /></td>
								<td colspan="2"><input type="text" name="teach_adjust_fund[9]"
									datatype="float" /></td>
								<td><input type="text" name="teach_actual_fund[9]"
									datatype="float" readonly="readonly"  /></td>
							</tr>
							<tr>
								<th>其他来源</th>
								<td><input type="text" name="other_budget_fund[9]"
									datatype="float" /></td>
								<td><input type="text" name="other_reduce_fund[9]"
									datatype="float" /></td>
								<td colspan="2"><input type="text" name="other_adjust_fund[9]"
									datatype="float" /></td>
								<td><input type="text" name="other_actual_fund[9]"
									datatype="float" readonly="readonly"  /></td>
							</tr>
							<tr>
								<th rowspan="2" colspan="3">其他费用</th>
								<th>区财政科技经费</th>
								<td><input type="text" name="teach_budget_fund[10]"
									datatype="float" /></td>
								<td><input type="text" name="teach_reduce_fund[10]"
									datatype="float" /></td>
								<td colspan="2"><input type="text" name="teach_adjust_fund[10]"
									datatype="float" /></td>
								<td><input type="text" name="teach_actual_fund[10]"
									datatype="float"  readonly="readonly" /></td>
							</tr>
							<tr>
								<th>其他来源</th>
								<td><input type="text" name="other_budget_fund[10]"
									datatype="float" /></td>
								<td><input type="text" name="other_reduce_fund[10]"
									datatype="float" /></td>
								<td colspan="2"><input type="text" name="other_adjust_fund[10]"
									datatype="float" /></td>
								<td><input type="text" name="other_actual_fund[10]"
									datatype="float" readonly="readonly"  /></td>
							</tr>
							<tr>
								<th colspan="4"><strong>合 计</strong></th>
								<td><input type="text" name="all_fund_tech_total"
									datatype="float" readonly="readonly"  /></td>
								<td><input type="text" name="teach_reduce_fund_total"
									datatype="float" readonly="readonly"  /></td>
								<td colspan="2"><input type="text" name="adjust_fund_total" datatype="float" /></td>
								<td><input type="text" name="total_total"
									datatype="float"  readonly="readonly" /></td>
							</tr>
							<tr>
								<th colspan="4">区财政科技经费合计</th>
								<td><input type="text" name="fund_tech_total" datatype="float"  readonly="readonly" /></td>
								<th colspan="3">其他来源总合计</th>
								<td><input type="text" name="fund_other_total" datatype="float"  readonly="readonly" /></td>
							</tr>
							<tr>
								<th colspan="4">(3)仪器设备购置费用明细：（单价在5万元以上，含5万元）</th>
								<th colspan="5"> </th>
							</tr>
							
							<tr><td colspan="9">
				<table cellspacing="0" style="margin-bottom: 0;"
							id="addtable">
							<tr>
								<th width='20%'>名 称</th>
								<th width='10%'>型 号</th>
								<th width='10%'>数 量</th>
								<th width='10%'>金 额（万元）</th>
								<th width='10%'>经费来源</th>
								<th width='10%'>购买时间</th>
								<th colspan="2" width='20%'>主要用途</th>
								<th width='10%'>操作</th>
							</tr>
				 <?php
										  $project_id = $_SESSION ['project_id'];
                                          $tableData = TableData::get($project_id,29);
                                          $tableData = $tableData['data'];
                                          if (!empty($tableData) && $tableData['names']) {
                                             $i = 0;
                                             foreach ($tableData['names'] as $key => $value) {
												echo "<tr>";
												echo "<td width='20%'><input type='text' name='names[$i]' value='{$tableData['names'][$key]}'/></td>";
												echo "<td width='10%'><input type='text' name='types[$i]' value='{$tableData['types'][$key]}'/></td>";
												echo "<td width='10%'><input type='text' name='nums[$i]' value='{$tableData['nums'][$key]}' datatype='number'/></td>";
												echo "<td width='10%'><input type='text' name='pays[$i]' value='{$tableData['pays'][$key]}' datatype='float'/></td>";
												echo "<td width='10%'><input type='text' name='sour[$i]' value='{$tableData['sour'][$key]}'/></td>";
												echo "<td width='10%'><input id='time_pick{$i}' type='text' name='time[$i]' value='{$tableData['time'][$key]}' class='dateplu' readonly/></td>";
												echo "<td colspan='2' width='20%'><input type='text' name='function[$i]' value='{$tableData['function'][$key]}'/></td>";
												echo "<td width='10%'><input type='button' class=\"pointer\" value='删除' onclick='delLine(this)'/></td>";
												echo "</tr>";
												++$i;
											}
										} else {
    											echo "<tr>";
    										    echo "<td width='20%'><input type='text' name='names[0]'/></td>";
												echo "<td width='10%'><input type='text' name='types[0]'/></td>";
												echo "<td width='10%'><input type='text' name='nums[0]' datatype='number'/></td>";
												echo "<td width='10%'><input type='text' name='pays[0]' datatype='float'/></td>";
												echo "<td width='10%'><input type='text' name='sour[0]'/></td>";
												echo "<td width='10%'><input id='time_pick0' type='text' name='time[0]' class='dateplu' readonly/></td>";
												echo "<td colspan='2' width='20%'><input type='text' name='function[0]'/></td>";
    											echo "<td width='10%'><input type='button' class=\"pointer\" value='删除' onclick='delLine(this)'/></td>";
    											echo "</tr>";
										}
										?>	
				 </table>
						<tr>
							<th colspan="9" height="25"><input   type="button" value="添加" class="pointer" onclick="addLine()" /></th>
							<!-- 没有字段-->
						</tr>
					</td>
				</tr>

							<tr>
								<th colspan="9">2、项目实施所需的其他配套条件和解决办法：</th>
							</tr>
							<tr>
								<td colspan="9"><textarea name="con_way" style="padding-top:10px;" class=""></textarea></td>
							</tr>



						</table>
						<div class="button_wrapper clearfix">
							
							<div class="save">保存</div>
							<!-- <div class="reset" >重置</div> -->
						</div>
					</div>
				</div>
			</form>
		</div>

	</div>

<script type="application/javascript">
	// 第一部分合计
	$first_value = $("input[name^='first_value[']");
	$second_value = $("input[name^='second_value[']");
	$third_value = $("input[name^='third_value[']");
	$total = $("input[name^='total[']");
	$total_queue = $("input[name^='total_queue[']");

	// 设置为0.00
	$first_value.val('0');
	$second_value.val('0');
	$third_value.val('0');
	$total.val('0');
	$total_queue.val('0');

	$first_value.bind('input propertychange', do_change1);
	$second_value.bind('input propertychange', do_change1);
	$third_value.bind('input propertychange', do_change1);

	function do_change1() {
		var total_queue = [0, 0, 0, 0];

		$total.each(function(i) {
			this.value = wt_add($first_value[i].value, $second_value[i].value, $third_value[i].value);
			if (i == 0) {
				return ;
			}
			total_queue[0] = wt_add(total_queue[0], $first_value[i].value);
			total_queue[1] = wt_add(total_queue[1], $second_value[i].value);
			total_queue[2] = wt_add(total_queue[2], $third_value[i].value);
			total_queue[3] = wt_add(total_queue[3], this.value);
		});

		$total_queue.each(function(i) {
			this.value = total_queue[i];
		});
	}


	// 第二部分的计算
	$teach_budget_fund = $("input[name^='teach_budget_fund[']");
	$teach_reduce_fund = $("input[name^='teach_reduce_fund[']");
	$teach_adjust_fund = $("input[name^='teach_adjust_fund[']");
	$teach_actual_fund = $("input[name^='teach_actual_fund[']");


	$other_budget_fund = $("input[name^='other_budget_fund[']");
	$other_reduce_fund = $("input[name^='other_reduce_fund[']");
	$other_adjust_fund = $("input[name^='other_adjust_fund[']");
	$other_actual_fund = $("input[name^='other_actual_fund[']");

	// 清空为0
	$teach_budget_fund.val('0');
	$teach_reduce_fund.val('0');
	$teach_adjust_fund.val('0');
	$teach_actual_fund.val('0');
	$other_budget_fund.val('0');
	$other_reduce_fund.val('0');
	$other_adjust_fund.val('0');
	$other_actual_fund.val('0');

	$("input[name='all_fund_tech_total']").val('0');
	$("input[name='teach_reduce_fund_total']").val('0');
	$("input[name='adjust_fund_total']").val('0');
	$("input[name='total_total']").val('0');

	$("input[name='fund_tech_total']").val('0');
	$("input[name='fund_other_total']").val('0');


	$("input[name^='teach_budget_fund['], input[name^='teach_reduce_fund['], input[name^='teach_adjust_fund[']").bind('input', do_change2);
	$("input[name^='other_budget_fund['], input[name^='other_reduce_fund['], input[name^='other_adjust_fund[']").bind('input', do_change2);
	function do_change2() {
		var total1 = 0;
		var total2 = 0;
		var total3 = 0;
		var total4 = 0;
		var total5 = 0;
		var total6 = 0;

		$teach_actual_fund.each(function(i) {
			this.value = wt_add($teach_budget_fund[i].value,
					$teach_reduce_fund[i].value,
					$teach_adjust_fund[i].value);

			$other_actual_fund[i].value = wt_add($other_budget_fund[i].value,
					$other_reduce_fund[i].value,
					$other_adjust_fund[i].value);

			total1 = wt_add(total1, $teach_budget_fund[i].value, $other_budget_fund[i].value);
			total2 = wt_add(total2, $teach_reduce_fund[i].value, $other_reduce_fund[i].value);
			total3 = wt_add(total3, $teach_adjust_fund[i].value, $other_adjust_fund[i].value);

			total5 = wt_add(total5, this.value);
			total6 = wt_add(total6, $other_actual_fund[i].value);
		});
		total4 = wt_add(total1, total2, total3);

		$("input[name='all_fund_tech_total']").val(total1);
		$("input[name='teach_reduce_fund_total']").val(total2);
		$("input[name='adjust_fund_total']").val(total3);
		$("input[name='total_total']").val(total4);

		$("input[name='fund_tech_total']").val(total5);
		$("input[name='fund_other_total']").val(total6);
	}
</script>
</body>
</html>

