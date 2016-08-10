//document.write('<script type="text/javascript" src="/common/html/js/validation.js"></script>');


function org_info(){
	$('#main_staff').form('submit',{
		url:'../../../../../../../extends/Table/api.php?action=save&subtable_id=27',
		success:function(result){
			$.messager.alert('提示','信息保存成功！','info',function(){
			//judge whether this table has been finished
			var complete = completeInput();   
			if(complete) {
				//call save_stage
				window.parent.save_stage('main_staff');
			}else{
				window.parent.update_stage('main_staff');
			}
			window.parent.setStep('main_staff',complete);
			});
		}
	});
}



$(function() {
	loadApplyInfo();
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
	$.get('../../../../../../../extends/Table/api.php?action=get&subtable_id=27',
					function(result) {
						if (result != '0') {
							var res = eval("(" + result + ")");
							$('#main_staff').form('load', res);
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
	newTr +="<td><input type='text' name=\"eqpt_name[" + rows+ "]\" /></td>";
	 newTr +="<td><select name=\"sex[" + rows+ "]\" style='height:100%;width:100%'><option value='男'>男</option><option value='女'>女</option></select></td>";
	 newTr +="<td><input type='text' name=\"age[" + rows+ "]\" datatype='number' placeholder='请输入整数' /></td>";
	 newTr +="<td><input type='text' name=\"rule[" + rows+ "]\" /></td>";
	 newTr +="<td><input type='text' name=\"major[" + rows+ "]\" /></td>";
	 newTr +="<td><input type='text' name=\"depart[" + rows+ "]\" /></td>";
	 newTr +="<td><input type='text' name=\"task[" + rows+ "]\" /></td>";
	
	 newTr  +="<td><input type='button' value='删除' class='pointer but' onclick='delRow(this)'/></td>";
	$('#addtable').append(newTr);
}

function delLine(obj) {
	var tr = obj.parentNode.parentNode;
	var tbody = tr.parentNode;
	tbody.removeChild(tr);
}

function delRow(obj) {
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
			$(this).find("select").each(function () {
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

