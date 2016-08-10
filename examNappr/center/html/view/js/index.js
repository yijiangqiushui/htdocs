// JavaScript Document
/**************************************************
#	Veion 1.2		PHP MySQL JavaScript
#	Copyright (c) 2009 http://www.fangbian123.com
#	Author: Li Zhixiao <English Name: Hawking E-mail:578731186@qq.com QQ:578731186>
#	Date: 2014/03/16
# 	Modified by: Li zhixiao,2014/05/05
# 	Modified by: Gao Xue,2015/03/19
**************************************************/
var randomMessageFromServer,catName,flag,NTID,hashValue;
$(function(){
	if(top!=self){
		if(self!=top){
			top.location=self.location;
		}
	}
	document.title=SYSTEM.name;
	//$('title').text(SYSTEM.name);//设置页面标题
	$('.copyright').html(SYSTEM.copyright);//设置版权文字

	$("#validateCode").focus(function(){
		var img_src='../../../../common/php/file/validateCode.png.php?rand='+Math.random();
		$('.validateCodeImg').html('<img src="'+img_src+'" width="80" height="28" />');
		$('.validateCodeImg').css('display','block');
	});
	$('#submit').bind('click',function(){});
	$.post('../../../php/action/page/ukeyOption.act.php?action=getRandom',function(result){
		randomMessageFromServer =result;
	});
	var browser = DetectBrowser();
	if(browser == "Unknown"){
		alert("不支持该浏览器， 如果您在使用傲游或类似浏览器，请切换到IE模式");
		return ;
	}
	//createElementIA300() 对本页面加入IA300插件
	createElementNT199();
	//DetectActiveX() 判断IA300Clinet是否安装
	var create = DetectNT199Plugin();
	if(create == false){
		//alert("插件未安装,请直接安装CD区的插件!");
		flag=0;
		return false;
	}else{
		self.setInterval("setMsgValue()",1000);
	}
});

function submitForm(){
	if(flag==0||setMsgValue()==0){
		flag=0;
		if($.trim($('#username').val())==''){alert('提示：请输入用户名！');return false;}
		else if($.trim($('#password').val())==''){alert('提示：请输入密码！');return false;}
		else if($.trim($('#validateCode').val())==''){alert('提示：请输入验证码！');return false;}
	}else if(setMsgValue()==1){//插入多个Ukey,不可登录
		return false;
	}else{//Ukey用户登录
		flag=2;
		var retVal=NT199_Find();
		retVal = NT199_CheckPassword($.trim($('#password').val()));
		if(retVal != 0){
			alert("用户密码验证失败！");
			return false;
		}
		//获取Key硬件ID
		NTID = NT199_GetHardwareId();
		hashValue = NT199_Sha1WithSeed(randomMessageFromServer);
		if(hashValue == ""){
			alert("二次验证码计算出错！");
			return false;	
		}
	}
	$.post("../../../php/action/page/index.php",{NTID:NTID,Digest:hashValue,flag:flag,usr:$.trim($('#username').val()),userPin:$.trim($('#password').val()),validateCode:$.trim($('#validateCode').val())},function(result){
//		alert(result);
		switch(result){
			case 'code_err':alert('提示：验证码输入错误！');srandValidateCode();break;
			case 'forbidden':alert('提示：该用户已被禁止使用！');break;
			case 'delete':alert('提示：该用户已被删除！');break;
			case 'data_err':alert('提示：数据库发生错误，请联系技术人员进行处理！');break;
			//case 'incorrect':alert('提示：此设备未注册,联系管理员申请注册后使用！');break;
			case 'incorrect':
				if(flag==0||setMsgValue()==0){
					alert('提示：用户名或密码错误,请重新输入！');
				}else{
					alert('提示：此设备未注册,联系管理员申请注册后使用！');
				}
				break;
			case 'success':
				window.location.href='main.html';
				break;
			default:alert('提示：系统发生错误，请联系技术人员进行处理！');
		}
	});
}

function srandValidateCode(){
	$('.validateCodeImg img').attr('src','../../../../common/php/file/validateCode.png.php?rand='+Math.random());
}
function setMsgValue(){
	var retVal = NT199_Find();
	if(retVal < 1){
		$('.msgValue').css({'display':'none'});
		$('.username').css({'display':'block'});
		//$('.msg').html("此用户需要插入Ukey可登录！");
		return 0;
	}else if(retVal > 1){
		$('.msgValue').css({'display':'block'});
		$('.username').css({'display':'none'});
		$('.msg').html("找到 " + retVal + " 把Key，只能对一把Key进行操作");
		return 1;
	}else{
		$('.msgValue').css({'display':'block'});
		$('.username').css({'display':'none'});
		$('.msg').html("成功插入设备,请输入密码！");
		return 2;
	}
}