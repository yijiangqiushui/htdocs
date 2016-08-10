document.write('<script type="text/javascript" src="/common/html/js/common.js"></script>');



var table_status;
var user_type;
var table_id;
var iscomplete;
$(function(){
	init();
});

$(window).resize(function(){
	resetWNH();					  
});

function init(){
	resetWNH();

	bindEvents();
}


function bindEvents(){
	$('.my-project').bind('click',function(){
		$('.iframe iframe').attr('src','userlist.php');
	});
	$('.menu').each(function(i){
		$(this).bind('click',function(){
			$('.menu').removeClass('menu-selected');
			$('.menu').addClass('menu-unselected');
			$(this).removeClass('menu-unselected');
			$(this).addClass('menu-selected');
		}); 
	});
/*	$('#swich2').bind('click',function(){
		var iframe_width = $("#iframe2").width();
		if($('.menus').css('display')!='none'){
			$('.menus').css('display','none');
			$('.menu-bar').css('display','none');
			$('.menu-bar').css('background-image','url(../../url)');
			$('#iframe2').css('width',iframe_width+200);
		}
		else{
			$('.menus').css('display','block');
			$('.menu-bar').css('display','block');
			$('.menu-bar').css('background-image','url(/website/html/view/img/main-xmsbxt/manage.png)');
//			$('.menu-bar').css('background-image','url(../../url)');
			$('#iframe2').css('width',iframe_width-200);
		}
	});*/
	$('.abstract').bind('click',function(){
		$('.iframe iframe').attr('src','abstract.php?table_status='+table_status+'&user_type='+user_type);
	});
	$('.org_info').bind('click',function(){
		$('.iframe iframe').attr('src','org_info.php?table_status='+table_status+'&user_type='+user_type);
	});
	$('.tec_invalid_ana').bind('click',function(){
		$('.iframe iframe').attr('src','tec_invalid_ana.php?table_status='+table_status+'&user_type='+user_type);
	});
	$('.project_extent').bind('click',function(){
		$('.iframe iframe').attr('src','project_extent.php?table_status='+table_status+'&user_type='+user_type);
	});

	$('.market_situation').bind('click',function(){
		$('.iframe iframe').attr('src','market_situation.php?table_status='+table_status+'&user_type='+user_type);
	});
	$('.invest_analysis').bind('click',function(){
		$('.iframe iframe').attr('src','invest_analysis.php?table_status='+table_status+'&user_type='+user_type);
	});
	$('.economy_profit').bind('click',function(){
		$('.iframe iframe').attr('src','economy_profit.php?table_status='+table_status+'&user_type='+user_type);
	});
	$('.project_effect').bind('click',function(){
		$('.iframe iframe').attr('src','project_effect.php?table_status='+table_status+'&user_type='+user_type);
	});
/*	$('.check').bind('click',function(){
		$('.iframe iframe').attr('src','/center/php/action/page/check_opinion.php?table_status='+table_status+"&table_id=" + table_id + '&user_type=' + user_type);
	});*/
	
	$('.abstract').click();
	
	
}

/*function resetWNH(){
	$('.menusNiframe').height($(window).height());
	$('.iframe iframe').width($(window).width()-214);
	$('.iframe iframe').height($('.menusNiframe').height());
	
}*/


function setID2Href(){

	//var flag=$._GET('flag');
	//var id=$._GET('id');
	
}


/*$(function(){
	$('title').text("科学技术奖申报流程");
	//removeSession();
	layout();//初始化布局
	clickEffect();//设置单击效果
	setATarget();//设置链接显示到iframe中

});*/

function setATarget(){
	$('.home a').attr({'target':'layout_right'});
	$('.information a').attr({'target':'layout_right'});
	$('.apply a').attr({'target':'layout_right'});
}

function layout(){
	$.layout();//没有参数则左部使用默认宽度
	$.layout_padding(0);
	$.layout_west_append($('.default_left').html());
	$.layout_east_append('<iframe src="/website/html/view/template/default_user_iframe.html" id="layout_right" name="layout_right" width="100%" height="100%" frameborder="0"></iframe>');
	$('.default_left').html('');
}


function setSuccess(classname,complete){
	if(complete) {
		$('.'+classname).children('.pic').show();
	} else {
		$('.'+classname).children('.pic').hide();
	}
}
//getting li postion by class name


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

function back2main(){
	window.location.href='main.html';
}