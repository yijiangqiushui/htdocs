// JavaScript Document
/**
 * jQuery HLUI 1.1.2
 * ImgSlide
 * 
 * Copyright(c) 2014-2014 omnimediawindows [ 1499962582@qq.com ] 
 * Author:Li Zhixiao
 * 
 */
$.extend({
	imgslide:function(config){
		var htmlstr='<div id="'+config.id+'" width="'+config.width+'" height="'+config.height+'"><div class="ui-imgslide-inner"><div class="ui-imgslide-holder"></div><!--ui-imgslide-holder--><div class="ui-imgslide-btn ui-imgslide-btn-left"></div> <div class="ui-imgslide-btn ui-imgslide-btn-right"></div></div><!--ui-imgslide-inner--> <div class="ui-imgslide-thumbnails"></div> <div class="ui-imgslide-intro"></div><!--ui-imgslide-intro--></div><!--ui-imgslide-realsize-->';

		$(config.renderTo==''?'body':config.renderTo).append(htmlstr);

		if(config.show_realsize && $('.ui-imgslide-realsize').length<1){
			$('body').append('<div class="ui-imgslide-realsize"></div><!--ui-imgslide-realsize-->');
		}
		$('#'+config.id).css({'width':config.width+'px'});
		$('#'+config.id).find('.ui-imgslide-inner').css({'height':config.height+'px','width':config.width+'px'});
		$.imgslide_loadimgs($('#'+config.id),$('#'+config.id).find('.ui-imgslide-holder'),config.width,config.height,config.img_root,config.img_arr,config.intro_arr);
		
		$('.ui-imgslide-intro').css(config.textStyle);
	},
 	imgslide_loadimgs:function(obj,holder_obj,width,height,img_root,img_arr,intro_arr){
		$('.ui-imgslide-realsize').draggable();
		
		//var slide_num=+'/'+img_arr.length;

		obj.unbind();
		obj.bind('dragstart',function(){return false;});
	   
		holder_obj.width(obj.attr('width')*img_arr.length);
		holder_obj.height(obj.attr('height'));
		$.imgslide_showintro(obj,1,img_arr.length,intro_arr[0]);
	   
		for(var i=0;i<img_arr.length;i++){
			holder_obj.append('<img src="'+img_root+img_arr[i]+'" width="'+width+'" height="'+height+'" '+($('.ui-imgslide-realsize').length>0?' ondblclick="$.imgslide_show_realsize(this.src);"':'')+' />');
		}
	   
		obj.bind('mousedown',function(e){
			obj.attr({'mousedown-x':e.pageX});
		});
	   
		obj.bind('mouseup',function(e){
		if(e.pageX>obj.attr('mousedown-x')){
			if(parseInt(holder_obj.css('left'))<0){
				var move_length=parseInt(holder_obj.css('left'))+parseInt(obj.attr('width'));
				holder_obj.animate({'left':move_length+'px'},'normal',function(){
					obj.attr({'mousedown-x':e.pageX});
					$.imgslide_showintro(obj,(Math.abs(parseInt(holder_obj.css('left')))/width+1),img_arr.length,intro_arr[Math.abs(parseInt(holder_obj.css('left')))/obj.attr('width')]);
				});
			}
		}
		else if(e.pageX<obj.attr('mousedown-x')){
			if(parseInt(holder_obj.css('left'))>(-obj.attr('width')*(img_arr.length-1))){
				var move_length=parseInt(holder_obj.css('left'))-obj.attr('width');
				holder_obj.animate({'left':move_length+'px'},'normal',function(){
					obj.attr({'mousedown-x':e.pageX});
					$.imgslide_showintro(obj,(Math.abs(parseInt(holder_obj.css('left')))/width+1),img_arr.length,intro_arr[Math.abs(parseInt(holder_obj.css('left')))/obj.attr('width')]);
					});
				}
			}
		});
	   
		obj.find('.ui-imgslide-btn-right').bind('click',function(){
			if(parseInt(holder_obj.css('left'))>(-obj.attr('width')*(img_arr.length-1))){
				var move_length=parseInt(holder_obj.css('left'))-obj.attr('width');
					holder_obj.animate({'left':move_length+'px'},'normal',function(){
					$.imgslide_showintro(obj,(Math.abs(parseInt(holder_obj.css('left')))/width+1),img_arr.length,intro_arr[Math.abs(parseInt(holder_obj.css('left')))/obj.attr('width')]);
				});
			}
		});
	   
		obj.find('.ui-imgslide-btn-left').bind('click',function(){
			if(parseInt(holder_obj.css('left'))<0){
				var move_length=parseInt(holder_obj.css('left'))+parseInt(obj.attr('width'));
				holder_obj.animate({'left':move_length+'px'},'normal',function(){
					$.imgslide_showintro(obj,(Math.abs(parseInt(holder_obj.css('left')))/width+1),img_arr.length,intro_arr[Math.abs(parseInt(holder_obj.css('left')))/obj.attr('width')]);
				});
			}
		});
 	}, 
	imgslide_showintro:function(obj,current,total,txt){
		$('.ui-imgslide-btn-left').css('display',(current==1?'none':'block'));
		$('.ui-imgslide-btn-right').css('display',(current==total?'none':'block'));
		obj.find('.ui-imgslide-intro').html('<span>'+current+'/'+total+'</span>'+(typeof(txt)=='undefined'?'':txt));
	},
	imgslide_show_realsize:function(src){
		var img_holder=$('.ui-imgslide-realsize');
		img_holder.css({'display':'block'});
		img_holder.html('<div class="ui-imgslide-close"><a href="javascript:void(0);" onclick="$.imgslide_hide_realsize();"></a></div><img src="'+src+'" ondblclick="$.imgslide_hide_realsize();" />');
	},
	imgslide_hide_realsize:function(){
		$('.ui-imgslide-realsize').css({'display':'none'});
 	}
});