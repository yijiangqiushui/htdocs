function submitdata(){
		$('#iopuc_fm').form('submit' ,{
			url: '/modules/php/action/page/applycation/apply.act.php?action=iopuc',
			success: function(result){
				$('#iopuc_fm').form('reset');
				
			}
		});
	}