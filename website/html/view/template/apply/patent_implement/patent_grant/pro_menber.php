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
<link rel="stylesheet"
	href="../../../../../../../common/html/lib/css/datapicker/daterangepicker.css" />

<script src="../../../../../../../common/html/lib/js/jquery-1.11.2.min.js"></script>
<script
	src="../../../../../../../common/html/plugin/datapicker/moment.min.js"></script>

<script type="text/javascript"
	src="../../../../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>
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
	<script type="text/javascript" src="../../../../../../../common/html/js/tablecommon.js"></script>
<script type="text/javascript" src="../../../../js/apply/patent_grant/pro_member.js"></script>

</head>
<body>
	<div class="wt_box">

		<div style="width: 100%; height: 100%; border: 1px;">
			<form method="post" id="pro_member">

				<div class="project_content">
					<div class="table_title clearfix">
						<div class="title_pic left">主要人员</div>
						<div class="right back_pic" id="back"></div>
					</div>
					<div class="table_content back-long">
						<table cellspacing="0" cellpadding="0" class="basic_info">
							<tr>
								<td colspan='9' style="background-color: #8AB5ED; height: 20px;">
									<div class="title_top p-b10">项目承担单位、协作单位、主要人员</div>
								</td>
							</tr>
							<tr>
								<th colspan="2">项目承担单位：</th>
								<td colspan="7" class=""><input name="org_name" class=""  id="org_name"  type="text"  readonly/></td>
							</tr>
							<tr>
								<th colspan="2">项目协作单位：</th>
								<td colspan="7" class=""><input name="coorg" class="" type="text" /></td>
							</tr>
							<tr>
								<th colspan="9">主要人员</th>

							</tr>

							<tr>
								<td colspan="9">
								<table border="0" id="addtable">
									<tr>
										<th><p align="center">姓 名</p></th>
										<th width="50px"><p align="center">性 别</p></th>
										<th><p align="center">年 龄</p></th>
										<th width='60px'><p align="center">学 历</p></th>
										<th><p align="center">职务（职称）</p></th>
										<th><p align="center">从事专业</p></th>
										<th><p align="center">工作单位</p></th>
										<th><p align="center">主要分工</p></th>
										<th>操作</th>

									</tr>

				 <?php $project_id = $_SESSION ['project_id'];
                                          $tableData = TableData::get($project_id,30);
                                          $tableData = $tableData['data'];
                                          if (!empty($tableData) && $tableData['name']) {
                                             $i = 0;
                                             foreach ($tableData['name'] as $key => $value) {
												echo "<tr>";
												echo "<td ><input type='text' name='name[$i]' value='{$tableData['name'][$key]}'/></td>";
												echo "<td ><select name='gender[$i]' value='{$tableData['gender'][$key]}' style='height:100%;width:100%'><option value='男'";
												      if($tableData['gender'][$key]=='男'){echo 'selected';}
												echo ">男</option><option value='女' ";
                                                      if($tableData['gender'][$key]=='女'){
                                                echo "'selected'";}
                                                echo ">女</option></select></td>";
												echo "<td ><input type='text' name='ages[$i]' value='{$tableData['ages'][$key]}'  datatype='number'  /></td>";


												echo "<td>";
												echo "<select name=\"edu[$i]\" style=\"height:100%;width:100%\">"
														 ?>
													 <option value="小学" <?php if ($tableData['edu'][$key] == '小学') echo 'selected'; ?>>小学</option>
													 <option value="初中" <?php if ($tableData['edu'][$key] == '初中') echo 'selected'; ?>>初中</option>
													 <option value="高中" <?php if ($tableData['edu'][$key] == '高中') echo 'selected'; ?>>高中</option>
													  <option value="中专" <?php if ($tableData['edu'][$key] == '中专') echo 'selected'; ?>>中专</option>
													 <option value="大专" <?php if ($tableData['edu'][$key] == '大专') echo 'selected'; ?>>大专</option>
													 <option value="本科" <?php if ($tableData['edu'][$key] == '本科') echo 'selected'; ?>>本科</option>
													 <option value="研究生" <?php if ($tableData['edu'][$key] == '研究生') echo 'selected'; ?>>研究生</option>

													 <option value="其他" <?php if ($tableData['edu'][$key] == '其他') echo 'selected'; ?>>其他</option>
												 </select>
												</td>
									<?php
												echo "<td ><input type='text' name='pos[$i]' value='{$tableData['pos'][$key]}'   /></td>";
												echo "<td ><input type='text' name='sub[$i]' value='{$tableData['sub'][$key]}'   /></td>";
												echo "<td ><input type='text' name='work[$i]' value='{$tableData['work'][$key]}'  /></td>";
												echo "<td><input type='text' name='mission[$i]' value='{$tableData['mission'][$key]}'  /></td>";
												echo "<td ><input type='button' value='删除' class='pointer'  onclick='delLine(this)'/></td>";
												echo "</tr>";
												++$i;
											}
										} else {
    											echo "<tr>";
    										    echo "<td ><input type='text' name='name[0]'/></td>";
												echo "<td ><select name='gender[0]' style='height:100%;width:100%'>
	                                                       <option value='男' selected>男</option>
	                                                       <option value='女'>女</option>
	                                                       </select>
	                                                 </td>";
												echo "<td ><input type='text' name='ages[0]'/ datatype='number' ></td>";
											  ?>
											  <td>
												  <select name="edu[0]" style="height:100%;width:100%">
												  <option value='小学'  selected="selected">小学</option>
                               			  	   <option value='初中'>初中</option>
                                   				 <option value='高中'>高中</option>
                                    				<option value='中专'>大专</option>
                                   				 <option value='大专'>大专</option>
                                   				 <option value='本科'>本科</option>
                                    				<option value='研究生'>研究生</option>

                                    <option value='其他'>其他</option>
												  </select>
											  </td>
									<?php
												echo "<td ><input type='text' name='pos[0]'   /></td>";
												echo "<td ><input type='text' name='sub[0]'  /></td>";
												echo "<td ><input type='text' name='work[0]'   /></td>";
												echo "<td ><input type='text' name='mission[0]'  /></td>";
    											echo "<td ><input type='button'  value='删除' class='pointer'  onclick='delLine(this)'/></td>";
    											echo "</tr>";
										}
										?>
				 					</table>
								</td>
							</tr>

								<tr>
									<th colspan="9" height="25"><input   type="button" value="添加" class='pointer' onclick="addLine()" /></th>
									<!-- 没有字段-->
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
</body>
</html>

