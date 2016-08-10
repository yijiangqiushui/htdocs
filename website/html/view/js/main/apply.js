/**
author:Gao Xue
date:2014-05-23
*/


/***申请项目****/
function saveApply(){
	$('#appFm').form('submit',{
		url:'/modules/php/action/page/applycation/apply.act.php?action=saveApply',
		onSubmit:function(){},
		success:function(){
			$('#appFm').form('reset');
		}
	});
}

function resetInfo(){
	alert('重置');
}