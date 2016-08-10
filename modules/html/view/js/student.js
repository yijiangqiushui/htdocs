
//贺央央

var url;
var studentId;
var pridge;

window.onresize=function(){		
	$('#grid').datagrid('resize',{		
		//height:$("#body").height(),
		width:$('#body').width()
	});
}

//---------------------------------------------学生信息-----------------------------------------------------	
$(function() {
	$('body').css('display','none');
	$.get('../../../php/action/page/jdgPge.act.php',function(data){
		pridge=data;
		$('body').css('display','block');
		
		if(data=='super'){
			loadPage();	
		}else{
			if(data.indexOf('stu_query')<0){
				$('body').html('<h2>您没有操作权限</h2>');
				
			}else{
				if(data.indexOf('stu_del')<0){
						$("a[onclick='destroyUserlist()']").css('display','none');			
				}
				if(data.indexOf('stu_add')<0){
						$("a[onclick='newUser()']").css('display','none');			
				}				
				loadPage();
			}	
		}
	});
});

function loadPage(){
	//alert(pridge);
	$('#grid').datagrid({
	title:'学生信息',
				
	//height:250,
	nowrap : true,//设置为true，当数据长度超出列宽时将会自动截取
	striped : true,//设置为true将交替显示行背景。
	collapsible : false,//显示可折叠按钮
	singleSelect:true,//为true时只能选择单行
	fitColumns:true,//允许表格自动缩放，以适应父容器
	rownumbers : true,//行数
	pagination:true,//分页
	pageSize: 15,  
	pageList: [5,10,15,20,30], 
	checkOnSelect:false,
	selectOnCheck:false, 
				
	remoteSort : false,
	//toolbar:'#toolbar',
			   
	url:'../../../php/action/page/student/stu.act.php?action=query',//url调用Action方法
	//loadMsg : '数据装载中......',
	//sortName : 'xh',//当数据表格初始化时以哪一列来排序
	//sortOrder : 'desc',//定义排序顺序，可以是'asc'或者'desc'（正序或者倒序）。
	columns:[[
				
		{field:'id',title:'id',checkbox:true},
		{field:'number',title:'学号',width:150},
		{field:'name',title:'姓名',width:100},
		{field:'sex',title:'性别',width:100},
		{field:'birthday',title:'生日',width:150},
		{field:'age',title:'年龄',width:100},
		{field:'tel',title:'电话',width:150},
		{field:'email',title:'邮箱',width:200},
		{field:'qq',title:'qq',width:100},
		
		{field:'action',title:'操作',width:350,align:'center',
			formatter:function(value,row,index){
				var a='<a href="javascript:void(0)" onclick="editUser('+row.id+')"  class="stu_edit">编辑</a>';
				var b='|'+'<a href="javascript:void(0)" onclick="destroyUser('+row.id+','+index+')" class="stu_del"> 删除</a>';
				
				var c='|'+'<a href="javascript:void(0)" onclick="showParGrid('+row.id+')" class="stu_par"> 家长信息</a>';				
				var d='|'+'<a href="javascript:void(0)" onclick="showEduGrid('+row.id+')" class="stu_edu"> 教育经历</a>';
				var e='|'+'<a href="javascript:void(0)" onclick="showActGrid('+row.id+')" class="stu_act"> 参加活动</a>';
				var f='|'+'<a href="javascript:void(0)" onclick="showProGrid('+row.id+')" class="stu_pro"> 学生作品</a>';
				var g='|'+'<a href="javascript:void(0)" onclick="showAwdGrid('+row.id+')" class="stu_awd"> 获得奖励</a>';
					
					var rn='';
					if(pridge=='super'){
						rn=a+b+c+d+e+f+g;
					}else{
						if(pridge.indexOf('stu_edit')>=0){
							rn+=a;
						}
						if(pridge.indexOf('stu_del')>=0){
							rn+=b;
						}
						if(pridge.indexOf('stu_par')>=0){
							rn+=c;
						}
						if(pridge.indexOf('stu_edu')>=0){
							rn+=d;
						}
						if(pridge.indexOf('stu_act')>=0){
							rn+=e;
						}
						if(pridge.indexOf('stu_pro')>=0){
							rn+=f;
						}
						if(pridge.indexOf('stu_awd')>=0){
							rn+=g;
						}
					}
					
					return rn;	
			}
		}
				
					
		]]
	
	});
				
	var p = $('#grid').datagrid('getPager');  
		$(p).pagination({  
			pageSize: 15,  
			pageList: [5,10,15,20,30],  
			beforePageText: '第', 
			afterPageText: '页    共 {pages} 页',  
			displayMsg: '当前显示 {from} - {to} 条记录   共 {total} 条记录'  
				   
	});  
}

//查询学生信息
function selectUser(){
	$('#show').dialog('open').dialog('setTitle','查询条件');	
	$('#show-form').form('clear');
			
}
function showSelectUser(){
			
	if(($('#search_no').val()=='')&&($('#search_name').val()=='')){
		$('#show').dialog('close');
	}else{ 
		$('#show-form').form('submit',{
			url:'../../../php/action/page/student/stu.act.php?action=query',
			onSubmit: function(){
					
			},
		success: function(result){
			$('#show').dialog('close'); 				
			$('#grid').datagrid('load',{
				'number':$('#search_no').val(),
				'name':$('#search_name').val()	
			});
						
		}
	});	
			
	}
			
}

//显示所有学生信息
function loadStudent(){			
	location.reload();				
}
		
//添加学生信息
function newUser(){
     $('#dlg').dialog('open').dialog('setTitle','添加学生信息');
     $('#fm').form('clear');
		url = '../../../php/action/page/student/stu.act.php?action=add';
}
//修改学生信息
function editUser(a){
	$.get( '../../../php/action/page/student/stu.act.php?action=findbyid&id='+a,function(data){
			
		var res=eval("("+data+")");				
        $('#dlg').dialog('open').dialog('setTitle','修改学生信息');
        $('#fm').form('load',res);
				
        url = '../../../php/action/page/student/stu.act.php?action=update&id='+a;
						                     
   });
}
		
function saveUser(){
     $('#fm').form('submit',{
     url:url,
     onSubmit: function(){
     },
     success: function(result){
		$('#dlg').dialog('close');        
        $('#grid').datagrid('reload');
		url=null;	
     }
     });
}
		
//删除学生信息
function destroyUser(id,index){
     $.messager.confirm('提示信息','确定删除吗？',function(r){
     if (r){
      $.get( '../../../php/action/page/student/stu.act.php?action=delete&id='+id,function(){						
           $('#grid').datagrid('reload');
			//$('#grid').datagrid('deleteRow',index);                        
      });					 
     }
     });         
}
//批量删除
function destroyUserlist(){
			
	var rows = $("#grid").datagrid("getChecked");
			
	if(rows.length==0){
		$.messager.alert('消息提示','请选择要删除的学生信息','info');	
	}else{
		var list=new Array();
		for(var i=0;i<rows.length;i++){
			list[i]=rows[i].id;	
		}
				
		$.messager.confirm('消息提示','确定删除吗？',function(r){
               if (r){
                        $.get( '../../../php/action/page/student/stu.act.php?action=deletelist&idlist='+list,function(data){					
                           $('#grid').datagrid('reload');
                        });					 
                    }
                });
					
			}
}

//-------------------------------------家长信息-----------------------------------------------

//家长信息
function showParGrid(sid) {
	studentId=sid;
	
	$('#par').dialog('open').dialog('setTitle','家长信息');

	$('#par_grid').datagrid({
	//title:'家长信息',
				
	height:250,
	nowrap : true,//设置为true，当数据长度超出列宽时将会自动截取
	striped : true,//设置为true将交替显示行背景。
	collapsible : false,//显示可折叠按钮
	singleSelect:true,//为true时只能选择单行
	fitColumns:true,//允许表格自动缩放，以适应父容器
	rownumbers : true,//行数
	pagination:true,//分页
	pageSize: 5,  
	pageList: [5,10,15], 
	checkOnSelect:false,
	selectOnCheck:false, 
				
	remoteSort : false,
	toolbar:'#par_toolbar',
			   
	url:'../../../php/action/page/student/stu.act.php?action=queryPar&stuid='+sid,
	
	columns:[[
				
		//{field:'id',title:'id',checkbox:true},
		{field:'app',title:'称呼',width:100},
		{field:'name',title:'姓名',width:100},
		{field:'address',title:'住址',width:100},
		{field:'tel',title:'联系方式',width:150},
		
		{field:'action',title:'操作',width:150,align:'center',
			formatter:function(value,row,index){
				var a='<a href="javascript:void(0)" onclick="show_edtpar_form('+row.id+')">编辑</a>';
				var b='<a href="javascript:void(0)" onclick="delPar('+row.id+')"> 删除</a>';
				
				return a+b;	
			}
		}
				
					
		]]
			  
	});
			
	var p = $('#par_grid').datagrid('getPager');  
	$(p).pagination({  
		pageSize: 5,  
		pageList: [5,10,15],  
		beforePageText: '第', 
		afterPageText: '页    共 {pages} 页',  
		displayMsg: '当前显示 {from} - {to} 条记录   共 {total} 条记录'  
			   
	});   
    
}

//删除家长信息
function delPar(parid){
	 $.messager.confirm('提示信息','确定删除吗？',function(r){
		 if (r){
			 $.get('../../../php/action/page/student/stu.act.php?action=delPar&id='+parid,function(){						
				   $('#par_grid').datagrid('reload');                    
			  });					 
		 }
     });
}


//添加家长信息
function show_par_form(){
          
	$('#par_add').dialog('open').dialog('setTitle','添加家长信息');
           
	$('#par_add_form').form('clear');
     
	url='../../../php/action/page/student/stu.act.php?action=addPar&stuid='+studentId;      
}

//修改家长信息

function show_edtpar_form(pid){
	$.get('../../../php/action/page/student/stu.act.php?action=findParById&id='+pid,function(data){
			
		var res=eval("("+data+")");				
        $('#par_add').dialog('open').dialog('setTitle','修改信息');
        $('#par_add_form').form('load',res);
				
        url ='../../../php/action/page/student/stu.act.php?action=edtPar&id='+pid+'&stuid='+studentId;
						                     
   });	
}

//保存家长信息
		
function addPar(){	
			$('#par_add_form').form('submit',{				
				url:url,
				onSubmit: function(){					
				},
				success: function(result){					
					$('#par_add').dialog('close');
					$('#par_grid').datagrid('reload'); 			
                 	url=null;
				}
			});	
		
}

function closepar(){
	$('#par_grid').datagrid('loadData',{total:0,rows:[]});
	studentId=null;	
}

//-------------------------------------教育经历-----------------------------------------------

function showEduGrid(sid) {
	studentId=sid;
	
	$('#edu').dialog('open').dialog('setTitle','教育经历');

	$('#edu_grid').datagrid({
	
	height:250,
	nowrap : true,//设置为true，当数据长度超出列宽时将会自动截取
	striped : true,//设置为true将交替显示行背景。
	collapsible : false,//显示可折叠按钮
	singleSelect:true,//为true时只能选择单行
	fitColumns:true,//允许表格自动缩放，以适应父容器
	rownumbers : true,//行数
	pagination:true,//分页
	pageSize: 5,  
	pageList: [5,10,15], 
	checkOnSelect:false,
	selectOnCheck:false, 
				
	remoteSort : false,
	toolbar:'#edu_toolbar',
			   
	url:'../../../php/action/page/student/stu.act.php?action=queryEdu&stuid='+sid,
	
	columns:[[
				
		//{field:'id',title:'id',checkbox:true},
		{field:'stage',title:'教育阶段',width:100},
		{field:'school',title:'学校名称',width:100},
		{field:'begindate',title:'开始时间',width:100},
		{field:'enddate',title:'结束时间',width:100},
		
		{field:'action',title:'操作',width:150,align:'center',
			formatter:function(value,row,index){
				var a='<a href="javascript:void(0)" onclick="show_edu2_form('+row.id+')">编辑</a>';
				var b='<a href="javascript:void(0)" onclick="delEdu('+row.id+')"> 删除</a>';
				
				return a+b;	
			}
		}
				
					
		]]
			  
	});
			
	var p = $('#edu_grid').datagrid('getPager');  
	$(p).pagination({  
		pageSize: 5,  
		pageList: [5,10,15],  
		beforePageText: '第', 
		afterPageText: '页    共 {pages} 页',  
		displayMsg: '当前显示 {from} - {to} 条记录   共 {total} 条记录'  
			   
	});   
    
}

function delEdu(parid){
	 $.messager.confirm('提示信息','确定删除吗？',function(r){
		 if (r){
			 $.get('../../../php/action/page/student/stu.act.php?action=delEdu&id='+parid,function(){						
				   $('#edu_grid').datagrid('reload');                    
			  });					 
		 }
     });
}

function show_edu_form(){
          
	$('#edu_dlg').dialog('open').dialog('setTitle','添加教育经历');
           
	$('#edu_form').form('clear');
     
	url='../../../php/action/page/student/stu.act.php?action=addEdu&stuid='+studentId;      
}

function show_edu2_form(pid){
	$.get('../../../php/action/page/student/stu.act.php?action=findEduById&id='+pid,function(data){
			
		var res=eval("("+data+")");				
        $('#edu_dlg').dialog('open').dialog('setTitle','修改信息');
        $('#edu_form').form('load',res);
				
        url ='../../../php/action/page/student/stu.act.php?action=edtEdu&id='+pid+'&stuid='+studentId;
						                     
   });	
}

function saveEdu(){
	
			$('#edu_form').form('submit',{				
				url:url,
				onSubmit: function(){					
				},
				success: function(result){					
					$('#edu_dlg').dialog('close');
					$('#edu_grid').datagrid('reload'); 			
                 	url=null;
				}
			});	
		
}

function closeedu(){
	$('#edu_grid').datagrid('loadData',{total:0,rows:[]});
	studentId=null;	
}

//-------------------------------------参加活动-----------------------------------------------

function showActGrid(sid) {
	studentId=sid;
	
	$('#act').dialog('open').dialog('setTitle','参加活动');

	$('#act_grid').datagrid({
	
	height:250,
	nowrap : true,//设置为true，当数据长度超出列宽时将会自动截取
	striped : true,//设置为true将交替显示行背景。
	collapsible : false,//显示可折叠按钮
	singleSelect:true,//为true时只能选择单行
	fitColumns:true,//允许表格自动缩放，以适应父容器
	rownumbers : true,//行数
	pagination:true,//分页
	pageSize: 5,  
	pageList: [5,10,15], 
	checkOnSelect:false,
	selectOnCheck:false, 
				
	remoteSort : false,
	toolbar:'#act_toolbar',
			   
	url:'../../../php/action/page/student/stu.act.php?action=queryAct&stuid='+sid,
	
	columns:[[
				
		//{field:'id',title:'id',checkbox:true},
		{field:'name',title:'活动名称',width:100},
		{field:'content',title:'活动内容',width:100},
		{field:'address',title:'活动地址',width:100},
		{field:'time',title:'活动时间',width:100},
		
		{field:'action',title:'操作',width:150,align:'center',
			formatter:function(value,row,index){
				var a='<a href="javascript:void(0)" onclick="show_act2_form('+row.id+')">编辑</a>';
				var b='<a href="javascript:void(0)" onclick="delAct('+row.id+')"> 删除</a>';
				
				return a+b;	
			}
		}
				
					
		]]
			  
	});
			
	var p = $('#act_grid').datagrid('getPager');  
	$(p).pagination({  
		pageSize: 5,  
		pageList: [5,10,15],  
		beforePageText: '第', 
		afterPageText: '页    共 {pages} 页',  
		displayMsg: '当前显示 {from} - {to} 条记录   共 {total} 条记录'  
			   
	});   
    
}

function delAct(parid){
	 $.messager.confirm('提示信息','确定删除吗？',function(r){
		 if (r){
			 $.get('../../../php/action/page/student/stu.act.php?action=delAct&id='+parid,function(){						
				   $('#act_grid').datagrid('reload');                    
			  });					 
		 }
     });
}

function show_act_form(){
          
	$('#act_dlg').dialog('open').dialog('setTitle','添加活动');
           
	$('#act_form').form('clear');
     
	url='../../../php/action/page/student/stu.act.php?action=addAct&stuid='+studentId;      
}

function show_act2_form(pid){
	$.get('../../../php/action/page/student/stu.act.php?action=findActById&id='+pid,function(data){
			
		var res=eval("("+data+")");				
        $('#act_dlg').dialog('open').dialog('setTitle','修改信息');
        $('#act_form').form('load',res);
				
        url ='../../../php/action/page/student/stu.act.php?action=edtAct&id='+pid+'&stuid='+studentId;
						                     
   });	
}

function saveAct(){
	
			$('#act_form').form('submit',{				
				url:url,
				onSubmit: function(){					
				},
				success: function(result){					
					$('#act_dlg').dialog('close');
					$('#act_grid').datagrid('reload'); 			
                 	url=null;
				}
			});	
		
}

function closeact(){
	$('#act_grid').datagrid('loadData',{total:0,rows:[]});
	studentId=null;	
}
//-------------------------------------学生作品-----------------------------------------------

function showProGrid(sid) {
	studentId=sid;
	
	$('#pro').dialog('open').dialog('setTitle','学生作品');

	$('#pro_grid').datagrid({
	
	height:250,
	nowrap : true,//设置为true，当数据长度超出列宽时将会自动截取
	striped : true,//设置为true将交替显示行背景。
	collapsible : false,//显示可折叠按钮
	singleSelect:true,//为true时只能选择单行
	fitColumns:true,//允许表格自动缩放，以适应父容器
	rownumbers : true,//行数
	pagination:true,//分页
	pageSize: 5,  
	pageList: [5,10,15], 
	checkOnSelect:false,
	selectOnCheck:false, 
				
	remoteSort : false,
	toolbar:'#pro_toolbar',
			   
	url:'../../../php/action/page/student/stu.act.php?action=queryPro&stuid='+sid,
	
	columns:[[
				
		//{field:'id',title:'id',checkbox:true},
		{field:'title',title:'标题',width:100},
		{field:'descrip',title:'描述 ',width:100},
		{field:'filename',title:'附件名称',width:100},
		{field:'teacher',title:'指导教师',width:100},
		{field:'act',title:'操作',width:150,align:'center',
			formatter:function(value,row,index){
				var a='<a href="javascript:void(0)" onclick="show_pro2_form('+row.id+')">编辑</a>';
				var b='<a href="javascript:void(0)" onclick="delPro('+row.id+')"> 删除</a>';
				
				return a+b;	
			}
		}
				
					
		]]
			  
	});
			
	var p = $('#pro_grid').datagrid('getPager');  
	$(p).pagination({  
		pageSize: 5,  
		pageList: [5,10,15],  
		beforePageText: '第', 
		afterPageText: '页    共 {pages} 页',  
		displayMsg: '当前显示 {from} - {to} 条记录   共 {total} 条记录'  
			   
	});   
    
}

function delPro(parid){
	 $.messager.confirm('提示信息','确定删除吗？',function(r){
		 if (r){
			 $.get('../../../php/action/page/student/stu.act.php?action=delPro&id='+parid,function(){						
				   $('#pro_grid').datagrid('reload');                    
			  });					 
		 }
     });
}

function show_pro_form(){
	
          
	$('#pro_dlg').dialog('open').dialog('setTitle','添加作品');
	//$("#productform").form('clear');
	
	$('#productform').each(function(){
		$(this).find('input').val('');
		$(this).find('textarea').val('');
	});
	
	url='../../../php/action/page/student/stu.act.php?action=addPro&stuid='+studentId;      
}

function show_pro2_form(pid){
	$.get('../../../php/action/page/student/stu.act.php?action=findProById&id='+pid,function(data){

		var res=eval("("+data+")");				
        $('#pro_dlg').dialog('open').dialog('setTitle','修改信息');
        $('#productform').form('load',res);
				
        url ='../../../php/action/page/student/stu.act.php?action=edtPro&id='+pid+'&stuid='+studentId;
						                     
   });	
}

function savePro(){
			$('#productform').form('submit',{				
				url:url,
				onSubmit: function(){					
				},
				success: function(result){		
					$('#pro_dlg').dialog('close');
					$('#pro_grid').datagrid('reload'); 			
                 	url=null;
				}
			});
		
}

function closepro(){
	$('#pro_grid').datagrid('loadData',{total:0,rows:[]});
	studentId=null;	
}


//-------------------------------------获得奖励-----------------------------------------------

function showAwdGrid(sid) {
	studentId=sid;
	
	$('#awd').dialog('open').dialog('setTitle','获得奖励');

	$('#awd_grid').datagrid({
	
	height:250,
	nowrap : true,//设置为true，当数据长度超出列宽时将会自动截取
	striped : true,//设置为true将交替显示行背景。
	collapsible : false,//显示可折叠按钮
	singleSelect:true,//为true时只能选择单行
	fitColumns:true,//允许表格自动缩放，以适应父容器
	rownumbers : true,//行数
	pagination:true,//分页
	pageSize: 5,  
	pageList: [5,10,15], 
	checkOnSelect:false,
	selectOnCheck:false, 
				
	remoteSort : false,
	toolbar:'#awd_toolbar',
			   
	url:'../../../php/action/page/student/stu.act.php?action=queryAwd&stuid='+sid,
	
	columns:[[
				
		//{field:'id',title:'id',checkbox:true},
		{field:'act',title:'参加活动',width:100},
		{field:'rank',title:'排名',width:100},
		{field:'descrip',title:'获奖描述',width:100},
		{field:'time',title:'获奖时间',width:100},
		{field:'attname',title:'附件名称',width:100},
		
		{field:'action',title:'操作',width:150,align:'center',
			formatter:function(value,row,index){
				var a='<a href="javascript:void(0)" onclick="show_awd2_form('+row.id+')">编辑</a>';
				var b='<a href="javascript:void(0)" onclick="delAwd('+row.id+')"> 删除</a>';
				
				return a+b;	
			}
		}
				
					
		]]
			  
	});
			
	var p = $('#awd_grid').datagrid('getPager');  
	$(p).pagination({  
		pageSize: 5,  
		pageList: [5,10,15],  
		beforePageText: '第', 
		afterPageText: '页    共 {pages} 页',  
		displayMsg: '当前显示 {from} - {to} 条记录   共 {total} 条记录'  
			   
	});   
    
}

function delAwd(parid){
	 $.messager.confirm('提示信息','确定删除吗？',function(r){
		 if (r){
			 $.get('../../../php/action/page/student/stu.act.php?action=delAwd&id='+parid,function(){						
				   $('#awd_grid').datagrid('reload');                    
			  });					 
		 }
     });
}

function show_awd_form(){
  
	$('#awd_dlg').dialog('open').dialog('setTitle','获得奖励');
          
	//$('#awardform').form('clear');
	$('#awardform').each(function(){
		$(this).find('input').val('');
		$(this).find('textarea').val('');
	});
     
	url='../../../php/action/page/student/stu.act.php?action=addAwd&stuid='+studentId;
	
}

function show_awd2_form(pid){
	$.get('../../../php/action/page/student/stu.act.php?action=findAwdById&id='+pid,function(data){
		var res=eval("("+data+")");				
        $('#awd_dlg').dialog('open').dialog('setTitle','修改信息');
        $('#awardform').form('load',res);
				
        url ='../../../php/action/page/student/stu.act.php?action=edtAwd&id='+pid+'&stuid='+studentId;
						                     
   });	
}

function saveAwd(){

			$('#awardform').form('submit',{				
				url:url,
				onSubmit: function(){					
				},
				success: function(result){		
					$('#awd_dlg').dialog('close');
					$('#awd_grid').datagrid('reload'); 			
                 	url=null;
				}
			});	
	
}

function closeawd(){
	$('#awd_grid').datagrid('loadData',{total:0,rows:[]});
	studentId=null;	
}
