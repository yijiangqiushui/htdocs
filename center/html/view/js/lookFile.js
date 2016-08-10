$(function(){
	loadTree();
	loadAll('','','','','','','');
	loadWest();
/*
	$('#tree').click(function(e) {
		var that = e.target;
		var project_type = $(that).html();
//		alert(project_type);
		loadAll(project_type);
	})*/
	$('#select').show();
	$('#select').click(function() {
		$('#select_block').dialog('open').dialog('setTitle','查询');
		$('#select_info').form("clear");
	})
});

var year = '';
var project_type = '';
function loadAll(project_type,year,name,id,engineer,start,end){
	var title='项目信息';
	isDel=0;
	var project_type = encodeURI(project_type);
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
		resizeHandle:true,
		toolbar:'#toolbar',
//		url:'/center/php/action/page/authority/authority_control.php?action=queryAdmin&isDel=0',//url调用Action方法
		url:'/modules/php/action/page/center/center.act.php?action=findLookFile&project_type='+project_type+'&year='+year+'&name='+encodeURIComponent(name)+'&id='+id+'&engineer='+engineer+'&start='+start+'&end='+end,
//		url:'/modules/php/action/page/center/center.act.php?action=findLookFile&project_type='+project_type+'&year='+year,
//		url:'/center/php/action/page/authority/authority_control.php?action=queryAdmin&isDel=0',
//		url:'../../../../php/action/page/admin/admin.act.php?action=queryAdmin&isDel=0',
		columns:[[
					
			{field:'id',title:'id',checkbox:true},
			{field:'project_type',title:'项目类别',width:100,align:'center'},
			{field:'project_name',title:'项目名称',width:250,align:'center'},
			//{field:'usr',title:'用户名',width:10},
			{field:'project_start',title:'申报开始时间',width:50,align:'center'},
			{field:'project_end',title:'申报结束时间',width:50,align:'center'},

			{field:'action',title:'操作',align:'center',width:100,align:'center',
				formatter:function(value,row,index){
//					 var link = "/center/php/action/page/project_list/fileCheck_list.html?department=" + row.department + "&min=1&max=4&name=" + row.project_type;
					 var link = "/center/php/action/page/approve.php?department=" + row.department + "&min=1&max=4&name=" + row.project_type + "&project_id=" + row.project_id + "&file=" + 1;
					 var a='<a href=' + link +  ' >查看</a>';
					 return a;
			}}														
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

function loadTree(){
	$('#tree').tree({
		url:'/modules/php/action/page/center/center.act.php?action=treedata',
		animate:true,
		onClick: function(node){
			year = parseInt($('#'+node.domId).parent().parent().siblings('.tree-node').find('.tree-title').html());
			project_type = node.id;
			loadAll(node.id,year,'','','','','');
		}
	});
}

function select() {
	var project_name = $('#project_name').val();
	var project_id = $('#project_id').val();
	var project_engineer = $('#project_engineer').val();
	var start_time = $("input[name='start_time']").val();
	var end_time = $("input[name='end_time']").val();
	loadAll(project_type,year,project_name,project_id,project_engineer,start_time,end_time);
	$('#select_block').dialog('close')
}