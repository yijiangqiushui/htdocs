function saveCheckOpin(){
	$('#other_condition').form('submit',{
		url:'../../../../../modules/php/action/page/projectapp/projectapp.act.php?action=task_saveOtherCondition',
		success:function(result){
			$('#other_condition').form('reset');
		}
	});
}

$(function()
		{
		loadApplyInfo();
		});
	function loadApplyInfo(){
		$.get('../../../../../modules/php/action/page/projectapp/projectapp.act.php?action=findOtherCondition',function(result){
			if(result!='0'){
				var res=eval("("+result+")");
				$('#other_condition').form('load',res);
			}
		});
	}
function resetInfo(){
	alert('重置');
}