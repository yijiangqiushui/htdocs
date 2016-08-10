function saveCheckOpin(){

	if(window.confirm("确定保存并提交'项目实施方案中的所有表单数据'？")){
		$('#project_check_opinion').form('submit',{
			url:'../../../../../modules/php/action/page/projectapp/projectapp.act.php?action=saveCheckOpin',
			success:function(result){
				$('#project_check_opinion').form('reset');
				alert("提交成功！");
			}
		});
	}

	

}

$(function()
		{
		loadApplyInfo();
		});
	function loadApplyInfo(){
		$.get('../../../../../modules/php/action/page/projectapp/projectapp.act.php?action=findProCheck',function(result){
			if(result!='0'){
				var res=eval("("+result+")");
				$('#project_check_opinion').form('load',res);
			}
		});
	}
	
function resetInfo(){
	alert('重置');
}