
/**
Modified by Gao Xue  	2014/06/18
Modified by Gao Xue  	2014/06/19
Modified by Wang Le  	2014/09/28
*/

var url;
var flag;
var index;
var flag1,id;
window.onresize=function(){		
	$('#grid').datagrid('resize',{		
		width:$('#body').width()
	});
}

$(function(){
	var column='advice_unit';
	flag1=$._GET('flag');
	id=$._GET('id');
		/*if(flag1=='2'){
		$.get('../../../../php/action/page/att.act.php?action=queryAdvice&id='+id+'&str='+column,function(result){
			if(result!==''&&result!==null){
				$('#checkAdviceDiv').show();
				$('#checkAdvice').val(result);
			}
			else{
				$('#checkAdviceDiv').hide();
			}
		});
	}else{
		$('#checkAdviceDiv').hide();
	}*/
	
	/*if(flag=='1'||flag=='2'){
		url='../../../../php/action/page/apply6.act.php?action=query&id='+id;
	}else{
		url='';
	}*/
	$('#grid').datagrid({
		title:'主要完成单位情况',
		//width:2500,
		nowrap : true,//设置为true，当数据长度超出列宽时将会自动截取
		striped : true,
		collapsible : false,
		singleSelect:true,
		fitColumns:true,
		rownumbers : true,
		height:'auto',
		pagination:true,
		pageSize: 15,  
		pageList: [5,10,15],
		
		checkOnSelect:false,
		selectOnCheck:false, 
				
		remoteSort : false,
		toolbar:'#toolbar',
		url:'../../../../php/action/page/apply6.act.php?action=query&id='+id+'&flag='+flag1,
	
		columns:[[				
			{field:'id',title:'id',checkbox:true},
			{field:'name',title:'单位名称',width:150},
			//{field:'contribute',title:'主要贡献',width:100},
			{field:'address',title:'通讯地址',width:150},
			//{field:'postcode',title:'邮政编码',width:100},
			//{field:'sort',title:'排序',width:150},
			{field:'nature',title:'单位性质',width:150},
			{field:'type',title:'单位类型',width:150},
			{field:'isSeparateLegal',title:'是否独立法人单位',width:150},
			{field:'registeNum',title:'企业注册号',width:150},
			{field:'organizationCode',title:'组织机构代码',width:150},
			//{field:'zone',title:'单位所在地区',width:150},
			//{field:'web',title:'单位网址',width:150},
			{field:'contact',title:'单位联系人',width:150},
			//{field:'phone',title:'联系人电话',width:150},
			//{field:'fax',title:'单位传真',width:150},
			//{field:'tel',title:'联系人手机',width:150},
			//{field:'email',title:'联系人电子邮箱',width:150},
			//{field:'proContact',title:'项目联系人',width:150},
			//{field:'proTel',title:'项目联系人手机',width:150},
			//{field:'proEmail',title:'项目联系人电子邮箱',width:150},
			
			{field:'action',title:'操作',width:200,align:'center',
				formatter:function(value,row,index){
					var a='<a href="javascript:void(0)" onclick="showForm('+row.id+','+index+')"> 编辑</a>';
					var b=' | '+'<a href="javascript:void(0)" onclick="delData('+row.id+','+index+')"> 删除</a>';
					//var c=' | '+'<a href="javascript:void(0)" onclick="showDetail('+row.id+')"> 查看</a>';
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

function showDetail(a){
	$.get( '../../../../php/action/page/apply6.act.php?action=findbyid&id='+a,function(data){			
			var res=eval("("+data+")");			
			$('#dlg_det').dialog('open').dialog('setTitle','完成单位详细信息');				
			$('#fm_det').form('load',res);
			
   	});	
}


function showForm(fg,d){
		if(fg==0){
			$('#dlg').dialog('open').dialog('setTitle','添加信息');
			$('#fm').each(function(){
				//$(this).find('input').removeAttr('readonly');
				//$(this).find('textarea').removeAttr('readonly');	
			});
			$('#fm').form('clear');
			url='../../../../php/action/page/apply6.act.php?action=add&id='+id;
			flag=0;
		}else{
			$.get( '../../../../php/action/page/apply6.act.php?action=findbyid&id='+fg,function(data){
				
				var res=eval("("+data+")");			
				$('#dlg').dialog('open').dialog('setTitle','修改信息');				
				$('#fm').form('load',res);
				url='../../../../php/action/page/apply6.act.php?action=update&id='+fg;		
			
				flag=1;
				index=d;
			});	
		}
}

function saveData(){
		if($("input[name='name']").val()==''){
			$.messager.alert('消息提示','请填写单位名称！','info');
		}else if($("input[name='address']").val()==''){
			$.messager.alert('消息提示','请填写通讯地址！','info');
		}else if($("input[name='nature']").val()==''){
			$.messager.alert('消息提示','请填写单位性质！','info');
		}else if($("input[name='type']").val()==''){
			$.messager.alert('消息提示','请填写单位类型！','info');
		}else if($("input[name='isSeparateLegal']").val()==''){
			$.messager.alert('消息提示','请填写是否是独立法人单位！','info');
		}else if($("input[name='contact']").val()==''){
			$.messager.alert('消息提示','请填写单位联系人！','info');
		}else if($("input[name='email']").val()==''){
			$.messager.alert('消息提示','请填写单位联系人电子邮箱！','info');
		}else if($("input[name='proContact']").val()==''){
			$.messager.alert('消息提示','请填写项目联系人！','info');
		}else if($("input[name='proEmail']").val()==''){
			$.messager.alert('消息提示','请填写项目联系人电子邮箱！','info');
		}else if($('#contribute').val()!=''&&$('#contribute').val().length>100){
			$.messager.alert('消息提示','您添加的数据超过了100字，请保持在100字以内！','info');
		}else{
			if($.form_validate('fm')){
				//do something
				$('#fm').form('submit',{
					url:url,
					onSubmit: function(r){					
					},
					success: function(result){
						//alert(result);
						if(result=='0'){
							$.messager.alert('信息提示','请先填写基本信息','info');
						}else{
							parent.setStep(5,'(√)');
							result=eval('('+result+')');
							$('#dlg').dialog('close');			
							if(flag==1){
								//result=eval('('+result+')');			
								$('#grid').datagrid('updateRow',{
									index:index,
									row:result	
								});				
							}else{
								$('#grid').datagrid('reload');	
							}
						}
						index=null;
						flag=null;
						url=null;
					}
				});	
			}
		}
}

function delData(id,i){
	 $.messager.confirm('提示信息','确定删除吗？',function(r){
		 if(r){
			 $.get( '../../../../php/action/page/apply6.act.php?action=delete&id='+id,function(){						
					$('#grid').datagrid('reload');                       
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
                      $.get( '../../../../php/action/page/apply6.act.php?action=deletelist&idlist='+list,function(data){
						 // alert(data);				
                           $('#grid').datagrid('reload');
                      });					 
                }
        });				
	}	
}

function resetCheck(){
	var str='advice_unit';
	$.get('../../../../../modules/php/action/page/applycation/apply.act.php?action=resetCheck&id='+id+'&str='+str,function(result){
		if(result!='0'){
			alert('修改成功');
		}
	});
}