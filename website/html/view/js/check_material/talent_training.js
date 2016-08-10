function unit_info(){
	$('#talent_training').form('submit',{
		url:'../../../../../../../modules/php/action/page/lmcheck_material/check_material.act.php?action=save_talent_training',
		success:function(result){
			$.messager.alert('提示','信息保存成功！','info',function(){
			var complete = completeInput();   
			if(complete) {
				window.parent.save_stage('talent_training');
			}else{
				window.parent.update_stage('talent_training');
			}
			window.parent.setStep('talent_training',complete);
			});
		}
	});
	
}
$(function() { 
	loadApplyInfo();
});

function completeInput() {
	var returnValue = true;
	$('input').each(function() {
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
	$.get('../../../../../../../modules/php/action/page/lmcheck_material/check_material.act.php?action=find_talent_training',
					function(result) {
						if (result != '0') {
							var res = eval("(" + result + ")");
							$('#talent_training').form('load', res);
						}
					});
		$('.save').bind('click',function(){ unit_info(); });
		$('.reset').bind('click',function(){
			window.location.reload();
		});
}


