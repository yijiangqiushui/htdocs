function org_info(){

	$('#pro_fund').form('submit',{
		url:'../../../../../../../extends/Table/api.php?action=save&subtable_id=29',
		success:function(result){
			$.messager.alert('提示','信息保存成功！','info',function(){
			//judge whether this table has been finished
			var complete = completeInput();   
			if(complete) {
				//call save_stage
				window.parent.save_stage('pro_fund');
			}else{
				window.parent.update_stage('pro_fund');
			}
			window.parent.setStep('pro_fund',complete);
			});
		}
	});
}



$(function() {
	loadApplyInfo();
	dateplu();
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
	$('input').each(function() {
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
	$.get('../../../../../../../extends/Table/api.php?action=get&subtable_id=29',
					function(result) {
						if (result != '0') {
							var res = eval("(" + result + ")");
							$('#pro_fund').form('load', res);
							year();
						}
					});
	
	
		
		$('.save').bind('click',function(){ org_info(); });
		$('.reset').bind('click',function(){
			window.location.reload();
		});
		
}


function addLine() {  
	var rows = addtable.rows.length-1;
	var newTr = "<tr>";
	newTr +="<td><input type='text' name=\"names[" + rows+ "]\" /></td>";
	 newTr +="<td><input type='text' name=\"types[" + rows+ "]\" /></td>";
	 newTr +="<td><input type='text' name=\"nums[" + rows+ "]\" datatype='number' /></td>";
	 newTr +="<td><input type='text' name=\"pays[" + rows+ "]\" datatype='float' /></td>";
	 newTr +="<td><input type='text' name=\"sour[" + rows+ "]\" /></td>";
	 newTr +="<td><input id='time_pick" + rows +  "' type='text' name=\"time[" + rows+ "]\" class='dateplu' readonly/></td>";
	 newTr +="<td colspan='2'><input type='text' name=\"function[" + rows+ "]\" /></td>";
	 newTr  +="<td><input type='button' value='删除' class='pointer' onclick='delLine(this)'/></td>";
	$('#addtable').append(newTr);
	dateplu();
}

function delLine(obj) {
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

function year(){ 
	var year = new Date();
	var temp = year.getFullYear(); 
    $("input[name='first_year']").val(temp);
    $("input[name='first']").val(temp);
    $("input[name='out_year[0]']").val(temp);
    $("input[name='second']").val(temp+1);
    $("input[name='second_year']").val(temp+1);
    $("input[name='out_year[1]']").val(temp+1);
    $("input[name='third_year']").val(temp+2);
    $("input[name='third']").val(temp+2);
    $("input[name='out_year[2]']").val(temp+2);
}