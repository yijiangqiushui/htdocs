/**
author:Gao Xue
date:2014-06-30
*/

var url;
var pridge;
$(function(){
	$('body').css('display','none');
	$.get('../../../php/action/page/jdgPge.act.php',function(data){
		pridge=data;
		$('body').css('display','block');
		if(data=='super'){
			loadPage();	
			//loadTree();
		}else{
			if(data.indexOf('model_query')<0){
				$('body').html('<h2>您没有操作权限</h2>');			
			}else{	
				if(data.indexOf('modul_add')<0){
						$("a[onclick='newModel()']").css('display','none');			
				}
				if(data.indexOf('model_remake')<0){
						$("a[onclick='makeArrModel()']").css('display','none');			
				}
				loadPage();
				//loadTree();
			}
		}
	});
});

function loadTree(){
	$("#treeData").tree({
		url:'../../../php/action/page/model.act.php?action=treeData',
		//checkbox:false,
		//animate:true,
		//lines:false,
		/*onBeforeExpand:function(node){
			$(this).tree('options').url='../../../php/action/page/contentcat.act.php?action=treeData&up_id='+node.id;
		},*/
		onClick:function(node){
			$('#modelgrid').datagrid('load',{'upid':node.id});
		}
	});
}

function loadPage(){
	loadTree();
	$('#modelgrid').datagrid({
		fit:true,
		nowrap : true,//设置为true，当数据长度超出列宽时将会自动截取
		striped : true,//设置为true将交替显示行背景。
		collapsible : false,//显示可折叠按钮
		singleSelect:true,//为true时只能选择单行
		fitColumns:true,//允许表格自动缩放，以适应父容器
		rownumbers : true,//行数
		pagination:true,//分页
		pageSize: 20,  
		pageList: [10,20,30], 
		checkOnSelect:false,
		selectOnCheck:false, 
		
		remoteSort : false,
		toolbar:'#toolbar',
		url:'../../../php/action/page/model.act.php?action=queryModel',//url调用Action方法
		
		columns:[[
			{field:'id',title:'id',checkbox:true},
			{field:'sqlQuery',title:'sql语句',width:300},
			{field:'fileName',title:'文件名称',fit:true},
			{field:'fileFolder',title:'文件夹名称',hidden:true},
			{field:'fileType',title:'信息类型',fit:true,
			},
			{field:'action',title:'操作',width:150,align:'center',
				formatter:function(value,row,index){							
					var a='<a href="javascript:void(0)" onclick="editModel('+row.id+')">编辑</a> ';
					var b=' | '+'<a href="javascript:void(0)" onclick="delModel('+row.id+')"> 删除</a> ';
					var c=' | '+'<a href="javascript:void(0)" onclick="reMakeModel(\''+row.sqlQuery.replace(/\'/g, "\\'")+'\',\''+row.fileName+'\',\''+row.fileType+'\',\''+row.fileFolder+'\')">重新生成</a>';
					var rn='';
					if(pridge=='super'){
							rn=a+b+c;
					}else{
							if(pridge.indexOf('model_edit')>=0){
								rn+=a;
							}
							if(pridge.indexOf('model_del')>=0){
								rn+=b;
							}
							if(pridge.indexOf('model_remake')>=0){
								rn+=c;
							}
						}
					return rn;
				}
			}		
		]]
	});
	
	var p = $('#loggrid').datagrid('getPager');
		$(p).pagination({  
		pageSize: 20,  
		pageList: [10,20,30], 
		beforePageText: '第', 
		afterPageText: '页    共 {pages} 页',  
		displayMsg: '当前显示 {from} - {to} 条记录   共 {total} 条记录'  
			   
	});  
}

function newModel(){
	$('#editdlg').dialog('open').dialog('setTitle','添加信息');
	$('#editdlg').form('clear');
	$('#editdlg').form('load',{'fileType':1,'fileFolder':0});
	url='../../../php/action/page/makeModel.php?action=makeModel';
}

function editModel(id){
	$.get('../../../php/action/page/model.act.php?action=getModel&id='+id,function(data){
		//alert(data);
		var res=eval("("+data+")");
		$('#editdlg').dialog('open').dialog('setTitle','修改信息');
		$('#editdlg').form('load',res);
		url='../../../php/action/page/model.act.php?action=updateModel&id='+id;/**/
	});
//	},'json');
}

function saveModel(){
	$('#editfm').form('submit',{
		url:url,
		success:function(result){
			$('#editdlg').dialog('close');
			$('#modelgrid').datagrid('reload');
		}
	});
}

function delModel(id){
	$.messager.confirm('提示信息','确定删除吗？',function(r){
		if (r){
			$.get( '../../../php/action/page/model.act.php?action=delModel&id='+id,function(data){						
				$('#modelgrid').datagrid('reload');                      
			});					 
		}
	}); 
}

function reMakeModel(sqlQuery,fileName,fileType,fileFolder){
	//alert(sqlQuery);
	$.post('../../../php/action/page/makeModel.php?action=remakeModel',{'sqlQuery':sqlQuery,'fileName':fileName,'fileType':fileType,'fileFolder':fileFolder},function(result){
		$.messager.alert('消息提示',result,'info');
	});
}

function makeArrModel(){
	$.messager.confirm('消息提示','确定重新生成吗？',function(r){
		if(r){
			$.get('../../../php/action/page/makeModel.php?action=makeArrModel',function(data){
				$('#modelgrid').datagrid('reload');
			});
		}
	});
/*	var rows = $("#modelgrid").datagrid("getChecked");
	if(rows.length==0){
		$.messager.alert('消息提示','请选择要重新生成的信息','info');	
	}else{
		var list=new Array();
		for(var i=0;i<rows.length;i++){
			list[i]=rows[i].id;
		}
		$.messager.confirm('消息提示','确定重新生成吗？',function(r){
			if(r){
				$.get('../../../php/action/page/makeModel.php?action=makeArrModel&arrId='+list,function(data){
					$('#modelgrid').datagrid('reload');
				});
			}
		});
	}
*/
}