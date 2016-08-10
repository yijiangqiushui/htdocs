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
	table:function(config){
		var htmlstr='<div id="'+config.id+'" class="hlui-table"><div class="ui-table-func-bar-outer" '+(config.menubutton_config.renderTo=='outer'?'':' style="display:none;"')+'></div><div class="ui-table-title-bar">'+config.title+'</div><div class="ui-table-func-bar-inner" '+(config.menubutton_config.renderTo=='inner'?'':' style="display:none;"')+'></div><table border="0" cellpadding="0" cellspacing="0" class="ui-table-table" ><thead><tr><th class="ui-table-th ui-table-th-count">编号</th><th class="ui-table-th ui-table-th-choose"><input type="checkbox" value="0" /></th>';
		for(var i=0;i<config.items.length;i++){
			htmlstr+='<th class="ui-table-th" style="width:'+config.items[i].width+'px;text-align:'+config.items[i].align+'">'+config.items[i].name+'</th>';
		}
        htmlstr+='<th class="ui-table-th ui-table-th-oper">操作</th><th>&nbsp;</th></tr></thead><tbody></tbody></table><div class="ui-table-pagination" style="text-align:'+config.pagination_align+';"></div></div><!--hlui-table-->';
		$(config.renderTo==''?'body':config.renderTo).append(htmlstr);
		
		config.menubutton_config.renderTo='.ui-table-func-bar-'+config.menubutton_config.renderTo;
		$.menubutton(config.menubutton_config);
	},
	table_loadData:function(config){
		var page_id=$('#'+config.id+' .hlui-pagination').attr('id');
		$.post(config.data_url, function(data){
			var htmlstr='';
			var current=$.pagination_params(page_id).page;
			var size=$.pagination_params(page_id).size;
			for(var i=0;i<data.length;i++){
				var htmlstr_='<tr><td class="ui-table-td ui-table-td-count">'+((current-1)*size+i+1)+'</td><td class="ui-table-td ui-table-td-choose"><input type="checkbox" value="'+data[i].id+'" /></td>';
				var j_count=0;
				for(var j in data[i]){
					if(j_count>0){
						htmlstr_+='<td class="ui-table-td">'+data[i][j]+'</td>';
					}
					j_count++;
				}
				htmlstr_+='<td class="ui-table-td">';
				for(var k=0;k<config.opers.length;k++){
					htmlstr_+=(k==0?'':' | ')+'<a href="'+(typeof(config.opers[k].func_name)=='undefined'?(config.opers[k].href+'?id='+data[i].id):('javascript:'+config.opers[k].func_name+'('+data[i].id+');'))+'" '+(typeof(config.opers[k].target)=='undefined'?'':'target="'+config.opers[k].target+'"')+'>'+config.opers[k].name+'</a>';
				}
				htmlstr_+='</td><td>&nbsp;</td></tr>';
				htmlstr+=htmlstr_;
			}
			$('#'+config.id+' tbody').html(htmlstr);
			$.table_apply(config);
		},'json');//
	},
	table_apply:function(config){
		$('#'+config.id+' table *').unbind();
		var css_arr=new Array();
		for(var i=0;i<config.items.length;i++){
			css_arr[i]={'width':config.items[i].width+'px','text-align':config.items[i].align};
		}
		
		$('#'+config.id).find('tbody tr').each(function(i){
			$('#'+config.id).find('.ui-table-td').each(function(j){
				if(j==0){
					$(this).addClass('ui-table-th-count');
				}
				if(j==1){
					$(this).addClass('ui-table-th-choose');
				}
				if(j>1&&j<css_arr.length-1){
					$(this).css(css_arr[j-2]);
				}
			});
			
			if(!(i%2)){
				$(this).addClass('ui-td-interlacing');
			}
			$(this).bind('click',function(){
				if($(this).attr('class').indexOf('hlui-table-tr-m-click')>-1){
					$(this).removeClass('ui-table-tr-m-click');
				}
				else{
					$(this).parent().find('tr').removeClass('ui-table-tr-m-click');
					$(this).addClass('ui-table-tr-m-click');
				}
			});
			$(this).bind('mouseover',function(){
				$(this).removeClass('ui-td-interlacing');
				$(this).addClass('ui-table-tr-m-over');
			});
			$(this).bind('mouseout',{'i':i},function(e){
				$(this).removeClass('ui-table-tr-m-over');
				if(!(e.data.i%2)){
					$(this).addClass('ui-td-interlacing');
				}
			});
		});	   

		$('#'+config.id+' .ui-table-th-choose input:checkbox').bind('click',function(){
			if($(this).val()!=1){
				$('#'+config.id+' .ui-table-td-choose input:checkbox').prop('checked',true);
				$(this).val(1);
			}
			else{
				$('#'+config.id+' .ui-table-td-choose input:checkbox').prop('checked',false);
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
