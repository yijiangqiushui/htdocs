/**
 * 
 */


$(function(){
	loadPage();
	
});

function loadPage(){
	var title='用户信息';
	isDel=0;
	$('#projectList').datagrid({
		//height:250,
		title:title,
		nowrap : true,//设置为true，当数据长度超出列宽时将会自动截取
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
		toolbar:'#toolbar',
				   
//		url:'/center/php/action/page/authority/authority_control.php?action=queryAdmin&isDel=0',//url调用Action方法
//		url:'/center/php/action/page/authority/authority_control.php?action=queryAdmin&isDel=0',
//		url:'../../../../php/action/page/admin/admin.act.php?action=queryAdmin&isDel=0',
		
		url:'/modules/php/action/page/center/center.act.php?action=project_main',
		columns:[[
					
			{field:'id',title:'id',checkbox:true},
			{field:'project_type',title:'项目类别',width:100,align:'center'},
			//{field:'usr',title:'用户名',width:10},
			{field:'project_start',title:'申报开始时间',width:100,align:'center'},
			{field:'project_end',title:'申报结束时间',width:150,align:'center'},
			//{field:'qq',title:'QQ',width:10},
			//{field:'userPrivileges',title:'权限',width:100,align:'center'},
			{field:'check_num',title:'待审核数量',width:80,align:'center',},
			//{field:'addedDate',title:'添加时间',align:'center'},
			{field:'action',title:'操作',align:'center',width:100,align:'center',
				formatter:function(value,row,index){							
					var a='<a href="javascript:void(0)" onclick="editAdmin('+row.id+')">编辑</a>';
					var b=' | <a href="javascript:void(0)" onclick="delAdmin('+row.id+')"> 删除</a>';							
					var rn='';
					rn=a+b;
					return rn;
				}
			}															
		]],
		/**onLoadSuccess: function () {
			reSize();
    	return true;
  	}	*/					  
	});
				
	var p = $('#projectList').datagrid('getPager');			  
	$(p).pagination({  
			pageSize: 15,  
			pageList: [5,10,15,20,30],  
			beforePageText: '第', 
			afterPageText: '页    共 {pages} 页',  
			displayMsg: '当前显示 {from} - {to} 条记录   共 {total} 条记录'  						   
	});   					
	$('#muti_back').css({'display':'none'});
	$('#back_loadPage').css({'display':'none'});
	
	
/*	$('#principal').combobox({
	    url:'/center/php/action/page/authority/authority_control.php?action=queryUsers',
	    valueField:'id',
	    textField:'text'
	});*/
	
	
	$(".easyui-combobox").each(function(){
//		alert(this);
		$(this).combobox({
		url:'/center/php/action/page/authority/authority_control.php?action=queryUsers',
	    valueField:'id',
	    textField:'text'
		 });
	});
}

