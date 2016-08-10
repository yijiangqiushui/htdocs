/**
author:Gao Xue
data:2014-06-10
*/

var flag,id;
$(function(){
	flag=$._GET('flag');
	id=$._GET('id');
	if(flag=='1'||flag=='2'){
		$.get('../../../../../modules/php/action/page/applycation/apply.act.php?action=findBrief&id='+id,function(result){
			var res=eval("("+result+")");
			if(res.isSave=='1'){
				$('#briefForm').form('load',res);
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
		loadBriefInfo();
		//$('#checkAdviceTr').hide();
	}
});

function loadBriefInfo(){
	$.get('../../../../../modules/php/action/page/applycation/apply.act.php?action=findBriefInfo',function(result){
		if(result!='0'){
			var res=eval("("+result+")");
			$('#briefForm').form('load',res);
		}
	});
}


function saveBrief(){
	if(flag=='0'){
		if($('#proBrief').val()==''){
			$.messager.alert('消息提示','项目基本内容简介不能为空,请认真填写...','info');
		}else if($('#proBrief').val().length>800){
			$.messager.alert('消息提示','您填写的内容超过了800字，请保持在800字内！','info');
		}else{
			$('#briefForm').form('submit',{
				url:'../../../../../modules/php/action/page/applycation/apply.act.php?action=saveBrief',
				success:function(result){
					if(result=='0'){
						$.messager.alert('信息提示','请先填写基本信息','info');
					}else{
						$('#briefForm').form('reset');
						parent.setStep(1,'(√)');
						parent.selectStep(2);//设置选中某个步骤
						window.location.href='apply3.html?flag='+flag+'&id='+id;
					}
				}
			});
		}
	}else{
		if($('#proBrief').val().length>800){
			$.messager.alert('消息提示','您填写的内容超过了八百字，请保持在八百字内！','info');
		}else{$('#briefForm').form('submit',{
				url:'../../../../../modules/php/action/page/applycation/apply.act.php?action=uptBrief&id='+id+'&flag='+flag,
				success:function(result){
				$.messager.alert('信息提示','修改成功','info');
				parent.setStep(1,'(√)');
				}
			});
		}
	}	
}