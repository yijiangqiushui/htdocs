$(function(){
			loadApplyInfo();
		});
	function loadApplyInfo(){
		$.get('/modules/php/action/page/projectapp/projectapp.act.php?action=findProInfo',function(result){
				var res=eval("("+result+")");
				if(res.isclose==1){
					$.messager.alert('', '您的 验收阶段已关闭，验收阶段信息已清空!', 'info');
				}
				$('#user_project').form('load',res);
		});
	}
	
	function printWord(url,table_status,project_type){
		var uri = url+"?table_status="+table_status+"&project_type="+project_type; 
		if(table_status == 2){
			$.messager.alert('提示', '您打印的是无水印文档，请以初审后带水印文档为准！', 'info',function(){
				$.get(uri,function(result){
					window.location.href = result;
				});
			});
		}else{
			$.get(uri,function(result){
				window.location.href = result;
			});
		}
		
	}
	function back(){
		window.location.href = '/website/html/view/template/myproject/completed.php'
	}
	
	
	
	