<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>申报单位注册</title>
<!-- <link rel="stylesheet" type="text/css"
	href="../../../../website/html/view/css/tablestyle.css" /> -->
<!--<script type="text/javascript" src="/common/html/lib/js/jquery-2.1.0.min.js"></script>-->
<link rel="stylesheet" type="text/css"
	href="../../../../../common/html/plugin/easyui/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css"
		href="../../../../../common/html/plugin/easyui/themes/icon.css">
		<script type="text/javascript"
			src="../../../../../common/html/plugin/easyui/jquery.min.js"></script>
		<script type="text/javascript"
			src="../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
		<script type="text/javascript"
			src="../../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>
		<script type="text/javascript" src="../../js/config.js"></script>

		<script type="text/javascript" src="../../js/login_2.js"></script>

		<link href="../../css/register.css" rel="stylesheet" type="text/css" />

</head>

<body>
	<div class="wrapper">
		<div class="head">
			<img src="../../img/logo.png" width="300" height="50" alt="logo" />
		</div>
		<div class="body">
			<div class="register">
				<h1 class="register_title">完善申报单位</h1>
				<div class="register_content">
					<form id="fm" method="post" enctype="multipart/form-data"
						novalidate>
						<table width="100%" border="0" align="center" cellpadding="0"
							cellspacing="0">
							<tr height="40">
								<td>申报单位名称</td>
								<td><input class="easyui-validatebox" name="orgName" /><span>*</span>（必填）</td>
							</tr>
							<tr>
								<!-- <td>用户名</td>
            <td><input class="easyui-validatebox" name="username"/><span>*</span>（必填）</td> -->
								<td>电子邮箱</td>
								<td><input type="text" class="easyui-validatebox"
									validtype="email" name="email" /><span>*</span>（必填）</td>
							</tr>
							<!--           <tr>
            <td>登录密码</td>
            <td><input type="password" class="easyui-validatebox" name="pwd"/><span>*</span>（必填）</td>
            <td>确认密码</td>
            <td><input type="password" class="easyui-validatebox" name="repwd"/><span>*</span>（必填）</td>
          </tr> -->
							<tr>
								<td>企业法人</td>
								<td><input type="text" class="easyui-validatebox"
									name="legalPerson" /><span>*</span>（必填）</td>
								<td>联系人</td>
								<td><input type="text" class="easyui-validatebox" name="contact" /><span>*</span>（必填）</td>
							</tr>
							<tr>
								<td>联系人手机</td>
								<td><input type="text" class="easyui-validatebox"
									name="telphone" /><span>*</span>（必填）</td>
								<td>通讯地址</td>
								<td><input type="text" class="easyui-validatebox" name="address" /><span>*</span>（必填）</td>
							</tr>
							<tr>
								<td>联系电话</td>
								<td><input type="text" class="easyui-validatebox" name="phone" /><span>*</span>（必填）</td>
								<td>工商营业执照</td>
								<td><input type="file" name='file1' /></td>
							</tr>
							<tr>
								<td>税务登记证</td>
								<td><input type="file" name="file" /></td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
							</tr>
							<tr rowspan="4">
								<td>注册指南</td>
								<td colspan="3"><textarea name="textarea" readonly="readonly"
										style="width: 517px; height: 160px;">
1、以上所有信息均为必填、请认真填写。
2、固定电话号码请按规定格式填写，如010-88888888。
3、税务登记证和工商营业执照的格式为png、jpg、gif、jpeg，请上传规定格式文件。
4、注册成功后，企业的组织机构代码将是您登录该系统的账号，请您牢记。
5、请您牢记设定的登录密码。</textarea></td>
							</tr>
						</table>
						<div style="text-align: center">
							<a href="javascript:void(0)" class="easyui-linkbutton"
								iconcls="icon-ok" onclick="addOrg()">确定 </a> <a
								href="javascript:void(0)" class="easyui-linkbutton"
								iconcls="icon-no" onclick="tologinhtml()">返回</a>
						</div>
					</form>
				</div>
				<div class="register_close"></div>
			</div>
		</div>
		<div class="foot">&copy;2014 北京市通州区科学技术委员会</div>
	</div>
</body>
</html>
