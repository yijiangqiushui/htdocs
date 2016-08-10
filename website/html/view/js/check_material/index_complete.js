function unit_info(){
	$('#index_complete').form('submit',{
		url:'../../../../../../../modules/php/action/page/lmcheck_material/check_material.act.php?action=save_index_complete',
		success:function(result){
			$.messager.alert('提示','信息保存成功！','info',function(){
			var complete = completeInput();   
			if(complete) {
				window.parent.save_stage('index_complete');
			}else{
				window.parent.update_stage('index_complete');

			}
			window.parent.setStep('index_complete',complete);
			});
		}
	});
	
}
$(function() {
	loadApplyInfo();
	year();

//	$('input').blur(function() {
//		var self = this;
//		var txt = $(this).val();
//		//返回被选元素的属性值
//		var type = $(this).attr('datatype');
//		var filter;
//			if(!txt) {
//				if(!$(self).attr('readonly')) {
//					$(self).after('<div class="error">此项不得为空</div>');
//					var timer = setTimeout(function() {
//						$(self).next().remove();
//						},1000); 
//				} else {
//					$(self).after('<div class="error1">此项不需要用户输入</div>');
//					var timer = setTimeout(function() {
//						$(self).next().remove();
//						},1000); 
//				}
//				
//			} else if(type) {
//				if(type == 'email') {//邮箱
//					 filter  =  /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/;
//				} else if(type == 'number') {//数字
//					filter  = /^\d+$/;
//				} else if(type == 'bignumber') {//汉字
//					filter  = /^[0-9]+([.]{1}[0-9]+){0,1}$/;
//				}  
//				if (!filter.test(txt)){	
//					alert('填写格式不正确,请重新填写!');
//					$(this).focus();
//				}
//			}
//	});
/*	
	$('#back').click(function() {
		root = $(window.parent.parent.document).get(0).location.pathname;
		reg = /website/;
		result = root.search(reg);
		//前台
		if(result != -1){
			$(window.parent.parent.document).find('iframe').attr('src',"../template/user_project.php");
		}
		//后台
		else{
			$(window.parent.parent.document).find('iframe').attr('src',"/center/php/action/page/approve.php");
		}
	});*/
	
	$('#identify_date').dateRangePicker({
		autoClose: true,
		singleDate : true,
		showShortcuts: false
	});
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
	$.get('../../../../../../../modules/php/action/page/lmcheck_material/check_material.act.php?action=find_index_complete',
					function(result) {
						if (result != '0') {
							var res = eval("(" + result + ")");
							$('#index_complete').form('load', res);
							if(res.expectation_target_year==''||res.expectation_target_year==null){
								year(1);
							}
							if(res.previous_year_year==''||res.previous_year_year==null){
								year(2);
							}
							if(res.after_year_year==''||res.after_year_year==null){
								year(3);
							}
							 
						}
						
					});
	
		
		$('.save').bind('click',function(){ unit_info(); });
		$('.reset').bind('click',function(){
			window.location.reload();
		});
	
}

function addLine(){
	var rows = document.getElementById("equipment_list").rows.length-1 ;
	var count=rows+1;
   var newTr = "<tr>";
    newTr +="<th ><p align='center'>"+count+"</p></th>";
	 newTr +="<td><input type='text' name=\"equipment_name["+rows+"]\" /></td>";
	 newTr +="<td><input type='text' name=\"equipment_num["+rows+"]\" /></td>";
	 newTr +="<td><input type='text' name=\"equipment_price["+rows+"]\" /></td>";
	 newTr +="<td><input type='text' name=\"equipment_fund["+rows+"]\" /></td>";
	 newTr  +="<td  ><input type='button'  value='删除'  onclick='deleteTwoRow(this)'/></td>";
	 newTr  +="</tr>";
	$('#equipment_list').append(newTr);	
}
function addLine2(){
	var rows = document.getElementById("instrument_list").rows.length-1 ;
	$count=rows+1;
	var newTr = "<tr>";
	 newTr +="<th ><p align='center'>"+$count+"</p></th>";
	newTr +="<td><input type='text' name=\"test_name["+rows+"]\" /></td>";
	newTr +="<td><input type='text' name=\"test_num["+rows+"]\" /></td>";
	newTr +="<td><input type='text' name=\"test_price["+rows+"]\" /></td>";
	newTr +="<td><input type='text' name=\"test_fund["+rows+"]\" /></td>";
	 newTr  +="<td><input type='button'  value='删除'  onclick='deleteRow(this)'/></td>";
	$('#instrument_list').append(newTr);	
}
function deleteRow(obj){
	var tr = obj.parentNode.parentNode;
	var tbody = tr.parentNode;
	tbody.removeChild(tr);
}
function deleteTwoRow(obj){
	var tr = obj.parentNode.parentNode;
	var tbody = tr.parentNode;
	tbody.removeChild(tr.prev("tr"));
	tbody.removeChild(tr);
}

function year(num) {
	var year = new Date().getFullYear();
	var pre_year = year - 1;
     if(num==1){
    	 $("input[name='expectation_target_year']").val(year);
     }
     if(num==2){
    	 $("input[name='previous_year_year']").val(pre_year);
     }
     if(num==3){
    	 $("input[name='after_year_year']").val(year);
     }
	/*$("input[name='expectation_target_year']").val(year);
	$("input[name='previous_year_year']").val(pre_year);
	$("input[name='after_year_year']").val(year);*/
}



