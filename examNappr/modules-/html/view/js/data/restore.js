/**
author:Gao Xue
date:2014-09-03
modify:Wang Le
date:2014-09-05
*/
$(function(){
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
	$('body').css('display','none');
	$.get('../../../../php/action/page/jdgPge.act.php',function(data){
	
		$('body').css('display','block');
		
		if(data=='super'){
			loadPage();	
		}else{
			if(data.indexOf('data_restore')<0){
				$('body').html('<h2>您没有操作权限</h2>');		
			}else{		
				loadPage();
			}	
		}
	});
	$(window).resize(function(){
		setTimeout("reSize()",200); 
	});
});
function reSize(){
	$('#restoregrid').datagrid('resize', { 
        width : $(document.body).width()<560?560:$(document.body).width()
    });  
}

function loadPage(){
	$('#restoregrid').datagrid({
		//fit:true,
		nowrap : true,//设置为true，当数据长度超出列宽时将会自动截取
		striped : true,//设置为true将交替显示行背景。
		collapsible : false,//显示可折叠按钮
		singleSelect:true,//为true时只能选择单行
		//fitColumns:true,//允许表格自动缩放，以适应父容器
		fit:true,
		rownumbers : true,//行数
		pagination:true,//分页
		pageSize: 15,  
		pageList: [5,10,15], 
		checkOnSelect:false,
		selectOnCheck:false, 
		
		remoteSort : false,
		toolbar:'#toolbar',
		url:'../../../../php/action/page/data/data.act.php?action=queryBackup',//url调用Action方法
		
		columns:[[
			{field:'id',title:'id',checkbox:true,hidden:true},
			{field:'optname',title:'操作人',align:'center'},
			{field:'optdate',title:'操作时间',align:'center'},
			{field:'dbname',title:'数据库名称',align:'center',fit:100,width:200},
			{field:'action',title:'操作',fit:true,align:'center',
				formatter:function(value,row,index){
					var a='<a href="javascript:void(0)" onclick="restoreData(\''+row.dbname+'\')">恢复</a>';
					return a;	
				}
			}
		]],
		 onLoadSuccess: function () {
							reSize();
                   		 	return true;
                		}
	});
	
	var p = $('#restoregrid').datagrid('getPager');
		$(p).pagination({ 
		pageSize: 5,  
		pageList: [5,10,15],  
		beforePageText: '第', 
		afterPageText: '页    共 {pages} 页',  
		displayMsg: '当前显示 {from} - {to} 条记录   共 {total} 条记录'  
			   
	}); 	
}


function restoreData(dbname){
	$.post('../../../../php/action/page/data/data.act.php?action=restoreData',{dbname:dbname},function(data){
		$.messager.alert('消息提示','恢复成功','info');
		$('#restoregrid').datagrid('reload');
	});
}