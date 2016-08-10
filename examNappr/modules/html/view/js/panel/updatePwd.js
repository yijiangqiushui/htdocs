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
				return $(param[0]).val()==value ;
			},
			message:'字段不匹配'
		} 
	});
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
			$('#pwd0').text('修改用户密码:');
			$('#pwd1').css({'display':'none'});
			$('#pwd2').css({'display':'none'});
			$('#pwd3').css({'display':''});
		}else{
			$('#pwd0').text('原始密码:');
			$('#pwd1').css({'display':''});
			$('#pwd2').css({'display':''});
			$('#pwd3').css({'display':'none'});
		}
	});
});
function updatePwd(){
	$.post('../../../../../center/php/action/page/ukeyOption.act.php?action=getUsr',function(result){
		if(result==2){
			$.post('../../../../../center/php/action/page/ukeyOption.act.php?action=getOldPwd',function(result){
				var oldUserPin=result;
				var uPin = $.trim($('#oldPwd').val());
				if(uPin == "")
				{
					alert("用户密码不能为空！");
					return false;	
				}else{
					if($.trim($('#oldPwd').val())!=$.trim($('#rePwd2').val())){
						alert('两次密码输入不一致');return false;
					}else{
						var Rtn =  NT199_ChangePassword(oldUserPin, uPin, uPin);
						if(Rtn!=0)
						{
						 alert("修改用户密码失败，错误码："+ NT199_GetLastError());
						 return false;
						}
						//$.messager.alert('消息提示','修改成功！','info');
						alert('修改成功！');
						window.location.href="../../../../../center/html/view/template/index.html";
						//$('#fm').form('reset');
					}
				}
			});
		}else{
			var oldPwd=$.trim($('#oldPwd').val());
			var newPwd=$.trim($('#newPwd').val());
			var rePwd2=$.trim($('#rePwd2').val());
			$.post('../../../../php/action/page/panel/user.act.php?action=checkold',{pwd:oldPwd},function(data){
				if(data.retflag=='success'){
					if($.trim($('#newPwd').val())!=''){
						if($.trim($('#newPwd').val())==$.trim($('#rePwd').val())){
							$.post('../../../../php/action/page/panel/user.act.php?action=updatePwd',{newPwd:newPwd},function(data){
								if(data=='1'){
									$('#fm').form('reset');
									//$.messager.alert('消息提示','修改成功！','info');
									alert('修改成功！');
									window.location.href="../../../../../center/html/view/template/index.html";
								}else{
									$.messager.alert('消息提示','修改失败！','info');
								}
							},'json');
						}else{
							alert('两次密码输入不一致');
						}
					}else{
						alert('密码不能为空或空格');
						}
				}
				else{
					$.messager.alert('消息提示','原密码错误，请重新输入！','info');
				}
			},'json');
		}
	});
}

//重置表单
function cancel(){
	$('#fm').form('reset');
}

