function org_info(){
	$('#item_fund').form('submit',{
		url:'../../../../../../../extends/Table/api.php?action=save&subtable_id=42',
		
		success:function(result){
			$.messager.alert('提示','信息保存成功！','info',function(){
			//judge whether this table has been finished
			var complete = completeInput(); 
			if(complete) {
				//call save_stage
				window.parent.save_stage('item_fund');
			}else{
				window.parent.update_stage('item_fund');
			}
			window.parent.setStep('item_fund',complete);
			});
		}
	});
}



$(function() {
	loadApplyInfo();
	$('textarea').blur(function() {
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
				 if(type == 'chinese_characters') {//汉字
					filter  = /^[\u4e00-\u9fa5]*$/;
				}
				if (!filter.test(txt)){	
					alert('填写格式不正确,请重新填写!');
					$(this).focus();
				}
			}
	});
	
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
	
	$('textarea').mousedown(function(){
		fix_mouse(event,this);
	});
	

});

function completeInput() {
	var returnValue = true;
	$('textarea').each(function() {
		if(!$(this).val()) {
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

function loadApplyInfo() {
	$.get('../../../../../../../extends/Table/api.php?action=get&subtable_id=42',
					function(result) {
						if (result != '0') {
							var res = eval("(" + result + ")");
							$('#item_fund').form('load', res);
						}
						
					});
	
	
	$('.save').bind('click',function(){ org_info(); });
	$('.reset').bind('click',function(){
		window.location.reload();
	});
}
function fix_mouse(e,a)
{
	if($(a).val()==""){
	    if ( e && e.preventDefault )
	    e.preventDefault();
	    else 
	    window.event.returnValue=false;
	    a.focus();
	}

}

