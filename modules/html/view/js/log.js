/**
author:Gao Xue
date:2014-04-28
*/
$(function(){
	$('body').css('display','none');
	$.get('../../../php/action/page/jdgPge.act.php',function(data){
		$('body').css('display','block');
		
		if(data=='super'){
			loadPage();	
		}else{
			if(data.indexOf('loginfo_query')<0){
				$('body').html('<h2>您没有操作权限</h2>');			
			}else{			
				loadPage();
			}	
		}
	});
});

function loadPage(){
	$('#loggrid').datagrid({
		fit:true,
		nowrap : true,//设置为true，当数据长度超出列宽时将会自动截取
		striped : true,//设置为true将交替显示行背景。
		collapsible : false,//显示可折叠按钮
		singleSelect:true,//为true时只能选择单行
		fitColumns:true,//允许表格自动缩放，以适应父容器
		rownumbers : true,//行数
		pagination:true,//分页
		pageSize: 15,  
		pageList: [5,10,15], 
		checkOnSelect:false,
		selectOnCheck:false, 
		
		remoteSort : false,
		toolbar:'#toolbar',
		url:'../../../php/action/page/log/log.act.php?action=queryLog',//url调用Action方法
		
		columns:[[
			{field:'id',title:'id',checkbox:true,hidden:true},
			{field:'opt',title:'操作',fit:100},
			{field:'username',title:'操作人',fit:100},
			{field:'timedata',title:'操作时间',fit:100}
		]]
	});
	
	var p = $('#loggrid').datagrid('getPager');
		$(p).pagination({  
		pageSize: 15,  
		pageList: [5,10,15],  
		beforePageText: '第', 
		afterPageText: '页    共 {pages} 页',  
		displayMsg: '当前显示 {from} - {to} 条记录   共 {total} 条记录'  
			   
	});  
}