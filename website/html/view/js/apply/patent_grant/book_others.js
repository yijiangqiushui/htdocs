function org_info(){

	$('#book_others').form('submit',{
		url:'../attach3_patent/attach3_patent.act.php?action=book_others',
		success:function(result){
			$.messager.alert('提示','信息保存成功！','info',function(){
			//judge whether this table has been finished
			var complete = completeInput();  
			//alert(complete);
			if(complete) {
				//call save_stage
				window.parent.save_stage('book_others');
			}else{
				window.parent.update_stage('book_others');
			}
			window.parent.setStep('book_others',complete);
			});
		}
	});
}
$(function() {
	loadApplyInfo();
});
function completeInput() {
	var returnValue = true;
	$("input[id!='save_display']").each(function() {
		//alert($(this).val());
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
	//该页面需要请求两次，保存的数据存在tabledata里了，没有填写时需要加载默认数据
$.get('../attach3_patent/attach3_patent.act.php?action=findBook_others',
					function(result) {
						if (result != '0') {
							var res = eval("(" + result + ")");
							$('#book_others').form('load', res);
						}
					});
    	$('.save').bind('click',function(){ org_info(); });
		$('.reset').bind('click',function(){
			window.location.reload();
		});
}


