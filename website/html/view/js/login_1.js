//heyangyang

function nextStep(){
	var str='';
	var org_code = $('input[name="orgCode"]').val();
	if($('input[name="orgCode"]').val()==''){
		str+='组织机构代码 ';	
	}
	if($('input[name="username"]').val()==''){
		str+='用户名 ';	
	}
	if($('input[name="email"]').val()==''){
		str+='电子邮箱 ';	
	}
	if($('input[name="contact"]').val()==''){
		str+='联系人 ';	
	}
	if($('input[name="address"]').val()==''){
		str+='通讯地址 ';	
	}

	if(str!=''){
		$.messager.alert('提示',str+'输入项不能为空','info');
		return;		
	}	
	
	/*if($('input[name="file"]').val()==''){
		$.messager.alert('提示','请上传税务登记证文件','info');
		return;	
	}*/
	
/*	if($('input[name="file"]').val()!=''){
		var a=$('input[name="file"]').val();
		a=a.substr(a.lastIndexOf('.'));
		if(!(a=='.jpg'||a=='.jpeg'||a=='.png'||a=='.gif')){
			$.messager.alert('提示','请上传正确的税务登记证文件','info');
			return;		
		}
	}*/
	
	/*if($('input[name="file1"]').val()==''){
		$.messager.alert('提示','请上传工商营业执照文件','info');
		return;	
	}*/
	
/*	if($('input[name="file1"]').val()!=''){
		var b=$('input[name="file1"]').val();
		b=b.substr(b.lastIndexOf('.'));
		if(!(b=='.jpg'||b=='.jpeg'||b=='.png'||b=='.gif')){
			$.messager.alert('提示','请上传正确工商营业执照文件','info');
			return;		
		}
	}*/
	
	
		$('#fm').form('submit',{
			url:'/website/php/action/page/loginUser.act.php?action=userComplete',
			onSubmit: function(){
			},
			success: function(result){
				var res = eval("("+result+")");
				if(res.org == 0){
					var mess = "欢迎新企业用户\n点击确定完善企业信息";
					alert(mess);
				}
				else{
					var mess = "欢迎 " + res.org_name + "的用户\n系统已经保存该公司信息，点击确定进行查看、修改";
					alert(mess);
				}
				window.location.href="login_2.php?org_code=" + org_code;
			}	
		});
}

function tologinhtml(){
	window.location.href="index.html";	
}
