function submit_data(){
	var complete = completeInput();
	if(complete){
			$('#login_info').form('submit' ,{
				url: '/modules/php/action/page/applycation/logininfo.act.php?action=logininfo',
				success: function(result){
					$.messager.alert('提示','信息修改成功！','info',function(){
						window.location.href="/website/html/view/template/userinfo/logininfo.html";
					});
				}
			});
	  }else{
		  $.messager.alert('提示','信息不完整，请完善信息后提交！');
	  }
	}


//自动获取数据库
$(function()
		{
			loadApplyInfo();
		});
	function loadApplyInfo(){	
		$.get('/modules/php/action/page/applycation/logininfo.act.php?action=findlogininfo',function(result){
			if(result!='0'){
				var res = JSON.parse(result);
				$('#login_info').form('load',res);
			}
		});
	}
	function completeInput() {
		var returnValue = true;
		$('input').each(function() {
			if(!$(this).val()) {
				returnValue = false;
			}
		});
		return returnValue;
	}
	
function cancel_readonly(){
	 var obj=document.getElementsByTagName("input");
	 for(var i=0;i<obj.length;i++){
		 if(obj[i].name != 'username'){
		 obj[i].readOnly=false; 
		 obj[i].style.backgroundColor="#d2d2d2"; 
		 }
	 }
	
}
