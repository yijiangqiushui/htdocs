<?php
    include '../../../../../../center/php/config.ini.php';
    include '../../../../../../common/php/config.ini.php';
    include '../../../../../../common/php/lib/db.cls.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>项目基本情况</title>
<!--部分可做成动态-->

<link rel="stylesheet" type="text/css" href="../../../../../../common/html/plugin/easyui/themes/default/easyui.css" />
<link rel="stylesheet" type="text/css" href="../../../../../../common/html/plugin/easyui/themes/icon.css" />
　
<link rel="stylesheet" type="text/css" href="../../../css/button.css" />
<link rel="stylesheet" type="text/css" href="../../../css/table.css"/>
<script type="text/javascript" src="../../../../../../common/html/js/validation.js"></script>

<script type="text/javascript" src="../../../../../../common/html/plugin/easyui/jquery.min.js"></script>
<script type="text/javascript" src="../../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="../../../../../../common/html/plugin/jquery-hlui-2.0/js/hlui.js"></script>
<script type="text/javascript" src="../../../../../../common/html/plugin/jquery-hlui-2.0/js/form.js"></script>
<script type="text/javascript" src="../../../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>
        <script type="text/javascript" src="../../../../../../common/html/js/validation.js"></script>
<script src="../../../../../../common/html/js/tablecommon.js"></script>
<script type="text/javascript" src="../../../js/apply/project3_info.js"></script>

</head>

<body>
		<form method="post" id="3project_info_fm">
    		<div class="project_content">
    		  <div class="table_title clearfix">
                <div class="title_pic left">项目申报书</div>
                <div class="right back_pic" id="back"></div>
              </div>
            <div class="table_content back-long">
			<table cellspacing="0" cellpadding="0" class="basic_info">
			    <tr>
                    <td colspan="8" class="border_left_none" style="background-color:#7AB5ED;">
                        <div class="title_top p-b10">项目基本信息</div>
                    </td>
                </tr>
				<tr>
					<th width="180px"><p align="center">项目名称</p></th>
					<td colspan="8"><input name="project_name" readonly/></td>
				</tr>
				
				<tr>
					<th><p align="center">项目建设地点</p></th>
					<td colspan="8"><input  name="project_place" /></td>
				</tr>
				
				<tr>
					<th><p align="center">技术领域</p></th>
					<td colspan="4"><input name="tech_area" /></td>
					<th colspan="1"><p align="center">项目技术水平</p></th>
					<td colspan="3"><input name="tech_level" /></td>
				</tr>
				
				<tr>
				    <th rowspan="3"><p align="center">项目技术水平证明材料</p></th>
					<td colspan="7">
						<table width="100%" id="addtable" cellspacing="0" cellpadding="0">
        					<tr>
                				<th colspan="2"><p align="center">知识产权名称</p></th>
                				<th colspan="2"><p align="center">类别</p></th>
                				<th colspan="2"><p align="center">授权号</p></th>
                				<th width="50px"><p align="center">操作</p></th>
        			        </tr>
        		    		<?php
        						$project_id = $_SESSION ['project_id'];
        						$db = new DB ();
        						$sql = "select * from tech_material where project_id = '$project_id' ";
        						$result = $db->SelectOri ( $sql );
        						$tableRow = mysql_num_rows ( $result );
        						if ($tableRow) {
        							for($i = 0; $i < $tableRow; $i ++) {
        								$row = mysql_fetch_object ( $result );
        								echo "<tr>";
        								echo "<td colspan='2' ><input  type='text' name='intel_property[$i]' value='$row->intel_property'/></td>";
        								echo "<td colspan='2'><input  type='text' name='type[$i]' value='$row->type'/></td>";
        								echo "<td colspan='2'><input  type='text' name='auth_code[$i]' value='$row->auth_code'/></td>";
        								echo "<td width='50px'><input type='button' value='删除' class='pointer' onclick='delLine(this)'/></td>";
        								echo "</tr>";
        							}
        						} else {
        							echo "<tr>";
        							echo "<td colspan='2'><input type='text' name='intel_property[0]'/></td>";
        							echo "<td colspan='2'><input  type='text' name='type[0]'/></td>";
        							echo "<td colspan='2'> <input  type='text'  name='auth_code[0]'/></td>";
        							echo "<td width='50px'><input type='button' value='删除' class='pointer'  onclick='delLine(this)'/></td>";
        							echo "</tr>";
        						}
        					?>
		    	         </table>
		    	    </td>
		    	</tr>
				<tr>
					<th colspan="9"><input type="button" value="添加" class='pointer' onclick="addLine()" /></th>
				</tr>
				
				<tr>
					<th colspan="3"><p align="center">其他证明材料</p></th>
					<td colspan="5"><input name="others_material"/></td>
				</tr>
				
				<tr>
					<th rowspan="2"><p align="center">项目计划投资总额（万元）</p></th>
					<td colspan="3" rowspan="2"><input name="invest_total" datatype="float"/></td>
					<th colspan="1"><p align="center">其中已完成的实际投资额（万元）</p></th>
					<td colspan="4"><input name="invested" datatype="float"/></td>
				</tr>
				
				<tr>
					<th colspan="1"><p align="center">其中固定资产投资额（万元）</p></th>
					<td colspan="5"><input name="fixed_invest" datatype="float"/></td>
				</tr>
				
				<tr>
					<th rowspan="4"><p align="center">项目今年实现效益情况</p></th>
					<th style='min-width: 40px;'><p align="center">年度</p></th>
					<th><p align="center">产量（台/套）</p></th>
					<th><p align="center">销售收入（万元）</p></th>
					<th><p align="center">上缴税收（万元）</p></th>
					<th><p align="center">净利润（万元）</p></th>
					<th><p align="center">出口创汇（万美元）</p></th>
					<th colspan="2"><p align="center">新增就业（人）</p></th>
				</tr>
				
				<tr>
					<th><p align="center">近1年</p></th>
					<!-- 这里需要改成日历的控件 -->
					<td><input name="output1" datatype="number"/></td>
					<td><input name="sale_income1" datatype="float"/></td>
					<td><input name="tax1" datatype="float"/></td>
					<td><input name="profit1" datatype="float"/></td>
					<td><input name="foreign_income1" datatype="float"/></td>
					<td colspan="2"><input name="new_member1" datatype="number"/></td>
				</tr>
				
				<tr>
					<th><p align="center">近2年</p></th>
					<td><input name="output2" datatype="number"/></td>
					<td><input name="sale_income2" datatype="float"/></td>
					<td><input name="tax2" datatype="float"/></td>
					<td><input name="profit2" datatype="float"/></td>
					<td><input name="foreign_income2" datatype="float"/></td>
					<td colspan="2"><input name="new_member2" datatype="number"/></td>
				</tr>
				<tr>
					<th><p align="center">近3年</p></th>
					<td><input name="output3" datatype="number"/></td>
					<td><input name="sale_income3" datatype="float"/></td>
					<td><input name="tax3" datatype="float"/></td>
					<td><input name="profit3" datatype="float"/></td>
					<td><input name="foreign_income3" datatype="float"/></td>
					<td colspan="2"><input name="new_member3" datatype="number"/></td>
				</tr>

				<tr>
					<th><p align="center">项目情况概述（1000字以内）</p></th>
					<td colspan="8"><textarea name="coproject_summary" title="1000" maxlength="1000"></textarea></td>
				</tr>
			</table>
			<div class="button_wrapper clearfix">
			    <div class="save">保存</div>
       			<!-- <div class="reset" >重置</div> -->
			</div>
			</div>
		      
			</div>
		</form>
<script type="text/javascript">
	$invested = $("input[name='invested']");
	$fixed_invest = $("input[name='fixed_invest']");
	$invest_total = $("input[name='invest_total']");

	$invested.bind('input propertychange', change);
	$fixed_invest.bind('input propertychange', change);

	function change() {
		$invest_total.val(wt_add($invested.val(), $fixed_invest.val()));
	}
</script>
</body>
</html>
