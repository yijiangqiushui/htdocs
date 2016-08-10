//function show_save(user_type,table_status){
document.write('<script type="text/javascript" src="/common/html/js/common.js"></script>');
var user_type;
var table_status;
function show_save(){
	if (user_type == 1 || user_type == 2 || user_type == 3) {
		if(getDepartment() != 3){
			if(table_status == 2){
				$('.button_wrapper').css('display', 'block');
			}else{
				inputTextRead();
			}
		}else{
			inputTextRead();
		}
	}
	if(user_type == 0 || user_type == -1){
	    if(table_status == 1  ||  table_status == 3)
	    {
	        $('.button_wrapper').css('display','block');
	    }else{
	    	//設置其為只讀的狀態。
	    	inputTextRead();
	    }
	}
}

function wt_add() {
	var total = 0;
	for (var i = 0; i < arguments.length; ++i) {
		total = parseInt(parseFloat(total * 100000 + arguments[i] * 100000).toFixed(0)) / 100000;
	}

	return total;
}

function inputTextRead(){
	var inputN = document.getElementsByTagName("input");
	for(i = 0;i<inputN.length;i++){
		inputN[i].setAttribute("disabled","true");
	}
	var txtN = document.getElementsByTagName("textarea");
	for(i = 0;i<txtN.length;i++){
		txtN[i].setAttribute("disabled","true");
	}
	var inputN = document.getElementsByTagName("select");
	for(i = 0;i<inputN.length;i++){
		inputN[i].setAttribute("disabled","true");
	}
}

$(function(){
	init();
	backBind();
	shieldReadOnly();
});

function init(){
	user_type = decodeURI(getQueryStringByName('user_type'));
	table_status = decodeURI(getQueryStringByName('table_status'));
	show_save();
}

function shieldReadOnly(){
	$("input[readOnly]").keydown(function(e) {
        e.preventDefault();
    });
	
	$("textarea[readOnly]").keydown(function(e){
		e.preventDefault();
	});
}


//绑定返回按钮
function backBind(){
	$('#back').click(function() {
		//后台
		var flag = getQueryStringByName("is_edit");
		$.post('/website/html/view/template/backbind.php',function(result){
			var data = $.parseJSON(result);
			if(data.code == '1'){
				if(flag==""){
					window.parent.location = "/center/php/action/page/approve.php";
				}else{
					window.parent.location = "/center/php/action/page/project_type/admin.php";
				}

			}else{
				if(parent.table_id == '19' || parent.table_id == '20'){
					$(window.parent.parent.document).find('iframe').attr('src',"../template/user_project_genious.php");
				}else{
					$(window.parent.parent.document).find('iframe').attr('src',"../template/user_project.php");
				}
				
			}

		});
//		if(user_type > 0){
//			//2月23号晚测super用户user_type=0.
//			window.parent.location = "/center/php/action/page/approve.php";
//		}else{    //前台
//			$(window.parent.parent.document).find('iframe').attr('src',"../template/user_project.php");
//		}
//	});
	});
}
function getQueryStringByName(name){

	var result = location.search.match(new RegExp("[\?\&]" + name + "=([^\&]+)", "i"));
	alert(location);
	if (result == null || result.length < 1) {
		return "";
	}
	return result[1];
}



