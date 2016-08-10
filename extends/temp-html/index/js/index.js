// JavaScript Document

$(function() {
	$.form('form1');

	$('title').text(SYSTEM.name);// 设置页面标题

	get_notices();

	$('#submitbtn').bind('click', function() {
		submit_form();
	});
	$('#get_help').bind('click', function() {
		get_help();
	});
});

function submit_form() {
	$username = $.trim($('#username').val());
	$password = $.trim($('#password').val());
	$validateCode = $.trim($('#validateCode').val());
	if ($.form_validate('form1')) {
		$.post('/website/php/action/page/index.php?action=login', {
			'username' : $username,
			'password' : $password,
			'validateCode' : $validateCode
		}, function(result) {
			var res = eval("(" + result + ")");
			switch (res.result){
			case 'code_err':
				alert('提示：验证码输入错误！');
				changeValidateCodeImg();
				break;
			case 'isForbidden':
				alert('提示：该用户已被禁用！');
				changeValidateCodeImg();
				break;
			case 'incorrect':
				alert('提示：用户名或密码错误，请重新输入！');
				changeValidateCodeImg();
				break;
			case 'not_check':
				alert('提示：账号未审核，我们会在24小时内处理，请稍后再试！');
				changeValidateCodeImg();
				break;
			case 'unchecked':
				alert('提示账号未通过审核，请重新注册 ！');
				changeValidateCodeImg();
				break;
			case 'success':
				// 如果注册成功则要判断用户的类型
				if (res.user_type == -1) { //先判断是不是自己后台生成的，在判断有没有完善公司信息 如果完善了就直接跳转到首页
					if(res.org_code==null){
					window.location.href = '/website/html/view/template/login/login_1.php';
					}
					else{
						window.location.href = '/website/html/view/template/main-xmsbxt.html';
					}

				} else {
					window.location.href = '/website/html/view/template/main-xmsbxt.html';
				}
				break;
			default:
				alert('提示：系统发生错误，请联系网站管理员！');
			}
		});
	}
}


function get_notices() {
	$.post('/website/php/action/page/notice.php?action=recommend', function(
			ret_val) {
		$('.list ul').html(ret_val);
	});
}

function changeValidateCodeImg() {
	$('#validateCodeImg').attr(
			'src',
			'/website/../common/php/file/validateCode.png.php?rand='
					+ Math.random());
}

function get_help() {
	//$.messager.alert('提示信息', '请于管理员联系，联系电话：010-66157731', 'info');
	window.location.href='http://'+window.location.host+'/website/html/view/template/userinfo/resetpwd_email.php';
}