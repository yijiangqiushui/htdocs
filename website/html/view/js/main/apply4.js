var flag1,aid;
var url;
$(function(){
	flag1=$._GET('flag');
	aid=$._GET('id');
	
	
	if(flag1=='0'){
		$('#f').each(function(){
			$(this).find('textarea').removeAttr('readonly');
			$(this).find('input').removeAttr('readonly');	
		});
		
		$('#rec_con').css('display','none');
		loadDetail();
	}else{	
		$('#f').each(function(){
			$(this).find('textarea').removeAttr('readonly');
			$(this).find('input').removeAttr('readonly');	
		});
		
		
		$('#rec_con').css('display','none');
		updateData();
	}
	/*else if(flag1=='2'){
		$('#f').each(function(){
			$(this).find('textarea[name!=checkAdvice]').attr('readonly','readonly');
			$(this).find('input[type!=button]').attr('readonly','readonly');	
		});
		
		$.get( '../../../../php/action/page/apply4.act.php?action=show&aid='+aid,function(data){
			var res=eval("("+data+")");	
			if(res.isCheck=='0'){
				$('#rec_con').css('display','block');
			}else{
				$('#rec_con').css('display','none');
			}
   		});	
		updateData();
	}*/
	
	/*
	if(flag1=='1'||flag1=='2'){
		$.get('/modules/php/action/page/applycation/apply.act.php?action=findApply&id='+id,function(result){
			var res=eval("("+result+")");
			if(res.isSave=='1'){
				$('#appFm').form('load',res);
				if(flag=='2'){
					if(res.checkAdvice!=null&&res.checkAdvice!=''){
						$('#checkAdviceTr').show();
					}else{
						$('#checkAdviceTr').hide();
					}
				}else{
					$('#checkAdviceTr').hide();
				}
			}
		});
	}else{
		$('#checkAdviceTr').hide();
		loadApplyInfo();
	}*/
	
	$('#grid').datagrid({
		nowrap : true,//设置为true，当数据长度超出列宽时将会自动截取
		striped : true,
		collapsible : false,
		singleSelect:true,
		fitColumns:true,
		//rownumbers : true,
		checkOnSelect:false,
		selectOnCheck:false, 
		remoteSort : false,
		toolbar:'',			   
		url:'../../../../php/action/page/apply4.act.php?action=queryBenefit&aid='+aid,
		columns:[[
					
			//{field:'id',title:'id',checkbox:true},
			{field:'id',title:'id',hidden:true},
			{field:'year',title:'年份',width:100},
			{field:'income',title:'新增销售收入',width:180},
			{field:'profit',title:'新增利润',width:180},
			{field:'tax',title:'新增税收',width:180},
			{field:'foreignCurrency',title:'创收外汇（美元）',width:180},
			{field:'totalSavings',title:'节支总额',width:180},
			{field:'action',title:'操作',width:120,align:'center',
				formatter:function(value,row,index){
					var a='<a href="javascript:void(0)" onclick="showForm('+row.id+')">编辑</a>';
					var b=' | '+'<a href="javascript:void(0)" onclick="deleteBen('+row.id+')"> 删除</a>';
					return a+b;					
				}
			}				
		]]
	});
	var p = $('#grid').datagrid('getPager');  
	$(p).pagination({  
			pageSize: 5,  
			pageList: [5,10,15],  
			beforePageText: '第', 
			afterPageText: '页    共 {pages} 页',  
			displayMsg: '当前显示 {from} - {to} 条记录   共 {total} 条记录'  
				   
	});
	
});

function loadDetail(){
	$.get('../../../../../modules/php/action/page/applycation/apply.act.php?action=findDetailInfo',function(result){
		if(result!='0'){
			editor.sync();
			var res=eval("("+result+")");
			$('#f').form('load',res);
			$('#f').form('load',{'invest':(res.invest==0)?'':res.invest});
			$('#f').form('load',{'recoverDate':(res.recoverDate==0)?'':res.recoverDate});
			editor.html(res.scienceCon);
		}
	});
}



//添加经济效益
function showForm(id){
	if(id==0){
		$('#dlg').dialog('open').dialog('setTitle','添加经济效益');
		$('#fm').form('clear');
		url='../../../../php/action/page/apply4.act.php?action=addBen&aid='+aid;
	}else{
		$.get( '../../../../php/action/page/apply4.act.php?action=findBenById&id='+id,function(data){
			var res=eval("("+data+")");				
			$('#dlg').dialog('open').dialog('setTitle','编辑信息');
			$('#fm').form('load',res);
	        url= '../../../../php/action/page/apply4.act.php?action=updateBen&id='+id+'&aid='+aid;    
   		});	
	}
}


function saveData(){
/*		if($('#background').val()!=''&&$('#background').val().length>800){
			$.messager.alert('消息提示','您填写的立项背景信息超过800字，请保持在800字以内！','info');
		}else if($('#extend').val()!=''&&$('#extend').val().length>800){
			$.messager.alert('消息提示','您填写的应用情况信息超过800字，请保持在800字以内！','info');
		}else if($('#effect').val()!=''&&$('#effect').val().length>800){
			$.messager.alert('消息提示','您填写的推动科学技术进步的作用信息超过800字，请保持在800字以内！','info');
		}else if($('#economicBenefit').val()!=''&&$('#economicBenefit').val().length>800){
			$.messager.alert('消息提示','您填写的经济效益综述信息超过800字，请保持在800字以内！','info');
		}else if($('#socialeffect').val()!=''&&$('#socialeffect').val().length>800){
			$.messager.alert('消息提示','您填写的社会效益信息超过800字，请保持在800字以内！','info');
		}else{*/
			$('#fm').form('submit',{
				url:url,
				onSubmit: function(){
				},
				success: function(result){
					//alert(result);
					$('#dlg').dialog('close');									
					$('#grid').datagrid('reload');				
				}
			});	
//		}
}

function deleteBen(id){
	$.get( '../../../../php/action/page/apply4.act.php?action=deleteBen&id='+id,function(data){	
		$('#grid').datagrid('reload');	
   });
}

//添加和编辑项目详细信息
function updateData(){
	$.get( '../../../../php/action/page/apply4.act.php?action=show&aid='+aid,function(data){	
		///var res=eval("("+data+")");
	    editor.sync();
        $('#f').form('load',data);
		//$('#invest').val((res.invest==0)?'':res.invest);
		//$('#recoverDate').val((res.recoverDate==0)?'':res.recoverDate);
		editor.html(data.scienceCon);
		$('#grid').datagrid('reload');
   },'json');
}

function myCheck(){
	for(var i=0;i<document.f.elements.length-1;i++){
		if(document.f.elements[i].value==""){
			alert("当前表单不能有空项");
			document.f.elements[i].focus();
			return false;
		}
    }
   return true;
}

function subData(){
	editor.sync();
	if(flag1==0){
		url='../../../../php/action/page/apply4.act.php?action=add';	
	}else{
		url='../../../../php/action/page/apply4.act.php?action=update&aid='+aid;
	}
	/*else if(flag1==2){
		url='../../../../php/action/page/apply4.act.php?action=addrecommend&aid='+aid;	
	}*/
	if($('#background').val()!=''&&$('#background').val().length>800){
		$.messager.alert('消息提示','您填写的立项背景信息超过800字，请保持在800字以内！','info');
		return;
	}
	if($('#extend').val()!=''&&$('#extend').val().length>800){
		$.messager.alert('消息提示','您填写的应用情况信息超过800字，请保持在800字以内！','info');
		return;
	}
	if($('#effect').val()!=''&&$('#effect').val().length>800){
		$.messager.alert('消息提示','您填写的推动科学技术进步的作用信息超过800字，请保持在800字以内！','info');
		return;
	}
	if($('#economicBenefit').val()!=''&&$('#economicBenefit').val().length>800){
		$.messager.alert('消息提示','您填写的经济效益综述信息超过800字，请保持在800字以内！','info');
		return;
	}
	if($('#socialeffect').val()!=''&&$('#socialeffect').val().length>800){
		$.messager.alert('消息提示','您填写的社会效益信息超过800字，请保持在800字以内！','info');
		return;
	}
	else{
		$('#f').form('submit',{
				url:url,
				onSubmit: function(){			
				},
				success: function(result){
					//alert(1);
					if(flag1==0){
						$.messager.alert('消息提示','添加成功','info');
					}else if(flag1==1){
						$.messager.alert('消息提示','修改成功','info');	
					}else if(flag1==2){
						$.messager.alert('消息提示','审核意见添加成功','info');
					}
					//$.messager.alert('消息提示','添加成功','info');
					parent.setStep(3,'(√)');
					parent.selectStep(4);//设置选中某个步骤
					window.location.href='apply5.html?flag='+flag1+'&id='+aid;	
	
					//跳到apply5页面
					
				}
		});		
	}
}

//取消
function cancal(){
/*
	 $.messager.confirm('提示信息','确定取消并清空当前经济效益吗？',function(r){
		 if (r){
		  	$.get('../../../../php/action/page/apply4.act.php?action=delBen',function(data){						
				$('#grid').datagrid('reload');
				$('#f').each(function(){
					  $(this).find('textarea').val('');
				});	              
			});				 
		 }
     });
*/
	location.reload();		
		
}


$.extend($.fn.validatebox.defaults.rules, {   
    minLength: {   
        validator: function(value, param){   
            return value.length >= param[0];   
        },   
        message: 'Please enter at least {0} characters.'  
    },
	 isYear:{
		validator:function(value,param){
			var reg=/^\d{4}$/;
			return reg.test(value);
		},
		message:'请输入正确年份'	
	},
	 isVal:{
		validator:function(value,param){
			var reg=/^\d+(.[0-9]+)?$/;
			return reg.test(value);
		},
		message:'请输入正确表单内容'	
	}, 
});



