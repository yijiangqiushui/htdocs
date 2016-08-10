// JavaScript Document
/**
 * jQuery HLUI 1.1.2
 * Layout
 * 
 * Copyright(c) 2014-2014 omnimediawindows [ 1499962582@qq.com ] 
 * Author:Li Zhixiao
 * 
 */
 
//when window resized,reinitialize and reset layout size
$(window).resize(function(){
	$.layout_init();
	$.layout_resetsize();
});

$.extend({
	layout_padding:function(padding){
		$('.ui-layout-ctntpdng').css({'padding':(padding+'px')});
	},
	layout_east_padding:function(padding){
		$('.ui-layout-east .ui-layout-ctntpdng').css({'padding':(padding+'px')});
	},
	layout_west_padding:function(padding){
		$('.ui-layout-west .ui-layout-ctntpdng').css({'padding':(padding+'px')});
	},
	layout_west_append:function(htmlstr){
		$('#ui-layout-west').append(htmlstr);
	},
	layout_east_append:function(htmlstr){
		$('#ui-layout-east').append(htmlstr);
	},
	layout:function(){
		var west_width=arguments[0]?arguments[0]:200;
		var htmlstr='<div class="hlui-layout">\
	<div class="ui-layout-west" width="'+west_width+'">\
      <div class="ui-layout-ctntpdng" id="ui-layout-west"><!--#insert here#-->\
      </div><!--ui-layout-ctntpdng-->\
    </div><!--ui-layout-west-->\
	<div class="ui-layout-break"></div><!--ui-layout-break-->\
    <div class="ui-layout-east">\
      <div class="ui-layout-ctntpdng" id="ui-layout-east"><!--#insert here#-->\
      </div><!--ui-layout-ctntpdng-->\
    </div><!--ui-layout-east-->\
    <div class="ui-plugin-clearboth"></div>\
</div><!--hlui-layout-->';
		$('body').append(htmlstr);
		$.layout_init();
	},
	layout_init:function(){
		$('body').addClass('body');
		$('.hlui-layout').height($(window).height());
		$('.ui-layout-break').unbind('mousedown');
		$('.ui-layout-west').width($('.ui-layout-west').attr('width'));
		var break_width=$('.ui-layout-break').width()+2;
		var east_width=$(window).width()-$('.ui-layout-west').attr('width')-break_width;
		//alert($('.ui-layout-west').width()+' '+east_width);
		$('.ui-layout-east').css({'width':east_width});
		$('body').append('<div class="ui-layout-mouseup"></div>');
		$('.ui-layout-ctntpdng').height($(window).height()-16);
		$.layout_apply();
	},
	layout_apply:function(){
		$('.hlui-layout').attr('mouse_x',0);
		$('.ui-layout-break').bind('mousedown',function(events){
			$('.hlui-layout').attr('mouse_x',events.pageX);
			$(document).bind("selectstart", function(){ return false; }); 
			$('body').addClass('hlui-layout-noselect');
			
			$('.ui-layout-mouseup').css({'display':'block','opacity':0.01,'width':$(window).width(),'height':$(window).height()});
			
			$(document).bind('mouseup',function(events){
				var break_width=$('.ui-layout-break').width()+2;
				var cal_width=$('.ui-layout-west').width()+(events.pageX-$('.hlui-layout').attr('mouse_x'));
				var west_width=cal_width>0?(cal_width<($(window).width()-break_width)?cal_width:($(window).width()-break_width)):0;
				var east_width=$(window).width()-west_width-break_width;
				
				$('.ui-layout-west').width(west_width);
				$('.ui-layout-east').width(east_width);
				
				$(this).unbind('mouseup');
				$(document).unbind("selectstart"); 
				$('body').removeClass('hlui-layout-noselect');
				$('.ui-layout-mouseup').css({'display':'none'});
			});
		});
	},
	layout_resetsize:function(){
		var break_width=$('.ui-layout-break').width()+2;
		var cal_width=$('.ui-layout-west').width();
		var west_width=cal_width>0?(cal_width<($(window).width()-break_width)?cal_width:($(window).width()-break_width)):0;
		var east_width=$(window).width()-west_width-break_width;
		
		$('.ui-layout-west').width(west_width);
		$('.ui-layout-east').width(east_width);
	}
});

/*
<div class="hlui-layout">
	<div class="ui-layout-west" width="200">
      <div class="ui-layout-ctntpdng"><!--#insert here#-->
        <!--###开始插入代码###-->
        <!--/###插入代码结束###-->
      </div><!--ui-layout-ctntpdng-->
    </div><!--ui-layout-west-->
	<div class="ui-layout-break"></div><!--ui-layout-break-->
    <div class="ui-layout-east">
      <div class="ui-layout-ctntpdng"><!--#insert here#-->
        <!--###开始插入代码###-->
        <!--/###插入代码结束###-->
      </div><!--ui-layout-ctntpdng-->
    </div><!--ui-layout-east-->
    <div class="ui-plugin-clearboth"></div>
</div><!--hlui-layout-->

*/