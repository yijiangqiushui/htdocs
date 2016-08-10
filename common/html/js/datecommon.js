document.write('<link href="/common/php/plugin/jquery-ui-1.11.4/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css"/>');
document.write('<script  src="/common/php/plugin/jquery-ui-1.11.4/jquery-2.1.0.min.js"></script>');
document.write('<script  src="/common/php/plugin/jquery-ui-1.11.4/jquery-ui.js"></script>');


function dateplu(){
		$('.dateplu').datepicker({
			changeMonth:true,
			changeYear:true
		});
	}

function birth_day(){
	$('.year').css({'width':'50%'});
	$('.month').css({'width':'50%'});
	var myDate = new Date();
	var temp = myDate.getFullYear();
	var year = parseInt(temp);
	var temp2 = myDate.getMonth();
	var month = parseInt(temp2)+1;
	for(var j=year ; j>=year-100 ; j--){
			$('.year').append("<option value='"+ j +"'>"+ j + "年" +"</option>");
	}
	for(var i=1 ; i<=12 ; i++){
		if(i == month){
			$('.month').append("<option value='"+ i +"' selected='true'>"+ i +"月"+"</option>");
		}else{
			$('.month').append("<option value='"+ i +"'>"+ i + "月" +"</option>");
		}
	}
}