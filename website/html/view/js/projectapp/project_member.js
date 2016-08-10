

$(function() {
	birth_day();
	loadApplyInfo();
	dateplu();
	$('textarea').blur(function() {
		var txt = $(this).val();
		var self = this;
		if(!txt) {
			if(!$(self).attr('readonly')) {
				$(self).after('<div class="error">此项不得为空</div>');
				var timer = setTimeout(function() {
					$(self).next().remove();
					},1000); 
			} else {
				$(self).after('<div class="error1">此项不需要用户输入</div>');
				var timer = setTimeout(function() {
					$(self).next().remove();
					},1000); 
			}
			
		}
		
	});
	
	
/*$('#back').click(function() {
	root = $(window.parent.parent.document).get(0).location.pathname;
	//alert(root)
	reg = /website/;
	result = root.search(reg);
	//alert(result)
	if(result != -1){
		$(window.parent.parent.document).find('iframe').attr('src',"../template/user_project.php");
	}else{
		department = $.cookie("department");
	    min = $.cookie("min");
	    max = $.cookie("max");
	    project_type = $.cookie("project_type");
		//var strCookie=document.cookie; 
		//alert(strCookie);
		$(window.parent.parent.document).find('iframe').attr('src',"/center/php/action/page/approve.php?min="+min+"&max="+max+"&department"+department+"&project_type"+project_type);
	}
});*/
	
});

function pro_member() {

	$('#project_member')
			.form(
					'submit',
					{
						url : '../../../../../../modules/php/action/page/applycation/apply.act.php?action=project_member',
						success : function(result) {
							$.messager.alert('提示','信息保存成功！','info',function(){
							var complete = completeInput();  
							if(complete) {
								window.parent.save_stage('project_member');
							} else{
								window.parent.update_stage('project_member');
							}
							window.parent.setStep('project_member',complete);
							});
							}
					});
}
function AddSignRow() {
	var value = tbl.rows.length - 1;//这里就是减1，不要再改了
	var newTr ='<tr>';
	newTr +="<td><input type='text' name=\"researcher_name[" + value
			+ "]\"/></td>";
	newTr +="<td width='50px'><select type='text' name=\"researcher_sex[" + value + "]\">" +
					"<option value='男' selected>男</option>"+
					"<option value='女'>女</option>"+
				    "</select></td>";
//	newTr +="<td><input type='text'   class='dateplu'  readonly  name=\"researcher_birth[" + value
//			+ "]\"/></td>";
	newTr += "<td>"+
				"<select  class='year' name='year["+value+"]'></select>"+
				"<select class='month' name='month["+value+"]'</select>"+
			"</td>";
	newTr +="<td><input type='text' name=\"researcher_ID[" + value
			+ "]\" datatype='idcard' placeholder='请输入18位身份证号'/></td>";
    newTr +="<td><input type='text' name=\"researcher_pos[" + value
			+ "]\"/></td>";
	newTr +="<td><input type='text' name=\"researcher_job[" + value
			+ "]\"/></td>";
	newTr +="<td width='100px'><select type='text' name=\"researcher_edu[" + value + "]\">"+
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
	newTr +="<td><input type='button' value='删除'  class='pointer but' onclick='delRow(this);'/></td>";
	$('#tbl').append(newTr);
	birth_day();
	
	
	//validation();
}
function addLine() {
	var rows = addtable.rows.length - 1;//这里就是减1，不要再改了
	var newTr = '<tr>';
	newTr += "<td width='110'><input type='text' name=\"org_name[" + rows + "]\" /></td>";
	newTr += "<td width='267'><input type='text' name=\"org_mission[" + rows + "]\" /></td>";
	newTr += "<td width='40'><input type='button'  value='删除'  class='pointer but'  onclick='delRow(this)'/></td>";
	newTr == '</tr>';
	$('#addtable').append(newTr);
}
// 删除节点的数据

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
function loadApplyInfo(){
	$.get(
		'../../../../../../modules/php/action/page/projectapp/projectapp.act.php?action=findProMember',
		function(result) {
			if (result != '0') {
				var res = eval("(" + result + ")");
				// alert(res.org_code);
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
