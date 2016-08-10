/**
author:Gao Xue 
date:2014-05-07
Modified by Zhao Xiaogang 2014/09/09
Modified by Gao Xue 2015/04/08
*/
var upid=0,uptext='',upcat,edtid;
var upper_cat='.',is_leaf;
var url;
var pridge;
var $adminIDS;

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
		url:'../../../../php/action/page/smslist/smslistcat.act.php?action=treeData',
		onBeforeExpand:function(node){
			$(this).tree('options').url='../../../../php/action/page/smslist/smslistcat.act.php?action=treeData&up_id='+node.id;
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
	$.post('../../../../php/action/page/smslist/smslistinfo.act.php?action=getAttach&id='+id,function(result){
		res = result;
		loadcombotree(res);	
			
		$('#newDlg').dialog('open').dialog('setTitle','编辑信息');
		$('#newFm').form('load',res);
		$('#newFm').form('load',{'cat_id':parseInt(res.catId)});
	},'json');
	url = '../../../../php/action/page/smslist/smslistinfo.act.php?action=updInfo&id='+id;

}
$(function(){
	$.get('../../../../php/action/page/smslist/smslistinfo.act.php?action=getCurrentID',function(data){
		$adminIDS=data;
	});
	$('body').css('display','none');
	$.get('../../../../php/action/page/jdgPge.act.php',function(data){
		pridge=data;
		$('body').css('display','block');
		if(data=='super'){
			loadPage();	
		}else{
			if(data.indexOf('smslistinfo_query')<0){
				$('body').html('<h2>您没有操作权限</h2>');			
			}else{	
				if(data.indexOf('smslistinfo_del')<0){
						$("a[onclick='delArrInfo()']").css('display','none');			
				}
				if(data.indexOf('smslistinfo_add')<0){
						$("a[onclick='newInfo()']").css('display','none');			
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
				   
		url:'../../../../php/action/page/smslist/smslistinfo.act.php?action=infoGrid',//url调用Action方法
		columns:[[
			{field:'id',title:'id',checkbox:true},
			{field:'name',title:'姓名',width:50},
			{field:'tel',title:'手机号',width:100},
			{field:'company',title:'公司',width:100},
			{field:'job',title:'职务',width:100},
			{field:'add_time',title:'添加时间',width:100},
			{field:'action',title:'操作',width:250,align:'center',
				formatter:function(value,row,index){
					var e='<a href="javascript:void(0)" onclick="edtInfo('+row.id+')">编辑</a>';
					var f=' | '+'<a href="javascript:void(0)" onclick="delInfo('+row.id+')">删除</a>';	
					var g=' | '+'<a href="javascript:void(0)" onclick="detailInfo('+row.id+')">查看详情</a>';
					var rn='';
					if(pridge=='super'){
						if(row.admin_id==1){
							rn=e+f+g;
						}else{
							rn="无操作权限";
						}
					}else{
						if(pridge.indexOf('smslistinfo_edit')>=0){
							rn+=e;
						}
						if(pridge.indexOf('smslistinfo_del')>=0){
							rn+=f;
						}
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
		url:'../../../../php/action/page/smslist/smslistinfo.act.php?action=getData',
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
}

function findInfo(){
	
	var name=$('#name2').val();
	var tel=$('#tel2').val();
	var company=$('#company2').val();
	var add_time=$("#add_time2").datebox("getValue");
	$('#infoGrid').datagrid('reload',{'name':name,'tel':tel,'company':company,'add_time':add_time,'upper_cat':upper_cat});
	$('#queDlg').dialog('close');
}

/*
功能：添加信息
*/
function newInfo(){
	$('#newDlg').dialog('open').dialog('setTitle','添加信息');
	$('#newFm').form('clear');
	
	$('#1').css('display','none');
	$('#2').css('display','block');
	
	loadcombotree(upid);	
	//$('#newFm').form('load',{'catId':upid==0?'请选择':parseInt(upid)});
	$('#newFm').form('load',{'catId':'请选择'});//modify by xiaogang 
	$('#newFm').form('load',{'cat_id':parseInt(upid)});
	//$('#newFm').form('load',{'category':(upid==0)?'.':upcat+upid+'.'});
	//$('input[name="upper_text"]').val(uptext);
	
		
	url = '../../../../php/action/page/smslist/smslistinfo.act.php?action=saveInfo';
}

function saveInfo(){
	if($('input[name="cat_id"]').val()==0){
		alert('请选择分组！');
		return;
	}
		$('#newFm').form('submit',{
			url:url,
			success:function(result){
				$('#newDlg').dialog('close');
				$('#infoGrid').datagrid('load',{'upper_cat':upper_cat});
			}
		});
}


/*
树形下拉菜单
*/
function loadcombotree(res){
	$("#catTree").combotree({
		url:'../../../../php/action/page/smslist/smslistinfo.act.php?action=treeData',
		onBeforeExpand:function(node){
			$(this).tree('options').url='../../../../php/action/page/smslist/smslistinfo.act.php?action=treeData&up_id='+node.id;
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
			$.get( '../../../../php/action/page/smslist/smslistinfo.act.php?action=delInfo&id='+id,function(data){						
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
				$.get('../../../../php/action/page/smslist/smslistinfo.act.php?action=delArrInfo',{arrId:list},function(data){
					$('#infoGrid').datagrid('reload',{'upper_cat':upper_cat});
				});
			}
		});
	}
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
				$.get( '../../../../php/action/page/smslist/smslistinfo.act.php?action=disableInfo&idlist='+list+'&flag='+flag,function(data){			
				   $('#infoGrid').datagrid('reload');
				});					 
			}
		});
	}
}

function detailInfo(id){
	$('#newDlg-detail').dialog('open').dialog('setTitle','信息详情');
	$.ajax({
			url: '../../../../php/action/page/smslist/smslistinfo.act.php?action=getAttach&id='+id,
			success: function(data){
				var res = eval("("+data+")");
				$('#upper_text1').html(res.upper_text);
				$('#name1').html(res.name);
				$('#tel1').html(res.tel);
				$('#company1').html(res.company);
				$('#job1').html(res.job);
			}
		});
}

function importList(){
	$('#importList').dialog('open').dialog('setTitle','导入通讯录');
	return;
	/*
	if(upper_cat=='.'){
		alert('请选择要导入通讯录的分组');return;
	}else{
		$('#importList').dialog('open').dialog('setTitle','导入通讯录');
	}
	*/
}

function importCSV(){
	$('#import-form').form('submit',{
		url:'../../../../php/action/page/csv/csv_list.act.php?action=import',//&category='+upper_cat,
		success:function(result){
			if(result=='导入成功！'){
				   $('#infoGrid').datagrid('reload');
				   $('#importList').dialog('close');
			}
			alert(result);
		}
	});
}

function importExcel(){
	//window.location.href='../../../../php/action/page/csv/csv_list.act.php?action=import_excel';
	//return;
	$('#import-form').form('submit',{
	  url:'../../../../php/action/page/csv/csv_list.act.php?action=import_excel',
		//url:'../../../../php/action/page/smslist/import_sms.php?category="."',
		//url:'../../../../php/action/page/csv/csv_list.act.php?action=import_excel&category='+upper_cat,
		success:function(result){
			if(result=='导入成功！'){
				   $('#infoGrid').datagrid('reload');
				   $('#importList').dialog('close');
			}
			alert(result);
		}
	});
}

function exportList(){
	$('#exportList').dialog('open').dialog('setTitle','导出通讯录');
	return;
	/*
	if(upper_cat=='.'){
		alert('请选择要导出通讯录的分组');return;
	}else{
		$('#exportList').dialog('open').dialog('setTitle','导出通讯录');
	}
	*/
}

function exportCSV(){
	$('#export-form').form('submit',{
		url:'../../../../php/action/page/csv/csv_list.act.php?action=export&category='+upper_cat,
		success:function(result){
			if(result=='导出成功'){
				$('#exportList').dialog('close');
			}
			alert(result);
		}
	});
}

function exportExcel(){
	window.location.href='../../../../php/action/page/csv/csv_list.act.php?action=export_excel';
	return;
	$('#export-form').form('submit',{
		url:'../../../../php/action/page/csv/csv_list.act.php?action=export_excel&category='+upper_cat,
		success:function(result){
			if(result=='导出成功'){
				$('#exportList').dialog('close');
			}
			alert(result);
		}
	});
}
function changeURL($url){
	if($flag==0){
		$url='http://'+document.location.host+':8080/MS-Excel/importexcel.htm?admin_id=';
	}else{
		$url='../../../../php/action/page/csv/csv_list.act.php?action=import&admin_id=';
	}
	$('#import-form').attr({'action':$url+$adminIDS});
	return true;
}
function changeUrl($flag){
	if($flag==0){
		$url='http://'+document.location.host+':8080/MS-Excel/exportexcel.htm?admin_id=';
	}else{
		$url='../../../../php/action/page/csv/csv_list.act.php?action=export&admin_id=';
	}
	$('#export-form').attr({'action':$url+$adminIDS+"&category="+upper_cat});
	$('#exportList').dialog('close');
	return true;
}


//允许他人导出
function exportMyList(){getUserList();
	$('#myDlg').dialog('open').dialog('setTitle','允许他人导出通讯录');
}
function exportMine(){
	$('#myFm').form('submit',{
		url:'../../../../php/action/page/smslist/smslistinfo.act.php?action=setOthers&ids='+$('#others').combobox('getValues'),
		success:function(data){
			if(data){
				alert("操作成功");	
			}else{
				alert("操作失败");	
			}
			$('#myDlg').dialog('close');
		}
	});
}
//获取他人信息
function getUserList(){
	$('#others').combobox({
		url:'../../../../php/action/page/admin/admininfo.act.php?action=getOthers',
		valueField:'id',
		textField:'usr',
		multiple:true
	});
}
//导出他人的通讯录
function exportOtherList(){getList();
	$('#otherDlg').dialog('open').dialog('setTitle','导出他人的通讯录');
}
//获取导出人员的列表
function getList(){
	$('#othersList').combobox({
		url:'../../../../php/action/page/admin/admininfo.act.php?action=getOthersList',
		valueField:'id',
		textField:'usr',
		multiple:true
	});
}
function exportOther(){
	$('#otherFm').form('submit',{
		url:'../../../../php/action/page/smslist/smslistinfo.act.php?action=importList&ids='+$('#othersList').combobox('getValues'),
		success:function(data){
			if(data){
				alert("操作成功");	
			}else{
				alert("操作失败");	
			}
			$('#otherDlg').dialog('close');
		}
	});
}