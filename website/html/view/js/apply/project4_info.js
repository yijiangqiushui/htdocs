$(function(){
		loadApplyInfo();
		dateplu();
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

	
	function getQueryStringByName(name){
	    var result = location.search.match(new RegExp("[\?\&]" + name + "=([^\&]+)", "i"));
	    if (result == null || result.length < 1) {
	        return "";
	    }
	    return result[1];
	}
	
	function loadApplyInfo(){//回写的函数
		$.get('/modules/php/action/page/applycation/apply4.act.php?action=find4ProInfo',function(result){
			if(result!='0'){
				var res = eval("("+result+")");
				$('#4pro_info_fm').form('load',res);
				
			}
		});
		$('.save').bind('click',function(){ submit_data(); });
		$('.reset').bind('click',function(){
			window.location.reload();
		});
	
	}


	function submit_data(){
		//alert("被调用了吗？");
		$('#4pro_info_fm').form('submit', {
			 url:'/modules/php/action/page/applycation/apply4.act.php?action=pro4Info',
			 success:function(result){
				$.messager.alert('提示','信息保存成功！','info',function(){
					var complete = completeInput();
					if(complete){
						
						window.parent.save_stage('project_info');
					}else{
						window.parent.update_stage('project_info');
					} 
					window.parent.setStep('project_info',complete);
				});
				
			 }
		});
	}

	
	function completeInput() {
		var returnValue = true;
		$('textarea').each(function() {
			if(!$(this).val()) {
				returnValue = false;
			}
		})
		$('input').each(function() {
			if(!$(this).val()) {
				returnValue = false;
			}
		})
		return returnValue;
	}
	