/**
 * 
 */

function agree(){
	//alert($project_id);
	$.get('../../../../modules/php/action/page/projectapp/projectapp.act.php?action=agree&name=北京市通州区科技计划项目实施方案', function(result){
		if(result!=0){
			alert("已同意");
			window.location.href='userlist.php';
		}
	});
}
