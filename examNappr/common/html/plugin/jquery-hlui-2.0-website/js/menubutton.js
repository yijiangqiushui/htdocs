// JavaScript Document
/**
 * jQuery HLUI 1.0.2
 * MenuButton
 * 
 * Copyright(c) 2014-2014 omnimediawindows [ 1499962582@qq.com ] 
 * Author:Li Zhixiao
 * 
 */


$.extend({
	menubutton:function(config){
		var htmlstr='';
		htmlstr='<div id="'+config.id+'" class="hlui-menubutton">';
		for(var i=0;i<config.menu.length;i++){
			if(config.menu[i].disabled!=true){
				htmlstr+='<div class="ui-menubutton-menus"><div class="ui-menubutton-menu" '+(typeof(config.menu[i].func)=='undefined'?'':' onclick="'+config.menu[i].func+'"')+'>'+(typeof(config.menu[i].icon)=='undefined'?'':('<span class="ui-menubutton-icon" style="background-image:url('+config.menu[i].icon+')">&nbsp;</span>'))+'<span class="ui-menubutton-name">'+config.menu[i].name+'</span>'+(typeof(config.menu[i].submenu)=='undefined'?'':'<span class="ui-menubutton-dropdown">&nbsp;</span>')+'</div>';
				if(typeof(config.menu[i].submenu)!='undefined'){
					htmlstr+='<div class="ui-menubutton-submenu">';
					for(var j=0;j<config.menu[i].submenu.length;j++){
						if(config.menu[i].submenu[j].disabled!=true){
							htmlstr+='<div '+(typeof(config.menu[i].submenu[j].func)=='undefined'?'':' onclick="'+config.menu[i].submenu[j].func+'"')+'><span class="ui-menubutton-submenu-icon"'+(typeof(config.menu[i].submenu[j].icon)=='undefined'?'':' style="background-image:url('+config.menu[i].submenu[j].icon+');"')+'>&nbsp;</span><span class="ui-menubutton-submenu-name">'+config.menu[i].submenu[j].name+'</span><div style="clear:both;"></div></div>';
						}
					}
					htmlstr+='</div>';
				}
				htmlstr+='</div><!--hlui-menubutton-menus-->';
			}
		}
		htmlstr+='</div><!--hlui-menubutton-->';
		$(config.renderTo==''?'body':config.renderTo).append(htmlstr);
		$.menubutton_apply();
	},
	menubutton_apply:function(){
		$('.ui-menubutton-menus').each(function(){
			$(this).bind('mouseover',function(){
				$('.ui-menubutton-submenu').css('display','none');
				$('.ui-menubutton-menu').removeClass('ui-menubutton-menu-hover');
				$(this).find('.ui-menubutton-menu').addClass('ui-menubutton-menu-hover');
				$(this).find('.ui-menubutton-submenu').css('display','block');
			});
			$(this).find('.ui-menubutton-menu').bind('mouseout',function(){
				$('.ui-menubutton-menu').removeClass('ui-menubutton-menu-hover');
				$('.ui-menubutton-submenu').css('display','none');
			});
			$(this).find('.ui-menubutton-submenu').bind('mouseout',function(){
				$('.ui-menubutton-menu').removeClass('ui-menubutton-menu-hover');
				$('.ui-menubutton-submenu').css('display','none');
			});
		});
		
		$('.ui-menubutton-submenu').bind('click',function(){
			$('.ui-menubutton-menu').removeClass('ui-menubutton-menu-hover');
			$(this).css('display','none');
		});
		
		$('.ui-menubutton-submenu div').bind('mouseover',function(){
			$(this).css({'background-color':'#f1f1f1'});
			$(this).find('.ui-menubutton-submenu-icon').css({'border':'1px solid #ccc','width':'24px','height':'20px','background-position':'2px center'});
			$(this).find('.ui-menubutton-submenu-name').css({'border':'1px solid #ccc','border-left':'0','line-height':'20px'});
		});
		$('.ui-menubutton-submenu div').bind('mouseout',function(){
			$(this).css({'background-color':'#fff'});
			$(this).find('.ui-menubutton-submenu-icon').css({'border':'0','border-right':'1px solid #ccc','width':'25px','height':'22px','background-position':'3px center'});
			$(this).find('.ui-menubutton-submenu-name').css({'border':'0','line-height':'22px','border-right':'1px solid #fff'});
		});
	}
});