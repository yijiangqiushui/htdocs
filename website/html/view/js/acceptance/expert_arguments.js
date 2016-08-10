
/** *申请项目*** */
function saveArgument() {
	$('#appFm').form('submit',{
						url : '../../../../../modules/php/action/page/acceptance/expert.act.php?action=saveArguments',
						success : function(result) {
							$.messager.alert('提示', '信息保存成功！', 'info',
									function() {
										var complete = completeInput();
										if (complete) {
											window.parent.save_stage('arguments');
										}else{
											window.parent.update_stage('arguments');
										}
										window.parent.setStep('arguments',complete);
									});
						}
					});
}

function completeInput() {
	if (!$('textarea').val()) {
		return false;	
	} 
	if(!$('input').val()){
		return false;
	}
	return true;
}

$(function() {
	loadApplyInfo();

	$('textarea').blur(function() {
		var self = this;
		var txt = $(this).val();
		// 返回被选元素的属性值
		var type = $(this).attr('datatype');
		var filter;
		if (!txt) {
			if (!$(self).attr('readonly')) {
				$(self).after('<div class="error">此项不得为空</div>');
				var timer = setTimeout(function() {
					$(self).next().remove();
				}, 1000);
			} else {
				$(self).after('<div class="error1">此项不需要用户输入</div>');
				var timer = setTimeout(function() {
					$(self).next().remove();
				}, 1000);
			}

		}
	})
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

	$('#register_time').dateRangePicker({
		autoClose : true,
		singleDate : true,
		showShortcuts : false
	});

});
function getQueryStringByName(name) {
	var result = location.search.match(new RegExp(
			"[\?\&]" + name + "=([^\&]+)", "i"));
	if (result == null || result.length < 1) {
		return "";
	}
	return result[1];
}

function loadApplyInfo() {
	$.get(
					'../../../../../modules/php/action/page/acceptance/expert.act.php?action=findProExpert',
					function(result) {
						if (result != '0') {
							var res = eval("(" + result + ")");
							$('#appFm').form('load', res);
							var save_display = $('#save_display').val();
							if (save_display == '1') {
								$('.button_wrapper').show();
							}
						}

					});

	$('.save').bind('click', function() {
		saveArgument();
	});
	$('.reset').bind('click', function() {
		window.location.reload();
	});

}

function resetInfo() {
	alert('重置');
}
