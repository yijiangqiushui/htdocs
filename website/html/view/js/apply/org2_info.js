
function submit_data(){
   $('#org2_info_fm').form('submit' ,{
		url: '/modules/php/action/page/applycation/apply2.act.php?action=org2Info',
		success: function(result){
			$.messager.alert('提示','信息保存成功！','info',function(){
					var complete = completeInput();    
					if(complete) {
						window.parent.save_stage('org_info');
					}else{
						window.parent.update_stage('org_info');
					} 
					window.parent.setStep('org_info',complete);
				});
			}
		});
}

$(function(){
	loadApplyInfo();
//	staff();
	
}); 
//先放在这里，不要删除
//function staff(){
//	$('#staff_num').change(function(){
//		var staff_num = parseInt($('#staff_num').val());
//		var junior = parseInt($('#junior').val());
//		var researcher_num = parseInt($('#researcher_num').val());
//		if(staff_num < junior || staff_num < researcher_num || staff_num < junior + researcher_num){
//			
//		}
//	});
//	$('#junior').change(function(){
//		var staff_num = $('#staff_num').val();
//		var junior = $('#junior').val();
//		var researcher_num = $('#researcher_num').val();
//		
//		var staff_numI = parseInt(staff_num);
//		var juniorI = parseInt(junior);
//		var researcher_numI = parseInt(researcher_num);
//		if($('#staff_num').val() == ''){
//			alert('请输入职工总数');
//		}else{
//			if(staff_numI < juniorI || staff_numI < researcher_numI || staff_numI < juniorI + researcher_numI){
//				alert("其中大专以上人员人数和");
//				$('#junior').focus();
//			}
//		}
//	});
//	$('#researcher_num').change(function(){
//		var staff_num = parseInt($('#staff_num').val());
//		var junior = parseInt($('#junior').val());
//		var researcher_num = parseInt($('#researcher_num').val());
//		if(staff_num == ''){
//			alert('请输入职工总数');
//		}else{
//			if(staff_num < junior || staff_num < researcher_num || staff_num < junior + researcher_num){
//				
//			}
//		}
//	});
//}

function completeInput(){ 
	returnValue=true;
$('input').not(':disabled').each(function() {  
	if (!$(this).val().trim()) {
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
	
function loadApplyInfo(){
	$.get('/modules/php/action/page/applycation/apply2.act.php?action=find2OrgInfo',
		function(result){
		if(result!=0){
			var res = eval("("+result+")");
				$('#org2_info_fm').form('load',res);
				if(res.listed==0){
				 $('.listed_code').attr('disabled','disabled');
				}
		}
	});
	
	$('.save').bind('click',function(){ 
		submit_data();	
	});
	$('.reset').bind('click',function(){
		window.location.reload();
	});
	
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

}

function ispicth(element){
	if(element.value == '1'){
		$('.listed_code').removeAttr('disabled');
	}else{
	  $('.listed_code').attr('disabled','disabled');
	  $('.listed_code').val(null);
	}
}
