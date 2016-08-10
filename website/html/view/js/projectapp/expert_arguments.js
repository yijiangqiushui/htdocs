

/***申请项目****/

function saveArgument(){
	$('#appFm').form('submit',{
		url:'../../../../../modules/php/action/page/acceptance/expert.act.php?action=zj_saveArguments',
		success:function(result){
			$.messager.alert('提示','信息保存成功！','info',function(){
				//judge whether this table has been finished
				var complete = completeInput();
				if(complete) {
					//call save_stage
					window.parent.save_stage('expert_arguments');
				}else{
					window.parent.update_stage('expert_arguments');
				}
				window.parent.setStep('expert_arguments',complete);
		  });
		}
	});
}

$(function()
		{
		loadApplyInfo();
		validation();
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
		});

function getQueryStringByName(name){
    var result = location.search.match(new RegExp("[\?\&]" + name + "=([^\&]+)", "i"));
    if (result == null || result.length < 1) {
        return "";
    }
    return result[1];
}

function loadApplyInfo(){
	$.get('../../../../../modules/php/action/page/acceptance/expert.act.php?action=zj_findProExpert',function(result){
		if(result!='0'){
			var res=eval("("+result+")");
			$('#appFm').form('load',res);
		}
	});
	
$('.save').bind('click',function(){ saveArgument(); });
$('.reset').bind('click',function(){
	window.location.reload();
});
	
}

function resetInfo(){
	alert('重置');
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
			returnValue = false;
		}
	})
	return returnValue;
}


/*function addRequire(){
	$('input').unbind('blur');
	$('input').not(':disabled').blur(function() {
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
				} else if(type == 'sex') {
					filter = /['男','女']/;
				}
				if (!filter.test(txt)){
					alert('填写格式不正确,请重新填写');
					$(this).focus();
				}
			}
	});
}*/
