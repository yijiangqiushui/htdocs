$(function() {
	//$("form :input[type='text']").each(function() {
		$("form :input").each(function() {
		$(this).addClass("easyui-validatebox");
		$(this).attr("required", "true");
	});
	
	$("textarea").each(function() {
		$(this).addClass("easyui-validatebox validatebox-text validatebox-invalid");
		$(this).attr("required", "required");
	});
})