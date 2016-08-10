/***********************************************************************
author:贺央央
Modified by Gao Xue  2014/04/30  function treeData
Modified by Ma Jun Wei 2014/09/05 
***********************************************************************/
		var url;
		var upid=0;
		var uptext='';
		var edtid;
		var pridge;
		var isDel=0;
		//var fg=false;
		
	$(function() {
		
		$('body').css('display','none');
		$.get('../../../../php/action/page/jdgPge.act.php',function(data){
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
							$("a[onclick='newCat()']").css('display','none');			
					}
					if(data.indexOf('admincat_disable')<0){
							$("a[onclick='disableEle(1)']").css('display','none');			
					}
					if(data.indexOf('admincat_enable')<0){
							$("a[onclick='disableEle(0)']").css('display','none');			
					}	
					$("a[onclick='get_isDel()']").css('display','none');			
					loadPage();
				}
			}
		});				
		$(window).resize(function(){
			setTimeout("reSize()",200); 
		});
		$.post('../../../../../center/php/action/page/ukeyOption.act.php?action=getUsr',function(result){
			if(result==2){
				var browser = DetectBrowser();
				if(browser == "Unknown")
				{
					alert("不支持该浏览器， 如果您在使用傲游或类似浏览器，请切换到IE模式");
					return ;
				}
				//createElementIA300() 对本页面加入IA300插件
			   
				createElementNT199();
				//DetectActiveX() 判断IA300Clinet是否安装
				var create = DetectNT199Plugin();
				if(create == false)
				{
					alert("插件未安装,,请直接安装CD区的插件!");
					return false;
				}
				self.setInterval("findNT199()",1000);
			}
		});
	});
function reSize(){
	$('#grid').datagrid('resize', { 
        width : $('#center').width()<960?960:$('#center').width()
    });  
}
		
	//表结构
	function loadPage(){
		isDel=0;
		loadTree('admincat');
		$('#grid').datagrid({
							
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
						   
				url:'../../../../php/action/page/admin/admincat.act.php?action=show&isDel=0',//url调用Action方法
				columns:[[
							
					{field:'id',title:'id',checkbox:true},
					{field:'catName',title:'名称',width:10,align:'center'},
					//{field:'exclusive_name',title:'专有名称',width:20,align:'center'},
					//{field:'upperName',title:'父节点名称',width:10,align:'center'},
					{field:'isForbidden',title:'是否禁用',width:10,align:'center'},
					//{field:'isLast',title:'是否是叶子节点',width:20,align:'center'},
					
					{field:'action',title:'操作',width:15,align:'center',
						formatter:function(value,row,index){							
							var a='<a href="javascript:void(0)" onclick="editCat('+row.id+')">编辑</a>';
							var b=' | <a href="javascript:void(0)" onclick="delEle('+row.id+')"> 删除</a>';
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
							if(rn==''){
								rn='无操作权限';	
							}
							return rn;	
						}
					}															
					]],	
				 onLoadSuccess: function () {
									reSize();
									return true;
								}						  
			});
			
			var p = $('#grid').datagrid('getPager');			  
			$(p).pagination({  
					pageSize: 15,  
					pageList: [5,10,15,20,30],  
					beforePageText: '第', 
					afterPageText: '页    共 {pages} 页',  
					displayMsg: '当前显示 {from} - {to} 条记录   共 {total} 条记录'  						   
			}); 	
	$('#muti_back').css({'display':'none'});
	}
		
		
	function loadTree(str_name){
		//树形结构
		$("#treeData").tree({
			//url:'../../../../php/action/page/admin/admincat.act.php?action=treeData&table_name='+str_name,
			url:'../../../../php/action/page/admin/admincat.act.php?action=treeData&table_name=admincat',
			
			checkbox:false,
			animate:true,
			lines:false,

			onBeforeExpand:function(node){
				$(this).tree('options').url='../../../../php/action/page/admin/admincat.act.php?action=treeData&up_id='+node.id+'&table_name='+str_name;
			},
			
			onClick:function(node){
				if(isDel==1){
					loadPage();
				}
				$(this).tree('expand',node.target);
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
			

//树形下拉菜单
function loadcombotree(str,str_name){
		$(str).combotree({
			url:'../../../../php/action/page/admin/admincat.act.php?action=treeData&table_name='+str_name,
			onBeforeExpand:function(node){
				$(this).tree('options').url='../../../../php/action/page/admin/admincat.act.php?action=treeData&up_id='+node.id+'&table_name='+str_name;
			},
			onClick:function(node){
				$('#pid').val(node.id);
				//alert($("#pritree").combotree('getValue'));
			},
			onLoadSuccess:function(node,data){
				$(str).combotree('tree').tree('expandAll');	
			}	
		});
		
}

//添加分组
function newCat(){
	$('#new_catDlg').dialog('open').dialog('setTitle','添加信息');
	$('#new_catfm').form('clear');
	$('#pid').val(upid);
	get_cat("#pritree1",'admincat');
	$('#new_catfm').form('load',{'pritree1':upid});
	url = '../../../../php/action/page/admin/admincat.act.php?action=add';
}

function saveNewCat(){
	$('#new_catfm').form('submit',{
		url:url,
		success: function(result){
			$('#new_catDlg').dialog('close');        
      $('#grid').datagrid('reload');
			if(upid==0){
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
function get_cat(str,str_name){
		$(str).combotree({
			url:'../../../../php/action/page/admin/admincat.act.php?action=treeData&table_name='+str_name,
			onBeforeExpand:function(node){
				$(this).tree('options').url='../../../../php/action/page/admin/admincat.act.php?action=treeData&up_id='+node.id+'&table_name='+str_name;
			},
			onClick:function(node){
				$('#pid').val(node.id);
			},
			onLoadSuccess:function(node,data){
				$(str).combotree('tree').tree('expandAll');	
			}	
		});
}

//修改分组
function editCat(id){
	$.get( '../../../../php/action/page/admin/admincat.act.php?action=findbyid&id='+id,function(data){
		$('#edit_catform').form('clear');	
		get_cat("#pritree",'admincat');		
		var res=eval("("+data+")");	
		
		$('#edit_catDlg').dialog('open').dialog('setTitle','编辑信息');
		$('#edit_catform').form('load',res);
		$('#edit_catform').form('load',{'pritree':res.upperID});
		edtid=id;
	
	});
}
	
function saveEditCat(){
	$('#edit_catform').form('submit',{
		url:'../../../../php/action/page/admin/admincat.act.php?action=saveEdtEle&id='+edtid,
		success: function(result){
			var node=$("#treeData").tree('find',upid);
			result=eval('('+result+')');
			if(result=='error'){
				alert('不能编辑到分组本身下！');
				return;
			}
			$('#edit_catDlg').dialog('close');        				
       $('#grid').datagrid('reload');
			if(result[0].upperID==upid){
				if(upid!=0){
					var node=$("#treeData").tree('find',upid);
					$("#treeData").tree('reload',node.target);	
				}else{
					loadTree('admincat');	
				}
			}else{
				if(upid==0||result[0].upperID==0){
					loadTree('admincat');
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

//获取管理分类列表
function getCatList(str,str_table){
	$('#'+str).combotree({
			url: '../../../../php/action/page/admin/admincat.act.php?action=content_tree&table_name='+str_table,
			checkbox:false,
			animate:true,
			lines:false,

			onBeforeExpand:function(node){
				$(this).tree('options').url='../../../../php/action/page/admin/admincat.act.php?action=content_tree&up_id='+node.id+'&table_name='+str_table;
			},
		onLoadSuccess: function (node, data) {
			$('#'+str).combotree('tree').tree("expandAll"); 
		},
			onClick:function(node){
				$(this).tree('expand',node.target);
			}
		});
}

//获取会员管理分类列表
function getMemberCatList(str,str_table){
	$('#'+str).combotree({
			url: '../../../../php/action/page/admin/admincat.act.php?action=tree&table_name='+str_table,
			checkbox:false,
			animate:true,
			lines:false,

			onBeforeExpand:function(node){
				$(this).tree('options').url='../../../../php/action/page/admin/admincat.act.php?action=tree&up_id='+node.id+'&table_name='+str_table;
			},
			onLoadSuccess: function (node, data) {
				$('#'+str).combotree('tree').tree("expandAll"); 
			},
			onClick:function(node){
				$(this).tree('expand',node.target);
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
			url:'../../../../php/action/page/admin/admincat.act.php?action=show&isDel=0',
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
			$.get( '../../../../php/action/page/admin/admincat.act.php?action=delEle&id='+id,function(){						
				var node=$("#treeData").tree('find',id);
        $('#grid').datagrid('reload');
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
                        $.get( '../../../../php/action/page/admin/admincat.act.php?action=delByIdList&idlist='+list,function(data){			
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
	var str;
	var rows = $("#grid").datagrid("getChecked");
			
	if(rows.length==0){
		//$.messager.alert('消息提示','请选择要禁用的数据信息','info');
		if(flag=='0'){
			str='请选择要启用的数据信息';
		}else{
			str='请选择要禁用的数据信息';
		}
		$.messager.alert('消息提示',str,'info');	
	}else{
		var list=new Array();
		for(var i=0;i<rows.length;i++){
			list[i]=rows[i].id;	
		}
		if(flag=='0'){
			str='确定启用吗？';
		}else{
			str='确定禁用吗？';
		}
				
		$.messager.confirm('消息提示',str,function(r){
               if (r){
                        $.get( '../../../../php/action/page/admin/admincat.act.php?action=disableEle&idlist='+list+'&flag='+flag,function(data){			
                           $('#grid').datagrid('reload');
						                        
                        });					 
                    }
                });
					
			}
}

function get_isDel(){
	isDel=1;
	//loadTree('admincat');
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
					 
		url:'../../../../php/action/page/admin/admincat.act.php?action=show&isDel=1',//url调用Action方法
		columns:[[
					
			{field:'id',title:'id',checkbox:true},
			{field:'catName',title:'名称',width:100},
			//{field:'upperName',title:'父节点名称',width:100},
			{field:'isForbidden',title:'是否禁用',width:100},
			//{field:'isLast',title:'是否是叶子节点',width:100},
			
			{field:'action',title:'操作',width:150,align:'center',
				formatter:function(value,row,index){							
					var a='<a href="javascript:void(0)" onclick="uptisDel('+row.id+')">恢复数据</a>';
					var rn='';
					if(pridge=='super'){
						rn=a;
					}else{
						if(pridge.indexOf('admincat_del')>=0){
							rn+=a;
						}
					}
					
					return rn;	
				}
			}															
		]],	
		onLoadSuccess: function () {
			reSize();
			return true;
		}						  
	});
		
	var p = $('#grid').datagrid('getPager');			  
	$(p).pagination({  
		pageSize: 15,  
		pageList: [5,10,15,20,30],  
		beforePageText: '第', 
		afterPageText: '页    共 {pages} 页',  
		displayMsg: '当前显示 {from} - {to} 条记录   共 {total} 条记录'  						   
	}); 	
	$('#muti_back').css({'display':'block'});
}

function uptisDel(id){
	$.messager.confirm('提示信息','确定恢复吗？',function(r){
		if (r){
			$.get( '../../../../php/action/page/admin/admincat.act.php?action=uptisDel&id='+id,function(){						
					loadPage();
					return;			
					$('#grid').datagrid('reload');
					var node=$("#treeData").tree('find',id);
					$("#treeData").tree('add',node.target);
			});					 
		}
	});         
}

function uptisDelList(){
	var rows = $("#grid").datagrid("getChecked");
			
	if(rows.length==0){
		$.messager.alert('消息提示','请选择要恢复的数据信息','info');	
	}else{
		var list=new Array();
		for(var i=0;i<rows.length;i++){
			list[i]=rows[i].id;	
		}
				
		$.messager.confirm('消息提示','确定恢复吗？',function(r){
			if (r){
				$.get( '../../../../php/action/page/admin/admincat.act.php?action=uptisDelList&idlist='+list,function(data){
					loadPage();
					return;			
					$('#grid').datagrid('reload');
					var arr=data.split(',');					   
					for(var i=0;i<arr.length;i++){
						var node=$("#treeData").tree('find',arr[i]);
						$("#treeData").tree('add',node.target);   
					}
				});					 
			}
		});
	}
}
