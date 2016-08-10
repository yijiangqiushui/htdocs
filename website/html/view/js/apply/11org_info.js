function submit_data(){
		$('#11org_info_fm').form('submit' ,{
			url: '/modules/php/action/page/applycation/apply11.act.php?action=11orgInfo',
			success: function(result){
				
//				$('#11org_info_fm').form('reset');

//				window.parent.setStep('org_info',complete);
				$.messager.alert('提示','信息保存成功！','info',function(){
				var complete = completeInput();
				if(complete){					
					window.parent.save_stage('org_info');
				}else{
					window.parent.update_stage('org_info');
				} 
				window.parent.setStep('org_info',complete);
				});
			}
	});
}
function reset() {
	$('#11org_info_fm').form('reset');
}

$(function() {
	loadApplyInfo();
	dateplu();
	$('#back').click(function() {
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
	});
/*	$(".affirm_time").each(function(){
		$(this).dateRangePicker({
			autoClose: true,
			singleDate : true,
			showShortcuts: false 
			});
	});*/
 
	
	
});

function loadApplyInfo() {
	$.get('/modules/php/action/page/applycation/apply11.act.php?action=find11orgInfo',
					function(result) {
		
						if (result != '0') {
							var res = eval("(" + result + ")");
							$('#11org_info_fm').form('load', res);
						}
						
					});


	$('.save').bind('click',function(){ submit_data(); });
	$('.reset').bind('click',function(){
		window.location.reload();
	});
}

function addLine() {
	dateplu();
	var rows = addtable.rows.length - 1;
	var newTr ='<tr>';
	newTr+="<td><input type='text' name=\"contract_code[" + rows + "]\" /></td>";
	newTr+="<td><input type='text' name=\"project_name[" + rows + "]\" /></td>";
	newTr+="<td><input type='text'  class='dateplu' name=\"affirm_time[" + rows + "]\" readonly/></td>";
	newTr+="<td><input type='text' datatype='float' name=\"contract_price[" + rows + "]\" /></td>";
	newTr+="<td><input type='button'  value='删除'  class='pointer but'  onclick='delLine(this)'/></td>";
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

function completeInput() {
	var returnValue = true;
	$('input').each(function() {
		if(!$(this).val().trim()) {
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
