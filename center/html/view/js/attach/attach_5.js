
/**
* 以下是自己添加
 */
var table_status = '';
var user_type = '';
var table_id = '';


$(function(){
	init();
});

$(window).resize(function(){
	resetWNH();					  
});

function init(){
//	alert();
	resetWNH();
	bindEvents();
	getAttr();
}

//获取参数
function getAttr(){
	$.post('/modules/php/action/page/attach/attach5.act.php?action=attach_attr&table_name=通州区支持创新平台建设项目申报书',function(result){
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
			$('.menu-bar').css('background-image','url(/website/html/view/img/main-xmsbxt/manage.png)');
		}
	});
	//这里是代替以前页面上的链接
	$('.org_info').bind('click',function(){
		$('.iframe iframe').attr('src','/website/html/view/template/apply/attach_5/org_info.html?status='+table_status);
	});
	
	$('.centeropinion').bind('click',function(){
		$('.iframe iframe').attr('src',"/center/php/action/page/check_opinion.php?table_name='通州区支持创新平台建设项目申报书'"+ "&user_type=" + user_type);
	});
}

function resetWNH(){
	$('.menusNiframe').height($(window).height());
	$('.iframe iframe').width($(window).width()-214);
	$('.iframe iframe').height($('.menusNiframe').height());
	
}
//以上是添加