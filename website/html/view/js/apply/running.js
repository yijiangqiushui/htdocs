function submit_data(){
		$('#running').form('submit' ,{
			url: '/modules/php/action/page/applycation/apply9.act.php?action=9running',
			success: function(result){
				$.messager.alert('提示','信息保存成功！','info',function(){
				var complete = completetextarea();
				if(complete){
					
					window.parent.save_stage('running');
				}else{
					window.parent.update_stage('running');
				} 
				window.parent.setStep('running',complete);
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
		//addRequire();
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
	function loadApplyInfo(){
		$.get('/modules/php/action/page/applycation/apply9.act.php?action=9findrunning',
		function(result){
			if(result!='0'){
				var res=eval("("+result+")");
				$('#running').form('load',res);
			}
		});

		
		$('.save').bind('click',function(){ submit_data(); });
		$('.reset').bind('click',function(){
			window.location.reload();
		});
	}
	
	function addRequire(){
		$('textarea').unbind('blur');
		$('textarea').not(':disabled').blur(function() {
			var self = this;
			var txt = $(this).val().trim();
			//返回被选元素的属性值
			var type = $(this).attr('datatype');
			var filter;
				if(!txt) {
					if(!$(self).attr('readonly')) {
						$(self).after('<div class="error">此项不得为空</div>');
						var timer = setTimeout(function() {
							$(self).next().remove();
							},1000); 
					} else {
						$(self).after('<div class="error1">此项不需要用户输入</div>');
						var timer = setTimeout(function() {
							$(self).next().remove();
							},1000); 
					}
					
				} else if(type) {
					if(type == 'email') {
						 filter  =  /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/;
					} else if(type == 'number') {
						filter  = /^\d+$/;
					} else if(type == 'phone') {
						filter =  /^\d{2,4}-?\d{5,8}$/;
					} else if(type == 'telephone') {
						filter = /^1\d{10}$/;
					} else if(type == 'decimal') {//6位的邮政编码
						filter =/^\d+(\.\d+)?$/;
					} else if(type == 'sex') {
						filter = /['男','女']/;
					}
					if (!filter.test(txt)){
						alert('填写格式不正确,请重新填写');
						$(this).focus();
					}
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