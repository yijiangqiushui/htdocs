document.write('<script type="text/javascript" src="/common/html/js/log.js"></script>');
$(function() {
/*	$('#back').click(function() {
		root = $(window.parent.parent.document).get(0).location.pathname;
		//alert(root)
		reg = /website/;
		result = root.search(reg);
		//alert(result)
		//前台
		if(result != -1){
			$(window.parent.parent.document).find('iframe').attr('src',"../template/user_project.php");
			
		}
		//后台
		else{
			
			$(window.parent.parent.document).find('iframe').attr('src',"/center/php/action/page/approve.php");
		}
		
	})*/
});

//fix mouse position in teatarea
function fix_mouse(e,a)
{
	if ( e && e.preventDefault )
	e.preventDefault();
	else 
	window.event.returnValue=false;
	a.focus();

}
//审核不通过的
function nopass(project_id,table_name){
	$.messager.confirm('确认','审核不通过后项目会失效，确定操作吗？',function(r){    
	    if (r){    
	    	
	    	//审核不通过
	    	  var  params=new Array(table_name);
    	      insertLogInfo("LogCheck_deny",params);
    	      
	    	$.ajax({
	    		url:"/center/php/action/page/verify.php",
	    		data:{'action':'nopass','project_id':project_id,'table_name':table_name},
	    		type: 'POST',
	    		dataType:'json',
	    		success:function(data){
	    			if(data != 0){
	    				console.dir(data);
	    				check_opinion(table_name);
	    				$.messager.alert('提示','设置成功了','info',function(){ 
	    				parent.location.href = "/center/php/action/page/approve.php";});
	    				$('.panel-tool-close').hide();
	    			}
	    			else{
	    				$.messager.alert('提示','设置失败');  $('.panel-tool-close').hide();
	    			}
	    		},
	    		error:function(){
	    			$.messager.alert('提示','出错了'); $('.panel-tool-close').hide();
	    		}
	    	});   
	    
	    }    
	}); 
}

//返回 上一步
function back(){
	window.history.back(-1);
}

function check_opinion($table_name){
	$('#check_opinion').form('submit',{
		url:"/modules/php/action/page/projectapp/projectapp.act.php?action=check_opinion&table_name=" + $table_name,
		success:function(result){
			var data = $.parseJSON(result);
			if(data.code == 1){
				$('#check_opinion').form('reset');
			}
			else{
				$.messager.alert('提示','出错了');$('.panel-tool-close').hide();
			}
		}
	});
}

function check_pass($table_name){
var approval_opinion = document.getElementById("approval_opinion").value;
	$.messager.confirm('确认','确定审核通过吗？',function(r){    
	
	    if (r){  
	    	//审核通过
	    	  var  params=new Array($table_name);
       	      insertLogInfo("LogCheck_pass",params);
	    	
	    	$.ajax({
	    		url:"/center/php/action/page/verify.php",
	    		data:{'action':'check_pass','table_name':$table_name,'approval_opinion':approval_opinion},
	    		type: 'POST',
	    		dataType:'json',
	    		//接受生成project_id的内容
	    		success:function(data){
	    			if(data.code == 0){
	    				console.dir(data);
	    				check_opinion($table_name);
	    				$.messager.alert('提示','提交审核成功','info',function(){ 
	    				parent.location.href = "/center/php/action/page/approve.php";});
	    				$('.panel-tool-close').hide();
	    			}
	    			else{
	    				$.messager.alert('提示','提交失败');$('.panel-tool-close').hide();
	    			}
	    		},
	    		error:function(data){
	    			
	    			$.messager.alert('提示','出错了');$('.panel-tool-close').hide();
	    		}
	    	});  
	    }    
	}); 
}

function check_deny($table_name){
	$.messager.confirm('确认','确定驳回吗？',function(r){    
	    if (r){    
	    	
	    	//驳回
	    	  var  params=new Array($table_name);
      	      insertLogInfo("LogCheck_deny",$table_name);
	    	
	    	$.ajax({
	    		url:"/center/php/action/page/verify.php",
	    		data:{'action':'check_deny','table_name':$table_name},
	    		type: 'POST',
	    		dataType:'json',
	    		success:function(data){
	    			if(data != 0){
	    				console.dir(data);
	    				check_opinion($table_name);
	    				$.messager.alert('提示','  驳回成功！','info',function(){ 
	    					parent.location.href = "/center/php/action/page/approve.php";
	    				});
	    				$('.panel-tool-close').hide();
	    			}
	    			else{
	    				$.messager.alert('提示','驳回失败');$('.panel-tool-close').hide();
	    			}
	    		},
	    		error:function(){
	    			$.messager.alert('提示','出错了');$('.panel-tool-close').hide();
	    		}
	    	});  
	    }    
	}); 
}

function loadApplyInfo() {
	$.get('../../../../../../modules/php/action/page/projectapp/projectapp.act.php?action=find_opnion',
					function(result) {
						if (result != '0') {
							var res = eval("(" + result + ")");
							$('#org_info').form('load', res);
							
						}
						
					});
	
		var user_type = decodeURI(getQueryStringByName('user_type'));
		var table_status = decodeURI(getQueryStringByName('table_status'));
		
//		if(user_type ==1||user_type ==2||user_type ==3){
//			 $('.button_wrapper').css('display','block');
//		}
//		if(user_type == 0) 
//		{
//		    if(table_status == 1  ||  table_status == 3)
//		    {
//		        $('.button_wrapper').css('display','block');
//		    }
//		}
		show_save(user_type,table_status);
	$('.save1').bind('click',function(){ org_info(); });
	$('.reset').bind('click',function(){
		window.location.reload();
	});
}