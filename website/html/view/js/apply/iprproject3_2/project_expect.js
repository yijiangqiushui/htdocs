function submitdata(){
		$('#project_expect').form('submit' ,{
			url: '/modules/php/action/page/applycation/iprproject3_2.act.php?action=project_expect',
			success: function(result){
				$('#project_expect').form('reset');
			}
		});
	}

function reset(){
$('#project_expect').form('reset');}

$(function() {
	loadApplyInfo();
});

function loadApplyInfo() {
	$.get('/modules/php/action/page/applycation/iprproject3_2.act.php?action=findproject_expect',
					function(result) {
						if (result != '0') {
							var res = eval("(" + result + ")");
							$('#project_expect').form('load', res);
						}
					});
}

