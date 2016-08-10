function submit_data(){
		$('#hatch9_fm').form('submit' ,{
			url: '/modules/php/action/page/applycation/apply9.act.php?action=9hatchFm',
			success: function(result){
				$.messager.alert('提示','信息保存成功！','info',function(){
				var complete = completeInput();
				if(complete){
					
					window.parent.save_stage('hatch');
				}else{
					window.parent.update_stage('hatch');
				} 
				window.parent.setStep('hatch',complete);
			});
			}
		});
	}

/**
 * 这个方法是判断是不是所有的 信息都填写完了 然后进一步设置是不是显示小对勾
 * 
 * @returns {Boolean}
 */
function completeInput() {
	var returnValue = true;
	$('input').each(function() {
		if (!$(this).val().trim()) {
			returnValue = false;
		}
	})
	return returnValue;
}

$(function()
		{
		loadApplyInfo();
		});
	function loadApplyInfo(){
		$.get('/modules/php/action/page/applycation/apply9.act.php?action=9findHatchFm',
		function(result){
			if(result!='0'){
				var res=eval("("+result+")");
				$('#hatch9_fm').form('load',res);
			}
		});

		
		$('.save').bind('click',function(){ submit_data(); });
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