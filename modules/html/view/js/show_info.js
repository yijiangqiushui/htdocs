$(function(){
	$.get( '../../../php/action/page/apply_org.act.php?action=showinfo',function(data){			
		var res=eval("("+data+")");			
        $('#fm').form('load',res);
			                     
   });	
		
});
