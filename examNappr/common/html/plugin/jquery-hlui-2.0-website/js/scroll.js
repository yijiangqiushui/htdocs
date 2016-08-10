// JavaScript Document

$.extend({
	scroll:function(config){
		var htmlstr='<div class="hlui-scroll" id="'+config.id+'"><div class="ui-scroll-content"><div></div></div></div><!--hlui-scroll-->';
		$(config.renderTo==''?'body':config.renderTo).append(htmlstr);
		$('#'+config.id).css({'width':config.width+'px','height':config.height+'px'});
		$('#'+config.id+' .ui-scroll-content').css({'width':config.width+'px','height':config.height+'px'});
		$('#'+config.id+' .ui-scroll-content div').css(config.contentStyle)
		$('#'+config.id+' .ui-scroll-content div').html(config.content);
		
		config.times=Math.floor(($('#'+config.id+' .ui-scroll-content div').height()+$('#'+config.id+' .ui-scroll-content').height())/$('#'+config.id+' .ui-scroll-content').height());
		
		if($('#'+config.id+' .ui-scroll-content div').height()>$('#'+config.id+' .ui-scroll-content').height()){
			config.clritvl=setInterval(scrolling,config.interval*1000);
		}
		
		function scrolling(){
			config.count=(config.count+1)%(config.times);
			if(config.count==0){
				$('#'+config.id+' .ui-scroll-content div').css({'top':$('#'+config.id+' .ui-scroll-content').height()+'px'});
			}
			var move_top='-'+(parseInt($('#'+config.id+' .ui-scroll-content').height())*config.count)+'px';
			$('#'+config.id+' .ui-scroll-content div').animate({'top':move_top},config.speed,function(){});
		}
	},
});
