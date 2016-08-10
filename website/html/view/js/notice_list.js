// JavaScript Document
$(function(){
	$('title').text(SYSTEM.name);//设置页面标题

	layPageination();
});

function load_notice_list(ret_val){
	var params=$.pagination_params('list_page');
	//alert(params.page+'   '+params.size);
	$.post('../../../php/action/page/notice.php?action=list',{page:params.page,size:params.size},function(ret_val){
		//do something
		$('.list ul').html(ret_val);
	});
}

function layPageination(){
	$.post('../../../php/action/page/notice.php?action=total',function(ret_val){//先获取记录总数
	var pagination_vars={
		id:'list_page',
		renderTo:'.pagination',
		class:'default',
		total:ret_val,
		size:15,
		current:1,
		list_num:4,
		dataopt:{
			is_four_text:1,
			is_links:1,
			is_turn2page:1
		},
		user_func:'load_notice_list',
		params:'',
	};
	$.pagination(pagination_vars);
	});
}
