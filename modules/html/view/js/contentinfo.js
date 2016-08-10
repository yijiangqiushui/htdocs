/**
author:Gao Xue 
date:2014-05-07
*/
var upid=0,uptext='',upcat,edtid;
var upper_cat,is_leaf;
var editor,editor1;
$(function(){
	$('body').css('display','none');
		$.get('../../../php/action/page/jdgPge.act.php',function(data){
			pridge=data;
			$('body').css('display','block');
			if(data=='super'){
				loadTree();
				loadPage();
			}else{
				if(data.indexOf('contentinfo_query')<0){
					$('body').html('<h2>您没有操作权限</h2>');
					
				}else{
					if(data.indexOf('contentinfo_del')<0){
							$("a[onclick='delArrInfo()']").css('display','none');			
					}
					if(data.indexOf('contentinfo_add')<0){
							$("a[onclick='newInfo()']").css('display','none');			
					}
					if(data.indexOf('contentinfo_disable')<0){
							$("a[iconCls='icon-no']").css('display','none');			
					}
					if(data.indexOf('contentinfo_enable')<0){
							$("a[iconCls='icon-ok']").css('display','none');			
					}
					loadTree();				
					loadPage();
				}	
			}
		});
	
		   						
});

function loadTree(){
	$("#treeData").tree({
		url:'../../../php/action/page/content/contentcat.act.php?action=treeData',
		onBeforeExpand:function(node){
			$(this).tree('options').url='../../../php/action/page/content/contentcat.act.php?action=treeData&up_id='+node.id;
		},
		onClick:function(node){
			if(node.id==0){
				upper_cat='.';
			}else{
				upper_cat=node.upper_cat+node.id+'.';
			}
			$('#infoGrid').datagrid('load',{'upper_cat':upper_cat});
			upid=node.id;
			uptext=node.text;
			upcat=node.upper_cat;
			is_leaf=node.is_leaf;
		}
	});
}

function loadPage(){

	$('#infoGrid').datagrid({
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
				   
		url:'../../../php/action/page/content/contentinfo.act.php?action=infoGrid',//url调用Action方法
		columns:[[
			{field:'id',title:'id',checkbox:true},
			{field:'title',title:'标题',width:100},
			//{field:'brief_title',title:'简短标题',width:100},
			//{field:'brief_ctnt',title:'简短内容',width:100},
			//{field:'tags',title:'标签',width:100},
			{field:'add_time',title:'添加时间',width:100},
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
			{field:'is_checked',title:'是否审核',width:100,
				formatter:function(value,row,index){
					var s='';
					if(value=='0'){
						s='未审核';
					}else{
						s='审核通过';
					}
					return s;
				}},
			{field:'is_recommended',title:'是否推荐',width:50,
				formatter:function(value,row,index){
					var s='';
					if(value=='0'){
						s='未推荐';
					}else{
						s='推荐';
					}
					return s;
				}},
			{field:'action',title:'操作',width:150,align:'center',
				formatter:function(value,row,index){
					var a='<a href="javascript:void(0)" onclick="upload('+row.id+')">上传附件</a>';
					var b=' | '+'<a href="javascript:void(0)" onclick="findUpload('+row.id+')">查看附件</a>';							
					var c=' | '+'<a href="javascript:void(0)" onclick="edtInfo('+row.id+')">编辑</a>';
					var d=' | '+'<a href="javascript:void(0)" onclick="delInfo('+row.id+')">删除</a>';							
					var rn='';
					if(pridge=='super'){
							rn=a+b+c+d;
					}else{
							if(pridge.indexOf('contentinfo_edit')>=0){
								rn+=a+b+c;
							}
							if(pridge.indexOf('contentinfo_del')>=0){
								rn+=a+b+d;
							}
							
						}
							
					return rn;	
				}
			}													
		]]						  
	});
				
	var p = $('#infoGrid').datagrid('getPager');			  
	$(p).pagination({  
			pageSize: 15,  
			pageList: [5,10,15,20,30], 
			beforePageText: '第', 
			afterPageText: '页    共 {pages} 页',  
			displayMsg: '当前显示 {from} - {to} 条记录   共 {total} 条记录'  						   
	});

}

/*$(function(){
	KindEditor.options.filterMode = false;
	KindEditor.ready(function(K) {
		editor = K.create('#editor_id', {
			resizeType : 1,
			allowPreviewEmoticons : false,
			allowImageUpload : false,
			items : [
				'source','|','fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
				'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
				'insertunorderedlist', '|', 'emoticons', 'image', 'link']
		});
	});
	
	KindEditor.ready(function(K) {
		editor1 = K.create('#queryEditor', {
			resizeType : 1,
			allowPreviewEmoticons : false,
			allowImageUpload : false,
			items : [
				'source','|','fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
				'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
				'insertunorderedlist', '|', 'emoticons', 'image', 'link']
		});
	});
	
	loadTree();
	$('#infoGrid').datagrid({
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
		toolbar:'#toolbar',
				   
		url:'../../../php/action/page/content/contentinfo.act.php?action=infoGrid',//url调用Action方法
		columns:[[
			{field:'id',title:'id',checkbox:true},
			{field:'title',title:'标题',width:100},
			{field:'brief_title',title:'简短标题',width:100},
			{field:'brief_ctnt',title:'简短内容',width:100},
			{field:'tags',title:'标签',width:100},
			{field:'add_time',title:'添加时间',width:100},
			{field:'is_forbidden',title:'是否禁用',width:50,
				formatter:function(value,row,index){
					var s='';
					if(value=='0'){
						s='启用';
					}else{
						s='禁用';
					}
					return s;
				}},
			{field:'is_checked',title:'是否审核',width:50,
				formatter:function(value,row,index){
					var s='';
					if(value=='0'){
						s='未审核';
					}else{
						s='审核通过';
					}
					return s;
				}},
			{field:'is_recommended',title:'是否推荐',width:50,
				formatter:function(value,row,index){
					var s='';
					if(value=='0'){
						s='未推荐';
					}else{
						s='推荐';
					}
					return s;
				}},
			{field:'action',title:'操作',width:150,align:'center',
				formatter:function(value,row,index){
					var a='<a href="javascript:void(0)" onclick="upload('+row.id+')">上传附件</a>';
					var b=' | '+'<a href="javascript:void(0)" onclick="findUpload('+row.id+')">查看附件</a>';							
					var c=' | '+'<a href="javascript:void(0)" onclick="edtInfo('+row.id+')">编辑</a>';
					var d=' | '+'<a href="javascript:void(0)" onclick="delInfo('+row.id+')">删除</a>';							
					return a+b+c+d;	
				}
			}													
		]]						  
	});
				
	var p = $('#infoGrid').datagrid('getPager');			  
	$(p).pagination({  
			pageSize: 5,  
			pageList: [5,10,15],  
			beforePageText: '第', 
			afterPageText: '页    共 {pages} 页',  
			displayMsg: '当前显示 {from} - {to} 条记录   共 {total} 条记录'  						   
	});
});*/

<!--查询信息-->
function queInfo(){
	$('#queDlg').dialog('open').dialog('setTitle','查询');
	$('#queFm').form('clear');
	editor1.html('');
	//$('#queFm').form('load',{'isForbidden':'0'});
}

function findInfo(){
	editor1.sync();
	var title=$('#title').val();
	var tags=$('#tags').val();
	var content=$('#queryEditor').val();
	$('#infoGrid').datagrid('reload',{'title':title,'tags':tags,'content':content,'upper_cat':upper_cat});
	$('#queDlg').dialog('close');
}

function newInfo(){
	if(uptext==''||uptext=='全部'){
		$.messager.alert('消息提示','请选择分类','info');
	}else{
		if(is_leaf!='0'){
			$('#newDlg').dialog('open').dialog('setTitle','添加信息');
			$('#newFm').form('clear');
			$('#catTree').css('display','none');
			$('.combo').css('display','none');
			$('input[name="upper_text"]').css('display','block');
			editor.html('');
			$('#newFm').form('load',{'cat_id':upid,'category':upcat+upid+'.'});
			$('input[name="upper_text"]').val(uptext);
			if($('input[name="info_source"]').val()==''){
				$('input[name="info_source"]').val('本站');
			}
			url = '../../../php/action/page/content/contentinfo.act.php?action=saveInfo';
		}
		else{
			$.messager.alert('消息提示','请选择子分类进行添加','info');
		}
	}
}

function saveInfo(){
	editor.sync();
	if($('#editor_id').val()==''){
		$.messager.alert('消息提示','请输入内容','info');
	}else{
		$('#newFm').form('submit',{
			url:url,
			success:function(result){
				$('#newDlg').dialog('close');
				$('#infoGrid').datagrid('load',{'upper_cat':upper_cat});
			}
		});
	}
}

function edtInfo(id){
	editor.sync();
	$('#newFm').form('clear');
	$('input[name="upper_text"]').css('display','none');
	//$('#catTree').css('display','none');
	$('.combo').css('display','block');
	$.get('../../../php/action/page/content/contentinfo.act.php?action=getAttach&id='+id,function(result){
		//alert(result);
		var res=eval("("+result+")");
		loadcombotree(res);
		$('#newDlg').dialog('open').dialog('setTitle','编辑信息');
		$('#newFm').form('load',res);
		$('#newFm').form('load',{'cat_id':parseInt(res.catId)});
		editor.html(res.content);
		url = '../../../php/action/page/content/contentinfo.act.php?action=updInfo&id='+id;
	});
}

//树形下拉菜单
function loadcombotree(res){
	$("#catTree").combotree({
		url:'../../../php/action/page/content/contentcat.act.php?action=treeData',
		onBeforeExpand:function(node){
			$(this).tree('options').url='../../../php/action/page/content/contentcat.act.php?action=treeData&up_id='+node.id;
		},
		onClick:function(node){
			if(node.is_leaf=='0'){
				$('#catTree').combotree('setValue',res.catId);
				$('input[name="category"]').val(res.category);
				$.messager.alert('消息提示','请选择子节点','info');
			}else{
				$('input[name="category"]').val(node.upper_cat+node.id+'.');
				$('input[name="cat_id"]').val(node.id);
			}
		},
		onLoadSuccess: function (node, data) {
			$('#catTree').combotree('tree').tree("expandAll"); 
		}
	});
}

function delInfo(id){
	$.messager.confirm('提示信息','确定删除吗？',function(r){
		if (r){
			$.get( '../../../php/action/page/content/contentinfo.act.php?action=delInfo&id='+id,function(data){						
				$('#infoGrid').datagrid('reload',{'upper_cat':upper_cat});                      
			});					 
		}
	});  
}

function delArrInfo(){
	var rows = $("#infoGrid").datagrid("getChecked");
	if(rows.length==0){
		$.messager.alert('消息提示','请选择要删除的信息','info');	
	}else{
		var list=new Array();
		for(var i=0;i<rows.length;i++){
			list[i]=rows[i].id;
		}
		$.messager.confirm('消息提示','确定删除吗？',function(r){
			if(r){
				$.get('../../../php/action/page/content/contentinfo.act.php?action=delArrInfo&arrId='+list,function(data){
					$('#infoGrid').datagrid('reload',{'upper_cat':upper_cat});
				});
			}
		});
	}
}

function upload(id){
	$('#loadDlg').dialog('open').dialog('setTitle','上传');
	$('#loadFm').form('clear');
	url='../../../php/action/page/content/contentinfo.act.php?action=load&id='+id;
}

function loadInfo(){
	$('#loadFm').form('submit',{
		url:url,
		success:function(result){
			if(result=='error'){
				$.messager.alert('消息提示','请选择需要上传的文件','info');
			}else{
				$('#loadDlg').dialog('close');
			}
		}
	});
}

function findUpload(id){
	$('#checkDlg').dialog('open').dialog('setTitle','查看上传附件');
	$('#attachGrid').datagrid({
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
		toolbar:'#toolbar1',
				   
		url:'../../../php/action/page/content/contentinfo.act.php?action=attachGrid&id='+id,//url调用Action方法
		columns:[[
			{field:'id',title:'id',checkbox:true},
			{field:'file_path',title:'附件路径',width:250},
			{field:'file_ext',title:'附件扩展名',width:50},
			{field:'file_size',title:'附件大小',width:50},
			{field:'brief_ctnt',title:'附件描述',width:100},
			{field:'action',title:'操作',width:50,align:'center',
				formatter:function(value,row,index){
					var a='<a href="javascript:void(0)" onclick="delAttach('+row.id+')"> 删除</a>';							
					return a;	
				}
			}															
		]]						  
	});
				
	var p = $('#attachGrid').datagrid('getPager');			  
	$(p).pagination({  
			pageSize: 5,  
			pageList: [5,10,15],  
			beforePageText: '第', 
			afterPageText: '页    共 {pages} 页',  
			displayMsg: '当前显示 {from} - {to} 条记录   共 {total} 条记录'  						   
	});
}

function delAttach(id){
	$.messager.confirm('提示信息','确定删除吗？',function(r){
		if (r){
			$.get( '../../../php/action/page/content/contentinfo.act.php?action=delAttach&id='+id,function(data){						
				$('#attachGrid').datagrid('reload');                      
			});					 
		}
	}); 
}

function delArrAttach(){
	var rows = $("#attachGrid").datagrid("getChecked");
	if(rows.length==0){
		$.messager.alert('消息提示','请选择要删除的信息','info');	
	}else{
		var list=new Array();
		for(var i=0;i<rows.length;i++){
			list[i]=rows[i].id;
		}
		$.messager.confirm('消息提示','确定删除吗？',function(r){
			if(r){
				$.get('../../../php/action/page/content/contentinfo.act.php?action=delArrAttach&arrId='+list,function(data){
					$('#attachGrid').datagrid('reload');
				});
			}
		});
	}
}
