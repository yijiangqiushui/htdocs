// JavaScript Document
/**
 * jQuery HLUI 1.0.2
 * Scrollbar
 * 
 * Copyright(c) 2014-2014 omnimediawindows [ 1499962582@qq.com ] 
 * Author:Li Zhixiao
 * 
 */

$.extend({
	scrollbar:function(id){
		$('.ui-scrollbar-body').after('<div id="'+id+'" class="hlui-scrollbar" mousedown-y="0" scroll-top="0" step-size="5" body-height="0"></div>');
		$.scrollbar_init();
	},
	scrollbar_init:function(){
		$('.hlui-scrollbar').each(function(i){
			var scrollbar_id=$(this).attr('id');
			
			$(this).attr('body-height',$('#'+scrollbar_id).parent().find('.ui-scrollbar-body').height());
			
			$(this).html('<div class="ui-scrollbar-inner"><div class="ui-scrollbar-bg"></div><div class="ui-scrollbar-block"></div></div>');
			$(this).parent().css({'position':'relative'});
			$(this).parent().find('.ui-scrollbar-body').css({'height':($(this).parent().height()-20)+'px','overflow':'hidden'});
			$(this).parent().find('.ui-scrollbar-body').bind('selectstart',function(){return false;});
			
			$(this).attr('height',$(this).parent().height()-20);
			
			$(this).find('.ui-scrollbar-inner').height($(this).attr('height'));
			
			$(this).parent().bind('mousedown',function(e){
				$('#'+scrollbar_id).css('display','block');
				$('#'+scrollbar_id).attr({'mousedown-y':e.pageY});
				//alert($('#'+scrollbar_id).parent().find('.ui-scrollbar-body').height());
			});
			$(this).parent().bind('mouseup',function(e){
				$.scrollbar_blockmove(scrollbar_id,e.pageY-$('#'+scrollbar_id).attr('mousedown-y'));
			});
		});
	},
	scrollbar_blockmove:function(scrollbar_id,scrolllength){
		var body_real_height=parseInt($('#'+scrollbar_id).attr('body-height'));
		var top_pos=parseInt($('#'+scrollbar_id+' .ui-scrollbar-block').css('top'));
		var block_height=$('#'+scrollbar_id+' .ui-scrollbar-block').height()-20;
		var scroll2pos=(top_pos-scrolllength)<0?0:((top_pos-scrolllength)>($('#'+scrollbar_id).height()-block_height)?($('#'+scrollbar_id).height()-block_height):(top_pos-scrolllength));
		$('#'+scrollbar_id+' .ui-scrollbar-block').animate({'top':scroll2pos},'fast',function(){
			$('#'+scrollbar_id).attr('scroll-top',$('#'+scrollbar_id).attr('scroll-top')+scrolllength);
			var scroll_body=$('#'+scrollbar_id).parent().find('.ui-scrollbar-body');
			var body_scroll=(body_real_height-scroll_body.height())*(parseInt($('#'+scrollbar_id+' .ui-scrollbar-block').css('top'))/($('#'+scrollbar_id).height()-block_height));
			scroll_body.animate({scrollTop:body_scroll},'fast',function(){
				$('#'+scrollbar_id).css('display','none');
				//alert(body_real_height);
			});
		});
	}
});