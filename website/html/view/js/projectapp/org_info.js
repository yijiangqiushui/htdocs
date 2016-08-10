function org_info(){
	$('#org_info').form('submit',{
		url:'../../../../../../modules/php/action/page/projectapp/projectapp.act.php?action=saveApplication',
		success:function(result){
			$.messager.alert('提示','信息保存成功！','info',function(){
			//judge whether this table has been finished
			var complete = completeInput();
			if(complete) {
				//call save_stage
				window.parent.save_stage('org_info');
			}else{
				window.parent.update_stage('org_info');
			}
			window.parent.setStep('org_info',complete);
			});
		}
	});
}

$(function(){
	loadApplyInfo();
	dateplu();
});


function completeInput(){
	var returnValue = true;
	$('input').each(function() {
		if(!$(this).val()) {
			returnValue = false;
		}
	});
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
	$.get('../../../../../../modules/php/action/page/projectapp/projectapp.act.php?action=findProOrg',
					function(result) {
						if (result != '0') {
							var res = eval("(" + result + ")");
							$('#org_info').form('load', res);
							
						}
						
					});
	$('.save').bind('click',function(){ org_info(); });
	$('.reset').bind('click',function(){
		window.location.reload();
	});
}

