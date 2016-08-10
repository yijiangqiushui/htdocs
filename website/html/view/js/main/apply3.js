/**
author:Gao Xue
data:2014-06-10
*/
var flag,id;
$(function(){
	flag=$._GET('flag');
	id=$._GET('id');
	
	if(flag=='1'||flag=='2'){
		$.get('../../../../../modules/php/action/page/applycation/apply.act.php?action=findCreate&id='+id,function(result){
			var res=eval("("+result+")");
			if(res.isSave=='1'){
				$('#createForm').form('load',res);
				/*if(flag=='2'){
					if(res.isCheck=='0'){
						$('#checkAdviceTr').show();
					}else{
						$('#checkAdviceTr').hide();
					}
				}else{
					$('#checkAdviceTr').hide();
				}*/
			}
		});
	}else{
		//$('#checkAdviceTr').hide();
		loadCreatInfo();
	}
});

function loadCreatInfo(){
	$.get('../../../../../modules/php/action/page/applycation/apply.act.php?action=findCreatInfo',function(result){
		if(result!='0'){
			var res=eval("("+result+")");
			$('#createForm').form('load',res);
		}
	});
}



function saveCreate(){
	if(flag=='0'){
		if($('#proCreate').val()==''){
			$.messager.alert('消息提示','项目主要创新点不能为空,请认真填写...','info');
		}else if($('#proCreat').val().length>1000){
			$.messager.alert('消息提示','您添加的数据超过了1000字，请保持在1000字以内！','info');
		}else{
			$('#createForm').form('submit',{
				url:'../../../../../modules/php/action/page/applycation/apply.act.php?action=saveCreate',
				success:function(result){
					if(result=='0'){
						$.messager.alert('信息提示','请先填写基本信息','info');
					}else{
						$('#createForm').form('reset');
						parent.setStep(2,'(√)');
						parent.selectStep(3);//设置选中某个步骤
						window.location.href='apply4.html?flag='+flag+'&id='+id;
					}
				}
			});
		}
	}else{
		if($('#proCreat').val().length>1000){
			$.messager.alert('消息提示','您添加的数据超过了一千字，请保持在一千字以内！','info');
		}else{$('#createForm').form('submit',{
				url:'../../../../../modules/php/action/page/applycation/apply.act.php?action=uptCreate&id='+id,
				success:function(){
				parent.setStep(2,'(√)');
				$.messager.alert('信息提示','修改成功','info');
				}
			});
		}
	}
}