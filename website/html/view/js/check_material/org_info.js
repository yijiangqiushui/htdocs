function unit_info(){
	$('#org_info').form('submit',{
		url:'../../../../../../../modules/php/action/page/lmcheck_material/check_material.act.php?action=save_org_info',
		success:function(result){
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
$(function() {
	loadApplyInfo();	
/*	$('#back').click(function() {
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
	$.get('../../../../../../../modules/php/action/page/lmcheck_material/check_material.act.php?action=find_org_info',
					function(result) {
						if (result != '0') {
							var res = eval("(" + result + ")");
							$('#org_info').form('load', res);
						}
						
					});
	
		
		$('.save').bind('click',function(){ unit_info(); });
		$('.reset').bind('click',function(){
			window.location.reload();
		});
	
}

function addLine(){
	/*var newTr = document.getElementById("shareholder_info").insertRow(-1);
	var value = document.getElementById("shareholder_info").rows.length - 1;
	var newTd0 = newTr.insertCell(0);
	var newTd1 = newTr.insertCell(1);
	var newTd2 = newTr.insertCell(2);
	newTd0.innerHTML="<input type='text' name=\"shareholder_name["+value+"]\" />";
	newTd1.innerHTML="<p align='center'>专利号</p>";
	newTd2.innerHTML="<input type='text' name=\"shareholder_name["+value+"]\" />";*/
	var rows = document.getElementById("shareholder_info").rows.length ;
	var newTr = "<tr>";
	newTr +="<td><input type='text' name=\"shareholder_name["+rows+"]\" /></td>";
	 newTr +="<th style='width:40px;'><p align='center'>专利号</p></th>";
	 newTr +="<td><input type='text' name=\"stock_ratio["+rows+"]\" /></td>";
	 newTr  +="<td><input type='button'  value='删除'  onclick='deleteRow(this)'/></td>";
	$('#shareholder_info').append(newTr);	
}
function addLine2(){
	/*var newTr = document.getElementById("shareholder_info").insertRow(-1);
	var value = document.getElementById("shareholder_info").rows.length - 1;
	var newTd0 = newTr.insertCell(0);
	var newTd1 = newTr.insertCell(1);
	var newTd2 = newTr.insertCell(2);
	newTd0.innerHTML="<input type='text' name=\"shareholder_name["+value+"]\" />";
	newTd1.innerHTML="<p align='center'>专利号</p>";
	newTd2.innerHTML="<input type='text' name=\"shareholder_name["+value+"]\" />";*/
	var rows = document.getElementById("award").rows.length ;
	var newTr = "<tr>";
	newTr +="<td><input type='text' name=\"award_name["+rows+"]\" /></td>";
	 newTr +="<td><input type='text' name=\"award_dep["+rows+"]\" /></td>";
	 newTr +="<td><input type='text' name=\"award_level["+rows+"]\" /></td>";
	 newTr  +="<td><input type='button'  value='删除'  onclick='deleteRow(this)'/></td>";
	$('#award').append(newTr);	
}
function deleteRow(obj){
	var tr = obj.parentNode.parentNode;
	var tbody = tr.parentNode;
	tbody.removeChild(tr);
}


