function org_info(){
	$('#economy_profit').form('submit',{
		url:'../../../../../../../modules/php/action/page/applycation/attach4_patent.act.php?action=save_economy',
		success:function(result){
			$.messager.alert('提示','信息保存成功！','info',function(){
			var complete = completeInput();
			if(complete) {
				window.parent.save_stage('economy_profit');
			}else{
				window.parent.update_stage('economy_profit');
			}
			window.parent.setStep('economy_profit',complete);
			});
		}
	});
}



$(function() {
	loadApplyInfo();
	addaAquire();
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

function completeInput() {
	var returnValue = true;
	$('textarea').each(function() {
		if(!$(this).val()) {
			returnValue = false;
		}
	});
	return returnValue;
}

function getQueryStringByName(name){
    var result = location.search.match(new RegExp("[\?\&]" + name + "=([^\&]+)", "i"));
    if (result == null || result.length < 1) {
        return "";
    }
    return result[1];
}

function loadApplyInfo() {
	$.get('../../../../../../../modules/php/action/page/applycation/attach4_patent.act.php?action=find_economy',
					function(result) {
						if (result != '0') {
							var res = eval("(" + result + ")");
							$('#economy_profit').form('load', res);
						}
					});
	
	
		$('.save').bind('click',function(){ org_info(); });
/*	$('.reset').bind('click',function(){
		window.location.reload();
	});*/
}

function addaAquire(){
	$('input').blur(function() {
		var self = this;
		var txt = $(this).val();
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
				var messge="填写格式不正确,请重新填写!";
				if(type == 'email') {//邮箱
					 filter  =  /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/;
					
				} else if(type == 'number') {//数字
					filter  = /^\d+$/;
				} else if(type == 'chinese_characters') {//汉字
					filter  = /^[\u4e00-\u9fa5]*$/;
				} else if(type == 'phone') {
					filter =  /^\d{2,4}-?\d{5,8}$/;
				} else if(type == 'telephone') {//手机
					filter = /^1[3|5|7|8|][0-9]{9}$/;
				} else if(type == 'fax') {//传真
//					filter =  /(\d{3,4})?(\-)?\d{7,8}/;
					filter = /^[0-9]{3}-[0-9]{8}$/;
					 messge="填写格式不正确,请按照：010-12345678  格式填写！";
				} else if(type == 'postcode') {//6位的邮政编码
					filter = /^\d{6}$/;
				} else if(type == 'chinese_characters') {//汉字
					filter  = /^[\u4e00-\u9fa5]*$/;
				}else if(type == 'date') {//汉字
					filter  = /^2[0-3][0-9]{2}-[0-1][1-9]-[0-3][1-9]$/;
				}
				if (!filter.test(txt)){	
					alert(messge);
					$(this).focus();
				}
			}
	});
	$(".date").each(function(){
		$(this).dateRangePicker({
			autoClose: true,
			singleDate : true,
			showShortcuts: false,
		});
	  });
	
}