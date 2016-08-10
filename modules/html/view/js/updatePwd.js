/**
author:Gao Xue
date:2014-04-28
*/
var id,option,pwd;
$(function(){
	$.extend($.fn.validatebox.defaults.rules, {  
    /*必须和某个字段相等*/
		equalTo: {
			validator:function(value,param){
				return $(param[0]).val() == value;
			},
			message:'字段不匹配'
		} 
	});
});


//修改密码
function updatePwd(){
	var oldPwd=$('#oldPwd').val();
	var newPwd=$('#newPwd').val();
	$.post('../../../php/action/page/user/user.act.php?action=checkold',{pwd:oldPwd},function(data){
		if(data.retflag=='success'){
			if($('#newPwd').val()!=''){
				$.post('../../../php/action/page/user/user.act.php?action=updatePwd',{newPwd:newPwd},function(data){
					if(data=='1'){
						$('#fm').form('reset');
						$.messager.alert('消息提示','修改成功！','info');
					}else{
						$.messager.alert('消息提示','修改失败！','info');
					}
				}),'json';
			}
		}
		else{
			$.messager.alert('消息提示','原密码错误，请重新输入！','info');
		}
	},'json');
}

//重置表单
function cancel(){
	$('#fm').form('reset');
}

