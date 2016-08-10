 function submit_data() {
	$('#9org_info_fm').form('submit',
					{url : '/modules/php/action/page/applycation/apply9.act.php?action=9orgInfo',
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

$(function() {
	loadApplyInfo();
	dateplu();
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
	$(".ismake_radio").change(function(){
		var selectedvalue = $("input[name='ismake']:checked").val();
		if(selectedvalue == '是') {
			$(".maked_name").attr("disabled",false);
			$(".maked_name").focus();
		} else {
			$(".maked_name").attr("disabled",true);
			$(".maked_name").val(null);
		}
	});
});


function loadApplyInfo() {
	$.get('/modules/php/action/page/applycation/apply9.act.php?action=9findOrgInfo',
					function(result) {
						if (result != '0') {
							var res = eval("(" + result + ")");
							if(res.ismake == '否'){
								$('.maked_name').attr({'disabled':'true'});
							}
							$('#9org_info_fm').form('load', res);
//							$('.ismake_radio_1').attr({"checked":"checked"});
							if(res.org_type != "事业单位" && res.org_type != "国有资本控股的有限公司" && res.org_type != "国有独资企业" &&res.org_type != "民营资本为主的有限公司") {
								$("#other_in11").prop("checked","checked");//使用prop代替attr
								$("#other_in1").val(res.org_type);
								$("#other_in1").prop("disabled",false);
								
							}
							if(res.investment != "国有企业" && res.investment != "民营企业" && res.investment != "大学" && res.investment != "研究院所" && res.investment != "政府" && res.investment != "投资机构" && res.investment != "自然人") {
								$("#other_in22").prop("checked","checked");
								$("#other_in2").val(res.investment);
								$("#other_in2").prop("disabled",false);
								
							}
							if(res.service_type != "综合型") {
								$("#other_in33").prop("checked","checked");
								$("#other_in3").val(res.service_type);
								$("#other_in3").prop("disabled",false);
								
							}
							
							 
						}
					});

	
	
	$('.save').bind('click',function(){
		var txt1 = $("#other_in1").val().trim();
		var txt2 = $("#other_in2").val().trim();
		if(txt1) {
			$("#other_in11").val(txt1);
		}
		if(txt2) {
			$("#other_in22").val(txt2);
		}
		submit_data(); 
	});
	
	$('.reset').bind('click',function(){
		window.location.reload();
	});
}
/**
 * 这个方法是判断是不是所有的 信息都填写完了 然后进一步设置是不是显示小对勾
 * 
 * @returns {Boolean}
 */
function completeInput() {
	var returnValue = true;
	$('input').not(':disabled').each(function() {
		if (!$(this).val().trim()) {
			returnValue = false;
		}
	})
	return returnValue;
}


function addLine() {  
	var rows = addtable.rows.length ;
	var newTr = "<tr>";
	newTr +="<td width='40%'><input type='text' name=\"shareholder_name[" + rows+ "]\" /></td>";
	 newTr +="<td width='40%'><input type='text'  datatype='float'   name=\"stock_ratio[" + rows+ "]\" /></td>";
	 newTr  +="<td><input type='button' value='删除' class='pointer but' onclick='delLine(this)'/></td>";
	$('#addtable').append(newTr);
	//addRequire();
	//validation();
}



 function delLine(obj) {
	 var tbody = $(obj).parents("tbody");//不可调换位置
	 var tr = obj.parentNode.parentNode;
	 var tbody = tr.parentNode;

	 var row = 0;//两个表头
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
		 }
		 row++;
	 });
	 tbody.removeChild(tr);
 }

function getQueryStringByName(name){
    var result = location.search.match(new RegExp("[\?\&]" + name + "=([^\&]+)", "i"));
    if (result == null || result.length < 1) {
        return "";
    }
    return result[1];
}