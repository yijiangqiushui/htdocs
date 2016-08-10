function unit_info(){
	$('#improve').form('submit',{
		url:'../../../../../../../modules/php/action/page/lmcheck_material/check_material.act.php?action=save_improve',
		success:function(result){
			$.messager.alert('提示','信息保存成功！','info',function(){
			var complete = completeInput();   
			if(complete) {
				window.parent.save_stage('improve');
			}else{
				window.parent.update_stage('improve');
			}
			window.parent.setStep('improve',complete);
			});
		}
	});
	
}
$(function() {
	loadApplyInfo();
	//the first one
	$equipment_name = $("input[name^='equipment_name[']");
    $equipment_num =$("input[name^='equipment_num[']");
    $equipment_price =$("input[name^='equipment_price[']");
    $equipment_fund =$("input[name^='equipment_fund[']");

    $("input[name^='equipment_num['],input[name^='equipment_price[']").change(function(){
    	 $equipment_name.each(function(i) {
    		 $equipment_fund[i].value=($equipment_num[i].value)*($equipment_price[i].value);
       
   	 });
    });	
   //the second one
    $test_name =$("input[name^='test_name[']");
    $test_num =$("input[name^='test_num[']");
    $test_price =$("input[name^='test_price[']");
    $test_fund =$("input[name^='test_fund[']");
    
    $("input[name^='test_num['],input[name^='test_price[']").change(function(){
   	 $test_name.each(function(i) {
   		 $test_fund[i].value=($test_num[i].value)*($test_price[i].value);
      
  	 });
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
	$.get('../../../../../../../modules/php/action/page/lmcheck_material/check_material.act.php?action=find_improve',
					function(result) {
						if (result != '0') {
							var res = eval("(" + result + ")");
							$('#improve').form('load', res);
						}
						
					});
	
		$('.save').bind('click',function(){ unit_info(); });
		$('.reset').bind('click',function(){
			window.location.reload();
		});
	
}

function addLine(){
	var rows = document.getElementById("equipment_list").rows.length-1 ;
	var count=rows+1;
   var newTr = "<tr>";
    newTr +="<th ><p align='center'>"+count+"</p></th>";
	 newTr +="<td><input type='text' name=\"equipment_name["+rows+"]\" /></td>";
	 newTr +="<td><input type='text' name=\"equipment_num["+rows+"]\" datatype='number' placeholder='请输入整数'/></td>";
	 newTr +="<td><input type='text' name=\"equipment_price["+rows+"]\" datatype='float' placeholder='请输入整数或小数'/></td>";
	 newTr +="<td><input type='text' name=\"equipment_fund["+rows+"]\" readonly placeholder='无需填写,自动计算,数量*单价'/></td>";
	 newTr  +="<td  ><input type='button'  value='删除'  class='pointer'  onclick='deleteRow(this)'/></td>";
	 newTr  +="</tr>";
	$('#equipment_list').append(newTr);	
	//validation();
	
	//call auto add
	$equipment_name = $("input[name^='equipment_name[']");
    $equipment_num =$("input[name^='equipment_num[']");
    $equipment_price =$("input[name^='equipment_price[']");
    $equipment_fund =$("input[name^='equipment_fund[']");

    $("input[name^='equipment_num['],input[name^='equipment_price[']").change(function(){
    	 $equipment_name.each(function(i) {
    		 $equipment_fund[i].value=($equipment_num[i].value)*($equipment_price[i].value);
       
   	 });
    });	
    
    
    
}
function addLine2(){
	var rows = document.getElementById("instrument_list").rows.length-1 ;
	$count=rows+1;
	var newTr = "<tr>";
	 newTr +="<th ><p align='center'>"+$count+"</p></th>";
	newTr +="<td><input type='text' name=\"test_name["+rows+"]\" /></td>";
	newTr +="<td><input type='text' name=\"test_num["+rows+"]\" datatype='number' placeholder='请输入整数'/></td>";
	newTr +="<td><input type='text' name=\"test_price["+rows+"]\" datatype='float' placeholder='请输入整数或小数'/></td>";
	newTr +="<td><input type='text' name=\"test_fund["+rows+"]\" placeholder='不需输入，自动计算，数量*单价' readonly/></td>";
	 newTr  +="<td><input type='button'  value='删除' class='pointer'  onclick='deleteRow(this)'/></td>";
	$('#instrument_list').append(newTr);	
	//validation();
	
	 $test_name =$("input[name^='test_name[']");
	    $test_num =$("input[name^='test_num[']");
	    $test_price =$("input[name^='test_price[']");
	    $test_fund =$("input[name^='test_fund[']");
	    
	    $("input[name^='test_num['],input[name^='test_price[']").change(function(){
	   	 $test_name.each(function(i) {
	   		 $test_fund[i].value=($test_num[i].value)*($test_price[i].value);
	      
	  	 });
	   });	
}
function deleteRow(obj){
	var tbody = $(obj).parents("tbody");//不可调换位置
	var tr = obj.parentNode.parentNode;
	var tbody = tr.parentNode;
	tbody.removeChild(tr);
	var row = 0;
	$(tbody).children("tr").each(function () {
		if (row != 0) {
			$(this).find("p").first().html(row);
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
			    if(type == 'number') {
					filter  = /^\d+$/;
				}else if(type == 'bignumber') {//汉字
					filter  = /^[0-9]+([.]{1}[0-9]+){0,1}$/;
				} 
				if (!filter.test(txt)){
					alert('填写格式不正确,请重新填写');
					$(this).focus();
				}
			}
	});
}

