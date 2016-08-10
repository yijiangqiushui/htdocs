<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link rel="stylesheet" type="text/css" href="../../../../../../common/html/plugin/easyui/themes/default/easyui.css" />
<link rel="stylesheet" type="text/css" href="../../../../../../common/html/plugin/easyui/themes/icon.css" />
<link rel="stylesheet" type="text/css" href="../../../css/table.css" />
<link rel="stylesheet" type="text/css" href="../../../css/button.css" />
<link rel="stylesheet" type="text/css" href="../../../css/date_common.css" />
<script src="../../../../../../common/html/js/datecommon.js"></script>

<script type="text/javascript" src="../../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="../../../../../../common/html/plugin/easyui/jquery.cookie.js"></script>
<script type="text/javascript" src="../../../../../../common/html/plugin/jquery-hlui-2.0/js/hlui.js"></script>
<script type="text/javascript" src="../../../../../../common/html/plugin/jquery-hlui-2.0/js/form.js"></script>
<script type="text/javascript" src="../../../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>
<script type="text/javascript" src="../../../../../../common/html/js/tablecommon.js"></script>
<script type="text/javascript" src="../../../js/projectapp/support_info.js"></script>
<script type="text/javascript" src="../../../../../../common/html/js/validation.js"></script>

<style>
  textarea {
	padding: 10px;
}
</style>
</head>
<body>
	<form id="genious_info" method="post">
		<div class="project_content">
			<div class="table_title clearfix">
				<div class="title_pic left">人才资助申报推荐表</div>
				<div class="right back_pic" id="back"></div>
			</div>

			<div class="table_content back-long">
				<table cellspacing="0" cellpadding="0" class="basic_info">
					<tr>
						<td colspan="6" class="border_left_none"
							style="background-color: #7AB5ED;">
							<div class="title_top p-b10">基本情况</div>
						</td>
					</tr>
					<tr>
						<th><p align="center">姓名</p></th>
						<td colspan="2"><input name="project_name" /></td>
						<th><p align="center">性别</p></th>
						<td colspan='2'><select name="genious_sex" id="org_sex">
								<option value='男' selected='selected'>男</option>
								<option value='女'>女</option>
						</select></td>
						<!-- <input id="org_sex" name="genious_sex" /> -->
						<!--                             <td rowspan="4"><p>(1寸彩照)</p></td> -->
					</tr>
					<tr>
						<th><p align="center">出生年月</p></th>
						<!--  <td colspan="2"><input id="genious_birth"  name="genious_birth" style="float: left;" class="dateplu" readonly/></td>-->
						<td colspan='2'><select class='year' name='genious_year'>
						</select> <select class='month' name='genious_month'>
						</select></td>
						<th><p align="center">民族</p></th>
						<td colspan='2'><input name="genious_nation"
							datatype="chinese_characters" /></td>
					</tr>
					<tr>
						<th><p align="center">党派</p></th>
						<td colspan="2"><input name="genious_party" /></td>
						<th><p align="center">籍贯</p></th>
						<td colspan='2'><input name="genious_native"
							datatype="chinese_characters" /></td>
					</tr>
					<tr>
						<th><p align="center">学历</p></th>
						<td colspan="2"><select name="genious_edu">
								<option value='小学' selected='selected'>小学</option>
								<option value='初中'>初中</option>
								<option value='高中'>高中</option>
								<option value='中专'>中专</option>
								<option value='大专'>大专</option>
								<option value='本科'>本科</option>
								<option value='研究生'>研究生</option>

								<option value='其他'>其他</option>
						</select> <!-- <input name="genious_edu" /> --></td>
						<th><p align="center">学位</p></th>
						<td colspan='2'><select name="genious_grade">
								<option value='学士学位' selected='selected'>学士学位</option>
								<option value='硕士学位'>硕士学位</option>
								<option value='博士学位'>博士学位</option>
								<option value='其他'>其他</option>
								<option value='无'>无</option>
						</select> <!-- <input name="genious_grade" /> --></td>
					</tr>
					<tr>
						<th><p align="center">专业</p></th>
						<td colspan="2"><input name="genious_major" /></td>
						<th><p align="center">从事行业</p></th>
						<td colspan="2"><input name="genious_devote" /></td>
					</tr>
					<tr>
						<th><p align="center">行政职务</p></th>
						<td colspan="2"><input name="administ_post"
							datatype="chinese_characters" /></td>
						<th><p align="center">专业职务</p></th>
						<td colspan="2"><input name="major_post" /></td>
					</tr>
					<tr>
						<th><p align="center">家庭住址</p></th>
						<td colspan="2"><input name="genious_address" /></td>
						<th><p align="center">移动电话</p></th>
						<td colspan="2"><input name="genious_phone" datatype="telephone"
							placeholder="请输入手机号" /></td>
					</tr>
					<tr>
						<th><p align="center">工作单位（企业名称）</p></th>
						<td colspan="2"><input name="company_name" readonly /></td>
						<th><p align="center">注册时间</p></th>
						<td colspan="2"><input name="register_time" id="regist_time"
							class="dateplu" readonly /></td>
					</tr>
					<tr>
						<th><p align="center">是否为高新企业</p></th>
						<td colspan="2"><select name="high_tech">
								<option value='是' selected="selected">是</option>
								<option value='否'>否</option>
						</select> <!-- <input type="radio" name="is_hightec_prise" style="width:20px; height:20px; margin-left:10px;"  />是
                                <input type="radio" name="is_hightec_prise" style="width:20px; height:20px;margin-left:50px;" />否
                                <input name="is_hightec_prise" /> --></td>
						<th><p align="center">联系人</p></th>
						<td colspan="2"><input name="contacts" /></td>
					</tr>
					<tr>
						<th><p align="center">联系电话</p></th>
						<td colspan="2"><input name="contact_phone" datatype="phandtel" /></td>
						<th><p align="center">电子信箱</p></th>
						<td colspan="2"><input name="email" datatype="email"
							placeholder="格式：XXXX@XX.com" /></td>
					</tr>
					<tr>
						<th rowspan="2"><p align="center">企业法定代表人情况</p></th>
						<th><p align="center">姓名</p></th>
						<th><p align="center">最高学历</p></th>
						<th colspan="3"><p align="center">任现职时间</p></th>

					</tr>
					<tr>
						<td><input name="corp_name" readonly /></td>
						<td><select name="corp_grade">
								<option value='小学'>小学</option>
								<option value='初中'>初中</option>
								<option value='高中'>高中</option>
								<option value='中专'>大专</option>
								<option value='大专'>大专</option>
								<option value='本科'>本科</option>
								<option value='研究生'>研究生</option>
								<option value='其他'>其他</option>
						</select></td>
						<td colspan="3"><input name="serving_time" id="serving_time"
							class="dateplu" /></td>
					</tr>
					<tr>
						<th><p align="center">职工总数</p></th>
						<td><input name="work_force" datatype="number" /></td>
						<th><p align="center">大专以上人员数量</p></th>
						<td><input name="college_num" datatype="number" /></td>
						<th><p align="center">研发人员数量</p></th>
						<td><input name="research_num" datatype="number" /></td>
					</tr>
					<tr>
						<th rowspan="6"><p align="center">工作简历</p></th>
						<td rowspan="6" colspan="6"><textarea rows="6" cols="6"
								name="job_resume"></textarea></td>
					</tr>
				</table>
				<!-- 				<input type="hidden" name="save_display" id="save_display" /> -->
				<div class="button_wrapper clearfix d-n">
					<div class="save">保存</div>
					<!-- <div class="reset" >重置</div> -->
				</div>
			</div>

		</div>
	</form>


</body>
</html>
