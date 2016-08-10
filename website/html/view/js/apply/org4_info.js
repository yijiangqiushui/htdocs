$(function(){
	loadApplyInfo();
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
		
		//$(window.parent.parent.document).find('iframe').attr('src',"../template/user_project.php");
	});*/
	
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

function submit_data(){
	$('#4org_info_fm').form('submit',{
		url:'../../../../../../modules/php/action/page/applycation/apply4.act.php?action=org4Info',
		success: function(result){
			$.messager.alert('提示','信息保存成功！','info',function(){
				var complete = completeInput(); 
				if(complete){
					window.parent.save_stage('org_info');
				}else{
					window.parent.update_stage('org_info');
				} 
				window.parent.setStep('org_info',complete);
				
				
			});
			
			//window.parent.selectStep(1);//设置选中某个步骤
		}
	});
}
function getQueryStringByName(name){
    var result = location.search.match(new RegExp("[\?\&]" + name + "=([^\&]+)", "i"));
    if (result == null || result.length < 1) {
        return "";
    }
    return result[1];
}
function loadApplyInfo(){
	$.get('/modules/php/action/page/applycation/apply4.act.php?action=find4OrgInfo',function(result){
		if(result!='0'){
			var res=eval("("+result+")");
			//alert(res.org_code);
			//alert(typeof res);
			$('#4org_info_fm').form('load', res);
			var save_display = $('#save_display').val();
			if(save_display == '1') {
				$('.button_wrapper').show();
			}
		}
	});
	
	$('.save').bind('click',function(){ submit_data();});
	$('.reset').bind('click',function(){
		  window.location.reload();
		  
		  
		  
	});
	
}



