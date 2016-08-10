/**
 * 
 */

function project_mean(){	
	$('#project_mean').form('submit',{
		url:'../../../../../../modules/php/action/page/projectapp/projectapp.act.php?action=project_mean',
		success:function(result){
			$.messager.alert('提示','信息保存成功！','info',function(){
			saveJsonData();
			var complete = completeInput();
			if(complete) {
				window.parent.save_stage('project_mean');
			}else{
				window.parent.update_stage('project_mean');
			}
			window.parent.setStep('project_mean',complete);
			});
		}
	});
}


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


$(function(){
	loadApplyInfo();
	$('textarea').blur(function() {
   		var self = this;
		var txt = $(this).val();
		var length = txt.length;
//		alert(length);
		var maxlength = $(this).attr('title');
//		alert(maxlength + "11");
		if(!txt) {
			if(!$(self).attr('readonly')) {
				$(self).after('<div class="error">此项不得为空</div>');
				var timer = setTimeout(function() {
					$(self).next().remove();
					},1000); 
			} else {
				$(self).after('<div class="error1">此项不需要用户输入</div>');
				var timer = setTimeout(function(){
					$(self).next().remove();
					},1000); 
			}
			
		}
		
	});
	/*$('#back').click(function() {
		root = $(window.parent.parent.document).get(0).location.pathname;
		reg = /website/;
		result = root.search(reg);
		//前台
		if(result != -1){
		$(window.parent.parent.document).find('iframe').attr('src',"../template/user_project.php");
		}else{
			$(window.parent.parent.document).find('iframe').attr('src',"/center/php/action/page/approve.php")
			
		}
		
	})*/
});


function getQueryStringByName(name){
    var result = location.search.match(new RegExp("[\?\&]" + name + "=([^\&]+)", "i"));
    if (result == null || result.length < 1) {
        return "";
    }
    return result[1];
}
function loadApplyInfo(){
		$.get('../../../../../../modules/php/action/page/projectapp/projectapp.act.php?action=findProjectMean',function(result){
			if(result!='0'){	
				var res=eval("("+result+")");
				$('#project_mean').form('load',res);
			}
		});
	$('.save').bind('click',function(){ project_mean(); });
	$('.reset').bind('click',function(){
		window.location.reload();
	})
	}
	
function resetInfo(){
	alert('重置');
}
