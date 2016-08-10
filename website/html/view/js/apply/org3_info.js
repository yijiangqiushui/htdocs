$(function(){
	loadApplyInfo();
});

function getQueryStringByName(name){
    var result = location.search.match(new RegExp("[\?\&]" + name + "=([^\&]+)", "i"));
    if (result == null || result.length < 1) {
        return "";
    }
    return result[1];
}

function loadApplyInfo(){
	$.get('/modules/php/action/page/applycation/apply3.act.php?action=find3OrgInfo',function(result){
		if(result!='0'){
			var res = eval("("+result+")");
			$('#3org_info_fm').form('load',res);
			if(res.listed==0){
				 $('.listed_code').attr('disabled','disabled');
			}
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

function submitdata(){
	$('#3org_info_fm').form('submit', {
		url: '/modules/php/action/page/applycation/apply3.act.php?action=org3Info',
		success: function(result){
			$.messager.alert('提示','信息保存成功！','info',function(){
				var complete = completeInput();  
				if(complete) {
					window.parent.save_stage('org_info');
				}  else{
					window.parent.update_stage('org_info');
				} 
				window.parent.setStep('org_info',complete);
			});
		}
	});
}

function completeInput() { 
	var returnValue = true;
	$('input').not(':disabled').each(function() {  
		if (!$(this).val().trim()) {
			returnValue = false;
		}
	})
 
	return returnValue;
}

function ispicth(element){
	if(element.value == '1'){
		$('.listed_code').removeAttr('disabled');
	}else{
	  $('.listed_code').attr('disabled','disabled');
	  $('.listed_code').val(null);
	}
}
