<?php
include '../../../../../../../common/php/config.ini.php';
include '../../../../../../../common/php/lib/db.cls.php';
include '../../../../../../../extends/Table/TableData.php';
session_start ();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>申报单位基本情况</title>

<link rel="stylesheet" type="text/css" href="../../../../../../../common/html/plugin/easyui/themes/default/easyui.css"></link>
<link rel="stylesheet" type="text/css" href="../../../../../../../common/html/plugin/easyui/themes/icon.css" />
<link rel="stylesheet" type="text/css" href="../../../../css/table.css"/>
<link rel="stylesheet" type="text/css" href="../../../../css/button.css" />

<script type="text/javascript" src="../../../../../../../common/html/plugin/easyui/jquery.min.js"></script>
<script type="text/javascript" src="../../../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="../../../../../../../common/html/plugin/jquery-hlui-2.0/js/hlui.js"></script>
<script type="text/javascript" src="../../../../../../../common/html/plugin/jquery-hlui-2.0/js/form.js"></script>
<script type="text/javascript" src="../../../../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>
<!-- <script type="text/javascript" src="../../../../../../../common/html/js/validation.js"></script> -->
<script type="text/javascript" src="../../../../../../../common/html/js/tablecommon.js"></script>
<script type="text/javascript" src="../../../../js/apply/attach3_patent/main_staff.js"></script>
<script type="text/javascript" src="../../../../../../../common/html/js/validation.js"></script>



</head>
<body>
	<form method="post" id="main_staff">
	<div class="project_content">
		<div class="table_title clearfix">
			<div class="title_pic left">专利实施项目申报书</div>
			<div class="right back_pic" id="back"></div>
		</div>
			<div class="table_content back-long">
				<div class="basic_info bg_blue">
            <table cellspacing="0" cellpadding="0">
				<tr>
                    <td colspan="8" class="border_left_none" style="background-color:#7AB5ED;">
                        <div class="title_top p-b10">四、项目主要参加人员登记表</div>
					</td>
				</tr>
			</table>
				






				<table cellspacing="0" style="margin-bottom: 0;"
							id="addtable">
					<tr>
						<th width="10%"><p align="center">姓名</p></th>
						<th width="10%"><p align="center">性别</p></th>
						<th width="10%"><p align="center">年龄</p></th>
						<th width="10%"><p align="center">职称（职务）</p></th>
						<th width="10%"><p align="center">专业</p></th>
						<th width="20%"><p align="center">单位</p></th>
						<th width="20%"><p align="center">在本项目中分担任务</p></th>
						<th width="10%">操作</th>
					</tr>
				 <?php

										/*
										 * $conn = mysql_connect("david","FRED","123456");
										 * mysql_select_db("project",$conn);
										 */
										
										  $project_id = $_SESSION ['project_id'];
                                          $tableData = TableData::get($project_id,27);
                                          $tableData = $tableData['data'];
                                            
                                          if (!empty($tableData['eqpt_name'])) {
                                          $i = 0;
                                          foreach ($tableData['eqpt_name'] as $key => $value) {
												echo "<tr>";
												echo "<td width='10%'><input type='text' name='eqpt_name[$i]' value='{$tableData['eqpt_name'][$key]}'/></td>";
												echo "<td ><select name='sex[$i]' style='width:100%;height:100%' value='{$tableData['sex'][$key]}'>
                                            <option value='男'";if($tableData['sex'][$key] == '男') { echo 'selected';} echo ">男</option>
											<option value='女'";if($tableData['sex'][$key] == '女') { echo 'selected';} echo ">女</option>
									       </select> </td>";
												echo "<td width='10%'><input type='text' name='age[$i]' value='{$tableData['age'][$key]}' datatype='number' placeholder='请输入整数'/></td>";
												echo "<td width='10%'><input typare='text' name='rule[$i]' value='{$tableData['rule'][$key]}'/></td>";
												echo "<td width='10%'><input type='text' name='major[$i]' value='{$tableData['major'][$key]}'/></td>";
												echo "<td width='20%'><input type='text' name='dept[$i]' value='{$tableData['depart'][$key]}' /></td>";
												echo "<td width='20%'><input type='text' name='task[$i]' value='{$tableData['task'][$key]}'/></td>";
												echo "<td width='10%'><input type='button' name='' class='center_style but' value='删除' onclick='delRow(this)'/></td>";
												echo "</tr>";
												++$i;
											}
										} else {
    											echo "<tr>";
    										    echo "<td width='10%'><input type='text' name='eqpt_name[0]'/></td>";
												echo "<td><select name='sex[$i]' style='width:100%;height:100%'/>
                                                <option value='男' selected>男</option>
    											<option value='女'>女</option>
    									        </select> </td>";
												echo "<td width='10%'><input type='text' name='age[0]' datatype='number' placeholder='请输入整数'/></td>";
												echo "<td width='10%'><input type='text' name='rule[0]'/></td>";
												echo "<td width='10%'><input type='text' name='major[0]'/></td>";
												echo "<td width='20%'><input type='text' name='depart[0]'/></td>";
												echo "<td width='20%'><input type='text' name='task[0]'/></td>";
    											echo "<td width='10%'><input type='button' class='pointer but' value='删除' onclick='delRow(this)'/></td>";
    											echo "</tr>";
										}
										?>	


				</table>
				<div >
					<input type="button" name="Submit" style="height: 30px; background: #7AB5ED; color: #ffffff; font-size: 12px;float: none" class='pointer' value="添加参加人员" onclick="addLine();" />
				</div>
				
			

			 <div class="button_wrapper clearfix d-n">
       			<div class="save">保存</div>
			</div> 
		</div>
			</div>
		</div>
		</form>
</body>
</html>
