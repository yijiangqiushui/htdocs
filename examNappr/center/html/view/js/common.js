// JavaScript Document
function resetPanelSize(cls_name){
	$('.'+cls_name).css({'width':($('.wrapper').css('width')-1)+"px"});
}

function findNT199(){
	var retVal = NT199_Find();
	if(retVal < 1){
		window.location.href="../../../../../center/html/view/template/index.html";	
		alert("ErrorCode: " + NT199_GetLastError() + " 没有查找到U盾请确认是否插上！");
		return false;
	}
	else if(retVal > 1){
		alert("找到 " + retVal + " 把Key，只能对一把Key进行操作。");
		window.location.href="../../../../../center/html/view/template/index.html";	
		return false;	
	}else{
		return true;
	}
}
