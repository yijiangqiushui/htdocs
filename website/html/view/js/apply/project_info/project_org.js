function submitdata(){
		$('#project_org').form('submit' ,{
			url: '/modules/php/action/page/applycation/apply.act.php?action=project_org',
			success: function(result){
				$('#project_org').form('reset');
			}
		});
	}

function reset(){
$('#project_org').form('reset');}
