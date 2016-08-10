
/**
 * 我写的 是下边
 */
var table_status = '';
var user_type = '';

$(function(){
	init();
});

$(window).resize(function(){
	resetWNH();					  
});

function init(){
	resetWNH();
	bindEvents();
	getAttr();
}

//获取参数
function getAttr(){
	var table_name = encodeURI('北京市通州区科技计划项目调整申请表');
	$.post('/modules/php/action/page/user_project/modify_solution.act.php?action=attach_attr&table_name='+table_name,function(result){
	    	var res = eval("("+result+")");
//	    	alert();
	    	table_status = res.table_status;
	    	user_type = res.user_type;
	});

}
function bindEvents(){
	$('.my-project').bind('click',function(){
		$('.iframe iframe').attr('src','userlist.php');
	});
	$('.menu').each(function(i){
		$(this).bind('click',function(){
			$('.menu').removeClass('menu-selected');
			$('.menu').addClass('menu-unselected');
			$(this).removeClass('menu-unselected');
			$(this).addClass('menu-selected');
		}); 
	});
	$('.switch-bar').bind('click',function(){
		if($('.menus').css('display')!='none'){
			$('.menus').css('display','none');
			$('.menu-bar').css('display','none');
			$('.menu-bar').css('background-image','url(../../url)');
		}
		else{
			$('.menus').css('display','block');
			$('.menu-bar').css('display','block');
			$('.menu-bar').css('background-image','url(../../url)');
		}
	});
	
	$('.org_info').bind('click',function(){
		$('.iframe iframe').attr('src','/website/html/view/template/Implement/modify_apply.php?status='+table_status);
	});
	$('.centercehck').bind('click',function(){
		$('.iframe iframe').attr('src',"/center/php/action/page/check_opinion.php?status="+table_status+"&table_name='北京市通州区科技计划项目调整申请表'" + "&user_type=" + user_type);
	});
	
}

function resetWNH(){
	$('.menusNiframe').height($(window).height());
	$('.iframe iframe').width($(window).width()-214);
	$('.iframe iframe').height($('.menusNiframe').height())
	;}
	
//上边是我写的