/**
author:Gao Xue
date:2014-09-03
modify:Wang Le
date:2014-09-05
*/
$(function(){
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
	$('body').css('display','none');
	$.get('../../../../php/action/page/jdgPge.act.php',function(data){
		$('body').css('display','block');
		
		if(data=='super'){
			$('input[type="checkbox"]:checked').length;
		}else{
			if(data.indexOf('data_backup')<0){
				$('body').html('<h2>您没有操作权限</h2>');
				
			}else{
				$('input[type="checkbox"]:checked').length;
			}	
		}
	});
	
});

function backup(){
	var checkBox=$('input[type="checkbox"]:checked');
	var length=$('input[type="checkbox"]:checked').length;
	if(length!=0){
		for(var i=0;i<length;i++){
			var dataname=checkBox[i].value;
			$.post('../../../../php/action/page/data/data.act.php?action=backup',{dataname:dataname},function(data){
				var str=data.substring(6,data.length);
				$.post('../../../../php/action/page/data/data.act.php?action=saveBackup',{dbname:str},function(data){
					if(data!=''){
						$('#fm').form('reset');
					}
				});
			});
		}
		$.messager.alert('消息提示','备份成功','info');
		/*option='数据库备份';
		$.post('/sp/php/action/page/log/log.act.php?action=addLog',{option:option},function(data){});*/
	}else{
		$.messager.alert('消息提示','请选择需要备份的数据库','info');
	}
	
}