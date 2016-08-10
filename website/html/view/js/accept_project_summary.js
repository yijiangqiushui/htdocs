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
/*	$('.switch-bar').bind('click',function(){
		if($('.menus').css('display')!='none'){
			$('.menus').css('display','none');
			$('.menu-bar').css('display','none');
			$('.menu-bar').css('background-image','url(../../url)');
		}
		else{
			$('.menus').css('display','block');
			$('.menu-bar').css('display','block');
			$('.menu-bar').css('background-image','url(/website/html/view/img/main-xmsbxt/manage.png)');
		}
	});*/
	
	$('.project_goal').bind('click',function(){
		$('.iframe iframe').attr('src','Acceptance/project_goal.php?table_status='+table_status+"&user_type="+user_type);
	});
	$('.project_kpi').bind('click',function(){
		$('.iframe iframe').attr('src','Acceptance/project_kpi.php?table_status='+table_status+"&user_type="+user_type);
	});
	$('.content').bind('click',function(){
		$('.iframe iframe').attr('src','Acceptance/project_chief_content.php?table_status='+table_status+"&user_type="+user_type);
	});
	$('.achievement').bind('click',function(){
		$('.iframe iframe').attr('src','Acceptance/project_achievement.php?table_status='+table_status+"&user_type="+user_type);
	});
	$('.ther_suggest').bind('click',function(){
		$('.iframe iframe').attr('src','Acceptance/project_other_suggest.php?table_status='+table_status+"&user_type="+user_type);
	});
	$('.generalize_plan').bind('click',function(){
		$('.iframe iframe').attr('src','Acceptance/project_generalize_plan.php?table_status='+table_status+"&user_type="+user_type);
	});
	$('.project_org_suggest').bind('click',function(){
		$('.iframe iframe').attr('src','Acceptance/project_org_suggest.php?table_status='+table_status+"&user_type="+user_type);
	});
/*	$('.check').bind('click',function(){
		$('.iframe iframe').attr('src',"/center/php/action/page/check_opinion.php?status="+table_status+"&table_id="+table_id+ "&user_type=" + user_type);
	});*/
	$('.project_goal').click();
	
}

/*function resetWNH(){
	$('.menusNiframe').height($(window).height());
	$('.iframe iframe').width($(window).width()-214);
	$('.iframe iframe').height($('.menusNiframe').height());
	
}*/


function setupPro(){
	$.post('../../../../modules/php/action/page/projectapp/projectapp.act.php?action=setupPro',function(result){
		if(result['code']!=0){
			alert("提交成功");
			window.location.href='userlist.php';
		}
	});
}
function removeSession(){
	$.get('../../../php/action/page/main.php?action=removeSession',function(){});
}
$(function(){
	$('title').text("科学技术奖申报流程");
	removeSession();
	setID2Href();
	
	layout();//初始化布局
	
	clickEffect();//设置单击效果
	
	setATarget();//设置链接显示到iframe中

});

function setATarget(){
	$('.home a').attr({'target':'layout_right'});
	$('.information a').attr({'target':'layout_right'});
	$('.apply a').attr({'target':'layout_right'});
}

function layout(){
	$.layout();//没有参数则左部使用默认宽度
	$.layout_padding(0);
	$.layout_west_append($('.default_left').html());
	$.layout_east_append('<iframe src="default_iframe.html" id="layout_right" name="layout_right" width="100%" height="100%" frameborder="0"></iframe>');
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

function back2main(){
	window.location.href='main.html';
}

