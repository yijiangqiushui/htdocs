function submit_data(){
		$('#9servise').form('submit' ,{
			url: '../../../../../../extends/Table/api.php?action=save&subtable_id=1929',
			success: function(result){
				$.messager.alert('提示','信息保存成功！','info',function(){
				var complete = completeInput();
				if(complete){
					
					window.parent.save_stage('service');
				}else{
					window.parent.update_stage('service');
				} 
				window.parent.setStep('service',complete);
			});
			}
		});
	}

/**
 * 这个方法是判断是不是所有的 信息都填写完了 然后进一步设置是不是显示小对勾
 * 
 * @returns {Boolean}
 */
function completeInput() { 
	var returnValue = true;
	$('input').not(':disabled').each(function() {  
		if (!$(this).val().trim()) {
			returnValue = false;
		}
	})
	$('textarea').each(function() {  
		if (!$(this).val().trim()) {
			returnValue = false;
		}
	})
	return returnValue;
}

$(function(){
		loadApplyInfo();
		$(".num").bind('blur', do_change);
		$total = $("input[name='coop_num']");
		$total.bind('blur', do_change);

		function do_change() {
			$(".num").each(function(i) {
				if (parseInt($total.val()) < parseInt($(this).val())) {
					if($(this).attr("id")=="num1"){
						alert('填写有误! 战略合作中介机构数应该大于管理咨询类');
					}
					if($(this).attr("id")=="num2"){
						alert('填写有误! 战略合作中介机构数应该大于技术服务类');
					}
					if($(this).attr("id")=="num3"){
						alert('填写有误! 战略合作中介机构数应该大于代理服务类');
					}
					if($(this).attr("id")=="num4"){
						alert('填写有误! 战略合作中介机构数应该大于金融服务类');
					}
					if($(this).attr("id")=="num5"){
						alert('填写有误! 战略合作中介机构数应该大于其他');
					}
					$(this).focus();
					return false;
				}
/*	多次弹框，没法让他只弹出一次了。。解开注释即可复现
 * 				if ($('#num1').val() != ""&&$('#num2').val() != ""&&$('#num3').val() != ""&&$('#num4').val() != ""&&$('#num5').val() != "" ){
				var num1 = parseInt($('#num1').val());
				var num2 = parseInt($('#num2').val());
				var num3 = parseInt($('#num3').val());
				var num4 = parseInt($('#num4').val());
				var num5 = parseInt($('#num5').val());
				$('#num5').blur(function(){
				if (parseInt($total.val())  !=  (num1+num2+num3+num4+num5)) {
					alert('填写有误，总人数等于分类人数');
					return false;
				}
				});
					}*/
					});
		}});	
				
					
					
					
					
					
	function loadApplyInfo(){
		$.get('../../../../../../extends/Table/api.php?action=get&subtable_id=1929',
		function(result){
			if(result!='0'){
				var res=eval("("+result+")");
				$('#9servise').form('load',res);
				initRadio();
			}
		});
		
		
		$('.save').bind('click',function(){ submit_data(); });
		$('.reset').bind('click',function(){
			window.location.reload();
		});
		checkRadio();

	}

	function getQueryStringByName(name){
	    var result = location.search.match(new RegExp("[\?\&]" + name + "=([^\&]+)", "i"));
	    if (result == null || result.length < 1) {
	        return "";
	    }
	    return result[1];
	}

//用来处理按钮的函数
	function checkRadio(){
		$("input[type='radio']").click(function(){
			var obj = $(this);//alert(obj.prop("name"));
			if(obj.prop("id")=="serve"){
				if(obj.val()=="0"){
					obj.parents("tr").find("input").prop("disabled","disabled");
					obj.parents("tr").find("input").prop("checked",false);
					obj.prop("checked",true);
					obj.prop("disabled","");
					obj.siblings().prop("disabled","");
					obj.parents("tr").find("input[type='hidden']").prop("value","0")
				}else{
					obj.parents("tr").find("input").prop("disabled","");
					obj.siblings().prop("checked",false);
					obj.parent().find("input:last").prop("value","1")
				}
			}else if(obj.prop("id")=="charge"){
				if(obj.val()=="0"){

					obj.siblings().prop("checked",false);
					obj.parent().find("input:last").prop("value","0")
				}else{
					obj.siblings().prop("checked",false);
					obj.parent().find("input:last").prop("value","1")
				}
			}else if(obj.prop("id")=="self"){
					obj.parents("tr").find("input#coop").prop("checked",false);
					obj.parents("tr").find("input#coop").siblings().prop("value",0);
					obj.siblings().prop("value","1");

			}else{
				obj.parents("tr").find("input#self").prop("checked",false);
				obj.parents("tr").find("input#self").siblings().prop("value",0);
				obj.siblings().prop("value","1");
			}
		});
	}
//初始化按钮操作
	function initRadio(){
		$("input[type='hidden']").each(function (){
			var obj = $(this);
			if(obj.prop("value")=="1"){
				if(obj.siblings("input").length>1){
					obj.siblings("input").filter("[value='1']").prop("checked",true);
				}else{
					obj.siblings("input").prop("checked",true);
				}
			}else{
				if(obj.siblings("input").length>1){
					var temp =obj.siblings("input").filter("[value='0']");
					if(temp.prop("id")=="serve"){
						temp.parents("tr").find("input").prop("checked",false);
						temp.parents("tr").find("input").prop("disabled","disabled");
						temp.prop("checked",true);
						temp.prop("disabled","");
						temp.siblings().prop("disabled","");
						temp.parents("tr").find("input[type='hidden']").prop("value","0")
					}else{
						temp.prop("checked",true);
					}
				}else{
					obj.siblings("input").prop("checked",false);
				}
			}
		});
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	