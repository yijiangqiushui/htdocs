function unit_info(){
	$('#unit_info').form('submit',{
		url:'../../../../../../../modules/php/action/page/lmcheck_material/check_material.act.php?action=save_unit_info',
		success:function(result){
			$.messager.alert('提示','信息保存成功！','info',function(){
			var complete = completeInput();   
//			alert(complete);
			if(complete) {
				window.parent.save_stage('unit_info');
			}else{
				window.parent.update_stage('unit_info');
			}
			window.parent.setStep('unit_info',complete);
			});
		}
	});
	
}
$(function() {
	loadApplyInfo();
	dateplu();	
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
	$.get('../../../../../../../modules/php/action/page/lmcheck_material/check_material.act.php?action=find_unit_info',
					function(result) {
						if (result != '0') {
							var res = eval("(" + result + ")");
							$('#unit_info').form('load', res);
						}
						
					});
	
	
		$('.save').bind('click',function(){ unit_info(); });
		$('.reset').bind('click',function(){
			window.location.reload();
		});
	
}
function addLine(){
	var rows = document.getElementById("shareholder_info").rows.length ;
	var newTr = "<tr>";
	newTr +="<td><input type='text' name=\"shareholder_name["+rows+"]\" /></td>";
	 newTr +="<th style='width:80px;'><p align='center'>专利号</p></th>";
	 newTr +="<td><input type='text' name=\"stock_ratio["+rows+"]\" /></td>";
	 newTr  +="<td><input type='button'  value='删除'  class='pointer'  onclick='deleteRow(this)'/></td>";
	 newTr += "</tr>";
	$('#shareholder_info').append(newTr);	
}
function addLine2(){
	var rows = document.getElementById("award").rows.length-1 ;
	var newTr = "<tr>";
	newTr +="<td><input type='text' name=\"award_name["+rows+"]\" /></td>";
	 newTr +="<td><input type='text' name=\"award_dep["+rows+"]\" /></td>";
	 newTr +="<td><input type='text' name=\"award_level["+rows+"]\" /></td>";
	 newTr  +="<td width='40'><input type='button'  value='删除' class='pointer'  onclick='deleteRowWithHead(this)'/></td>";
	 newTr += "</tr>";
	 $('#award').append(newTr);	
}


function deleteRowWithHead(obj) {
	var tbody = $(obj).parents("tbody");//不可调换位置
	var tr = obj.parentNode.parentNode;
	var tbody = tr.parentNode;
	tbody.removeChild(tr);
	var row = 0;
	$(tbody).children("tr").each(function () {
		if (row != 0) {
			$(this).find("input").each(function () {
				var name = $(this).prop("name");
				if (name != "" &&(name.indexOf("[")!=-1)) {
					var newName = name.split("[");
					newName[0] = newName[0] + "[" + (row - 1) + "]";
					$(this).prop("name", newName[0]);
				}
			});
		}
		row++;
	});
}

function deleteRow(obj) {
	var tbody = $(obj).parents("tbody");//不可调换位置
	var tr = obj.parentNode.parentNode;
	var tbody = tr.parentNode;
	tbody.removeChild(tr);
	var row = 1;
	$(tbody).children("tr").each(function () {
		if (row != 0) {
			$(this).find("input").each(function () {
				var name = $(this).prop("name");
				if (name != "" &&(name.indexOf("[")!=-1)) {
					var newName = name.split("[");
					newName[0] = newName[0] + "[" + (row - 1) + "]";
					$(this).prop("name", newName[0]);
				}
			});
		}
		row++;
	});
}


