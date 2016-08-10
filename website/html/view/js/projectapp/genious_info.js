function genious_info(){
	$('#genious_info').form('submit',{
		url:'/modules/php/action/page/genious/genious.act.php?action=save_award',
		success:function(result){
			$.messager.alert('提示','信息保存成功！','info',function(){
			var complete = completeInput();   
			if(complete) {
				window.parent.save_stage('genious_info');
			}
			window.parent.setStep('genious_info',complete);
			});
		}
	});
}



$(function() {
	birth_day();
	loadApplyInfo();
	dateplu();
/*	$('#back').click(function() {
		root = $(window.parent.parent.document).get(0).location.pathname;
		reg = /website/;
		result = root.search(reg);
		//前台
		if(result != -1){
			$(window.parent.parent.document).find('iframe').attr('src',"../template/user_project_genious.php");
		}
		//后台
		else{
			$(window.parent.parent.document).find('iframe').attr('src',"/center/php/action/page/approve.php");
		}
	});*/
});

function completeInput() {
	var returnValue = true;
	$('input').each(function() {
		if(!$(this).val()) {
			returnValue = false;
		}
	})
	$('textarea').each(function() {  
		if (!$(this).val().trim()) {
			returnValue = false;
		}
	})
	return returnValue;
}

function getQueryStringByName(name){
    var result = location.search.match(new RegExp("[\?\&]" + name + "=([^\&]+)", "i"));
    if (result == null || result.length < 1) {
        return "";
    }
    return result[1];
}

function loadApplyInfo() {
	$.get('/modules/php/action/page/genious/genious.act.php?action=findGenious',
					function(result) {
						if (result != '0') {
							var res = eval("(" + result + ")");
							$('#genious_info').form('load', res);
							var save_display = $('#save_display').val();
							if(save_display == '1') {
								$('.button_wrapper').show();
							}
						}
						
					});
	
	
		$('.save').bind('click',function(){ genious_info(); });
		$('.reset').bind('click',function(){
			window.location.reload();
		});
	
}


