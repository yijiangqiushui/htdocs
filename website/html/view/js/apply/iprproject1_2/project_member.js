function submitdata(){
		$('#project_member').form('submit' ,{
			url: '/modules/php/action/page/applycation/iprproject1_2.act.php?action=project_member',
			success: function(result){
				$('#project_member').form('reset');
			}
		});
	}

function reset(){
$('#project_member').form('reset');}

$(function() {
	loadApplyInfo();
});

function loadApplyInfo() {
	$.get('/modules/php/action/page/applycation/iprproject1_2.act.php?action=findproject_member',
					function(result) {
						if (result != '0') {
							var res = eval("(" + result + ")");
							$('#project_member').form('load', res);
						}
					});
}


function addLine() {
	var newTr = addtable.insertRow(-1);
	//总的行数 减一  就是 从0开始的吧  我觉得应该是
	var rows = addtable.rows.length - 2;
	var cell1 = newTr.insertCell();
	var cell2 = newTr.insertCell();
	var cell3 = newTr.insertCell();
	var cell4 = newTr.insertCell();
	var cell5 = newTr.insertCell();
	var cell6 = newTr.insertCell();
	var cell7 = newTr.insertCell();
	var cell8 = newTr.insertCell();
	cell1.innerHTML = "<input type='text'  name=\"name[" + rows + "]\" />";
	cell2.innerHTML = "<input type='text'  name=\"sex[" + rows + "]\" />";
	cell3.innerHTML = "<input type='text'  name=\"job[" + rows + "]\" />";
	cell4.innerHTML = "<input type='text'  name=\"age[" + rows + "]\" />";
	cell5.innerHTML = "<input type='text'  name=\"major[" + rows + "]\" />";
	cell6.innerHTML = "<input type='text'  name=\"org[" + rows + "]\" />";
	cell7.innerHTML = "<input type='text'  name=\"mission[" + rows + "]\" />";
	cell8.innerHTML = "<input type='button'  value='删除'  onclick='delLine(this)'/>";
	
	
}
function delLine(obj) {
	var tr = obj.parentNode.parentNode;
	var tbody = tr.parentNode;
	tbody.removeChild(tr);
}