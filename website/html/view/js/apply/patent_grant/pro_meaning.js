function org_info(){

	$('#pro_meaning').form('submit',{
		url:'../attach3_patent/attach3_patent.act.php?action=pro_meaning',
		success:function(result){
			$.messager.alert('提示','信息保存成功！','info',function(){
			//judge whether this table has been finished
			var complete = completeInput();   
			if(complete) {
				//call save_stage
				window.parent.save_stage('pro_meaning');
			}else{
				window.parent.update_stage('pro_meaning');
			}
			window.parent.setStep('pro_meaning',complete);
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
			$(window.parent.parent.document).find('iframe').attr('src',"../template/user_project.php");
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
	$.get('../attach3_patent/attach3_patent.act.php?action=findpro_meaning',
					function(result) {
						if (result != '0') {
							var res = eval("(" + result + ")");
							$('#pro_meaning').form('load', res);
						}
					});
	
	
	
		$('.save').bind('click',function(){ org_info(); });
		$('.reset').bind('click',function(){
			window.location.reload();
		});
}


