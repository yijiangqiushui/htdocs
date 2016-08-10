function honor_title(){
	$('#honor_title').form('submit',{
		url:'/modules/php/action/page/genious/genious.act.php?action=savesupporthonor_title',
		success:function(result){
			$.messager.alert('提示','信息保存成功！','info',function(){
			var complete = completeInput();   
			if(complete) {
				window.parent.save_stage('honor_title');
			}
			window.parent.setStep('honor_title',complete);
			});
		}
	});
	
}



$(function() {
	loadApplyInfo();
	
	/*$('#back').click(function() {
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
	$.get('/modules/php/action/page/genious/genious.act.php?action=support_findhonor_title',
					function(result) {
						if (result != '0') {
							var res = eval("(" + result + ")");
							$('#honor_title').form('load', res);
						}
						
					});
		$('.save').bind('click',function(){ honor_title(); });
		$('.reset').bind('click',function(){
			window.location.reload();
		});
	
}
