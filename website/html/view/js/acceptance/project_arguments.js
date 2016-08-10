

/***申请项目****/
function saveArgument(){
	$('#project_argument').form('submit',{
		url:'../../../../../modules/php/action/page/acceptance/project.act.php',
		success:function(result){
			$('#project_argument').form('reset');
		}
	});
}

function resetInfo(){
	alert('重置');
}