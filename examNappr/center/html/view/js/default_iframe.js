// JavaScript Document
$(document).ready(function(){
	$.get('../../../php/action/page/main.php?action=cur_user',function(res){
		var a=res.split('{|}');
		$('#cur_user').text(a[5]);
		$('#catName').text(a[1]);
		$('#addedDate').text(a[2]);
		$('#lastIP').text(a[3]);
		$('#lastLoginTime').text(a[4]);
	});
	
	$.post('../../../php/action/page/ukeyOption.act.php?action=getUsr',function(result){
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
