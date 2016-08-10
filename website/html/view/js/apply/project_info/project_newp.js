function submitdata(){
		$('#project_newp').form('submit' ,{
			url: '/modules/php/action/page/applycation/apply.act.php?action=project_newp',
			success: function(result){
				$('#project_newp').form('reset');
			}
		});
	}

function reset(){
$('#project_newp').form('reset');}
