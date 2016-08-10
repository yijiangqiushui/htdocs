function final_opinion(){
	$('#final_opinion').form('submit',{
		url:'/modules/php/action/page/genious/genious.act.php?action=savefinal_opinion',
		success:function(result){
			$.messager.alert('提示','信息保存成功！','info',function(){
			var complete = completeInput();   
			if(complete) {
				window.parent.save_stage('final_opinion');
			}
			window.parent.setStep('final_opinion',complete);
			});
		}
	});
	
}



$(function() {
	loadApplyInfo();
	
/*	$('#back').click(function() {
		root = $(window.parent.parent.document).get(0).location.pathname;
		//alert(root)
		reg = /website/;
		result = root.search(reg);
		//alert(result)
		//前台
		if(result != -1){
			$(window.parent.parent.document).find('iframe').attr('src',"../template/user_project_genious.php");
		}
		//后台
		else{
			$(window.parent.parent.document).find('iframe').attr('src',"/center/php/action/page/approve.php");
		}
	});*/
	
	$('#register_time').dateRangePicker({
		autoClose: true,
		singleDate : true,
		showShortcuts: false
	});
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
	$.get('/modules/php/action/page/genious/genious.act.php?action=findfinal_opinion',
					function(result) {
						if (result != '0') {
							var res = eval("(" + result + ")");
							$('#final_opinion').form('load', res);
							var save_display = $('#save_display').val();
							if(save_display == '1') {
								$('.button_wrapper').show();
							}
						}
						
					});
	
		
	$('.save').bind('click',function(){ final_opinion(); });
	$('.reset').bind('click',function(){
		window.location.reload();
	});
	
}



