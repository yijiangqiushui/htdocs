
/**
 * 自己加的
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
	$.post('/modules/php/action/page/attach/attach10.act.php?action=attach_attr&table_name=通州区支持科技服务机构发展项目申报书',function(result){
	    	var res = eval("("+result+")");
	    	table_status = res.table_status;
	    	user_type = res.user_type;
	});
}
function bindEvents(){
	var table_status;
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
		$('.iframe iframe').attr('src','/website/html/view/template/apply/attach_10/org_info.php?status='+table_status);
	});
	$('.service_team').bind('click',function(){
		$('.iframe iframe').attr('src','/website/html/view/template/apply/attach_10/service_team.html?status='+table_status);
	});
	$('.manager').bind('click',function(){
		$('.iframe iframe').attr('src','/website/html/view/template/apply/attach_10/manager.html?status='+table_status);
	});
	$('.service').bind('click',function(){
		$('.iframe iframe').attr('src','/website/html/view/template/apply/attach_10/service.html?status='+table_status);
	});
	$('.centercheck').bind('click',function(){
		$('.iframe iframe').attr('src',"/center/php/action/page/check_opinion.php?status="+table_status+"&table_name='通州区支持科技服务机构发展项目申报书'" + "&user_type=" + user_type);
	});
}

function resetWNH(){
	$('.menusNiframe').height($(window).height());
	$('.iframe iframe').width($(window).width()-214);
	$('.iframe iframe').height($('.menusNiframe').height());
	
}
//上边是自己加的
