$(function(){
	$('title').text("申报单位管理中心");
	
	layout();//初始化布局
	
	clickEffect();//设置单击效果
	
	setATarget();//设置链接显示到iframe中
	
	isDeny();
});

function isDeny(){
	$.post('../../../php/action/page/main.php?action=isdeny',{},function(ret_val){
		if(ret_val=='deny'){
			window.location.href='index.html';
		}
	});
}

function setATarget(){
	$('.home a').attr({'target':'layout_east'});
	$('.information a').attr({'target':'layout_east'});
	$('.apply a').attr({'target':'layout_east'});
	$('.check a').attr({'target':'layout_east'});
}

function layout(){
	
	$.layout();//没有参数则左部使用默认宽度
	$.layout_padding(0);
	$.layout_west_append($('.default_left').html());
	$.layout_east_append('<iframe src="default_user_iframe.html" id="layout_east" name="layout_east" width="100%" height="100%" frameborder="0"></iframe>');
	$('.default_left').html('');
}

function clickEffect(){
	$('.menus a').each(function(){
		$(this).bind('click',function(){
			$('.menus li').css({'background-color':''});
			$('.menus li').find('a').css({'color':''});
			$(this).parent().css({'background-color':'#0066ff'});
			$(this).parent().find('a').css({'color':'#fff'});
		});
	});
}

function RGBToHex(rgb){
	var re=rgb.replace(/(?:\(|\)|rgb|RGB)*/g,"").split(",");//利用正则表达式去掉多余的部分，将rgb中的数字提取
	var hexColor="#";
	var hex=['0','1','2','3','4','5','6','7','8','9','a','b','c','d','e','f'];
	for(var i=0;i<re.length;i++){
		var hexint=parseInt(re[i]);
		if(hexint>16){
			hexColor+=hex[(hexint-hexint%16)/16]+hex[hexint%16];
		}
		else{
			hexColor+='0'+hex[hexint%16];
		}
	}
	return hexColor;
}

function logout(){
	$.post('../../../php/action/page/main.php?action=logout',function(data){
		if(data.type=='success'){
			window.location.href='index.html';
		}
	},'json');
}