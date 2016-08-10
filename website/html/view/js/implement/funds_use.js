function funds_use(){
	$('#total_funds').form('submit',{
		url:'../../../../../../../extends/Table/api.php?action=save&subtable_id=48',
		success:function(result){
			$.messager.alert('提示','信息保存成功！','info',function(){
			//judge whether this table has been finished
			var complete = completeInput();
			if(complete) {
				//call save_stage
				window.parent.save_stage('funds_use');
			}else{
				window.parent.update_stage('funds_use');
			}
			window.parent.setStep('funds_use',complete);
			});
		}
	});
}



$(function() {
	loadApplyInfo();
	  year();
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

});


function completeInput() {
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
	$.get('../../../../../../../extends/Table/api.php?action=get&subtable_id=48',
					function(result) {
						if (result != '0') {
							var res = eval("(" + result + ")");
							$('#total_funds').form('load', res);
							
						}
						
					});
	
	
		$('.save').bind('click',function(){ funds_use(); });
		$('.reset').bind('click',function(){
			window.location.reload();
		});
}

function year(){
	var year = new Date();
	var temp = year.getFullYear();
    $("input[name='year[0]']").val(temp);
    $("input[name='year[1]']").val(temp+1);
    $("input[name='year[2]']").val(temp+2);
    $("input[name='p_m_year[0]']").val(temp);
    $("input[name='p_m_year[1]']").val(temp+1);
    $("input[name='p_m_year[2]']").val(temp+2);
}
