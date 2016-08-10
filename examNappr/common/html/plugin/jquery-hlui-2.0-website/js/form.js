// JavaScript Document
/**
 * jQuery HLUI 1.1.2
 * Form
 * 
 * Copyright(c) 2014-2014 omnimediawindows [ 1499962582@qq.com ] 
 * Author:Li Zhixiao
 * Modified by: Li Zhixiao
 */
 
/**
* warning:
*/

$.extend({
	form:function(idSelector,user_func,debug){
		var is_up_file=0;
		var is_iframe_exist=0;
		if($('#hlui_submit_iframe').length>0){
			is_iframe_exist=1;
		}
		if($(idSelector+' .ui-form-file').length>0){//if file input found
			$(idSelector).attr({'method':'post','enctype':'multipart/form-data','target':'hlui_submit_iframe'});
			is_up_file=1;
		}
		$(idSelector).attr('onsubmit','return false;');
		
		$('.ui-form-button').attr({'href':'javascript:void(0);'});
		if(!is_iframe_exist && is_up_file){
			$('body').append('<iframe name="hlui_submit_iframe" id="hlui_submit_iframe"></iframe>');
			$("#hlui_submit_iframe").load(function(){
				var jsonstr=$(document.getElementById('hlui_submit_iframe').contentWindow.document.body).html();
				if(typeof(debug)!='undefined' && debug=='debug'){
					alert(jsonstr);
				}
				else{
					user_func($.parseJSON(jsonstr));
				}
			});
		}
		$.form_validate(idSelector,user_func,debug);
	},
	form_validate:function(idSelector,user_func,debug){
		var is_all_correct=true;
		$(idSelector+' .ui-form-validate').each(function(){
			var d_opt=$.data_option_format($(this).attr('data-opt'));
			
			if(d_opt.required){
				if($(this).attr('class').indexOf('ui-form-file')>-1){
					if($(this).val()==''){
						alert('请选择需要上传的文件！');
						$.form_auto_warning(this);
						is_all_correct=false;
						return false;
					}
				}
				else{
					$(this).val($.trim($(this).val()));
					if($(this).val()==''){
						alert('您还有必填项尚未填写！');
						$.form_auto_warning(this);
						is_all_correct=false;
						return false;
					}
				}
			}
			if(d_opt.required && d_opt.length && d_opt.length!=''){
				var length_arr=d_opt.length.split(',');
				var start=length_arr[0];
				var end=length_arr[1];
				if((start!='' && $(this).val().length<parseInt(start))){
					alert('输入不能少于'+start+'个字符！');
					$.form_auto_warning(this);
					is_all_correct=false;
					return false;
				}
				else if(end!='' && $(this).val().length>parseInt(end)){
					alert('输入不能多于'+end+'个字符！');
					$.form_auto_warning(this);
					is_all_correct=false;
					return false;
				}
			}
			if(d_opt.required && d_opt.validType){
				switch(d_opt.validType){
				case 'email':
					var reg=/^\w+([\.\-]\w+)*\@\w+([\.\-]\w+)*\.\w+$/;	
					if(!reg.test($(this).val())){alert('电子邮件格式错误，请检查！');$.form_auto_warning(this);is_all_correct=false;}
					break;
				case 'number':
					var reg=/^[0-9]*$/;
					if(!reg.test($(this).val())){alert('请输入数字！');$.form_auto_warning(this);is_all_correct=false;}
					break;
				case 'money':
					var reg=/^[0-9]+(.[0-9]{2})?$/;
					if(!reg.test($(this).val())){alert('货币金额格式不正确（整数.两位小数）！');$.form_auto_warning(this);is_all_correct=false;}
					break;
				case 'user':
					var reg=/^[a-zA-Z]\w*$/;
					if(!reg.test($(this).val())){alert('用户名必须以字母开头，可以包括数字和下划线！');$.form_auto_warning(this);is_all_correct=false;}
					break;
				case 'url':
					var reg=/^[a-zA-z]+:\/\/[^\s]*$/;
					if(!reg.test($(this).val())){alert('URL地址输入不正确！');$.form_auto_warning(this);is_all_correct=false;}
					break;
				case 'chnchr'://汉字
					var reg=/^[\u4e00-\u9fa5]*$/;
					if(!reg.test($(this).val())){alert('请输入汉字！');$.form_auto_warning(this);is_all_correct=false;}
					break;
				case 'ip':
					var reg=/^\d+\.\d+\.\d+\.\d+$/;
					if(!reg.test($(this).val())){alert('IP地址输入不正确！');$.form_auto_warning(this);is_all_correct=false;}
					break;
				case 'tel':
					var reg=/^([\d-+]*)$/;//it is hard to validate a telephone number because of the uncertain rules
					if(!reg.test($(this).val())){alert('座机号码输入不正确！');$.form_auto_warning(this);is_all_correct=false;}
					break;
				case 'phone':
					var reg=/^(((1[0-9]{1}[0-9]{1}))+\d{8})$/;
					if(!reg.test($(this).val())){alert('手机号码输入不正确！');$.form_auto_warning(this);is_all_correct=false;}
					break;
				case 'postcode':
					var reg=/^\d{6}$/;
					if(!reg.test($(this).val())){alert('邮政编码输入不正确！');$.form_auto_warning(this);is_all_correct=false;}
					break;
				case 'ic':
					if(!$.id_card_valicate($(this).val())){alert('身份证号码输入不正确！');$.form_auto_warning(this);is_all_correct=false;}
					break;
				}
			}
			if(!is_all_correct){
				return false;
			}
		});
		
		if(is_all_correct){
			if($(idSelector+' .ui-form-file').length>0){
				document.getElementById(idSelector.replace('#','')).submit();
			}
			else{
				var json_data={};
				var serialize_arr=$(idSelector).serializeArray();
				$.each(serialize_arr, function() {
      				json_data[this.name]=this.value;
    			});
				if(typeof(debug)!='undefined' && debug=='debug'){
					$.post($(idSelector).attr('action'),json_data,function(ret_val){
						alert(ret_val);
					});
				}
				else{
					$.post($(idSelector).attr('action'),json_data,function(ret_val){
						user_func(ret_val);
					},'json');
				}
			}
		}
		//return is_all_correct;
	},
	form_auto_warning:function(obj){
		$(obj).focus();
		$(obj).select();
	},
	form_checkbox_val:function(name){
		var str='';
		$('input[name="'+name+'"]:checked').each(function(i){
			str+=(i==0?'':',')+$(this).val();
		});
		return str;
	},
	form_radio_val:function(name){
		return typeof($('input[name="'+name+'"]:checked').val())=='undefined'?'':$('input[name="'+name+'"]:checked').val();
	}
});