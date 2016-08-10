
///////////////////
function saveSign() {
    $('#appFm').form('submit', {
        url: '../../../../../modules/php/action/page/acceptance/expert.act.php?action=sign',
        success: function (result) {
            $.messager.alert('提示', '信息保存成功！', 'info', function () {
                var complete = completeInput();
                //alert(complete);
                if (complete) {
                    window.parent.save_stage('sign');
                } else {
                    window.parent.update_stage('sign');
                }
//                alert(complete);
                window.parent.setStep('sign', complete);
            });
        }
    });
}


function completeInput(){
	var returnValue = true;
	$('input').each(function() {
		if(!$(this).val()) {
			returnValue = false;
		}
	});
	return returnValue;
}


$(function () {
    loadApplyInfo();
    addRequire();
/*    $('#back').click(function () {
        root = $(window.parent.parent.document).get(0).location.pathname;
        //alert(root)
        reg = /website/;
        result = root.search(reg);
        //alert(result)
        //前台
        if (result != -1) {
            $(window.parent.parent.document).find('iframe').attr('src', "../template/user_project.php");
        }
        //后台
        else {
            $(window.parent.parent.document).find('iframe').attr('src', "/center/php/action/page/approve.php");
        }
    });*/
dateplu();
/*    $('#argument_time').dateRangePicker({
        autoClose: true,
        singleDate: true,
        showShortcuts: false
    });*/
});
function getQueryStringByName(name) {
    var result = location.search.match(new RegExp("[\?\&]" + name + "=([^\&]+)", "i"));
    if (result == null || result.length < 1) {
        return "";
    }
    return result[1];
}
function loadApplyInfo() {
    $.get('../../../../../modules/php/action/page/acceptance/expert.act.php?action=findsign', function (result) {
        if (result != '0') {
            var res = eval("(" + result + ")");
            $('#appFm').form('load', res);
            //console.log(res);
            $("#project_name_span").text(res['project_name']);
        }
    });
   
    $('.save').bind('click', function () {
        saveSign();
    });
    $('.reset').bind('click', function () {
        window.location.reload();
    });

}











/**************************不知道为什么没有回写的函数******************************************/
function addLine() {
    var rows = $("#addtable tr").size() - 1;
    var value = addtable.rows.length - 1;
    var newTr = '<tr>';
    newTr += "<td width='110'><input type='text' name=\"expert_name[" + rows
            + "]\" /></td>";
    newTr += "<td width='267'><select type='text' name='expert_divide["+rows+"]'   ><option value='1'>组员</option><option value='0'>组长</option></select></td>";
    newTr += "<td width='267'><input type='text' name=\"expert_org[" + rows
            + "]\" /></td>";
    newTr += "<td width='267'><input type='text' name=\"expert_id[" + rows
            + "]\" datatype='idcard'  /></td>";
    newTr += "<td width='267'><input type='text' name=\"expert_job[" + rows
            + "]\" /></td>";
    newTr += "<td width='267'><input type='text' name=\"expert_major[" + rows
            + "]\" /></td>";
    newTr += "<td width='267'><input type='text' datatype='telephone'  name=\"expert_phone[" + rows
            + "]\" /></td>"
    newTr += "<td width='40'><input type='button'  value='删除' class='pointer'   onclick='delLine(this)'/></td></tr>";
    $('#addtable').append(newTr);
    addRequire();

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



function addRequire() {
    $("select").unbind("change");
    $("select").change(function () {
        if ($(this).val() == 0) {
            var name = $(this).attr("name");
            if (add(name) != 0) {
                alert("只能选择一个组长");
                $(this).val("1");
            }

        }
    });
}


function add(name) {
    var count = 0;
    $("select").each(function () {
        if ($(this).val() == 0 && $(this).attr("name") != name) {
            count++;
        }
    });
    return  count;
}
