

$(function(){
	loadAll();
	loadWest();
});

function loadAll(){
	var title='公告信息';
	var i=0;
	var arrayObj = new Array();
	var arrayObj2 = new Array();
	isDel=0;
	$('#projectList').datagrid({
		//height:250,
		title:title,
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
		toolbar:'#toolbar',
//		url:'/center/php/action/page/authority/authority_control.php?action=queryAdmin&isDel=0',//url调用Action方法
		url:'/modules/php/action/page/center/center.act.php?action=project_all',
//		url:'/center/php/action/page/authority/authority_control.php?action=queryAdmin&isDel=0',
//		url:'../../../../php/action/page/admin/admin.act.php?action=queryAdmin&isDel=0',
		columns:[[
					
			{field:'id',title:'id',checkbox:true},
			{field:'project_type',title:'公告标题',align:'center'},
			//{field:'usr',title:'用户名',width:10},
			{field:'project_start',title:'发布人',align:'center'},
			{field:'project_end',title:'发布时间',align:'center'},
			//{field:'qq',title:'QQ',width:10},
			//{field:'userPrivileges',title:'权限',width:100,align:'center'},
			//{field:'check_num',title:'待审核数量',align:'center',},
			//{field:'addedDate',title:'添加时间',align:'center'},
			{field:'action',title:'编辑',align:'center',
			}															
		]],
		
	});
	 
	
	
	
		//分页		
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

function loadWest(){
//	alert("hhhh");
	$.post('/modules/php/action/page/center/center.act.php?action=isSuper',function(result){
		var res = eval("("+result+")");
//		alert(res.departmesnt);
		if(res.user_type == 3){
//			$("#li0").css('display','block');
			$("#li1").css('display','block');
			$("#li2").css('display','block');
			$("#li3").css('display','block');
//			document.getElementById('body').className = 'easyui-layout'
		}
		else{
			if(res.department == 0){
				$("#li1").css('display','block');
			}
			else if(res.department == 1){
				$("#li2").css('display','block');
			}
			else if(res.department == 2){
				$("#li3").css('display','block');
			}
			else{
				
			}
		}
	});
}

function loadPage(department){
	var title='用户信息';
	isDel=0;
	$('#projectList').datagrid({
		//height:250,
		title:title,
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
		toolbar:'#toolbar',
//		url:'/center/php/action/page/authority/authority_control.php?action=queryAdmin&isDel=0',//url调用Action方法
		url:'/modules/php/action/page/center/center.act.php?action=project_main&department='+department,
//		url:'/center/php/action/page/authority/authority_control.php?action=queryAdmin&isDel=0',
//		url:'../../../../php/action/page/admin/admin.act.php?action=queryAdmin&isDel=0',
		columns:[[
					
			{field:'id',title:'id',checkbox:true},
			{field:'project_type',title:'项目类别',align:'center'},
			//{field:'usr',title:'用户名',width:10},
			{field:'project_start',title:'申报开始时间',align:'center'},
			{field:'project_end',title:'申报结束时间',align:'center'},
			//{field:'qq',title:'QQ',width:10},
			//{field:'userPrivileges',title:'权限',width:100,align:'center'},
			{field:'check_num',title:'待审核数量',align:'center',},
			//{field:'addedDate',title:'添加时间',align:'center'},
			{field:'action',title:'操作',align:'center',
				formatter:function(value,row,index){
					var a = '';
					var link = '';
					if(row.check_num > 0)
					{
					   link = "/center/php/action/page/project_list/check_list.html?department=" + row.department + "&min=1&max=4&name=" + row.project_type;
					   a='<a href=' + link +  ' onclick="editAdmin('+row.id+');">受理</a>';
					}
					else{
						a='<a href=' + link +  ' onclick="editAdmin('+row.id+');">查看</a>';
					}
					var rn='';
					rn=a;
					return rn;
				}
			}															
		]],
	});
		//分页		
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
   //打开添加新用户界面;
    function newAdmin()
	{
    	$('#newProject').dialog('open').dialog('setTitle','添加项目');
		$('#addProject').form('clear');
    	
	}
    //添加新用户;
    function addAdmin()
    {
    	$('#newAdmin').form('submit',{
    		url:'/modules/php/action/page/center/center.act.php?action=newadmin',
    		success:function(result){
    			if(result != 0)
    			{
    			  alert("加入成功");
    			  window.location.reload(true);
    			}
    			else
    			{
    				alert("失败");
    			}    			
    		}
    	});
    }
    //单个删除项目;
    function delAdmin($project_type)
    {  
    	 if(!confirm("确定要删除吗？")){
    		 return false;
    	 }
    	$.post('/modules/php/action/page/center/center.act.php?action=delAdmin'+'&project_type='+$project_type,function(result){
			if(result!=0){
               alert("删除成功");
               window.location.reload(true);
			}
		});
    }
    
  //批量删除
    function delArrAdmin(){
    	var rows = $("#projectList").datagrid("getChecked");
    	if(rows.length==0){
    		$.messager.alert('消息提示','请选择要删除的信息','info');	
    	}else{
    		var list=new Array();
    		for(var i=0;i<rows.length;i++){
    			list[i]=rows[i].project_type;
    		}
    		$.messager.confirm('消息提示','确定删除吗？',function(r){
    			if(r){
    				$.get('/modules/php/action/page/center/center.act.php?action=delArrproject_type&arrproject_type='+list,function(data){
    					$('#projectList').datagrid('reload');
    				});
    			}
    		});
    	}
    }
