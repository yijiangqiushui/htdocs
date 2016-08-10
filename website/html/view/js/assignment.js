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
	
	clickEffect();//设置单击效果
	setATarget();//设置链接显示到iframe中
	
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
/*	
	$('#swich2').bind('click',function(){
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
			$('#iframe2').css('width',iframe_width-200);
		}
	});*/
	
	
	if($('.menu').hasClass('check_define')){
		$(".org_info").click();
		return;
	}

	$('.org_info').bind('click',function(){
		$('.iframe iframe').attr('src','Projectapp/org_info.php?table_status='+table_status+"&user_type="+user_type);
	});
	
	$('.project_target').bind('click',function(){
		$('.iframe iframe').attr('src','Projectapp/task_project_target.php?table_status='+table_status+"&user_type="+user_type);
	});
	
	$('.project_content').bind('click',function(){
		$('.iframe iframe').attr('src','Projectapp/task_project_content.php?table_status='+table_status+"&user_type="+user_type);
	});
	
	$('.project_techway').bind('click',function(){
		$('.iframe iframe').attr('src','Projectapp/task_project_techway.php?table_status='+table_status+"&user_type="+user_type);
	});
	
	$('.project_ann_plan').bind('click',function(){
		$('.iframe iframe').attr('src','Projectapp/task_project_ann_plan.php?table_status='+table_status+"&user_type="+user_type);
	});
	
	$('.total_fund').bind('click',function(){
		$('.iframe iframe').attr('src','Projectapp/task_project_money.php?table_status='+table_status+"&user_type="+user_type);
	});
	
	$('.project_expert_form').bind('click',function(){
		$('.iframe iframe').attr('src','Projectapp/task_project_expert_form.php?table_status='+table_status+"&user_type="+user_type);
	});
	
	$('.project_member').bind('click',function(){
		$('.iframe iframe').attr('src','Projectapp/task_project_member.php?table_status='+table_status+"&user_type="+user_type);
	});
	
	$('.other_condition').bind('click',function(){
		$('.iframe iframe').attr('src','Projectapp/other_condition.php?table_status='+table_status+"&user_type="+user_type);
	});
	
	$('.plan_parties').bind('click',function(){
		$('.iframe iframe').attr('src','Projectapp/plan_parties.php?table_status='+table_status+"&user_type="+user_type);
	});
	
	
	$(".org_info").click();
}

/*function resetWNH(){
	$('.menusNiframe').height($(window).height());
	$('.iframe iframe').width($(window).width()-214);
	$('.iframe iframe').height($('.menusNiframe').height());
}*/

function setupPro(){
	//alert("fff");
	$.post('../../../../modules/php/action/page/projectapp/projectapp.act.php?action=setupPro',function(result){
		if(result['code']!=0){
			alert("提交成功");
			window.location.href='userlist.php';
		}
	});
}


function setATarget(){
	$('.home a').attr({'target':'layout_right'});
	$('.information a').attr({'target':'layout_right'});
	$('.apply a').attr({'target':'layout_right'});
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
