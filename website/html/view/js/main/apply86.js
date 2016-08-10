//heyangyang
/*
Modified by Gao Xue  	2014/06/19
Modified By Gao Xue 2014-07-07
Modified By Gao Xue 2014-07-12
*/
var url;
var flag,dex;
var proofId;

var flag1,id;
window.onresize=function(){		
	$('#grid').datagrid('resize',{		
		width:$('#body').width()
	});
}

$(function(){	
	flag1=$._GET('flag');
	id=$._GET('id');
		
	$('#grid').datagrid({
		title:'应用证明材料目录',
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
				   
		url:'../../../../php/action/page/apply86.act.php?action=query&id='+id+'&flag='+flag1,
	
		columns:[[
					
			{field:'id',title:'id',checkbox:true},
			{field:'unit',title:'应用单位名称',width:150},
			{field:'contact',title:'联系人',width:100},
			{field:'phone',title:'电话',width:150},
			{field:'startTime',title:'应用起始时间',width:150},
			{field:'endTime',title:'应用完成时间',width:150},
			{field:'benefit',title:'经济效益',width:150},

			{field:'action',title:'操作',width:100,align:'center',
				formatter:function(value,row,index){
					var a='<a href="javascript:void(0)" onclick="showform('+row.id+','+index+')">编辑</a>';
					var b='<a href="javascript:void(0)" onclick="delData('+row.id+','+index+')"> 删除</a>';
					var c='<a href="javascript:void(0)" onclick="showAtt('+row.id+')"> 相关资料</a>';
					return a+b+c;
				}
			}
					
						
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


function showform(fg,b){
	if(fg==0){
		$('#dlg').dialog('open').dialog('setTitle','添加信息');	
		$('#fm').form('clear');
		url='../../../../php/action/page/apply86.act.php?action=add&id='+id;
		flag=0;
	}else{
		$.get( '../../../../php/action/page/apply86.act.php?action=findbyid&id='+fg,function(data){
			
			var res=eval("("+data+")");				
			$('#dlg').dialog('open').dialog('setTitle','修改信息');
			$('#fm').form('load',res);
			url='../../../../php/action/page/apply86.act.php?action=update&id='+fg;
			flag=1;
			dex=b;
   		});
		
	}
}


function saveData(){	
	if($("input[name='unit']").val() == ""){
           $.messager.alert('消息提示','请添加应用单位名称','info');
	}else if($("input[name='contact']").val() == ""){
           $.messager.alert('消息提示','请添加联系人','info');
	}else if($("input[name='phone']").val() == ""){
           $.messager.alert('消息提示','请添加电话','info');
	}else{
	$('#fm').form('submit',{
		url:url,
		onSubmit: function(){			
		},
		success: function(result){
			parent.setStep(13,'(√)');
			result=eval('('+result+')');
			$('#dlg').dialog('close');
			if(flag==1){
				$('#grid').datagrid('updateRow',{
					index:dex,
					row:result	
				});	
			}else{						
				$('#grid').datagrid('reload');
			}
			flag=null;
			dex=null;
			url=null;				
		}
	});	
}
}
function delData(id,index){
	 $.messager.confirm('提示信息','确定删除吗？',function(r){
		 if(r){
			 $.get( '../../../../php/action/page/apply86.act.php?action=delete&id='+id,function(){						
					$('#grid').datagrid('reload');                       
			 });					 
		 }
     }); 
}

function deleteList(){
	var rows = $("#grid").datagrid("getChecked");		
	if(rows.length==0){
		$.messager.alert('消息提示','请选择要删除的信息','info');	
	}else{
		var list=new Array();
		for(var i=0;i<rows.length;i++){
			list[i]=rows[i].id;	
		}			
		$.messager.confirm('消息提示','确定删除吗？',function(r){
               if (r){
                      $.get( '../../../../php/action/page/apply86.act.php?action=deletelist&idlist='+list,function(data){				
                           $('#grid').datagrid('reload');
                      });					 
                }
        });					
	}	
}

function showAtt(proid){
	
	proofId=proid;
	
	$('#att_dlg').dialog('open').dialog('setTitle','相关资料信息');
	$('#att_grid').datagrid({
		height:'224',		
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
		toolbar:'#att_toolbar',
				   
		url:'../../../../php/action/page/att.act.php?action=query&pro=proof6&pid='+proid,
	
		columns:[[
					
			{field:'id',title:'id',checkbox:true},
			{field:'title',title:'标题',width:100},
			{field:'descrip',title:'描述',width:150},
			{field:'attname',title:'文件名',width:100},
			{field:'savepath',title:'存储路径',width:200},
			
			{field:'action',title:'操作',width:100,align:'center',
				formatter:function(value,row,index){
					var a='<a href="javascript:void(0)" onclick="showAttForm('+row.id+')">编辑</a>';
					var b='<a href="javascript:void(0)" onclick="delAtt('+row.id+')"> 删除</a>';
					return a+b;	
				}
			}
					
						
		]]
	});
	var p = $('#att_grid').datagrid('getPager');  
	$(p).pagination({  
			pageSize: 5,  
			pageList: [5,10,15],  
			beforePageText: '第', 
			afterPageText: '页    共 {pages} 页',  
			displayMsg: '当前显示 {from} - {to} 条记录   共 {total} 条记录'  
				   
	});
}

function showAttForm(a){
	if(a==0){
		$('#addAtt_dlg').dialog('open').dialog('setTitle','添加信息');
		//$('#addAtt_fm').form('clear');		
		$('#addAtt_fm').each(function(){
			$(this).find('input').val('');
			$(this).find('textarea').val('');
		});
		url='../../../../php/action/page/att.act.php?action=add&pro=proof6&pid='+proofId+'&id='+id;

	}else{
		$.get( '../../../../php/action/page/att.act.php?action=findbyid&pro=proof6&pid='+proofId+'&id='+a,function(data){
			var res=eval("("+data+")");				
			$('#addAtt_dlg').dialog('open').dialog('setTitle','修改信息');
			$('#addAtt_fm').form('load',res);
			url='../../../../php/action/page/att.act.php?action=update&pro=proof6&pid='+proofId+'&id='+a;
   		});	
	}
}

function saveAtt(){

	$('#addAtt_fm').form('submit',{
		url:url,
		onSubmit: function(){			
		},
		success: function(result){
			if(result==-3){
				$.messager.alert('提示消息','请上传JPG或者PDF格式的文件！','info');
				return;
			}else if(result==-2){
				$.messager.alert('提示消息','您上传的附件总数已超过45个，无法再上传更多！','info');
				return;
			}else if(result<=0){
				$.messager.alert('提示消息','您已上传的附件总大为'+Math.ceil(-result/1024)+'kb，总共不能超过15M,否则无法上传！','info');
				//$.messager.alert('提示消息','您上传的附件总大小已超过15M，无法上传！','info');
				return;
			}else
			if(result!=0){
				parent.setStep(16,'(√)');
			}
			$('#addAtt_dlg').dialog('close');							
			$('#att_grid').datagrid('reload');		
			url=null;					
		}
	});		
}

function delAtt(id){
	 $.messager.confirm('提示信息','确定删除吗？',function(r){
		 if(r){
			 $.get( '../../../../php/action/page/att.act.php?action=delete&id='+id,function(){						
					$('#att_grid').datagrid('reload');                        
			 });					 
		 }
     }); 
}

function deleteAttList(){
	var rows = $("#att_grid").datagrid("getChecked");		
	if(rows.length==0){
		$.messager.alert('消息提示','请选择要删除的信息','info');	
	}else{
		var list=new Array();
		for(var i=0;i<rows.length;i++){
			list[i]=rows[i].id;	
		}			
		$.messager.confirm('消息提示','确定删除吗？',function(r){
               if (r){
                      $.get( '../../../../php/action/page/att.act.php?action=deletelist&idlist='+list,function(data){				
                           $('#att_grid').datagrid('reload');
                      });					 
                }
        });					
	}	
}

function closedlg(){
	$('#att_grid').datagrid('loadData',{total:0,rows:[]});
	proofId=null;		
}