// JavaScript Document
function resetPanelSize(cls_name){
	$('.'+cls_name).css({'width':($('.wrapper').css('width')-1)+"px"});
}

function center_go_back(){
	$(".project_content #back").click(function() {
		root = $(window.parent.parent.document).get(0).location.pathname;
		//alert(root)
		reg = /website/;
		result = root.search(reg);
		//alert(result)
		if(result != -1){
			$(window.parent.parent.document).find('iframe').attr('src',"../template/user_project.php");
		}else{
			department = $.cookie("department");
		    min = $.cookie("min");
		    max = $.cookie("max");
		    project_type = $.cookie("project_type");
			//var strCookie=document.cookie; 
			//alert(strCookie);
			$(window.parent.parent.document).find('iframe').attr('src',"/center/php/action/page/approve.php?min="+min+"&max="+max+"&department"+department+"&project_type"+project_type);
		}
	})
}

$(function(){
//	ukeyfunction();
	$(".project_content #back").unbind("click");
	center_go_back();
});



