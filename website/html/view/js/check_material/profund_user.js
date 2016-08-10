function unit_info(){
	$('#total_funds').form('submit',{
		url:'../../../../../../../modules/php/action/page/lmcheck_material/check_material.act.php?action=save_develop',
		success:function(result){
			$.messager.alert('提示','信息保存成功！','info',function(){
			var complete = completeInput();   
			if(complete) {
				window.parent.save_stage('develop');
			}else{
				window.parent.update_stage('develop');
			}
			window.parent.setStep('develop',complete);
			});
		}
	});
	
}
$(function() {
	loadApplyInfo();
	addRequire();
	
	$('#back').click(function() {
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
	});
	
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
	$.get('../../../../../../../modules/php/action/page/lmcheck_material/check_material.act.php?action=find_authent',
					function(result) {
						if (result != '0') {
							var res = eval("(" + result + ")");
							$('#authent').form('load', res);
						}
						
					});
	
			
	$('.save').bind('click',function(){ unit_info(); });
	$('.reset').bind('click',function(){
		window.location.reload();
	});
	
}

function addLine(){
	/*	echo "<tr>";
				echo "<th rowspan='2'><p align='center'>1</p></th>";
				echo "<th><p align='center'>专利名称</p></th>";
				echo "<td><input type='text' name='patent_name[$i]'  datatype='baifenshu'   value='$row->patent_name'/></td>";
				echo "<td><th><p align='center'>类型</p></th></td>";
				echo "<td><input type='text' name='patent_type[$i]'  datatype='baifenshu'   value='$row->patent_type'/></td>";
				echo "<td rowspan='2'><input type='button' value='删除' onclick='deleteRow(this)'/></td>";
				echo "</tr>";
				echo "<tr>";
		        echo "<th><p align='center'>专利状态</p></th>";
				echo "<td><input type='text' name='patent_state[$i]'  datatype='baifenshu'   value='$row->patent_state'/></td>";
		        echo "</tr>";*/
	var rows = document.getElementById("patent_list").rows.length ;
	$val=rows/2;
	$count=rows/2+1;
	var newTr = "<tr>";
    newTr +="<th rowspan='2'><p align='center'>"+$count+"</p></th>";
    newTr +="<th><p align='center'>专利名称</p></th>";
	 newTr +="<td><input type='text' name=\"patent_name["+$val+"]\" /></td>";
	 newTr +="<td><th><p align='center'>类型</p></th></td>";
	 newTr +="<td><input type='text' name=\"patent_type["+$val+"]\" /></td>";
	 newTr  +="<td rowspan='2'><input type='button'  value='删除'  onclick='deleteTwoRow(this)'/></td>";
	 newTr  +="</tr>";
	 newTr  +="<tr>";
	newTr  +="<th><p align='center'>专利状态</p></th>";
	 newTr +="<td><input type='text' name=\"patent_state["+$val+"]\" /></td>";
	 newTr +="</tr>";
	$('#patent_list').append(newTr);	
}
function addLine2(){
	var rows = document.getElementById("produce").rows.length ;
	
	/*echo "<tr>";
	echo "<th ><p align='center'>1</p></th>";
	echo "<th><p align='center'>产品名称</p></th>";
	echo "<td><input type='text' name='produce_name[$i]'  datatype='baifenshu'   value='$row->produce_name'/></td>";

	echo "<th><p align='center'>产品水平</p></th>";
	echo "<td><select name='produce_level[$si]' value='$row->produce_level'>
			<option value='1'>国际领先</option>
			<option value='2'>国际先进</option>
			<option value='3'>国内领先</option>
			<option value='4'>国内先进</option>
			<option value='5'>填补国内空白</option>
			</select></td>";
	echo "<td><input type='button' value='删除' onclick='deleteRow(this)'/></td>";
	echo "</tr>";*/
	$count=rows+1;
	var newTr = "<tr>";
	 newTr +="<th ><p align='center'>"+$count+"</p></th>";
	 newTr +="<th><p align='center'>产品名称</p></th>";
	newTr +="<td><input type='text' name=\"produce_name["+rows+"]\" /></td>";
	newTr +="<th><p align='center'>产品水平</p></th>";
	 newTr +="<td><select name='produce_level["+rows+"]' ><option value='1'>国际领先</option><option value='2'>国际先进</option><option value='3'>国内领先</option><option value='4'>国内先进</option><option value='5'>填补国内空白</option></select></td>";
	 newTr  +="<td><input type='button'  value='删除'  onclick='deleteRow(this)'/></td>";
	$('#produce').append(newTr);	
}
function deleteRow(obj){
	var tbody = tr.parentNode;
	tbody.removeChild(tr);
}
function deleteTwoRow(obj){
	var tbody = $(obj).parents("tbody").first();
	$(obj).parent().parent().next().remove();
	$(obj).parent().parent().remove();
	var rows = tbody.children("tr").size()/2;
	var row = 0;
	var value = -1;
	tbody.children("tr").each(function(){
		if(row%2==0){
			value++;
			$(this).find("p").first().html(value+1);
		}
		$(this).find("input").each(function(){
			var name = $(this).prop("name");
			if(name!=""){
				var newName = name.split("[");
				newName[0] = newName[0] + "["+(value)+"]";
				$(this).prop("name",newName[0]);
			}
		});
		row++;
	});
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
				}else if(type == 'fax') {
					filter =  /^[0-9]{3}-[0-9]{8}$/;
				} else if(type == 'telephone') {
					filter = /^1\d{10}$/;
				} else if(type == 'postcode') {//6位的邮政编码
					filter = /^\d{6}$/;
				} else if(type == 'baifenshu') { 
					filter=/^(\d+(\.\d+)?)+(\%)?$/;
				}  else if(type == 'decimal') {//6位的邮政编码
					filter = /^\d+(\.\d+)?$/;
				} 
				else if(type == 'website') {//网址
					filter = /^((https?|ftp|news):\/\/)?([a-z]([a-z0-9\-]*[\.。])+([a-z]{2}|aero|arpa|biz|com|coop|edu|gov|info|int|jobs|mil|museum|name|nato|net|org|pro|travel)|(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]))(\/[a-z0-9_\-\.~]+)*(\/([a-z0-9_\-\.]*)(\?[a-z0-9+_\-\.%=&]*)?)?(#[a-z][a-z0-9_]*)?$/;
				}else if(type == 'chinese_characters') {//汉字
					filter  = /^[\u4e00-\u9fa5]*$/;
				} 
				if (!filter.test(txt)){
					alert('填写格式不正确,请重新填写');
					$(this).focus();
				}
			}
	});
}
