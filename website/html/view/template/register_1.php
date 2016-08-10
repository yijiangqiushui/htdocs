<?php 
	session_start();
	$username = $_GET['username'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=10">
<title>申报单位注册</title>
<link rel="stylesheet" type="text/css"
	href="../../../../common/html/plugin/easyui/themes/default/easyui.css" />
<link rel="stylesheet" type="text/css"
	href="../../../../common/html/plugin/easyui/themes/icon.css" />
<script type="text/javascript"
	src="../../../../common/html/plugin/easyui/jquery.min.js"></script>
<script type="text/javascript"
	src="../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript"
	src="../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>
<script type="text/javascript" src="../js/config.js"></script>
<script type="text/javascript" src="../../../../common/html/js/validation.js"></script>
<script type="text/javascript" src="../js/register_1.js"></script>
<link href="../css/register.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="../css/table.css" />
<link rel="stylesheet" type="text/css" href="../css/button.css" />
<script type="text/javascript">
$(function(){
	$('.username').val('<?php echo $username?>');
	if('<?php echo $username?>' != null && '<?php echo $username?>' != ''){
		$('#password').css({"display":"none"});
		$('input[name=username]').attr("readonly","readonly");
		}
});
</script>
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
			<img src="../img/logo.png" width="300" height="50" alt="logo" />
		</div>
		<div class="body">
			<div class="register">
				<div class="register_content">
					<form id="fm" method="post" enctype="multipart/form-data"
						novalidate>
						<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
							<tr>
								<td colspan="4"><h1 class="register_title">用户信息</h1></td>
							</tr>
							<tr height="40">
								<td>组织机构代码（统一社会信用代码）</td>
								<td colspan="3"><input name="orgCode" style="width: 82.5%" /><span>*</span>（必填）</td>
							</tr>
							<tr>
								<td >用户名</td>
								<td ><input name="username" class='username'/><span>*</span>（必填）</td>
								<td>电子邮箱</td>
								<td><input type="text" name="email" datatype="email" /><span>*</span>（必填）</td>
							</tr>
							<tr  id = 'password'>
								<td >登录密码</td>
								<td><input type="password" name="pwd" /><span>*</span>（必填）</td>
								<td>确认密码</td>
								<td><input type="password" name="repwd" /><span>*</span>（必填）</td>
							</tr>
							<tr>
								<td rowspan="2">联系人</td>
								<td rowspan="2"><input type="text" name="name"
									datatype="" /><span>*</span>（必填）</td>
								<td>联系手机</td>
								<td><input type="text" name="celphone" datatype="telephone" /><span>*</span>（必填）</td>
							</tr>
							<tr>
								<td>联系座机</td>
								<td><input type="text" name="phone" datatype="phone" /><span>*</span>（必填）</td>
							</tr>
						</table>
						<div class="butt">
							<a href="javascript:void(0)" class="easyui-linkbutton"
								iconcls="icon-ok" onclick="nextStep()">下一步 </a> 
					   <a href="javascript:void(0)" class="easyui-linkbutton" iconcls="icon-no" onclick="history.back()">返回</a>
						</div>
					</form>
				</div>
				<div class="register_close"></div>
			</div>
		</div>
		<div class="foot">&copy;2015 北京市通州区科学技术委员会</div>
	</div>
</body>
</html>
