$(function(){
	alert('aaaaa');
//	loadApplyInfo();
});

function loadApplyInfo(){
		$.get('../../../../../../modules/php/action/page/projectapp/projectapp.act.php?action=checktest',function(result){
			if(result!='0'){	
				var res=eval("("+result+")");
				$('#project_mean').form('load',res);
			}
		});
}