function submitaimdata(){
		$('#project_target').form('submit' ,{
			url: '/modules/php/action/page/applycation/aim_standard.php?action=project_content',
			success: function(result){
				$('#project_target').form('reset');
			}
		});
	}
function submit(){
	$('#project_mean').form('submit' ,{
		url: '/modules/php/action/page/applycation/aim_standard.php?action=project_mean',//action=后面是aim_standard.php文件的case：内容
		success: function(result){
			
			$('#project_mean').form('reset');
		}
	});
}
function sub(){
	$('#project_plan').form('submit' ,{
		url: '/modules/php/action/page/applycation/aim_standard.php?action=project_plan',
		success: function(result){
			
			$('#project_plan').form('reset');
		}
	});
}