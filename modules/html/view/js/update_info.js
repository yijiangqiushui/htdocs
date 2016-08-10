
$(function(){
   $.get( '../../../php/action/page/apply_org.act.php?action=findById',function(data){			
		var res=eval("("+data+")");				
        $('#fm').form('load',res);			
   });
  
});

function saveOrg(){

     $('#fm').form('submit',{
		 url:'../../../php/action/page/apply_org.act.php?action=update',
		 onSubmit: function(){
		 },
		 success: function(result){			
			window.location.href='show_info.html';
		 }
     });
}
