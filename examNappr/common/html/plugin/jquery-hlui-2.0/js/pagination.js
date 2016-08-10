// JavaScript Document
/**
 * jQuery HLUI 1.0.2
 * Pagination
 * 
 * Copyright(c) 2014-2014 omnimediawindows [ 1499962582@qq.com ] 
 * Author:Li Zhixiao
 * 
 */

$.extend({
	pagination_params:function(id){
		var params_str=$('#'+id).attr('params');
		var item_arr=params_str.split('&');
		if(params_str.length>0){
			var jsonstr='({';
			for(var i=0;i<item_arr.length;i++){
				var param_arr=item_arr[i].split('=');
				jsonstr+=(i==0?'':',')+'"'+param_arr[0]+'":"'+param_arr[1]+'"';
			}
			jsonstr+=',"page":"'+$('#'+id).attr('current')+'","size":"'+$('#'+id).attr('size')+'"';
			jsonstr+=',"params":"?page='+$('#'+id).attr('current')+'&size='+$('#'+id).attr('size')+'&'+$('#'+id).attr('params')+'"';
			jsonstr+='})';
			var json=eval(jsonstr);
			return json;
		}
		return {};
	},
	pagination:function(config){
		var htmlstr='<div id="'+config.id+'" class="hlui-pagination '+config.class+'" data-opt="is_four_text:'+config.dataopt.is_four_text+',is_links:'+config.dataopt.is_links+',is_turn2page:'+config.dataopt.is_turn2page+'" total="'+config.total+'" size="'+config.size+'" current="'+config.current+'" list-num="'+config.list_num+'" params="'+config.params+'" user-func="'+config.user_func+'">\
<span class="ui-pagination-first">&nbsp;</span>\
<span class="ui-pagination-pre">&nbsp;</span>\
<span class="ui-pagination-next">&nbsp;</span>\
<span class="ui-pagination-last">&nbsp;</span>\
</div><!--hlui-pagination-->\
';
		
		$(config.renderTo==''?'body':config.renderTo).append(htmlstr);
		$.pagination_apply(config.id);
		$.pagination_locate(config.id,1);
	},
	pagination_init:function(){
		$('.hlui-pagination').each(function(i){
			var thisObj=$(this);
			thisObj.html('<span class="ui-pagination-first">&nbsp;</span><span class="ui-pagination-pre">&nbsp;</span><span class="ui-pagination-next">&nbsp;</span><span class="ui-pagination-last">&nbsp;</span>');
			if($(this).attr('get-total-url') && $(this).attr('get-total-url')!=''){
				$.post($(this).attr('get-total-url'),function(data){
					thisObj.attr('total',$.trim(data));
					$.pagination_apply(thisObj.attr('id'));
					$.pagination_locate(thisObj.attr('id'),1);
				});
			}
		});
	},
	pagination_apply:function(id){
		$('#'+id+' *').unbind();
		var d_opt=$.data_option_format($('#'+id).attr('data-opt'));
		var page_total=Math.ceil(((parseInt($('#'+id).attr('total')))/parseInt($('#'+id).attr('size'))));
		if(d_opt.is_four_text>0){
			$('#'+id+' .ui-pagination-first').css({'padding':'0 5px','width':'auto','background-image':'url()'});
			$('#'+id+' .ui-pagination-first').text('首页');
			$('#'+id+' .ui-pagination-pre').css({'padding':'0 5px','width':'auto','background-image':'url()'});
			$('#'+id+' .ui-pagination-pre').text('上一页');
			$('#'+id+' .ui-pagination-next').css({'padding':'0 5px','width':'auto','background-image':'url()'});
			$('#'+id+' .ui-pagination-next').text('下一页');
			$('#'+id+' .ui-pagination-last').css({'padding':'0 5px','width':'auto','background-image':'url()'});
			$('#'+id+' .ui-pagination-last').text('末页');
		}
		$('#'+id+' .ui-pagination-first').bind('click',function(e){
			$.pagination_locate(id,1);
		});
		$('#'+id+' .ui-pagination-pre').bind('click',function(e){
			var pre=parseInt($('#'+id).attr('current'))-1;
			$.pagination_locate(id,pre<1?1:pre);
		});
		$('#'+id+' .ui-pagination-next').bind('click',function(e){
			var next=parseInt($('#'+id).attr('current'))+1;
			$.pagination_locate(id,next>page_total?page_total:next);
		});
		$('#'+id+' .ui-pagination-last').bind('click',function(e){
			$.pagination_locate(id,page_total);
		});
		if(d_opt.is_links>0 && $('.ui-pagination-links').length<1){
			var htmlstr='';
			var current=parseInt($('#'+id).attr('current'));
			var list_num=parseInt($('#'+id).attr('list-num'));
			var total=parseInt($('#'+id).attr('total'));
			var size=parseInt($('#'+id).attr('size'));
			var page_total=parseInt(total/size)+(total%size>0?1:0);

			var i_start=(current>list_num)?(current-list_num):1;
			var i_end=((current+list_num)<page_total)?(current+list_num):page_total;
			for(var i=i_start;i<=i_end;i++){
				if(i==current){
					htmlstr+='<span class="ui-pagination-links ui-pagination-link-current">'+i+'</span>';
				}
				else{
					htmlstr+='<span class="ui-pagination-links">'+i+'</span>';
				}
			}
			$('#'+id+' .ui-pagination-pre').after(htmlstr);
			$('#'+id+' .ui-pagination-links').each(function(i){
				$(this).bind('click',function(e){
					$.pagination_locate(id,parseInt($(this).text()));
				});
			});
		}
		if(d_opt.is_turn2page>0){
			$('#'+id+' .ui-pagination-last').after('<span class="ui-pagination-turn2page">跳转到<input name="ui-pagination-turn2page" onkeydown="if(event.keyCode==13){$.pagination_locate(\''+id+'\',parseInt(this.value));}" type="text" /></span>');
		}
	},
	pagination_locate:function(id,i){
		var page_total=parseInt($('#'+id).attr('total')/$('#'+id).attr('size'))+1;
		if(i>=page_total){
			i=page_total;
		}
		$('#'+id).attr('current',i);
		$('#'+id+' .ui-pagination-links').each(function(i){
			$(this).remove();
		});
		$('#'+id+' .ui-pagination-turn2page').remove();
		$.pagination_apply(id);
		if($('#'+id).attr('user-func')!=''){
			var params='page='+$('#'+id).attr('current')+'&size='+$('#'+id).attr('size')+'&'+$('#'+id).attr('params');
			eval($('#'+id).attr('user-func')+'("'+params+'")');
		}
	}
});