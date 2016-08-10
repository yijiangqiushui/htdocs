// JavaScript Document

$(function(){
	init();
});

$(window).resize(function(){
	resetWNH();					  
});

function init(){
	resetWNH();
	bindEvents();
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
			if(i==1){
				$('.submenu').css('display','block');
			//	$('.iframe iframe').attr('src','user_info.php');
			}
			else{
				$('.submenu').css('display','none');
				$('.iframe iframe').attr('src','userlist.php');
			}
		}); 
	});
	$('.submenu-modifypwd').bind('click',function(){
	    $('.iframe iframe').attr('src','./userinfo/changpwd.html');
	 });
	$('.submenu-userinfo').bind('click',function(){
		$('.iframe iframe').attr('src','./userinfo/logininfo.html');
	
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
}

function resetWNH(){
	$('.menusNiframe').height($(window).height());
	$('.iframe iframe').width($(window).width()-214);
	$('.iframe iframe').height($('.menusNiframe').height());
	
}