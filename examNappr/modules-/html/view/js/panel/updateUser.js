/**
author:Gao Xue
date:2014-04-28
Modified：Wang Le  	
data：2014/09/06
*/
var id,option;
$(function(){
	$.post('../../../../php/action/page/panel/user.act.php?action=getUser',function(data){
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
	/*$('.validatebox-text').bind('blur', function(){
		$(this).validatebox('enableValidation').validatebox('validate');
	});*/
	$.post('../../../../../center/php/action/page/ukeyOption.act.php?action=getUsr',function(result){
		if(result==2){
			var browser = DetectBrowser();
			if(browser == "Unknown")
			{
				alert("不支持该浏览器， 如果您在使用傲游或类似浏览器，请切换到IE模式");
				return ;
			}
			//createElementIA300() 对本页面加入IA300插件
		   
			createElementNT199();
			//DetectActiveX() 判断IA300Clinet是否安装
			var create = DetectNT199Plugin();
			if(create == false)
			{
				alert("插件未安装,,请直接安装CD区的插件!");
				return false;
			}
			self.setInterval("findNT199()",1000);
		}
	});
});

function updateUser(){

		var phone=$('#uphone').val();
		var email=$('#uemail').val();
		var qq=$('#uqq').val();
		$.post('../../../../php/action/page/panel/user.act.php?action=updateUser',{id:id,phone:phone,email:email,qq:qq},function(data){
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

function check(){
	
		if(!$("#uphone").val().match(/^(13[0-9]|14[0-9]|15[0-9]|18[0-9])\d{8}$/)){
		//if (!$("#uphone").val().match(/^(((13[0-9]{1})|159|153)+\d{8})$/)) {
			alert("手机号码格式不正确！");
			$("#uphone").val();
			$("#uphone").focus();
			return false;
		} 
		if (!$("#uemail").val().match(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/)) {
			alert("邮箱格式不正确！");
			$("#uemail").focus();
			return false;
		} 
		
	
		if (!$("#uqq").val().match( /^\s*[.0-9]{5,11}\s*$/)) {
			alert("QQ号码格式不正确！");
			$("#uqq").focus();
			return false;
		
	     }
		updateUser()
}