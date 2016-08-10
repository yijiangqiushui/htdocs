function submitdata(){
		$('#service_team').form('submit' ,{
			url: '/modules/php/action/page/applycation/apply10.act.php?action=10service_team',
			success: function(result){
//				$.messager.alert('提示','信息保存成功！');
//				var complete = completeInput();                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      lete = completeInput();
//				window.parent.setStep('service_team',complete);
				$.messager.alert('提示','信息保存成功！','info',function(){
				var complete = completeInput();
				if(complete){
					
					window.parent.save_stage('service_team');
				}else{
					window.parent.update_stage('service_team');
				} 
				window.parent.setStep('service_team',complete);
				});
			}
		});
	}
function reset(){
$('#service_team').form('reset');}
$(function()
{
	$(".calper").keyup(do_change);
	$("input[name='manage_num']").keyup(do_change);
		loadApplyInfo();
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


function do_change() {
	$(".calper").each(function(i) {
		var total = parseInt($("input[name='manage_num']").val());
		if (total > 0) {
			var percent = parseInt(this.value) * 100 / total;
			if(isNaN(percent)){percent=0}
			$('.calratio')[i].value = percent;
			
//			alert(tofixed($('.calratio')[i]));
		}
	});
}

function loadApplyInfo(){
		$.get('/modules/php/action/page/applycation/apply10.act.php?action=find10service_team',function(result){
			if(result!='0'){
				var res=eval("("+result+")");
				$('#service_team').form('load',res);
			}
		});

		
		$('.save').bind('click',function(){ submitdata(); });
		$('.reset').bind('click',function(){
			window.location.reload();
		});
	}

function completeInput() {
	var returnValue = true;
	$('input').each(function() {
		if(!$(this).val().trim()) {
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