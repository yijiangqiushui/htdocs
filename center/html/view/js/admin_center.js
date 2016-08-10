// JavaScript Document
var SETTINGARGS={small_icon_width:119,toggleBtn_width:10,admin_center_iframe_width:100,
target_url:['/sns/community/admincp.php','/website/index.php?m=admin&c=index','main.html','/lab/html/view/template/']
};

/**
*当改变浏览器尺寸时调整相关元素的尺寸
*/
$(window).resize(function() {
	//$('.wrapper').text($(window).width()+" "+$(window).height());
	resetElementsSize();
});

$(document).ready(function(){
	$.post("../../../php/action/page/admin_center.php?action=init",function(result){
		if(result.type=='success'){

	$('title').text(SYSTEM.name);//设置页面标题
	//$('.copyright').html(SYSTEM.copyright);//设置版权文字

	for(var i=0;i<SETTINGARGS.target_url.length;i++){
		$('.s-i-'+i).attr({'href':SETTINGARGS.target_url[i],'target':'admin_center_iframe'});
		$('.l-i-'+i).attr({'href':SETTINGARGS.target_url[i],'target':'admin_center_iframe'});
		$('.s-i-'+i).bind('click',{id:i},function(event){
			$('.small_icon_block').css('background-color','#fff');$('.s-i-'+event.data.id).css('background-color','#ddd');
			$('.large_icon_block').css('background-color','#fff');$('.l-i-'+event.data.id).css('background-color','#ddd');
			hideLargeIcon();});
		$('.l-i-'+i).bind('click',{id:i},function(event){
			$('.small_icon_block').css('background-color','#fff');$('.s-i-'+event.data.id).css('background-color','#ddd');
			$('.large_icon_block').css('background-color','#fff');$('.l-i-'+event.data.id).css('background-color','#ddd');
			hideLargeIcon();});
	}

	resetElementsSize();
	
	document.body.onselectstart=function(){return false;}//ie下禁止选择文字
	
		}
		else if(result.type=='forbidden'){
			$('body').html('');
			alert('提示：您还未登录或已经超时退出，请重新登录！');
			window.location.href='index.html';
		}
		else{
			$('body').html('');
			alert('提示：系统发生错误，请联系技术人员进行处理！');
		}
	},
    //返回类型
    "json");
});

/**
*页面尺寸随着浏览器改变时相应地改变相关元素
*/
function resetElementsSize(){
	$('.small_icon').css({'width':SETTINGARGS.small_icon_width,'height':$(window).height()});
	$('.toggleBtn').css({'width':SETTINGARGS.toggleBtn_width,'height':$(window).height()});
	$('.admin_center_iframe').css({'width':($(window).width()-($('.small_icon').css('display')!='block'?0:SETTINGARGS.small_icon_width)-SETTINGARGS.toggleBtn_width-4),'height':$(window).height()});
}

/**
*显示大图标界面，显示小图标和Iframe
*/
function showLargeIcon(){
	$('.small_icon_choice').css({'display':'none'});
	$('.large_icon_choice').css({'display':'block'});
}

/**
*隐藏大图标界面，隐藏小图标和Iframe
*/
function hideLargeIcon(){
	$('.large_icon_choice').css({'display':'none'});
	$('.small_icon_choice').css({'display':'block'});
}

function toggleArea(){
	if($('.small_icon').css('display')!='block'){
		$('.small_icon').css({'display':'block'});
		$('.toggleBtn').css({'background-image':'url(../img/toggle-expand.png)'});
		$('.admin_center_iframe').css({'width':($(window).width()-SETTINGARGS.small_icon_width-SETTINGARGS.toggleBtn_width-4)});
	}
	else {
		$('.small_icon').css({'display':'none'});
		$('.toggleBtn').css({'background-image':'url(../img/toggle-expand_.png)'});
		$('.admin_center_iframe').css({'width':($('.admin_center_iframe').width()+SETTINGARGS.small_icon_width)});
	}
}