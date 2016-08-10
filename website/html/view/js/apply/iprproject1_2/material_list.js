function submitdata(){
		$('#material_list').form('submit' ,{
			url: '/modules/php/action/page/applycation/iprproject1_2.act.php?action=material_list',
			success: function(result){
				$('#material_list').form('reset');
			}
		});
	}

function reset(){
$('#material_list').form('reset');}

$(function() {
	loadApplyInfo();
});

function loadApplyInfo() {
	$.get('/modules/php/action/page/applycation/iprproject1_2.act.php?action=findorg_info',
					function(result) {
						if (result != '0') {
							var res = eval("(" + result + ")");
							$('#material_list').form('load', res);
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
	var count=rows+1;
	cell1.innerHTML = "<input type='text' value='"+count+"' />";
	cell2.innerHTML = "<input type='text'  name=\"name[" + rows + "]\" />";
	
	cell3.innerHTML = "<input type='button'  value='删除'  onclick='delLine(this)'/>";
}
function delLine(obj) {
	var tr = obj.parentNode.parentNode;
	var tbody = tr.parentNode;
	tbody.removeChild(tr);
}