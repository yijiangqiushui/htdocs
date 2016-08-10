// JavaScript Document
var res;
$(function(){
	$('title').text(SYSTEM.name);//设置页面标题

	load_notice();
});

function load_notice(){
	$.post('../../../php/action/page/notice.php?action=detail',{id:$._GET('id')},function(ret_val){
		res=eval("("+ret_val+")");
		$('.notice_title').html(res.title);
		$('.notice_datetime span').html(res.add_time);
		$('.notice_content').html(res.content);
	
		//$attachment='http://localhost/common/'+res.attach;//附件路径
		$attachment='/common/'+res.attach;//附件路径
		if(res.attach!=''){
			/*$('.notice_content').append('<div class="notice_attachment"><img src="/website/html/view/img/attachment.gif" align="absmiddle" />附件：<a href="'+$attachment+'" target="_blank">点击下载</a></div>');*/
			
			$('.notice_content').append('<div class="notice_attachment"><img src="/website/html/view/img/attachment.gif" align="absmiddle" />附件：<a href="javascript:void(0)" onclick="downFile()">点击下载</a></div>');
		}
	});
}

function downFile(){
	window.open('../../../php/action/page/notice.php?action=downFile&attach='+$attachment);
/*	$.post('/website/php/action/page/notice.php?action=downFile',{attach:$attachment},function(result){
		alert(result+'-----------------');
	});*/
}

function win_close(){    
    var browserName=navigator.appName;    
    if (browserName=="Netscape") {    
        window.open('','_self','');    
        window.close();
    } else {    
		window.close();    
    }  
}    