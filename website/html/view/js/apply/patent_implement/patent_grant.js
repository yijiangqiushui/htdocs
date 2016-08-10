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
//			$('.menu-bar').css('background-image','url(../../url)');
			$('#iframe2').css('width',iframe_width-200);
		}
	});*/
	$('.pro_target').bind('click',function(){
		$('.iframe iframe').attr('src','pro_target.php?table_status='+table_status+'&user_type='+user_type);
	});
	$('.pro_meaning').bind('click',function(){
		$('.iframe iframe').attr('src','pro_meaning.php?table_status='+table_status+'&user_type='+user_type);
	});
	$('.pro_doing').bind('click',function(){
		$('.iframe iframe').attr('src','pro_doing.php?table_status='+table_status+'&user_type='+user_type);
	});
	$('.pro_fund').bind('click',function(){
		$('.iframe iframe').attr('src','pro_fund.php?table_status='+table_status+'&user_type='+user_type);
	});
	$('.pro_belong').bind('click',function(){
		$('.iframe iframe').attr('src','pro_belong.php?table_status='+table_status+'&user_type='+user_type);
	});
	$('.pro_member').bind('click',function(){
		$('.iframe iframe').attr('src','pro_menber.php?table_status='+table_status+'&user_type='+user_type);
	});
	$('.common_rule').bind('click',function(){
		$('.iframe iframe').attr('src','common_rule.php?table_status='+table_status+'&user_type='+user_type);
	});
	$('.other_rule').bind('click',function(){
		$('.iframe iframe').attr('src','other_rule.php?table_status='+table_status+'&user_type='+user_type);
	});
	$('.book_others').bind('click',function(){
		$('.iframe iframe').attr('src','book_others.php?table_status='+table_status+'&user_type='+user_type);
	});
    
	$('.pro_target').click();
	
}

function setATarget(){
	$('.home a').attr({'target':'layout_right'});
	$('.information a').attr({'target':'layout_right'});
	$('.apply a').attr({'target':'layout_right'});
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
function getQueryStringByName(name){
    var result = location.search.match(new RegExp("[\?\&]" + name + "=([^\&]+)", "i"));
    if (result == null || result.length < 1) {
        return "";
    }
    return result[1];
}