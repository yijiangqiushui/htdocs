function submitdata(){
		$('#org_info').form('submit' ,{
			url: '/modules/php/action/page/applycation/iprproject1_1.act.php?action=org_info',
			success: function(result){
				$('#org_info').form('reset');
			}
		});
	}

function reset(){
$('#org_info').form('reset');}

$(function() {
	loadApplyInfo();
});

function loadApplyInfo() {
	$.get('/modules/php/action/page/applycation/iprproject1_1.act.php?action=findorg_info',
					function(result) {
						if (result != '0') {
							var res = eval("(" + result + ")");
							$('#org_info').form('load', res);
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
	
	cell1.innerHTML = "<input type='text' name=\"main_product[" + rows
			+ "]\" />";
	cell2.innerHTML = "<input type='text'  name=\"sale_ratio[" + rows + "]\" />";
	
	cell3.innerHTML = "<input type='button'  value='删除'  onclick='delLine(this)'/>";
}
function delLine(obj) {
	var tr = obj.parentNode.parentNode;
	var tbody = tr.parentNode;
	tbody.removeChild(tr);
}