function submitdata()
{
	
	$('#2coorg_info_fm').form('submit',{
		url: '/modules/php/action/page/applycation/apply2.act.php?action=coorg2Info',
		success: function(result){
			$.messager.alert('提示','信息保存成功！','info',function(){
			var complete = completeInput();  
			if(complete) {
				window.parent.save_stage('coorg_info');
			} else{
				window.parent.update_stage('coorg_info');
			} 
			window.parent.setStep('coorg_info',complete);
			});
		}
	});
}
$(function(){
	loadApplyInfo();
});

function completeInput(){
	var returnValue = true;
	$('input').each(function(){
		if(!$(this).val()){
			returnValue = false;
		}
	});
	$('textarea').each(function(){
		if(!$(this).val()){
			returnValue = false;
		}
	});
	//alert(returnValue);
	return returnValue;
}

function getQueryStringByName(name){
    var result = location.search.match(new RegExp("[\?\&]" + name + "=([^\&]+)", "i"));
    if (result == null || result.length < 1) {
        return "";
    }
    return result[1];
}

function loadApplyInfo(){
	$.get('/modules/php/action/page/applycation/apply2.act.php?action=find2CoorgInfo',
		function(result){
		if(result!=0){
			var res = eval("("+result+")");
			$('#2coorg_info_fm').form('load',res);
		}	
	});
	
	
	$('.save').bind('click',function(){ submitdata(); });
	$('.reset').bind('click',function(){
		window.location.reload();
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
	});*/
}