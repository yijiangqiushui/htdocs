function submit_data(){
		$('#manage9_state').form('submit' ,{
			url: '/modules/php/action/page/applycation/apply9.act.php?action=manage9_state',
			success: function(result){
				$.messager.alert('提示','信息保存成功！','info',function(){
				var complete = completeInput();
				if(complete){
					
					window.parent.save_stage('manage_state');
				}else{
					window.parent.update_stage('manage_state');
				} 
				window.parent.setStep('manage_state',complete);
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

$(function(){
	 
		
		var current_date = new Date();
		var current_year = current_date.getFullYear() - 1;
		var option = '';
		for(var i = current_year-10; i<current_year +10; i++) {
			option += '<option value="'+i+'"">'+i+'</option>'
		}
	    $('.current_year').append(option);
	    year();
	    loadApplyInfo();
	
		/*$('#back').click(function() {
			$(window.parent.parent.document).find('iframe').attr('src',"../template/user_project.php");
		})*/
});


	function loadApplyInfo(){
		$.get('/modules/php/action/page/applycation/apply9.act.php?action=9findManageState',
		function(result){
			if(result!='0'){ 
				var res=eval("("+result+")");
				$('#manage9_state').form('load',res);
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
	
	
	

	function year(){
		var year = new Date();
		var temp = year.getFullYear();
	    $("select[name='the_year[0]']").val(temp-3);
	    $("select[name='the_year[1]']").val(temp-2);
	    $("select[name='the_year[2]']").val(temp-1);
	}