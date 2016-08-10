document.write('<script type="text/javascript" src="/common/html/js/common.js"></script>');

var table_status;
var user_type;
var table_id;
var iscomplete;

/*function adapt_height() { 
	var pheight=$(window.parent).height()-120;
	var height=$(".menus").height();
	if(height>pheight) {
		$(".pic").css("margin-right","5px");
		$(".menus").css({"overflow-y":"scroll","overflow-x":"hidden","height":pheight});
	}
	
}*/

$(function(){
	init();
});

function init(){
	//adapt_height();
	resetWNH();
	bindEvents();
}

$(window).resize(function(){
	resetWNH();					  
});

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
	
	
	//用来判断是否包含这个类
	if($('.menu').hasClass('check_define')){
		$(".org_info").click();
		return;
	}
	$('.org_info').bind('click',function(){ 
		$('.iframe iframe').attr('src','../../apply/attach_1/org_info.php?table_status='+table_status+'&user_type='+user_type);
	});
    
	$('.project_mean').bind('click',function(){
		$('.iframe iframe').attr('src','../../apply/attach_1/project_meaning.php?table_status='+table_status+'&user_type='+user_type);
	});
	$('.work_base').bind('click',function(){
		$('.iframe iframe').attr('src','../../apply/attach_1/project_status.php?table_status='+table_status+'&user_type='+user_type);
	});
	$('.project_target').bind('click',function(){
		$('.iframe iframe').attr('src','../../apply/attach_1/project_target.php?table_status='+table_status+'&user_type='+user_type);
	});
	$('.project_content').bind('click',function(){
		$('.iframe iframe').attr('src','../../apply/attach_1/project_content.php?table_status='+table_status+'&user_type='+user_type);
	});
	$('.tech_route').bind('click',function(){
		$('.iframe iframe').attr('src','../../apply/attach_1/project_techway.php?table_status='+table_status+'&user_type='+user_type);
	});
	$('.project_plan').bind('click',function(){
		$('.iframe iframe').attr('src','../../apply/attach_1/project_ann_plan.php?table_status='+table_status+'&user_type='+user_type);
	});
	$('.project_budget').bind('click',function(){
		$('.iframe iframe').attr('src','../../apply/attach_1/project_money.php?table_status='+table_status+'&user_type='+user_type);
	});
	$('.project_risk').bind('click',function(){
		$('.iframe iframe').attr('src','../../apply/attach_1/project_risk.php?table_status='+table_status+'&user_type='+user_type);
	});
	$('.expect_manage').bind('click',function(){
		$('.iframe iframe').attr('src','../../apply/attach_1/project_expert_form.php?table_status='+table_status+'&user_type='+user_type);
	});
	$('.recommend_plan').bind('click',function(){
		$('.iframe iframe').attr('src','../../apply/attach_1/project_economy_effect.php?table_status='+table_status+'&user_type='+user_type);
	});
	$('.project_member').bind('click',function(){

		$('.iframe iframe').attr('src','../../apply/attach_1/project_member.php?table_status='+table_status+'&user_type='+user_type);
	});
	$('.approve').bind('click',function(){
		$('.iframe iframe').attr('src','../../apply/attach_1/project_opinion_promise.php?table_status='+table_status+'&user_type='+user_type );
	});
}

function resetWNH(){
	$('.menus-scroll-hidden').height($(window).height());
	$('.menus').height($(window).height());
	$('.menusNiframe').height($(window).height());
	$('.iframe iframe').width($(window).width()-214);
	$('.iframe iframe').height($('.menusNiframe').height());
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

function setStep(classname,complete){
	if(complete) {
		$('.'+classname).children('.pic').show();
	} else {
		$('.'+classname).children('.pic').hide();
	}
	if($('.'+classname).next().css("display")!='none'){
		$('.'+classname).next().click();
	}
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
//getting li postion by class name

