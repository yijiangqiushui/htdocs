function submitdata(){
		$('#project_fund').form('submit' ,{
			url: '/modules/php/action/page/applycation/iprproject1_1.act.php?action=project_fund',
			success: function(result){
				$('#project_fund').form('reset');
			}
		});
	}
function reset(){
$('#project_fund').form('reset');}

$(function() {
	loadApplyInfo();
});

function loadApplyInfo() {
	$.get('/modules/php/action/page/applycation/iprproject1_1.act.php?action=findproject_fund',
					function(result) {
						if (result != '0') {
							var res = eval("(" + result + ")");
							$('#project_fund').form('load', res);
						}
					});
}



function addLine() {
	var newTr = addtable.insertRow(-1);
	//总的行数 减一  就是 从0开始的吧  我觉得应该是
	var rows = addtable.rows.length - 1;
	var cell1 = newTr.insertCell();
	var cell2 = newTr.insertCell();
	var cell3 = newTr.insertCell();
	var cell4 = newTr.insertCell();
	var cell5 = newTr.insertCell();
	var cell6 = newTr.insertCell();
	var cell7 = newTr.insertCell();
	var cell8 = newTr.insertCell();
	var cell9 = newTr.insertCell();
	cell1.innerHTML = "<input type='text' name=\"patent_name[" + rows
			+ "]\" />";
	cell3.innerHTML = "<input type='text' name=\"patent_code[" + rows + "]\" />";
	
	cell9.innerHTML = "<input type='button'  value='删除'  onclick='delLine(this)'/>";
}
function delLine(obj) {
	var tr = obj.parentNode.parentNode;
	var tbody = tr.parentNode;
	tbody.removeChild(tr);
}