$(function()
		{
		loadApplyInfo();
		});
	function loadApplyInfo(){
		$.get('../../../../../modules/php/action/page/acceptance/project.act.php?action=findProArchieve',function(result){
			if(result!='0'){
				var res=eval("("+result+")");
				$('#project_archievement').form('load',res);
			}
		});
	}