<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>

<link rel="stylesheet" type="text/css" href="../../../../../../../common/html/plugin/easyui/themes/default/easyui.css" />
<link rel="stylesheet" type="text/css" href="../../../../../../../common/html/plugin/easyui/themes/icon.css" />
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
<script src="../../../../../../../common/html/plugin/datapicker/jquery.daterangepicker.js"></script>
<script type="text/javascript" src="../../../../../../../common/html/js/validation.js"></script>
<script type="text/javascript"
	src="../../../../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>
<script type="text/javascript" src="../../../../../../../common/html/js/tablecommon.js"></script>
<script type="text/javascript" src="../../../../js/implement/funds_use.js"></script>
<style type="text/css">
#qi{
	float:left;
	margin-top: 5px;
	
}
</style>
</head>
<body>
	<div class="wt_box">

		<div style="width: 100%; height: 100%; border: 1px;">
			<form method="post" id="total_funds">

				<div class="project_content">
					<div class="table_title clearfix">
						<div class="title_pic left">专利实施验收报告书</div>
						<div class="right back_pic" id="back"></div>
					</div>
					<div class="table_content back-long">
						<table cellspacing="0" cellpadding="0" class="basic_info">
							<tr>
								<td colspan=10 style="background-color: #7AB5ED; height: 20px;">
									<div class="title_top p-b10">项目资金使用情况
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 单位：万元</div>
								</td>
							</tr>
							<tr>
								<th colspan="5">(1)项目经费来源：</th>
								<th  class=""><input name="year[0]" style="width: 50%;" datatype="year" /><span id='qi'>年</span></th>
								<th  class=""><input name="year[1]" style="width: 50%;" datatype="year"  /><span id='qi'>年</span></th>
								<th  class=""><input name="year[2]" style="width: 50%;" datatype="year"  /><span id='qi'>年</span></th>
								<th  class="" >合 计</th>
							</tr>
							<tr>
								<th colspan="5">区专利实施经费</th>
								<td colspan="1" class="" ><input datatype="float" name="year_patent[0]" /></td>
								<td colspan="1" class="" ><input datatype="float" name="year_patent[1]" /></td>
								<td colspan="1" class="" ><input datatype="float" name="year_patent[2]"/></td>
								<td colspan="3" class="" ><input datatype="float" name="year_total" id="year_total" readonly/></td>
							</tr>
							<tr>
								<th rowspan="4" colspan="4">其他来源</th>
								<th rowspan="1">市级以上</th>
								<td colspan="1" class="" ><input datatype="float" name="city[0]"/></td>
								<td colspan="1" class="" ><input datatype="float" name="city[1]"/></td>
								<td colspan="1" class="" ><input datatype="float" name="city[2]"/></td>
								<td colspan="3" class="" ><input datatype="float" name="city_total" readonly/></td>
							</tr>
							<tr>
								<th rowspan="1">单位自筹</th>
								<td colspan="1" class="" ><input datatype="float" name="org[0]"/></td>
								<td colspan="1" class="" ><input datatype="float" name="org[1]"/></td>
								<td colspan="1" class="" ><input datatype="float" name="org[2]"/></td>
								<td colspan="3" class="" ><input datatype="float" name="org_total" readonly/></td>
							</tr>
							<tr>
								<th rowspan="1">银行贷款</th>
								<td colspan="1" class="" ><input datatype="float" name="bank[0]"/></td>
								<td colspan="1" class="" ><input datatype="float" name="bank[1]"/></td>
								<td colspan="1" class="" ><input datatype="float" name="bank[2]"/></td>
								<td colspan="3" class="" ><input datatype="float" name="bank_total" readonly/></td>
							</tr>
							<tr>
								<th rowspan="1">其他</th>
								<td colspan="1" class="" ><input datatype="float" name="other[0]"/></td>
								<td colspan="1" class="" ><input datatype="float" name="other[1]"/></td>
								<td colspan="1" class="" ><input datatype="float" name="other[2]"/></td>
								<td colspan="3" class="" ><input datatype="float" name="other_sub_total" readonly/></td>
							</tr>
							<tr>
								<th colspan="5">合计</th>
								<td colspan="1" class="" ><input datatype="float" name="total[0]" readonly/></td>
								<td colspan="1" class="" ><input datatype="float" name="total[1]" readonly/></td>
								<td colspan="1" class="" ><input datatype="float" name="total[2]" readonly/></td>
								<td colspan="3" class="" ><input datatype="float" name="total[3]" readonly/></td>
							</tr>
							<tr>
								<th colspan="5">(2)项目经费支出：</th>
								<th colspan="4"></th>
							</tr>
							<tr>
								<th colspan="4">科 目</th>
								<th>经费来源</th>
								<th><input type="text" name="p_m_year[0]" style="width: 50%;" datatype="number" /><span id='qi'>年</span></td>
								<th><input type="text" name="p_m_year[1]"  style="width: 50%;" datatype="number" /><span id='qi'>年</span></td>
								<th><input type="text" name="p_m_year[2]" style="width: 50%;" datatype="number" /><span id='qi'>年</span></td>
								<th>合计</th>
							</tr>
							<tr>
								<th rowspan="2" colspan="4">设备费</th>
								<th>区财政科技经费</th>
								<td><input type="text" name="teach1_fund[0]"
									datatype="float" /></td>
								<td><input type="text" name="teach2_fund[0]"
									datatype="float" /></td>
								<td><input type="text" name="teach3_fund[0]"
									datatype="float" /></td>
								<td><input type="text" name="teach_total[0]" datatype="float"/></td>
							</tr>
							<tr>
								<th>其他来源</th>
								<td><input type="text" name="other1_fund[0]"
									datatype="float" /></td>
								<td><input type="text" name="other2_fund[0]"
									datatype="float" /></td>
								<td><input type="text" name="other3_fund[0]"
									datatype="float" /></td>
								<td><input type="text" name="other_total[0]" datatype="float"/></td>
							</tr>
							<tr>
								<th rowspan="2" colspan="4">材料费</th>
								<th>区财政科技经费</th>
								<td><input type="text" name="teach1_fund[1]"
									datatype="float" /></td>
								<td><input type="text" name="teach2_fund[1]"
									datatype="float" /></td>
								<td><input type="text" name="teach3_fund[1]"
									datatype="float" /></td>
								<td><input type="text" name="teach_total[1]" datatype="float"/></td>
									
							</tr>
							<tr>
							    <th>其他来源</th>
								<td><input type="text" name="other1_fund[1]"
									datatype="float" /></td>
								<td><input type="text" name="other2_fund[1]"
									datatype="float" /></td>
								<td><input type="text" name="other3_fund[1]"
									datatype="float" /></td>
								<td><input type="text" name="other_total[1]" datatype="float"/></td>
							</tr>
							<tr>
								<th rowspan="2" colspan="4">测试化验加工费</th>
								<th>区财政科技经费</th>
								<td><input type="text" name="teach1_fund[2]"
									datatype="float" /></td>
								<td><input type="text" name="teach2_fund[2]"
									datatype="float" /></td>
								<td><input type="text" name="teach3_fund[2]"
									datatype="float" /></td>
								<td><input type="text" name="teach_total[2]" datatype="float"/></td>
							</tr>
							<tr>
								<th>其他来源</th>
								<td><input type="text" name="other1_fund[2]"
									datatype="float" /></td>
								<td><input type="text" name="other2_fund[2]"
									datatype="float" /></td>
								<td><input type="text" name="other3_fund[2]"
									datatype="float" /></td>
								<td><input type="text" name="other_total[2]" datatype="float"/></td>
							</tr>
							<tr>
								<th rowspan="2" colspan="4">燃料动力费</th>
								<th>区财政科技经费</th>
								<td><input type="text" name="teach1_fund[3]"
									datatype="float" /></td>
								<td><input type="text" name="teach2_fund[3]"
									datatype="float" /></td>
								<td><input type="text" name="teach3_fund[3]"
									datatype="float" /></td>
								<td><input type="text" name="teach_total[3]" datatype="float"/></td>
							</tr>
							<tr>
								<th>其他来源</th>
								<td><input type="text" name="other1_fund[3]"
									datatype="float" /></td>
								<td><input type="text" name="other2_fund[3]"
									datatype="float" /></td>
								<td><input type="text" name="other3_fund[3]"
									datatype="float" /></td>
								<td><input type="text" name="other_total[3]" datatype="float"/></td>
							</tr>
							<tr>
								<th rowspan="2" colspan="4">国际合作与交流费</th>
								<th>区财政科技经费</th>
								<td><input type="text" name="teach1_fund[4]"
									datatype="float" /></td>
								<td><input type="text" name="teach2_fund[4]"
									datatype="float" /></td>
								<td><input type="text" name="teach3_fund[4]"
									datatype="float" /></td>
								<td><input type="text" name="teach_total[4]" datatype="float"/></td>
							</tr>
							<tr>
								<th>其他来源</th>
								<td><input type="text" name="other1_fund[4]"
									datatype="float" /></td>
								<td><input type="text" name="other2_fund[4]"
									datatype="float" /></td>
								<td><input type="text" name="other3_fund[4]"
									datatype="float" /></td>
								<td><input type="text" name="other_total[4]" datatype="float"/></td>
							</tr>
							<tr>
								<th rowspan="2" colspan="4">差旅费</th>
								<th>区财政科技经费</th>
								<td><input type="text" name="teach1_fund[5]"
									datatype="float" /></td>
								<td><input type="text" name="teach2_fund[5]"
									datatype="float" /></td>
								<td><input type="text" name="teach3_fund[5]"
									datatype="float" /></td>
								<td><input type="text" name="teach_total[5]" datatype="float"/></td>
							</tr>
							<tr>
								<th>其他来源</th>
								<td><input type="text" name="other1_fund[5]"
									datatype="float" /></td>
								<td><input type="text" name="other2_fund[5]"
									datatype="float" /></td>
								<td><input type="text" name="other3_fund[5]"
									datatype="float" /></td>
								<td><input type="text" name="other_total[5]" datatype="float"/></td>
							</tr>
							<tr>
								<th rowspan="2" colspan="4">会议费</th>
								<th>区财政科技经费</th>
								<td><input type="text" name="teach1_fund[6]"
									datatype="float" /></td>
								<td><input type="text" name="teach2_fund[6]"
									datatype="float" /></td>
								<td><input type="text" name="teach3_fund[6]"
									datatype="float" /></td>
								<td><input type="text" name="teach_total[6]" datatype="float"/></td>
							</tr>
							<tr>
								<th>其他来源</th>
								<td><input type="text" name="other1_fund[6]"
									datatype="float" /></td>
								<td><input type="text" name="other2_fund[6]"
									datatype="float" /></td>
								<td><input type="text" name="other3_fund[6]"
									datatype="float" /></td>
								<td><input type="text" name="other_total[6]" datatype="float"/></td>
							</tr>
							<tr>
								<th rowspan="2" colspan="4">档案出版、文献信息传播、知识产权事务费</th>
								<th>区财政科技经费</th>
								<td><input type="text" name="teach1_fund[7]"
									datatype="float" /></td>
								<td><input type="text" name="teach2_fund[7]"
									datatype="float" /></td>
								<td><input type="text" name="teach3_fund[7]"
									datatype="float" /></td>
								<td><input type="text" name="teach_total[7]" datatype="float"/></td>
							</tr>
							<tr>
								<th>其他来源</th>
								<td><input type="text" name="other1_fund[7]"
									datatype="float" /></td>
								<td><input type="text" name="other2_fund[7]"
									datatype="float" /></td>
								<td><input type="text" name="other3_fund[7]"
									datatype="float" /></td>
								<td><input type="text" name="other_total[7]" datatype="float"/></td>
							</tr>
							<tr>
								<th rowspan="2" colspan="4">劳务费</th>
								<th>区财政科技经费</th>
								<td><input type="text" name="teach1_fund[8]"
									datatype="float" /></td>
								<td><input type="text" name="teach2_fund[8]"
									datatype="float" /></td>
								<td><input type="text" name="teach3_fund[8]"
									datatype="float" /></td>
								<td><input type="text" name="teach_total[8]" datatype="float"/></td>
							</tr>
							<tr>
								<th>其他来源</th>
								<td><input type="text" name="other1_fund[8]"
									datatype="float" /></td>
								<td><input type="text" name="other2_fund[8]"
									datatype="float" /></td>
								<td><input type="text" name="other3_fund[8]"
									datatype="float" /></td>
								<td><input type="text" name="other_total[8]" datatype="float"/></td>
							</tr>
							<tr>
								<th rowspan="2" colspan="4">专家咨询费</th>
								<th>区财政科技经费</th>
								<td><input type="text" name="teach1_fund[9]"
									datatype="float" /></td>
								<td><input type="text" name="teach2_fund[9]"
									datatype="float" /></td>
								<td><input type="text" name="teach3_fund[9]"
									datatype="float" /></td>
								<td><input type="text" name="teach_total[9]" datatype="float"/></td>
							</tr>
							<tr>
								<th>其他来源</th>
								<td><input type="text" name="other1_fund[9]"
									datatype="float" /></td>
								<td><input type="text" name="other2_fund[9]"
									datatype="float" /></td>
								<td><input type="text" name="other3_fund[9]"
									datatype="float" /></td>
								<td><input type="text" name="other_total[9]" datatype="float"/></td>
							</tr>
							<tr>
								<th rowspan="2" colspan="4">其他费用</th>
								<th>区财政科技经费</th>
								<td><input type="text" name="teach1_fund[10]"
									datatype="float" /></td>
								<td><input type="text" name="teach2_fund[10]"
									datatype="float" /></td>
								<td><input type="text" name="teach3_fund[10]"
									datatype="float" /></td>
								<td><input type="text" name="teach_total[10]" datatype="float"/></td>
							</tr>
							<tr>
								<th>其他来源</th>
								<td><input type="text" name="other1_fund[10]"
									datatype="float" /></td>
								<td><input type="text" name="other2_fund[10]"
									datatype="float" /></td>
								<td><input type="text" name="other3_fund[10]"
									datatype="float" /></td>
								<td><input type="text" name="other_total[10]" datatype="float"/></td>
							</tr>
							<tr>
								<th colspan="5"><strong>合 计</strong></th>
								<td><input type="text" name="sum[1]"
									datatype="float" readonly/></td>
								<td><input type="text" name="sum[2]"
									datatype="float" readonly/></td>
								<td><input type="text" name="sum[3]" datatype="float" readonly/></td>
								<td><input type="text" name="sum[4]"
									datatype="float" readonly/></td>
							</tr>
							<tr>
								<th colspan="4">区财政科技经费总计</th>
								<td><input type="text" name="sum[5]" datatype="float" readonly/></td>
								<th colspan="3">其他来源总合计</th>
								<td><input type="text" name="sum[6]" datatype="float" readonly/></td>
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
	// 日期自动填充
	$(function() {
		$year = $("input[name^='year[']");
		$p_m_year = $("input[name^='p_m_year[']");
		$("input[name='year[0]'], input[name='p_m_year[0]']").change(function() {
			var that = this;
			$year.each(function(i) {
				this.value = add(that.value, i);
			});
			$p_m_year.each(function(i) {
				this.value = add(that.value, i);
			});
		});
	});

	$(function() {
		// 置0
		$("input[datatype='float']").val('0');

		// 上半部分计算
		$year_patent = $("input[name^='year_patent[']");
		$city = $("input[name^='city[']");
		$org = $("input[name^='org[']");
		$bank = $("input[name^='bank[']");
		$other = $("input[name^='other[']");

		$year_patent.change(do_change2);
		$city.change(do_change2);
		$org.change(do_change2);
		$bank.change(do_change2);
		$other.change(do_change2);


		function do_change2() {
			$('#year_total').val(wt_add($year_patent[0].value, $year_patent[1].value, $year_patent[2].value));
			$("input[name='city_total']").val(wt_add($city[0].value, $city[1].value, $city[2].value));
			$("input[name='org_total']").val(wt_add($org[0].value, $org[1].value, $org[2].value));
			$("input[name='bank_total']").val(wt_add($bank[0].value, $bank[1].value, $bank[2].value));
			$("input[name='other_sub_total']").val(wt_add($other[0].value, $other[1].value, $other[2].value));

			var total0 = wt_add($year_patent[0].value, $city[0].value, $org[0].value, $bank[0].value, $other[0].value);
			var total1 = wt_add($year_patent[1].value, $city[1].value, $org[1].value, $bank[1].value, $other[1].value);
			var total2 = wt_add($year_patent[2].value, $city[2].value, $org[2].value, $bank[2].value, $other[2].value);
			var total3 = wt_add(total0, total1, total2);

			$("input[name='total[0]']").val(total0);
			$("input[name='total[1]']").val(total1);
			$("input[name='total[2]']").val(total2);
			$("input[name='total[3]']").val(total3);
		}

		// 下面部分计算
		$teach1_fund = $("input[name^='teach1_fund[']");
		$teach2_fund = $("input[name^='teach2_fund[']");
		$teach3_fund = $("input[name^='teach3_fund[']");
		$teach_total = $("input[name^='teach_total[']");

		$other1_fund = $("input[name^='other1_fund[']");
		$other2_fund = $("input[name^='other2_fund[']");
		$other3_fund = $("input[name^='other3_fund[']");
		$other_total = $("input[name^='other_total[']");

		// 先设置为空
		$teach1_fund.val('0');
		$teach2_fund.val('0');
		$teach3_fund.val('0');
		$other1_fund.val('0');
		$other2_fund.val('0');
		$other3_fund.val('0');

		// 设置为空
		$("input[name*='sum']").val('0');

		$teach1_fund.change(do_change);
		$teach2_fund.change(do_change);
		$teach3_fund.change(do_change);
		$other1_fund.change(do_change);
		$other2_fund.change(do_change);
		$other3_fund.change(do_change);

		function do_change() {
			$teach_total.each(function(i) {
				var teach_total = ($teach1_fund[i].value * 10000
						+ $teach2_fund[i].value * 10000
						+ $teach3_fund[i].value * 10000)/ 10000;

				var other_total = wt_add($other1_fund[i].value, $other2_fund[i].value, $other3_fund[i].value);
				this.value = teach_total;
				$other_total[i].value = other_total;
			});

			var total1 = 0.0,
					total2 = 0.0,
					total3 = 0.0,
					total4 = 0.0,
					total5 = 0.0,
					total_other = 0.0;

			$teach1_fund.each(function(i) {
				total1 = add(total1, $teach1_fund[i].value, $other1_fund[i].value);
				total2 = (total2 * 10000 + $teach2_fund[i].value * 10000 + $other2_fund[i].value * 10000) / 10000;
				total3 = (total3 * 10000 + $teach3_fund[i].value * 10000 + $other3_fund[i].value * 10000) / 10000;
				total4 = (total1 * 10000 + total2 * 10000 + total3 * 10000) / 10000;
				total5 = (total5 * 10000 + $teach1_fund[i].value * 10000 + $teach2_fund[i].value * 10000 + $teach3_fund[i].value * 10000) / 10000;
				total_other = (total_other * 10000 + $other1_fund[i].value * 10000 + $other2_fund[i].value * 10000 + $other3_fund[i].value * 10000) / 10000;
			});

			$("input[name='sum[1]']").val(total1);
			$("input[name='sum[2]']").val(total2);
			$("input[name='sum[3]']").val(total3);
			$("input[name='sum[4]']").val(total4);
			$("input[name='sum[5]']").val(total5);
			$("input[name='sum[6]']").val(total_other);
		}

	});

	function add() {
		var total = 0;
		for (var i = 0; i < arguments.length; ++i) {
			total = (total * 10000 + arguments[i] * 10000) / 10000;
		}

		return total;
	}
</script>
</body>
</html>

