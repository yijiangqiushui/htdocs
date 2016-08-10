function submitdata(){
		$('#project_promote').form('submit' ,{
			url: '/modules/php/action/page/applycation/apply.act.php?action=project_promote',
			success: function(result){
				$('#project_promote').form('reset');
			}
		});
	}

function reset(){
$('#project_promote').form('reset');}
