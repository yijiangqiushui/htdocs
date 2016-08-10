<?php
session_start();
include '../../../../../../../common/php/config.ini.php';
include '../../../../../../../common/php/lib/db.cls.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>

<link rel="stylesheet" type="text/css"
	href="../../../../../../../common/html/plugin/easyui/themes/default/easyui.css"/>
<link rel="stylesheet" type="text/css"
	href="../../../../../../../common/html/plugin/easyui/themes/icon.css"/>
<link rel="stylesheet" type="text/css" href="../../../../css/table.css"/>
<link rel="stylesheet" type="text/css" href="../../../../css/button.css"/>
<link rel="stylesheet"
	href="../../../../../../../common/html/lib/css/datapicker/daterangepicker.css"/>

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

<script
	src="../../../../../../../common/html/plugin/datapicker/jquery.daterangepicker.js"></script>
<script type="text/javascript" src="../../../../../../../common/html/js/validation.js"></script>	
<script type="text/javascript"
	src="../../../../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>
<script type="text/javascript" src="../../../../../../../common/html/js/tablecommon.js"></script>
<script type="text/javascript"
	src="../../../../js/check_material/develop.js"></script>

<style>
th {
	width:80px;
}
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
div{
	padding:0;
}
</style>

</head>

<body>
	<form id="develop" method="post">
		<div class="project_content">
			<div class="table_title clearfix">
				<div class="title_pic left">专利实施验收报告书</div>
				<div class="right back_pic" id="back"></div>
			</div>

			<div class="table_content back-long">
				<table cellspacing="0" cellpadding="0" class="basic_info">
					<tr>
						<td colspan="6" class="border_left_none"
							style="background-color: #7AB5ED;">
							<div class="title_top p-b10">项目实施过程中企业研发新专利、开发新产品情况</div>
						</td>
					</tr>
				<tr><td colspan="5">
				<table id="patent_list">
				<?php
		$project_id = $_SESSION['project_id'];
		$sql = "Select * from patent_list where project_id='$project_id' and  is_new = 1  ";
// 		echo $sql;
		$db = new DB ();
		$result = $db->SelectOri ( $sql );
		$tableRow = array();
		if($result != false){
			$tableRow = mysql_num_rows ( $result );
		}
		if ($tableRow) {
			for($i = 0; $i < $tableRow; $i ++) {
				$row = mysql_fetch_object ( $result );
				$count=$i+1;

				echo "<tr>";
				echo "<th rowspan='2'><p align='center'>".$count."</p></th>";
				echo "<th><p align='center'>专利名称</p></th>";
				echo "<td><input type='text' name='patent_name[$i]'   value='$row->patent_name'/></td>";
				echo "<td><th><p align='center'>类型</p></th></td>";
				echo "<td><select name='patent_type[$i]' >
				<option value='发明'"; if($row->patent_type == '发明') { echo 'selected';} echo">发明</option>
				<option value='实用新型' "; if($row->patent_type == '实用新型') { echo 'selected';} echo">实用新型</option>
				<option value='外观设计' "; if($row->patent_type == '外观设计') { echo 'selected';} echo">外观设计</option>
				    </select></td>";
				//echo "<td><input type='text' name='patent_type[$i]'     value='$row->patent_type'/></td>";
				echo "<td rowspan='2'><input type='button' value='删除' class='pointer'  onclick='deleteTwoRow(this)'/></td>";
				echo "</tr>";
				echo "<tr>";
		        echo "<th><p align='center'>专利状态</p></th>";
		        echo "<td><select name='patent_state[$i]'   >
		        <option value='申请'"; if($row->patent_state == '申请') { echo 'selected';} echo" >申请</option>
				<option value='实审' "; if($row->patent_state == '实审') { echo 'selected';} echo" >实审</option>
				<option value='授权有效'"; if($row->patent_state == '授权有效') { echo 'selected';} echo" >授权有效</option>
				    </select></td>";
		        echo "</tr>";

			}
		} else {

			    echo "<tr>";
				echo "<th rowspan='2'><p align='center'>1</p></th>";
				echo "<th><p align='center'>专利名称</p></th>";
				echo "<td><input type='text' name='patent_name[0]'  /></td>";
				echo "<td><th><p align='center'>类型</p></th></td>";
				echo "<td><select name='patent_type[$i]' value='$row->patent_type'>
				<option value='发明'>发明</option>
				<option value='实用新型'>实用新型</option>
				<option value='外观设计'>外观设计</option>
				</select></td>";
				//echo "<td><input type='text' name='patent_type[0]'    ></td>";
				echo "<td rowspan='2'><input type='button' value='删除' class='pointer'  onclick='deleteTwoRow(this)'/></td>";
				echo "</tr>";
				echo "<tr>";
		        echo "<th><p align='center'>专利状态</p></th>";
		        echo "<td><select name='patent_state[$i]' value='$row->patent_state'>
		        <option value='申请'>申请</option>
		        <option value='实审'>实审</option>
		        <option value='授权有效'>授权有效</option>
		        </select></td>";
				//echo "<td><input type='text' name='patent_state[0]'  /></td>";
		        echo "</tr>";

		}
		?>
				
				</table>
				</td></tr>
				<tr>
				<th colspan="5"><input type="button" value="添加" class='pointer'  onclick="addLine()"/></th>
				</tr>
				<tr><td colspan="5">
				<table id="produce">
					<?php
		$project_id = $_SESSION['project_id'];
		$sql = "Select * from produce where project_id='$project_id'";
		//
// 		echo $sql;
		$db = new DB ();
		$result = $db->SelectOri ( $sql );
		$tableRow = array();
		if($result != false){
			$tableRow = mysql_num_rows ( $result );
		}
		if ($tableRow) {
			for($i = 0; $i < $tableRow; $i ++) {
				$row = mysql_fetch_object ( $result );
				$count=$i+1;
				echo "<tr>";
				echo "<th ><p align='center'>1</p></th>";
				echo "<th><p align='center'>产品名称</p></th>";
				echo "<td><input type='text' name='produce_name[$i]'  value='$row->produce_name'/></td>";

				echo "<th><p align='center'>产品水平</p></th>";
				echo "<td><select name='produce_level[$si]' > 
						<option value='国际领先' ";
						if($row->produce_level==1){echo 'selected';}   echo  ">国际领先</option>
						<option value='国际先进' ";
						if($row->produce_level==2){echo 'selected';}  echo  ">国际先进</option>
						<option value='国内领先'"; 
						if($row->produce_level==3){echo 'selected';}  echo  ">国内领先</option>
						<option value='国内先进'";
						 if($row->produce_level==4){echo 'selected';}  echo  ">国内先进</option>
						<option value='填补国内空白'";
						if($row->produce_level==5){echo 'selected';}  echo  ">填补国内空白</option>
						</select></td>";
				echo "<td><input type='button' value='删除' class='pointer'  onclick='deleteRow(this)'/></td>";
				echo "</tr>";
			}
		} else {
			echo "<tr>";
			echo "<th >1</th>";
			echo "<th><p align='center'>产品名称</p></th>";
			echo "<td><input type='text' name='produce_name[0]'/></td>";
			echo "<th><p align='center'>产品水平</p></th>";
			echo "<td><select name='produce_level[$si]' value='$row->produce_level'>
						<option value='1'>国际领先</option>
						<option value='2'>国际先进</option>
						<option value='3'>国内领先</option>
						<option value='4'>国内先进</option>
						<option value='5'>填补国内空白</option>
						</select></td>";
			echo "<td   ><input type='button' value='删除' class='pointer'   onclick='deleteRow(this)'/></td>";
			echo "</tr>";
		}
		?>
				</table>
				</td></tr>
					 <tr><th colspan="5"><input type="button" value="添加" class='pointer'  onclick="addLine2()"/></th></tr>
				</table>
				<div class="button_wrapper clearfix d-n">
					<div class="save">保存</div>
					<!-- <div class="reset" >重置</div> -->
				</div>
			</div>

		</div>
	</form>


</body>
</html>
