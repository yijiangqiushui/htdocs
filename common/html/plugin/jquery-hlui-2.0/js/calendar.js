// JavaScript Document
/**
 * jQuery HLUI 1.1.2
 * Calendar
 * 
 * Copyright(c) 2014-2014 omnimediawindows [ 1499962582@qq.com ] 
 * Author:Li Zhixiao
 * 
 */
 
/**
* special point like this: $._loadmodule('calendar');
* params:objID-input id,show_type-datepicker or spinner
* pay attention to the value of z-index
*/
$.extend({
	calendar_sys_date_time:function(show_type){
		var date=new Date();
		var y=date.getFullYear();
		var m=date.getMonth()+1;
		m=m>9?m:'0'+m;
		var d=date.getDate();
		d=d>9?d:'0'+d;
		
		var h=date.getHours();
		h=h>9?h:'0'+h;
		var i=date.getMinutes();
		i=i>9?i:'0'+i;
		var s=date.getSeconds();
		s=s>9?s:'0'+s;
		switch(show_type){
			case 'datetime':return y+'-'+m+'-'+d+' '+h+':'+i+':'+s;break;
			case 'date':return y+'-'+m+'-'+d;break;
			default: return h+':'+i+':'+s;
		}
		return y+'-'+m+'-'+d;
	},
	calendar:function(objID,show_type){
		var calendar_id=objID+'-calendar';
		var initial_val=$.trim($('#'+objID).val());
		initial_val=initial_val==''?$.calendar_sys_date_time(show_type):initial_val;//initial_val==''?(show_type=='date'?'0000-00-00':(show_type=='datetime'?'0000-00-00 00:00:00':'00:00:00')):initial_val;
		
		var calendar_html='\
		<div id="'+calendar_id+'" class="hlui-calendar">\
			<div class="ui-calendar-body">\
				'+((show_type=='date'||show_type=='datetime')?'<div class="ui-calendar-date">\
				<div class="ui-calendar-yNm">\
					<div class="ui-calendar-preyear"></div>\
					<div class="ui-calendar-premonth"></div>\
					<div class="ui-calendar-yNm-center"></div>\
					<div class="ui-calendar-nextyear"></div>\
					<div class="ui-calendar-nextmonth"></div>\
					<div class="ui-plugin-clearboth"></div>\
				</div><!--ui-calendar-yNm-->\
				<div class="ui-calendar-week">\
					<span>日</span><span>一</span><span>二</span><span>三</span><span>四</span><span>五</span><span>六</span>\
				</div><!--ui-calendar-week-->\
				<div class="ui-calendar-day"></div><!--ui-calendar-day-->\
				</div><!--ui-calendar-date-->\
				':'')+((show_type=='time'||show_type=='datetime')?'<div class="ui-calendar-time"'+(show_type=='time'?' style="border:0;margin-top:0;"':'')+'>\
					<div class="ui-calendar-spinner-hour"><input type="text" name="ui-calendar-spinnerinput" id="ui-calendar-spinnerinput" value="00" /><span class="ui-calendar-spinnerarrow"><span class="ui-calendar-spinnerarrow-up"></span><span class="ui-calendar-spinnerarrow-down"></span></span></div><!--ui-calendar-spinner-->\
					<div class="ui-calendar-spinner-br">:</div>\
					<div class="ui-calendar-spinner"><input type="text" name="ui-calendar-spinnerinput" id="ui-calendar-spinnerinput" value="00" /><span class="ui-calendar-spinnerarrow"><span class="ui-calendar-spinnerarrow-up"></span><span class="ui-calendar-spinnerarrow-down"></span></span></div><!--ui-calendar-spinner-->\
					<div class="ui-calendar-spinner-br">:</div>\
					<div class="ui-calendar-spinner"><input type="text" name="ui-calendar-spinnerinput" id="ui-calendar-spinnerinput" value="00" /><span class="ui-calendar-spinnerarrow"><span class="ui-calendar-spinnerarrow-up"></span><span class="ui-calendar-spinnerarrow-down"></span></span></div><!--ui-calendar-spinner-->\
					<div class="ui-plugin-clearboth"></div>\
				</div><!--ui-calendar-time-->\
				':'')+'<div class="ui-calendar-button"><span class="ui-calendar-nowbtn">现在</span><span class="ui-calendar-confirmbtn">确定</span><span class="ui-calendar-closebtn">关闭</span></div>\
			</div><!--ui-calendar-body-->\
		</div><!--hlui-calendar-->';
		if($('#'+calendar_id).length>0){//once appended,do not append again
			$('.hlui-calendar').css({'z-index':20000});
			$('#'+calendar_id).css({'display':'block','z-index':20001});
		}
		else{
			$('#'+objID).after('<span id="'+objID+'-span" style="position:relative; display:inline-block;"></span>');
			$('#'+objID+'-span').append(calendar_html);
			$('.hlui-calendar').css({'z-index':20000});
			$('#'+calendar_id).css({'left':'-'+($('#'+objID).width()+4)+'px','z-index':20001});
		}
		$('#'+calendar_id+' *').unbind();
		//initialize the style according to the different type
		if(show_type=='datetime'){
			var is_auto_init=false;//check is necessary to auto initialize
			if($.trim(initial_val)!=''){ 
				var datetime_arr=initial_val.split(' ');
				if(!$.is_date_format(datetime_arr[0]) || !$.is_time_format(datetime_arr[1])){
					is_auto_init=true;
				}
			}
			else{
				is_auto_init=true;
			}
			if(is_auto_init){
				initial_val=$.calendar_get_sys_datetime();
			}
			$.calendar_datetimesave(calendar_id,initial_val,show_type);
			$.calendar_days_init(calendar_id,$('#'+calendar_id).attr('year'),$('#'+calendar_id).attr('month'));
			$.calendar_time_init(calendar_id);
			
			//date settings
			$('#'+calendar_id+' .ui-calendar-premonth').bind('click',{'calendar_id':calendar_id},function(e){
				$.calendar_premonth(e.data.calendar_id);
			});
			$('#'+calendar_id+' .ui-calendar-nextmonth').bind('click',{'calendar_id':calendar_id},function(e){
				$.calendar_nextmonth(e.data.calendar_id);
			});
			$('#'+calendar_id+' .ui-calendar-preyear').bind('click',{'calendar_id':calendar_id},function(e){
				$.calendar_preyear(e.data.calendar_id);
			});
			$('#'+calendar_id+' .ui-calendar-nextyear').bind('click',{'calendar_id':calendar_id},function(e){
				$.calendar_nextyear(e.data.calendar_id);
			});
			
			//time settings
			$('#'+calendar_id+' .ui-calendar-spinner-hour .ui-calendar-spinnerarrow-up').bind('click',{'calendar_id':calendar_id},function(e){
				var input_val=parseInt($(this).parent().parent().find('input').val())+1;
				$(this).parent().parent().find('input').val(input_val>23?'00':(input_val>9?input_val:'0'+input_val));
				$('#'+calendar_id).attr('hour',$(this).parent().parent().find('input').val());
			});
			$('#'+calendar_id+' .ui-calendar-spinner-hour .ui-calendar-spinnerarrow-down').bind('click',{'calendar_id':calendar_id},function(e){
				var input_val=parseInt($(this).parent().parent().find('input').val())-1;
				$(this).parent().parent().find('input').val(input_val<0?23:(input_val<10?'0'+input_val:input_val));
				$('#'+calendar_id).attr('hour',$(this).parent().parent().find('input').val());
			});
			$('#'+calendar_id+' .ui-calendar-spinner-hour input').bind('change',{'calendar_id':calendar_id},function(e){
				var input_val=parseInt($(this).val());
				$(this).val(input_val<0?23:(input_val<10?'0'+input_val:(input_val<=23?input_val:'00')));
				$('#'+calendar_id).attr('hour',$(this).parent().parent().find('input').val());
			});
			$('#'+calendar_id+' .ui-calendar-spinner .ui-calendar-spinnerarrow-up').bind('click',{'calendar_id':calendar_id},function(e){
				var input_val=parseInt($(this).parent().parent().find('input').val())+1;
				$(this).parent().parent().find('input').val(input_val>59?'00':(input_val>9?input_val:'0'+input_val));
				$(this).parent().parent().parent().find('input').each(function(i){
					$('#'+calendar_id).attr(i==1?'minute':'second',$(this).val());
				});
			});
			$('#'+calendar_id+' .ui-calendar-spinner .ui-calendar-spinnerarrow-down').bind('click',{'calendar_id':calendar_id},function(e){
				var input_val=parseInt($(this).parent().parent().find('input').val())-1;
				$(this).parent().parent().find('input').val(input_val<0?59:(input_val<10?'0'+input_val:input_val));
				$(this).parent().parent().parent().find('input').each(function(i){
					$('#'+calendar_id).attr(i==1?'minute':'second',$(this).val());
				});
			});
			$('#'+calendar_id+' .ui-calendar-spinner input').bind('change',{'calendar_id':calendar_id},function(e){
				var input_val=parseInt($(this).val());
				$(this).val(input_val<0?59:(input_val<10?'0'+input_val:(input_val<=59?input_val:'00')));
				$(this).parent().parent().parent().find('input').each(function(i){
					$('#'+calendar_id).attr(i==1?'minute':'second',$(this).val());
				});
			});
			
			$('#'+calendar_id+' .ui-calendar-nowbtn').bind('click',function(){
				$('#'+calendar_id.replace('-calendar','')).val($.calendar_get_sys_datetime());
				$('#'+calendar_id).css('display','none');
			});
			$('#'+calendar_id+' .ui-calendar-confirmbtn').bind('click',{'calendar_id':calendar_id},function(){
				$('#'+calendar_id.replace('-calendar','')).val($.calendar_set_datetime(calendar_id));
				$('#'+calendar_id).css('display','none');
			});
		}
		else{
			if(show_type=='time'){
				var is_auto_init=false;
				if($.trim(initial_val)!=''){
					if(!$.is_time_format(initial_val)){
						is_auto_init=true;
					}
				}
				else{
					is_auto_init=true;
				}
				if(is_auto_init){
					initial_val=$.calendar_get_sys_datetime().split('0')[1];
				}
				$.calendar_datetimesave(calendar_id,initial_val,show_type);
				$.calendar_time_init(calendar_id);
				
				//time settings
				$('#'+calendar_id+' .ui-calendar-spinner-hour .ui-calendar-spinnerarrow-up').bind('click',{'calendar_id':calendar_id},function(e){
					var input_val=parseInt($(this).parent().parent().find('input').val())+1;
					$(this).parent().parent().find('input').val(input_val>23?'00':(input_val>9?input_val:'0'+input_val));
					$('#'+calendar_id).attr('hour',$(this).parent().parent().find('input').val());
				});
				$('#'+calendar_id+' .ui-calendar-spinner-hour .ui-calendar-spinnerarrow-down').bind('click',{'calendar_id':calendar_id},function(e){
					var input_val=parseInt($(this).parent().parent().find('input').val())-1;
					$(this).parent().parent().find('input').val(input_val<0?23:(input_val<10?'0'+input_val:input_val));
					$('#'+calendar_id).attr('hour',$(this).parent().parent().find('input').val());
				});
				$('#'+calendar_id+' .ui-calendar-spinner-hour input').bind('change',{'calendar_id':calendar_id},function(e){
					var input_val=parseInt($(this).val());
					$(this).val(input_val<0?23:(input_val<10?'0'+input_val:(input_val<=23?input_val:'00')));
					$('#'+calendar_id).attr('hour',$(this).parent().parent().find('input').val());
				});
				$('#'+calendar_id+' .ui-calendar-spinner .ui-calendar-spinnerarrow-up').bind('click',{'calendar_id':calendar_id},function(e){
					var input_val=parseInt($(this).parent().parent().find('input').val())+1;
					$(this).parent().parent().find('input').val(input_val>59?'00':(input_val>9?input_val:'0'+input_val));
					$(this).parent().parent().parent().find('input').each(function(i){
						$('#'+calendar_id).attr(i==1?'minute':'second',$(this).val());
					});
				});
				$('#'+calendar_id+' .ui-calendar-spinner .ui-calendar-spinnerarrow-down').bind('click',{'calendar_id':calendar_id},function(e){
					var input_val=parseInt($(this).parent().parent().find('input').val())-1;
					$(this).parent().parent().find('input').val(input_val<0?59:(input_val<10?'0'+input_val:input_val));
					$(this).parent().parent().parent().find('input').each(function(i){
						$('#'+calendar_id).attr(i==1?'minute':'second',$(this).val());
					});
				});
				$('#'+calendar_id+' .ui-calendar-spinner input').bind('change',{'calendar_id':calendar_id},function(e){
					var input_val=parseInt($(this).val());
					$(this).val(input_val<0?59:(input_val<10?'0'+input_val:(input_val<=59?input_val:'00')));
					$(this).parent().parent().parent().find('input').each(function(i){
						$('#'+calendar_id).attr(i==1?'minute':'second',$(this).val());
					});
				});
				
				$('#'+calendar_id+' .ui-calendar-nowbtn').bind('click',function(){
					$('#'+calendar_id.replace('-calendar','')).val($.calendar_get_sys_datetime().split(' ')[1]);
					$('#'+calendar_id).css('display','none');
				});
				$('#'+calendar_id+' .ui-calendar-confirmbtn').bind('click',{'calendar_id':calendar_id},function(){
					$('#'+calendar_id.replace('-calendar','')).val($.calendar_set_datetime(calendar_id).split(' ')[1]);
					$('#'+calendar_id).css('display','none');
				});
				}
			else{
				var is_auto_init=false;
				if($.trim(initial_val)!=''){
					if(!$.is_date_format(initial_val)){
						is_auto_init=true;
					}
				}
				else{
					is_auto_init=true;
				}
				if(is_auto_init){
					initial_val=$.calendar_get_sys_datetime().split('0')[0];
				}
				$.calendar_datetimesave(calendar_id,initial_val,show_type);
				$.calendar_days_init(calendar_id,$('#'+calendar_id).attr('year'),$('#'+calendar_id).attr('month'));
				
				//date settings
				$('#'+calendar_id+' .ui-calendar-premonth').bind('click',{'calendar_id':calendar_id},function(e){
					$.calendar_premonth(e.data.calendar_id);
				});
				$('#'+calendar_id+' .ui-calendar-nextmonth').bind('click',{'calendar_id':calendar_id},function(e){
					$.calendar_nextmonth(e.data.calendar_id);
				});
				$('#'+calendar_id+' .ui-calendar-preyear').bind('click',{'calendar_id':calendar_id},function(e){
					$.calendar_preyear(e.data.calendar_id);
				});
				$('#'+calendar_id+' .ui-calendar-nextyear').bind('click',{'calendar_id':calendar_id},function(e){
					$.calendar_nextyear(e.data.calendar_id);
				});
			
				$('#'+calendar_id+' .ui-calendar-nowbtn').bind('click',function(){
					$('#'+calendar_id.replace('-calendar','')).val($.calendar_get_sys_datetime().split(' ')[0]);
					$('#'+calendar_id).css('display','none');
				});
				$('#'+calendar_id+' .ui-calendar-confirmbtn').bind('click',{'calendar_id':calendar_id},function(){
					$('#'+calendar_id.replace('-calendar','')).val($.calendar_set_datetime(calendar_id).split(' ')[0]);
					$('#'+calendar_id).css('display','none');
				});
			}
		}
		$('#'+calendar_id+' .ui-calendar-closebtn').bind('click',function(){
			$('#'+calendar_id).css('display','none');
		});
	},
	calendar_set_datetime:function(calendar_id){
		return $('#'+calendar_id).attr('year')+'-'+$('#'+calendar_id).attr('month')+'-'+$('#'+calendar_id).attr('day')+' '+$('#'+calendar_id).attr('hour')+':'+$('#'+calendar_id).attr('minute')+':'+$('#'+calendar_id).attr('second');
	},
	calendar_get_sys_datetime:function(){
		var cur_date=new Date();
		return cur_date.getFullYear()+'-'+(cur_date.getMonth()<9?'0':'')+(cur_date.getMonth()+1)+'-'+(cur_date.getDate()<10?'0'+cur_date.getDate():cur_date.getDate())+' '+(cur_date.getHours()<10?'0'+cur_date.getHours():cur_date.getHours())+':'+(cur_date.getMinutes()<10?'0'+cur_date.getMinutes():cur_date.getMinutes())+':'+(cur_date.getSeconds()<10?'0'+cur_date.getSeconds():cur_date.getSeconds());
	},
	calendar_nextmonth:function(calendar_id){
		if($('#'+calendar_id).attr('month')==12){
			$('#'+calendar_id).attr('month',1);
			$('#'+calendar_id).attr('year',parseInt($('#'+calendar_id).attr('year'))+1);
		}
		else{
			$('#'+calendar_id).attr('month',parseInt($('#'+calendar_id).attr('month'))+1);
		}
		$.calendar_days_init(calendar_id,$('#'+calendar_id).attr('year'),$('#'+calendar_id).attr('month'));
	},
	calendar_premonth:function(calendar_id){
		if($('#'+calendar_id).attr('month')==1){
			$('#'+calendar_id).attr('month',12);
			$('#'+calendar_id).attr('year',$('#'+calendar_id).attr('year')-1);
		}
		else{
			$('#'+calendar_id).attr('month',$('#'+calendar_id).attr('month')-1);
		}
		$.calendar_days_init(calendar_id,$('#'+calendar_id).attr('year'),$('#'+calendar_id).attr('month'));
	},
	calendar_nextyear:function(calendar_id){
		$('#'+calendar_id).attr('year',parseInt($('#'+calendar_id).attr('year'))+1);
		$.calendar_days_init(calendar_id,$('#'+calendar_id).attr('year'),$('#'+calendar_id).attr('month'));
	},
	calendar_preyear:function(calendar_id){
		$('#'+calendar_id).attr('year',$('#'+calendar_id).attr('year')-1);
		$.calendar_days_init(calendar_id,$('#'+calendar_id).attr('year'),$('#'+calendar_id).attr('month'));
	},
	calendar_time_init:function(calendar_id){
		$('#'+calendar_id+' .ui-calendar-spinner-hour input').val($('#'+calendar_id).attr('hour'));
		$('#'+calendar_id+' .ui-calendar-spinner input').each(function(i){
			$(this).val($('#'+calendar_id).attr(i==0?'minute':'second'));
		});
	},
	calendar_days_init:function(calendar_id,year,month){
		var month_arr=['一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月'];
		$('#'+calendar_id+' .ui-calendar-yNm-center').text(month_arr[month-1]+' '+year);
		var monthdays=$.calendar_monthdays(month-1,year);
		var day_spans='';
		for(var i=1;i<=monthdays;i++){
			day_spans+='<span class="ui-calendar-span-black '+($('#'+calendar_id).attr('day')==i?'ui-calendar-span-selected':'')+'">'+i+'</span>'
		}
		var start_day_cal=new Date(year,month-1,1);
		var start_days=$.calendar_monthdays((month-2)<0?12:(month-2),(month-2)<0?(year-1):year);
		var start_spans='';
		for(var j=start_days;j>start_days-start_day_cal.getDay();j--){
			start_spans='<span class="ui-calendar-span-grey">'+j+'</span>'+start_spans;
		}
		var end_days=7-(monthdays+start_day_cal.getDay()+7)%7;
		var end_spans='';
		for(var k=0;k<end_days;k++){
			end_spans+='<span class="ui-calendar-span-grey">'+(k+1)+'</span>'
		}
		$('#'+calendar_id+' .ui-calendar-day').html(start_spans+day_spans+end_spans);
		$('#'+calendar_id+' .ui-calendar-span-black').bind('click',function(e){
			$('#'+calendar_id).attr('day',parseInt($(this).text())<10?'0'+$(this).text():$(this).text());
			$('#'+calendar_id+' .ui-calendar-span-black').removeClass('ui-calendar-span-selected');
			$(this).addClass('ui-calendar-span-selected');
		});
	},
	calendar_monthdays:function(month,year){
		switch(month){
		case 0:return 31;break;
		case 1:
			return ((0 == year % 4) && (0 != (year % 100))) || (0 == year % 400) ? 29 : 28;
			break;
		case 2:return 31;break;
		case 3:return 30;break;
		case 4:return 31;break;
		case 5:return 30;break;
		case 6:return 31;break;
		case 7:return 31;break;
		case 8:return 30;break;
		case 9:return 31;break;
		case 10:return 30;break;
		default:return 31;
		}
	},
	calendar_datetimesave:function(calendar_id,datetime,showtype){//alert(33);
		if(showtype=='datetime'){
			var dt_arr=datetime.split(' ');
			var date_arr=dt_arr[0].split('-');
			var time_arr=dt_arr[1].split(':');
			$('#'+calendar_id).attr('year',date_arr[0]);
			$('#'+calendar_id).attr('month',date_arr[1]);
			$('#'+calendar_id).attr('day',date_arr[2]);
			$('#'+calendar_id).attr('hour',time_arr[0]);
			$('#'+calendar_id).attr('minute',time_arr[1]);
			$('#'+calendar_id).attr('second',time_arr[2]);
		}
		else if(showtype=='time'){
			var time_arr=datetime.split(':');
			$('#'+calendar_id).attr('hour',time_arr[0]);
			$('#'+calendar_id).attr('minute',time_arr[1]);
			$('#'+calendar_id).attr('second',time_arr[2]);
		}
		else{
			var date_arr=datetime.split('-');
			$('#'+calendar_id).attr('year',date_arr[0]);
			$('#'+calendar_id).attr('month',date_arr[1]);
			$('#'+calendar_id).attr('day',date_arr[2]);
		}
	},
	is_date_format:function(datestr){
		var dateformat=/^(?:(?!0000)[0-9]{4}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-8])|(?:0[13-9]|1[0-2])-(?:29|30)|(?:0[13578]|1[02])-31)|(?:[0-9]{2}(?:0[48]|[2468][048]|[13579][26])|(?:0[48]|[2468][048]|[13579][26])00)-02-29)$/;
		return dateformat.test(datestr);
	},
	is_time_format:function(timestr){
		var timeformat=(/^(([01]?[0-9])|(2[0-3])):[0-5]?[0-9]:[0-5]?[0-9]$/);
		return timeformat.test(timestr);
	}
});