
/**
 * 自己加的
 */
var table_status = '';
var user_type = '';
var table_id = '';


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
	$.post('/modules/php/action/page/attach/attach9.act.php?action=attach_attr&table_name=通州区支持科技企业孵化器大学科技园发展项目申报书',function(result){
	    	var res = eval("("+result+")");
	    	table_status = res.table_status;
	    	user_type = res.user_type;
	    	if(user_type==0 )
	    	{
	    		  if(table_status > 2)
	    	      {
	    		   $('.check').css({display:'block'});
	    		  }
	    	}
	    	else
	    	{
	    		$('.check').css({display:'block'});
	    	}
	    	if(user_type == 0){
	    	   if(table_status ==1 || table_status == 3){	
	    	    $('.submit').css({display:'block'});
	    	   }
	    	}
	});

}
function bindEvents(){
	var table_status;
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
	
	$('.org_info').bind('click',function(){
		$('.iframe iframe').attr('src','/website/html/view/template/apply/attach_9/org_info.php?status='+table_status);
	});
	$('.manager_team').bind('click',function(){
		$('.iframe iframe').attr('src','/website/html/view/template/apply/attach_9/manager_team.html?status='+table_status);
	});
	$('.manage_state').bind('click',function(){
		$('.iframe iframe').attr('src','/website/html/view/template/apply/attach_9/manage_state.html?status='+table_status);
	});
	$('.service').bind('click',function(){
		$('.iframe iframe').attr('src','/website/html/view/template/apply/attach_9/service.html?status='+table_status);
	});
	$('.hatch').bind('click',function(){
		$('.iframe iframe').attr('src','/website/html/view/template/apply/attach_9/hatch.html?status='+table_status);
	});
	$('.check').bind('click',function(){
		$('.iframe iframe').attr('src',"/center/php/action/page/check_opinion.php?table_name='通州区支持科技企业孵化器大学科技园发展项目申报书'"+'status='+table_status+ "&user_type=" + user_type);
	});
}

function resetWNH(){
	$('.menusNiframe').height($(window).height());
	$('.iframe iframe').width($(window).width()-214);
	$('.iframe iframe').height($('.menusNiframe').height());
	
}
//上边是自己加的



