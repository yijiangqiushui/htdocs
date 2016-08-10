<!--
/************************************************************************************************************
#	PHP Version 1.2   MySQL  JavaScript
#	Copyright (c) 2009 http://www.cnalog.com
#	Author: Li Zhixiao <English Name: Hawking E-mail:lzxbit2008@yahoo.com.cn QQ:578731186>
#	Date: 2009/10/10
************************************************************************************************************/

/**
* 点击让验证码图片随机改变
**/
document.onreadystatechange =function(){
	var getClearCode=document.getElementById("getClearCode");
	if(getClearCode){
		getClearCode.onclick=function(){
			getCodeFun();
		}
	}
	
	function getCodeFun(){
		var vrifyCode=document.getElementById("vrifyCodeImg");
		vrifyCode.src="/cms/system/inc/verify.img.php?change="+Math.random();
	}
}
//-->