<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link rel="stylesheet" type="text/css"
	href="../../../../../../common/html/plugin/easyui/themes/default/easyui.css" />
<link rel="stylesheet" type="text/css"
	href="../../../../../../common/html/plugin/easyui/themes/icon.css" />
<link rel="stylesheet" type="text/css" href="../../../css/table.css" />
<link rel="stylesheet" type="text/css" href="../../../css/button.css" />
<link rel="stylesheet" type="text/css"
	href="../../../css/date_common.css" />
	
<script src="../../../../../../common/html/js/datecommon.js"></script>
<script type="text/javascript"
	src="../../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript"
	src="../../../../../../common/html/plugin/easyui/jquery.cookie.js"></script>
<script type="text/javascript"
	src="../../../../../../common/html/plugin/jquery-hlui-2.0/js/hlui.js"></script>
<script type="text/javascript"
	src="../../../../../../common/html/plugin/jquery-hlui-2.0/js/form.js"></script>
<script type="text/javascript"
	src="../../../../../../common/html/js/validation.js"></script>
<script type="text/javascript"
	src="../../../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>
<script type="text/javascript"
	src="../../../../../../common/html/js/tablecommon.js"></script>
<script type="text/javascript" src="../../../js/projectapp/org_info.js"></script>
</head>
<body>
	<form id="org_info" method="post">
		<div class="project_content">
			<div class="table_title clearfix">
				<div class="title_pic left">项目实施方案填写</div>
				<div class="right back_pic" id="back"></div>
			</div>
			<div class="table_content back-long">
				<table cellspacing="0" cellpadding="0" class="basic_info">
					<tr>
						<td colspan="4" class="border_left_none"
							style="background-color: #7AB5ED;">
							<div class="title_top p-b10">项目承担单位基本信息</div>
						</td>
					</tr>
					<tr>
						<th width="180px"><p align="center">单位名称</p></th>
						<td colspan="3"><input id="org_name" name="org_name"
							title="只读信息，若有误请联系管理员修改" readonly /></td>
					</tr>
					<tr>
						<th><p align="center">组织机构代码</p></th>
						<td><input id="org_code" name="org_code" title="只读信息，若有误请联系管理员修改"
							readonly /></td>
						<th width="180px"><p align="center">隶属关系</p></th>
						<td><input id="relationship" name="relationship" /></td>
					</tr>
					<tr>
						<th><p align="center">
								上级主管单位名称 <br /> （一级法人）
							</p></th>
						<td colspan="3"><input id="legal_person" name="legal_person"
							title="只读信息，若有误请联系管理员修改" /></td>
					</tr>
					<tr>
						<th><p align="center">单位类型</p></th>
						<td colspan="3"><input id="org_type" name="org_type" /></td>
					</tr>
					<tr>
						<th><p align="center">单位地址</p></th>
						<td colspan="3"><input id="org_address" name="contact_address"
							readonly /></td>
					</tr>
					<tr>
						<th><p align="center">注册地所属乡镇</p></th>
						<td><input id="register_town" name="register_town" /></td>

						<th><p align="center">注册时间</p></th>
						<td><input id="register_time" name="register_time"
							style="float: left;" class='dateplu' readonly /></td>
					</tr>
					<tr>
						<th><p align="center">邮政编码</p></th>
						<td><input id="postal" name="postal" datatype="postcode"
							placeholder="邮编格式：101100(6位数字)" /></td>
						<th><p align="center">单位传真</p>
							</td>
							<td><input id="fax" name="fax" datatype="fax"
								placeholder="正确格式：XXXX-12345678" /></td>
					
					</tr>
					<tr>
						<th><p align="center">电子邮箱</p></th>
						<td colspan="3"><input id="email" name="email"
							title="只读信息，若有误请联系管理员修改" readonly /></td>
					</tr>
					<tr>
						<th><p align="center">高新证书号</p></th>
						<td><input id="certi_code" name="certi_code" datatype="" /></td>
						<th><p align="center">所在高技术开发区</p></th>
						<td><input id="develop_area" name="develop_area" /></td>
					</tr>
					<tr>
						<th><p align="center">单位负责人</p></th>
						<td><input name="org_leader" datatype="" /></td>
						<th><p align="center" name="leader_contact">联系方式</p></th>
						<td><input name="leader_contact" datatype="phandtel"
							placeholder="请输入手机或固话" /></td>
					</tr>
					<tr>
						<th height="35px"><p align="center">单位科技管理部门负责人</p></th>
						<td><input id="dev_leader" name="dev_leader" datatype="" /></td>
						<th><p align="center">联系方式</p></th>
						<td><input id="dev_contact" name="dev_contact" datatype="phandtel"
							placeholder="请输入手机或固话" /></td>
					</tr>
					<tr>
						<th><p align="center">项目负责人</p></th>
						<td><input name="leader_name" /></td>
						<th><p align="center">联系方式</p></th>
						<td><input name="leader_phone" datatype="phandtel"
							placeholder="请输入手机或固话" /></td>
					</tr>
					<tr>
						<th><p align="center">财务负责人</p></th>
						<td><input id="finance_leader" name="finance_leader" datatype="" /></td>
						<th><p align="center">联系方式</p></th>
						<td><input id="finance_contact" name="finance_contact"
							datatype="phandtel" placeholder="请输入手机或固话" /></td>
					</tr>
					<tr>
						<th><p align="center">联系人</p></th>
						<td><input id="linkman" name="linkman" /></td>
						<th><p align="center">联系方式</p></th>
						<td><input id="linkman_contact" name="linkman_contact"
							datatype="phandtel" /></td>
					</tr>
					<tr>
						<th class=" border_none"><p align="center">市科委认定研发机构批准号</p></th>
						<td colspan="3"><input id="ratification_num"
							name="ratification_num" /></td>
					</tr>

				</table>
				<div class="button_wrapper clearfix d-n">
					<!--                 <div class="submit" >提交</div> -->
					<div class="save">保存</div>
					<!-- <div class="reset" >重置</div> -->
				</div>
			</div>

		</div>
	</form>


</body>
</html>
