

/***申请项目****/
function saveApplys(){
	$('#modify_apply').form('submit',{
		url:'../../../../../modules/php/action/page/implement/middle.act.php?action=saveApplys',
		success:function(result){
			$.messager.alert('提示','信息保存成功！','info',function(){
				var complete = completeInput();    
				if(complete) {
					window.parent.save_stage('org_info');
				} else{
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
	$('.border_none').change(function(){
		sum();
	});
	 //$('.tofixed').change(function(){
	 //   	tofixed(this);
	 //   });
	
});


function tofixed(object){
	var temp = object.value;
	$(object).val(Number(temp).toFixed(2));
}

function completeInput() {
	var returnValue = true;
	$('input').each(function() {
		if(!$(this).val()) {
			returnValue = false;
		}
	})
	$('textarea').each(function() { 
		if(!$(this).val()) { 
			if($(this).attr("id")!="no"){
				returnValue = false;
			}
			
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

	function loadApplyInfo(){
		$.get('../../../../../modules/php/action/page/implement/middle.act.php?action=findModifyApp',
				function(result){
	                 if(result!='0'){
		                  var res=eval("("+result+")");
		                  $('#modify_apply').form('load',res);
		                  var save_display = $('#save_display').val();
							if(save_display == '1') {
								$('.button_wrapper').show();
							}
	                  }
		         });
		
	$('.save').bind('click',function(){ saveApplys(); });
	$('.reset').bind('click',function(){
		window.location.reload();
	});
	
}function resetInfo(){
	alert('重置');
}