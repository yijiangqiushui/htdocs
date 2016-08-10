/**
author:Gao Xue
date:2014-07-07
*/
var flag,id;
$(function(){
	flag=$._GET('flag');
	id=$._GET('id');
	//alert('Flag:'+flag+'  '+'ID:'+id);
	$.get('../../../php/action/page/Refer.act.php?action=commitRec&id='+id+'&flag='+flag,function(result){
		if(result==''){
			alert('请先填写信息在提交');
		}else{
			alert('提交成功');
			/*if(flag=='0'){
				window.location.href='fruits.html?flag='+flag;
			}
			if(flag=='1'){
				window.location.href='isNotRefer.html';
			}
			if(flag=='2'){
				window.location.href='isNotCheck.html';
			}*/
		}
	});
});