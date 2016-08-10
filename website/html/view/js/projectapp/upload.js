var table_status = '';
var user_type = '';
$(function(){
	getAttr();
	$('#back').click(function(){
		root = $(window.parent.parent.document).get(0).location.pathname;
//		alert(root)
		reg = /website/;
		result = root.search(reg);
		//alert(result)
		//前台
		if(result != -1){
			$.get('/website/html/view/template/uploadFile_genious.php',function(result){
				if(result == '1'){
					$(window.parent.parent.document).find('iframe').attr('src',"../template/user_project_genious.php");
				}else{
					$(window.parent.parent.document).find('iframe').attr('src',"../template/user_project.php");
				}
			});
		}
		//后台
		else{
			$(window.parent.parent.document).find('iframe').attr('src',"/center/php/action/page/approve.php");
		}
	});

});

function getQueryStringByName(name){
	var result = location.search.match(new RegExp("[\?\&]" + name + "=([^\&]+)", "i"));
	if (result == null || result.length < 1) {
		return "";
	}
	return result[1];
}

function getAttr() {
	
	var table_id = '';
	table_id = getQueryStringByName('table_id');
//	var table_name = encodeURI("北京市通州区科技计划项目实施方案");
//	$.post('/modules/php/action/page/attach/attach1.act.php?action=attach_attr&table_name='+table_name,function(result){
	$.post('/modules/php/action/page/attach/attach1.act.php?action=attach_attr&table_id=' + table_id, function (result) {
		var res = eval("(" + result + ")");
		table_status = res.table_status;
		user_type = res.user_type;
		$(".org_info").click();
		//科委  科长  super
		if (user_type == 1 || user_type == 2 || user_type == 3) {
			//后台什么时候显示 审核？
			if (table_status >= 2) {
				$('.check').css({display: 'block'});
			}
			$('.upload_block').css({display:'none'});
		}

		//是申报用户  后台生成用户
		if (user_type == 0 || user_type == -1) {
			//待提交

			if (table_status == 1){

				$('.submit').css({display: 'block'});
				$('.check').css({display: 'none'});
				$('.upload_block').css({display: 'block'});
			}
			//或者驳会修改
			else if (table_status == 3) {
				$('.submit').css({display: 'block'});
				$('.check').css({display: 'block'});
				$('.upload_block').css({display: 'block'});
			}
			else {
				$('.upload_block').remove();
				$('.showAttach').css('display', 'none');
				$('.upload_block').css({display: 'none'});
			}
		}
		var iscomplete = eval("(" + res.iscomplete + ")");
		var i = 0;
		$('ul li').each(function () {
			if (iscomplete.length > i && iscomplete[i] == 1) {
				$(this).children('.pic').show();
			}
			i++;
		});
	});
}