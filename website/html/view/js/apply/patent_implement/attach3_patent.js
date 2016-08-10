
document.write('<script type="text/javascript" src="/common/html/js/common.js"></script>');

function ischeck(value,name){
	if(value==1){
		// 通过
		$.post('../../../../../modules/php/action/page/projectapp/projectapp.act.php?action=execute&name='+table_id,function(result){
			if(result['code']!=0){
				window.location.href='/website/html/view/template/user_project.php';
			}
		});
	}else if(value==0){
		
		//不通过
	}
}


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
	
	$('.org_info').bind('click',function(){
		$('.iframe iframe').attr('src','org_info.php?table_status='+table_status+'&user_type='+user_type);
	});
	$('.project_info').bind('click',function(){
		$('.iframe iframe').attr('src','project_info.php?table_status='+table_status+'&user_type='+user_type);
	});
	$('.project_fund').bind('click',function(){
		$('.iframe iframe').attr('src','project_fund.php?table_status='+table_status+'&user_type='+user_type);
	});
	$('.main_staff').bind('click',function(){
		$('.iframe iframe').attr('src','main_staff.php?table_status='+table_status+'&user_type='+user_type);
	});
	
	$('.stuff_list').bind('click',function(){
		$('.iframe iframe').attr('src','stuff_list.php?table_status='+table_status+'&user_type='+user_type);
	});

	$('.references').bind('click',function(){
		$('.iframe iframe').attr('src','references.php?table_status='+table_status+'&user_type='+user_type);
	});
	$('.community_opinion').bind('click',function(){
		$('.iframe iframe').attr('src','community_opinion.php?table_status='+table_status+'&user_type='+user_type);
	});
/*	$('.check').bind('click',function(){
		$('.iframe iframe').attr('src','/center/php/action/page/check_opinion.php?table_status='+table_status+"&table_id=" + table_id + '&user_type=' + user_type);
	});*/
	$('.org_info').click();
	
}


function removeSession(){
	$.get('../../../php/action/page/main.php?action=removeSession',function(){});
}


$(function(){
	clickEffect();//设置单击效果
	setATarget();//设置链接显示到iframe中

});

function setATarget(){
	$('.home a').attr({'target':'layout_right'});
	$('.information a').attr({'target':'layout_right'});
	$('.apply a').attr({'target':'layout_right'});
}

function setSuccess(classname,complete){
	if(complete) {
		$('.'+classname).children('.pic').show();
	} else {
		$('.'+classname).children('.pic').hide();
	}
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



