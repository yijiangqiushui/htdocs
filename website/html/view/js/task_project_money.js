

function wt_validate() {
	var total_teach = [0, 0, 0];
	var total_other = [0, 0, 0];

	$total_funds = [
		$("input[name^='total1_fund[']"),
		$("input[name^='total2_fund[']"),
		$("input[name^='total3_fund[']")
	];

	$teach_funds = [
		$("input[name^='teach1_fund[']"),
		$("input[name^='teach2_fund[']"),
		$("input[name^='teach3_fund[']")
	];

	$other_funds = [
		$("input[name^='other1_fund[']"),
		$("input[name^='other2_fund[']"),
		$("input[name^='other3_fund[']")
	];

	for(var i= 0; i < 3; ++i) {
		$teach_funds[i].each(function(j) {
			total_teach[i] = wt_add(total_teach[i], this.value);
		});

		$other_funds[i].each(function(j) {
			total_other[i] = wt_add(total_other[i], this.value);
		});

		if (total_teach[i] != $total_funds[0][i].value) {
			alert('年度“区财政科技经费”应该等于该年度各科目“区财政科技经费”总和');
			return false;
		}

		if (total_other[i] != wt_add($total_funds[1][i].value, $total_funds[2][i].value)) {
			alert('年度“项目承担单位自筹经费”、“其他”经费的和应该等于该年度各科目“其他来源”经费总和');
			return false;
		}
	}

	return true;
}

function submit_data(){
	if (! wt_validate()) {
		return ;
	}
		$('#project_money').form('submit' ,{
			url: '../../../../../extends/Table/api.php?action=save&subtable_id=18',
			success: function(result){
				
				$.messager.alert('提示','信息保存成功！','info',function(){
					//judge whether this table has been finished
					var complete = completeInput();   
					if(complete) {
						//call save_stage
						window.parent.save_stage('total_fund');
					} else{
						window.parent.update_stage('total_fund');
					}
					window.parent.setStep('total_fund',complete);
					});
			}
		});
	}
function reset() {
	$('#project_money').form('reset');
}

$(function() {
	year();
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
	
});

function loadApplyInfo() {
	$.get('../../../../../extends/Table/api.php?action=get&subtable_id=18',
					function(result) {
						if (result != '0') {
							var res = eval("(" + result + ")");
							$('#project_money').form('load', res);
						}
					});
	
	
	
	$('.save').bind('click',function(){ submit_data(); });
	$('.reset').bind('click',function(){
		window.location.reload();
	});
}

function addLine() {
	// 总的行数 减一 就是 从0开始的吧 我觉得应该是
	var rows = addtable.rows.length - 1;
	var newTr = "<tr>";
	newTr += "<td width='110'><input type='text' name=\"eqpt_name[" + rows + "]\" /></td>";
	/*newTr += "<td><input type='text' name=\"stock_ratio[" + rows
			+ "]\" /></td>";*/
	newTr += "<td width='267'><input type='text' name=\"eqpt_model[" + rows + "]\" /></td>";
	newTr += "<td width='267'><input type='text' name=\"actual_num[" + rows + "]\" datatype='number'/></td>";
	newTr += "<td width='267'><input type='text' name=\"actual_pay[" + rows + "]\" datatype='float'/></td>";
	newTr += "<td width='267'><input type='text' name=\"fund_src[" + rows + "]\" /></td>";
	newTr += "<td width='267'><input type='text' name=\"buy_time[" + rows + "]\" id='date_pick"+rows+"' class='dateplu' readonly/></td>";
	newTr += "<td width='267'><input type='text' name=\"main_use[" + rows + "]\" /></td>";
	newTr += "<td width='267'><input type='button'  value='删除' class='pointer but'  onclick='delLine(this)'/></td>";
	newTr += "</tr>";
	$('#addtable').append(newTr);
	
	dateplu();
	//addRequire();
	$('textarea').unbind('blur');
	$('input').unbind('blur');
	//validation();
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
	$('textare').each(function() {
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

function year(){
	var year = new Date();
	var temp = year.getFullYear();
	$("input[name='year[0]']").val(temp);
	$("input[name='p_m_year[0]']").val(temp);
	$("input[name='year[1]']").val(temp+1);
	$("input[name='p_m_year[1]']").val(temp+1);
	$("input[name='year[2]']").val(temp+2);
	$("input[name='p_m_year[2]']").val(temp+2);
}