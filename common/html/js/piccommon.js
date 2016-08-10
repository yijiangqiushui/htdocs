function loadpic($data){  
	if($data !=''&&$data!=null){
	var iscomplete = eval("("+$data+")"); 
		var i = 0;
		$('ul li').each(function() {
			if(iscomplete.length > i && iscomplete[i] == 1) {
				$(this).children('.pic').show();
			}
			i++;
		});
	}
}

function save_stage(className){
	var length = $('ul li').length-2; //查找一共多长 也就是多标志位中放几个数值
	var i=0;
	var position;
	$('ul li').each(function() {
		if($(this).hasClass(className)){//判断是谁 要置1 //这是判断第几个 
			position = i;
		}
		i++;
	});
	$.post('/modules/php/action/page/projectapp/projectapp.act.php?action=isComplete&length='+length+'&position='+position+'&table_name='+table_id,function(result) {});
}

function update_stage(className){
	var length = $('ul li').length-2; //查找一共多长 也就是多标志位中放几个数值
	var i=0,position;
	$('ul li').each(function() {
		if($(this).hasClass(className)) {//判断是谁 要置1 //这是判断第几个 
			position = i;
		} 
		i++;
	});
//	alert('position:'+position+'length:'+length);
	$.post('/modules/php/action/page/projectapp/projectapp.act.php?action=update_stage&length='+length+'&position='+position+'&table_name='+table_id,function(result) {});

}

function setStep(classname,complete){
	if(complete) {
		$('.'+classname).children('.pic').show();
	} else {
		$('.'+classname).children('.pic').hide();
	}
//	$('.'+classname).next().click();
	if($('.'+classname).next().css("display")!='none'){
		$('.'+classname).next().click();
	}
	
}
