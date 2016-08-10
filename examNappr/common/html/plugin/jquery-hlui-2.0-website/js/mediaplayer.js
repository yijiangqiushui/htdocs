// JavaScript Document

$(function(){
	$.mediaplayer(config);
});


$.extend({
	mediaplayer:function(config){
		var htmlstr='<object classid="clsid:6BF52A52-394A-11D3-B153-00C04F79FAA6" id="'+config.id+'" width="'+config.width+'" height="'+config.height+'"><param name="url" value="'+config.files[0].url+'" />';
		for(var i=0;i<config.params.length;i++){
			htmlstr+='<param name="'+config.params[i].name+'" value="'+config.params[i].val+'">';
		}
		htmlstr+='</object>';
		$(config.renderTo==''?'body':config.renderTo).append(htmlstr);
		
		
		
	},
	
});