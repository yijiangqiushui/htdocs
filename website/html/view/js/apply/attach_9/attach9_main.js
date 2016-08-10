document.write('<script type="text/javascript" src="/common/html/js/common.js"></script>');

function setStep(classname,complete){
//	alert("setstep");
	if(complete) {
		$('.'+classname).children('.pic').show();
	}else{
		$('.'+classname).children('.pic').hide();
	}
//	alert(classname);
//	alert($('.'+classname).next().click());
	if($('.'+classname).next().css("display")!='none'){
		$('.'+classname).next().click();
	}
	
//	$('.service').next().click();
}

/**
 * 自己加的
 */
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
	adapt_height();
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
	
	$('.org_info').bind('click',function(){
		$('.iframe iframe').attr('src','org_info.php?table_status='+table_status+"&user_type="+user_type);
	});
	$('.manager_team').bind('click',function(){
		$('.iframe iframe').attr('src','manager_team.html?table_status='+table_status+"&user_type="+user_type);
	});
	$('.manage_state').bind('click',function(){
		$('.iframe iframe').attr('src','manage_state.html?table_status='+table_status+"&user_type="+user_type);
	});
	$('.service').bind('click',function(){
		$('.iframe iframe').attr('src','service.html?table_status='+table_status+"&user_type="+user_type);
	});
	$('.hatch').bind('click',function(){
		$('.iframe iframe').attr('src','hatch.html?table_status='+table_status+"&user_type="+user_type);
	});
	$('.special').bind('click',function(){
		$('.iframe iframe').attr('src','special.html?table_status='+table_status+"&user_type="+user_type);
	});
	$('.running').bind('click',function(){
		$('.iframe iframe').attr('src','running.html?table_status='+table_status+"&user_type="+user_type);
	});
	$('.influence').bind('click',function(){
		$('.iframe iframe').attr('src','influence.php?table_status='+table_status+"&user_type="+user_type);
	});
	$('.service_job').bind('click',function(){
		$('.iframe iframe').attr('src','service_job.html?table_status='+table_status+"&user_type="+user_type);
	});
	$('.abstract').bind('click',function(){
		$('.iframe iframe').attr('src','abstract.html?table_status='+table_status+"&user_type="+user_type);
	});
/*	
	$('.check').bind('click',function(){
		$('.iframe iframe').attr('src',"/center/php/action/page/check_opinion.php?status="+table_status+"&table_id=" + table_id  + "&user_type=" + user_type);
	});*/
	
	$('.org_info').click();
}

/*function resetWNH(){
	$('.menusNiframe').height($(window).height());
	$('.iframe iframe').width($(window).width()-214);
	$('.iframe iframe').height($('.menusNiframe').height());
	
}*/
//上边是自己加的




/**
Modified By Gao Xue 
date:2014-06-19
*/
//var isCheck_award,isCheck_unit,isCheck_peo;

function setupPro(){
	alert("fff");
	$.post('../../../../modules/php/action/page/projectapp/projectapp.act.php?action=setupPro',function(result){
		if(rehsult['code']!=0){
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
/*	removeSession();
	setID2Href();*/
	
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
	$.layout_east_append('<iframe src="/website/html/view/template/default_user_iframe.html" id="layout_right" name="layout_right" width="100%" height="100%" frameborder="0"></iframe>');
	$('.default_left').html('');
}
/*
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
}*/

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


function save_stage(className) {
//	var table_name = '通州区支持科技成果转化项目申报书';
	var length = $('ul li').length-2; //查找一共多长 也就是多标志位中放几个数值
//	alert(length+'aa'+className);
	var i=0,position;
	$('ul li').each(function() {
		if($(this).hasClass(className)) {//判断是谁 要置1 //这是判断第几个 
			position = i;
		}
		i++;
	})
//	var table_name = encodeURI(table_name);
	$.post('../../../../../../modules/php/action/page/projectapp/projectapp.act.php?action=isComplete&length='+length+'&position='+position+'&table_name='+table_id,function(result) {});
}

function update_stage(className){
	var length = $('ul li').length-2; //查找一共多长 也就是多标志位中放几个数值
	var i=0,position;
	$('ul li').each(function() {
		if($(this).hasClass(className)) {//判断是谁 要置1 //这是判断第几个 
			position = i;
		}
		i++;
	});
//	alert('position:'+position+'length:'+length);
	$.post('../../../../../../modules/php/action/page/projectapp/projectapp.act.php?action=update_stage&length='+length+'&position='+position+'&table_name='+table_id,function(result) {});

}