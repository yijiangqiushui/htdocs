document.write('<script type="text/javascript" src="/common/html/js/common.js"></script>');

function ischeck(value,name){
	if(value==1){
		$.post('/modules/php/action/page/projectapp/projectapp.act.php?action=execute&name='+table_id,function(result){
			if(result['code']!=0){
				window.location.href='/website/html/view/template/user_project.php';
			}
		});
	}else if(value==0){
		//不通过
	}
}

function execute(){
		$.post('/modules/php/action/page/projectapp/projectapp.act.php?action=execute&name='+table_id,function(result){
		if(result['code']!=0){
			//需要改成confirm
			alert("提交成功！");
			window.location.href='/website/html/view/template/user_project.php';
		}
	});
}


function adapt_height() {
	var pheight=$(window.parent).height()-120;
	//alert(pheight);
	var height=$(".menus").height();
	if(height>pheight) {
		//alert(pheight+'+'+height);
		$(".menus").css({"overflow-y":"scroll","overflow-x":"hidden","height":pheight});
	}
	
}

$( function() {
	adapt_height();
	
});

var table_status = '';
var user_type = '';
var table_id = '';
$(function(){
	table_id = getQueryStringByName('table_id');
	init();
//	alert(table_id);
	
	var pheight=$(window.parent).height()-120;
	//alert(pheight);
	var height=$(".menus").height();
	if(height>pheight) {
		//alert(pheight+'+'+height);
		$(".menus").css({"overflow-y":"scroll","overflow-x":"hidden","height":pheight});
	}
	$(".org_info").addClass('menu-selected');
});

$(window).resize(function(){
	resetWNH();					  
});

function init(){
//	alert();
	resetWNH();
	bindEvents();
	getAttr();
}

//获取参数
function getAttr(){
	
//	var table_name = encodeURI("北京市通州区科技计划项目实施方案");

//	$.post('/modules/php/action/page/attach/attach1.act.php?action=attach_attr&table_name='+table_name,function(result){
	$.post('/modules/php/action/page/attach/attach1.act.php?action=attach_attr&table_id='+table_id,function(result){
	    	var res = eval("("+result+")");
	    	table_status = res.table_status;
	    	user_type = res.user_type;
/*	    	alert("table_status:" + table_status);
	    	alert("user_type:" + user_type);*/
	    	//科委  科长  super
	    	if(user_type==1 || user_type==2||user_type==3 )
	    	{
	    		//后台什么时候显示 审核？   
	    		  if(table_status >=2)
	    	      {
	    		    $('.check').css({display:'block'});
	    		  }
	    	}
	    	
	    	//是申报用户  后台生成用户
	    	if(user_type == 0 || user_type == -1){ 
	    		//待提交
	    	   if(table_status == 1 ){	 
	    		   
	    		   $('.submit').css({display:'block'});
	    	       $('.check').css({display:'none'});
	    	   }
	    	   //或者驳会修改
	    	   else if(table_status == 3 ){ 
	    		   $('.submit').css({display:'block'});
	    		   $('.check').css({display:'block'});
	    	   }
	    	   else{
	    	       $('.check').css({display:'block'});
	    	   }
	    	}
	    	
	    	var iscomplete = eval("("+res.iscomplete+")");
	    	var i = 0;
	    	$('ul li').each(function() {
	    		if(iscomplete.length > i && iscomplete[i] == 1) {
	    			$(this).children('.pic').show();
	    		}
	    		i++;
	    	});
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
	});
	$('.unit_info').bind('click',function(){
		$('.iframe iframe').attr('src','../../check_material/unit_info.php?table_status='+table_status+'&user_type='+user_type);
	});
	$('.org_info').bind('click',function(){
		$('.iframe iframe').attr('src','../../check_material/org_info.php?table_status='+table_status+'&user_type='+user_type);
	});
	$('.authent').bind('click',function(){
		$('.iframe iframe').attr('src','../../check_material/authent.php?table_status='+table_status+'&user_type='+user_type);
	});
	$('.index_complete').bind('click',function(){
		$('.iframe iframe').attr('src','../../check_material/index_complete.php?table_status='+table_status+'&user_type='+user_type);
	});
	$('.spread').bind('click',function(){
		$('.iframe iframe').attr('src','../../check_material/spread.php?table_status='+table_status+'&user_type='+user_type);
	});
	$('.develop').bind('click',function(){
		$('.iframe iframe').attr('src','../../check_material/develop.php?table_status='+table_status+'&user_type='+user_type);
	});
	$('.talent_training').bind('click',function(){
		$('.iframe iframe').attr('src','../../check_material/talent_training.php?table_status='+table_status+'&user_type='+user_type);
	});
	$('.funds_use').bind('click',function(){
		$('.iframe iframe').attr('src','../../check_material/funds_use.php?table_status='+table_status+'&user_type='+user_type);
	});
	$('.improve').bind('click',function(){
		$('.iframe iframe').attr('src','../../check_material/improve.php?table_status='+table_status+'&user_type='+user_type);
	});
	$('.unit_opinion').bind('click',function(){
		$('.iframe iframe').attr('src','../../check_material/unit_opinion.php?table_status='+table_status+'&user_type='+user_type);
	});
	$('.final_opinion').bind('click',function(){
		$('.iframe iframe').attr('src','../../check_material/final_opinion.php?table_status='+table_status+'&user_type='+user_type);
	});
	$('.check').bind('click',function(){
		$('.iframe iframe').attr('src','/center/php/action/page/check_opinion.php?table_status='+table_status+"&table_id=" + table_id + '&user_type=' + user_type);
    });
}

function resetWNH(){
	$('.menusNiframe').height($(window).height());
	$('.iframe iframe').width($(window).width()-214);
	$('.iframe iframe').height($('.menusNiframe').height());
	
}


function setID2Href(){

	//var flag=$._GET('flag');
	//var id=$._GET('id');
	
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

function setStep(classname,complete){
	if(complete) {
		$('.'+classname).children('.pic').show();
	} else {
		$('.'+classname).children('.pic').hide();
	}
	$('.'+classname).next().click();
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
function save_stage(className) {
	var table_name = '通州区支持创新平台建设项目申报书';
	var length = $('ul li').length-2; //查找一共多长 也就是多标志位中放几个数值
//	alert(length+'aa'+className);
	var i=0,position;
	$('ul li').each(function() {
		if($(this).hasClass(className)) {//判断是谁 要置1 //这是判断第几个 
			position = i;
		}
		i++;
	})
	var table_name = encodeURI(table_name);
	$.post('../../../../../../modules/php/action/page/projectapp/projectapp.act.php?action=isComplete&length='+length+'&position='+position+'&table_name='+table_name,function(result) {});
}