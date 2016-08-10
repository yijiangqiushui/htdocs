

/**
 * 我写的 是下边
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
	$.post('/modules/php/action/page/user_project/total_fundf.act.php?action=attach_attr&table_name=项目经费总决算表',function(result){
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
/*			if(i==1){
				$('.submenu').css('display','block');
			//	$('.iframe iframe').attr('src','user_info.php');
			}
			else{
				$('.submenu').css('display','none');
				$('.iframe iframe').attr('src','userlist.php');
			}*/
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
	
	$('.fund').bind('click',function(){
		$('.iframe iframe').attr('src','/website/html/view/template/total_fund.php?status='+table_status);
	});
	$('.centercheck').bind('click',function(){
		
		$('.iframe iframe').attr('src',"/center/php/action/page/check_opinion.php?status="+table_status+"&table_name='项目经费总决算表'" + '&user_type='+user_type);
	});
}

function resetWNH(){
	$('.menusNiframe').height($(window).height());
	$('.iframe iframe').width($(window).width()-214);
	$('.iframe iframe').height($('.menusNiframe').height());
	
}





//上边是我写的