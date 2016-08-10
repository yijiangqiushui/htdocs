function org_info(){
	$('#org_info').form('submit',{
		url:'/modules/php/action/page/projectapp/projectapp.act.php?action=patent3_orginfo',
		success:function(result){
			$.messager.alert('提示','信息保存成功！','info',function(){
			//judge whether this table has been finished
			var complete = completeInput();   
			if(complete) {
				//call save_stage
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
	birth_day()
	loadApplyInfo();
	dateplu();
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
});

function completeInput() {
	var returnValue = true;
	$("input[type='text']").each(function() {
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
		return false;
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
	$.get('/modules/php/action/page/projectapp/projectapp.act.php?action=findpatent3_org',
					function(result) {
						if (result != '0') {
							var res = eval("(" + result + ")");
							$('#org_info').form('load', res);
						}
						
					});
	
	$('.save').bind('click',function(){ org_info(); });
	$('.reset').bind('click',function(){
		window.location.reload();
	});
}


function AddSignRow(){
	var rol = tbl.rows.length - 1;
	var newTr = "<tr>";
	newTr += "<td colspan=\"6\"><input type=\"text\" name=\"main_product["+rol+"]\"/></td>";
	newTr += "<td colspan=\"2\"><input type=\"text\" name=\"sale_ratio["+rol+"]\" datatype=\"float\"/></td>";
	newTr += "<td><input type='button' value='删除' class='pointer but' onclick='delRow(this)';/></td>";
	newTr += "</tr>";
	$('#tbl').append(newTr);
	//validation();
}
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
		}
		row++;
	});
}
