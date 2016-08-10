function work_product(){
	$('#work_product').form('submit',{
		url:'/modules/php/action/page/genious/genious.act.php?action=savework_product',
		success:function(result){
			$.messager.alert('提示','信息保存成功！','info',function(){
			var complete = completeInput();   
			if(complete) {
				window.parent.save_stage('work_product');
			}
			window.parent.setStep('work_product',complete);
			});
		}
	});
	
}



$(function() {
	loadApplyInfo();
	/*
	$('#back').click(function() {
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
	$('textarea').each(function() {
		if(!$(this).val()) {
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
	$.get('/modules/php/action/page/genious/genious.act.php?action=findwork_product',
					function(result) {
						if (result != '0') {
							var res = eval("(" + result + ")");
							$('#work_product').form('load', res);
							var save_display = $('#save_display').val();
							if(save_display == '1') {
								$('.button_wrapper').show();
							}
						}
						
					});
	
		
		$('.save').bind('click',function(){ work_product(); });
		$('.reset').bind('click',function(){
			window.location.reload();
		});
	
}



