<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>申报单位注册</title>
<link rel="stylesheet" type="text/css" href="../../../../../common/html/plugin/easyui/themes/default/easyui.css"/>
<link rel="stylesheet" type="text/css" href="../../../../../common/html/plugin/easyui/themes/icon.css"/>
<script type="text/javascript" src="../../../../../common/html/plugin/easyui/jquery.min.js"></script>
<script type="text/javascript" src="../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="../../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>
<script type="text/javascript" src="../../js/config.js"></script>
<script type="text/javascript" src="../../js/login_1.js"></script>
<link href="../../css/register.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../../css/table.css" />
<link rel="stylesheet" type="text/css" href="../../css/button.css" />
<style>
input {
	width: 60%;
}

table {
	margin-top: 80px;
	border: solid 3px #ffffff;
}
body {

	text-align: left;
}
.butt{text-align: center;
}
</style>
</head>
<body>
	<div class="wrapper">
		<div class="head">
			<img src="../../img/logo.png" width="300" height="50" alt="logo" />
		</div>
		<div class="body">
			<div class="register">
				<div class="register_content">
					<form id="fm" method="post" enctype="multipart/form-data"
						novalidate>
						<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
						    <tr>
								<td colspan="4"><h1 class="register_title">用户信息完善</h1></td>
							</tr>
							<tr height="40">
								<td>组织机构代码</td>
								<td><input name="orgCode" class="easyui-validatebox" /><span>*</span>（必填）</td>
								<td>电子邮箱</td>
								<td><input type="text" class="easyui-validatebox"
									validtype="email" name="email" /><span>*</span>（必填）</td>
							</tr>
							<tr>
								<td>真实姓名</td>
								<td><input type="text" class="easyui-validatebox" name="name" /><span>*</span>（必填）</td>
								<td>联系电话</td>
								<td><input type="text" class="easyui-validatebox" name="phone" /><span>*</span>（必填）</td>
							</tr>
							<tr>
								<td>通讯地址</td>
								<td colspan='3'><input type="text" class="easyui-validatebox" name="address"/><span>*</span>（必填）</td>
							</tr>
						</table>
						<div style="text-align: center">
							<a href="javascript:void(0)" class="easyui-linkbutton"
								iconcls="icon-ok" onclick="nextStep()">下一步 </a>
							<!--  <a href="javascript:void(0)" class="easyui-linkbutton" iconcls="icon-no" onclick="tologinhtml()">返回</a> -->
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
