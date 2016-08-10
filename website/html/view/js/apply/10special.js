function submit_data(){
		$('#special').form('submit' ,{
			url: '/modules/php/action/page/applycation/apply9.act.php?action=10special',
			success: function(result){
				$.messager.alert('提示','信息保存成功！','info',function(){
				var complete = completetextarea();
				if(complete){
					
					window.parent.save_stage('special');
				}else{
					window.parent.update_stage('special');
				} 
				window.parent.setStep('special',complete);
			});
			}
		});
	}

/**
 * 这个方法是判断是不是所有的 信息都填写完了 然后进一步设置是不是显示小对勾
 * 
 * @returns {Boolean}
 */
function completetextarea() {
	var returnValue = true;
	$('textarea').each(function() {
		if (!$(this).val().trim()) {
			returnValue = false;
		}
	})
	return returnValue;
}

$(function()
		{
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
		$.get('/modules/php/action/page/applycation/apply9.act.php?action=10findsp',
		function(result){
			if(result!='0'){
				var res=eval("("+result+")");
				$('#special').form('load',res);
			}
		});

		$('.save').bind('click',function(){ submit_data(); });
		$('.reset').bind('click',function(){
			window.location.reload();
		});
	}
	
	}

	function getQueryStringByName(name){
	    var result = location.search.match(new RegExp("[\?\&]" + name + "=([^\&]+)", "i"));
	    if (result == null || result.length < 1) {
	        return "";
	    }
	    return result[1];
	}