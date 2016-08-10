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
<script type="text/javascript" src="../../../../../../../common/html/js/tablecommon.js"></script>
<script type="text/javascript" src="../../../../js/apply/attach3_patent/stuff_list.js"></script>
	<script type="text/javascript" src="../../../../../../../common/html/js/validation.js"></script>
</head>
<body>
	<form method="post" id="stuff_list">
	<div class="project_content">
		<div class="table_title clearfix">
			<div class="title_pic left">专利实施项目申报书</div>
			<div class="right back_pic" id="back"></div>
		</div>
			<div class="table_content back-long">
            <table cellspacing="0" cellpadding="0" class="basic_info">
				<tr>
                    <td colspan="7" class="border_left_none" style="background-color:#7AB5ED;">
                        <div class="title_top p-b10">五、单位提供相关材料清单</div>
					</td>
				</tr>
				
				<tr>
					<th width="200px"><p align="center">序号</p></th>
					<th colspan="6"><p align="center">材料名称</p></th>	
				</tr>
				
				<tr><td colspan="7">
				<table cellspacing="0" style="margin-bottom: 0;"
							id="addtable">
				 <?php
										  $project_id = $_SESSION ['project_id'];
                                          $tableData = TableData::get($project_id,28);
                                          $tableData = $tableData['data'];
                                            
                                          if (!empty($tableData['serial_number'])) {
                                          $i = 0;
                                          foreach ($tableData['serial_number'] as $key => $value) {
												echo "<tr>";
												echo "<td width='200px'><p><input type='text' name='serial_number[$i]' class='center_style' value='{$tableData['serial_number'][$key]}'/><p></td>";
												echo "<td colspan='5'><input type='text' name='stuff_name[$i]' value='{$tableData['stuff_name'][$key]}'/></td>";
												echo "<td colspan='1'><input type='button' class='pointer but' value='删除' onclick='delLine(this)'/></td>";
												echo "</tr>";
												++$i;
											}
										} else {
    											echo "<tr>";
    										    echo "<td width='200px'><p><input type='text' name='serial_number[0]' value='1' class='center_style' readonly/></p></td>";
												echo "<td colspan='5'><input type='text' name='stuff_name[0]'/></td>";
    											echo "<td colspan='1'><input type='button' class='pointer but'  value='删除' onclick='delLine(this)'/></td>";
    											echo "</tr>";
										}
										?>	
				 </table>
						<tr>
							<th colspan="7" height="25"><input   type="button" class='pointer' value="添加"  onclick="addLine()" /></th>
							<!-- 没有字段-->
						</tr>
					</td>
				</tr>
				<tr>
				<th><p align="center">备注</p></th>
				<td class="special-row">
				<textarea style="padding: 10px; width:98%;" name="comment"></textarea>
				</td>
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
