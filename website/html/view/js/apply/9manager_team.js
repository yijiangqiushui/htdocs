function submit_data(){
		$('#9manager_team_fm').form('submit' ,{
			url: '/modules/php/action/page/applycation/apply9.act.php?action=9managerTeam',
			success: function(result){
				$.messager.alert('提示','信息保存成功！','info',function(){
				var complete = completeInput();
				if(complete){
					
					window.parent.save_stage('manager_team');
				}else{
					window.parent.update_stage('manager_team');
				} 
				window.parent.setStep('manager_team',complete);
				});
			   }
		});
}


/**
 * 这个方法是判断是不是所有的 信息都填写完了 然后进一步设置是不是显示小对勾
 * @returns {Boolean}
 */
function completeInput() {
	var returnValue = true;
	$('input').each(function() {
		if(!$(this).val().trim()) {
			returnValue = false;
		}
	})
	return returnValue;
}

function tofixed(object){
	var temp = object.value;
	$(object).val(Number(temp).toFixed(2));
}


function tofixed2(object){
	var temp = object.value;
	$(object).val(Number(temp).toFixed(0));
}
$(function(){
	
	$(".calper").bind('input propertychange', do_change);
	$manager_total_num = $("input[name='manager_total_num']");
	$manager_total_num.bind('input propertychange', do_change);

	function do_change() {
		$(".calper").each(function(i) {
			if (parseInt($manager_total_num.val()) < parseInt($(this).val())) {
				alert('填写有误，管理人员结构人数不能大于管理人员总数');
				$(this).focus();
				return false;
			}
			
			var num1 = parseInt($('#calper1').val());
			var num2 = parseInt($('#calper2').val());
			var num3 = parseInt($('#calper3').val());
			var num4 = parseInt($('#calper4').val());
			if (parseInt($manager_total_num.val()) < (num1+num2+num3+num4)) {
				alert('填写有误，管理人员结构总的人数不能大于管理人员总数');
				$($manager_total_num).focus();
				return false;
			}
			
			
			
			var total = parseInt($manager_total_num.val());
			if (total > 0) {
				var percent = parseInt(this.value) * 100 / total;
				if(isNaN(percent)){percent=0}
				$('.calratio')[i].value = percent;
			}
		});
	}
	
		loadApplyInfo();

		});
	function loadApplyInfo(){
		$.get('/modules/php/action/page/applycation/apply9.act.php?action=9findManagerTeam',
		function(result){
			if(result!='0'){
				var res=eval("("+result+")");			
				$('#9manager_team_fm').form('load',res);
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