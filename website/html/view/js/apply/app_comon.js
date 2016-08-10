$(function(){
	if(table_name == null){
		var table_name = "";
	}
	$(".menu.check_define").on("click",function(){
		var obj = $(this);
		$('.iframe iframe').attr('src',obj.attr("url")+'&table_name='+table_name+'&table_status='+table_status+'&user_type='+user_type );
	});
});