/**
author:Gao Xue
date:2014-05-24
*/
var cat_name='',upper_id=0,upper_cat='.',edtid;
var pridge;
$(function(){
	$('body').css('display','none');
	$.get('../../../php/action/page/jdgPge.act.php',function(data){
		pridge=data;
		$('body').css('display','block');
		if(data=='super'){
			loadTree();
			loadPage();
		}else{
			if(data.indexOf('fruitsCat_query')<0){
				$('body').html('<h2>您没有操作权限</h2>');
			}else{
				if(data.indexOf('fruitsCat_del')<0){
						$("a[onclick='delCatlist()']").css('display','none');			
				}
				if(data.indexOf('fruitsCat_add')<0){
						$("a[onclick='newEle()']").css('display','none');			
				}
				if(data.indexOf('fruitsCat_disable')<0){
						$("a[iconCls='icon-no']").css('display','none');			
				}
				if(data.indexOf('fruitsCat_enable')<0){
						$("a[iconCls='icon-ok']").css('display','none');			
				}	
				loadTree();			
				loadPage();
			}	
		}
	});	
	//loadTree();
	//loadPage();
});

function loadTree(){
	$('#treeData').tree({
		url:'../../../php/action/page/applycation/applycat.act.php?action=treeData',
		onBeforeExpand:function(node){
			$(this).tree('options').url='../../../php/action/page/applycation/applycat.act.php?action=treeData&upper_id='+node.id;
		},
		onClick:function(node){
			if(node.text=='全部'){
				cat_name='';
				upper_id=0;
				upper_cat='.';
			}else{
				cat_name=node.text;
				upper_id=node.id;
				upper_cat=node.upper_cat+node.id+'.';
			}
			$('#catgrid').datagrid('load',{'upperid':node.id});
		}
	});
}

function loadPage(){
	$('#catgrid').datagrid({
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
		toolbar:'#toolbar',
				   
		url:'../../../php/action/page/applycation/applycat.act.php?action=gridData',//url调用Action方法
		
		columns:[[		
			{field:'id',title:'id',checkbox:true},
			{field:'cat_name',title:'名称',width:100},
			{field:'upper_cat',title:'上级节点',width:100},
			{field:'upper_id',title:'父节点ID',width:100},
			{field:'is_forbidden',title:'是否禁用',width:100},
			{field:'is_leaf',title:'是否是叶子节点',width:100},
			
			{field:'action',title:'操作',width:150,align:'center',
				formatter:function(value,row,index){							
					var a='<a href="javascript:void(0)" onclick="edtCat('+row.id+')">编辑</a>';
					var b=' | '+'<a href="javascript:void(0)" onclick="delCat('+row.id+')">删除</a>';
					var rn='';
					if(pridge=='super'){
						rn=a+b;
					}else{
						if(pridge.indexOf('fruitsCat_edit')>=0){
							rn+=a;
						}
						if(pridge.indexOf('fruitsCat_del')>=0){
							rn+=b;
						}
					}
					return rn;	
				}
			}															
		]]						  
	});
	
	var p = $('#catgrid').datagrid('getPager');			  
	$(p).pagination({  
			pageSize: 15,  
			pageList: [5,10,15,20,30],  
			beforePageText: '第', 
			afterPageText: '页    共 {pages} 页',  
			displayMsg: '当前显示 {from} - {to} 条记录   共 {total} 条记录'  						   
	});
}

/******添加分类***********/
function newCat(){
	$('#addDlg').dialog('open').dialog('setTitle','添加信息');
	$('#addFm').form('clear');
	$('#upperCat').val(cat_name);
	$('#upper_id').val(upper_id);
	$('#upper_cat').val(upper_cat);
	
	url = '../../../php/action/page/applycation/applycat.act.php?action=saveCat';
}

function saveCat(){
	$('#addFm').form('submit',{
		url:url,
		success:function(result){
			$('#addDlg').dialog('close');
			$('#catgrid').datagrid('reload');
	
			if(upper_id==0){
				loadTree();
			}else{
				var node=$("#treeData").tree('find',upper_id);
				result=eval('('+result+')');
				$("#treeData").tree('append',{
					parent:node.target,
					data:result	
				});
			}
		}
	});
}

//树形下拉菜单
function loadcombotree(){
	$("#upperTree").combotree({
		url:'../../../php/action/page/applycation/applycat.act.php?action=treeData',
		onBeforeExpand:function(node){
			$(this).tree('options').url='../../../php/action/page/applycation/applycat.act.php?action=treeData&upper_id='+node.id;
		},
		/*onClick:function(node){
			$('#upper_cat1').val(node.upper_cat+node.id+'.');
		},*/
		onLoadSuccess:function(node,data){
			$("#upperTree").combotree('tree').tree('expandAll');	
		}	
	});
}

function edtCat(id){
	$.get('../../../php/action/page/applycation/applycat.act.php?action=findCat&id='+id,function(result){
		$('#edtFm').form('clear');
		loadcombotree();
		
		var res=eval("("+result+")");
        $('#edtDlg').dialog('open').dialog('setTitle','编辑信息');
        $('#edtFm').form('load',res);
		edtid=id;
	});
}

function saveEdtCat(){
	$('#edtFm').form('submit',{
		url:'../../../php/action/page/applycation/applycat.act.php?action=saveEdtCat&id='+edtid,
		success:function(result){
			var node=$("#treeData").tree('find',upper_id);
			result=eval('('+result+')');
			
			$('#edtDlg').dialog('close');        
        	$('#catgrid').datagrid('reload');
		
			if(result[0].upper_id==upper_id){
				if(upper_id!=0){
					var node=$("#treeData").tree('find',upper_id);
					$("#treeData").tree('reload',node.target);	
				}else{
					loadTree();	
				}
			}else{
				if(upper_id==0||result[0].upper_id==0){
					loadTree();
				}else{
					var oldnode=$("#treeData").tree('find',edtid);
					$("#treeData").tree('remove',oldnode.target);
					var n=$("#treeData").tree('find',result[0].upper_id);
					$("#treeData").tree('append',{
						parent:n.target,
						data:result	
					});
				}
			}
			edtid=null;
     	}
	});
}

/**********删除/批量删除分类**********************************/
function delCat(id){
	$.messager.confirm('提示信息','确定删除吗？',function(r){
     	if (r){
      		$.get('../../../php/action/page/applycation/applycat.act.php?action=delCat&id='+id,function(){
           		$('#catgrid').datagrid('reload');
				var node=$("#treeData").tree('find',id);
				$("#treeData").tree('remove',node.target);
      		});					 
     	}
    });
}

function delCatlist(){
	var rows = $("#catgrid").datagrid("getChecked");
	if(rows.length==0){
		$.messager.alert('消息提示','请选择要删除的数据信息','info');	
	}else{
		var list=new Array();
		for(var i=0;i<rows.length;i++){
			list[i]=rows[i].id;	
		}		
		$.messager.confirm('消息提示','确定删除吗？',function(r){
			if (r){
			   $.get('../../../php/action/page/applycation/applycat.act.php?action=delCatlist&idlist='+list,function(data){
				   $('#catgrid').datagrid('reload');
				   var arr=data.split(',');
				   for(var i=0;i<arr.length;i++){
					   var node=$("#treeData").tree('find',arr[i]);
					   $("#treeData").tree('remove',node.target);
				   }
			   });
			}
		});
	}
}

/***********禁用/启用********************/
function disableCat(flag){
	var message='';
	var smessage='';
	var rows = $("#catgrid").datagrid("getChecked");
			
	if(rows.length==0){
		if(flag==0){
			message='请选择要启用的数据信息';
			smessage='确定启用吗？';
		}else{
			message='请选择要禁用的数据信息';
			smessage='确定禁用吗？';
		}
		$.messager.alert('消息提示',message,'info');
	}else{
		if(flag==0){
			smessage='确定启用吗？';
		}else{
			smessage='确定禁用吗？';
		}
		var list=new Array();
		for(var i=0;i<rows.length;i++){
			list[i]=rows[i].id;	
		}	
		$.messager.confirm('消息提示',smessage,function(r){
			if(r){
				$.get('../../../php/action/page/applycation/applycat.act.php?action=disableCat&idlist='+list+'&flag='+flag,function(data){
					$('#catgrid').datagrid('reload');
				});
			}
		});
	}
}