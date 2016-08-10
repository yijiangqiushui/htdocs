function submitdata(){
		$('#unit_fm').form('submit' ,{
			url: '/modules/php/action/page/applycation/unit.act.php?action=unit_provement',
			success: function(result){
				$('#unit_fm').form('reset');
			}
		});
	}
function reset(){
$('#unit_fm').form('reset');}

$(function() {
	loadApplyInfo();
});

function loadApplyInfo() {
	$.get('/modules/php/action/page/applycation/unit.act.php?action=unit_provement',
					function(result) {
						if (result != '0') {
							var res = eval("(" + result + ")");
							$('#unit_fm').form('load', res);
						}
					});
}

function addLine_test() {
	var newTr = test_list.insertRow(-1);
	var rows = test_list.rows.length - 1;
	var cell1 = newTr.insertCell();
	var cell2 = newTr.insertCell();
	var cell3 = newTr.insertCell();
	var cell4 = newTr.insertCell();
	var cell5 = newTr.insertCell();
	cell1.innerHTML = "<input type='text' name=\"test_name[" + rows+ "]\" />";
	cell2.innerHTML = "<input type='text' name=\"test_num[" + rows+ "]\" />";
	cell3.innerHTML = "<input type='text' name=\"test_price[" + rows+ "]\" />";
	cell4.innerHTML = "<input type='text' name=\"test_fund[" + rows+ "]\" />";
	cell5.innerHTML = "<input type='button'  value='删除'  onclick='delLine(this)'/>";
}
function addLine_equ() {

	var newTr = equipment_list.insertRow(-1);
	var rows = equipment_list.rows.length - 1;
	var cell1 = newTr.insertCell();
	var cell2 = newTr.insertCell();
	var cell3 = newTr.insertCell();
	var cell4 = newTr.insertCell();
	var cell5 = newTr.insertCell();
//	alert(rows);
	cell1.innerHTML = "<input type='text' name=\"equipment_name[" + rows+ "]\" />";
	cell2.innerHTML = "<input type='text' name=\"equipment_num[" + rows+ "]\" />";
	cell3.innerHTML = "<input type='text' name=\"equipment_price[" + rows+ "]\" />";
	cell4.innerHTML = "<input type='text' name=\"equipment_fund[" + rows+ "]\" />";
	cell5.innerHTML = "<input type='button'  value='删除'  onclick='delLine(this)'/>";
}
function delLine(obj) {
	var tr = obj.parentNode.parentNode;
	var tbody = tr.parentNode;
	tbody.removeChild(tr);
}
