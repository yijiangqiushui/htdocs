<?php
include '../../../../../../common/php/config.ini.php';
include '../../../../../../common/php/lib/db.cls.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>项目基本情况</title>

<link rel="stylesheet" type="text/css" href="../../../../../../common/html/plugin/easyui/themes/default/easyui.css" />
<link rel="stylesheet" type="text/css" href="../../../../../../common/html/plugin/easyui/themes/icon.css" />
<link rel="stylesheet" type="text/css" href="../../../../../../website/html/view/css/tablestyle.css" />
<link rel="stylesheet" type="text/css" href="../../../css/button.css" />
<link rel="stylesheet" type="text/css" href="../../../css/table.css"/>

<script type="text/javascript" src="../../../../../../common/html/plugin/easyui/jquery.min.js"></script>
<script type="text/javascript" src="../../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="../../../../../../common/html/plugin/jquery-hlui-2.0/js/hlui.js"></script>
<script type="text/javascript" src="../../../../../../common/html/plugin/jquery-hlui-2.0/js/form.js"></script>
<script type="text/javascript" src="../../../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>
<script src="../../../../../../common/html/js/tablecommon.js"></script>
        <script type="text/javascript" src="../../../../../../common/html/js/validation.js"></script>
<script type="text/javascript" src="../../../js/apply/project2_info.js"></script>
<style>
table  textarea {
	width: 95%;
	margin: 20px;
}
</style>
</head>
<body>
	<form method="post" id="2project_info_fm">
	<div class="project_content">
	   <div class="table_title clearfix">
	       <div class="title_pic left">项目申请书</div>
	       <div class="right back_pic" id="back"></div>
	   </div>
	   <div class="table_content back-long">
		<table cellspacing="0" cellpadding="0" class="basic_info">
			<tr>
				<td colspan="4" class="border_left_none" style="background-color:#7AB5ED;">
				<div class="title_top p-b10">项目基本情况</div>
				</td>
			</tr>
			
			<tr>
				<th width="180px"><p align="center">项目名称</p></th>
				<td colspan="3"><input name="project_name" readonly/></td>
			</tr>
			
			<tr>
				<th><p align="center">项目建设地点</p></th>
				<td colspan="3"><input name="project_place"/></td>
			</tr>
			
			<tr>
				<th><p align="center"></p>技术领域</th>
				<td ><input name="tech_area"  readonly/></td>
				<th width="180px"><p align="center">项目技术水平</p></th>
				<td width="250px"><input name="tech_level"/></td>
			</tr>
			
			<tr>
				<th rowspan="3"><p align="center">项目技术水平证明材料</p></th>
				<td colspan="3">
					<table id="addtable" cellspacing="0" cellpadding="0">
						<tr>
							<th><p align="center">知识产权名称</p></th>
							<th><p align="center">类别</p></th>
							<th><p align="center">授权号</p></th>
							<th><p align="center">操作</p></th>
						</tr>
						<?php
    						$project_id = $_SESSION ['project_id'];
    						$db = new DB ();
    						$sql = "Select * from tech_material where project_id='$project_id'";
    						$result = $db->SelectOri ( $sql );
    						$tableRow = mysql_num_rows( $result );
    						if ($tableRow) {
    							for($i = 0; $i < $tableRow; $i ++) {
    								$row = mysql_fetch_object ( $result );
    								echo "<tr>";
    								echo "<td><input type='text' name='intel_property[$i]' value='$row->intel_property' /></td>";
    								echo "<td><input type='text' name='type[$i]' value='$row->type'/></td>";
    								echo "<td><input type='text' name='auth_code[$i]' value='$row->auth_code'/></td>";
    								echo "<td><input type='button' value='删除' class='pointer but' onclick='delLine(this)'/></td>";
    								echo "</tr>";
    							}
    						} else {
    							echo "<tr>";
    							echo "<td width='110'><input type='text' name='intel_property[0]'/></td>";
    							echo "<td width='267'><input type='text'name='type[0]'/></td>";
    							echo "<td width='267'><input type='text'name='auth_code[0]'/></td>";
    							echo "<td width='40' ><input type='button' value='删除' class='pointer but' onclick='delLine(this)'/></td>";
    							echo "</tr>";
    						}
						?>
					</table>
				</td>
			</tr>
			<tr>
				<th colspan="4"><input type="button" value="添加" class='pointer' onclick="addLine()"/></th>
			</tr>
            <tr>
                <th width="220px"><p align="center">其他证明材料</p></th>
                <td colspan="3"><input name="others_material" /></td>
            </tr>
			<tr>
				<th rowspan="2"><p align="center">项目计划投资总额（万元）</p></th>
				<td rowspan="2"><input name="invest_total" datatype = "float"/></td>
				<th><p align="center">其中已完成的实际投资额（万元）</p></th>
				<td><input name="invested" datatype = "float"/></td>
			</tr>
			<tr>
				<th><p align="center">其中固定资产投资额（万元）</p></th>
				<td><input name="fixed_invest" datatype = "float"/></td>
			</tr>
			<tr>
				<th><p align="center">合作项目简介（限1000字）</p></th>
				<td colspan="3"><div><textarea name="coproject_summary" datalength="1000" ></textarea></div></td>
			</tr>
			<tr>
				<th><p align="center">项目取得的科研成果（限500字）</p></th>
				<td colspan="3" ><div ><textarea name="tech_achieve" datalength="500"></textarea></div></td>
			</tr>
			<tr>
				<th><p align="center">已取得的经济社会效益（限500字）</p></th>
<!-- 				<td colspan="3" rowspan="3"><div><textarea name="social_benefit" ></textarea></div></td> -->
				<td colspan="3"><div><textarea name="social_benefit" datalength="500"></textarea></div></td>
			</tr>
		</table>
		<div class="button_wrapper clearfix">
   			<div class="save">保存</div>
   			<!-- <div class="reset" >重置</div> -->
		</div>
		</div>
		
		</div>
	</form>
</body>
</html>



