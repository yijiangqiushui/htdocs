function saveSign() {
	$('#expert_sign')
			.form(
					'submit',
					{
						url : '../../../../../modules/php/action/page/acceptance/expert.act.php?action=zj_sign',
						success : function(result) {
//							$.messager.alert('提示', '信息保存成功！');
//							// $('#expert_sign').form('reset');
//							var complete = completeInput();
//							lete = completeInput();
//							window.parent.setStep('expert_sign', complete);
							$.messager.alert('提示','信息保存成功！','info',function(){
								//judge whether this table has been finished
								var complete = completeInput();
								if(complete) {
									//call save_stage
									window.parent.save_stage('expert_sign');
								}else{
									window.parent.update_stage('expert_sign');
								}
								window.parent.setStep('expert_sign',complete);
							});
						}
					});
}
function resetInfo() {
	alert('重置');

}
$(function() {
	loadApplyInfo();
	dateplu();
/*	$('#register_time').dateRangePicker({
		autoClose : true,
		singleDate : true,
		showShortcuts : false,
	});*/
//	validation();
/*	$('#back')
			.click(
					function() {
						root = $(window.parent.parent.document).get(0).location.pathname;
						// alert(root)
						reg = /website/;
						result = root.search(reg);
						// alert(result)
						// 前台
						if (result != -1) {
							$(window.parent.parent.document)
									.find('iframe')
									.attr('src', "../template/user_project.php");
						}
						// 后台
						else {
							$(window.parent.parent.document).find('iframe').attr('src',"/center/php/action/page/approve.php");
						}
					});*/
});

function getQueryStringByName(name) {
	var result = location.search.match(new RegExp(
			"[\?\&]" + name + "=([^\&]+)", "i"));
	if (result == null || result.length < 1) {
		return "";
	}
	return result[1];
}
function loadApplyInfo() {
	$.get('../../../../../modules/php/action/page/acceptance/expert.act.php?action=findzj_sign',
					function(result) {
						if (result != '0') {
							var res = eval("(" + result + ")");
							// alert(res.org_code);
							$('#expert_sign').form('load', res);
						}
					});

	
	$('.save').bind('click', function() {
		saveSign();
	});
	$('.reset').bind('click', function() {
		window.location.reload();
	});
}
function AddSignRow() {
	var value = $("#addtable tr").size() - 1;
	$("#addtable").append("<tr></tr>");
	var newTr = $("#addtable tr:last")[0];
	var newTd0 = newTr.insertCell(0);
	var newTd1 = newTr.insertCell(1);
	var newTd2 = newTr.insertCell(2);
	var newTd3 = newTr.insertCell(3);
	var newTd4 = newTr.insertCell(4);
	var newTd5 = newTr.insertCell(5);
	var newTd6 = newTr.insertCell(6);
	var newTd8 = newTr.insertCell(7);

	newTd0.innerHTML = "<input type='text'   name=\"expert_name[" + value
			+ "]\"/>";
	newTd1.innerHTML = "<select type='text' name=\"expert_divide[" + value+"]\" value= '0' > <option value='1'>组员</option>  <option value='0'>组长</option></select>";

	newTd2.innerHTML = "<input type='text'  name=\"expert_org[" + value
			+ "]\"/>";
	newTd3.innerHTML = "<input type='text'  name=\"expert_id[" + value
			+ "]\" datatype='idcard' />";
	newTd4.innerHTML = "<input type='text'  name=\"expert_job[" + value
			+ "]\"/>";
	newTd5.innerHTML = "<input type='text' name=\"expert_major[" + value
			+ "]\"/>";
	newTd6.innerHTML = "<input type='text' datatype='telephone' name=\"expert_phone[" + value
			+ "]\"/>";
	newTd8.innerHTML = "<input type='button'  value='删除' class='pointer'  onclick='delRow(this);'/>";
	$("select").each(function() {
		
		$(this).unbind("change");
	});
	$("select").each(function() {
		$(this).change(function() {
			if ($(this).val() == 0) {
				var name = $(this).attr("name");
				if(add(name)!=0){
					alert("只能选择一个组长");
					$(this).val("1");
				}

			}
		});
	});
//	validation();
}

function delRow(obj) {
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

function completeInput() {
	var returnValue = true;
	$('input').each(function() {
		if (!$(this).val().trim()) {
			returnValue = false;
		}
	})
	return returnValue;
}

/*function addRequire() {
	$('input').unbind('blur');
	$('input').not(':disabled').blur(
					function() {
						var self = this;
						var txt = $(this).val().trim();
						// 返回被选元素的属性值
						var type = $(this).attr('datatype');
						var filter;
						if (!txt) {
							if (!$(self).attr('readonly')) {
								$(self)
										.after(
												'<div class="error">此项不得为空</div>');
								var timer = setTimeout(function() {
									$(self).next().remove();
								}, 1000);
							} else {
								$(self).after(
										'<div class="error1">此项不需要用户输入</div>');
								var timer = setTimeout(function() {
									$(self).next().remove();
								}, 1000);
							}

						} else if (type) {
							if (type == 'email') {
								filter = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/;
							} else if (type == 'number') {
								filter = /^\d+$/;
							} else if (type == 'phone') {
								filter = /^\d{2,4}-?\d{5,8}$/;
							} else if (type == 'telephone') {
								filter = /^1\d{10}$/;
							} else if (type == 'sex') {
								filter = /['男','女']/;
							} else if (type == 'idcard'){
								filter = /^\d{6}(18|19|20)?\d{2}(0[1-9]|1[12])(0[1-9]|[12]\d|3[01])\d{3}(\d|X)$/i;
							}
							if (!filter.test(txt)) {
								alert('填写格式不正确,请重新填写');
								$(this).focus();
							}
						}
					});
	$("select").each(function() {
		
		$(this).unbind("change");
	});
	$("select").each(function() {
		$(this).change(function() {
			if ($(this).val() == 0) {
				var name = $(this).attr("name");
				if(add(name)!=0){
					alert("只能选择一个组长");
					$(this).val("1");
				}

			}
		});
	});


}*/

function add(name) { 
	var  count=0;
	$("select").each(function() {
		if ($(this).val() == 0 && $(this).attr("name") != name) {
			count++;
		}
	});
	return  count;
}

function getQueryStringByName(name) {
	var result = location.search.match(new RegExp(
			"[\?\&]" + name + "=([^\&]+)", "i"));
	if (result == null || result.length < 1) {
		return "";
	}
	return result[1];
}
