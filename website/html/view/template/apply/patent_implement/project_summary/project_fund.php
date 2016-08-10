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

<script src="../../../../../../../common/html/js/datecommon.js"></script>

<script type="text/javascript"
	src="../../../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript"
	src="../../../../../../../common/html/plugin/easyui/jquery.cookie.js"></script>
<script type="text/javascript"
	src="../../../../../../../common/html/plugin/jquery-hlui-2.0/js/hlui.js"></script>
<script type="text/javascript" src="../../../../../../../common/html/plugin/jquery-hlui-2.0/js/form.js"></script>
<script type="text/javascript" src="../../../../../../../common/html/js/validation.js"></script>
<script type="text/javascript"
	src="../../../../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>
<script type="text/javascript" src="../../../../../../../common/html/js/tablecommon.js"></script>
<script type="text/javascript"
	src="../../../../js/apply/project_summary/project_fund.js"></script>

</head>

<body>
	<form id="project_fund" method="post">
		<div class="project_content">·
			<div class="table_title clearfix">
				<div class="title_pic left">专利经费总决算表</div>
				<div class="right back_pic" id="back"></div>
			</div>

			<div class="table_content back-long">
				<table cellspacing="0" cellpadding="0" class="basic_info">
					<tr>
						<td colspan="7">
							<p class="title_top p-b10">通州区专利实施项目经费总决算表</p>
						</td>
					</tr>
					
					<tr>
						<th colspan="2"><p align="center">项目名称</p></th>
						<td colspan="5"><input  type="text" name="project_name"></td>
					</tr>
					<tr>
						<th colspan="2"><p align="center">项目编号</p></th>
						<td ><input type="text" name="business_id"  readonly></td>
						<th style='width:136px;'><p align="center">开始时间</p></th>
						<td ><input name="start_time"  id="start_time" class='dateplu' readonly></td>
						<th style='width:136px;'>结束时间</th>
						<td><input name='end_time'  id="end_time" class='dateplu' readonly /></td>
					</tr>
					<tr>
						<th colspan="2"><p align="center">项目承担单位</p></th>
						<td colspan="5"><input name="org_name" readonly /></td>
					</tr>
					<tr>
						<th rowspan="7"><p align="center">经费来源</p></th>
						<th></th>
						<th colspan="2"><p align="center">经费来源预算</p></th>
						<th colspan="3"><p align="center">实际到位经费</p></th>
						
					</tr>

					<tr>
						<th ><p align="center" name="community" value="1">区专利实施经费</p></th>
						<td colspan="2"><input name="bgt_fund[0]" type="text" datatype="float" value='0' ></td>
						<td colspan="3"><input name="actual_fund1[0]" type="text" datatype="float" value='0' ></td>
					</tr>
					<tr>
						<th ><p align="center" name="major" value="2">市级以上拨款</p></th>
						<td colspan="2"><input name="bgt_fund[1]" datatype="float" value='0' ></td>
						<td colspan="3"><input name="actual_fund1[1]" datatype="float" value='0' ></td>
					</tr>
					<tr>
						<th ><p align="center" name="unit" value="3">单位自筹</p></th>
						<td colspan="2"><input name="bgt_fund[2]" datatype="float" value='0' ></td>
						<td colspan="3"><input name="actual_fund1[2]" datatype="float" value='0' ></td>
					</tr>
					<tr>
						<th ><p align="center" name="debt" value="4">银行贷款</p></th>
						<td colspan="2"><input name="bgt_fund[3]" datatype="float" value='0' ></td>
						<td colspan="3"><input name="actual_fund1[3]" datatype="float" value='0' ></td>
					</tr>
						<tr>
						<th ><p align="center" name="other" value="5">其它</p></th>
						<td colspan="2"><input name="bgt_fund[4]" datatype="float" value='0' ></td>
						<td colspan="3"><input name="actual_fund1[4]" datatype="float" value='0' ></td>
					</tr>
					<tr>
						<th ><p align="center" >合计</p></th>
						<td colspan="2"><input name="bgt_fund_total" datatype="float" value='0' ></td>
						<td colspan="3"><input name="actualsrc_fund_total" datatype="float" value='0' ></td>
					</tr>
				
					<tr>
						<th rowspan="13"><p align="center">经费支出</p></th>
						<th></th>
						<th ><p align="center">支出预算</p></th>
						<th ><p align="center">实际支出</p></th>
						<th colspan="3"><p align="center">其中：区专利实施经费支出</p></th>	
					</tr>
					
					<tr>
						<th><p align="center">设备费</p></th>
						<td><input type="text" name="budget_fund[0]" datatype="float" value='0' /></td>
						<td><input type="text" name="actual_fund[0]" datatype="float" value='0' /></td>
						<td colspan="3"><input type="text" name="patent_out[0]" datatype="float" value='0' /></td>
					</tr>
					<tr>
						<th><p align="center">材料费</p></th>
						<td><input type="text" name="budget_fund[1]" datatype="float" value='0' /></td>
						<td><input type="text" name="actual_fund[1]" datatype="float" value='0' /></td>
						<td colspan="3"><input type="text" name="patent_out[1]" datatype="float" value='0' /></td>
					</tr>
					<tr>
						<th><p align="center">测试化验加工费</p></th>
						<td><input type="text" name="budget_fund[2]" datatype="float" value='0' /></td>
						<td><input type="text" name="actual_fund[2]" datatype="float" value='0' /></td>
						<td colspan="3"><input type="text" name="patent_out[2]" datatype="float" value='0' /></td>
					</tr>
					<tr>
						<th><p align="center">燃料动力费</p></th>
						<td><input type="text" name="budget_fund[3]" datatype="float" value='0' /></td>
						<td><input type="text" name="actual_fund[3]" datatype="float" value='0' /></td>
						<td colspan="3"><input type="text" name="patent_out[3]" datatype="float" value='0' /></td>
					</tr>
					<tr>
						<th><p align="center">国际合作与交流费</p></th>
						<td><input type="text" name="budget_fund[4]" datatype="float" value='0' /></td>
						<td><input type="text" name="actual_fund[4]" datatype="float" value='0' /></td>
						<td colspan="3"><input type="text" name="patent_out[4]" datatype="float" value='0' /></td>
					</tr>
					<tr>
						<th><p align="center">差旅费</p></th>
						<td><input type="text" name="budget_fund[5]" datatype="float" value='0' /></td>
						<td><input type="text" name="actual_fund[5]" datatype="float" value='0' /></td>
						<td colspan="3"><input type="text" name="patent_out[5]" datatype="float" value='0' /></td>
					</tr>
					<tr>
						<th><p align="center">会议费</p></th>
						<td><input type="text" name="budget_fund[6]" datatype="float" value='0' /></td>
						<td><input type="text" name="actual_fund[6]" datatype="float" value='0' /></td>
						<td colspan="3"><input type="text" name="patent_out[6]" datatype="float" value='0' /></td>
					</tr>
					<tr>
						<th><p align="center">档案出版、文献信息传播、知识产权事务费</p></th>
						<td><input type="text" name="budget_fund[7]" datatype="float" value='0' /></td>
						<td><input type="text" name="actual_fund[7]" datatype="float" value='0' /></td>
						<td colspan="3"><input type="text" name="patent_out[7]" datatype="float" value='0' /></td>
					</tr>
					<tr>
						<th><p align="center">劳务费</p></th>
						<td><input type="text" name="budget_fund[8]" datatype="float" value='0' /></td>
						<td><input type="text" name="actual_fund[8]" datatype="float" value='0' /></td>
						<td colspan="3"><input type="text" name="patent_out[8]" datatype="float" value='0' /></td>
					</tr>
					<tr>
						<th><p align="center">专家咨询费</p></th>
						<td><input type="text" name="budget_fund[9]" datatype="float" value='0' /></td>
						<td><input type="text" name="actual_fund[9]" datatype="float" value='0' /></td>
						<td colspan="3"><input type="text" name="patent_out[9]" datatype="float" value='0' /></td>
					</tr>
					<tr>
						<th><p align="center">其它费用</p></th>
						<td><input type="text" name="budget_fund[10]" datatype="float" value='0' /></td>
						<td><input type="text" name="actual_fund[10]" datatype="float" value='0' /></td>
						<td colspan="3"><input type="text" name="patent_out[10]" datatype="float" value='0' /></td>
					</tr>	
					<tr>
						<th><p align="center">合计</p></th> 
						<td><input type="text" name="total[0]"  readonly/></td>	
						<td><input type="text" name="total[1]"  readonly/></td>	
						<td colspan="3"><input type="text" name="total[2]"  readonly/></td>	
					</tr>
				
				</table>
				
				<div class="button_wrapper clearfix d-n">                                                                                                                                                                                                      
					<div class="save">保存</div>
				 </div>
			</div>
		</div>

	</form>


</body>
</html>
