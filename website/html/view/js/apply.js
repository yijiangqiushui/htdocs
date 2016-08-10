/**
author:Gao Xue
date:2014-05-23
modify by zhao xiaogang saveApply() 
*/
var flag,id;
$(function(){
	flag=$._GET('flag');
	id=$._GET('id');
	//loadcombotree();
	/**$('#baseYear').combobox({
		editable: false,
		panelWidth:250,
		url:'../../../../../modules/php/action/page/applycation/apply.act.php?action=queryYear',   
		valueField:'id',
		textField:'text',
		value:2014
	});*/
	
	$("#baseScience").combotree({
		url:'../../../../../modules/php/action/page/applycation/applycatTechnical.act.php?action=treeData',
		onBeforeExpand:function(node){
			$(this).tree('options').url='../../../../../modules/php/action/page/applycation/applycatTechnical.act.php?action=treeData&upper_id='+node.id;
		},
		onClick:function(node){
			$('#scienceCat').val(node.upper_cat+node.id+'.');
		},
		onLoadSuccess:function(node,data){
			$("#baseScience").combotree('tree').tree('expandAll');	
		}	
	});


	/*$('#baseScience').combobox({
		editable: false,
		panelWidth:283,
		url:'../../../../../modules/php/action/page/applycation/apply.act.php?action=queryScience',   
		valueField:'id',
		textField:'cat_name',
		onSelect:function(record){
			$('#economicCat').val('.'+record.id+'.');
		}
	});*/
	
	$('#baseEconomic').combobox({
		editable: false,
		panelWidth:283,
		url:'../../../../../modules/php/action/page/applycation/apply.act.php?action=queryEconomic',   
		valueField:'id',
		textField:'text',
		onSelect:function(record){
			$('#economicCat').val('.'+record.id+'.');
		}
	});
	
	$('#rec_org').combobox({   
		url:'../../../../../modules/php/action/page/applycation/apply.act.php?action=queryRecOrg',   
		valueField:'id',   
		textField:'text'
		/*onLoadSuccess:function(){
			$('#rec_org').combobox('setValue', '请选择推荐单位');
		}*/
	});
	if(flag=='1'||flag=='2'){
		$.get('../../../../../modules/php/action/page/applycation/apply.act.php?action=findApply&id='+id,function(result){
			var res=eval("("+result+")");
			if(res.isSave=='1'){
				$('#appFm').form('load',res);
			}
		});
	}else{
		loadApplyInfo();
	}
});

function loadApplyInfo(){
	$.get('../../../../../modules/php/action/page/applycation/apply.act.php?action=findApplyInfo',function(result){
		if(result!='0'){
			var res=eval("("+result+")");
			$('#appFm').form('load',res);
		}
	});
}

/********树形下拉菜单******************
function loadcombotree(){
	$("#scienceTree").combotree({
		url:'../../../../../modules/php/action/page/applycation/applycat.act.php?action=treeData',
		onBeforeExpand:function(node){
			$(this).tree('options').url='../../../../../modules/php/action/page/applycation/applycat.act.php?action=treeData&upper_id='+node.id;
		},
		onClick:function(node){
			$('#scienceCat').val(node.upper_cat+node.id+'.');
		},
		onLoadSuccess:function(node,data){
			$("#scienceTree").combotree('tree').tree('expandAll');
			var node=$("#scienceTree").combotree('tree').tree('find',0);
			$("#scienceTree").combotree('tree').tree('update',{target:node.target,text:'请选择所属科技领域'});
		}	
	});
}*/
/***申请项目****/
function saveApply(){
	    if($("input[name='aname']").val() == ""){
           $.messager.alert('消息提示','请添加项目名称','info');
        }else if($("textarea[name='impPerson']").val() == ""){
           $.messager.alert('消息提示','请添加主要完成人','info');
        }else if($("textarea[name='completeOrg']").val() == ""){
           $.messager.alert('消息提示','请添加单位名称','info');
        }else if($("textarea[name='completeAdress']").val() == ""){
           $.messager.alert('消息提示','请添加通讯地址','info');
        }else if($("input[name='completeCode']").val() == ""){
           $.messager.alert('消息提示','请添加邮编','info');
        }else if($("input[name='completePerson']").val() == ""){
           $.messager.alert('消息提示','请添加联系人','info');
        }else if($("input[name='completeTel']").val() == ""){
           $.messager.alert('消息提示','请添加联系电话','info');
        }else if($("input[name='completePhone']").val() == ""){
           $.messager.alert('消息提示','请添加手机号码','info');
        }else if($("input[name='completeFax']").val() == ""){
           $.messager.alert('消息提示','请添加传真','info');
        }else if($("input[name='completeEmail']").val() == ""){
           $.messager.alert('消息提示','请添加邮箱地址','info');
        }else if($('#rec_org').combobox('getValue')==''){
			$.messager.alert('消息提示','推荐单位不能为空,请选择...','info');
		}else if($('#baseEconomic').combobox('getValue')==''){
			$.messager.alert('消息提示','请选择所属国民经济行业','info');
		}else if($('#baseScience').combobox('getValue')==''){
			$.messager.alert('消息提示','请选择所属科技领域','info');
		}else{
			if($.form_validate('appFm')){
				if(flag=='0'){
					$('#appFm').form('submit',{
						url:'../../../../../modules/php/action/page/applycation/apply.act.php?action=saveApply',
						success:function(result){
							$('#appFm').form('reset');
							$('#rec_org').combobox('setValue', '请选择推荐单位');
							parent.setStep(0,'(√)');
							parent.selectStep(1);//设置选中某个步骤
							window.location.href='apply2.html?flag='+flag+'&id='+id;
						}
					});
				}
				else{
					$('#appFm').form('submit',{
						url:'../../../../../modules/php/action/page/applycation/apply.act.php?action=uptApply&id='+id+'&flag='+flag,
						success:function(result){
							if(result!=''){
								parent.setStep(0,'(√)');
								$.messager.alert('信息提示','修改成功','info');
							}else{
								$.messager.alert('信息提示','修改失败','info');
							}
						}
					});
				}
			}
		}
}

function resetInfo(){
	alert('重置');
}