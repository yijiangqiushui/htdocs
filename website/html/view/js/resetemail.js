function addOrg() {
	var email = $("#email").val();
	var filter  =  /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/;
	
	if (!email || !filter.test(email)){
		alert('填写格式不正确,请重新填写');
		$(this).focus();
	} else {
		if(email) {
			$.post('/modules/php/action/page/applycation/logininfo.act.php?action=checkemail',{email:email}, function(data) {
				if(data == 1) {
					$.post('/modules/php/action/page/applycation/logininfo.act.php?action=resetpwd',{re_email:email}, function() {
						alert('重置密码邮件已发送，请登录邮箱查看！');
					});
				} else {
					alert('您输入的邮箱不存在');
//					alert(data);
				}
			});
		}
	}
}

function tologinhtml() {
	var host = window.location.host;
	window.location.href = 'http://kw.bjtzh.gov.cn/PBindex.html';
}