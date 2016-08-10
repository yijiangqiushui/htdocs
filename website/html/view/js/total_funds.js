/**
 author:Gao Xue
 date:2014-05-23
 */

function wt_validate() {
    var total_reduce = [0, 0];

    $reduce_fund = $("input[name^='reduce_fund[']");
    $teach_reduce_fund = $("input[name^='teach_reduce_fund[']");
    $other_reduce_fund = $("input[name^='other_reduce_fund[']");

    $teach_reduce_fund.each(function(i) {
        total_reduce[0] = wt_add(total_reduce[0], $teach_reduce_fund[i].value);
        total_reduce[1] = wt_add(total_reduce[1], $other_reduce_fund[i].value);
    });

    if (total_reduce[0] != $reduce_fund[0].value) {
        $.messager.alert('提示', '年度“区财政科技经费”核减经费应该等于该年度各科目“区财政科技经费”核减经费总和');
        return false;
    }

    if (total_reduce[1] != wt_add($reduce_fund[1].value, $reduce_fund[2].value)) {
        $.messager.alert('提示', '年度“项目承担单位自筹经费”、“其他”核减经费的和应该等于该年度各科目“其他来源”核减经费总和');
        return false;
    }

    return true;
}

$(function () {
    // 第一部分计算的input
    $bgt_fund = $("input[name^='bgt_fund']");
    $reduce_fund = $("input[name^='reduce_fund']");
    $actual_fund = $("input[name^='actual_fund']");

    $reduce_fund.val('0');
    $actual_fund.val('0');

    // 第二部分计算的input
    $teach_budget_fund = $("input[name^='teach_budget_fund[']");
    $teach_reduce_fund = $("input[name^='teach_reduce_fund[']");
    $teach_adjust_fund = $("input[name^='teach_adjust_fund[']");
    $teach_actual_fund = $("input[name^='teach_actual_fund[']");

    $other_budget_fund = $("input[name^='other_budget_fund[']");
    $other_reduce_fund = $("input[name^='other_reduce_fund[']");
    $other_adjust_fund = $("input[name^='other_adjust_fund[']");
    $other_actual_fund = $("input[name^='other_actual_fund[']");

    $teach_reduce_fund.val('0');
    $other_reduce_fund.val('0');

    $teach_actual_fund.val('0');
    $other_actual_fund.val('0');


    $bind_dom = $("input[name^='teach_budget_fund'], input[name^='teach_reduce_fund'], input[name^='teach_adjust_fund'], input[name^='other_budget_fund'], input[name^='other_reduce_fund'], input[name^='other_adjust_fund'], input[name^='teach_actual_fund'], input[name^='other_actual_fund']");

    $all_fund_tech_total = $("input[name^='all_fund_tech_total']");
    $teach_reduce_fund_total = $("input[name^='teach_reduce_fund_total']");
    $adjust_fund_total = $("input[name^='adjust_fund_total']");
    $teach_actual_fund_total = $("input[name^='teach_actual_fund_total']");

    $fund_tech_total = $("input[name^='fund_tech_total']");
    $fund_other_total = $("input[name^='fund_other_total']");
    $bgt_fund.change(function () {
        wt_total(this);
    });

    $reduce_fund.change(function () {
        wt_total(this);
    });

    $actual_fund.change(function () {
        wt_total(this);
    });
    $bind_dom.change(bind_dom);
});
function bind_dom() {
    var that = this;
    // 总计1
    var all_fund_tech_total = 0;
    $teach_budget_fund.each(function (i) {
        all_fund_tech_total = wt_add(all_fund_tech_total, $(this).val(), $($other_budget_fund[i]).val());
    });
    $all_fund_tech_total.val(all_fund_tech_total);

    // 总计2
    var teach_reduce_fund_total = 0;
    $teach_reduce_fund.each(function (i) {
        teach_reduce_fund_total = wt_add(teach_reduce_fund_total, $(this).val(), $other_reduce_fund[i].value);
    });
    $teach_reduce_fund_total.val(teach_reduce_fund_total);

    // 总计3
    var adjust_fund_total = wt_add($all_fund_tech_total.val(), -$teach_reduce_fund_total.val());
    $adjust_fund_total.val(adjust_fund_total);
    //var adjust_fund_total = 0;
    //$teach_adjust_fund.each(function () {
    //    adjust_fund_total += $(this).val() * 10000 / 10000;
    //});
    //$other_adjust_fund.each(function () {
    //    adjust_fund_total += $(this).val() * 10000 / 10000;
    //});
    //$adjust_fund_total.val(adjust_fund_total);

    // 财政经费实际支出
    //$teach_actual_fund.each(function (i) {
    //    var total = ($teach_budget_fund[i].value * 10000 - $teach_reduce_fund[i].value * 10000 + $teach_adjust_fund[i].value * 10000) / 10000;
    //    if (total < 0) {
    //        $.messager.alert('提示消息', '填写有误', 'info');
    //        $(that).val('');
    //        return false;
    //    }
    //    $(this).val(total);
    //});

    // 其他经费实际支出
    //$other_actual_fund.each(function (i) {
    //    var total = ($other_budget_fund[i].value * 10000 - $other_reduce_fund[i].value * 10000 + $other_adjust_fund[i].value * 10000) / 10000;
    //    if (total < 0) {
    //        $.messager.alert('提示消息', '填写有误', 'info');
    //        $(that).val('');
    //        return false;
    //    }
    //    $(this).val(total);
    //});

    // 实际支出合计
    //var teach_actual_fund_total = all_fund_tech_total - teach_reduce_fund_total + ;adjust_fund_total;
    //$teach_actual_fund_total.val(teach_actual_fund_total)

    // 调整经费的计算和实际支出合计
    $teach_budget_fund.each(function(i) {
        var teach_adjust_fund = wt_add($teach_budget_fund[i].value, -$teach_reduce_fund[i].value);
        var other_adjust_fund = wt_add($other_budget_fund[i].value, -$other_reduce_fund[i].value);

        if (teach_adjust_fund < 0 || other_adjust_fund < 0) {
            alert('核算经费应该小于任务书预算经费');
            $(that).focus();
            return false;
        }

        $teach_adjust_fund[i].value = teach_adjust_fund;
        $other_adjust_fund[i].value = other_adjust_fund;
    });

    // 实际支出的合计
    var fund_tech_total = 0;
    var fund_other_total = 0;
    var teach_actual_fund_total = 0;
    $teach_actual_fund.each(function(i) {
        fund_tech_total = wt_add(fund_tech_total, $teach_actual_fund[i].value);
        fund_other_total = wt_add(fund_other_total, $other_actual_fund[i].value);

        var total = wt_add($teach_actual_fund[i].value, $other_actual_fund[i].value);
        teach_actual_fund_total = wt_add(teach_actual_fund_total, total);
    });
    $teach_actual_fund_total.val(teach_actual_fund_total);

    // 区财政科技经费总合计
    //$teach_budget_fund.each(function (i) {
    //    fund_tech_total += $(this).val() * 10000 / 10000;
    //});
    $fund_tech_total.val(fund_tech_total);

    // 其他来源总合计
    //$other_budget_fund.each(function (i) {
    //    fund_other_total += this.value * 10000 / 10000;
    //});
    $fund_other_total.val(fund_other_total);
}
function wt_total(that) {
    for (var i = 0; i < 3; ++i) {
        var temp = $bgt_fund[i].value - $reduce_fund[i].value;
        if (temp < 0) {
            alert('核算经费应该小于任务书预算经费');
            $(that).focus();
            return ;
        }
    }
    var bgt_fund_total = wt_add($bgt_fund[0].value, $bgt_fund[1].value, $bgt_fund[2].value);
    var reduce_fund_total = wt_add($reduce_fund[0].value, $reduce_fund[1].value, $reduce_fund[2].value);
    var actual_fund_total = wt_add($actual_fund[0].value, $actual_fund[1].value, $actual_fund[2].value);
    $("input[name='bgt_fund_total']").val(bgt_fund_total);
    $("input[name='reduce_fund_total']").val(reduce_fund_total);
    $("input[name='actual_fund_total']").val(actual_fund_total);
}
$(function () {
	dateplu();
    loadApplyInfo();
 /*   $('#back').click(function () {

        root = $(window.parent.parent.document).get(0).location.pathname;
        reg = /website/;
        result = root.search(reg);
        //前台
        if (result != -1) {
            $(window.parent.parent.document).find('iframe').attr('src', "../template/user_project.php");
        }
        //后台
        else {
            $(window.parent.parent.document).find('iframe').attr('src', "/center/php/action/page/approve.php");
        }
    });*/
});
function completeInput() {
    var returnValue = true;
    $('input').each(function () {
        if (!$(this).val()) {
            returnValue = false;
        }
    })
    return returnValue;
}
function submitdata() {
    if (! wt_validate()) {
        return ;
    }
    $('#total_funds').form('submit', {url: '../../../../../extends/Table/api.php?action=save&subtable_id=1954',
        success: function (result) {
            $.messager.alert('提示', '信息保存成功！', 'info', function () {
                var complete = completeInput();
                if (complete) {
                    window.parent.save_stage('fund');
                } else {
                    window.parent.update_stage('fund');
                }
                window.parent.setStep('fund',complete);
            });
        }
    });


}

$(function () {
    loadApplyInfo();
});

function loadApplyInfo() {
    $.get('../../../../../extends/Table/api.php?action=get&subtable_id=1954', function (result) {
        if (result != '0') {
            var res = eval("(" + result + ")");

            // alert(res.org_code);
            $('#total_funds').form('load', res);
            bind_dom();
            wt_total();
        }
    });

    $('.save').bind('click', function () {
        submitdata();
    });
    $('.reset').bind('click', function () {
        window.location.reload();
    });
}

function getQueryStringByName(name) {
    var result = location.search.match(new RegExp("[\?\&]" + name + "=([^\&]+)", "i"));
    if (result == null || result.length < 1) {
        return "";
    }
    return result[1];
}


function addLine() {
    var newTr = addtable.insertRow(-1);
    // 总的行数 减一 就是 从0开始的吧 我觉得应该是
    var rows = addtable.rows.length - 2;
    var cell1 = newTr.insertCell(0);
    var cell2 = newTr.insertCell(1);
    var cell3 = newTr.insertCell(2);
    var cell4 = newTr.insertCell(3);
    var cell5 = newTr.insertCell(4);
    var cell6 = newTr.insertCell(5);
    var cell7 = newTr.insertCell(6);
    var cell8 = newTr.insertCell(7);
    var cell9 = newTr.insertCell(8);
    cell1.innerHTML = "<input type='text' name=\"eqpt_name[" + rows + "]\"/>";
    cell2.innerHTML = "<input type='text' name=\"eqpt_model[" + rows + "]\"/>";
    cell3.innerHTML = "<input type='text' name=\"plan_money[" + rows + "]\" datatype='float'/>";
    cell4.innerHTML = "<input type='text' name=\"actual_num[" + rows + "]\" datatype='number'/>";
    cell5.innerHTML = "<input type='text' name=\"actual_pay[" + rows + "]\" datatype='float'/>";
    cell6.innerHTML = "<input type='text' name=\"fund_src[" + rows + "]\"/>";
    cell7.innerHTML = "<input type='text'  id='buy_time"+rows+"' class='dateplu'  name=\"buy_time[" + rows + "]\"  readonly/>";
    cell8.innerHTML = "<input type='text' name=\"main_use[" + rows + "]\"/>";
    cell9.innerHTML = "<input type='button'  value='删除' class='pointer but'  onclick='delLine(this)'/>";
    $('textarea').unbind('blur');
    $('input').unbind('blur');
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
		}
		row++;
	});
}
