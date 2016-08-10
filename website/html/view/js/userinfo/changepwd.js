
function changepwd(){

	var oldPwd=$('#oldpwd').val();
	var newPwd=$('#newpwd').val();
	var rePwd2=$('#renewpwd').val();
	$.post('/modules/php/action/page/applycation/changepwd.act.php?action=getoldpwd',{pwd:oldPwd},function(data){
		if(data.retflag=='success'){
			if($('#newpwd').val()!=''){
				if($('#newpwd').val()==$('#renewpwd').val()){
					$.post('/modules/php/action/page/applycation/changepwd.act.php?action=updatepwd',{newPwd:newPwd},function(data){
						if(data=='1'){
							$('#change_pwd').form('reset');
							$.messager.alert('消息提示','修改成功！','info');
						}else{
							$.messager.alert('消息提示','修改失败！','info');
						}
					},'json');
				}else{
					alert('两次密码输入不一致');
				}
			}
			else{
				$.messager.alert('消息提示','密码不能为空','info');
				
			}
		}
		else{
			$.messager.alert('消息提示','原密码错误，请重新输入！','info');
		}
	},'json');
}
	
function reset(){
	$('#change_pwd').form('reset');
	
}
	
function cancel_readonly(){
	 var obj=document.getElementsByTagName("input");
	 for(var i=0;i<obj.length;i++){
	 obj[i].readOnly=false; 
	 obj[i].style.backgroundColor="#d2d2d2"; 
	 }
	 
	var obj2 = document.getElementById("company_summary"); 
	obj2.readOnly=false;
	var obj3=document.getElementById("research_content"); 
	obj3.readOnly=false;
	
	obj2.style.backgroundColor="#d2d2d2"; 
	obj3.style.backgroundColor="#d2d2d2"; 
}