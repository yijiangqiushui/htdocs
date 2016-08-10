var mytimer = null;  
function showPic($condition){
	var rootDiv = document.getElementById('test');
	var left = event.clientX-100;
	var top = event.clientY;
	rootDiv.style.position = "absolute";
	rootDiv.style.left = event.clientX -400 + "px";
	rootDiv.style.top = event.clientY + "px";
	
	mytimer = window.setTimeout("myfunc(" + $condition + ")", 1000);  
}

function cancelEvent(){
	clearTimeout(mytimer);        
	mytimer = -1;
	$("#pic").remove();
}

function myfunc($condition) {
	var rootDiv = document.getElementById('test');
	var pic = document.getElementById('pic');
	rootDiv.innerHTML="<img src=\"../img/" + $condition + ".png\" " + " id='pic' name='pic' style='overflow:scroll'>";
}

function getProject_id($id,$stage){
	    $.get('/modules/php/action/page/genious.php?id=' + $id , function(result){
	    	if(result == 1){
	    		window.location.href = "/website/html/view/template/Projectapp/project_summary_genious.php?id=" + $id + "&stage=" + $stage;
	    	}else{
	    		window.location.href = "/website/html/view/template/Projectapp/project_summary.php?id=" + $id + "&stage=" + $stage;
	    	}
	    });
}

function showDetail($project_id){
	$.get('/modules/php/action/page/showDetail.php?project_id=' + $project_id,function(result){
//		alert(result.code + 'and' +result.genious);
		if(result.code == 1){
			if(result.genious == 1){
				window.location.href = "/website/html/view/template/user_project_genious.php";
			}else{
				window.location.href = "/website/html/view/template/user_project.php";
			}
		}
		else{
			$.messager.alert('提示','系统错误，联系管理员');
		}
},'json');
	
}