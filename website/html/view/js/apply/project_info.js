/**
 * 
 */

function submint_data(){
	//alert("被调用了吗？");
	$('#project_info').form('submit', {
		 url:'/modules/php/action/page/applycation/iprproject1_1.act.php?action=project_info',
		 success:function(result){
			 $('#project_info').form('reset');
		 }
	});
}