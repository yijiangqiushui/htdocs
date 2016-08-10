function pro_effect(){
	$('#project_effect').form('submit',{
		url:'../../../../../../modules/php/action/page/projectapp/projectapp.act.php?action=project_effect',
		success:function(result){
			$.messager.alert('提示','信息保存成功！','info',function(){
			saveJsonData();	
			var complete = completeInput();  
			if(complete) {
				window.parent.save_stage('recommend_plan');
			} else{
				window.parent.update_stage('recommend_plan');
			}
			window.parent.setStep('recommend_plan',complete);
			});
		}
	});
}

$(function()
{
	loadApplyInfo();
	$('textarea').blur(function() {
		var self = this;
		var txt = $(this).val();
		if(!txt) {
			if(!$(self).attr('readonly')) {
				$(self).after('<div class="error">此项不得为空</div>');
				var timer = setTimeout(function() {
					$(self).next().remove();
					},1000); 
			} else {
				$(self).after('<div class="error1">此项不需要用户输入</div>');
				var timer = setTimeout(function() {
					$(self).next().remove();
					},1000); 
			}
			
		}
	});
	/*$('#back').click(function() {
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
		
		
	})*/
});

function completeInput(){
	
	var flag = false;
	$('textarea').each(function(){
		if(!$(this).is(":hidden")){
			if(!$(this).val()){
				flag = true;
			}	
		}
	});
	
	if(flag) {
		return false;
	}else{
		return true;
	}
}
	function loadApplyInfo(){
		$.get('../../../../../../modules/php/action/page/projectapp/projectapp.act.php?action=findProEconomy',function(result){
			if(result!='0'){
				var res=eval("("+result+")");
				$('#project_effect').form('load',res);
			}
		});
		
		
		$('.save').bind('click',function(){ pro_effect(); });
		$('.reset').bind('click',function(){
			window.location.reload();
	});
}
function getQueryStringByName(name){
    var result = location.search.match(new RegExp("[\?\&]" + name + "=([^\&]+)", "i"));
    if (result == null || result.length < 1) {
        return "";
    }
    return result[1];
}
