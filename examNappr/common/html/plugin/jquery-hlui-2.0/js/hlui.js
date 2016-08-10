// JavaScript Document
/**
 * jQuery HLUI 1.1.2
 * Hawking Lee UI
 * 
 * Copyright(c) 2014-2014 omnimediawindows [ 1499962582@qq.com ] 
 * Author:Li Zhixiao
 * 
 */

$.extend({
	include:function(url){
		var url_arr=typeof url=='string'?[url]:url;
		for(var i=0;i<url_arr.length;i++){
			var name=url_arr[i].replace(/^\s|\s$/g,'');
			var att=name.split('.');
			var ext=att[att.length-1].toLowerCase();
			var is_css=(ext=='css');
			var tag=is_css?'link':'script';
			var attr=is_css?' type="text/css" rel="stylesheet" ':' type="text/javascript" ';
			var src=(is_css?'href':'src')+'="'+name+'"';
			if($(tag+'['+src+']').length==0)$('head').append('<'+tag+attr+src+'></'+tag+'>');
		}
	},
	_GET:function(param){
		var url=window.location.href;
		var url_arr=url.split('?');
		if(url_arr.length>1){
			var item_arr=url_arr[1].split('&');
			if(url_arr.length>0){
				var jsonstr='({';
				for(var i=0;i<item_arr.length;i++){
					var param_arr=item_arr[i].split('=');
					jsonstr+=(i==0?'':',')+'"'+param_arr[0]+'":"'+param_arr[1]+'"';
				}
				jsonstr+='})';
				var json=eval(jsonstr);
				return json[param];
			}
		}
		return {};
	},
	data_option_format:function(d_opt){
		var json=eval('({'+d_opt+'})');
		return json;
	}
});

