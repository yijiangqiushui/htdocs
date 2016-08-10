// JavaScript Document
/**
 * jQuery HLUI 1.0.2
 * Table
 * 
 * Copyright(c) 2014-2014 omnimediawindows [ 1499962582@qq.com ] 
 * Author:Li Zhixiao
 * 
 */

$.extend({
	table_data_list:function(page_id,table_id,params){

		$.post($('#'+table_id).attr('data-url')+'?'+params, function(data){
			var htmlstr='';
			var current=parseInt($('#'+page_id).attr('current'));
			var size=parseInt($('#'+page_id).attr('size'));
			for(var i=0;i<data.length;i++){
				var htmlstr_='<tr><td class="ui-table-td ui-table-td-count">'+((current-1)*size+i+1)+'</td><td class="ui-table-td ui-table-td-choose"><input type="checkbox" value="'+data[i].id+'" /></td>';
				var j_count=0;
				for(var j in data[i]){
					if(j_count>0){
						htmlstr_+='<td class="ui-table-td">'+data[i][j]+'</td>';
					}
					j_count++;
				}
				htmlstr_+='<td>&nbsp;</td></tr>';
				htmlstr+=htmlstr_;
			}
			$('#'+table_id+' tbody').html(htmlstr);
			$.table_init();
		 },'json');
	},
	table_init:function(){
		$('.hlui-table table *').unbind();
		$('.hlui-table').each(function(){
			var t_d_opt=$.data_option_format($(this).attr('data-opt'));
			if(t_d_opt.funcbar2titlebar){
				var htmlstr=$(this).find('.ui-table-func-bar').html();
				$(this).find('.ui-table-in-func-bar').html(htmlstr);
				$(this).find('.ui-table-func-bar').remove();
			}
		
			var css_arr=new Array();
			$(this).find('.ui-table-th').each(function(i){
				if($(this).attr('data-opt')){
					var d_opt=$.data_option_format($(this).attr('data-opt'));	
					css_arr[i]={'width':d_opt.width+'px','text-align':d_opt.align};
					$(this).css(css_arr[i]);
				}
			});
			
			$(this).find('tbody tr').each(function(i){
				$(this).find('.ui-table-td').each(function(i){
					$(this).css(css_arr[i]);
				});
				if(!(i%2)){
					$(this).addClass('ui-td-interlacing');
				}
				$(this).bind('click',function(){
					if($(this).attr('class').indexOf('hlui-table-tr-m-click')>-1){
						$(this).removeClass('hlui-table-tr-m-click');
					}
					else{
						$(this).parent().find('tr').removeClass('hlui-table-tr-m-click');
						$(this).addClass('hlui-table-tr-m-click');
					}
				});
				$(this).bind('mouseover',function(){
					$(this).removeClass('ui-td-interlacing');
					$(this).addClass('hlui-table-tr-m-over');
				});
				$(this).bind('mouseout',{'i':i},function(e){
					$(this).removeClass('hlui-table-tr-m-over');
					if(!(e.data.i%2)){
						$(this).addClass('ui-td-interlacing');
					}
				});
			});	   

			$.table_apply($(this).attr('id'));
		});
	},
	table_apply:function(id){
		$('#'+id+' .ui-table-th-choose input:checkbox').bind('click',function(){
			if($(this).val()!=1){
				$('#'+id+' .ui-table-td-choose input:checkbox').prop('checked',true);
				$(this).val(1);
			}
			else{
				$('#'+id+' .ui-table-td-choose input:checkbox').prop('checked',false);
				$(this).val(0);
			}
		});
	},
	table_get_selection:function(id){
		var arr=new Array();
		var arr_i=0;
		$('#'+id+' .ui-table-td-choose input:checkbox').each(function(){
			if($(this).prop('checked')){
				arr[arr_i++]=$(this).val();
			}
		});
		return arr;
	}
});

/*
function TNFsetCheckbox(state){
	var $oCheckbox=$(".TNF_"+eval('document.'+TNFGlobal.formname+'.checkBoxType.options[document.myForm.checkBoxType.selectedIndex].value'));
	var $arrLen=$oCheckbox.length;
	if($arrLen){
		for(var i=0;i<$oCheckbox.length;i++){
			if(!$oCheckbox[i].disabled){
				if(state<0){
					$oCheckbox[i].checked=!$oCheckbox[i].checked;
				}
				else{
					$oCheckbox[i].checked=state;
				}
			}
		}
	}
	else{
		if(state<0){
			$oCheckbox.checked=!$oCheckbox.checked;
		}
		else{
			$oCheckbox.checked=state;
		}
	}
}
*/