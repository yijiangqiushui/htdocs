<?php
include '../../../../center/php/config.ini.php';
include '../../../../common/php/config.ini.php';
include '../../../../common/php/lib/db.cls.php';
session_start();
$db = new DB();
?>
<!DOCTYPE html PUBLIC "-//W5C//DTD XHTML 1.0 Transitional//EN" "http://www.w5.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w5.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>项目经费总决算表</title>
<link rel="stylesheet" type="text/css"
	href="../../../../common/html/plugin/easyui/themes/default/easyui.css" />
<link rel="stylesheet" type="text/css"
	href="../../../../common/html/plugin/easyui/themes/icon.css" />


<script type="text/javascript"
	src="../../../../center/html/view/js/jquery-1.11.2.min.js"></script>
<script type="text/javascript"
	src="../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript"
	src="../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>
<script type="text/javascript" src="../../view/js/task_total_funds.js"></script>

<link rel="stylesheet" type="text/css" href="../css/table.css" />
<link rel="stylesheet" type="text/css" href="../css/button.css" />
<style type="text/css">
input {
	height: 100%;
	width: 100%;
	border: 0;
	ont-family: "微软雅黑";
	font-size: 16px;
	background-color:transparent;
	
}
tr:nth-child(odd) {
	background-color: #D1E4F3;
	border: solid 2px #ffffff;
}

tr:nth-child(even) {
	background-color: #EAF3FA;
	border: solid 2px #ffffff;
}

td {
	text-align: center;
	border: solid 2px #ffffff;
}

th {
	height: 32px;
	fond-family: '黑体';
	color: #FFFFFF;
	font-size: 1.0em;
	background-color: #7AB5ED;
	border: solid 2px #ffffff;
}
body {
	text-align: center;
	margin: auto 0;
	border:0;
}
</style>
</head>
<body>
<div>
	<img src="../../view/img/newimg/用户信息底.png"
	style="position: absolute; left: 120px; top: 70px;height:1290px; width: 1020px;margin-top:0px;margin-bottom:40px; z-index: 1;" />
		</div>
 <div style="position: absolute;left: 1030px; top:41.5px; z-index: 3;">
   <img src="../../view/img/newimg/返回.png" style="width: 70px; height: 27px;repeat:no-repeat;"/></div>

    <div style="width: 270px; height: 80%; margin-top: 40px; margin-left: 0px;">
						<img src="../../view/img/newimg/用户信息底.png"
							style="position: absolute; left: 120px; top: 40px; width: 1020px; height: 30px; z-index: 1;"/></div>

							<div style="position: absolute; left: 130px; top: 42px; width: 120px; height: 25px;
		         background-image:url('../../view/img/新建项目.png');background-size:cover ;z-index: 3;color:#FFFFFF;vertical-align: center;text-align: center;">项目内容</div>
						
						
<div style="position: absolute;left: 130px; top: 90px; width: 1000px; z-index: 3;">

	<div style="width: 100%; height: 100%; border: 1px;">
		<form method="post" id="total_funds">
			<table  style="border: solid 2px #ffffff;height:100%;width:99.5%;" cellspacing="0">
				<tr>
					<td colspan=10 style="background-color: #7AB5ED; height: 20px;">
						<center>
							<p style="height: 18px; color: #FFF002">项目经费预算</p>
						</center>

					</td>
				</tr>
				<tr>
					<td colspan="5" class="bt">项目经费来源：</td>
					<td colspan="5" class="bt"><center>
							单位：万元
							<center /></td>
				</tr>
				<tr>
					<td colspan="5">来 源</td>
					<td >任务书预算经费</td>
					<td >核减经费</td>
					<td colspan="2">实际到位经费</td>
				</tr>

				<tr>
					<td colspan="5" class="bt"><center>区财政科技经费</center></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="bgt_fund[0]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="reduce_fund[0]" /></td>
					<td colspan="2"><input class="easyui-validatebox" required="true" type="text"
						name="actual_fund[0]" /></td>
				</tr>
				<tr>
					<td colspan="5" class="bt"><center>项目承担单位自筹经费</center></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="bgt_fund[1]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="reduce_fund[1]" /></td>
					<td colspan="2"><input class="easyui-validatebox" required="true" type="text"
						name="actual_fund[1]" /></td>
				</tr>
				<tr>
					<td colspan="5" class="bt"><center>其 他</center></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="bgt_fund[2]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="reduce_fund[2]" /></td>
					<td colspan="2"><input class="easyui-validatebox" required="true" type="text"
						name="actual_fund[2]" /></td>
				</tr>
				<tr>
					<td colspan="5" class="bt"><center>合 计</center></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
					<td colspan="2"><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
				</tr>
				<tr>
					<td colspan="5" class="bt">项目经费支出：</td>
					<td colspan="5" class="bt"><center>
							单位：万元
							<center /></td>
				</tr>
				<tr>
					<td colspan="9" class="bt">项目经费支出预算：</td>
				</tr>
				<tr>
					<td colspan="4" class="bt">科 目</td>
					<td class="bt">经费来源</td>
					<td class="bt">任务书预算经费</td>
					<td class="bt">核减经费</td>
					<td class="bt">调整经费</td>
					<td class="bt">实际支出经费</td>
				</tr>
				<tr>
					<td rowspan="2" colspan="4" class="bt">设备费</td>
					<td class="bt">区财政科技经费</td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="teach_budget_fund[0]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="teach_reduce_fund[0]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="teach_adjust_fund[0]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="teach_actual_fund[0]" /></td>
				</tr>
				<tr>
					<td class="bt">其他来源</td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="other_budget_fund[0]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="other_reduce_fund[0]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="other_adjust_fund[0]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="other_actual_fund[0]" /></td>
				</tr>
				<tr>
					<td rowspan="2" colspan="4" class="bt">材料费</td>
					<td class="bt">区财政科技经费</td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="teach_budget_fund[1]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="teach_reduce_fund[1]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="teach_adjust_fund[1]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="teach_actual_fund[1]" /></td>
				</tr>
				<tr>
					<td class="bt">其他来源</td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="other_budget_fund[1]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="other_reduce_fund[1]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="other_adjust_fund[1]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="other_actual_fund[1]" /></td>
				</tr>
				<td rowspan="2" colspan="4" class="bt">测试化验加工费</td>
				<td class="bt">区财政科技经费</td>
				<td><input class="easyui-validatebox" required="true" type="text"
					name="teach_budget_fund[2]" /></td>
				<td><input class="easyui-validatebox" required="true" type="text"
					name="teach_reduce_fund[2]" /></td>
				<td><input class="easyui-validatebox" required="true" type="text"
					name="teach_adjust_fund[2]" /></td>
				<td><input class="easyui-validatebox" required="true" type="text"
					name="teach_actual_fund[2]" /></td>
				</tr>
				<tr>
					<td class="bt">其他来源</td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="other_budget_fund[2]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="other_reduce_fund[2]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="other_adjust_fund[2]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="other_actual_fund[2]" /></td>
				</tr>
				<tr>
					<td rowspan="2" colspan="4" class="bt">燃料动力费</td>
					<td class="bt">区财政科技经费</td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="teach_budget_fund[3]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="teach_reduce_fund[3]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="teach_adjust_fund[3]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="teach_actual_fund[3]" /></td>
				</tr>
				<tr>
					<td class="bt">其他来源</td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="other_budget_fund[3]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="other_reduce_fund[3]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="other_adjust_fund[3]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="other_actual_fund[3]" /></td>
				</tr>
				<tr>
					<td rowspan="2" colspan="4" class="bt">国际合作与交流费</td>
					<td class="bt">区财政科技经费</td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="teach_budget_fund[4]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="teach_reduce_fund[4]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="teach_adjust_fund[4]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="teach_actual_fund[4]" /></td>
				</tr>
				<tr>
					<td class="bt">其他来源</td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="other_budget_fund[4]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="other_reduce_fund[4]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="other_adjust_fund[4]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="other_actual_fund[4]" /></td>
				</tr>
				<tr>
					<td rowspan="2" colspan="4" class="bt">差旅费</td>
					<td class="bt">区财政科技经费</td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="teach_budget_fund[5]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="teach_reduce_fund[5]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="teach_adjust_fund[5]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="teach_actual_fund[5]" /></td>
				</tr>
				<tr>
					<td class="bt">其他来源</td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="other_budget_fund[5]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="other_reduce_fund[5]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="other_adjust_fund[5]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="other_actual_fund[5]" /></td>
				</tr>
				<tr>
					<td rowspan="2" colspan="4" class="bt">会议费</td>
					<td class="bt">区财政科技经费</td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="teach_budget_fund[6]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="teach_reduce_fund[6]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="teach_adjust_fund[6]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="teach_actual_fund[6]" /></td>
				</tr>
				<tr>
					<td class="bt">其他来源</td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="other_budget_fund[6]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="other_reduce_fund[6]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="other_adjust_fund[6]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="other_actual_fund[6]" /></td>
				</tr>
				<tr>
					<td rowspan="2" colspan="4" class="bt">档案出版、文献信息传播、知识产权事务费</td>
					<td class="bt">区财政科技经费</td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="teach_budget_fund[7]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="teach_reduce_fund[7]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="teach_adjust_fund[7]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="teach_actual_fund[7]" /></td>
				</tr>
				<tr>
					<td class="bt">其他来源</td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="other_budget_fund[7]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="other_reduce_fund[7]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="other_adjust_fund[7]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="other_actual_fund[7]" /></td>
				</tr>
				<td rowspan="2" colspan="4" class="bt">劳务费</td>
				<td class="bt">区财政科技经费</td>
				<td><input class="easyui-validatebox" required="true" type="text"
					name="teach_budget_fund[8]" /></td>
				<td><input class="easyui-validatebox" required="true" type="text"
					name="teach_reduce_fund[8]" /></td>
				<td><input class="easyui-validatebox" required="true" type="text"
					name="teach_adjust_fund[8]" /></td>
				<td><input class="easyui-validatebox" required="true" type="text"
					name="teach_actual_fund[8]" /></td>
				</tr>
				<tr>
					<td class="bt">其他来源</td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="other_budget_fund[8]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="other_reduce_fund[8]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="other_adjust_fund[8]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="other_actual_fund[8]" /></td>
				</tr>
				<td rowspan="2" colspan="4" class="bt">专家咨询费</td>
				<td class="bt">区财政科技经费</td>
				<td><input class="easyui-validatebox" required="true" type="text"
					name="teach_budget_fund[9]" /></td>
				<td><input class="easyui-validatebox" required="true" type="text"
					name="teach_reduce_fund[9]" /></td>
				<td><input class="easyui-validatebox" required="true" type="text"
					name="teach_adjust_fund[9]" /></td>
				<td><input class="easyui-validatebox" required="true" type="text"
					name="teach_actual_fund[9]" /></td>
				</tr>
				<tr>
					<td class="bt">其他来源</td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="other_budget_fund[9]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="other_reduce_fund[9]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="other_adjust_fund[9]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="other_actual_fund[9]" /></td>
				</tr>
				<td class="bt" rowspan="2" colspan="4">其他费用</td>
				<td class="bt">区财政科技经费</td>
				<td><input class="easyui-validatebox" required="true" type="text"
					name="teach_budget_fund[10]" /></td>
				<td><input class="easyui-validatebox" required="true" type="text"
					name="teach_reduce_fund[10]" /></td>
				<td><input class="easyui-validatebox" required="true" type="text"
					name="teach_adjust_fund[10]" /></td>
				<td><input class="easyui-validatebox" required="true" type="text"
					name="teach_actual_fund[10]" /></td>
				</tr>
				<tr>
					<td class="bt">其他来源</td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="other_budget_fund[10]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="other_reduce_fund[10]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="other_adjust_fund[10]" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="other_actual_fund[10]" /></td>
				</tr>
				<tr>
					<td class="bt" colspan="5"><strong>合 计</strong></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
				</tr>
				<tr>
					<td class="bt" colspan="4">区财政科技经费总合计</td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
					<td class="bt" colspan="3">其他来源总合计:</td>
					<td><input class="easyui-validatebox" required="true" type="text"
						name="" /></td>
				</tr>

				<tr>
					<td colspan="9" class="bt">仪器设备购置费用明细：（单价在5万元以上，含5万元）</td>
				</tr>


				<tr>
					<td colspan="9">
						<table width="100%"cellspacing="0"
							style="margin-bottom: 0;" id="addtable">
							<tr>
								<td class="bt">名 称</td>
								<td class="bt">型号</td>
								<td class="bt">任务计划金额（单价）</td>
								<td class="bt">实际购买数量</td>
								<td class="bt">实际支付金额（单价）</td>
								<td class="bt">资金来源</td>
								<td class="bt">购买时间</td>
								<td class="bt">主要用途</td>
								<td class="bt">操作</td>
							</tr>
		<?php
$project_id = $_SESSION['project_id'];
$sql = "Select * from equipment where project_id='$project_id'";
$result = $db->SelectOri($sql);
$tableRow = mysql_num_rows($result);
if ($tableRow) {
    for ($i = 0; $i < $tableRow; $i ++) {
        $row = mysql_fetch_object($result);
        echo "<tr>";
        echo "<td><input type='text' name='eqpt_name[$i]' value='$row->eqpt_name'/></td>";
        echo "<td><input type='text' name='eqpt_model[$i]' value='$row->eqpt_model'/></td>";
        echo "<td><input type='text' name='plan_money[$i]' value='$row->plan_money'/></td>";
        echo "<td><input type='text' name='actual_num[$i]' value='$row->actual_num'/></td>";
        echo "<td><input type='text' name='actual_pay[$i]' value='$row->actual_pay'/></td>";
        echo "<td><input type='text' name='fund_src[$i]' value='$row->fund_src'/></td>";
        echo "<td><input type='text' name='buy_time[$i]' value='$row->buy_time'/></td>";
        echo "<td><input type='text' name='main_use[$i]' value='$row->main_use'/></td>";
        echo "<td><input type='button' value='删除' onclick='delLine(this)'/></td>";
        echo "</tr>";
    }
} else {
    echo "<tr>";
    echo "<td width='110'><input type='text' name='eqpt_name[0]'/></td>";
    echo "<td width='267'><input type='text'name='eqpt_model[0]'/></td>";
    echo "<td width='267'><input type='text'name='plan_money[0]'/></td>";
    echo "<td width='267'><input type='text'name='actual_num[0]'/></td>";
    echo "<td width='267'><input type='text'name='actual_pay[0]'/></td>";
    echo "<td width='267'><input type='text'name='fund_src[0]'/></td>";
    echo "<td width='267'><input type='text'name='buy_time[0]'/></td>";
    echo "<td width='267'><input type='text'name='main_use[0]'/></td>";
    echo "<td width='267' ><input type='button' value='删除' onclick='delLine(this)'/></td>";
    echo "</tr>";
}
?>
</table>
</td>
</tr>
         <tr>
			<td colspan="9" height="25"><input type="button" value="添加" onclick="addLine()" /></td>
		 </tr>
	<div class="wrapper"style="position: absolute;left: 385px; bottom:-140px; z-index: 6;cursor: pointer;margin-bottom:40px">
       <div class="save" ><div>保存</div></div>
       <div class="reset" ><div>重置</div></div>
    </div>
</table>
</form>
</div>

</div>

		

</body>
</html>
