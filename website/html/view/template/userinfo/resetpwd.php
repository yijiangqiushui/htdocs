<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>申报单位注册</title>
	<script type="text/javascript" src="../../../../../common/html/plugin/easyui/jquery.min.js"></script>
	<link href="../../css/register.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="../../js/reset.js"></script>
</head>
<body>
	<div class="wrapper">
		<div class="head">
			<img src="../../img/logo.png" width="300" height="50" alt="logo" />
		</div>
		<div class="body">
			<div id="reset" style="display:block;">
				<h1 class="register_title">找回密码</h1>
				<div class="register_content">
					<form id="fm" method="post">
						<table width="100%" border="0" align="center" cellpadding="0" cellspacing="5">
							<tr>
								<td align="right">设置新密码</td>
								<td><input type="password" name="email" id="password" style="height: 22px; "/></td>
							</tr>
							<tr>
								<td align="right" style="letter-spacing: 3.6px;">确认密码</td>
								<td><input type="password" name="re_email" id="re_password" style="height: 22px; " /></td>
							</tr>
							<tr>
								<td></td>
								<td><input type="button" value="确认" id="verify_pwd" style="padding:3px 8px;"/></td>
							</tr>
						</table>
						<div >
							
						</div>
					</form>
				</div>
				<div class="register_close"></div>
			</div>
		</div>
		<div class="foot">&copy;2015 北京市通州区科学技术委员会</div>
	</div>
	<input type="hidden" value="<?php echo $_GET['token']?>" id="token"/>
	<input type="hidden" id="user_id"/>
</body>
</html>
