function loadWest(){
	$.post('/modules/php/action/page/center/center.act.php?action=isSuper',function(result){
		var res = eval("("+result+")");
//		alert(res.user_type);
		if(res.user_type == 3){
			$("#li1").css('display','block');
			$("#li2").css('display','block');
			$("#li3").css('display','block');
//			document.getElementById('body').className = 'easyui-layout'
		}
		else{
			if(res.department == 0){
				$("#li1").css('display','block');
			}
			else if(res.department == 1){
				$("#li2").css('display','block');
			}
			else if(res.department == 2){
				$("#li3").css('display','block');
			}
			else{
				
			}
		}
	});
}

function submitForm(){
	
	var local_tag = 0;
	
	/*if($("input[name='changeFile1']").is(':checked')||$("input[name='changeFile2']").is(':checked')){
		local_tag = 1;
	}*/
	
	var local_str = "p";
	var t_str = "t";
	
	$("input[name='Fruit']").each(function(){     
		if($(this).is(":checked"))     
		{     
			local_str += "|"+$(this).attr('value');
		}     
    });
	
	$("input[name='table_list']").each(function(){     
		if($(this).is(":checked"))     
		{     
			t_str += "|"+$(this).attr('value');
		}     
    });
	
	//get json for initialization
	$.ajax({
		url : "/center/php/action/page/project_type/control.php?action=create_define",
		data : {
			'ptname':$("input[name='ptname']").first().val(),
			'ptid':$(".pt_fid").find("option:selected").val(),
			'local_str':local_str,
			't_str':t_str
		},
		type : 'POST',
		async: false,
		dataType : 'json',
		success : function(data) {
			if(data.msgcode == 100){
				if (data.ret) {
                    //change to edit form
					if(local_tag){
						window.location.href = "?action=subtable";
					}else{
						window.location.href = "?action=admin";
					}
                }else{
                	
                }
			}else{
				alert("error");
			}
		},
		error : function(data) {
			//alert("修改失败，请重试，或联系管理员！");
		}
	});
	
}


function editForm(){
	
	var local_tag = 0;
	
	var local_str = "p";
	var t_str = "t";
	
	$("input[name='Fruit']").each(function(){     
		if($(this).is(":checked"))     
		{     
			local_str += "|"+$(this).attr('value');
		}     
    });
	
	$("input[name='table_list']").each(function(){     
		if($(this).is(":checked"))     
		{     
			t_str += "|"+$(this).attr('value');
		}     
    });
	
	//get json for initialization
	$.ajax({
		url : "/center/php/action/page/project_type/control.php?action=edit_define",
		data : {
			'ptname':$("input[name='ptname']").first().val(),
			'ptid':$(".pt_fid").find("option:selected").val(),
			'local_str':local_str,
			't_str':t_str
		},
		type : 'POST',
		async: false,
		dataType : 'json',
		success : function(data) {
			if(data.msgcode == 100){
				if (data.ret) {
                    window.location.href = "?action=admin";
                }else{
                	
                }
			}else{
				alert("error");
			}
		},
		error : function(data) {
			//alert("修改失败，请重试，或联系管理员！");
		}
	});
	
}

function clearForm(){
	
}

$(function(){
	loadWest();
});