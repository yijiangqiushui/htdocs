//解析参数;
 function getQueryStringByName(name){
    var result = location.search.match(new RegExp("[\?\&]" + name + "=([^\&]+)", "i"));
    if (result == null || result.length < 1) {
        return "";
    }
    return result[1];
}

//页面自动加载
 $(function(){
	 //设置回退功能;
/*  	 $('#back').click(function() {
			root = $(window.parent.parent.document).get(0).location.pathname;
			reg = /website/;
			result = root.search(reg);
			//前台
			if(result != -1){
				$(window.parent.parent.document).find('iframe').attr('src',"../template/user_project_genious.php");
			}
			//后台
			else{
				$(window.parent.parent.document).find('iframe').attr('src',"/center/php/action/page/approve.php");
			}
		});*/
  	 loadInfo();
	 
});
 
 //页面回写的函数;
 function loadInfo(){
	
	 $.get('/modules/php/action/page/genious/genious.act.php?action=find_award_statement',
				function(result) {
					if (result != '0') {
						var res = eval("(" + result + ")");
						$('#statement').form('load', res);
					}
					
				});
	 $('.save').bind('click',function(){ save_statement(); });
 }
 //进行存值;
 function save_statement(){
	 $('#statement').form('submit',{
			url:'/modules/php/action/page/genious/genious.act.php?action=save_award_statement',
			success:function(result){
				$.messager.alert('提示','信息保存成功！','info',function(){
				var complete = completeInput();   
				if(complete) {
					window.parent.save_stage('statement');
				}
				window.parent.setStep('statement',complete);
				});
			}
		});
 }
 
 function completeInput() {
		var returnValue = true;
		$('textarea').each(function() {
			if(!$(this).val()) {
				returnValue = false;
			}
		})
		return returnValue;
	}