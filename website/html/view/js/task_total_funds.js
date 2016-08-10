/**
author:Gao Xue
date:2014-05-23
 */

/** *申请项目*** */

function submitdata() {
	$('#total_funds').form('submit',
					{url : '../../../../../modules/php/action/page/projectapp/projectapp.act.php?action=task_saveTotalFund',
						success : function(result) {
							$('#total_funds').form('reset');
						}
					});
}

$(function() {
	loadApplyInfo();
});

function loadApplyInfo() {
	$.get('../../../../../modules/php/action/page/projectapp/projectapp.act.php?action=findTotalFund',
					function(result) {
						if (result != '0') {
							var res = eval("(" + result + ")");

							// alert(res.org_code);
							$('#total_funds').form('load', res);
						}
					});
			
			var user_type = decodeURI(getQueryStringByName('user_type'));
			var table_status = decodeURI(getQueryStringByName('table_status'));
			if(user_type == 0)
			{
			    if(table_status == 1  ||  table_status == 3)
			    {
			        $('.wrapper').css('display','block');
			    }
			}		
			$('.save').bind('click',function(){ org_info(); });
			$('.reset').bind('click',function(){
				window.location.reload();
			});
}


function getQueryStringByName(name){
    var result = location.search.match(new RegExp("[\?\&]" + name + "=([^\&]+)", "i"));
    if (result == null || result.length < 1) {
        return "";
    }
    return result[1];
}


function addLine() {
	var newTr = addtable.insertRow(-1);
	// 总的行数 减一 就是 从0开始的吧 我觉得应该是
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
	cell1.innerHTML = "<input type='text' name=\"eqpt_name[" + rows + "]\" />";
	cell2.innerHTML = "<input type='text' name=\"eqpt_model[" + rows + "]\" />";
	cell3.innerHTML = "<input type='text' name=\"plan_money[" + rows + "]\" />";
	cell4.innerHTML = "<input type='text' name=\"actual_num[" + rows + "]\" />";
	cell5.innerHTML = "<input type='text' name=\"actual_pay[" + rows + "]\" />";
	cell6.innerHTML = "<input type='text' name=\"fund_src[" + rows + "]\" />";
	cell7.innerHTML = "<input type='text' name=\"buy_time[" + rows + "]\" />";
	cell8.innerHTML = "<input type='text' name=\"main_use[" + rows + "]\" />";
	cell9.innerHTML = "<input type='button'  value='删除'  onclick='delLine(this)'/>";
}
function delLine(obj) {
	var tr = obj.parentNode.parentNode;
	var tbody = tr.parentNode;
	tbody.removeChild(tr);
}
