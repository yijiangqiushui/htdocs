/**
author:Gao Xue
date:2014-04-28
Modified：Wang Le  	
data：2014/09/06
*/
var id,option;
$(function(){
	$.post('../../../php/action/page/user/user.act.php?action=getUser',function(data){
		$('#username').text(data.username);
		$('#addedDate').text(data.addedDate);
		$('#lastLoginTime').text(data.lastLoginTime);
		$('#lastIP').text(data.lastIP);
		$('#uphone').val(data.phone);
		$('#uemail').val(data.email);
		$('#uqq').val(data.qq);
		id=data.id;
	},'json');
	//验证输入信息是否符合格式
	$('.validatebox-text').bind('blur', function(){
		$(this).validatebox('enableValidation').validatebox('validate');
	});
});

function updateUser(){
	var phone=$('#uphone').val();
	var email=$('#uemail').val();
	var qq=$('#uqq').val();
	$.post('../../../php/action/page/user/user.act.php?action=updateUser',{id:id,phone:phone,email:email,qq:qq},function(data){
		if(data=='1'){
			$.messager.alert('消息提示','修改成功','info');
			//$('#fm').form('reset');
			/*--------------------添加操作日志-----------------------------------
			option='修改个人信息';
			$.post('/sp/php/action/page/log/log.act.php?action=addLog',{option:option},function(data){
			});*/
		}else{
			$.messager.alert('消息提示','修改失败','info');
		}
	});
}
function cancel(){
	$('#fm').form('reset');
}