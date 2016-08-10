function submit_data(){
		$('#7org_info_fm').form('submit' ,{
			url: '/modules/php/action/page/applycation/apply7.act.php?action=7orgInfo',
			success: function(result){
				//$('#7org_info_fm').form('reset');
				$.messager.alert('提示','保存信息成功','info',function(){
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

$(function()
		{
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
		})*/
});
	function loadApplyInfo(){
		$.get('/modules/php/action/page/applycation/apply7.act.php?action=7findOrgInfo',
		function(result){
			if(result!='0'){
				var res=eval("("+result+")");
				$('#7org_info_fm').form('load',res);
				/*if(res.listed==0){
					 $('.listed_code').attr('disabled','disabled');
				}*/
			}
		});
		
		$('.save').bind('click',function(){ submit_data();});
		$('.reset').bind('click',function(){
			  window.location.reload();
		});
		
		
	}
	function getQueryStringByName(name){
	    var result = location.search.match(new RegExp("[\?\&]" + name + "=([^\&]+)", "i"));
	    if (result == null || result.length < 1) {
	        return "";
	    }
	    return result[1];
	}
	function completeInput() { 
		var returnValue = true;
		$('input').not(':disabled').each(function() {  
			if (!$(this).val().trim()) {
				returnValue = false;
			}
		})
		$('textarea').each(function() {  
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