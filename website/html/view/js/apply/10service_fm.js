function submit_data(){
	$('#service_fm').form('submit' ,{
		url: '../../../../../../extends/Table/api.php?action=save&subtable_id=1929',
		success: function(result){
			$.messager.alert('提示','　　　信息保存成功！','info',function(){
				var complete = completeInput();
				if(complete){

					window.parent.save_stage('service');
				}else{
					window.parent.update_stage('service');
				}
				window.parent.setStep('service',complete);
			});
		}
	});
}

function reset(){
$('#service_fm').form('reset');}

$(function()
  {

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

function completeInput() {
	var returnValue = true;
	$('input').each(function() {
		if(!$(this).val().trim()) {
			returnValue = false;
		}
	})
	$('textarea').each(function() {  
		if (!$(this).val().trim()) {
			returnValue = false;
		}
	})
	return returnValue;
}



$(function()
		{
		loadApplyInfo();
		$('#back').click(function() {
			$(window.parent.parent.document).find('iframe').attr('src',"../template/user_project.php");
		})
		});



function loadApplyInfo(){
	$.get('../../../../../../extends/Table/api.php?action=get&subtable_id=1929',
		function(result){
			if(result!='0'){
				var res=eval("("+result+")");
				$('#service_fm').form('load',res);
				initRadio();
			}
		});


	$('.save').bind('click',function(){ submit_data(); });
	$('.reset').bind('click',function(){
		window.location.reload();
	});
	checkRadio();

}


	function getQueryStringByName(name){
	    var result = location.search.match(new RegExp("[\?\&]" + name + "=([^\&]+)", "i"));
	    if (result == null || result.length < 1) {
	        return "";
	    }
	    return result[1];
	}

//用来处理按钮的函数
function checkRadio(){
	$("input[type='radio']").click(function(){
		var obj = $(this);//alert(obj.prop("name"));
		if(obj.prop("id")=="serve"){
			if(obj.val()=="0"){
				obj.parents("tr").find("input").prop("disabled","disabled");
				obj.parents("tr").find("input").prop("checked",false);
				obj.prop("checked",true);
				obj.prop("disabled","");
				obj.siblings().prop("disabled","");
				obj.parents("tr").find("input[type='hidden']").prop("value","0")
			}else{
				obj.parents("tr").find("input").prop("disabled","");
				obj.siblings().prop("checked",false);
				obj.parent().find("input:last").prop("value","1")
			}
		}else if(obj.prop("id")=="charge"){
			if(obj.val()=="0"){

				obj.siblings().prop("checked",false);
				obj.parent().find("input:last").prop("value","0")
			}else{
				obj.siblings().prop("checked",false);
				obj.parent().find("input:last").prop("value","1")
			}
		}else if(obj.prop("id")=="self"){
			obj.parents("tr").find("input#coop").prop("checked",false);
			obj.parents("tr").find("input#coop").siblings().prop("value",0);
			obj.siblings().prop("value","1");

		}else{
			obj.parents("tr").find("input#self").prop("checked",false);
			obj.parents("tr").find("input#self").siblings().prop("value",0);
			obj.siblings().prop("value","1");
		}
	});
}
//初始化按钮操作
function initRadio(){
	$("input[type='hidden']").each(function (){
		var obj = $(this);
		if(obj.prop("value")=="1"){
			if(obj.siblings("input").length>1){
				obj.siblings("input").filter("[value='1']").prop("checked",true);
			}else{
				obj.siblings("input").prop("checked",true);
			}
		}else{
			if(obj.siblings("input").length>1){
				var temp =obj.siblings("input").filter("[value='0']");
				if(temp.prop("id")=="serve"){
					temp.parents("tr").find("input").prop("checked",false);
					temp.parents("tr").find("input").prop("disabled","disabled");
					temp.prop("checked",true);
					temp.prop("disabled","");
					temp.siblings().prop("disabled","");
					temp.parents("tr").find("input[type='hidden']").prop("value","0")
				}else{
					temp.prop("checked",true);
				}
			}else{
				obj.siblings("input").prop("checked",false);
			}
		}
	});

}