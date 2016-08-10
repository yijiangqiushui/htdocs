//heyangyang
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
	var column='advice_peo';
	flag1=$._GET('flag');
	id=$._GET('id');
	/*if(flag1=='2'){
		$('#checkAdviceDiv').show();
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
		url='../../../../php/action/page/apply7.act.php?action=query&id='+id;
	}else{
		url='';
	}*/
	
	$('#grid').datagrid({
		title:'主要完成人情况',
		nowrap : true,//设置为true，当数据长度超出列宽时将会自动截取
		striped : true,
		collapsible : false,
		singleSelect:true,
		fitColumns:true,
		rownumbers : true,
		pagination:true,
		pageSize: 15,  
		pageList: [5,10,15],
	
		checkOnSelect:false,
		selectOnCheck:false, 
				
		remoteSort : false,
		toolbar:'#toolbar',
				   
		url:'../../../../php/action/page/apply7.act.php?action=query&id='+id+'&flag='+flag1,
	
		columns:[[				
			{field:'id',title:'id',checkbox:true},
			{field:'name',title:'姓名',width:150},
			{field:'sex',title:'性别',width:100},
			{field:'nation',title:'民族',width:150},
			//{field:'birthplace',title:'出生地',width:100},
			//{field:'birthdate',title:'出生日期',width:150},
			//{field:'idNumber',title:'身份证号',width:150},
			//{field:'sort',title:'排序',width:150},
			{field:'eduLeval',title:'文化程度',width:150},
			//{field:'graduateTime',title:'毕业时间',width:150},
			//{field:'isHomecoming',title:'是否归国人员',width:150},
			//{field:'company',title:'工作单位',width:150},
			{field:'phone',title:'联系电话',width:150},
			{field:'email',title:'电子邮箱',width:150},
			{field:'tel',title:'手机',width:150},
			//{field:'address',title:'通讯地址',width:150},
			//{field:'graduateSchool',title:'毕业学校',width:150},
			//{field:'major',title:'专业',width:150},
			//{field:'degree',title:'学位',width:150},
			//{field:'profession',title:'现从事专业',width:150},
			//{field:'techTitle',title:'技术职称',width:150},
			
			//{field:'adminPost',title:'行政职务',width:150},
			//{field:'familiarSubject',title:'熟悉学科',width:150},
			//{field:'techAward',title:'曾获科技奖励情况',width:150},
			//{field:'startTime',title:'起始时间',width:150},
			//{field:'endTime',title:'完成时间',width:150},
			//{field:'contribute',title:'主要贡献',width:150},
			
			
			{field:'action',title:'操作',width:200,align:'center',
				formatter:function(value,row,index){
					//var c='<a href="javascript:void(0)" onclick="showDet('+row.id+')"> 查看</a>';
					var a='<a href="javascript:void(0)" onclick="showForm('+row.id+','+index+')"> 编辑</a>';
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

function showForm(fg,d){
	if(fg==0){
		$('#dlg').dialog('open').dialog('setTitle','添加信息');	
		$('#fm').form('clear');
		url='../../../../php/action/page/apply7.act.php?action=add&id='+id;
		flag=0;
	}else{
		$.get( '../../../../php/action/page/apply7.act.php?action=findbyid&id='+fg,function(data){
			
			var res=eval("("+data+")");			
			$('#dlg').dialog('open').dialog('setTitle','修改信息');
			$('#fm').form('load',res);
			url='../../../../php/action/page/apply7.act.php?action=update&id='+fg;
			flag=1;
			index=d;
   		});	
	}
}

function showDet(a){
	$.get( '../../../../php/action/page/apply7.act.php?action=findbyid&id='+a,function(data){	
			var res=eval("("+data+")");				
			$('#dlg_det').dialog('open').dialog('setTitle','完成人详细信息');
			$('#fm_det').form('load',res);
		
   		});		
}

function saveData(){
	if($("input[name='name']").val()==''){
		$.messager.alert('消息提示','请填写主要完成人姓名！','info');
	}else if($("input[name='birthplace']").val()==''){
		$.messager.alert('消息提示','请填写出生地信息！','info');
	}else if($("input[name='birthdate']").val()==''){
		$.messager.alert('消息提示','请填写出生地日期！','info');
	}else if($("input[name='idNumber']").val()==''){
		$.messager.alert('消息提示','请填写身份证号！','info');
	}else if($("input[name='eduLeval']").val()==''){
		$.messager.alert('消息提示','请填写文化程度！','info');
	}else if($("input[name='graduateTime']").val()==''){
		$.messager.alert('消息提示','请填写毕业时间！','info');
	}else if($("input[name='company']").val()==''){
		$.messager.alert('消息提示','请填写工作单位！','info');
	}else if($("input[name='email']").val()==''){
		$.messager.alert('消息提示','请填写电子邮箱！','info');
	}else if($("input[name='address']").val()==''){
		$.messager.alert('消息提示','请填写通讯地址！','info');
	}else if($("input[name='graduateSchool']").val()==''){
		$.messager.alert('消息提示','请填写毕业学校！','info');
	}else if($("input[name='major']").val()==''){
		$.messager.alert('消息提示','请填写专业！','info');
	}else if($("input[name='familiarSubject']").val()==''){
		$.messager.alert('消息提示','请填写熟悉学科！','info');
	}else if($("input[name='startTime']").val()==''){
		$.messager.alert('消息提示','请填写参加本项目的起始时间！','info');
	}else if($("input[name='endTime']").val()==''){
		$.messager.alert('消息提示','请填写完成时间！','info');
	}else if($("textarea[name='contribute']").val()==''){
		$.messager.alert('消息提示','请填写对本项目主要实质性贡献！','info');
	}else if($('#contribute').val().length>100){
		$.messager.alert('消息提示','您添加的数据超过了100字，请保持在100字以内！','info');
	}else{
		if($.form_validate('fm')){
				//do something
			$('#fm').form('submit',{
				url:url,
				onSubmit: function(){	
				},
				success: function(result){
					parent.setStep(6,'(√)');
					result=eval('('+result+')');
					$('#dlg').dialog('close');			
					if(flag==0){							
						$('#grid').datagrid('insertRow',{
							index:0,
							row:result	
						});
					}else if(flag==1){			
						$('#grid').datagrid('updateRow',{
							index:index,
							row:result	
						});				
					}else{
						$('#grid').datagrid('reload');	
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
			 $.get( '../../../../php/action/page/apply7.act.php?action=delete&id='+id,function(){						
					$('#grid').datagrid('deleteRow',i);                        
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
                      $.get( '../../../../php/action/page/apply7.act.php?action=deletelist&idlist='+list,function(data){		
                           $('#grid').datagrid('reload');
                      });					 
                }
        });				
	}	
}

function resetCheck(){
	var str='advice_peo';
	$.get('../../../../../modules/php/action/page/applycation/apply.act.php?action=resetCheck&id='+id+'&str='+str,function(result){
		if(result!='0'){
			alert('修改成功');
		}
	});
}