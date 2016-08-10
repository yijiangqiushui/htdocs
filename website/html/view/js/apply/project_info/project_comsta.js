function submitdata(){
		$('#project_comsta').form('submit' ,{
			url: '/modules/php/action/page/applycation/apply.act.php?action=project_comsta',
			success: function(result){
				$('#project_comsta').form('reset');
			}
		});
	}
function reset(){
$('#project_comsta').form('reset');}


