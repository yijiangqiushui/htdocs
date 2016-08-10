function execute(){
//	alert("value="+value+"  name="+name);
	//alert();
	if(value==1){
		// 通过
		var table_name = encodeURI("北京市通州区科技计划项目任务书");
		$.post('/modules/php/action/page/projectapp/projectapp.act.php?action=execute&name='+table_name,function(result){
			if(result['code']!=0){
				
				window.location.href='/website/html/view/template/user_project.php';
			}
		});
	}else if(value==0){
		//不通过
		
	}
	
}

function assignment(){
	
	$.post('../../../../modules/php/action/page/projectapp/projectapp.act.php?action=assignment',function(result){
		if(result['code']!=0){
			alert("提交成功");
			window.location.href='/website/html/view/template/user_project.php';
		}
	});
	
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
	var table_name = encodeURI("北京市通州区科技计划项目任务书");
	$.post('/modules/php/action/page/attach/attach2.act.php?action=attach_attr&table_name='+table_name,function(result){
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
		$('.iframe iframe').attr('src','../../../../website/html/view/template/Projectapp/org_info.php?status='+table_status);
	});
	
	$('.project_target').bind('click',function(){
		$('.iframe iframe').attr('src','../../../../website/html/view/template/Projectapp/task_project_target.php?status='+table_status);
	});
	
	$('.project_content').bind('click',function(){
		$('.iframe iframe').attr('src','../../../../website/html/view/template/Projectapp/task_project_content.php?status='+table_status);
	});
	
	$('.project_techway').bind('click',function(){
		$('.iframe iframe').attr('src','../../../../website/html/view/template/Projectapp/task_project_techway.php?status='+table_status);
	});
	
	$('.project_ann_plan').bind('click',function(){
		$('.iframe iframe').attr('src','../../../../website/html/view/template/Projectapp/task_project_ann_plan.php?status='+table_status);
	});
	
	$('.total_fund').bind('click',function(){
		$('.iframe iframe').attr('src','../../../../website/html/view/template/Projectapp/task_project_money.php?status='+table_status);
	});
	
	$('.project_expert_form').bind('click',function(){
		$('.iframe iframe').attr('src','../../../../website/html/view/template/Projectapp/task_project_expert_form.php?status='+table_status);
	});
	
	$('.project_member').bind('click',function(){
		$('.iframe iframe').attr('src','../../../../website/html/view/template/Projectapp/task_project_member.php?status='+table_status);
	});
	
	$('.project_parties_response').bind('click',function(){
		$('.iframe iframe').attr('src','../../../../website/html/view/template/Projectapp/project_parties_response.php?status='+table_status);
	});
	
	$('.other_condition').bind('click',function(){
		$('.iframe iframe').attr('src','../../../../website/html/view/template/Projectapp/other_condition.php?status='+table_status);
	});
	
	$('.plan_parties').bind('click',function(){
		$('.iframe iframe').attr('src','../../../../website/html/view/template/Projectapp/plan_parties.php?status='+table_status);
	});
	$('.check').bind('click',function(){
//		var tmp_name = '项目任务书';
		$('.iframe iframe').attr('src',"/center/php/action/page/check_opinion.php?status="+table_status+"&table_name='北京市通州区科技计划项目任务书'"+ "&user_type=" + user_type);
	});
}

function resetWNH(){
	$('.menusNiframe').height($(window).height());
	$('.iframe iframe').width($(window).width()-214);
	$('.iframe iframe').height($('.menusNiframe').height());
	
}


/**
Modified By Gao Xue 
date:2014-06-19
*/
//var isCheck_award,isCheck_unit,isCheck_peo;

function setupPro(){
	//alert("fff");
	$.post('../../../../modules/php/action/page/projectapp/projectapp.act.php?action=setupPro',function(result){
		if(result['code']!=0){
			alert("提交成功");
			window.location.href='userlist.php';
		}
	});
}

function setID2Href(){
	var flag=$_GET('flag');
	var id=$_GET('id');
	
	if(flag=='1'||flag=='2'){
		$('.apply a').each(function(){
			$(this).attr('href',$(this).attr('href')+'?flag='+flag+'&id='+id);
		});
		/****************一、基本信息****************************************/
		$.get('',function(result){
			var res=eval("("+result+")");
			if(res.isSave!=null){
				setStep(0,'(√)');
			}else{
				setStep(0,'(未填写)');
			}
		});

		$.get('',function(result){
			var res=eval("("+result+")");
			if(res.isSave!=null){
				setStep(1,'(√)');
			}else{
				setStep(1,'(未填写)');
			}
		});

		$.get('',function(result){
			var res=eval("("+result+")");
			if(res.isSave!=null){
				setStep(2,'(√)');
			}else{
				setStep(2,'(未填写)');
			}
		}); 

		$.get('',function(result){
			//alert('apply4'+result+'============');
			var res=eval("("+result+")");
			if(res.isSave!=null){
				setStep(3,'(√)');
			}else{
				setStep(3,'(未填写)');
			}
		}); 

		$.post('',function(result){
			if(result!='{"total":0,"rows":[]}'){
				setStep(4,'(√)');
			}else{
				setStep(4,'(未填写)');
			}
		});

		$.post('',function(result){
			if(result!='{"total":0,"rows":[]}'){
				setStep(5,'(√)');
			}else{
				setStep(5,'(未填写)');
			}
		});

		$.post('',function(result){
			if(result!='{"total":0,"rows":[]}'){
				setStep(6,'(√)');
			}else{
				setStep(6,'(未填写)');
			}
		});

		$.post('',function(result){
			if(result!='{"total":0,"rows":[]}'){
				setStep(8,'(√)');
			}else{
				setStep(8,'(未填写)');
			}
		});
		$.post('',function(result){
			if(result!='{"total":0,"rows":[]}'){
				setStep(9,'(√)');
			}else{
				setStep(9,'(未填写)');
			}
		});
		$.post('',function(result){
			if(result!='{"total":0,"rows":[]}'){
				setStep(10,'(√)');
			}else{
				setStep(10,'(未填写)');
			}
		});
		$.post('',function(result){
			if(result!='{"total":0,"rows":[]}'){
				setStep(11,'(√)');
			}else{
				setStep(11,'(未填写)');
			}
		});
		$.post('',function(result){
			if(result!='{"total":0,"rows":[]}'){
				setStep(12,'(√)');
			}else{
				setStep(12,'(未填写)');
			}
		});
		$.post('',function(result){
			if(result!='{"total":0,"rows":[]}'){
				setStep(13,'(√)');
			}else{
				setStep(13,'(未填写)');
			}
		});
		$.post('',function(result){
			if(result!='{"total":0,"rows":[]}'){
				setStep(14,'(√)');
			}else{
				setStep(14,'(未填写)');
			}
		});

		$.post('',{page:1,rows:5},function(result){
			if(result!='{"total":0,"rows":[]}'){
				setStep(16,'(√)');
			}else{
				setStep(16,'(未填写)');
			}
		});
	}
	/*if(flag=='2'){
		$('.apply a').each(function(){
			$(this).attr('href',$(this).attr('href')+'?flag='+flag+'&id='+id);
		});
		$.get('../../../../modules/php/action/page/applycation/apply.act.php?action=findApply&id='+id,function(result){
			var res=eval("("+result+")");
			if(res.isCheck=='0'||res.isCheck==null){
				setStep(0,'(审核未通过)');
			}else{
				setStep(0,'(通过)');
			}
		});
		$.get('../../../../modules/php/action/page/applycation/apply.act.php?action=findBrief&id='+id,function(result){
			var res=eval("("+result+")");
			if(res.isCheck=='0'||res.isCheck==null){
				if(res.isCheck==null){
					setStep(1,'(此项未填写、未审核)');
				}else{
					setStep(1,'(审核未通过)');
				}
			}else{
				setStep(1,'(通过)');
			}
		});
		$.get('../../../../modules/php/action/page/applycation/apply.act.php?action=findCreate&id='+id,function(result){
			var res=eval("("+result+")");
			if(res.isCheck=='0'||res.isCheck==null){
				if(res.isCheck==null){
					setStep(2,'(此项未填写、未审核)');
				}else{
					setStep(2,'(审核未通过)');
				}
			}else{
				setStep(2,'(通过)');
			}
		}); 
		$.get('../../../php/action/page/apply4.act.php?action=show&aid='+id,function(result){
			var res=eval("("+result+")");
			if(res.isCheck=='0'||res.isCheck==null){
				if(res.isCheck==null){
					setStep(3,'(此项未填写、未审核)');
				}else{
					setStep(3,'(审核未通过)');
				}
			}else{
				setStep(3,'(通过)');
			}
		}); 
		$.post('../../../php/action/page/apply5.act.php?action=query&id='+id,{page:1,rows:5},function(result){
			if(result!='{"total":0,"rows":[]}'){
				$.get('../../../../modules/php/action/page/applycation/apply.act.php?action=findApply&id='+id,function(result){
					var res=eval("("+result+")");
					if(res.isCheck_award==0){
						setStep(4,'(审核未通过)');
					}else{
						setStep(4,'(通过)');
					}
				});
			}else{
				setStep(4,'(此项未填写、未审核)');
			}
		});
		$.post('../../../php/action/page/apply6.act.php?action=query&id='+id,{page:1,rows:5},function(result){
			if(result!='{"total":0,"rows":[]}'){
				$.get('../../../../modules/php/action/page/applycation/apply.act.php?action=findApply&id='+id,function(result){
					var res=eval("("+result+")");
					if(res.isCheck_unit==0){
						setStep(5,'(审核未通过)');
					}else{
						setStep(5,'(通过)');
					}
				});
				
			}else{
				setStep(5,'(此项未填写、未审核)');
			}
		});
		$.post('../../../php/action/page/apply7.act.php?action=query&id='+id,{page:1,rows:5},function(result){
			if(result!='{"total":0,"rows":[]}'){
				$.get('../../../../modules/php/action/page/applycation/apply.act.php?action=findApply&id='+id,function(result){
					var res=eval("("+result+")");
					if(res.isCheck_peo==0){
						setStep(6,'(审核未通过)');
					}else{
						setStep(6,'(通过)');
					}
				});
			}else{
				setStep(6,'(此项未填写、未审核)');
			}
		});
		
	}*/
/*	else{
		$('.apply a').each(function(){
			$(this).attr('href',$(this).attr('href')+'?flag='+flag);
		});
	}*/
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