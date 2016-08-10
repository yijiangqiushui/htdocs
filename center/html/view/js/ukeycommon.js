$(function(){
	ukeyfunction();
});

function findNT199(){
	var retVal = NT199_Find();
	if(retVal < 1){
		window.location.href="http://10.171.28.230/center/html/view/template/index.html";	
		alert("ErrorCode: " + NT199_GetLastError() + " 没有查找到U盾请确认是否插上！");
		return false;
	}
	else if(retVal > 1){
		alert("找到 " + retVal + " 把Key，只能对一把Key进行操作。");
		window.location.href="http://10.171.28.230/center/html/view/template/index.html";
		return false;	
	}else{
		return true;
	}
}

function ukeyfunction(){
	$.post('/center/php/action/page/ukeyOption.act.php?action=getUsr',function(result){
		var res = JSON.parse(result);
		if(res.flag==2 && res.user_type > 0){
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
}