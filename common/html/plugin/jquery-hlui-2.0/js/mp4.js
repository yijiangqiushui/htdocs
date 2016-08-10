/**
 * jQuery HLUI 1.1.2
 * MP4
 * 
 * Copyright(c) 2014-2014 omnimediawindows [ 1499962582@qq.com ] 
 * Author:Li Zhixiao
 * 
 */
var global={config:Object,index:0,time:0,interval:0,seekInterval:0};
 
$.extend({
	mp4_init:function(){
		$('.hlui-mp4').each(function(i){
			if($(this).attr('src')==''){
				$(this).html('提示：没有视频源！');
			}
			else{
				var config={
					renderTo:'#'+$(this).attr('id'),
					height:$(this).attr('height'),
					width:$(this).attr('width'),
					controls:$(this).attr('controls')=='controls'?true:false,
					autoplay:$(this).attr('autoplay')=='autoplay'?true:false,
					loop:$(this).attr('loop')=='loop'?true:false,
					muted:$(this).attr('muted')=='muted'?true:false,
					mp4_root:$(this).attr('mp4_root'),
					contextmenu:$(this).attr('contextmenu')==''?false:($(this).attr('contextmenu')=='true'?'true':false),
					autoposition:$(this).attr('autoposition')==''?false:($(this).attr('autoposition')=='true'?'true':false),
					src_arr:$(this).attr('src').split('|')
				};
				global.config=config;
				$.mp4_render();
			}
		});
	},
	mp4:function(config){
		global.config=config;
		$.mp4_render();
	},
 	mp4_render:function(){
		
		if(global.config.autoposition){
			global.index=!localStorage.getItem('mp4_list_index_'+global.config.id)?0:localStorage.getItem('mp4_list_index_'+global.config.id);
			global.time=!localStorage.getItem('mp4_play_time_'+global.config.id)?0:localStorage.getItem('mp4_play_time_'+global.config.id);
		}
		
		global.index=global.index>=global.config.src_arr.length?0:parseInt(global.index);
		
		var htmlstr='<video id="'+global.config.id+'" style="background-color:#000" height="'+global.config.height+'" width="'+global.config.width+'"'
		+(typeof(global.config.controls)=='undefined'?'':(global.config.controls?' controls="controls"':''))
		+(typeof(global.config.muted)=='undefined'?'':(global.config.muted?' muted="muted"':''))
		+' src="'+global.config.mp4_root+global.config.src_arr[global.index]+'">';

		htmlstr+='</video>';
		if(global.config.renderTo==''){
			$('body').append(htmlstr);
		}
		else{
			$(global.config.renderTo).html(htmlstr);
		}
		
		if(!global.config.contextmenu){
			$('#'+global.config.id).bind('contextmenu',function(){return false;});//屏蔽右键菜单
		}
		
		var Media=document.getElementById(global.config.id);
		if(global.config.autoplay){
			if(Media.NETWORK_IDLE){
				Media.play();
				if(global.config.autoposition){
					Media.pause();
					global.seekInterval=setInterval('mp4_auto_seek()',200);
				}
			}
		}
		global.interval=setInterval('mp4_auto_detect()',1000);
	},
	
});

function mp4_auto_seek(){//这个对自动定位播放很重要
	var Media=document.getElementById(global.config.id);
	if(Media.NETWORK_IDLE){
		Media.currentTime=global.time;
		Media.play();
		clearInterval(global.seekInterval);
	}
}

function mp4_auto_detect(){
	var Media=document.getElementById(global.config.id);
	if(Media.ended){
		global.index++;
		global.index=global.index>=global.config.src_arr.length?0:global.index;
		$('#'+global.config.id).attr('src',global.config.src_arr[global.index]);
		Media.play();
		
		if(!global.config.loop && global.index==0){
			clearInterval(global.interval);
			Media.pause();
		}
	}
	if(global.config.autoposition){
		localStorage.setItem('mp4_list_index_'+global.config.id,global.index);
		localStorage.setItem('mp4_play_time_'+global.config.id,Media.currentTime);
		$('#mytest').html('mp4_list_index'+global.config.id);
	}
}
	
