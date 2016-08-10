
$(function() {
	var token = $('#token').val();
	if(token) {
		$.post('/modules/php/action/page/applycation/logininfo.act.php?action=checktoken',{token:token}, function(data) {
			if(data != '0') {
				$('#reset').show();
				$('#user_id').val(data);
			} else {
				alert('链接已失效');
			}
		});
	}
	$("#verify_pwd").click(function() {
		var pwd = $('#password').val();
		var re_pwd = $('#re_password').val();
		var user_id = $('#user_id').val();
	
		if(check_pwd(pwd,re_pwd)) {
			$.post('/modules/php/action/page/applycation/changepwd.act.php?action=setnewpass',{new_pwd:pwd,id:user_id}, function(data) {
				alert('密码更改成功');
				window.location.href='http://10.171.252.50/website/html/view/template/index.html';
			});
		}
	})
})



function check_pwd(pwd,re_pwd) {
	if(pwd && re_pwd) {
		if(pwd == re_pwd) {
			return true;
		} else {
			alert('两次输入不相同');
		}
	} else {
		alert('密码不得为空');
	}
}