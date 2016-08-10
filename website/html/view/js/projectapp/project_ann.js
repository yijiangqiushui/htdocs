function pro_ann(){
//	alert("hahah");
	$('#project_ann').form('submit',{
		url:'../../../../../../modules/php/action/page/applycation/apply.act.php?action=project_ann',
		success:function(result){
			$.messager.alert('提示','信息保存成功！','info',function(){
			var complete = completeInput();  
			if(complete) {
				window.parent.save_stage('project_plan');
			} else{
				window.parent.update_stage('project_plan');
			}
			window.parent.setStep('project_plan',complete);
			});
		}
	});
}



$(function()
{
	loadApplyInfo();
	$('textarea').blur(function() {
		var self = this;
		var txt = $(this).val();
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
  addRequire();
	year();
});

function year(){
	var current_date = new Date();
	var current_year = current_date.getFullYear();
	$('.current_year').val(current_year);
}

function completeInput() {
	var returnValue = true;
	$('textarea').each(function() {
		if(!$(this).val()) {
			returnValue = false;
		}
	})
	$('input').each(function() {
		if(!$(this).val()) {
			returnValue = false;
		}
		
	})
	return returnValue;
}

function loadApplyInfo(){
		$.get('../../../../../../modules/php/action/page/projectapp/projectapp.act.php?action=findProAnn',function(result){
			if(result!='0'){
				var res=eval("("+result+")");
				//alert(res.org_code);
				$('#project_ann').form('load',res);
			}
		});
		
	
	$('.save').bind('click',function(){ pro_ann(); });
	$('.reset').bind('click',function(){
		window.location.reload();
	});
	}


function addLine() {  
	var rows = addtable.rows.length-1 ;
	var current_date = new Date();
	var current_year = current_date.getFullYear();
	var newRows = $("#addtable").find("tr:last").find("input").val();
	if(!isNaN(newRows)){
		newRows = Number(newRows)+1;
	}else{
		newRows = current_year;
	}

	current_year = current_year + rows;
	var newTr = '<tr>';
	newTr += "<td style='width:70px;'><p><input  name=\"plan_year[" + rows
			+ "]\" class='current_year' datatype='year' value='"+ newRows +"' style='width:38px;'/><p style='margin:9px;'>年</p></td>";
	newTr += "<td><textarea style='padding:10px;margin:10px;'   name=\"plan_content[" + rows + "]\" ></textarea></td>";
	newTr += "<td width='66px;' class='pointer but'><input type='button'  value='删除' class='pointer' onclick='delLine(this)'/></td>";
	newTr += '</tr>';
	$('#addtable').append(newTr);
	addRequire();
}
function delLine(obj) {
	//删除逻辑比较复杂，先改写年份信息，然后删除行，然后再修改name属性，不可更改顺序
	var tr = obj.parentNode.parentNode;
	var tbody = tr.parentNode;
	var year = $(tr).find("input:first").val();
	var current_date = new Date();
	var current_year = current_date.getFullYear();
	if(!isNaN(year)){
		year = Number(year);
	}else{
		year = current_year;
	}
	$(tr).nextAll().each(function(){
			//alert($(this).find("input:first").prop("value"));
			$(this).find("input:first").prop("value",year++);
		}
	);
	tbody.removeChild(tr);
	var row = 0;
	$(tbody).children("tr").each(function(){
		if(row!=0){

			$(this).find("select").each(function(){
				var name = $(this).prop("name");
				if(name!=""){
					var newName = name.split("[");
					newName[0] = newName[0] + "["+(row-1)+"]";
					$(this).prop("name",newName[0]);
				}
			});
			$(this).find("input").each(function(){
				var name = $(this).prop("name");
				if(name!=""){
					var newName = name.split("[");
					newName[0] = newName[0] + "["+(row-1)+"]";
					$(this).prop("name",newName[0]);
				}
			});
			$(this).find("textarea").each(function(){
				var name = $(this).prop("name");
				if(name!=""){
					var newName = name.split("[");
					newName[0] = newName[0] + "["+(row-1)+"]";
					$(this).prop("name",newName[0]);
				}
			});

		}
		row++;
	});
}


function getQueryStringByName(name){
    var result = location.search.match(new RegExp("[\?\&]" + name + "=([^\&]+)", "i"));
    if (result == null || result.length < 1) {
        return "";
    }
    return result[1];
}



function addRequire(){
	$('input').unbind('blur');
	$('input').not(':disabled').blur(function() {
		var self = this;
		var txt = $(this).val().trim();
		//返回被选元素的属性值
		var type = $(this).attr('datatype');
		var filter;
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
				
			} else if(type) {
				if(type == 'email') {
					 filter  =  /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/;
				} else if(type == 'number') {
					filter  = /^\d+$/;
				} else if(type == 'phone') {
					filter =  /^\d{2,4}-?\d{5,8}$/;
				} else if(type == 'telephone') {
					filter = /^1\d{10}$/;
				} else if(type == 'sex') {
					filter = /['男','女']/;
				}
				if (!filter.test(txt)){
					alert('填写格式不正确,请重新填写');
					$(this).focus();
				}
			}
	});
	
	$('textarea').not(':disabled').blur(function() {
		var self = this;
		var txt = $(this).val().trim();
		//返回被选元素的属性值
		var type = $(this).attr('datatype');
			if(!txt) {
				if(!$(self).attr('readonly')) {
					$(self).after('<div class="error">此项不得为空</div>');
					var timer = setTimeout(function() {
						$(self).next().remove();
						},1000); 
				} 
			} 
	});
   
}
//
//function year(){
//	var rows = addtable.rows.length ;
//	var current_date = new Date();
//	var current_year = current_date.getFullYear();
//	var option = '';
//	for(var i = current_year-10; i<current_year +10; i++) {
//		if (i == current_year + rows - 1) {
//			option += '<option value="'+i+'"" selected="selected">'+i+'</option>';
//		} else {
//			option += '<option value="'+i+'"">'+i+'</option>';
//		}
//	}
//	$('.current_year:eq(' + (rows - 1) + ')').append(option);

//}
	