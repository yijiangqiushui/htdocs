// JavaScript Document
$.extend({
	focusslide:function(config){
		var a_imgs='';
		var a_btns='';
		config.total=config.info_arr.length;
		for(var i=0;i<config.total;i++){
			a_imgs+='<a href="'+config.info_arr[i].href+'" target="_blank" style="background-image:url('+config.img_root+config.info_arr[i].img+');"></a>';
			a_btns+='<a href="javascript:void(0);"></a>';
		}
		var htmlstr='<div class="focusnews" id="'+config.id+'" style="width:'+config.width+'px;height:'+config.height+'px;">\
              <div class="focusnews-img">'+a_imgs+'</div>\
              <div class="focusnews-txt">\
                <div class="focusnews-txt-bg"></div>\
                <div class="focusnews-txt-text"></div>\
              </div>\
              <div class="focusnews-btn">'+a_btns+'</div>\
            </div>\
';
		$(config.renderTo==''?'body':config.renderTo).append(htmlstr);
		$('#'+config.id+' .focusnews-img a').css({'height':config.height+'px'});
		$('#'+config.id+' .focusnews-btn').css(config.buttonStyle);
		$('#'+config.id+' .focusnews-txt-text').html(config.info_arr[0].title);
		$('.focusnews-txt-bg').css('opacity',0.6);
		
		$('#'+config.id+' .focusnews-btn a').each(function(i){
			$(this).bind('click',function(){
				clearInterval(config.clritvl);
				config.count=i;
				moving(config.count);
				config.clritvl=setInterval(auto,config.interval*1000);
			});
		});
		
		config.clritvl=setInterval(auto,config.interval*1000);
		
		function auto(){
			config.count=(config.count+1)%(config.total);
			moving(config.count);
		}
		
		function moving(count){
			$('#'+config.id+' .focusnews-img').animate({'margin-top':'-'+(count*config.height)+'px'},config.speed,function(){
				$('#'+config.id+' .focusnews-txt-text').text(config.info_arr[config.count].title);
				$('#'+config.id+' .focusnews-btn a').css({'background-color':'#fff'});
				$('#'+config.id+' .focusnews-btn a:nth-child('+(count+1)+')').css({'background-color':'#f00'});
			});
		}
		
	}
});
