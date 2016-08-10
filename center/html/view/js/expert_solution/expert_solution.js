
function ischeck(value,name){
//	alert("value="+value+"  name="+name);
	
	if(value==1){
		// 通过
		$.post('/modules/php/action/page/projectapp/projectapp.act.php?action=execute&name=专家组论证意见',function(result){
			if(result['code']!=0){
				
				window.location.href='/website/html/view/template/user_project.php';
			}
		});
	}else if(value==0){
		//不通过
		
	}
	
}

function expert_solution(){
	if(confirm("你确定要提交吗？")){
	$.post('../../../../modules/php/action/page/projectapp/projectapp.act.php?action=expert_solution',function(result){
		if(result['code']!=0){
			//alert("提交成功");
			window.location.href='/website/html/view/template/user_project.php';
		}
	});
	}
}

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
	$.post('/modules/php/action/page/attach/attach2.act.php?action=attach_attr&table_name=专家组论证意见',function(result){
	    	var res = eval("("+result+")");
	    	table_status = res.table_status;
	    	user_type = res.user_type;
	    	//是其他用户，科委or管理员
	    	if(user_type==1 || user_type==2|| user_type==3 )
	    	{
	    		//驳回修改or审核通过，显示审核意见
	    		  if(table_status > 2)
	    	      {
	    		   $('.check').css({display:'block'});
	    		  }
	    	}
	    	//是申报用户
	    	if(user_type == 0 || user_type == -1){ 
	    		//待提交
	    	   if(table_status ==1 ){	
	    		   $('.submit').css({display:'block'});
	    	       $('.check').css({display:'none'});
	    	   }
	    	   //或者驳会修改
	    	   else if(table_status == 3 ){
	    		   $('.submit').css({display:'block'});  
	    		   $('.check').css({display:'block'});
	    	   }else{
	    	       $('.check').css({display:'block'});
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
	
	$('.expert_arguments').bind('click',function(){
		$('.iframe iframe').attr('src','../../../../website/html/view/template/Projectapp/expert_arguments.php?status='+table_status);
	});
	
	$('.expert_sign').bind('click',function(){
		$('.iframe iframe').attr('src','../../../../website/html/view/template/Projectapp/expert_sign.php?status='+table_status);
	});
	
	$('.check').bind('click',function(){
		$('.iframe iframe').attr('src',"/center/php/action/page/check_opinion.php?status="+table_status+"&table_name='专家名单及专家论证意见'" + "&user_type=" + user_type);
	});
	
	
}

function resetWNH(){
	$('.menusNiframe').height($(window).height());
	$('.iframe iframe').width($(window).width()-214);
	$('.iframe iframe').height($('.menusNiframe').height());
	
}

$(function(){
	$('title').text("科学技术奖申报流程");
	removeSession();
	setID2Href();
	
	layout();//初始化布局
	
	clickEffect();//设置单击效果
	
	setATarget();//设置链接显示到iframe中

	
	//selectStep(0);
	//setStep(0,'(√)');
	//selectStep(1);//设置选中某个步骤
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
	$.layout_east_append('<iframe src="default_user_iframe.html" id="layout_right" name="layout_right" width="100%" height="100%" frameborder="0"></iframe>');
	$('.default_left').html('');
}

function setStep(index,text){
	$('.apply li').each(function(i){
		if(i==index){
			$(this).find('span').text(text);
		}
	});
}

function selectStep(index){
	$('.apply li').each(function(i){
		if(i!=index){
			$(this).css({'background-color':''});
			$(this).find('a').css({'color':''});
		}
		else{
			$(this).css({'background-color':'#0066ff'});
			$(this).find('a').css({'color':'#fff'});
		}
	});
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
