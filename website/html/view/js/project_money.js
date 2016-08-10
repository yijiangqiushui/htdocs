function submit_data(){
		$('#project_money').form('submit' ,{
			url: '/modules/php/action/page/applycation/project_money.act.php?action=project_money',
			success: function(result){
				
				$('#project_money').form('reset');
			}
		});
	}
function reset() {
	$('#project_money').form('reset');
}

$(function() {
	loadApplyInfo();
});

function loadApplyInfo() {
	$.get('/modules/php/action/page/applycation/project_money.act.php?action=findproject_money',
					function(result) {
		
						if (result != '0') {
							var res = eval("(" + result + ")");
							$('#project_money').form('load', res);
						}
					});
}

function addLine() {
	var newTr = addtable.insertRow(-1);
	var rows = addtable.rows.length - 1;
	var cell1 = newTr.insertCell();
	var cell2 = newTr.insertCell();
	var cell3 = newTr.insertCell();
	var cell4 = newTr.insertCell();
	var cell5 = newTr.insertCell();
	
	cell1.innerHTML = "<input type='text' name=\"contract_code[" + rows + "]\" />";
	cell2.innerHTML = "<input type='text' name=\"project_name[" + rows + "]\" />";
	cell3.innerHTML = "<input type='text' name=\"affirm_time[" + rows + "]\" />";
	cell4.innerHTML = "<input type='text' name=\"contract_price[" + rows + "]\" />";
	cell5.innerHTML = "<input type='button'  value='删除'  onclick='delLine(this)'/>";
}
function delLine(obj) {
	var tr = obj.parentNode.parentNode;
	var tbody = tr.parentNode;
	tbody.removeChild(tr);
}
