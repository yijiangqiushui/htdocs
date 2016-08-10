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
	
	timer1= setInterval(checkLogin,3000);
	
	$('.menu').each(function(i){
		$(this).bind('click',function(){
			$('.menu').removeClass('menu-selected');
			$('.menu').addClass('menu-unselected');
			$(this).removeClass('menu-unselected');
			$(this).addClass('menu-selected');
			if(i==1){
				$('.myproject').css('display','block');
				$('.userinfo').css('display','none');
			}
			else if(i==2)
			{
				$('.myproject').css('display','none');
			    $('.userinfo').css('display','block');
			}
			else{
				$('.myproject').css('display','none');
				$('.userinfo').css('display','none');
				$('.iframe iframe').attr('src','./myproject/uncompleted.php');
				changeNav('我的项目', './myproject/uncompleted.php');
			}
		}); 
	});
	$('.new-project').bind('click',function(){
	    $('.iframe iframe').attr('src','/website/html/view/template/show.php');
		changeNav($(this).text(), '/website/html/view/template/show.php');
	 });
	$('.submenu-uncompleted').bind('click',function(){
		$('.submenu-completed').removeClass('selected-color');
		$('.submenu-userinfo').removeClass('selected-color');
		$('.submenu-cominfo').removeClass('selected-color');
		$('.submenu-modifypwd').removeClass('selected-color');
		$(this).addClass('selected-color');
		$id = getQueryStringByName('user_id');
	    $('.iframe iframe').attr('src','./myproject/completed.php?user_id='+$id);
		changeNav($(this).text(), 'myproject/completed.php');
	 });
	$('.submenu-completed').bind('click',function(){
		$('.submenu-uncompleted').removeClass('selected-color');
		$('.submenu-userinfo').removeClass('selected-color');
		$('.submenu-cominfo').removeClass('selected-color');
		$('.submenu-modifypwd').removeClass('selected-color');
		$(this).addClass('selected-color');
		$('.iframe iframe').attr('src','./myproject/uncompleted.php');
		changeNav($(this).text(), 'myproject/uncompleted.php');
	 });
	$('.submenu-modifypwd').bind('click',function(){
		$('.submenu-userinfo').removeClass('selected-color');
		$('.submenu-cominfo').removeClass('selected-color');
		$('.submenu-uncompleted').removeClass('selected-color');
		$('.submenu-completed').removeClass('selected-color');
		$(this).addClass('selected-color');
		$('.iframe iframe').attr('src','./userinfo/changpwd.html');
		changeNav($(this).text(), 'userinfo/changpwd.html');
	 });
	$('.submenu-userinfo').bind('click',function(){
		$('.submenu-modifypwd').removeClass('selected-color');
		$('.submenu-cominfo').removeClass('selected-color');
		$('.submenu-uncompleted').removeClass('selected-color');
		$('.submenu-completed').removeClass('selected-color');
		$(this).addClass('selected-color');
		$('.iframe iframe').attr('src','./userinfo/logininfo.html');
		changeNav($(this).text(), 'userinfo/logininfo.html');
	});
	$('.submenu-cominfo').bind('click',function(){
		$('.submenu-userinfo').removeClass('selected-color');
		$('.submenu-modifypwd').removeClass('selected-color');
		$('.submenu-uncompleted').removeClass('selected-color');
		$('.submenu-completed').removeClass('selected-color');
		$(this).addClass('selected-color');
		$('.iframe iframe').attr('src','./userinfo/userinfo.html');
		changeNav($(this).text(), 'userinfo/userinfo.html');
	});
	$('#switch1').bind('click',function(){
		var iframe_width = $("#iframe1").width();
		var subiframe_width = $(window.frames["mainframe"].document).find("#iframe2").width();
		if($('.menus').css('display')!='none'){
			$('.menus').css('display','none');
			$('.menu-bar').css('display','none');
			$('.menu-bar').css('background-image','url(../../url)');
			$('.iframe').css('margin-left','10px');
			$('#iframe1').css('width',iframe_width+200);
			$(window.frames["mainframe"].document).find("#iframe2").width(subiframe_width+200);
		}
		else{
			$('.menus').css('display','block');
			$('.menu-bar').css('display','block');
			$('.menu-bar').css('background-image','url(/website/html/view/img/main-xmsbxt/manage.png)');
			$('.iframe').css('margin-left','210px');
			$('#iframe1').css('width',iframe_width-200);
			$(window.frames["mainframe"].document).find("#iframe2").css('width',subiframe_width-200);
		}
	});
	
	$('.exit').bind('click',function(){
		$.post("../../../php/action/page/main.act.php?action=logout",function(result){
			if(result.type == "success"){
			//	window.location.href = "http://kw.bjtzh.gov.cn/PBindex.html";
				window.location.href = "/website/html/view/template/index.php";
			}
			else{
				alert("系统出错！");
			}
		},'json');
	});
	$.get("../../../php/action/page/main.act.php?action=c_user",function(result){
		var show = "欢迎您，" + result.org_name + " 的用户，" + result.username;
		$('.welcome').text(show);
	},'json');
	$('.submenu-uncompleted').click();
	$('.myproject').css('display','block');
	
}

//需要判断当前的用户是不是一直是前台的用户
function checkLogin(){
	$.get('../../../php/action/page/main.act.php?action=checklogin',function(result){
		var res = JSON.parse(result);
		if(res.code == "exit"){
			alert("您不能使用同一个浏览器登录后台系统！请重新登录系统");
			window.location.href = 'index.php';
		}else if(res.code == "nologin"){
			alert("您还没有登录，请登陆系统后在进行操作！");
			window.location.href = "index.php";
		}
	});
}

function resetWNH(){
	$('.menusNiframe').height($(window).height()-116);
	//$('.iframe iframe').width($(window).width()-214);
	$('.iframe iframe').height($('.menusNiframe').height());
	
}

function changeNav(name, link) {
	$('#nav-link').text(name);
	$('#nav-link').attr('href', link);
}

function getQueryStringByName(name){
    var result = location.search.match(new RegExp("[\?\&]" + name + "=([^\&]+)", "i"));
    if (result == null || result.length < 1) {
        return "";
    }
    return result[1];
}