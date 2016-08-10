// JavaScript Document
/**************************************************
#	Version 1.2		PHP MySQL JavaScript
#	Copyright (c) 2009 http://www.fangbian123.com
#	Author: Li Zhixiao <English Name: Hawking E-mail:578731186@qq.com QQ:578731186>
#	Date: 2014/03/16
**************************************************/

/**
*当改变浏览器尺寸时调整相关元素的尺寸
*/
$(window).resize(function() {
	//$('.wrapper').text($(window).width()+" "+$(window).height());
	resetElementsSize();
});

$(document).ready(function(){
	$.post("../../../php/action/page/main.php?action=init",function(result){
		if(result.type=='success'){
				
			document.title=SYSTEM.name;
			//$('title').text(SYSTEM.name);//设置页面标题
			//$('.copyright').html(SYSTEM.copyright);//设置版权文字
				
				// add:heyangyang
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
							window.location.href=SETTINGARGS.logout_link;break;
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
			
			$('.toggleSubmenu').bind('click',function(){//切换显示左侧子菜单
				//alert($(this).parent().parent().find('ul').attr('class'));
				if($(this).parent().parent().find('.submenuItem').css('display')!='block'){
					$(this).parent().parent().find('.submenuItem').css({'display':'block'});
					$(this).css({'background-image':'url(../img/toggle-submenu_.png)'});
				}
				else{
					$(this).parent().parent().find('.submenuItem').css({'display':'none'});
					$(this).css({'background-image':'url(../img/toggle-submenu.png)'});
				}
				//alert($(this).attr('class'));
			});
			
			$('.toggleMenu').bind('click',function(){//切换显示左侧菜单
				if($('.menu').css('display')!='block'){
					$('.menu').css('display','block')
					$(this).css({'background-image':'url(../img/toggle-expand.png)'});
					$('.targetFrame').css('width',$(document).width()-SETTINGARGS.menu_width);
					$('.targetFrame .iframe').css({'width':($('.targetFrame').width()-SETTINGARGS.switch_width-SETTINGARGS.body_padding_right-SETTINGARGS.iframe_border_width)});
				}
				else{
					$('.menu').css('display','none')
					$(this).css({'background-image':'url(../img/toggle-expand_.png)'});
					$('.targetFrame').css('width',$(document).width());
					$('.targetFrame .iframe').css({'width':($(document).width()-SETTINGARGS.switch_width-SETTINGARGS.body_padding_right-SETTINGARGS.iframe_border_width)});
				}
			});
			
			//document.body.onselectstart=function(){return false;}//ie下禁止选择文字
			
			$('.btn2up').bind('click',function(){$('.menu .holder').scrollTop($('.menu .holder').scrollTop()-SETTINGARGS.scrl_step);});//向上滚动显示
			$('.btn2down').bind('click',function(){$('.menu .holder').scrollTop($('.menu .holder').scrollTop()+SETTINGARGS.scrl_step);});//向下滚动显示
			
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
				},"json");
			});
			
			$('#lockScrBtn').bind('click',function(){//屏幕上锁
				lockScreen();
			});
			if(result.locked){
				lockScreen();
			}
	
		}
		else if(result.type=='forbidden'){
			$('body').html('');
			alert('提示：您还未登录或已经超时退出，请重新登录！');
			window.location.href='index.html';
		}
		else{
			$('body').html('');
			alert('提示：系统发生错误，请联系技术人员进行处理！');
		}
	}
    //返回类型
    ,"json"
	);
});

function lockScreen(){
	$('#slfPWD').val('');
	$('.screenLock_bg').css('display','block');
	$('.screenLock_pwd').css('display','block');
	$.post("../../../php/action/page/main.php?action=lck_scr",function(result){});
}

/**
*初始化显示顶部导航和左侧菜单
*/
function initModules(){
	var menu_html='';
	for(var i=0;i<MENUARR.length;i++){
		menu_html+='<a href="javascript:showSubmenu('+i+');" id="nav_'+i+'" style="display:'+MENUARR[i].show+'">'+MENUARR[i].menu_name+'</a>';
		var submenu_html='<div class="holder" id="submenu_holder_'+i+'" '+(i==0?'':' style="display:none;"')+'>';
		for(var j=0;j<MENUARR[i].submenu_arr.length;j++){
			submenu_html+='<div class="menuBlock" style="display:'+MENUARR[i].submenu_arr[j].show+'"><h1>'+MENUARR[i].submenu_arr[j].submenu_name+'<span class="toggleSubmenu"></span></h1><ul class="submenuItem" style="margin-top:5px;">';
		  	var item_html='';
			for(var k=0;k<MENUARR[i].submenu_arr[j].item_arr.length;k++){
				if(MENUARR[i].submenu_arr[j].item_arr[k].show=='none') continue;
				
				var href = MENUARR[i].submenu_arr[j].item_arr[k].target;
				if (href.indexOf('http://') != -1) {
					item_html+='<li><a href="'+MENUARR[i].submenu_arr[j].item_arr[k].target+'" target="_blank" onclick="chgeSubmenuItemStyle(this,'+i+','+j+','+k+')">'+MENUARR[i].submenu_arr[j].item_arr[k].item_name+'</a></li>';
				} else {
					item_html+='<li><a href="'+MENUARR[i].submenu_arr[j].item_arr[k].target+'" target="'+SETTINGARGS.target_frame+'" onclick="chgeSubmenuItemStyle(this,'+i+','+j+','+k+')">'+MENUARR[i].submenu_arr[j].item_arr[k].item_name+'</a></li>';
				}
			}
			submenu_html+=item_html;
			submenu_html+='</ul></div><!--menuBlock-->';
		}
		submenu_html+='<!--holder-->';
		$('.menu').prepend(submenu_html);
	}
	$('.nav .left').prepend(menu_html);
}

/**
*设置左侧菜单选中项的样式
*/
function chgeSubmenuItemStyle(obj,i,j,k){
	$('.position span').text(MENUARR[i].menu_name+' >'+MENUARR[i].submenu_arr[j].submenu_name+' >'+MENUARR[i].submenu_arr[j].item_arr[k].item_name+' >');
	
	$('.submenuItem li').css('background-image','url()');
	$(obj).parent().css('background-image','url(../img/submenu_selected.gif)');
	$('.submenuItem a').css({'color':'','font-weight':''});
	$(obj).css({'color':'#f00','font-weight':'bold'});
}

/**
*显示左侧菜单
*/
function showSubmenu(id){
	$('.position span').text(MENUARR[id].menu_name+' >');
	
	$('.menu .holder').css('display','none');
	$('#submenu_holder_'+id).css('display','block');
	
	$('.nav .left a').css({'color':'#fff','background-image':'url(../img/nav_bg1.png)'});
	$('#nav_'+id).css({'color':'#0072ff','background-color':'#e2e9ea','background-image':'url()'});
}

/**
*页面尺寸随着浏览器改变时相应地改变相关元素
*/
function resetElementsSize(){
	$('.navNinfo').width(($(window).width()-$('.logo').width())-20);
	$('.body').height($(window).height()-SETTINGARGS.head_height-10);
	$('.body').width($(window).width());//alert($(screen).width());
	$('.menu').width(SETTINGARGS.menu_width);
	$('.targetFrame').width($(window).width()-SETTINGARGS.menu_width);
	$('.targetFrame .iframe').css({'width':($('.targetFrame').width()-SETTINGARGS.switch_width-SETTINGARGS.body_padding_right-SETTINGARGS.iframe_border_width),'height':($(window).height()-SETTINGARGS.head_height-SETTINGARGS.minus_height)});
	if($('.menu .holder').height()>=($('.body').height()-SETTINGARGS.scrl_btn_height)){
		$('.menuScroll').css('display','block');
		$('.menu .holder').css('height',($('.body').height()-SETTINGARGS.scrl_btn_height));
	}
	else{
		$('.menuScroll').css('display','none');
		$('.menu .holder').css('height','');
	}
}

