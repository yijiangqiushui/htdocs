// JavaScript Document
/**
 * jQuery HLUI 2.0.1
 * ImgRotate
 * 
 * Copyright(c) 2014-2014 omnimediawindows [ 1499962582@qq.com ] 
 * Author:Li Zhixiao
 * 
 */

$.extend({
	imgrotate:function(config){
		var htmlstr='<div class="hlui-imgrotate" id="'+config.id+'" style="display: block;">\
					  <div class="ui-imgrotate-button-l"><a href="javascript:void(0);"></a></div>\
					  <div class="ui-imgrotate-holder">\
						<div class="ui-imgrotate-holder-slide" style="width: 3360px; left: 0px; top: 0px;">\
						  <div class="ui-imgrotate-clear"></div>\
						</div>\
					  </div>\
					  <!--ui-imgrotate-holder-->\
					  <div class="ui-imgrotate-button-r"><a href="javascript:void(0);"></a></div>\
					  <div class="ui-imgrotate-clear"></div>\
					</div>';
		$(config.renderTo==''?'body':config.renderTo).append(htmlstr);
		
		htmlstr='';
		for(var i=0;i<config.infoArr.length;i++){
			htmlstr+='<div class="ui-imgrotate-block"><a href="'+config.infoArr[i].href+'" target="_blank" class="ui-imgrotate-block-holder"><div class="ui-imgrotate-block-img"><div class="ui-imgrotate-block-img-holder" style="background-image:url('+config.infoArr[i].imgurl+');"></div></div><div class="ui-imgrotate-block-title">'+config.infoArr[i].title+'</div></a></div>';
		}
		$('#'+config.id+' .ui-imgrotate-holder-slide').prepend(htmlstr);
		
		$('#'+config.id+' .ui-imgrotate-button-l').css({'margin-top':((config.txtHeight+config.imgHeight-40-config.width_heightAdded)/2)+'px'});
		$('#'+config.id+' .ui-imgrotate-button-r').css({'margin-top':((config.txtHeight+config.imgHeight-40-config.width_heightAdded)/2)+'px'});
		$('#'+config.id).width((config.imgWidth+config.width_heightAdded)*config.scrollAmount+80);
		$('#'+config.id+' .ui-imgrotate-holder').width((config.imgWidth+config.width_heightAdded)*config.scrollAmount);
		$('#'+config.id+' .ui-imgrotate-holder').height(config.imgHeight+config.txtHeight+config.width_heightAdded);
		$('#'+config.id+' .ui-imgrotate-block-img-holder').height(config.imgHeight);
		$('#'+config.id+' .ui-imgrotate-block-title').css({'height':config.txtHeight+'px','line-height':config.txtHeight+'px'});
		$('#'+config.id+' .ui-imgrotate-block').width(config.imgWidth);
		
		$('#'+config.id).unbind();
		config.scrollWidth=config.scrollAmount*(config.width_heightAdded+$('#'+config.id+' .ui-imgrotate-block').width());//10=padding/margin/border:5*2
		$('#'+config.id+' .ui-imgrotate-holder-slide').width($('#'+config.id+' .ui-imgrotate-block').length*config.scrollWidth);
		//alert($('#'+config.id+' .ui-imgrotate-holder-slide').width());
		$('#'+config.id+' .ui-imgrotate-holder-slide').css({'left':0,'top':0});
		
		$('#'+config.id+' .ui-imgrotate-button-l a').bind('click',function(){
			$.scrollPre(config);
		});
		$('#'+config.id+' .ui-imgrotate-button-r a').bind('click',function(){
			$.scrollNext(config);
		});
	},
	scrollNext:function(config){
		var move_left=parseInt($('#'+config.id+' .ui-imgrotate-holder-slide').css('left'))-config.scrollWidth;
		//alert(config.width_heightAdded+$('#'+config.id+' .ui-imgrotate-block').width()+'---'+(-$('#'+config.id+' .ui-imgrotate-holder-slide').width()));
		if(move_left<=(-(config.width_heightAdded+$('#'+config.id+' .ui-imgrotate-block').width())*$('#'+config.id+' .ui-imgrotate-block').length)){
			return;
		}/**/
		$('#'+config.id+' .ui-imgrotate-button-r a').unbind();
		$('#'+config.id+' .ui-imgrotate-holder-slide').animate({'left':move_left+'px'},config.speed,function(){
			$('#'+config.id+' .ui-imgrotate-button-r a').bind('click',function(){
				$.scrollNext(config);
			});
		});
	},
	scrollPre:function(config){
		var move_left=parseInt($('#'+config.id+' .ui-imgrotate-holder-slide').css('left'))+config.scrollWidth;
		if(move_left>=config.scrollWidth){
			return;
		}
		$('#'+config.id+' .ui-imgrotate-button-l a').unbind();
		$('#'+config.id+' .ui-imgrotate-holder-slide').animate({'left':move_left+'px'},config.speed,function(){
			$('#'+config.id+' .ui-imgrotate-button-l a').bind('click',function(){
				$.scrollPre(config);
			});
		});
	}
});
