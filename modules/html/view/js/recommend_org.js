// JavaScript Document
var url;
var commendId;
var pridge;

window.onresize=function(){		
	$('#grid').datagrid('resize',{		
		width:$('#body').width()
	});
}



$(function(){
	$('body').css('display','none');
	$.get('../../../php/action/page/jdgPge.act.php',function(data){
		pridge=data;
		
		$('body').css('display','block');
		
		if(data=='super'){
			loadPage();	
		}else{
			if(data.indexOf('Recunit_query')<0){
				$('body').html('<h2>您没有操作权限</h2>');
				
			}else{
				if(data.indexOf('Recunit_del')<0){
						$("a[onclick='delCommendList()']").css('display','none');			
				}
				if(data.indexOf('Recunit_add')<0){
						$("a[onclick='newCommend()']").css('display','none');			
				}	
				loadPage();			
				
			}	
		}
	});
});



function loadPage(){
	//alert(pridge);
 $('#grid').datagrid({
	title:'推荐单位信息',
	nowrap : true,//设置为true，当数据长度超出列宽时将会自动截取
	striped : true,//设置为true将交替显示行背景。
	collapsible : false,//显示可折叠按钮
	singleSelect:true,//为true时只能选择单行
	fitColumns:true,//允许表格自动缩放，以适应父容器
	rownumbers : true,//行数
	pagination:true,//分页
	pageSize: 20,  
	pageList: [5,10,15,20,30], 
	checkOnSelect:false,
	selectOnCheck:false, 				
	remoteSort : false,
	toolbar:'#toolbar',	
			   
	url:'../../../php/action/page/recommend/recommend.act.php?action=query',//url调用Action方法	
	columns:[[				
		{field:'id',title:'id',checkbox:true},		
		{field:'name',title:'推荐单位名称',width:200},
		{field:'address',title:'推荐单位地址',width:200},
		{field:'type',title:'推荐单位类型',width:200},
		{field:'tel',title:'单位电话',width:150},
		{field:'email',title:'电子邮箱',width:200},
		{field:'fax',title:'传真',width:150},
		{field:'linkman',title:'联系人',width:200},
		{field:'phone',title:'联系人电话',width:150},		
		{field:'action',title:'操作',width:200,align:'center',
			formatter:function(value,row,index){
				var a='<a href="javascript:void(0)" onclick="editUser('+row.id+')"  class="comm_edit">编辑</a>';
				var b=' | '+'<a href="javascript:void(0)" onclick="destroyUser('+row.id+','+index+')" class="comm_del">删除</a>';			
					var rn='';
					if(pridge=='super'){
						rn=a+b;
					}else{
						if(pridge.indexOf('Recunit_edit')>=0){
							rn+=a;
						}
						if(pridge.indexOf('Recunit_del')>=0){
							rn+=b;
						}					
					}				
					return rn;	
			}
		}					
		]]
	
	});				
	var p = $('#grid').datagrid('getPager');  
		$(p).pagination({  
			pageSize: 20,  
			pageList: [5,10,15,20,30],  
			beforePageText: '第', 
			afterPageText: '页    共 {pages} 页',  
			displayMsg: '当前显示 {from} - {to} 条记录   共 {total} 条记录'  				   
	});  
}




//---------------------------------------------推荐单位信息-----------------------------------------------------
	
/*$(function(){
	$('body').css('display','none');
	$.get('../../../php/action/page/jdgPge.act.php',function(data){
		pridge=data;
		$('body').css('display','block');
		
		if(data=='super'){
			loadPage();	
		}else{
			if(data.indexOf('comm_query')<0){
				$('body').html('<h2>您没有操作权限</h2>');
				
			}else{
				if(data.indexOf('comm_del')<0){
						$("a[onclick='delCommendList()']").css('display','none');			
				}
				if(data.indexOf('comm_add')<0){
						$("a[onclick='newCommend()']").css('display','none');			
				}				
				
			}	
		}
	});
});*/



/*function loadPage(){
	//alert(pridge);
 $('#grid').datagrid({
	title:'推荐单位信息',
	nowrap : true,//设置为true，当数据长度超出列宽时将会自动截取
	striped : true,//设置为true将交替显示行背景。
	collapsible : false,//显示可折叠按钮
	singleSelect:true,//为true时只能选择单行
	fitColumns:true,//允许表格自动缩放，以适应父容器
	rownumbers : true,//行数
	pagination:true,//分页
	pageSize: 5,  
	pageList: [5,10,15,20,30], 
	checkOnSelect:false,
	selectOnCheck:false, 				
	remoteSort : false,
	toolbar:'#toolbar',	
			   
	url:'../../../php/action/page/recommend/recommend.act.php?action=query',//url调用Action方法	
	columns:[[				
		{field:'id',title:'id',checkbox:true},		
		{field:'name',title:'推荐单位名称',width:200},
		{field:'address',title:'推荐单位地址',width:200},
		{field:'type',title:'推荐单位类型',width:200},
		{field:'tel',title:'单位电话',width:150},
		{field:'email',title:'电子邮箱',width:200},
		{field:'fax',title:'传真',width:150},
		{field:'linkman',title:'联系人',width:200},
		{field:'phone',title:'联系人电话',width:150},		
		{field:'action',title:'操作',width:200,align:'center',
			formatter:function(value,row,index){
				var a='<a href="javascript:void(0)" onclick="editUser('+row.id+')"  class="comm_edit">编辑</a>';
				var b='<a href="javascript:void(0)" onclick="destroyUser('+row.id+','+index+')" class="comm_del"> 删除</a>';			
					var rn='';
					if(pridge=='super'){
						rn=a+b;
					}else{
						if(pridge.indexOf('comm_edit')>=0){
							rn+=a;
						}
						if(pridge.indexOf('comm_del')>=0){
							rn+=b;
						}					
					}				
					return rn;	
			}
		}					
		]]
	
	});				
	var p = $('#grid').datagrid('getPager');  
		$(p).pagination({  
			pageSize: 5,  
			pageList: [5,10,15,20,30],  
			beforePageText: '第', 
			afterPageText: '页    共 {pages} 页',  
			displayMsg: '当前显示 {from} - {to} 条记录   共 {total} 条记录'  				   
	});  
}*/



//查询推荐单位信息
function selectUser(){
	$('#show').dialog('open').dialog('setTitle','查询条件');	
	$('#show-form').form('clear');
			
}

function showSelectUser(){	
	if(($('#search_name').val()=='')&&($('#search_type').combobox('getValue')=='')){
		$('#show').dialog('close');
		location.reload();
	}else{ 
		$('#show-form').form('submit',{
			url:'../../../php/action/page/recommend/recommend.act.php?action=query',
			onSubmit: function(){					
			},
		success: function(result){
			$('#show').dialog('close'); 				
			$('#grid').datagrid('load',{
				//'address':$('#search_address').combobox('getValue'),
				'type':$('#search_type').combobox('getValue'),
				'name':$('#search_name').val()	
			});
						
		}
	});	
			
	}
			
}



//显示所有推荐单位信息
function loadCommend(){			
	location.reload();				
}
		
//添加推荐单位信息
function newCommend(){
     $('#dlg').dialog('open').dialog('setTitle','添加推荐单位信息');
     $('#fm').form('clear');
		url = '../../../php/action/page/recommend/recommend.act.php?action=add';
}
//修改推荐单位信息
function editUser(a){
	$.get( '../../../php/action/page/recommend/recommend.act.php?action=findbyid&id='+a,function(data){
			
		var res=eval("("+data+")");				
        $('#dlg').dialog('open').dialog('setTitle','修改推荐单位信息');
        $('#fm').form('load',res);
				
        url = '../../../php/action/page/recommend/recommend.act.php?action=update&id='+a;
						                     
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
		
//删除推荐单位信息
function destroyUser(id,index){
     $.messager.confirm('提示信息','确定删除吗？',function(r){
     if (r){
      $.get( '../../../php/action/page/recommend/recommend.act.php?action=delete&id='+id,function(){						
           $('#grid').datagrid('reload');                        
      });					 
     }
     });         
}
//批量删除
function delCommendList(){		
	var rows = $("#grid").datagrid("getChecked");		
	if(rows.length==0){
		$.messager.alert('消息提示','请选择要删除的推荐单位信息','info');	
	}else{
		var list=new Array();
		for(var i=0;i<rows.length;i++){ 
			list[i]=rows[i].id;	
		}				
		$.messager.confirm('消息提示','确定删除吗？',function(r){
               if (r){
                        $.get( '../../../php/action/page/recommend/recommend.act.php?action=deletelist&idlist='+list,function(data){					
                           $('#grid').datagrid('reload');
                        });					 
                    }
                });
					
			}
}
