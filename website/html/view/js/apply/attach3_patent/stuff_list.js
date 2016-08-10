function org_info(){
	$('#stuff_list').form('submit',{
		url:'../../../../../../../extends/Table/api.php?action=save&subtable_id=28',
		success:function(result){
			$.messager.alert('提示','信息保存成功！','info',function(){
			//judge whether this table has been finished
			var complete = completeInput();   
			if(complete) {
				//call save_stage
				window.parent.save_stage('stuff_list');
			}else{
				window.parent.update_stage('stuff_list');
			}
			window.parent.setStep('stuff_list',complete);
			});
		}
	});
}



$(function() {
	loadApplyInfo();
	/*
	$('input').blur(function() {
		var self = this;
		var txt = $(this).val();
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
				if(type == 'email') {//邮箱
					 filter  =  /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/;
				} else if(type == 'number') {//数字
					filter  = /^\d+$/;
				} else if(type == 'chinese_characters') {//汉字
					filter  = /^[\u4e00-\u9fa5]*$/;
				} else if(type == 'phone') {
					filter = /(^(0[0-9]{2,3}\-)?([2-9][0-9]{6,7})+(\-[0-9]{1,4})?$)|(^((\(\d{3}\))|(\d{3}\-))?(1[358]\d{9})$)/;
				}  else if(type == 'fax') {//传真
					filter =  /^((0\d{2,3})-)(\d{7,8})(-(\d{3,}))?$/;
				} else if(type == 'postal') {//6位的邮政编码
					filter = /^\d{6}$/;
				} else if(type == 'date') {//汉字
					filter  = /^2[0-3][0-9]{2}-[0-1][1-9]-[0-3][1-9]$/;
				}else if(type == "bignumber"){
					filter = /^-?\d+(\.\d+)?$/;	
				}else if(type == 'sex') {
					filter = /['男','女']/;
				}else if(type == 'chinese_characters') {//汉字
					filter  = /^[\u4e00-\u9fa5]*$/;
				}
				if (!filter.test(txt)){	
					alert('填写格式不正确,请重新填写!');
					$(this).focus();
				}
			}
	});
	*/
	
/*	$('#back').click(function() {
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
/*
	$('#date').dateRangePicker({
		autoClose: true,
		singleDate : true,
		showShortcuts: false,
		getValue: function()
		{
			return this.innerHTML;
		},
		setValue: function(s)
		{
			this.innerHTML = s;
		}
	});
	
	$('#birth').dateRangePicker({
		autoClose: true,
		singleDate : true,
		showShortcuts: false,
		getValue: function()
		{
			return this.innerHTML;
		},
		setValue: function(s)
		{
			this.innerHTML = s;
		}
	});
	$('#employ').dateRangePicker({
		autoClose: true,
		singleDate : true,
		showShortcuts: false,
		getValue: function()
		{
			return this.innerHTML;
		},
		setValue: function(s)
		{
			this.innerHTML = s;
		}
	});
	*/
});

function completeInput() {
	var returnValue = true;
	$('input').each(function() {
		if(!$(this).val()) {
			returnValue = false;
		}
	});
	$('textarea').each(function() {
		if(!$(this).val()) {
			returnValue = false;
		}
	});
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
	$.get('../../../../../../../extends/Table/api.php?action=get&subtable_id=28',
					function(result) {
						if (result != '0') {
							var res = eval("(" + result + ")");
							$('#stuff_list').form('load', res);
						}
						
					});
	
	
	$('.save').bind('click',function(){ org_info(); });
	$('.reset').bind('click',function(){
		window.location.reload();
	});
}


function addLine() {  
	var rows = addtable.rows.length;
	var newrows = $("#addtable").find("tr:last").find("input:first").val();
	var order = 1;
	if(Number(newrows)){
		order = Number(newrows)+1;
	}
	var newTr = "<tr>";
	 newTr +="<td width=\"200px\"><p><input type='text' name=\"serial_number[" + rows+ "]\" value='"+ order +"' style='text-align:center;'/></p></td>";
	 newTr +="<td colspan='5'><input type='text' name=\"stuff_name[" + rows+ "]\" /></td>";
	 newTr  +="<td><input type='button' value='删除' class='pointer but' onclick='delLine(this)'/></td>";
	 newTr += "</tr>";
	$('#addtable').append(newTr);

}

function delLine(obj) {
	var tbody = $(obj).parents("tbody");//不可调换位置
	var tr = obj.parentNode.parentNode;
	var tbody = tr.parentNode;
	var row = 0;
	$(tbody).children("tr").each(function () {
		if (row != 0) {
			//$(this).find("p").each(function(){
			//	$(this).html(row);
			//});
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
	tbody.removeChild(tr);
}

