function org_info(){
	$('#pro_target').form('submit',{
		url:'../attach3_patent/attach3_patent.act.php?action=pro_target',
		success:function(result){
			$.messager.alert('提示','信息保存成功！','info',function(){
			//judge whether this table has been finished
			var complete = completeInput();   
			if(complete) {
				//call save_stage
				window.parent.save_stage('pro_target');
			}else{
				window.parent.update_stage('pro_target');
			}
			window.parent.setStep('pro_target',complete);
			});
		}
	});
}



$(function() {
	loadApplyInfo();
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
	$.get('../attach3_patent/attach3_patent.act.php?action=findpro_target',
					function(result) {
						if (result != '0') {
							var res = eval("(" + result + ")");
							$('#pro_target').form('load', res);
						}
					});
		$('.save').bind('click',function(){ org_info(); });
		$('.reset').bind('click',function(){
			window.location.reload();
		});
}


