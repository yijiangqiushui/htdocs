// JavaScript Document
/**
 * jQuery HLUI 2.0.1
 * Table
 * 
 * Copyright(c) 2014-2014 omnimediawindows [ 1499962582@qq.com ] 
 * Author:Li Zhixiao
 * 
 */

$.extend({
	upgradeIE:function(){
		var ie_ver=$.ieVer();
		var is_upgrade=false;
		if(ie_ver=='IE6'){
			is_upgrade=true;
		}
		if(ie_ver=='IE7'){
			is_upgrade=true;
		}
		if(is_upgrade){
			$('body').append('<div class="hlui-navigator" style="position:absolute; left:0; top:28px; border:1px solid #ccc; padding:10px; background-color:#fff; color:#333;"><div><p style="color:#f00;">不会吧？你还在使用'+ie_ver+'内核的浏览器？现在基本上在火星才能找到！</p><p>要是IE版本太低，我就变得不好看了！</p><p>赶紧升级吧：<a href="http://www.microsoft.com/zh-cn/download/internet-explorer.aspx" target="_blank">获取IE更高版本</a></p><p>换用其他浏览器：<a href="http://www.google.cn/intl/zh-CN/chrome/browser/">Chrome（谷歌浏览器）</a>、<a href="http://www.firefox.com.cn/download/" target="_blank">Firefox（火狐浏览器）</a></p></div></div><div class="info"></div>');
			$('.hlui-navigator *').css({'font-size':'14px','line-height':'24px'});
		}
	},
	ieVer:function(){
		var browser=navigator.appName;
		var b_version=navigator.appVersion; 
		var version=b_version.split(";"); 
		var trim_Version=version[1].replace(/[ ]/g,""); 
		if(browser=="Microsoft Internet Explorer" && trim_Version=="MSIE6.0"){ 
			return 'IE6';
		} 
		else if(browser=="Microsoft Internet Explorer" && trim_Version=="MSIE7.0"){ 
			return 'IE7';
		} 
		else if(browser=="Microsoft Internet Explorer" && trim_Version=="MSIE8.0"){ 
			return 'IE8';
		} 
		else if(browser=="Microsoft Internet Explorer" && trim_Version=="MSIE9.0"){ 
			return 'IE9';
		}
		else{
			return 'IE9+/OTHER';
		}	
	}
});