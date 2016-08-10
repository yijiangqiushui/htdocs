var flag1,id;
window.onresize=function(){		
	$('#grid').datagrid('resize',{		
		width:$('#body').width()
	});
}

$(function(){	
	flag1=$._GET('flag');
	id=$._GET('id');
	
	/*if(flag1=='2'){
		$('#checkAdviceDiv').show();
	}else{
		$('#checkAdviceDiv').hide();
	}*/
	
	$('#grid').datagrid({
		title:'项目详细信息',
		nowrap : true,//设置为true，当数据长度超出列宽时将会自动截取
		striped : true,
		collapsible : false,
		singleSelect:true,
		fitColumns:true,
		rownumbers : true,	
		checkOnSelect:false,
		selectOnCheck:false,
		pagination:true,
		pageSize: 5,  
		pageList: [5,10,15], 
				
		remoteSort : false,
		toolbar:'#toolbar',
				   
		url:'../../../../php/action/page/apply10.act.php?action=query&id='+id+'&flag='+flag1,
	
		columns:[[
					
			{field:'id',title:'id',checkbox:true},
			{field:'title',title:'标题',width:100},
			{field:'descrip',title:'描述',width:200},
			{field:'attname',title:'附件名称',width:100},
			{field:'savepath',title:'存储路径',width:100},
			{field:'pro',title:'附件类型',width:100},
		
		]]
	});
	var p = $('#grid').datagrid('getPager');  
	$(p).pagination({  
			pageSize: 5,  
			pageList: [5,10,15],  
			beforePageText: '第', 
			afterPageText: '页    共 {pages} 页',  
			displayMsg: '当前显示 {from} - {to} 条记录   共 {total} 条记录'  
				   
	});
	
});