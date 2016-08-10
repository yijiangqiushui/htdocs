function submitdata(){
		$('#project_talent').form('submit' ,{
			url: '/modules/php/action/page/applycation/apply.act.php?action=project_talent',
			success: function(result){
				$('#project_talent').form('reset');
			}
		});
	}

function reset(){
$('#project_talent').form('reset');}
