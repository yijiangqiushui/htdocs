function org_info(){
	if(validateNum()){
		$.messager.alert('提示',"已获专利授权数为发明、实用新型、外观设计三项数据之和！",'error');
		return ;
	}else{
	$('#project_info').form('submit',{
		url:'/modules/php/action/page/projectapp/projectapp.act.php?action=patent3_projectinfo',
		success:function(result){
			$.messager.alert('提示','信息保存成功！','info',function(){
			//judge whether this table has been finished
			var complete = completeInput();   
			if(complete) {
				//call save_stage
				window.parent.save_stage('project_info');
			}else{
				window.parent.update_stage('project_info');
			}
			window.parent.setStep('project_info',complete);
			});
		}
	});
}}

function addLine() {
	var rows = addtable.rows.length;
	var newTr = '<tr>';
	newTr += "<td  colspan=\"2\"><input type=\"text\" name=\"patent_name[" + rows + "]\"/></td>";
	newTr += "<th><p align=\"center\">专利号</p></th>";
	newTr += "<td  colspan=\"2\"><input type=\"text\" name=\"patent_code[" + rows + "]\"/></td>";
	newTr += "<td  colspan=\"2\"><input type='button' value='删除' class='pointer but'  onclick='delRow(this)'/></td>";
	newTr += '</tr>';
	$('#addtable').append(newTr);
}

function delRow(obj) {
	var tbody = $(obj).parents("tbody");//不可调换位置
	var tr = obj.parentNode.parentNode;
	var tbody = tr.parentNode;
	tbody.removeChild(tr);
	var row = 1;
	$(tbody).children("tr").each(function () {
		if (row != 0) {
			$(this).find("input").each(function () {
				var name = $(this).prop("name");
				if (name != "" &&(name.indexOf("[")!=-1)) {
					var newName = name.split("[");
					newName[0] = newName[0] + "[" + (row-1) + "]";//
					$(this).prop("name", newName[0]);
				}
			});
		}
		row++;
	});
}


$(function() {
	birth_day()
	loadApplyInfo();
	dateplu();
});


function validateNum(){
	var invent_num = document.getElementsByName('invent_num')[0].value;
	var function_patent = document.getElementsByName('function_patent')[0].value;
	var patent_design = document.getElementsByName('patent_design')[0].value;
	var sum1=Number(document.getElementsByName('patent_num')[0].value);
	var sum = Number(invent_num) + Number(function_patent) + Number(patent_design);
	if(sum1!=sum){
		return true;
	}else{
		return false;
	}
}
function sum(){
	var invent_num = document.getElementsByName('invent_num')[0].value;
	var function_patent = document.getElementsByName('function_patent')[0].value;
	var patent_design = document.getElementsByName('patent_design')[0].value;
	var sum = Number(invent_num) + Number(function_patent) + Number(patent_design);
    $("input[name='patent_num']").val(sum);	
}

function completeInput() {//display
	var returnValue = true;
	$('input').each(function() {
		if(!$(this).val()) {
			if($(this).css("display")!='none'){
				returnValue = false;
			}
			
		}
	})
	$('textarea').each(function() {
		if(!$(this).val()) {
			returnValue = false;
		}
	})
	var count = 0;
	$(':checkbox').each(function(){
		if($(this).prop('checked')){
			count++;
		}
	})
	if(count == 0){
		return;
	}
	return returnValue;
}

function getQueryStringByName(name){
    var result = location.search.match(new RegExp("[\?\&]" + name + "=([^\&]+)", "i"));
    if (result == null || result.length < 1) {
        return "";
    }
    return result[1];
}

function loadApplyInfo() {
	$.get('/modules/php/action/page/projectapp/projectapp.act.php?action=findpatent3_pro',
					function(result) {
						if (result != '0') {
							var res = eval("(" + result + ")");
							if(res.tech_area != '电子信息' && res.tech_area != '生物医药' && res.tech_area != '新材料' && res.tech_area != '先进制造与自动化' && res.tech_area != '能源与节能' && res.tech_area != '环境保护' && res.tech_area != '农业' && res.tech_area != '社会事业'){
								$('#tech_area').append("<option value='"+ res.tech_area +"'>"+ res.tech_area +"</option>");
//								$('#leader_edu').val(res.tech_area);
							}
							$('#project_info').form('load', res);
							if(res.tech_area != "电子信息" && res.tech_area != "生物医药" && res.tech_area != "新材料" && res.tech_area != "先进制造与自动化" && res.tech_area != "能源与节能" && res.tech_area != "环境保护" && res.tech_area != "农业"&& res.tech_area != "社会事业") {                         
								$('#tech_area_other').show();
								var obj = document.getElementById('tech_area');
					             obj.style.width = '65px';
					             obj.val="其他";
//								$("#tech_area_other").prop("checked","checked");//使用prop代替attr
								$("#tech_area_other").val(res.tech_area);
								$("#tech_area_other").prop("disabled",false);
								$('#areaother').attr('selected', 'selected');
							}
							
							
						}
						
					});
	
		var user_type = decodeURI(getQueryStringByName('user_type'));
		var table_status = decodeURI(getQueryStringByName('table_status'));

		show_save(user_type,table_status);
		$('.save').bind('click',function(){ org_info(); });
		$('.reset').bind('click',function(){
			window.location.reload();
		});
}


