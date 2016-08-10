
function completeInfo(){

	$('#complete_info').form('submit',{
		url:"/modules/php/action/page/user/user.act.php?action=complete_info",
		success:function(result){

			$('#complete_info').form('reset');
		}
	});
}


/*function check_opinion($table_name){
	$('#check_opinion').form('submit',{
		url:"/modules/php/action/page/projectapp/projectapp.act.php?action=check_opinion&table_name=" + $table_name,
		success:function(result){
//			alert("dfdf" + result);
			var data = $.parseJSON(result);
//			alert(data.code);
			if(data.code == 1){
				$('#check_opinion').form('reset');
//				alert("提交成功！");
			}
			else{
				alert("wrong!");
			}
		}
	});

}*/