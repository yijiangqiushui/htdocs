<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>项目经费总预算</title>

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
	src="../../../js/apply/iprproject3_2/project_fund.js"></script>
<link rel="stylesheet" type="text/css"
	href="../../../../../../website/html/view/css/tablestyle.css" />
<style type="text/css">
input class ="easyui-validatebox"  required ="true"{
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
	<div class="" style="border: 0;">
		<form method="post" id="project_fund">
			<table border="1" cellspacing="0">
				<tr>
					<td colspan="7"><h2>四、项目经费总预算</h2></td>
				</tr>
				<tr>
					<td colspan="2">实施年度</td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="first_imple" value="2013"> </input class="easyui-validatebox"  required="true"></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="second_imple " value="2014"></input class="easyui-validatebox"  required="true"></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="three_imple" value="2015"></input class="easyui-validatebox"  required="true"></td>
					<td>合计</td>
				</tr>
				<tr>
					<td colspan="2">经费总额</td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="project_fund[0]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="project_fund[1]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="project_fund[2]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="sum_fund" /></td>
				</tr>
				<tr>
					<td colspan="6"><h3>1、项目经费来源与支出</h3></td>
				</tr>
				<tr>
					<!-- fund_src  -->
					<td colspan="2">（1）项目经费来源</td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="sour_first_year" value="2013"></input class="easyui-validatebox"  required="true"></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="sour_second_year" value="2014"></input class="easyui-validatebox"  required="true"></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="sour_budget_sum" value="2015"></input class="easyui-validatebox"  required="true"></td>
					<td>合计</td>
				</tr>
				<tr>

					<td colspan="2">区财政科技经费</td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="actual_fund[0]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="actual_fund[1]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="actual_fund[2]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text" /></td>
				</tr>
				<tr>
					<td rowspan="4">其他来源</td>
					<td>市级以上拨款</td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="other_town[0]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="other_town[1]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="other_town[3]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text" /></td>
				</tr>
				<tr>
					<td>单位自筹</td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="source _self[0]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="source _self[1]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="source _self[2]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text" /></td>
				</tr>
				<tr>
					<td>银行贷款</td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="source_bank[0]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="source_bank[1]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="source_bank[2]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
				</tr>
				<tr>
					<td>其他</td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="source _other" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
				</tr>
				<tr>
					<td colspan="2">合计</td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="source_sum" /></td>
				</tr>
			</table>
			<table border="1" cellspacing="0">
				<tr>
					<!-- project_fund  -->
					<td colspan="6"><h3>（2）项目经费支出</h3></td>
				</tr>
				<tr>
					<td>科目</td>
					<td>来源</td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="out_second_year" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="out_three_year" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="out_budget_sum" /></td>
					<td>合计</td>
				</tr>
				<tr>
					<!-- actual_fund[0][0]  -->
					<!-- actual_fund[0][1]  -->
					<!-- actual_fund[0][2]  -->
					<td rowspan="2">设备费</a></td>
					<td>区财政科技经费</td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="dev_dist" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
				</tr>
				<tr>
					<!-- otheractual_fund[0][0]  -->
					<!-- otheractual_fund[0][1]  -->
					<!-- otheractual_fund[0][2]  -->
					<td>其他来源</td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="dev_other" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
				</tr>
				<tr>
					<!-- actual_fund[1][0]  -->
					<!-- actual_fund[1][1]  -->
					<!-- actual_fund[1][2]  -->
					<td rowspan="2">材料费</td>
					<td>区财政科技经费</td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="mater_dist" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
				</tr>
				<tr>
					<!-- otheractual_fund[1][0]  -->
					<!-- otheractual_fund[1][1]  -->
					<!-- otheractual_fund[1][2]  -->
					<td>其他来源</td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="mater_other" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
				</tr>
				<tr>
					<td rowspan="2">测试化验加工费</td>
					<td>区财政科技经费</td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="test_dist" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
				</tr>
				<tr>
					<td>其他来源</td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="test_other" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
				</tr>
				<tr>
					<td rowspan="2">燃料动力费</td>
					<td>区财政科技经费</td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="fuel_dist" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
				</tr>
				<tr>
					<td>其他来源</td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="fuel_other" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
				</tr>
				<tr>
					<td rowspan="2">国际合作与交流费</td>
					<td>区财政科技经费</td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="coop_dist" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
				</tr>
				<tr>
					<td>其他来源</td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="coop_other" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
				</tr>
				<tr>
					<td rowspan="2">差旅费</td>
					<td>区财政科技经费</td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="trval_dist" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
				</tr>
				<tr>
					<td>其他来源</td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="trval_other" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
				</tr>
				<tr>
					<td rowspan="2">会议费</td>
					<td>区财政科技经费</td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="meet_dist" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
				</tr>
				<tr>
					<td>其他来源</td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="meet_ohter" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
				</tr>
				<tr>
					<td rowspan="2">档案出版、文献信息传播、知识产权事务费</td>
					<td>区财政科技经费</td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="artic_dist" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
				</tr>
				<tr>
					<td>其他来源</td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="artic_other" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
				</tr>
				<tr>
					<td rowspan="2">劳务费</td>
					<td>区财政科技经费</td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="ser_dist" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
				</tr>
				<tr>
					<td>其他来源</td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="ser_other" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
				</tr>
				<tr>
					<td rowspan="2">专家咨询费</td>
					<td>区财政科技经费</td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="expert_dist" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
				</tr>
				<tr>
					<td>其他来源</td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="expert_other" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
				</tr>
				<tr>
					<td rowspan="2">其他费用</td>
					<td>区财政科技经费</td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="other_dist" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
				</tr>
				<tr>
					<td>其他来源</td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="out_other" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
				</tr>
				<tr>
					<td colspan="2">合计</td>
					<td colspan="4"><input class="easyui-validatebox" required="true"
						type="text" name="out_sum" /></td>
				</tr>
				<tr>
					<td colspan="2">区财政科技经费合计</td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="dist_sum" /></td>
					<td colspan="2">其他来源合计</td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="other_sum" /></td>
				</tr>
			</table>
			<table border="1" cellspacing="0">
				<tr>
					<!-- equipment 表 -->
					<td colspan="6">（3）仪器设备购置费用明细：（单价在5万元以上，含5万元）</td>
				</tr>
				<tr>
					<td>名称</td>
					<td>型号</td>
					<td>数量</td>
					<td>金额（万元）</td>
					<td>经费来源</td>
					<td>购买时间</td>
					<td>主要用途</td>
				</tr>
				<tr>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="dev_name" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="dev_type" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="dev_num" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="dev_fund" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="dev_fund_sour" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="dev_buy_time" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="dev_for" /></td>
				</tr>
				<tr>
					<td colspan="8">
						<table border="1" cellspacing="0" style="margin-bottom: 0;"
							id="addtable">
		    		
		<?php
		// $org_code = $_SESSION['org_code'];
		$org_code = '01234567';
		$sql = "Select * from shareholder_info where org_code=$org_code";
		$conn = mysql_connect ( "david", "FRED", "123456" );
		mysql_select_db ( "project", $conn );
		$result = mysql_query ( $sql, $conn );
		$tableRow = mysql_num_rows ( $result );
		
		if ($tableRow) {
			for($i = 0; $i < $tableRow; $i ++) {
				$row = mysql_fetch_object ( $result );
				echo "<tr>";
				echo "<td><input   type='text' name='shareholder_name[$i]' value='$row->shareholder_name'/></td>";
				echo "<td><input   type='text' name='shareholder_name[$i]' value='$row->shareholder_name'/></td>";
				echo "<td><input   type='text' name='shareholder_name[$i]' value='$row->shareholder_name'/></td>";
				echo "<td><input   type='text' name='shareholder_name[$i]' value='$row->shareholder_name'/></td>";
				echo "<td><input   type='text' name='shareholder_name[$i]' value='$row->shareholder_name'/></td>";
				echo "<td><input   type='text' name='shareholder_name[$i]' value='$row->shareholder_name'/></td>";
				echo "<td><input   type='text' name='stock_ratio[$i]' value='$row->stock_ratio'/></td>";
				echo "<td><input   type='button' value='删除' onclick='delLine(this)'/></td>";
				echo "</tr>";
			}
		} else {
			echo "<tr>";
			echo "<td><input   type='text' name='shareholder_name[0]'/></td>";
			echo "<td><input   type='text' name='shareholder_name[0]'/></td>";
			echo "<td><input   type='text' name='shareholder_name[0]'/></td>";
			echo "<td><input   type='text' name='shareholder_name[0]'/></td>";
			echo "<td><input   type='text' name='shareholder_name[0]'/></td>";
			echo "<td><input   type='text' name='shareholder_name[0]'/></td>";
			echo "<td><input   type='text'name='stock_ratio[0]'/></td>";
			echo "<td><input   type='button' value='删除' onclick='delLine(this)'/></td>";
            echo "</tr>";
        }
        ?>
		    	</table>
					</td>
					<!-- 没有字段-->
				</tr>
				<tr>
					<td colspan="9"><input class="easyui-validatebox" required="true"
						type="button" value="添加" onclick="addLine()" /></td>
					<!-- 没有字段-->
				</tr>

				<tr>
					<td colspan="7"><h3>2、项目实施所需的其他配套条件:</h3></td>
				</tr>
				<tr>
					<td colspan="7"><textarea name="pro_cond"
							class="easyui-validatebox" required="true"></textarea></td>
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
