//heyangyang
/**
Modified by Gao Xue  	2014/07/04
*/
var flag,id;
$(function(){
	flag=$._GET('flag');
	id=$._GET('id');
	if(flag=='1'||flag=='2'){
		if(flag=='2'){
			$('#unitWrite').attr('style','display:none');
			$('#showForm').attr('style','display:block');
			$.get( '../../../../php/action/page/apply9.act.php?action=query&id='+id,function(data){
				//alert(data);
				var res=eval("("+data+")");	
				$('#tuijiandanweiyijian').html(res.content);			
				//$('#fm').form('load',res);
			});
		}else{
			$('#unitWrite').attr('style','display:block');
			$('#showForm').attr('style','display:none');
		}
		
		//url='../../../../php/action/page/apply7.act.php?action=query&id='+id;
	}else{
		$('#unitWrite').attr('style','display:block');
		$('#showForm').attr('style','display:none');
		//url='';
	}
	
});