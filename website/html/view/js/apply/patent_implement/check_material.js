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
			$('#iframe2').css('width',iframe_width-200);
		}
	});*/
	$('.org_info').bind('click',function(){
		$('.iframe iframe').attr('src','org_info.php?table_status='+table_status+'&user_type='+user_type);
	});
	$('.unit_info').bind('click',function(){
		$('.iframe iframe').attr('src','unit_info.php?table_status='+table_status+'&user_type='+user_type);
	});
	$('.authent').bind('click',function(){
		$('.iframe iframe').attr('src','authent.php?table_status='+table_status+'&user_type='+user_type);
	});
	$('.index_complete').bind('click',function(){
		$('.iframe iframe').attr('src','index_complete.php?table_status='+table_status+'&user_type='+user_type);
	});

	$('.spread').bind('click',function(){
		$('.iframe iframe').attr('src','spread.php?table_status='+table_status+'&user_type='+user_type);
	});
	$('.develop').bind('click',function(){
		$('.iframe iframe').attr('src','develop.php?table_status='+table_status+'&user_type='+user_type);
	});
	$('.talent_training').bind('click',function(){
		$('.iframe iframe').attr('src','talent_training.php?table_status='+table_status+'&user_type='+user_type);
	});
	$('.funds_use').bind('click',function(){
		$('.iframe iframe').attr('src','funds_use.php?table_status='+table_status+'&user_type='+user_type);
	});
	$('.improve').bind('click',function(){
		$('.iframe iframe').attr('src','improve.php?table_status='+table_status+'&user_type='+user_type);
	});
	$('.unit_opinion').bind('click',function(){
		$('.iframe iframe').attr('src','unit_opinion.php?table_status='+table_status+'&user_type='+user_type);
	});
	$('.final_opinion').bind('click',function(){
		$('.iframe iframe').attr('src','final_opinion.php?table_status='+table_status+'&user_type='+user_type);
	});
	
	$('.org_info').click();
	
	
}

