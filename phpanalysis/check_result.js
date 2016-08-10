

$(function(){
	init();
});

function init(){
	bindEvents();
}

function bindEvents(){
//	$('.button_title').attr('href','127.0.0.1/center/php/action/page/check/check_repeat.php?status=1');
}

function check_pass($project_id){
	window.location.href = "http://127.0.0.1/center/php/action/page/check/check_repeat.php?status=1&project_id=" + $project_id;
	window.close();
}