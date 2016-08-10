function saveCheckOpin(){
	if(confirm("确定提交并保存提交‘项目任务书’？")){
		$('#plan_parties').form('submit',{
			url:'../../../../../modules/php/action/page/projectapp/projectapp.act.php?action=task_savePlanParties',
			success:function(result){
				$('#plan_parties').form('reset');
			}
		});
	}
	
}

$(function()
		{
		loadApplyInfo();
		});
	function loadApplyInfo(){
		$.get('../../../../../modules/php/action/page/projectapp/projectapp.act.php?action=findPlanPart',function(result){
			if(result!='0'){
				var res=eval("("+result+")");
				//alert(res.org_code);
				$('#plan_parties').form('load',res);
			}
		});
	}
	
function resetInfo(){
	alert('重置');
}