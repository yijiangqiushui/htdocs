function org_info(){

	$('#pro_member').form('submit',{
		url:'../../../../../../../extends/Table/api.php?action=save&subtable_id=30',
		success:function(result){
			$.messager.alert('提示','信息保存成功！','info',function(){
			//judge whether this table has been finished
			var complete = completeInput();  
			
			if(complete) {
				//call save_stage
				window.parent.save_stage('pro_member');
			}else{
				window.parent.update_stage('pro_member');
			}
			window.parent.setStep('pro_member',complete);
			});
		}
	});
}

$(function() {
	loadApplyInfo();
	$('#date').dateRangePicker({
		autoClose: true,
		singleDate : true,
		showShortcuts: false,
		getValue: function()
		{
			return this.innerHTML;
		},
		setValue: function(s)
		{
			this.innerHTML = s;
		}
	});
	
	$('#birth').dateRangePicker({
		autoClose: true,
		singleDate : true,
		showShortcuts: false,
		getValue: function()
		{
			return this.innerHTML;
		},
		setValue: function(s)
		{
			this.innerHTML = s;
		}
	});
	$('#employ').dateRangePicker({
		autoClose: true,
		singleDate : true,
		showShortcuts: false,
		getValue: function()
		{
			return this.innerHTML;
		},
		setValue: function(s)
		{
			this.innerHTML = s;
		}
	});
});

function completeInput() {
	var returnValue = true;
	$("input[type='text']").each(function() {
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
	$.get('../attach3_patent/attach3_patent.act.php?action=findproject_member',
			function(result) {
				if (result != '0') {
					var res = eval("(" + result + ")");
					$('#org_name').val(res.org_name);
				}
			});
	$.get('../../../../../../../extends/Table/api.php?action=get&subtable_id=30',
					function(result) {
						if (result != '0') {
							var res = eval("(" + result + ")");
							$('#pro_member').form('load', res);
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
	newTr +="<td><input type='text' name=\"name[" + rows+ "]\" /></td>";
	 newTr +="<td><select name=\"gender[" + rows+ "]\" style='height:100%;width:100%'><option value='男'>男</option><option value='女'>女</option></select></td>";
	 newTr +="<td><input type='text' name=\"ages[" + rows+ "]\"  datatype='number'  /></td>";
	 newTr += '<td><select name="edu[' + rows+ ']\" style="height:100%;width:100%">' +
		 '<option value="小学">小学'+
	'<option value="初中">初中</option>' +
		 '<option value="高中">高中' +
		 '</option><option value="中专">中专</option>'+
		 '</option><option value="大专">大专</option><option value="本科">本科</option><option value="研究生">研究生</option><option value="其他">其他</option></select></td>';
	 newTr +="<td><input type='text' name=\"pos[" + rows+ "]\" /></td>";
	 newTr +="<td><input type='text' name=\"sub[" + rows+ "]\" /></td>";
	 newTr +="<td><input type='text' name=\"work[" + rows+ "]\" /></td>";
	 newTr +="<td><input type='text' name=\"mission[" + rows+ "]\" /></td>";
	
	 newTr  +="<td><input type='button' value='删除' class='pointer'  onclick='delLine(this)'/></td>";
	$('#addtable').append(newTr);

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

