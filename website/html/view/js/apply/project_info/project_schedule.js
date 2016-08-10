function submitdata(){
		$('#project_schedule').form('submit' ,{
			url: '/modules/php/action/page/applycation/apply.act.php?action=project_schedule',
			success: function(result){
				$('#project_schedule').form('reset');
			}
		});
	}

function reset(){
$('#project_schedule').form('reset');}
