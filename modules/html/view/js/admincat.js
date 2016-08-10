/**
Modified by GaoXue	2014/05/23
*/

		var url;
		var upid=0;
		var uptext='';
		var edtid;
		var pridge;
		//var fg=false;


		
	$(function() {
		
		
		$('body').css('display','none');
		$.get('../../../php/action/page/jdgPge.act.php',function(data){
			pridge=data;
			$('body').css('display','block');
			if(data=='super'){
				loadPage();
			}else{
				if(data.indexOf('admincat_query')<0){
					$('body').html('<h2>您没有操作权限</h2>');
					
				}else{
					if(data.indexOf('admincat_del')<0){
							$("a[onclick='delElelist()']").css('display','none');			
					}
					if(data.indexOf('admincat_add')<0){
							$("a[onclick='newEle()']").css('display','none');			
					}
					if(data.indexOf('admincat_disable')<0){
							$("a[iconCls='icon-no']").css('display','none');			
					}
					if(data.indexOf('admincat_enable')<0){
							$("a[iconCls='icon-ok']").css('display','none');			
					}				
					loadPage();
				}	
			}
		});	
						
			  					   						
	});
		
	//表结构
	function loadPage(){
		
		
		$('#grid').datagrid({
				//title:'角色信息',
							
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
				toolbar:'#toolbar',
						   
				url:'../../../php/action/page/admincat/admincat.act.php?action=show',//url调用Action方法
				columns:[[
							
					{field:'id',title:'id',checkbox:true},
					{field:'catName',title:'名称',width:100},
					{field:'upperCat',title:'上级节点',width:100},
					{field:'upperID',title:'父节点ID',width:100},
					{field:'isForbidden',title:'是否禁用',width:100},
					{field:'userPrivileges',title:'角色权限',width:150},
					{field:'isLast',title:'是否是叶子节点',width:100},
					
					{field:'action',title:'操作',width:150,align:'center',
						formatter:function(value,row,index){							
							var a='<a href="javascript:void(0)" onclick="edtEle('+row.id+')">编辑</a>';
							var b=' | '+'<a href="javascript:void(0)" onclick="delEle('+row.id+')"> 删除</a>';
							var rn='';
							if(pridge=='super'){
								rn=a+b;
							}else{
								if(pridge.indexOf('admincat_edit')>=0){
									rn+=a;
								}
								if(pridge.indexOf('admincat_del')>=0){
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
					pageSize: 15,  
					pageList: [5,10,15,20,30],  
					beforePageText: '第', 
					afterPageText: '页    共 {pages} 页',  
					displayMsg: '当前显示 {from} - {to} 条记录   共 {total} 条记录'  						   
			}); 	
	}
		
		
	function loadTree(){
		//树形结构
		$("#treeData").tree({
			
			url:'../../../php/action/page/admincat/admincat.act.php?action=treeData',
			
			checkbox:false,
			animate:true,
			lines:false,

			onBeforeExpand:function(node){
				$(this).tree('options').url='../../../php/action/page/admincat/admincat.act.php?action=treeData&up_id='+node.id;
			},
			
			onClick:function(node){
				//alert(node.id);
				//if(!fg){
					$(this).tree('expand',node.target);
				//	fg=true;
				/*
				}else{
					$(this).tree('collapse',node.target);
					fg=false;	
				}
				*/
				$('#grid').datagrid('load',{
					'upid':node.id
				});
				
				upid=node.id;
				if(node.text=='全部'){
					uptext='';	
				}else{
					uptext=node.text;
				}
			}
				
		});
	}
		
	/*	
		window.onresize=function(){		
			$('#grid').datagrid('resize',{	
				//height:$("#body").height(),
				width:$('#body').width()
			});
		}
	*/
		
//添加
function newEle(){

     $('#dlg').dialog('open').dialog('setTitle','添加信息');
     $('#fm').form('clear');
	 $('#pid').val(upid);
	 $('#ptext').val(uptext);
	 getCatList('concat_expert','applycat');
	$('#fm').form('load',{'role':'score1'});
	url = '../../../php/action/page/admincat/admincat.act.php?action=add';
}
	
function saveEle(){
	
	var pdg="priviliges,";
	pdg+='concat_'+$('#concat_expert').combotree('getValue')+",";
	$("#fm input[name=role]").each(function(){
		if($(this).prop("checked")){
			pdg+=$(this).val()+",";	
		}	
	});
	pdg=pdg.substring(0,pdg.length-1);
	
	/*var v;
	if($('#lab_school').combobox('getValue')==''){
		v='lab_school:0'	
	}else{
		v='lab_school:'+$('#lab_school').combobox('getValue');	
	}
	
	pdg=v+pdg;*/
	
	$("#pridge").val(pdg);
	
     $('#fm').form('submit',{
     url:url,
     onSubmit: function(){
     },
     success: function(result){
		
		$('#dlg').dialog('close');        
        $('#grid').datagrid('reload');
	
		if(upid==0){
			//$("#treeData").tree('reload');
			loadTree();
		}else{
			var node=$("#treeData").tree('find',upid);

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
		$("#pritree").combotree({
			url:'../../../php/action/page/admincat/admincat.act.php?action=treeData',
			onBeforeExpand:function(node){
				$(this).tree('options').url='../../../php/action/page/admincat/admincat.act.php?action=treeData&up_id='+node.id;
			},
			onClick:function(node){
				//alert($("#pritree").combotree('getValue'));
			},
			onLoadSuccess:function(node,data){
				$("#pritree").combotree('tree').tree('expandAll');	
			}	
		});
		
}

//修改
function edtEle(id){
	$.get( '../../../php/action/page/admincat/admincat.act.php?action=findbyid&id='+id,function(data){
			
		$('#edt-form').form('clear');	
		getCatList('concat_expert1','applycat');
		loadcombotree();
		var res=eval("("+data+")");	
		
        $('#edt').dialog('open').dialog('setTitle','编辑信息');

        $('#edt-form').form('load',res);
        $('#edt-form').form('load',{'score':res.score1?res.score1:res.score0});
		
		edtid=id;
	
   });
	
}

	
function saveEdtEle(){
	var pdg="priviliges,";
	pdg+='concat_'+$('#concat_expert1').combotree('getValue')+',';
	if($("#edt-form input[type='radio']:checked").val()){
		pdg+=$("#edt-form input[type='radio']:checked").val()+',';
	}
	$("#edt-form input[type=checkbox]").each(function(){
		if($(this).prop("checked")){
			pdg+=$(this).val()+",";	
		}	
	});
	/*var v;
	
	//alert($('#lab_school').combobox('getValue'));
	
	if($('#lab_school2').combobox('getValue')==''){
		v='lab_school:'+0;	
	}else{
		v='lab_school:'+$('#lab_school2').combobox('getValue');	
	}
	
	pdg=v+pdg;*/
	pdg=pdg.substring(0,pdg.length-1);
	
	$("#pridge2").val(pdg);
	
	
     $('#edt-form').form('submit',{
     	url:'../../../php/action/page/admincat/admincat.act.php?action=saveEdtEle&id='+edtid,
     	onSubmit: function(){
    	},
     	success: function(result){
			
			var node=$("#treeData").tree('find',upid);

			result=eval('('+result+')');
			
			$('#edt').dialog('close');        
        	$('#grid').datagrid('reload');
		
			if(result[0].upperID==upid){
				if(upid!=0){
					var node=$("#treeData").tree('find',upid);
					$("#treeData").tree('reload',node.target);	
				}else{
					loadTree();	
				}
			}else{
				
				
				
				if(upid==0||result[0].upperID==0){
					loadTree();
				}else{
					var oldnode=$("#treeData").tree('find',edtid);
					$("#treeData").tree('remove',oldnode.target);
				
					var n=$("#treeData").tree('find',result[0].upperID);
					
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

//查询
function queEle(){
	$('#show').dialog('open').dialog('setTitle','查询条件');	
	$('#show-form').form('clear');
			
}
function queResult(){
			
	if(($('#search_name').val()=='')&&($('#search_state').combobox('getValue')=='')){
		$('#show').dialog('close');
	}else{ 		
		$('#show').dialog('close');
		
		$('#show-form').form('submit',{
			url:'../../../php/action/page/admincat/admincat.act.php?action=show',
			onSubmit: function(){
					
			},
			success: function(result){
			
			
				$('#show').dialog('close'); 				
				$('#grid').datagrid('load',{
					'upid':upid,
					'catName':$('#search_name').val(),
					'isForbidden':$('#search_state').combobox('getValue')	
				});	
					
			}
		});	
			
			
	}
			
}

//删除
function delEle(id){
     $.messager.confirm('提示信息','确定删除吗？',function(r){
     	if (r){
      		$.get( '../../../php/action/page/admincat/admincat.act.php?action=delEle&id='+id,function(){						
           		$('#grid').datagrid('reload');
				  
				var node=$("#treeData").tree('find',id);
				$("#treeData").tree('remove',node.target);
				      
      		});					 
     	}
     });         
}
		
//批量删除
function delElelist(){
	var rows = $("#grid").datagrid("getChecked");
			
	if(rows.length==0){
		$.messager.alert('消息提示','请选择要删除的数据信息','info');	
	}else{
		var list=new Array();
		for(var i=0;i<rows.length;i++){
			list[i]=rows[i].id;	
		}
				
		$.messager.confirm('消息提示','确定删除吗？',function(r){
               if (r){
                        $.get( '../../../php/action/page/admincat/admincat.act.php?action=delByIdList&idlist='+list,function(data){			
                           $('#grid').datagrid('reload');
						   						   
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

//禁用操作
function disableEle(flag){
	var rows = $("#grid").datagrid("getChecked");
			
	if(rows.length==0){
		$.messager.alert('消息提示','请选择要禁用的数据信息','info');	
	}else{
		var list=new Array();
		for(var i=0;i<rows.length;i++){
			list[i]=rows[i].id;	
		}
				
		$.messager.confirm('消息提示','确定删除吗？',function(r){
               if (r){
                        $.get( '../../../php/action/page/admincat/admincat.act.php?action=disableEle&idlist='+list+'&flag='+flag,function(data){			
                           $('#grid').datagrid('reload');
						                        
                        });					 
                    }
                });
					
			}
}


//获取管理分类列表
function getCatList(str,str_table){
	$('#'+str).combotree({
			url: '../../../php/action/page/admincat/admincat.act.php?action=content_tree&table_name='+str_table,
			checkbox:false,
			animate:true,
			lines:false,

			onBeforeExpand:function(node){
				$(this).tree('options').url='../../../php/action/page/admincat/admincat.act.php?action=content_tree&up_id='+node.id+'&table_name='+str_table;
			},
		onLoadSuccess: function (node, data) {
			$('#'+str).combotree('tree').tree("expandAll"); 
		},
			onClick:function(node){
				$(this).tree('expand',node.target);
			}
		});
}

