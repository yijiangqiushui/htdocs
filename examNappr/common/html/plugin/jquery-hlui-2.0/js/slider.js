// JavaScript Document
/**
 * jQuery HLUI 1.1.2
 * Slider
 * 
 * Copyright(c) 2014-2014 omnimediawindows [ 1499962582@qq.com ] 
 * Author:Li Zhixiao
 * 
 */

$(window).resize(function(){
	$('.hlui-slider').each(function(i){
		var percentage=$(this).attr('percentage');

		$(this).find('.ui-slider-bar').css({'width':percentage*$(this).width()});
		$(this).find('.ui-slider-dragger').css({'left':percentage*$(this).width()+'px'});
	});
});
 
$.fn.extend({
	slider:function(){
		$(this).find('.ui-slider-dragger').draggable({containment:"parent",'stop':function(){
			$.slide_percentage(this);
		}});
	},
});

$.extend({
	slider:function(config){
		var htmlstr='<div id="'+config.id+'" class="hlui-slider" percentage="0" user-func="'+config.user_func+'">\
		<div class="ui-slider-bar-bg"></div>\
    <div class="ui-slider-bar"></div>\
    <div class="ui-slider-dragger"></div>\
</div>';
		$(config.renderTo==''?'body':config.renderTo).append(htmlstr);
		var dragger=$('#'+config.id).find('.ui-slider-dragger');
		dragger.draggable({containment:"parent",'stop':function(){
			$.slide_percentage(this);
		}});
	},
	slider_init:function(){
		$('.hlui-slider').each(function(i){
			$(this).html('<div class="ui-slider-bar-bg"></div><div class="ui-slider-bar"></div><div class="ui-slider-dragger"></div>');
			var dragger=$(this).find('.ui-slider-dragger');
			dragger.draggable({containment:"parent",'stop':function(){
				$.slide_percentage(this);
			}});
		});
	},
	slide_percentage:function(thisObj){
		var percentage=parseInt($(thisObj).css('left'))/(parseInt($(thisObj).parent().find('.ui-slider-bar-bg').width()-$(thisObj).width()));
		$(thisObj).parent().find('.ui-slider-bar').css('width',$(thisObj).css('left'));
		$(thisObj).parent().attr('percentage',parseInt(percentage*100)/100);
		if($(thisObj).parent().attr('user-func')!=''){
			eval($(thisObj).parent().attr('user-func')+'('+percentage+')');
		}		
	}
});