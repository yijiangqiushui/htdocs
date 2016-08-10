

/**
 * 下边自己写的
 */


var table_status = '';
var user_type = '';

$(function(){
	init();
});

$(window).resize(function(){
	resetWNH();					  
});

function init(){
	resetWNH();
	bindEvents();
	getAttr();
}

//获取参数
function getAttr(){
	$.post('/modules/php/action/page/user_project/expertProAccept.act.php?action=attach_attr&table_name=项目验收专家组意见',function(result){
	    	var res = eval("("+result+")");
	    	table_status = res.table_status;
	    	user_type = res.user_type;
	});

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
	$('.switch-bar').bind('click',function(){
		if($('.menus').css('display')!='none'){
			$('.menus').css('display','none');
			$('.menu-bar').css('display','none');
			$('.menu-bar').css('background-image','url(../../url)');
		}
		else{
			$('.menus').css('display','block');
			$('.menu-bar').css('display','block');
			$('.menu-bar').css('background-image','url(../../url)');
		}
	});
	
	$('.project_goal').bind('click',function(){
		$('.iframe iframe').attr('src','/website/html/view/template/Acceptance/project_goal.php?status='+table_status);
	});
	$('.project_kpi').bind('click',function(){
		$('.iframe iframe').attr('src','/website/html/view/template/Acceptance/project_kpi.php?status='+table_status);
	});
	$('.content').bind('click',function(){
		$('.iframe iframe').attr('src','/website/html/view/template/Acceptance/project_chief_content.php?status='+table_status);
	});
	$('.achievement').bind('click',function(){
		$('.iframe iframe').attr('src','/website/html/view/template/Acceptance/project_achievement.php?status='+table_status);
	});
	$('.ther_suggest').bind('click',function(){
		$('.iframe iframe').attr('src','/website/html/view/template/Acceptance/project_other_suggest.php?status='+table_status);
	});
	$('.generalize_plan').bind('click',function(){
		$('.iframe iframe').attr('src','/website/html/view/template/Acceptance/project_generalize_plan.php?status='+table_status);
	});
	$('.project_org_suggest').bind('click',function(){
		$('.iframe iframe').attr('src','/website/html/view/template/Acceptance/project_org_suggest.php?status='+table_status);
	});
	$('.centercheck').bind('click',function(){
		$('.iframe iframe').attr('src',"/center/php/action/page/check_opinion.php?status="+table_status+"&table_name='项目总结报告书'"+ "&user_type=" + user_type);
	});
}

function resetWNH(){
	$('.menusNiframe').height($(window).height());
	$('.iframe iframe').width($(window).width()-214);
	$('.iframe iframe').height($('.menusNiframe').height());
	
}








//上边是自己写的