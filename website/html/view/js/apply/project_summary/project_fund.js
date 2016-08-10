function org_info(){
	$('#project_fund').form('submit',{
		url:'../../../../../../../extends/Table/api.php?action=save&subtable_id=31',
		
		success:function(result){
			$.messager.alert('提示','信息保存成功！','info',function(){
			//judge whether this table has been finished
			var complete = completeInput(); 
			if(complete) {
				//call save_stage
				window.parent.save_stage('project_fund');
			}else{
				window.parent.update_stage('project_fund');
			}
			window.parent.setStep('project_fund',complete);
			});
		}
	});
}



$(function() {
	loadApplyInfo();
	dateplu();
	$('input').change(function(){
		sum();
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
	
});

function completeInput() {
	var returnValue = true;
	$('input').each(function() {
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
	$.get('../../../../../../../extends/Table/api.php?action=get&subtable_id=31',
					function(result) {
						if (result != '0') {
							var res = eval("(" + result + ")");
							$('#project_fund').form('load', res);
							if(res.start_time==null){
								$.get('../attach3_patent/attach3_patent.act.php?action=findtime',
										function(result) { 
									var res = eval("(" + result + ")");
									$("#start_time").val(res.start_time);
									$("#end_time").val(res.end_time);
								});
							}
						}
						
					});
		$('.save').bind('click',function(){ org_info(); });
		$('.reset').bind('click',function(){
			window.location.reload();
		});
}

function sum(){
	var str1 = 0;
	var str2= 0;
	var str3= 0;
	var str4= 0;
	var str5= 0;
	$("input[name^='bgt_fund[']").each(function(){
		 str1 += Number($(this).val());
	});
	$("input[name='bgt_fund_total']").val(str1);
	
	$("input[name^='actual_fund1[']").each(function(){
		str2 += Number($(this).val());
	});
	$("input[name='actualsrc_fund_total']").val(str2);
	
	$("input[name^='budget_fund[']").each(function(){
		str3 += Number($(this).val());
	});
	$("input[name='total[0]']").val(str3);
	
	$("input[name^='actual_fund[']").each(function(){
		str4 += Number($(this).val());
	});
	$("input[name='total[1]']").val(str4);
	
	$("input[name^='patent_out[']").each(function(){
		str5 += Number($(this).val());
	});
	$("input[name='total[2]']").val(str5);
	
}



