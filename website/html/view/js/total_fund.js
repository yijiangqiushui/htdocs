/**
 * 
 */

document.write('<script type="text/javascript" src="/common/html/js/common.js"></script>');




function execute(){
//	var table_name = encodeURI("项目经费总决算表");
	$.get('../../../../modules/php/action/page/projectapp/projectapp.act.php?action=execute&name='+table_id,function(result){
		if(result['code']!=0){
			alert("提交成功");
			//window.location.href='userlist.php';
		}
	});
}

/**
Modified By Gao Xue 
date:2014-06-19
*/
//var isCheck_award,isCheck_unit,isCheck_peo;

function setupPro(){
	alert("fff");
	$.post('../../../../modules/php/action/page/projectapp/projectapp.act.php?action=setupPro',function(result){
		if(result['code']!=0){
			alert("提交成功");
			window.location.href='userlist.php';
		}
	});
}

function removeSession(){
	$.get('../../../php/action/page/main.php?action=removeSession',function(){});
}

var table_id = '';


$(function(){
	table_id = getQueryStringByName('table_id');
	$('title').text("科学技术奖申报流程");
	removeSession();
	setID2Href();
	
	layout();//初始化布局
	
	clickEffect();//设置单击效果
	
	setATarget();//设置链接显示到iframe中
	
	//selectStep(0);
	//setStep(0,'(√)');
	//selectStep(1);//设置选中某个步骤
	$('#back').click(function() {
		$(window.parent.parent.document).find('iframe').attr('src',"../template/user_project.php");
	})
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
