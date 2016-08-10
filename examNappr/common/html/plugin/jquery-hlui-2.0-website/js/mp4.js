/**
 * jQuery HLUI 1.1.2
 * MP4
 * 
 * Copyright(c) 2014-2014 omnimediawindows [ 1499962582@qq.com ] 
 * Author:Li Zhixiao
 * 
 */
var global={id:'',index:0,time:0,interval:0,seekInterval:0};
 
$.extend({
	mp4:function(config){
		//global.push(eval('{"'+config.id+'":{id:0,index:0,time:0,interval:0,seekInterval:0}'));
		global[config.id]={config:config,index:0,time:0,interval:0,seekInterval:0};
		//global[config.id].config=config;
		
		if(config.autoposition){
			global.index=!localStorage.getItem('mp4_list_index_'+config.id)?0:localStorage.getItem('mp4_list_index_'+config.id);
			global.time=!localStorage.getItem('mp4_play_time_'+config.id)?0:localStorage.getItem('mp4_play_time_'+config.id);
		}
		
		global.index=global.index>=config.src_arr.length?0:parseInt(global.index);
		
		var htmlstr='<video id="'+config.id+'" style="background-color:#000" height="'+config.height+'" width="'+config.width+'"'
		+(typeof(config.controls)=='undefined'?'':(config.controls?' controls="controls"':''))
		+(typeof(config.muted)=='undefined'?'':(config.muted?' muted="muted"':''))
		+' src="'+config.mp4_root+config.src_arr[global.index]+'">';

		htmlstr+='</video>';
		if(config.renderTo==''){
			$('body').append(htmlstr);
		}
		else{
			$(config.renderTo).html(htmlstr);
		}
		
		if(!config.contextmenu){
			$('#'+config.id).bind('contextmenu',function(){return false;});//屏蔽右键菜单
		}
		
		var Media=document.getElementById(config.id);
		if(config.autoplay){
			if(Media.NETWORK_IDLE){
				Media.play();
				if(config.autoposition){
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
	
