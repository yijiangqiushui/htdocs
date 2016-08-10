/**
author:Gao Xue 
date:2014-05-06
Modified by Zhao Xiaogang 2015/03/02
*/
var upid=0,uptext='根节点',upcat,edtid,upcatname_all;

function loadTree(){
	$("#treeData").tree({
		url:'../../../../php/action/page/smslist/smslistcat.act.php?action=treeData',
		onBeforeExpand:function(node){
			$(this).tree('options').url='../../../../php/action/page/smslist/smslistcat.act.php?action=treeData&up_id='+node.id;
		},
		onClick:function(node){
			if(node.user_id!=node.admin_id){
					$("a[onclick='delArrCat()']").css('display','none');			
					$("a[onclick='newCat()']").css('display','none');			
			}else{
					$("a[onclick='delArrCat()']").css('display','');			
					$("a[onclick='newCat()']").css('display','');			
				}
				
			$('#catGrid').datagrid('load',{'upid':node.id});
			upid=node.id;
			uptext=node.text;
			upcat=node.upper_cat;
			
		}
	});
}

$(function(){
	$('body').css('display','none');
	$.get('../../../../php/action/page/jdgPge.act.php',function(data){
		pridge=data;
		$('body').css('display','block');
		if(data=='super'){
			loadPage();	
		}else{
			if(data.indexOf('smslistcat_query')<0){
				$('body').html('<h2>您没有操作权限</h2>');			
			}else{	
				if(data.indexOf('smslistcat_del')<0){
						$("a[onclick='delArrCat()']").css('display','none');			
				}
				if(data.indexOf('smslistcat_add')<0){
						$("a[onclick='newCat()']").css('display','none');			
				}
				if(data.indexOf('smslistcat_disable')<0){
						$("a[iconCls='icon-no']").css('display','none');			
				}
				if(data.indexOf('smslistcat_enable')<0){
						$("a[iconCls='icon-ok']").css('display','none');			
				}				
				loadPage();
			}
		}
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

function loadPage(){
	loadTree();	
	$('#catGrid').datagrid({
		//height:250,
		nowrap : true,//设置为true，当数据长度超出列宽时将会自动截取
		striped : true,//设置为true将交替显示行背景。
		collapsible : false,//显示可折叠按钮
		singleSelect:true,//为true时只能选择单行
		fitColumns:true,//允许表格自动缩放，以适应父容器
		rownumbers : true,//行数
		pagination:true,//分页
		pageSize: 15,  
		pageList: [5,10,15], 
		checkOnSelect:false,
		selectOnCheck:false, 
		remoteSort : false,
		toolbar:'#toolbar',
				   
		url:'../../../../php/action/page/smslist/smslistcat.act.php?action=catGrid',//url调用Action方法
		columns:[[
			{field:'id',title:'id',checkbox:true},
			{field:'cat_name',title:'名称',width:100},
			{field:'exclusive_name',title:'专用名称',width:100},
			{field:'upper_cat',title:'上级节点',width:100},
			{field:'upper_id',title:'父节点ID',width:100},
			{field:'is_forbidden',title:'是否禁用',width:100,
				formatter:function(value,row,index){
					var s='';
					if(value=='0'){
						s='启用';
					}else{
						s='禁用';
					}
					return s;
				}},
			{field:'is_leaf',title:'是否是叶子节点',width:100,
				formatter:function(value,row,index){
					var s='';
					if(value=='0'){
						s='非叶子节点';
					}else{
						s='叶子节点';
					}
					return s;
				}},
			{field:'action',title:'操作',width:150,align:'center',
				formatter:function(value,row,index){							
					var a='<a href="javascript:void(0)" onclick="edtCat('+row.id+')">编辑</a>';
					var b=' | '+'<a href="javascript:void(0)" onclick="delCat('+row.id+')"> 删除</a>';							
					var rn='';
					if(pridge=='super'){
						if(row.user_id==1){
							rn=a+b;
						}else{
							rn='无操作权限';
						}
					}else{
						if(pridge.indexOf('smslistcat_edit')>=0){
							rn+=a;
						}
						if(pridge.indexOf('smslistcat_del')>=0){
							rn+=b;
						}
					}
					return rn;	
				}
			}															
		]]						  
	});
				
	var p = $('#catGrid').datagrid('getPager');			  
	$(p).pagination({  
			pageSize: 15,  
			pageList: [5,10,15],  
			beforePageText: '第', 
			afterPageText: '页    共 {pages} 页',  
			displayMsg: '当前显示 {from} - {to} 条记录   共 {total} 条记录'  						   
	});
}

/*
功能：添加
*/
function newCat(){
	$('#newDlg').dialog('open').dialog('setTitle','添加信息');
	$('#newFm').form('clear');
	$('#newFm').form('load',{'uptext':uptext,'is_forbidden':'0','is_recommend':'1','upper_id':upid,'upper_cat':(upid!=0)?upcat+upid+'.':'.'});
	url = '../../../../php/action/page/smslist/smslistcat.act.php?action=saveCat';
}


function saveCat(){
	cat_name=$('input[name="cat_name"]').val();
	$('#newFm').form('submit',{
		url:url,
		success:function(result){
			$('#newDlg').dialog('close');        
        	$('#catGrid').datagrid('reload',{'upid':upid});
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

/*
功能：树形下拉菜单
*/
function loadcombotree(){
	$("#tree").combotree({
		url:'../../../../php/action/page/smslist/smslistcat.act.php?action=treeData',
		onBeforeExpand:function(node){
			$(this).tree('options').url='../../../../php/action/page/smslist/smslistcat.act.php?action=treeData&up_id='+node.id;
		},
		onClick:function(node){
			if(node.id=='0'){
				$('input[name="upper_cat"]').val('.');
				upcatname_all='';
			}else{
				$('input[name="upper_cat"]').val(node.upper_cat+node.id+'.');
				upcatname_all=node.catname_all;
			}
			upid=node.id;
		},
		onLoadSuccess: function (node, data) {
			$('#tree').combotree('tree').tree("expandAll"); 
		}	
	});
}

/*
功能：编辑
*/
function edtCat(id){
	$.get('../../../../php/action/page/smslist/smslistcat.act.php?action=findCat&id='+id,function(data){
		$('#edtFm').form('clear');
		loadcombotree();
		var res=eval("("+data+")");
		$('#edtDlg').dialog('open').dialog('setTitle','编辑信息');
        $('#edtFm').form('load',res);
		edtid=id;
	});
}

function edtSaveCat(){
	catname_edit=$('#catname_edit').val();
	if(upid!=0){
		$('#catname_alledit').val(upcatname_all+','+catname_edit);
	}else{
		$('#catname_alledit').val(catname_edit);
	}
	$('#edtFm').form('submit',{
		url:'../../../../php/action/page/smslist/smslistcat.act.php?action=saveEdtEle&id='+edtid,
		onSubmit: function(){
    	},
		success: function(result){
			$('#edtDlg').dialog('close');        
        	$('#catGrid').datagrid('reload',{'upid':upid});
			if(result==upid){
				if(upid!=0){
					var node=$("#treeData").tree('find',upid);
					$("#treeData").tree('reload',node.target);	
				}else{
					loadTree();	
				}
			}else{
				if(upid==0||result==0){
					loadTree();
				}else{
					var oldnode=$("#treeData").tree('find',edtid);
					$("#treeData").tree('remove',oldnode.target);
					
					var pn=$("#treeData").tree('find',result);
					$("#treeData").tree('reload',pn.target);
				}
			}
			edtid=null;
		}
	});
}

/*
功能：单条删除
*/
function delCat(id){
	$.messager.confirm('提示信息','确定删除吗？',function(r){
     	if (r){
      		$.get( '../../../../php/action/page/smslist/smslistcat.act.php?action=delCat&id='+id,function(){						
           		$('#catGrid').datagrid('reload',{'upid':upid});
				var node=$("#treeData").tree('find',id);
				$("#treeData").tree('remove',node.target);
      		});					 
     	}
	});   
}

/*
功能：批量删除
*/
function delArrCat(){
	var rows = $("#catGrid").datagrid("getChecked");
	if(rows.length==0){
		$.messager.alert('消息提示','请选择要删除的数据信息','info');	
	}else{
		var list=new Array();
		for(var i=0;i<rows.length;i++){
			list[i]=rows[i].id;	
		}	
		$.messager.confirm('消息提示','确定删除吗？',function(r){
			if (r){
				$.get( '../../../../php/action/page/smslist/smslistcat.act.php?action=delArrCat&idlist='+list,function(data){
					$('#catGrid').datagrid('reload',{'upid':upid});
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

/*
功能：禁用操作
*/
function disableCat(flag){
	var str;
	var rows = $("#catGrid").datagrid("getChecked");
			
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
				$.get( '../../../../php/action/page/smslist/smslistcat.act.php?action=disableCat&idlist='+list+'&flag='+flag,function(data){			
				   $('#catGrid').datagrid('reload');
				});					 
			}
		});
	}
}