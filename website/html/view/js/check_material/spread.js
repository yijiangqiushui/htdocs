function unit_info(){
	$('#spread').form('submit',{
		url:'../../../../../../../modules/php/action/page/lmcheck_material/check_material.act.php?action=save_spread',
		success:function(result){
			$.messager.alert('提示','信息保存成功！','info',function(){
			var complete = completeInput();   
			if(complete) {
				window.parent.save_stage('spread');
			}else{
				window.parent.update_stage('spread');
			}
			window.parent.setStep('spread',complete);
			});
		}
	});
	
}
$(function() {
	loadApplyInfo();
//	$('input').blur(function() {
//		var self = this;
//		var txt = $(this).val();
//		//返回被选元素的属性值
//		var type = $(this).attr('datatype');
//		var filter;
//			if(!txt) {
//				if(!$(self).attr('readonly')) {
//					$(self).after('<div class="error">此项不得为空</div>');
//					var timer = setTimeout(function() {
//						$(self).next().remove();
//						},1000); 
//				} else {
//					$(self).after('<div class="error1">此项不需要用户输入</div>');
//					var timer = setTimeout(function() {
//						$(self).next().remove();
//						},1000); 
//				}
//				
//			} else if(type) {
//				if(type == 'email') {//邮箱
//					 filter  =  /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/;
//				} else if(type == 'number') {//数字
//					filter  = /^\d+$/;
//				} else if(type == 'chinese_characters') {//汉字
//					filter  = /^[\u4e00-\u9fa5]*$/;
//				} else if(type == 'phone') {
//					filter =  /^\d{2,4}-?\d{5,8}$/;
//				} else if(type == 'telephone') {//手机
//					filter = /^1[3|5|7|8|][0-9]{9}$/;
//				} else if(type == 'fax') {//传真
//					filter =  /^((0\d{2,3})-)(\d{7,8})(-(\d{3,}))?$/;
//				} else if(type == 'postcode') {//6位的邮政编码
//					filter = /^\d{6}$/;
//				} else if(type == 'chinese_characters') {//汉字
//					filter  = /^[\u4e00-\u9fa5]*$/;
//				}
//				if (!filter.test(txt)){	
//					alert('填写格式不正确,请重新填写!');
//					$(this).focus();
//				}
//			}
//	});
	
/*	$('#back').click(function() {
		root = $(window.parent.parent.document).get(0).location.pathname;
		reg = /website/;
		result = root.search(reg);
		//前台
		if(result != -1){
			$(window.parent.parent.document).find('iframe').attr('src',"../template/user_project.php");
		}
		//后台
		else{
			$(window.parent.parent.document).find('iframe').attr('src',"/center/php/action/page/approve.php");
		}
	});*/
	
	$('#identify_date').dateRangePicker({
		autoClose: true,
		singleDate : true,
		showShortcuts: false
	});
});

function completeInput() {
	var returnValue = true;
	$('input').each(function() {
		if(!$(this).val()) {
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

function loadApplyInfo() {
	$.get('../../../../../../../modules/php/action/page/lmcheck_material/check_material.act.php?action=find_spread',
					function(result) {
						if (result != '0') {
							var res = eval("(" + result + ")");
							$('#spread').form('load', res);
						}
						
					});
	
		
		$('.save').bind('click',function(){ unit_info(); });
		$('.reset').bind('click',function(){
			window.location.reload();
		});
	
}

function addLine(){
	/*var newTr = document.getElementById("shareholder_info").insertRow(-1);
	var value = document.getElementById("shareholder_info").rows.length - 1;
	var newTd0 = newTr.insertCell(0);
	var newTd1 = newTr.insertCell(1);
	var newTd2 = newTr.insertCell(2);
	newTd0.innerHTML="<input type='text' name=\"shareholder_name["+value+"]\" />";
	newTd1.innerHTML="<p align='center'>专利号</p>";
	newTd2.innerHTML="<input type='text' name=\"shareholder_name["+value+"]\" />";*/
	var rows = document.getElementById("tech_transfer").rows.length -1;
	var count=rows+1;
	var newTr = "<tr>";
    	newTr +="<td><p align='center'>"+count+"</p></td>";
	newTr +="<td><input type='text' name=\"receiver["+rows+"]\" /></td>";
	 newTr +="<td><input type='text' name=\"company_scale["+rows+"]\" /></td>";
	 newTr  +="<td><input type='button'  value='删除'  class='pointer' onclick='deleteRow(this)'/></td>";
	$('#tech_transfer').append(newTr);	
}
function addLine2(){

	var rows = document.getElementById("co_construct").rows.length -1;
	var count=rows+1;
	var newTr = "<tr>";
	 newTr +="<td><p align='center'>"+count+"</p></td>";
	newTr +="<td><input type='text' name=\"partner_name["+rows+"]\" /></td>";
	 newTr +="<td><input type='text' name=\"company_scale1["+rows+"]\" /></td>";
	 newTr  +="<td><input type='button'  value='删除' class='pointer'  onclick='deleteRow(this)'/></td>";
	$('#co_construct').append(newTr);	
}

function deleteRow(obj) {
	var tbody = $(obj).parents("tbody");//不可调换位置
	var tr = obj.parentNode.parentNode;
	var tbody = tr.parentNode;
	tbody.removeChild(tr);
	var row = 0//有表头的时候是从0开始
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
			$(this).find("p").html(row);
		}

		row++;
	});



}


