/**
*Modified by GaoXue	2014/05/23
*/
var url;
var upid=0;
//var uptext='顶级';
var uptext='',upCat,upIsLast,upCagory;
var edtid;
var usr,isForbidden;
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
				if(data.indexOf('admininfo_query')<0){
					$('body').html('<h2>您没有操作权限</h2>');
					
				}else{
					if(data.indexOf('admininfo_del')<0){
							$("a[onclick='delArrAdmin()']").css('display','none');			
					}
					if(data.indexOf('admininfo_add')<0){
							$("a[onclick='newAdmin()']").css('display','none');			
					}
					if(data.indexOf('admininfo_disable')<0){
							$("a[iconCls='icon-no']").css('display','none');			
					}
					if(data.indexOf('admininfo_enable')<0){
							$("a[iconCls='icon-ok']").css('display','none');			
					}
					loadTree()				
					loadPage();
				}	
			}
		});
	
		   						
});

function loadTree(){
	$("#treeData").tree({
		url:'../../../php/action/page/admincat/admincat.act.php?action=treeData',
		checkbox:false,
		animate:true,
		lines:false,
		onBeforeExpand:function(node){
			$(this).tree('options').url='../../../php/action/page/admincat/admincat.act.php?action=treeData&up_id='+node.id;
		},
		onClick:function(node){
			upid=node.id;
			uptext=node.text;
			upCat=node.upperCat;
			upIsLast=node.isLast;
			if(node.id=='0'){
				upCagory='.';
			}else{
				upCagory=node.upperCat+node.id+'.';
			}
			$('#admingrid').datagrid('load',{'upCagory':upCagory});
		}
	});
}

function loadPage(){
	$('#admingrid').datagrid({
		height:250,
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
				   
		url:'../../../php/action/page/admincat/admininfo.act.php?action=queryAdmin',//url调用Action方法
		columns:[[
					
			{field:'id',title:'id',checkbox:true},
			{field:'usr',title:'用户名',width:100},
			{field:'phone',title:'联系方式',width:100},
			{field:'email',title:'E-MAIL',width:100},
			{field:'qq',title:'QQ',width:100},
			{field:'isForbidden',title:'是否禁用',width:150,
				formatter:function(value,row,index){
					var s='';
					if(value=='0'){
						s='启用';
					}else{
						s='禁用';
					}
					return s;
				}},
			{field:'addedDate',title:'添加时间',width:100},
			
			{field:'action',title:'操作',width:150,align:'center',
				formatter:function(value,row,index){							
					var a='<a href="javascript:void(0)" onclick="editAdmin('+row.id+')">编辑</a>';
					var b=' | '+'<a href="javascript:void(0)" onclick="delAdmin('+row.id+')"> 删除</a>';							
					var rn='';
					if(pridge=='super'){
							rn=a+b;
					}else{
							if(pridge.indexOf('admininfo_edit')>=0){
								rn+=a;
							}
							if(pridge.indexOf('admininfo_del')>=0){
								rn+=b;
							}
						}
							
					return rn;
				}
			}															
		]]						  
	});
				
	var p = $('#admingrid').datagrid('getPager');			  
	$(p).pagination({  
			pageSize: 15,  
			pageList: [5,10,15,20,30], 
			beforePageText: '第', 
			afterPageText: '页    共 {pages} 页',  
			displayMsg: '当前显示 {from} - {to} 条记录   共 {total} 条记录'  						   
	});   					
}





function newAdmin(){
	if(uptext==''||uptext=='全部'){
		$.messager.alert('消息提示','请选择分类','info');
	}else{
		if(upIsLast!='0'){
			$('#newdlg').dialog('open').dialog('setTitle','添加信息');
			$('#newfm').form('clear');
			$('#newfm').form('load',{'isForbidden':'0'});
			$('#pcat').val(upCat+upid+'.');
			$('#ptext').val(uptext);
			url = '../../../php/action/page/admincat/admininfo.act.php?action=saveAdmin';
		}
		else{
			$.messager.alert('消息提示','请选择子分类进行添加','info');
		}
	}
}

<!--添加用户-->
function saveAdmin(){
	$('#newfm').form('submit',{
		url:url,
		success:function(result){
			$('#newdlg').dialog('close');
			$('#admingrid').datagrid('load',{'upCagory':upCagory});
		}
	});
}

<!--编辑用户-->
function editAdmin(id){
	$.get('../../../php/action/page/admincat/admininfo.act.php?action=getAdmin&id='+id,function(data){
		var res=eval("("+data+")");
		loadcombotree(res);
		$('#edtdlg').dialog('open').dialog('setTitle','修改信息');
		$('#edtdlg').form('clear');
		$('#edtdlg').form('load',res);
		url='../../../php/action/page/admincat/admininfo.act.php?action=updateAdmin&id='+id;
	});
}

function updateAdmin(){
	$('#edtdlgfm').form('submit',{
		url:url,
		success:function(result){
			$('#edtdlg').dialog('close');
			$('#admingrid').datagrid('load',{'upCagory':upCagory});
		}
	});
}
<!--删除用户-->
function delAdmin(id){
	$.messager.confirm('提示信息','确定删除吗？',function(r){
		if (r){
			$.get( '../../../php/action/page/admincat/admininfo.act.php?action=delAdmin&id='+id,function(data){						
				$('#admingrid').datagrid('reload',{'upCagory':upCagory});                      
			});					 
		}
	});   
}

<!--批量删除用户-->
function delArrAdmin(){
	var rows = $("#admingrid").datagrid("getChecked");
	if(rows.length==0){
		$.messager.alert('消息提示','请选择要删除的信息','info');	
	}else{
		var list=new Array();
		for(var i=0;i<rows.length;i++){
			list[i]=rows[i].id;
		}
		$.messager.confirm('消息提示','确定删除吗？',function(r){
			if(r){
				$.get('../../../php/action/page/admincat/admininfo.act.php?action=delArrAdmin&arrId='+list,function(data){
					$('#admingrid').datagrid('reload',{'upCagory':upCagory});
				});
			}
		});
	}
}

//树形下拉菜单
function loadcombotree(res){
	$("#catTree").combotree({
		url:'../../../php/action/page/admincat/admincat.act.php?action=treeData',
		onBeforeExpand:function(node){
			$(this).tree('options').url='../../../php/action/page/admincat/admincat.act.php?action=treeData&up_id='+node.id;
		},
		onClick:function(node){
			if(node.isLast=='0'){
				$('#catTree').combotree('setValue',res.upperID);
				$('#upCat').val(res.category);
				$.messager.alert('消息提示','请选择子节点','info');
			}else{
				$('#upCat').val(node.upperCat+node.id+'.');
			}
		},
		onLoadSuccess: function (node, data) {
			//var n=$('#catTree').combotree('tree').tree("find",up); 
			//$('#catTree').combotree('tree').tree("expand",n.target);
			$('#catTree').combotree('tree').tree("expandAll"); 
		}
	});
}

<!--查询信息-->
function queryAdmin(){
	$('#quedlg').dialog('open').dialog('setTitle','查询');
	$('#quefm').form('clear');
	$('#quefm').form('load',{'isForbidden':'0'});
}

function findAdmin(){
	usr=$('#username').val();
	isForbidden=$("input[name=isForbidden]:checked").val();
	$('#admingrid').datagrid('reload',{usr:usr,isForbidden:isForbidden,upCagory:upCagory});
	$('#quedlg').dialog('close');
}

//禁用操作
function disableAdmin(flag){
	var str;
	var rows = $("#admingrid").datagrid("getChecked");
			
	if(rows.length==0){
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
				$.get( '../../../php/action/page/admincat/admininfo.act.php?action=disableAdmin&idlist='+list+'&flag='+flag,function(data){			
				   $('#admingrid').datagrid('reload');
				});					 
			}
		});
	}
}