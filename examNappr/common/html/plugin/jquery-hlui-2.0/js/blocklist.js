// JavaScript Document
/**
 * jQuery HLUI 1.1.2
 * Slider
 * 
 * Copyright(c) 2014-2014 omnimediawindows [ 1499962582@qq.com ] 
 * Author:Li Zhixiao
 * 
 */

$.extend({
	blocklist:function(){
		$('.hlui-blocklist').each(function(i){
			var id=$(this).attr('id');
			if($(this).attr('class').indexOf('hlui-blocklist-l')>-1){
				$('.hlui-blocklist-l .ui-blocklist-bar-l a:nth-child(1)').addClass('ui-blocklist-l-bar-a-selected');
				$('#'+id+' .ui-blocklist-bar-r a').attr({'target':'_blank','href':$('#'+id+' .ui-blocklist-bar-l a:nth-child(1)').attr('hrefto')});
				$('#'+id+' .ui-blocklist-bar-l a').each(function(j){
					$(this).bind('click',function(){
						$('#'+id+' .ui-blocklist-bar-r a').attr('href',$(this).attr('hrefto'));
						$('#'+id+' .ui-blocklist-bar-l a').removeClass('ui-blocklist-l-bar-a-selected');
						$(this).addClass('ui-blocklist-l-bar-a-selected');
						
						$('#'+id+' .ui-blocklist-content-item').css({'display':'none'});
						$('#'+id+' .ui-blocklist-content-item:nth-child('+(j+1)+')').css({'display':'block'});
					});
				});
			}
			else{
				$('#'+id+' .ui-blocklist-bar-r a').attr({'target':'_blank','href':$('#'+id+' .ui-blocklist-bar-l a:nth-child(1)').attr('hrefto')});
				if($('#'+id+' .ui-blocklist-bar').attr('class').indexOf('ui-blocklist-bar-icon')>-1){
					$('#'+id+' .ui-blocklist-bar').css({'padding-left':'30px'});
					$('#'+id+' .ui-blocklist-bar-l a').height(32);
				}
				else{
					$('#'+id+' .ui-blocklist-bar-l a:nth-child(1)').addClass('ui-blocklist-r-bar-a-selected');
					$('#'+id+' .ui-blocklist-bar').css({'padding-left':'15px'});
					$('#'+id+' .ui-blocklist-bar-l a').each(function(j){
						$(this).bind('click',function(){
							$('#'+id+' .ui-blocklist-bar-r a').attr('href',$(this).attr('hrefto'));
							$('#'+id+' .ui-blocklist-bar-l a').removeClass('ui-blocklist-r-bar-a-selected');
							$(this).addClass('ui-blocklist-r-bar-a-selected');
							
							$('#'+id+' .ui-blocklist-content-item').css({'display':'none'});
							$('#'+id+' .ui-blocklist-content-item:nth-child('+(j+1)+')').css({'display':'block'});
						});
					});
				}
			}
			if($('#'+id+' .ui-blocklist-bar-l a:nth-child(1)').attr('hrefto')=="#"){
				$('#'+id+' .ui-blocklist-bar-r a').css('display','none');
			}
		});
	}
});