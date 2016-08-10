	
function generateid(){
	if($.trim($('#username').val())==''){alert('提示：请输入用户名！');}
	else if($.trim($('#password').val())==''){alert('提示：请输入密码！');}
	else{
		$.post("../form.act.php?action=generateid",{username:$.trim($('#username').val()),password:$.trim($('#password').val())},function(result){
			if(result == 0){
				var username = $.trim($('#username').val());
				var password = $.trim($('#password').val());
				var mess = "您生成的账号为：\n用户名：" + username + "\n密码：" + password;
				alert('成功增加用户，' + mess);
			}
			else{
				alert("用户已存在！");
			}
		});
	}
}

/*$(function()
		{
		loadApplyInfo();
		});
	function loadApplyInfo(){
		$('#cc').combobox({
			url:'get_data.php',
			valueField:'id',
			textField:'text'
		});
	}*/

