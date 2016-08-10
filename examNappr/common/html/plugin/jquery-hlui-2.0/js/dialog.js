// JavaScript Document
/**
 * jQuery HLUI 1.1.2
 * Dialog
 * 
 * Copyright(c) 2014-2014 omnimediawindows [ 1499962582@qq.com ] 
 * Author:Li Zhixiao
 * 
 */

$.extend({
	dialog_close:function(id){
		$('#'+id).css('display','none');
	},
	dialog:function(config){
		if($('#'+config.id).length>0){
			$('#'+config.id).css('display','block');
			if(config.reloadinner){
				$('#'+config.id+' .ui-dialog-title').text(config.title);
				switch(config.inner.type){
				case 'iframe':$('#'+config.id+' .ui-dialog-body').html('<iframe name="'+config.inner.type+config.id+'" id="'+config.inner.type+config.id+'" src="'+config.inner.iframe+'" frameborder="0" scrolling="auto" width="100%" height="100%" allowtransparency="true"></iframe>');break;
				case 'ajax':$('#'+config.id+' .ui-dialog-body').load(config.inner.ajax);break;
				case 'id':$('#'+config.id+' .ui-dialog-body').html($('#'+config.inner.id).html());break;
				default:$('#'+config.id+' .ui-dialog-body').html(config.inner.html);
				}
			}
		}
		else{
			$('body').append('  <div id="'+config.id+'" class="hlui-dialog" title="'+config.title+'" data-opt="'+(config.iconSrc==''?'':'iconSrc:\''+config.iconSrc+'\',')+'isWin:'+config.isWin+'" width="'+config.width+'" height="'+config.height+'" left="'+config.left+'" top="'+config.top+'">\
			<div class="ui-dialog-titlebar">'+(config.iconSrc==''?'':'<div class="ui-dialog-icon"></div>')+'<div class="ui-dialog-title"></div><div class="ui-dialog-win"><a href="javascript:void(0);" \class="ui-dialog-min"></a><a href="javascript:void(0);" class="ui-dialog-max"></a><a href="javascript:void(0);" class="ui-dialog-close"></a></div><div class="ui-plugin-clearboth"></div></div><!--ui-dialog-titlebar-->\
			<div class="ui-dialog-body ui-widget-content"></div><!--ui-dialog-body-->\
		  </div><!--ui-dialog-->\
		');
			switch(config.inner.type){
			case 'iframe':$('#'+config.id+' .ui-dialog-body').html('<iframe name="'+config.inner.type+config.id+'" id="'+config.inner.type+config.id+'" src="'+config.inner.iframe+'" frameborder="0" scrolling="auto" width="100%" height="100%" allowtransparency="true"></iframe>');break;
			case 'ajax':$('#'+config.id+' .ui-dialog-body').load(config.inner.ajax);break;
			case 'id':$('#'+config.id+' .ui-dialog-body').html($('#'+config.inner.id).html());break;
			default:$('#'+config.id+' .ui-dialog-body').html(config.inner.html);
			}
			$.dialog_apply('#'+config.id);
		}
	},/*!--dialog--*/
	dialog_apply:function(elemID){
		var dataopt=eval('({'+$(elemID).attr('data-opt')+'})');
		//-->on focus	
		$(elemID).bind('mousedown',function(){
			$('.hlui-dialog').css({'z-index':9999});
			$(this).css({'z-index':10000});
		});	
		//-->minimize dialog
		$(elemID+' .ui-dialog-min').bind('click',{'elemID':elemID},function(){
			$(elemID+' .ui-dialog-body').css({'display':'none'});
			$(elemID+' .ui-dialog-titlebar').css({'padding-bottom':'0'});
		});
		//initialize dialog
		$(elemID).css({'width':$(elemID).attr('width'),'left':$(elemID).attr('left')+'px','top':$(elemID).attr('top')+'px'});
		$(elemID+' .ui-dialog-body').css({'height':$(elemID).attr('height')});
		//-->maximize dlalog
		$(elemID+' .ui-dialog-max').bind('click',{'elemID':elemID},function(){
			if($(elemID+' .ui-dialog-body').css('display')!='block'){
				$(elemID+' .ui-dialog-body').css({'display':'block'});
				$(elemID+' .ui-dialog-titlebar').css({'padding-bottom':'8px'});
			}
			else{
				if($(elemID).attr('is-max')!=1){
					$('body').css({'overflow':'hidden'});//avoid to display the scrolling bar
					$(elemID).attr('window-width',$(window).width());//avoid different window width because of the scrolling bar
					$(elemID).attr({'is-max':1,'left':$(elemID).css('left'),'top':$(elemID).css('top')});
					$(elemID+' .ui-dialog-body').css({'display':'block','height':$(window).height()-40});
					$(elemID+' .ui-dialog-titlebar').css({'padding-bottom':'8px'});
					$(elemID).css({'width':$(elemID).attr('window-width')-14,'left':0,'top':0});
					$(this).css('background-position','-16px -16px');
					$(elemID+' .ui-dialog-titlebar').unbind('mousedown');
				}
				else{
					$('body').css({'overflow':''});
					$(elemID).attr('is-max',0);
					$(elemID+' .ui-dialog-body').css({'display':'block','height':$(elemID).attr('height')});
					$(elemID+' .ui-dialog-titlebar').css({'padding-bottom':'8px'});
					$(elemID).css({'width':$(elemID).attr('width'),'left':$(elemID).attr('left'),'top':$(elemID).attr('top')});
					$(this).css('background-position','0 -16px');
					$(elemID+' .ui-dialog-titlebar').bind('mousedown',function(){
						$(elemID).draggable();
						$(elemID).draggable('enable');
					});
				}
			}
		});
		//-->close button
		$(elemID+' .ui-dialog-close').bind('click',{'elemID':elemID},function(){
			$(elemID).css({'display':'none'});
		});
		//set dialog model
		$(elemID+' .ui-dialog-min').css({'display':dataopt.isWin>0?'':'none'});
		$(elemID+' .ui-dialog-max').css({'display':dataopt.isWin>0?'':'none'});
		//-->initialize titlebar
		$(elemID+' .ui-dialog-title').text($(elemID).attr('title'));
		$(elemID+' .ui-dialog-titlebar').bind('mousedown',function(){
			$(elemID).draggable();
			$(elemID).draggable('enable');
		});
		$(elemID+' .ui-dialog-titlebar').bind('mouseup',function(){
			$(elemID).draggable('disable');
		});
		//-->initialize dialog icon
		if(dataopt.iconSrc && (dataopt.iconSrc!='' || dataopt.iconSrc!='undefined')){
			$(elemID+' .ui-dialog-icon').css({'background-image':'url('+dataopt.iconSrc+')'});
		}
	}
});
