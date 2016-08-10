
$(function(){});

function savepwd(){
	if($('#pwd').val()==''){
		alert("请输入原始密码！");
	}
	else{
		$.post( '../../../php/action/page/apply_org.act.php?action=getpwd',{'pwd':$('#pwd').val()},function(data){			
			if(data.retflag=='wrong'){
				alert('原始密码输入不正确，请重新输入');
				$('#fm').form('clear');			
				$('#pwd').focus();
			}
			else{
				if($.trim($('#pwd1').val())==''){
					alert('请输入新密码！');
					$('#pwd1').focus();
				}
				else if($('#pwd1').val()!=$('#pwd2').val()){
					alert('两次输入新密码不相同，请重新输入');		
				}else{
					$('#fm').form('submit',{
						 url:'../../../php/action/page/apply_org.act.php?action=savepwd',
						 onSubmit: function(){
						 },
						 success: function(result){			
							alert('修改成功');
							$('#fm').form('clear');
						 }
					 });	
				}
			}
		},'json');	
	}
}