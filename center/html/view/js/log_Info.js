$(function(){
	loadAll();
});

function loadAll(){
	
			$('#loginfo').datagrid({
				title:'操作日志',   
				nowrap : true,//设置为true，当数据长度超出列宽时将会自动截
				striped : true,//设置为true将交替显示行背景。
				collapsible : false,//显示可折叠按钮
				singleSelect:true,//为true时只能选择单行
				fitColumns:true,//允许表格自动缩放，以适应父容器
				//fit:true,
				rownumbers : true,//行数
				pagination:true,//分页
				pageSize: 15,  
				pageList: [5,10,15,20,30], 
				checkOnSelect:false,
				selectOnCheck:false, 
				remoteSort : false,
				nowrap:true,
				toolbar:'#toolbar',
				autoRowHeight:false,
				url:'/modules/php/action/page/projectapp/projectapp.act.php?action=findLogInfo',
				columns:[[
					{field:'id',title:'id',checkbox:true},
					{field:'username',title:'操作人',align:'center'},
					{field:'timedata',title:'操作时间',align:'center'},
					{field:'opt',title:'操作',align:'center'},
				]],
			});
			//分页		
			var p = $("#loginfo").datagrid('getPager');
			$(p).pagination({
					pageSize : 15,
					pageList : [ 5, 10, 15, 20, 30 ],
					beforePageText : '第',
					afterPageText : '页    共 {pages} 页',
					displayMsg : '当前显示 {from} - {to} 条记录   共 {total} 条记录'
			});
		}