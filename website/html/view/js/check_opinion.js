

function check_opinion($table_name){
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
/*	$.ajax({
		url:"/modules/php/action/page/projectapp /projectapp.act.php?action=check_opinion&table_name=" + $table_name,
		data:$('#check_opinion').serialize(),
		dataType:"json",
		type:'POST',
		success:function(data){
			$('#check_opinion').form('reset');
			alert("提交成功！");
		},
		error:function(){
			alert("提交失败！");
		}
	});*/
	
}

function check_pass($table_name){
	$.ajax({
		url:"/center/php/action/page/verify.php",
		data:{'action':'check_pass','table_name':$table_name},
		type: 'POST',
		dataType:'json',
		success:function(data){
			if(data.code == 0){
				console.dir(data);
				check_opinion($table_name);
				alert('提交审核成功');
				window.location.href = "/center/php/action/page/approve.php";
			}
			else{
				alert('提交失败');
			}
		},
		error:function(){
			alert("出错了");
		}
	});
	/*$.post('/center/php/action/page/verify.php?action=check_pass&table_name=' + $table_name,function(result){
		alert("4444" + result);
		if(result['code'] != 0){
			check_opinion($table_name);
		}
		else{
			alert("系统产生错误！请联系管理员");
		}
	});*/
}

function check_deny($table_name){
	$.ajax({
		url:"/center/php/action/page/verify.php",
		data:{'action':'check_deny','table_name':$table_name},
		type: 'POST',
		dataType:'json',
		success:function(data){
			if(data != 0){
				console.dir(data);
				check_opinion($table_name);
				alert('驳回成功');
				window.location.href = "/center/php/action/page/approve.php";
			}
			else{
				alert('提交失败');
			}
		},
		error:function(){
			alert("出错了");
		}
	});
}

function resetInfo(){
	alert('重置');
}


