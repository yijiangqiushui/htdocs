/**
author:Gao Xue
date:2014-06-16
*/

$(function(){
	$('#datagrid').datagrid({
		//height:250,
		title:'未提交申报推荐书',
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
		url:'../../../php/action/page/isNotRefer.act.php?action=queryNotRefer',//url调用Action方法
		onLoadSuccess:function(){
			//alert('yes'+Math.random());
		},
		columns:[[
					
			{field:'id',title:'id',checkbox:true},
			{field:'aname',title:'项目名称',fit:true},
			//{field:'impPerson',title:'主要完成人',fit:true},
			{field:'completeOrg',title:'第一完成单位',fit:true},
			//{field:'completePhone',title:'联系电话',fit:true},
			//{field:'recOrg',title:'推荐单位',fit:true},
			//{field:'recPhone',title:'推荐单位电话',fit:true},
			//{field:'planID',title:'具体计划、基金的名称和编号',fit:true},
			//{field:'proStart',title:'项目起始时间',fit:true},
			//{field:'proEnd',title:'完成时间',fit:true},
			
			{field:'action',title:'操作',width:200,align:'center',
				formatter:function(value,row,index){							
					var a='<a href="javascript:void(0)" onclick="uptApply('+row.id+')">修改</a>';						
					/*var rn='';
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
							
					return rn;*/
					return a;
				}
			}															
		]]						  
	});
				
	var p = $('#datagrid').datagrid('getPager');			  
	$(p).pagination({  
			pageSize: 15,  
			pageList: [5,10,15],  
			beforePageText: '第', 
			afterPageText: '页    共 {pages} 页',  
			displayMsg: '当前显示 {from} - {to} 条记录   共 {total} 条记录'  						   
	});  
});

function uptApply(id){
	var flag=1;
	window.location.href='fruits.html?flag='+flag+'&id='+id;
}