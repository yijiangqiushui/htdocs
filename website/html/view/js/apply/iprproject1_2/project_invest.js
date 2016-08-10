function submitdata(){
		$('#project_invest').form('submit' ,{
			url: '/modules/php/action/page/applycation/iprproject1_2.act.php?action=project_invest',
			success: function(result){
				$('#project_invest').form('reset');
			}
		});
	}
function reset(){
$('#project_invest').form('reset');}




$(function() {
	loadApplyInfo();
});

function loadApplyInfo() {
	$.get('/modules/php/action/page/applycation/iprproject1_2.act.php?action=findproject_invest',
					function(result) {
						if (result != '0') {
							var res = eval("(" + result + ")");
							$('#project_invest').form('load', res);
						}
					});
}