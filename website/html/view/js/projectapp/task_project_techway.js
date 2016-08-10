function pro_tech(){
	$('#project_tech').form('submit',{
		url:'../../../../../modules/php/action/page/projectapp/projectapp.act.php?action=task_project_techway',
		success:function(result){

			$.messager.alert('提示','信息保存成功！','info',function(){
				//judge whether this table has been finished
				saveJsonData();
				var complete = completeInput();   
				if(complete) {
					//call save_stage
					window.parent.save_stage('project_techway');
				} else{
					window.parent.update_stage('project_techway');
				}
				window.parent.setStep('project_techway',complete);
				});
		}
	});
}

$(function()
		{
		loadApplyInfo();
		addRequire();
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
		$.get('../../../../../modules/php/action/page/projectapp/projectapp.act.php?action=findtask_ProTech',function(result){
			if(result!='0'){
				var res=eval("("+result+")");
				$('#project_tech').form('load',res);
			}
		});
		
		$('.save').bind('click',function(){pro_tech(); });
		$('.reset').bind('click',function(){
			window.location.reload();
		});
		

	}
	
function completeInput(){
		
		var flag = false;
		$('textarea').each(function(){
			if(!$(this).is(":hidden")){
				if(!$(this).val()){
					flag = true;
				}	
			}
		});
		
		if(flag) {
			return false;
		}else{
			return true;
		}
	}

function getQueryStringByName(name){
    var result = location.search.match(new RegExp("[\?\&]" + name + "=([^\&]+)", "i"));
    if (result == null || result.length < 1) {
        return "";
    }
    return result[1];
}

function addRequire(){
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
	
	$('textarea').not(':disabled').blur(function() {
		var self = this;
		var txt = $(this).val().trim();
		//返回被选元素的属性值
		var type = $(this).attr('datatype');
			if(!txt) {
				if(!$(self).attr('readonly')) {
					$(self).after('<div class="error">此项不得为空</div>');
					var timer = setTimeout(function() {
						$(self).next().remove();
						},1000); 
				} 
			} 
	});
}
