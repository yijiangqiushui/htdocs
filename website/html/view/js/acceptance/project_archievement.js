

/***申请项目****/
function saveAchievement(){
	$('#project_archievement').form('submit',{
		url:'../../../../../modules/php/action/page/acceptance/project.act.php?action=saveArchievement',
		success:function(result){
			$.messager.alert('提示','信息保存成功！','info',function(){
				var complete = completeInput(); 
			 if(complete) {
					window.parent.save_stage('achievement');
				} else{
					window.parent.update_stage('achievement');
				}
				window.parent.setStep('achievement',complete);
			});
		}
	});
	}
		

function completeInput(){
	if(!$('textarea').val()) {
		return false;
	}else{
		return true;
	}
}


$(function(){
	loadApplyInfo();
	$('textarea').blur(function() {
   		var self = this;
		var txt = $(this).val();
		if(!txt) {
			$(self).after('<div class="error">此项不得为空</div>');
			var timer = setTimeout(function() {
				$(self).next().remove();
				},1000); 
	}
	
	});
/*	$('#back').click(function() {
		root = $(window.parent.parent.document).get(0).location.pathname;
		//alert(root)
		reg = /website/;
		result = root.search(reg);
		//alert(result)
		//前台
		if(result != -1){
			$(window.parent.parent.document).find('iframe').attr('src',"../template/user_project.php");
		}
		//后台
		else{
			$(window.parent.parent.document).find('iframe').attr('src',"/center/php/action/page/approve.php");
		}
	});*/
});
function getQueryStringByName(name){
    var result = location.search.match(new RegExp("[\?\&]" + name + "=([^\&]+)", "i"));
    if (result == null || result.length < 1) {
        return "";
    }
    return result[1];
}

	function loadApplyInfo(){
		$.get('../../../../../modules/php/action/page/acceptance/project.act.php?action=findProArchieve',function(result){
			if(result!='0'){
				var res=eval("("+result+")");
				$('#project_archievement').form('load',res);
			}
		});
		
	$('.save').bind('click',function(){ saveAchievement(); });
	$('.reset').bind('click',function(){
		window.location.reload();
	});
	
}
	
	function resetInfo(){
		alert('重置');
	}
	
	
	