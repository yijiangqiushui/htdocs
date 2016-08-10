function submitdata() {
	$('#10org_info_fm').form('submit',
	{
		url : '/modules/php/action/page/applycation/apply10.act.php?action=10orgInfo',
		success : function(result) {
			$.messager.alert('提示','信息保存成功！','info',function(){
			var complete = completeInput();
			if(complete){
				window.parent.save_stage('org_info');
			}else{
				window.parent.update_stage('org_info');
			} 
			window.parent.setStep('org_info',complete);
		});
		}
    });

}

function reset() {
	$('#10org_info_fm').form('reset');
}

$(function() {
	loadApplyInfo();
	dateplu();
	$(".org_radio").change(function(){
		var selectedvalue = $("input[name='org_type']:checked").val();
		if(selectedvalue == '其他') {
			$("#other_in1").attr("disabled",false);
			$("#other_in1").focus();
		} else {
			$("#other_in1").attr("disabled",true);
			$("#other_in1").val('');
		}
	});
	$(".invest_radio").change(function(){
		var selectedvalue = $("input[name='investment']:checked").val();
		if(selectedvalue == '其他') {
			$("#other_in2").attr("disabled",false);
			$("#other_in2").focus();
		} else {
			$("#other_in2").attr("disabled",true);
			$("#other_in2").val('');
		}
	});
	$(".service_radio").change(function(){
		var selectedvalue = $("input[name='service_type']:checked").val();
		if(selectedvalue == '专业型') {
			$("#other_in3").attr("disabled",false);
			$("#other_in3").focus();
		} else {
			$("#other_in3").attr("disabled",true);
			$("#other_in3").val('');
		}
	});
	/*$('#back').click(function() {
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
	});*/
			
});

function loadApplyInfo() {
	$.get('/modules/php/action/page/applycation/apply10.act.php?action=find10orgInfo',
					function(result) {
						if (result != '0') {
							var res = eval("(" + result + ")");
							$('#10org_info_fm').form('load',res);
							if(res.org_type != "事业单位" && res.org_type != "国有资本控股的有限公司" && res.org_type != "国有独资企业" &&res.org_type != "民营资本为主的有限公司") {
								$("#other_in11").attr("checked","checked");
								$("#other_in1").val(res.service_type);
								$("#other_in1").attr("disabled",false);
								
							}
							if(res.investment != "国有企业" && res.investment != "民营企业" && res.investment != "大学" && res.investment != "研究院所" && res.investment != "政府" && res.investment != "投资机构" && res.investment != "自然人") {
								$("#other_in22").attr("checked","checked");
								$("#other_in2").val(res.investment);
								$("#other_in2").attr("disabled",false);
								
							}
							if(res.service_type != "综合型") {
								$("#other_in33").attr("checked","checked");
								$("#other_in3").val(res.service_type);
								$("#other_in3").attr("disabled",false);
								
							}
						}
					});
	
	
	$('.save').bind('click',function() {
		submitdata();
	});
	$('.reset').bind('click',function() {
		window.location.reload();
	});
}

function addLine() {
		var rows = addtable.rows.length - 1;
		var newTr = "<tr>";
		newTr +="<td><input type='text' name=\"shareholder_name[" + rows+ "]\" /></td>";
		 newTr +="<td><input type='text' datatype='float'  name=\"stock_ratio[" + rows+ "]\" /></td>";
		 newTr  +="<td><input type='button'  value='删除'  class='pointer but'  onclick='delLine(this)'/></td>";
		$('#addtable').append(newTr);
     	addRequire();
}
function delLine(obj) {
	var tr = obj.parentNode.parentNode;
	var tbody = tr.parentNode;
	tbody.removeChild(tr);
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

function getQueryStringByName(name){
    var result = location.search.match(new RegExp("[\?\&]" + name + "=([^\&]+)", "i"));
    if (result == null || result.length < 1) {
        return "";
    }
    return result[1];
}