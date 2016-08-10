$(function() {
	loadApplyInfo();
});

function completeInput(){
	var returnValue = true;
	$('input').each(function(){
		if(!$(this).val()){
			returnValue = false;
		}
	});
	$('textarea').each(function(){
		if(!$(this).val()){
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
	$.get('/modules/php/action/page/applycation/apply2.act.php?action=find2ProInfo',
		function(result) {
			if (result != 0)
				var res = eval("(" + result + ")");
			$('#2project_info_fm').form('load', res);
		});
	
	$('.save').bind('click',function(){ submitdata(); });
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

function submitdata() {
	$('#2project_info_fm').form('submit',
		{
			url : '/modules/php/action/page/applycation/apply2.act.php?action=project2Info',
			success : function(result) {
				$.messager.alert('提示','信息保存成功！','info',function(){
				var complete = completeInput();  
				if(complete) {
					window.parent.save_stage('project_info');
				} else{
					window.parent.update_stage('project_info');
				} 
				window.parent.setStep('project_info',complete);
				});
			}
		});
}
function addLine() {
	var rows = addtable.rows.length - 1;
	var newTr = "<tr>";
	newTr+="<td width='110'><input type='text' name=\"intel_property[" + rows
			+ "]\" /></td>"
		newTr+="<td width='267'><input type='text' name=\"type[" + rows + "]\" /></td>"
			newTr+="<td width='267'><input type='text' name=\"auth_code[" + rows + "]\" /></td>"
				newTr+="<td width='40'><input type='button'  value='删除' class='pointer but' onclick='delLine(this)'/></td>"
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
