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
	$('.org_info').click();
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
		$('.iframe iframe').attr('src','./Implement/modify_apply.php?table_status='+table_status+"&user_type=" + user_type);
	});
	
	
}

/*function resetWNH(){
	$('.menusNiframe').height($(window).height());
	$('.iframe iframe').width($(window).width()-214);
	$('.iframe iframe').height($('.menusNiframe').height());
	
}*/

function setupPro(){
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
//	var table_name = '通州区支持创新平台建设项目申报书';
	var length = $('ul li').length-2; //查找一共多长 也就是多标志位中放几个数值
//	alert(length+'aa'+className);
	var i=0,position;
	$('ul li').each(function() {
		if($(this).hasClass(className)) {//判断是谁 要置1 //这是判断第几个 
			position = i;
		}
		i++;
	});
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