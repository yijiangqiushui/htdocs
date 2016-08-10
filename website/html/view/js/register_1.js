//heyangyang
$(function() {
	$('#back').click(function() {
		root = $(window.parent.parent.document).get(0).location.pathname;
		//alert(root)
		reg = /website/;
		result = root.search(reg);
		//alert(result)
		//前台
		if(result != -1){
			$(window.parent.parent.document).find('iframe').attr('src',"../template/user_project.php");
		}
		//后台
		else{
			$(window.parent.parent.document).find('iframe').attr('src',"/center/php/action/page/approve.php");
		}
	});
	
});

  $.extend($.fn.validatebox.defaults.rules, {
  phone: {
    validator: function(value){
    var rex=/^1[3|5|8][0-9]{9}$/; 
    var rex2=/^((0\d{2,3})-)(\d{7,8})(-(\d{3,}))?$/;
    if(rex.test(value)||rex2.test(value))
    {
      return true;
    }else
    {
       return false;
    }
    },
    message: '请输入正确电话或手机格式'
  }
});



function nextStep(){
	
	
	var str='';
	
	if($('input[name="orgCode"]').val()==''){
		str+='组织机构代码 ';	
	}
	if($('input[name="orgName"]').val()==''){
		str+='申报单位名称 ';	
	}
	if($('input[name="username"]').val()==''){
		str+='用户名 ';	
	}
	if($('input[name="email"]').val()==''){
		str+='电子邮箱 ';	
	}
	if($('#password').css("display")!="none"){
		if($('input[name="pwd"]').val()==''){
			str+='登录密码 ';	
		}
		if($('input[name="repwd"]').val()==''){
			str+='确认密码 ';	
		}
	}
	if($('input[name="legalPerson"]').val()==''){
		str+='企业法人 ';	
	}
	if($('input[name="contact"]').val()==''){
		str+='联系人 ';	
	}
	if($('input[name="telphone"]').val()==''){
		str+='联系人手机 ';	
	}
	if($('input[name="address"]').val()==''){
		str+='通讯地址 ';	
	}
	if($('input[name="phone"]').val()==''){
		str+='联系电话 ';	
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
	
	if($("input[name='pwd']").val()==$("input[name='repwd']").val() || ($('#password').css("display") == "none")){
		$('#fm').form('submit',{
			url:'../../../php/action/page/applyUser_add.act.php',
			onSubmit: function(){
			},
			success: function(result){
				var res = eval("("+result+")");
//				 alert(res.user_status);
				if(res.user_status == 1 && $('input[name=username]').attr("readonly")!="readonly"){
					$.messager.alert('提示', "该用户名已存在！请更换");return;
				}
				if(res.user_status == 2){// && $('input[name=username]').attr("readonly") == "readonly"
					$.messager.alert('提示', "该邮箱已被注册！请更换");return;
				}
			else{
					if(res.org_status == 1){
						var org_name = res.org_name;
						var mess = "欢迎 " + org_name + "的用户\n系统已经存在该公司信息，点击确定进行查看、修改";
						$.messager.alert('提示',mess,'info',function(){
							window.location.href="register.html?org_code=" + $('input[name="orgCode"]').val();
						});
					}
					else{
						var mess = "欢迎新企业用户\n点击确定完善企业信息";
						$.messager.alert('提示',mess,'info',function(){
							window.location.href="register.html?org_code=" + $('input[name="orgCode"]').val();
						});
/*						$.messager.alert('提示',mess,function(){
							
							$('#fm').each(function(){
								$(this).find('input').val('');
							});
						});*/
					}
					
				}
				//$('#fm').form('clear');
			}	
		});
	
	}else{
		$.messager.alert('警告','两次输入密码不同，重新输入');
	}	
}

function tologinhtml(){
	window.location.href="index.html";	
}
