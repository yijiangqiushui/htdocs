// JavaScript Document
/**
 * Spinner
 * Initializing Hawking Lee UI
 * 
 * Copyright(c) 2014-2014 omnimediawindows [ 1499962582@qq.com ] 
 * Author:Li Zhixiao
 * 
 */

$.extend({
	spinner:function(config){
		var htmlstr='<span class="hlui-spinner" data-opt="name:\''+config.name+'\',val:'+config.val+',scope:\''+config.scope.start+','+config.scope.end+'\'" style="width:'+config.width+'px;"></span>';
		if(config.renderTo==''){
			$('body').append(htmlstr);
		}
		else{
			$(config.renderTo).html(htmlstr);
		}
		$.spinner_init();
	},
	spinner_init:function(){
		$('.hlui-spinner').each(function(i){
			$(this).html('<input type="text" value="00"><span class="ui-spinner-arrow"><span class="ui-spinner-arrow-up"></span><span class="ui-spinner-arrow-down"></span></span>');
			var d_opt=$.data_option_format($(this).attr('data-opt'));
			var inputObj=$(this).find('input')
			inputObj.attr({'name':d_opt.name,'id':d_opt.name,'value':d_opt.val});
			inputObj.width($(this).width()-22);
			var scope_arr=(d_opt.scope?d_opt.scope:'').split(',');
			$(this).find('.ui-spinner-arrow-up').bind('click',function(){
				var val_reset=parseInt(inputObj.val())+1;
				val_set=val_reset>parseInt(scope_arr[1])?parseInt(scope_arr[1]):val_reset;
				inputObj.val(d_opt.scope==''?val_reset:val_set);
			});
			$(this).find('.ui-spinner-arrow-down').bind('click',function(){
				var val_reset=parseInt(inputObj.val())-1;
				val_set=val_reset<parseInt(scope_arr[0])?parseInt(scope_arr[0]):val_reset;
				inputObj.val(d_opt.scope==''?val_reset:val_set);
			});
		});
	}
});