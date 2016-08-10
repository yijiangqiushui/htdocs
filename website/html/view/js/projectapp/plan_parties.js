function saveCheckOpin(){
		$('#plan_parties').form('submit',{
			url:'../../../../../modules/php/action/page/projectapp/projectapp.act.php?action=savePlanParties',
			success:function(result){
				$.messager.alert('提示','信息保存成功！','info',function(){
					//judge whether this table has been finished
					var complete = completeInput();   
					if(complete) {
						//call save_stage
						window.parent.save_stage('plan_parties');
					} else{
						window.parent.update_stage('plan_parties');
					}
					window.parent.setStep('plan_parties',complete);
					});
			}
		});
	
}

$(function(){
	loadApplyInfo();
	$('#back').click(function() {
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
	});
});
	function loadApplyInfo(){
		$.get('../../../../../modules/php/action/page/projectapp/projectapp.act.php?action=findPlanPart',function(result){
			if(result!='0'){
				var res=eval("("+result+")");
				//alert(res.org_code);
				$('#plan_parties').form('load',res);
			}
		});
	
		$('.save').bind('click',function(){ saveCheckOpin(); });
		$('.reset').bind('click',function(){
			window.location.reload();
		});
	}
	
	function resetInfo(){
		$('#plan_parties').form('reset');
	}
	

	function completeInput() {
		var returnValue = true;
		$('input').each(function() {
			if(!$(this).val().trim()) {
				returnValue = false;
			}
		})
		$('textare').each(function() {
			if(!$(this).val().trim()) {
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
	

