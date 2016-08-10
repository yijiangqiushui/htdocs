// JavaScript Document
$.extend({
	tagbar:function(config){
		var is_href=false;
		var htmlstr='<div class="hlui-tagbar" id="'+config.id+'">\
		  <div class="ui-tagbar-under">\
		  '+(typeof(config.bar_h1)!='undefined'?'<h1 class="ui-tarbar-h1" style="background-image:url('+config.bar_h1.icon+');">'+(config.bar_h1.txt)+'</h1>':'')+'\
			<div class="ui-tagbar-top">\
			</div>\
			'+(typeof(config.more)!='undefined'?'<a class="ui-tarbar-more" style="background-image:url('+config.more.icon+');" href="'+config.more.href+'" target="'+((typeof(config.more.target)!='undefined'&&config.more.target!='')?config.more.target:'')+'">'+((typeof(config.more.txt)!='undefined'&&config.more.txt!='')?config.more.txt:'')+'</a>':'')+'\
		  </div>\
		</div><!--hlui-tagbar-->';
		
		if(config.renderTo==''){
			$('body').append(htmlstr);
		}
		else{
			$(config.renderTo).html(htmlstr);
		}
		
		$('#'+config.id).css(config.ui_css);
		
		for(var i=0;i<config.item_arr.length;i++){
			if(typeof(config.item_arr[i].href)!='undefined' && config.item_arr[i].href!=''){
				is_href=true;
			}
			$('#'+config.id+' .ui-tagbar-top').append('<a '+((typeof(config.item_arr[i].href)!='undefined' && config.item_arr[i].href!='')?(' href="'+config.item_arr[i].href+'" '+((typeof(config.item_arr[i].target)!='undefined' && config.item_arr[i].target!='')?' target="'+config.item_arr[i].target+'"':'')):' href="javascript:void(0);"')+'>'+config.item_arr[i].name+'</a>');
		}
		$('#'+config.id+' .ui-tagbar-top a:nth-child('+(config.init_index+1)+')').css(config.selected_css);
		$('#'+config.id+' .ui-tagbar-top a:nth-child('+config.init_index+')').css({'background-image':'url()'});
		$('#'+config.id+' .ui-tagbar-top a').each(function(i){
			$(this).bind(config.event_type,function(){
				for(var key in config.selected_css){
					$('#'+config.id+' .ui-tagbar-top a').css(key,'');
				}
				$('#'+config.id+' .ui-tagbar-top a:nth-child('+i+')').css({'background-image':'url()'});
				$('#'+config.id+' .ui-tagbar-top a:nth-child('+(i+1)+')').css(config.selected_css);
				if(!is_href){
					config.user_func(i);
				}
			});
		});
		if(!is_href){
			config.user_func(config.init_index);
		}
	},
});