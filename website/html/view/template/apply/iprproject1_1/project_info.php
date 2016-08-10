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
	src="../../../../../../common/html/plugin/easyui/jquery.min.js"></script>
<script type="text/javascript"
	src="../../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript"
	src="../../../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>
<script type="text/javascript"
	src="../../../js/apply/iprproject1_1/project_info.js"></script>

<style type="text/css">
input {
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
		<form method="post" id="project_info">
			<table width="500" height="291" border="1" cellspacing="0">
				<tr>
					<td height="44" colspan="8"><h2>二、项目基本情况</h2></td>
				</tr>
				<tr>
					<td width="84">项目名称</td>
					<td colspan="4"><input type="text" name="project_name"
						class="easyui-validatebox" required="true" /></td>
					<td width="81">计划完成时间</td>
					<td colspan="2"><input type="text" name="planfinish_time"
						class="easyui-validatebox" required="true" /></td>
				</tr>
				<tr>
					<td>项目负责人</td>
					<td width="54"><input type="text" name="leader_name"
						class="easyui-validatebox" required="true" /></td>
					<td width="67">性别</td>
					<td width="64"><input type="text" name="leader_sex"
						class="easyui-validatebox" required="true" /></td>
					<td width="73">出生年月</td>
					<td><input type="text" name="leader_birth"
						class="easyui-validatebox" required="true" /></td>
					<td width="65">最高学历</td>
					<td width="78"><input type="text" name="leader_edu"
						class="easyui-validatebox" required="true" /></td>
				</tr>
				<tr>
					<td>技术领域</td>
					<td colspan="7"><input type="radio" name="tech_area" value="0">1电子与信息</input>
						<input type="radio" name="tech_area" value="1">2.生物、医药</input> <input
						type="radio" name="tech_area" value="2">3、新材料</input> <input
						type="radio" name="tech_area" value="3">4、光电一体化 </input> <input
						type="radio" name="tech_area" value="4">5.资源与环境</input> <input
						type="radio" name="tech_area" value="5">6.新能源、高能效 </input> <input
						type="radio" name="tech_area" value="6">7.其他高技术</input></td>
				</tr>
				<tr>
					<td height="67">技术水平</td>

					<td colspan="7"><input type="radio" name="tech_level" value="0">1.国际领先水平
					</input> <input type="radio" name="tech_level" value="1">2.国际先进水平 </input>
						<input type="radio" name="tech_level" value="2">3.国内领先水平</input> <input
						type="radio" name="tech_level" value="3"> 4.国内先进水平</input></td>
				</tr>
				<tr>
					<td height="29">项目阶段</td>

					<td colspan="7"><input type="radio" name="project_stage" value="0">1.研发阶段</input>
						<input type="radio" name="project_stage" value="1"> 2.中试阶段</input>
						<input type="radio" name="project_stage" value="2"> 3.批量（规模）生产</input>
					</td>
				</tr>
				<tr>
					<td height="64">项目主要优势</td>


					<td colspan="7"><input type="radio" name="project_advantage"
						value="0">1.市场前景很好 </input> <input type="radio"
						name="project_advantage" value="1"> 2.产品或工业创新性突出</input> <input
						type="radio" name="project_advantage" value="2"> 3.经济效益显著</input>
						<input type="radio" name="project_advantage" value="3">4.社会效益显著 </input>
						<input type="radio" name="project_advantage" value="4">5.其他 </input>
					</td>
				</tr>
				<tr>
					<td rowspan="3"><p>项目获</p>
						<p>专利情况</p></td>
					<td rowspan="3">已获专利授权</td>
					<td colspan="2" rowspan="3"><input class="easyui-validatebox"
						required="true" type="text" name="patent_num" /></td>
					<td height="35" colspan="2">发明</td>
					<td colspan="2"><input class="easyui-validatebox" required="true"
						type="text" name="invent_num" /></td>
				</tr>
				<tr>
					<td height="35" colspan="2">实用新型</td>
					<td colspan="2"><input class="easyui-validatebox" required="true"
						type="text" name="function_patent" /></td>
				</tr>
				<tr>
					<td colspan="2" height="35">外观设计</td>
					<td colspan="2"><input class="easyui-validatebox" required="true"
						type="text" name="patent_design" /></td>
				</tr>
				<tr>
					
		    		
  	    		
		<?php
		// $org_code = $_SESSION['org_code'];
		$org_code = '01234567';
		// $project_id = $_SESSION['project_id'];
		$project_id = '121212';
		$sql = "Select * from patent_list where project_id=$project_id";
		$conn = mysql_connect ( "david", "FRED", "123456" );
		mysql_select_db ( "project", $conn );
		$result = mysql_query ( $sql, $conn );
		$tableRow = mysql_num_rows ( $result );
		echo "  <tr>
        <td rowspan='1'>专利名称</td>";
		echo "<td colspan='7'>
						<table width='570' border='1'cellspacing='0'
							style='margin-bottom: 0;' id='addtable'>";
		if ($tableRow) {
			
			for($i = 0; $i < $tableRow; $i ++) {
				$row = mysql_fetch_object ( $result );
				echo "<tr>";
				echo "<td width='200'><input type='text' name='patent_name[$i]' value='$row->patent_name'/></td>";
				echo "<td width='40'>专利号</td>";
				echo "<td><input type='text' name='patent_code[$i]' value='$row->patent_code'/></td>";
				echo "<td width='100'><input type='button' value='删除' onclick='delLine(this)'/></td>";
				echo "</tr>";
			}
		} else {
			echo "<tr>";
			echo "<td width='200'><input type='text' name='patent_name[0]'/></td>";
			echo "<td width='40'>专利号</td>";
			echo "<td width='267'><input type='text'name='patent_code[0]'/></td>";
			echo "<td width='40' ><input type='button' value='删除' onclick='delLine(this)'/></td>";
			echo "</tr>";
		}
		echo "</td></table>";
		?>
		    	
		    	
				</tr>
				<tr>
					<td colspan="9" height="25"><input class="easyui-validatebox"
						required="true" type="button" value="添加" onclick="addLine()" /></td>
					<!-- 没有字段-->
				</tr>



				<tr>
					<td>项目简介</td>
					<td colspan="7"><textarea class="easyui-validatebox"
							required="true" name="coproject_summary"></textarea></td>
				</tr>
				<tr>
					<td rowspan="4">项目上一年度指标</td>
					<td colspan="2" height="35">就业人数</td>
					<td colspan="2"><input class="easyui-validatebox" required="true"
						type="text" name="last_employ_num" /></td>
					<td>年净利润</td>
					<td colspan="2"><input class="easyui-validatebox" required="true"
						type="text" name="last_year_profit" /></td>
				</tr>
				<tr>
					<td colspan="2" height="35">年工业总产值</td>
					<td colspan="2"><input class="easyui-validatebox" required="true"
						type="text" name="last_industry_num" /></td>
					<td>年缴税总额</td>
					<td colspan="2"><input class="easyui-validatebox" required="true"
						type="text" name="last_tax_sum" /></td>
				</tr>
				<tr>
					<td colspan="2" height="35">年工业增加值</td>
					<td colspan="2"><input class="easyui-validatebox" required="true"
						type="text" name="last_industry_add" /></td>
					<td>年创汇</td>
					<td colspan="2"><input class="easyui-validatebox" required="true"
						type="text" name="last_foreign_tax" /></td>
				</tr>
				<tr>
					<td colspan="2" height="35">年产品销售额</td>
					<td colspan="2"><input class="easyui-validatebox" required="true"
						type="text" name="last_sell_sum" /></td>
					<td>市场占有率</td>
					<td colspan="2"><input class="easyui-validatebox" required="true"
						type="text" name="last_market_share" /></td>
				</tr>
				<tr>
					<td rowspan="4">项目计划完成时年度指标</td>
					<td colspan="2" height="35">就业人数</td>
					<td colspan="2"><input class="easyui-validatebox" required="true"
						type="text" name="employ_num" /></td>
					<td>年净利润</td>
					<td colspan="2"><input class="easyui-validatebox" required="true"
						type="text" name="year_profit" /></td>
				</tr>
				<tr>
					<td colspan="2" height="35">年工业总产值</td>
					<td colspan="2"><input class="easyui-validatebox" required="true"
						type="text" name="industry_num" /></td>
					<td>年缴税总额</td>
					<td colspan="2"><input class="easyui-validatebox" required="true"
						type="text" name="tax_sum" /></td>
				</tr>
				<tr>
					<td colspan="2" height="35">年工业增加值</td>
					<td colspan="2"><input class="easyui-validatebox" required="true"
						type="text" name="industry_add" /></td>
					<td>年创汇</td>
					<td colspan="2"><input class="easyui-validatebox" required="true"
						type="text" name="foreign_tax" /></td>
				</tr>
				<tr>
					<td colspan="2" height="35">年产品销售额</td>
					<td colspan="2"><input class="easyui-validatebox" required="true"
						type="text" name="sell_sum" /></td>
					<td>市场占有率</td>
					<td colspan="2"><input class="easyui-validatebox" required="true"
						type="text" name="market_share" /></td>
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
