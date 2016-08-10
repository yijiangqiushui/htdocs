
/**
Modified by Gao Xue  	2014/06/18
Modified by Gao Xue  	2014/06/19
*/
var url;
var flag,dex;

var flag1,id;
window.onresize=function(){		
	$('#grid').datagrid('resize',{		
		width:$('#body').width()
	});
}

$(function(){
	
	var column='advice_award';
	flag1=$._GET('flag');
	id=$._GET('id');
	
	/*if(flag1=='2'){
		$.get('../../../../php/action/page/att.act.php?action=queryAdvice&id='+id+'&str='+column,function(result){
			if(result!==''&&result!==null){
				$('#checkAdviceDiv').show();
				$('#advice_award').val(result);
			}
			else{
				$('#checkAdviceDiv').hide();
			}
		});
	}else{
		$('#checkAdviceDiv').hide();
	}*/
	
	$('#grid').datagrid({
		title:'项目曾获科技奖励情况',
		//height:'auto',		
		nowrap : true,//设置为true，当数据长度超出列宽时将会自动截取
		striped : true,
		collapsible : false,
		singleSelect:true,
		fitColumns:true,
		rownumbers : true,
		pagination:true,
		checkOnSelect:false,
		selectOnCheck:false, 
		pageSize: 15,  
		pageList: [5,10,15],		
		remoteSort : false,
		toolbar:'#toolbar',
				   
		url:'../../../../php/action/page/apply5.act.php?action=query&id='+id+'&flag='+flag1,
	
		columns:[[
					
			{field:'id',title:'id',checkbox:true},
			//{field:'id',title:'id',hidden:true},
			{field:'name',title:'获奖项目名称',width:150},
			{field:'awardTime',title:'获奖时间',width:100},
			{field:'awardName',title:'奖励名称',width:150},
			{field:'awardGrade',title:'奖励等级',width:100},
			{field:'depart',title:'授奖部门',width:150},
			
			{field:'action',title:'操作',width:100,align:'center',
				formatter:function(value,row,index){
					var a='<a href="javascript:void(0)" onclick="showform('+row.id+','+index+')">编辑</a>';
					var b=' | '+'<a href="javascript:void(0)" onclick="delData('+row.id+','+index+')"> 删除</a>';
					return a+b;	
				}
			}
					
						
		]]
	});
	
	var p = $('#grid').datagrid('getPager');  
	$(p).pagination({  
			pageSize: 15,  
			pageList: [5,10,15],  
			beforePageText: '第', 
			afterPageText: '页    共 {pages} 页',  
			displayMsg: '当前显示 {from} - {to} 条记录   共 {total} 条记录'  
				   
	});
});


function showform(fg,b){
	if(fg==0){
		$('#dlg').dialog('open').dialog('setTitle','添加信息');	
		$('#fm').form('clear');
		url='../../../../php/action/page/apply5.act.php?action=add&id='+id;
		flag=0;
	}else{
		$.get( '../../../../php/action/page/apply5.act.php?action=findbyid&id='+fg,function(data){
			var res=eval("("+data+")");				
			$('#dlg').dialog('open').dialog('setTitle','修改信息');
			$('#fm').form('load',res);
			url='../../../../php/action/page/apply5.act.php?action=update&id='+fg;
			flag=1;
			dex=b;
   		});
		
	}
}


function saveData(){
	if($("input[name='name']").val() == ""){
		$.messager.alert('消息提示','请添加获奖项目名称','info');
	}else{
		$('#fm').form('submit',{
			url:url,
			onSubmit: function(){			
			},
			success: function(result){
				parent.setStep(4,'(√)');
				result=eval('('+result+')');
				$('#dlg').dialog('close');
				if(flag==1){
					$('#grid').datagrid('updateRow',{
						index:dex,
						row:result	
					});	
				}else{					
					$('#grid').datagrid('reload');
				}
				flag=null;
				dex=null;				
			}
		});	
	}
}
function delData(id,index){
	 $.messager.confirm('提示信息','确定删除吗？',function(r){
		 if(r){
			 $.get( '../../../../php/action/page/apply5.act.php?action=delete&id='+id,function(){						
				   $('#grid').datagrid('reload');
					//$('#grid').datagrid('deleteRow',index);                        
			 });					 
		 }
     }); 
}

function deleteList(){
	var rows = $("#grid").datagrid("getChecked");		
	if(rows.length==0){
		$.messager.alert('消息提示','请选择要删除的信息','info');	
	}else{
		var list=new Array();
		for(var i=0;i<rows.length;i++){
			list[i]=rows[i].id;	
		}			
		$.messager.confirm('消息提示','确定删除吗？',function(r){
		   if (r){
				  $.get( '../../../../php/action/page/apply5.act.php?action=deletelist&idlist='+list,function(data){				
					   $('#grid').datagrid('reload');
				  });					 
			}
        });					
	}	
}

function resetCheck(){
	var str='advice_award';
	$.get('../../../../../modules/php/action/page/applycation/apply.act.php?action=resetCheck&id='+id+'&str='+str,function(result){
		if(result!='0'){
			alert('修改成功');
		}
	});
}