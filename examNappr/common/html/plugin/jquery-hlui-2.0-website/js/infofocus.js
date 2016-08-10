// JavaScript Document
$.extend({
	infofocus:function(config){
		config.total=config.imgarr.length;
		
		var htmlstr='<div class="hlui-focus" id="'+config.id+'">\
  <div class="ui-focus-holder">\
    <div class="ui-focus-img"></div>\
  </div><!--ui-focus-holder-->\
  <div class="ui-focus-intro"></div><!--ui-focus-intro-->\
  <div class="ui-focus-intro-bg"></div><!--ui-focus-intro-bg-->\
  <div class="ui-focus-switch"></div>\
  <!--ui-focus-switch-->\
</div><!--hlui-focus-->';
		$(config.renderTo==''?'body':config.renderTo).append(htmlstr);	
		var htmlstr1='';
		var htmlstr2='';
		var htmlstr3='';
		for(var i=0;i<config.total;i++){
			htmlstr1+='<a href="'+config.imgarr[i].href+'" target="_blank" style="background-image:url('+config.imgarr[i].url+');"></a>';
			htmlstr2+='<div><h1>'+config.introarr[i].h1+'</h1><p>'+config.introarr[i].p+'</p></div>';
			htmlstr3+='<a href="javascript:void(0);"></a>';
		}	
		$('#'+config.id+' .ui-focus-img').html(htmlstr1+'<div class="clearboth"></div>');
		$('#'+config.id+' .ui-focus-intro').html(htmlstr2);
		$('#'+config.id+' .ui-focus-switch').html(htmlstr3);
		
		$('#'+config.id).css({'width':config.blkwth+'px','height':config.blkhgt+'px'});
		$('#'+config.id+' .ui-focus-holder').width(config.blkwth*config.total);
		$('#'+config.id+' .ui-focus-holder a').css({'width':config.blkwth+'px','height':config.blkhgt+'px'});
		$('#'+config.id+' .ui-focus-intro h1').css(config.intro_h1_style);
		$('#'+config.id+' .ui-focus-intro p').css(config.intro_p_style);
		$('#'+config.id+' .ui-focus-intro-bg').css(config.intro_bg_style);
		$('#'+config.id+' .ui-focus-switch').css(config.switch_style);
		$('#'+config.id+' .ui-focus-switch a').each(function(i){
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
			$('#'+config.id+' .ui-focus-holder').animate({'margin-left':'-'+(count*config.blkwth)+'px'},config.speed,function(){
				$('#'+config.id+' .ui-focus-intro div').css('display','none');
				$('#'+config.id+' .ui-focus-intro div:nth-child('+(count+1)+')').css('display','block');
				$('#'+config.id+' .ui-focus-switch a').css({'background-color':'#333'});
				$('#'+config.id+' .ui-focus-switch a:nth-child('+(count+1)+')').css({'background-color':'#06f'});
			});
		}
	}
});
