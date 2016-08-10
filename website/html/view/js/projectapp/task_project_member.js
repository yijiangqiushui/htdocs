function pro_member() {

	$('#project_member').form('submit',
					{
						url : '../../../../../modules/php/action/page/applycation/apply.act.php?action=task_project_member',
						success : function(result) {	
							$.messager.alert('提示','信息保存成功！','info',function(){
							//judge whether this table has been finished
//							var complete = completeInput(); 
//								window.parent.save_stage('project_member',complete);
//							window.parent.setStep('project_member',complete);
								var complete = completeInput();
								if(complete) {
									//call save_stage
									window.parent.save_stage('project_member');
								}else{
									window.parent.update_stage('project_member');
								}
								window.parent.setStep('project_member',complete);
							});
						}
					});
}
function AddSignRow() {
	var value = tbl.rows.length - 1;
	var newTr ='<tr>';
	newTr +="<td><input type='text' name=\"researcher_name[" + value
			+ "]\"/></td>";
	newTr +="<td><select type='text' name=\"researcher_sex[" + value + "]\">" +
					"<option value='男' selected>男</option>"+
					"<option value='女'>女</option>"+
				    "</select></td>";
	/*newTr +="<td><input type='text'   class='dateplu'   name=\"researcher_birth[" + value
			+ "]\" class='dateplu' readonly/></td>";*/
	newTr += "<td>"+
			"<select  class='year' name='year["+value+"]'></select>"+
			"<select class='month' name='month["+value+"]'</select>"+
		    "</td>";
	newTr +="<td><input type='text' datatype='idcard' name=\"researcher_ID[" + value
			+ "]\"/></td>";
    newTr +="<td><input type='text' name=\"researcher_pos[" + value
			+ "]\"/></td>";
	newTr +="<td><input type='text' name=\"researcher_job[" + value
			+ "]\"/></td>";
	newTr +="<td><select type='text' name=\"researcher_edu[" + value + "]\">"+
				   "<option value='小学' selected>小学</option>"+
				   "<option value='初中' >初中</option>"+
				   "<option value='高中'>高中</option>"+
				   "<option value='中专'>中专</option>"+
				   "<option value='大专'>大专</option>"+
				   "<option value='本科'>本科</option>"+
				   "<option value='研究生'>研究生</option>"+
				   "<option value='其他'>其他</option>"+
				   "</select></td>";
	newTr +="<td><input type='text' name=\"researcher_major[" + value
			+ "]\"/></td>";
	newTr +="<td><input type='text' name=\"researcher_work[" + value
			+ "]\"/></td>";
	newTr +="<td><input type='text' name=\"researcher_org[" + value
			+ "]\"/></td>";
	newTr +="<td><input type='button' value='删除' class='pointer'  onclick='delRow(this);'/></td>";
	$('#tbl').append(newTr);
	dateplu();
	birth_day();
}
function addLine() {
	var newTr = addtable.insertRow(-1);
	// 总的行数 减一 就是 从0开始的吧 我觉得应该是
	var rows = addtable.rows.length - 2;
	var cell1 = newTr.insertCell(0);
	var cell2 = newTr.insertCell(1);
	var cell3 = newTr.insertCell(2);
	cell1.innerHTML = "<input type='text' name=\"org_name[" + rows + "]\" />";
	cell2.innerHTML = "<input type='text' name=\"org_mission[" + rows
			+ "]\" />";

	cell3.innerHTML = "<input type='button'  value='删除' class='pointer'   onclick='delRow(this)'/>";
	addRequire();
}
// 删除节点的数据
function delRow(obj) {
	var tbody = $(obj).parents("tbody");
	var tr = obj.parentNode.parentNode;
	var tbody = tr.parentNode;
	tbody.removeChild(tr);
	var row = 0;
	$(tbody).children("tr").each(function(){
		if(row!=0){
			$(this).find("input").each(function(){
				var name = $(this).prop("name");
				if(name!=""){
					var newName = name.split("[");
					newName[0] = newName[0] + "["+(row-1)+"]";
					$(this).prop("name",newName[0]);
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
	/*
	 * var value =
	 * parseInt(eval(document.getElementById("txtTRLastIndex")).value);
	 * document.getElementById("txtTRLastIndex").value = value-1;
	 */
}
/*
 * function resetResearchers(){ alert('fdfdf'); $('#resetResearcher').remove(); }
 */
$(function() {
	birth_day();
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
function loadApplyInfo(){
	$.get('../../../../../modules/php/action/page/projectapp/projectapp.act.php?action=findtask_ProMember',
					function(result) {
						if (result != '0') {
							var res = eval("(" + result + ")");
	//						 alert(res.org_code);
//							 alert(res.org_code);
							$('#project_member').form('load', res);
						}
					});
	
		
		$('.save').bind('click',function(){ pro_member(); });
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

function completeInput() {
	var returnValue = true;
	$('input').each(function() {
		if(!$(this).val() && $(this).attr('name') != 'txtTRLastIndex') {
			returnValue = false;
		}
	})
	$('textarea').each(function(){
		if(!$(this).val()){
			returnValue = false;
		}
	});
	return returnValue;
}



