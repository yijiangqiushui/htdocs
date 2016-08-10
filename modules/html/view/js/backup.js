//var option;
$(function(){
	$('body').css('display','none');
	$.get('../../../php/action/page/jdgPge.act.php',function(data){
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
			$.post('../../../php/action/page/data/data.act.php?action=backup',{dataname:dataname},function(data){
				var str=data.substring(6,data.length);
				$.post('../../../php/action/page/data/data.act.php?action=saveBackup',{dbname:str},function(data){
					if(data!=''){
						$('#fm').form('reset');
					}
				});
			});
		}
		$.messager.alert('消息提示','备份成功','info');
	}else{
		$.messager.alert('消息提示','请选择需要备份的数据库','info');
	}
	
}