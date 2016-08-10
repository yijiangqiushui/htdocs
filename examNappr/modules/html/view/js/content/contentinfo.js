/**
author:Gao Xue 
date:2014-05-07
Modified by Zhao Xiaogang 2014/09/09
*/
var upid=0,uptext='',upcat,edtid;
var upper_cat,is_leaf;
//var editor,editor1;
var url;
var pridge;

function myformatter(date){
	var y = date.getFullYear();
	var m = date.getMonth()+1;
	var d = date.getDate();
	return y+'-'+(m<10?('0'+m):m)+'-'+(d<10?('0'+d):d);
}
function myparser(s){
	if (!s) return new Date();
	var ss = (s.split('-'));
	var y = parseInt(ss[0],10);
	var m = parseInt(ss[1],10);
	var d = parseInt(ss[2],10);
	if (!isNaN(y) && !isNaN(m) && !isNaN(d)){
		return new Date(y,m-1,d);
	} else {
		return new Date();
	}
}
function loadTree(){
	$("#treeData").tree({
		url:'../../../../php/action/page/content/contentcat.act.php?action=treeData',
		onBeforeExpand:function(node){
			$(this).tree('options').url='../../../../php/action/page/content/contentcat.act.php?action=treeData&up_id='+node.id;
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

/*
功能：编辑
*/
function edtInfo(id){

	$('#newFm').form('clear');
	$('#1').css('display','none');
	$('#2').css('display','block');
	$.post('../../../../php/action/page/content/contentinfo.act.php?action=getAttach&id='+id,function(result){
		res = result;
		loadcombotree(res);	
		var recOption=res.recOption;
			
		$('#newDlg').dialog('open').dialog('setTitle','编辑信息');
		$('#newFm').form('load',res);
		$('#newFm').form('load',{'cat_id':parseInt(res.catId)});
		editor.html(res.content);
	},'json');
	url = '../../../../php/action/page/content/contentinfo.act.php?action=updInfo&id='+id;

}
$(function(){
	$('body').css('display','none');
	$.get('../../../../php/action/page/jdgPge.act.php',function(data){
		pridge=data;
		$('body').css('display','block');
		if(data=='super'){
			loadPage();	
		}else{
			if(data.indexOf('coninfo_query')<0){
				$('body').html('<h2>您没有操作权限</h2>');			
			}else{	
				if(data.indexOf('coninfo_del')<0){
						$("a[onclick='delArrInfo()']").css('display','none');			
				}
				if(data.indexOf('coninfo_add')<0){
						$("a[onclick='newInfo()']").css('display','none');			
				}
				if(data.indexOf('linkinfo_disable')<0){
						$("a[iconCls='icon-no']").css('display','none');			
				}
				if(data.indexOf('linkinfo_enable')<0){
						$("a[iconCls='icon-ok']").css('display','none');			
				}				
				loadPage();
			}
		}
	});	
});

function loadPage(){
	loadTree();
	$('#infoGrid').datagrid({
		//height:250,
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
				   
		url:'../../../../php/action/page/content/contentinfo.act.php?action=infoGrid',//url调用Action方法
		columns:[[
			{field:'id',title:'id',checkbox:true},
			{field:'title',title:'标题',width:100},
//			{field:'brief_title',title:'简短标题',width:100},
//			{field:'brief_ctnt',title:'简短内容',width:100},
//			{field:'tags',title:'标签',width:50},
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
			{field:'action',title:'操作',width:250,align:'center',
				formatter:function(value,row,index){
					var a='<a href="javascript:void(0)" onclick="upload('+row.id+')">科室负责人签批</a>';
					var b=' | '+'<a href="javascript:void(0)" onclick="upload('+row.id+')">主管领导批示</a>';
					var c=' | '+'<a href="javascript:void(0)" onclick="upload('+row.id+')">主要领导批示</a>';
					//var a='<a href="javascript:void(0)" onclick="upload('+row.id+')">上传附件</a>';
					//var b=' | '+'<a href="javascript:void(0)" onclick="findUpload('+row.id+')">查看附件</a>';	
					//var c=' | '+'<a href="javascript:void(0)" onclick="checkInfo('+row.id+')">审核</a>';
					//var h=' | '+'<a href="javascript:void(0)" onclick="commentInfo('+row.id+')">评论</a>';
					//var d=' | '+'<a href="javascript:void(0)" onclick="checkComment('+row.id+')">查看评论</a>';							
					var e=' | '+'<a href="javascript:void(0)" onclick="edtInfo('+row.id+')">编辑</a>';
					var f=' | '+'<a href="javascript:void(0)" onclick="delInfo('+row.id+')">删除</a>';	
					//var g=' | '+'<a href="javascript:void(0)" onclick="detailInfo('+row.id+')">查看详情</a>';
					var rn='';
					if(pridge=='super'){
						rn=a+b+c+e+f;//+d
					}else{
						if(pridge.indexOf('coninfo_upattch')>=0){
							rn+=a;
						}
						if(pridge.indexOf('coninfo_ckattch')>=0){
							rn+=b;
						}
						if(pridge.indexOf('coninfo_check')>=0){
							rn+=c;
						}
						/*if(pridge.indexOf('coninfo_comment')>=0){
							rn+=h;
						}if(pridge.indexOf('coninfo_ckcomment')>=0){
							rn+=d;
						}
						if(pridge.indexOf('coninfo_edit')>=0){
							rn+=e;
						}
						if(pridge.indexOf('coninfo_del')>=0){
							rn+=f;
						}
						if(pridge.indexOf('coninfo_detail')>=0){
							rn+=g;
						}*/
					}
					return rn;								
				}
			}													
		]]						  
	});
				
	var p = $('#infoGrid').datagrid('getPager');			  
	$(p).pagination({  
		pageSize: 20,  
		pageList: [10,20,30], 
			beforePageText: '第', 
			afterPageText: '页    共 {pages} 页',  
			displayMsg: '当前显示 {from} - {to} 条记录   共 {total} 条记录'  						   
	});
	
	$('#baseClass').combobox({
		editable: false,
		panelWidth:250,
		url:'../../../../php/action/page/content/contentinfo.act.php?action=getData',
		valueField:'id',
		textField:'text'
	});
}

/*
功能：查询信息
*/
function queInfo(){
	$('#queDlg').dialog('open').dialog('setTitle','查询');
	$('#queFm').form('clear');
	//editor1.html('');
	//$('#queFm').form('load',{'isForbidden':'0'});
}

function findInfo(){
	
	var title=$('#title').val();
	var tags=$('#tags').val();
	var content=$('#content').val();
	var add_time=$("#add_time").datebox("getValue");
	$('#infoGrid').datagrid('reload',{'title':title,'tags':tags,'content':content,'add_time':add_time,'upper_cat':upper_cat});
	$('#queDlg').dialog('close');
}

/*
功能：添加信息
*/
function newInfo(){
	$('#newDlg').dialog('open').dialog('setTitle','添加信息');
	$('#newFm').form('clear');
	
	editor.html('');
	$('#2').css('display','none');
	$('#1').css('display','block');
	$('#newFm').form('load',{'cat_id':upid,'category':(upid==0)?'.':upcat+upid+'.'});
	$('input[name="upper_text"]').val(uptext);
	
	if($('input[name="info_source"]').val()==''){
		$('input[name="info_source"]').val('本站');
	}
	url = '../../../../php/action/page/content/contentinfo.act.php?action=saveInfo';
}

function saveInfo(){
	editor.sync();
	if($('#editor_id').val()==''){
		$.messager.alert('消息提示','请输入内容','info');
	}else{
			var r='';
			$('input[type="checkbox"]').each(function(){
				if($(this).prop('checked')){
					r=r+$(this).val()+',';
				}	
			});
			r=r.substr(0,r.length-1);
			$('input[name="recOption"]').val(r);
		    $('#newFm').form('submit',{
			url:url,
			success:function(result){
				$('#newDlg').dialog('close');
				$('#infoGrid').datagrid('load',{'upper_cat':upper_cat});
			}
		});
	}
}


/*
树形下拉菜单
*/
function loadcombotree(res){
	$("#catTree").combotree({
		url:'../../../../php/action/page/content/contentcat.act.php?action=treeData',
		onBeforeExpand:function(node){
			$(this).tree('options').url='../../../../php/action/page/content/contentcat.act.php?action=treeData&up_id='+node.id;
		},
		onClick:function(node){
			$('input[name="category"]').val(node.upper_cat+node.id+'.');
			$('input[name="cat_id"]').val(node.id);
		},
		onLoadSuccess: function (node, data) {
			$('#catTree').combotree('tree').tree("expandAll"); 
		}
	});
}

/*
功能：删除单条
*/
function delInfo(id){
	$.messager.confirm('提示信息','确定删除吗？',function(r){
		if (r){
			$.get( '../../../../php/action/page/content/contentinfo.act.php?action=delInfo&id='+id,function(data){						
				$('#infoGrid').datagrid('reload',{'upper_cat':upper_cat});                      
			});					 
		}
	});  
}

/*
功能：批量删除
*/
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
				$.get('../../../../php/action/page/content/contentinfo.act.php?action=delArrInfo',{arrId:list},function(data){
					$('#infoGrid').datagrid('reload',{'upper_cat':upper_cat});
				});
			}
		});
	}
}

/*
功能：上传附件
*/
function upload(id){
	$('#loadDlg').dialog('open').dialog('setTitle','上传');
	$('#loadFm').form('clear');
	url='../../../../php/action/page/content/contentinfo.act.php?action=load&id='+id;
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

/*
功能：查看附件
*/
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
		pageSize: 20,  
		pageList: [10,20,30], 
		checkOnSelect:false,
		selectOnCheck:false, 
		remoteSort : false,
		toolbar:'#toolbar1',
				   
		url:'../../../../php/action/page/content/contentinfo.act.php?action=attachGrid&id='+id,//url调用Action方法
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
		pageSize: 20,  
		pageList: [10,20,30], 
			beforePageText: '第', 
			afterPageText: '页    共 {pages} 页',  
			displayMsg: '当前显示 {from} - {to} 条记录   共 {total} 条记录'  						   
	});
}

/*
功能：删除
*/
function delAttach(id){
	$.messager.confirm('提示信息','确定删除吗？',function(r){
		if (r){
			$.get( '../../../../php/action/page/content/contentinfo.act.php?action=delAttach&id='+id,function(data){						
				$('#attachGrid').datagrid('reload');                      
			});					 
		}
	}); 
}

/*
功能：批量删除
*/
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
				$.get('../../../../php/action/page/content/contentinfo.act.php?action=delArrAttach',{arrId:list},function(data){
					$('#attachGrid').datagrid('reload');
				});
			}
		});
	}
}
/*
功能：审核
*/
function checkInfo(id){
	$.messager.confirm('提示信息','确定审核吗？',function(r){
		if (r){
			$.get( '../../../../php/action/page/content/contentinfo.act.php?action=checkInfo&id='+id,function(data){						
				$('#infoGrid').datagrid('reload',{'upper_cat':upper_cat});                     
			});					 
		}
	}); 
}


/*
禁用操作
*/
function disableEle(flag){
	var str;
	var rows = $("#infoGrid").datagrid("getChecked");
			
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
				$.get( '../../../../php/action/page/content/contentinfo.act.php?action=disableInfo&idlist='+list+'&flag='+flag,function(data){			
				   $('#infoGrid').datagrid('reload');
				});					 
			}
		});
	}
}

/*
功能：添加评论
*/
function commentInfo(id){
	$('#commentDlg').dialog('open').dialog('setTitle','添加评论');
	$('#commentFm').form('clear');
	$('#commentFm').form('load',{'comment_grade':1});
	url = '../../../../php/action/page/content/contentinfo.act.php?action=saveComment&id='+id;
}

function saveComment(){
	$('#commentFm').form('submit',{
		url:url,
		success:function(result){
			$('#commentDlg').dialog('close');
			$('#commentGrid').datagrid('reload');
			//$('#infoGrid').datagrid('load',{'upper_cat':upper_cat});
		}
	});
}

/*
功能：查看评论
*/
function checkComment(id){
	$('#checkComDlg').dialog('open').dialog('setTitle','查看评论');
	$('#commentGrid').datagrid({
		height:250,
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
		toolbar:'#toolbar2',
				   
		url:'../../../../php/action/page/content/contentinfo.act.php?action=commentGrid&id='+id,//url调用Action方法
		columns:[[
			{field:'id',title:'id',checkbox:true},
			{field:'comment',title:'评论内容',width:250},
			{field:'comment_grade',title:'评论等级',width:50,
				formatter:function(value,row,index){
					var str='';
					switch(value){
						case '1':
							str='好评';
							break;
						case '2':
							str='差评';
							break;
						case '3':
							str='一般';
							break;
						default:;
					}
					return str;
				}},
			{field:'comment_time',title:'评论时间',width:50},
			{field:'member_name',title:'评论人',width:100},
			{field:'action',title:'操作',width:50,align:'center',
				formatter:function(value,row,index){
					var a='<a href="javascript:void(0)" onclick="editComment('+row.id+')">编辑</a>';	
					var b='|'+'<a href="javascript:void(0)" onclick="delComment('+row.id+')">删除</a>';							
					return a+b;	
				}
			}															
		]]						  
	});
				
	var p = $('#commentGrid').datagrid('getPager');			  
	$(p).pagination({  
		pageSize: 20,  
		pageList: [10,20,30], 
			beforePageText: '第', 
			afterPageText: '页    共 {pages} 页',  
			displayMsg: '当前显示 {from} - {to} 条记录   共 {total} 条记录'  						   
	});
}

/*
功能：编辑评论
*/
function editComment(id){
	$('#commentDlg').dialog('open').dialog('setTitle','编辑评论');
	$.post('../../../../php/action/page/content/contentinfo.act.php?action=findById',{'id':id},function(data){
		$('#commentFm').form('load',data);
	},'json');
	url='../../../../php/action/page/content/contentinfo.act.php?action=uptComment&id='+id;
}

/*
功能：删除单条评论
*/
function delComment(id){
	$.messager.confirm('提示信息','确定删除吗？',function(r){
		if (r){
			$.get( '../../../../php/action/page/content/contentinfo.act.php?action=delComment&id='+id,function(data){						
				$('#commentGrid').datagrid('reload');                      
			});					 
		}
	}); 
}

/*
功能：批量删除评论
*/
function delArrComment(){
	var rows = $("#commentGrid").datagrid("getChecked");
	if(rows.length==0){
		$.messager.alert('消息提示','请选择要删除的信息','info');	
	}else{
		var list=new Array();
		for(var i=0;i<rows.length;i++){
			list[i]=rows[i].id;
		}
		$.messager.confirm('消息提示','确定删除吗？',function(r){
			if(r){
				$.get('../../../../php/action/page/content/contentinfo.act.php?action=delArrComment&arrId='+list,function(data){
					$('#commentGrid').datagrid('reload');
				});
			}
		});
	}
}

function detailInfo(id){
	$('#newDlg-detail').dialog('open').dialog('setTitle','信息详情');
	$.ajax({
			url: '../../../../php/action/page/content/contentinfo.act.php?action=getInfoById&id='+id,
			success: function(data){
				var res = eval("("+data+")");
				var imgs='';
				if(res.cat_name!=null&&res.cat_name!=''){
					$('#upper_text').html(res.cat_name);					
				}else{
					$('#upper_text').html('全部');
				}
				var str='';
					switch(res.type){
						case '0':
							str='未选择';
							break;
						case '1':
							str='文章模型';
							break;
						case '2':
							str='图片模型';
							break;
						case '3':
							str='视频模型';
							break;
						case '3':
							str='下载模型';
							break;
						default:;
					}
				$('#type1').html(str);
				$('#title1').html(res.title);
				$('#content1').html(res.content);
				$('#brief_title1').html(res.brief_title);
				$('#brief_ctnt1').html(res.brief_ctnt);
				$('#tags1').html(res.tags);
				$('#info_source1').html(res.source);
				if(res.thumbnail!=''&&res.thumbnail!=null)
				$('#thumbnail1').attr('src','../../../../../common/'+res.thumbnail);
			}
		});
}