//author:heyangyang

var url;
var indexid;

window.onresize=function(){		
	$('#grid').datagrid('resize',{		
		width:$('#body').width()
	});
}
//------------------------------------申报单位信息--------------------------------
//权限设置
$(function(){
	$('body').css('display','none');
	$.get('../../../php/action/page/jdgPge.act.php',function(data){
		pridge=data;
		$('body').css('display','block');
		
		if(data=='super'){
			loadPage();	
		}else{
			if(data.indexOf('Orgunit_query')<0){
				$('body').html('<h2>您没有操作权限</h2>');
				
			}else{
				if(data.indexOf('Orgunit_del')<0){
						$("a[onclick='delOrgList()']").css('display','none');			
				}				
				loadPage();	
			}	
		}
	});
});

function loadPage(){
	$('#grid').datagrid({
		title:'申报机构信息',
		
		nowrap : true,//设置为true，当数据长度超出列宽时将会自动截取
		striped : true,//设置为true将交替显示行背景。
		collapsible : false,//显示可折叠按钮
		singleSelect:true,//为true时只能选择单行
		fitColumns:true,//允许表格自动缩放，以适应父容器
		rownumbers : true,//行数
		pagination:true,//分页
		pageSize: 20,  
		pageList: [10,15,20], 
		checkOnSelect:false,
		selectOnCheck:false, 
					
		remoteSort : false,
		toolbar:'#toolbar',
				   
		url:'../../../php/action/page/apply_org.act.php?action=show',
		//loadMsg : '数据装载中......',
		sortName : 'id',//当数据表格初始化时以哪一列来排序
		sortOrder : 'desc',//定义排序顺序，可以是'asc'或者'desc'（正序或者倒序）。
		columns:[[
					
			{field:'id',title:'id',checkbox:true},
			{field:'orgCode',title:'组织机构代码',width:150},
			{field:'orgName',title:'申报单位名称',width:150},
			{field:'legalPerson',title:'企业法人',width:100},
			{field:'contact',title:'联系人',width:100},
			{field:'phone',title:'联系电话',width:150},
			{field:'telphone',title:'联系人手机',width:150},
			{field:'email',title:'电子邮箱',width:150},
			{field:'address',title:'通讯地址',width:150},
			{field:'is_checked',title:'审核状态',width:150,
				formatter:function(value,row,index){
					var flag = '';
					switch(value){
						case '0':
							flag = '未审核';
							break;
						case '1':
							flag = '审核通过';
							break;
						case '2':
							flag = '审核未通过';
							break;
						default:;
					}
					return flag;
				}
			},
			
			{field:'action',title:'操作',width:150,align:'center',
				formatter:function(value,row,index){
					var a='<a href="javascript:void(0)" onclick="showeditform('+row.id+','+index+')">编辑</a>';
					var b=' |'+'<a href="javascript:void(0)" onclick="delOrg('+row.id+','+index+')"> 删除</a>';	
					var c=' |'+'<a href="javascript:void(0)" onclick="do_checked('+row.id+','+index+')"> 审核</a>';	
					var rn='';
					if(pridge=='super'){
						rn=a+b;
					}else{
						if(pridge.indexOf('Orgunit_edit')>=0){
							rn+=a;
						}
						if(pridge.indexOf('Orgunit_del')>=0){
							rn+=b;
						}					
					}	
					rn+=c;			
					return rn;	
				}
			}				
		]]		
	});
				
	var p = $('#grid').datagrid('getPager');  
	$(p).pagination({  
			pageSize: 20,  
			pageList: [10,15,20],  
			beforePageText: '第', 
			afterPageText: '页    共 {pages} 页',  
			displayMsg: '当前显示 {from} - {to} 条记录   共 {total} 条记录'  
				   
	});  
}
//审核
function do_checked(id,index){
	$.messager.confirm('是否通过审核','通过审核？',function(r){
		if(r){
			$.post('../../../php/action/page/apply_org.act.php?action=change_checked',{flag:1,id:id},function(data){
				 $('#grid').datagrid('reload');                        
			});
		}else{
			$.post('../../../php/action/page/apply_org.act.php?action=change_checked',{flag:2,id:id},function(data){
				 $('#grid').datagrid('reload');                        
			});
		}
	});
}

//查询
function showCondition(){
	$('#show').dialog('open').dialog('setTitle','查询条件');
	$('#show-form').form('clear');	
}

function findOrg(){
	if(($('#search_code').val()=='')&&($('#search_name').val()=='')){
		$('#show').dialog('close');
	}else{	
		$('#show').dialog('close'); 				
		$('#grid').datagrid('load',{
			'orgCode':$('#search_code').val(),
			'orgName':$('#search_name').val()	
		});

	}	
}

//展示机构信息
function showAll(){				
	$('#grid').datagrid('load',{
		'orgCode':'',
		'orgName':''	
	});
}

//删除
function delOrg(id,index){
     $.messager.confirm('提示信息','确定删除吗？',function(r){
		 if(r){
			  $.get( '../../../php/action/page/apply_org.act.php?action=delete&id='+id,function(data){
				 //$('#grid').datagrid('reload');
				 $('#grid').datagrid('deleteRow',index);                        
			  });					 
		 }
     });       
}

//批量删除
function delOrgList(){
			
	var rows = $("#grid").datagrid("getChecked");
			
	if(rows.length==0){
		$.messager.alert('消息提示','请选择要删除的数据信息','info');	
	}else{
		var list=new Array();
		for(var i=0;i<rows.length;i++){
			list[i]=rows[i].id;	
		}
				
		$.messager.confirm('消息提示','确定删除吗？',function(r){
            if (r){
                 $.get( '../../../php/action/page/apply_org.act.php?action=deletelist&idlist='+list,function(data){					
                       $('#grid').datagrid('reload');
                 });					 
            }
        });
					
	}
}

//修改
function showeditform(a,b){
	$.get( '../../../php/action/page/apply_org.act.php?action=findById&id='+a,function(data){
			
		var res=eval("("+data+")");				
        $('#dlg').dialog('open').dialog('setTitle','修改信息');
        $('#fm').form('load',res);
				
        url = '../../../php/action/page/apply_org.act.php?action=update&id='+a;
		indexid=b;
						                     
   });
}
		
function saveOrg(){

     $('#fm').form('submit',{
		 url:url,
		 onSubmit: function(){
		 },
		 success: function(result){
			
			result="{index:"+indexid+",row:"+result+"}";
			var res=eval("("+result+")");
			 
			$('#dlg').dialog('close');	        
			//$('#grid').datagrid('reload');
			$('#grid').datagrid('updateRow',res);
			url=null;
			indexid=null;
		 }
     });
}
 