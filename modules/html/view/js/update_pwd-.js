
$(function(){
	
	$('#pwd').blur(function(){
		$.post( '../../../php/action/page/apply_org.act.php?action=getpwd',{'pwd':$('#pwd').val()},function(data){			
				if(data.retflag=='wrong'){
					alert('密码输入不正确，请重新输入');
					$('#fm').form('clear');			
					$('#pwd').focus();	
				}
		   },'json');	
	});			
		
});

function savepwd(){			
			if($('#pwd1').val()!=$('#pwd2').val()){
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