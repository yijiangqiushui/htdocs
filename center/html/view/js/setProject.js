function setProject($project_id,$org_code){
//	alert($project_id);
	$.get('../../page/setProject.php?project_id='+$project_id+"&org_code="+$org_code,function(result){
		if(result == 0){
			window.location.href = "../../page/approve.html";
		}
		else{
			alert("wrong");
		}
	});
	
}
