// JavaScript Document
var timer1;
$(window).resize(function() {
	//$('.wrapper').text($(window).width()+" "+$(window).height());
	resetElementsSize();
});

$(document).ready(function(){
	
	//需要获取链接中的值
	
	$.post("../../../php/action/page/main.php?action=init",function(result){
		if(result.type=='success'){
			clearInterval(timer1);
//			20151105  取消了其自动定时验证登录的功能
//			timer1=setInterval(checkLastTime,3000);
				
			document.title=SYSTEM.name;
			//$('title').text(SYSTEM.name);//设置页面标题
			//$('.copyright').html(SYSTEM.copyright);//设置版权文字
			$.get('../../../php/action/page/main.php?action=cur_user',function(res){
				var a=res.split('{|}');
				//$('#cur_user').text(a[0]);
				$('#cur_user').text(a[5]);
				$('#catName').text(a[1]);
			});
			$('#logout').bind('click',function(){
				$.post("../../../php/action/page/main.php?action=logout",function(result){
					switch(result.type){
						case 'success':
//							window.location.href=SETTINGARGS.logout_link;break;
							window.location.href="../../../../../../center/html/view/template/index.html";break;
						default:alert('提示：系统发生错误，请联系技术人员进行处理！');
					}
				},"json");
			});
			$('#sys_home').bind('click',function(){$('.position span').text('系统首页 >');});
			$('#web_home').attr({'href':SETTINGARGS.head_link.web_home,'target':'_blank'});
			$('#product_home').attr({'href':SETTINGARGS.head_link.product_home,'target':'_blank'});
			$('#help').attr({'href':SETTINGARGS.head_link.help});
			MENUARR=result.menu;
			initModules();
			resetElementsSize();			
			
			$('#slfSubmit').bind('click',function(){//屏幕解锁
				if($.trim($('#slfPWD').val())==''){
					alert('提示：请输入密码！');
					return false;
				}
				$.post("../../../php/action/page/main.php?action=unlck_scr",{slfPWD:$.trim($('#slfPWD').val())},function(result){
					switch(result.type){
						case 'incorrect':alert('提示：密码输入错误，请重新输入！');break;
						case 'forbidden':alert('提示：该用户已被禁止使用！');break;
						case 'data_err':alert('提示：数据库发生错误，请联系技术人员进行处理！');break;
						case 'success':
							$('.screenLock_bg').css('display','none');
							$('.screenLock_pwd').css('display','none');break;
						default:alert('提示：系统发生错误，请联系技术人员进行处理！');
					}
				},'json');
			});
			
			$('#lockScrBtn').bind('click',function(){//屏幕上锁
				lockScreen();
			});
			if(result.locked){
				lockScreen();
			}
		
		}
		
		//
		else if(result.type=='forbidden'){
			$('body').html('');
			alert('提示：您还未登录或已经超时退出，请重新登录！');
//			window.location.href='index.html';
			window.location.href='../../../../../../center/html/view/template/index.html';
		}
		else{
			$('body').html('');
			alert('提示：系统发生错误，请联系技术人员进行处理！');
		}
	},'json');
});

//锁屏
function lockScreen(){
	$('#slfPWD').val('');
	$('.screenLock_bg').css('display','block');
	$('.screenLock_pwd').css('display','block');
	$.post("../../../php/action/page/main.php?action=lck_scr",function(result){});
}
//初始化菜单
function initModules(){
	var menu_html='<ul class="clear">';
	for(var i=0;i<MENUARR.length;i++){
		menu_html+='<li id="nav_'+i+'" style="display:'+MENUARR[i].show+'" onmouseover="show_submenu('+i+');" onmouseout="hide_submenu('+i+');"><span class="Darrow"></span><div class="nav-menu" onmouseover="show_menu('+i+');" onmouseout="hide_menu('+i+');">'+MENUARR[i].menu_name+'</div><dl><dt><span class="arrow"></span></dt>';
		for(var k=0;k<MENUARR[i].submenu_arr[0].item_arr.length;k++){
			if(MENUARR[i].submenu_arr[0].item_arr[k].show=='none') continue;
			
			var href = MENUARR[i].submenu_arr[0].item_arr[k].target;
			if (href.indexOf('http://') != -1) {
				menu_html+='<dd><a href="'+MENUARR[i].submenu_arr[0].item_arr[k].target+'" target="_blank" onclick="chgeSubmenuItemStyle(this,'+i+','+k+')">'+MENUARR[i].submenu_arr[0].item_arr[k].item_name+'</a></dd>';
			} else {
				menu_html+='<dd><a href="'+MENUARR[i].submenu_arr[0].item_arr[k].target+'" target="'+SETTINGARGS.target_frame+'" onclick="chgeSubmenuItemStyle(this,'+i+','+k+')">'+MENUARR[i].submenu_arr[0].item_arr[k].item_name+'</a></dd>';
			}
		}
		menu_html+='</dl></li>';
	}
	menu_html+='</ul>';
		$('.nav').prepend(menu_html);
}

//鼠标移至菜单上方事件事件
function show_menu(index){
	$('#nav_'+index+' .Darrow').css({'border-color':'transparent transparent #FFF transparent','margin':'7px 10px 0 0'});
	$('.nav li dd').css({'display':'block'});
}

//鼠标移出菜单上方事件事件
function hide_menu(index){
	if($('#nav_'+index+' .nav-menu').css('color')=='rgb(0, 114, 255)'){
		$('#nav_'+index+' .Darrow').css({'border-color':'#0072ff transparent transparent transparent','margin':'12px 10px 0 0'});
	}else{
		$('#nav_'+index+' .Darrow').css({'border-color':'#FFF transparent transparent transparent','margin':'12px 10px 0 0'});
	}
	//$('.nav li dd').css({'display':'none'});
}
//鼠标移至子菜单上方事件事件
function show_submenu(index){
	$('.nav li dd').css({'display':'block'});
}

//鼠标移出子菜单上方事件事件
function hide_submenu(index){
	$('.nav li dd').css({'display':'none'});
	return;
	if($('#nav_'+index+' .nav-menu').css('color')=='rgb(0, 114, 255)'){
		$('#nav_'+index+' .Darrow').css({'border-color':'#0072ff transparent transparent transparent','margin':'12px 10px 0 0'});
	}else{
		$('#nav_'+index+' .Darrow').css({'border-color':'#FFF transparent transparent transparent','margin':'12px 10px 0 0'});
	}
	//$('.nav li dd').css({'display':'none'});
}

/**
*设置左侧菜单选中项的样式
*/
function chgeSubmenuItemStyle(obj,i,k){
	$('.nav-menu').css({'color':'#fff','background-image':'url(../img/nav_bg1.png)'});
	$('.Darrow').css({'border-color':'#FFF transparent transparent transparent','margin':'12px 10px 0 0'});
	$('#nav_'+i+' .nav-menu').css({'color':'#0072ff','background-color':'#e2e9ea','background-image':'url()'});
	$('#nav_'+i+' .Darrow').css({'border-color':'transparent transparent #0072ff transparent','margin':'7px 10px 0 0'});
	//$('.position span').text(MENUARR[i].menu_name+' >'+MENUARR[i].submenu_arr[0].item_arr[k].item_name+' >');
	$('.position span').html(MENUARR[i].menu_name+"><a class='lm' href='"+MENUARR[i].submenu_arr[0].item_arr[k].target+"'"+" target='"+SETTINGARGS.target_frame+"'  text-decoration='none'>"+ MENUARR[i].submenu_arr[0].item_arr[k].item_name+"</a>");
	$('.nav li dd').css({'display':'none'});
}

/**
*页面尺寸随着浏览器改变时相应地改变相关元素
*/
function resetElementsSize(){
	$('.adminInfo').width(($(window).width()-$('.logo').width())-40);
	$('.body').height($(window).height()-SETTINGARGS.head_height-10);
	$('.body').width($(window).width());	
	$('.targetFrame').width($(window).width()-SETTINGARGS.menu_width);
	$('.targetFrame .iframe').css({'width':($('.targetFrame').width()-SETTINGARGS.switch_width-SETTINGARGS.body_padding_right-SETTINGARGS.iframe_border_width),'height':($(window).height()-SETTINGARGS.head_height-SETTINGARGS.minus_height)});
}

function checkLastTime(){
	$.post('../../../php/action/page/main.php?action=checkLastTime',function(data){
		
		//这个地方的话缺少
/*		if(data=='exit'){
			alert('您已在别处登录，被迫下线！');
			window.location.href='index.html';
		}*/
	});
}

$(function() {
	var base_url = 'http://youdoufang.com';
	var url = base_url + '/center/php/action/page/login_check.php?callback=?';
	setInterval(function() {
		$.getJSON(url, function(data) {
			if (! data.login) {
				alert('当前用户未登录');
				location.href = base_url + '/center';
			}
		});
	}, 3000);
});