function project_fund(){
	var result = validateNum();
	if(result==1){
		$.messager.alert('提示','已完成投资额的值不小于其中银行贷款和其中政府资助之和','error');
		return ;
	}else if(result==2){alert('aa');
		$.messager.alert('提示','计划新增投资额为固定资产投资和流动资金投资总和','error');
		return ;
	}else if(result==3){
		$.messager.alert('提示','计划投资总额为已完成投资额和计划新增投资额之和','error');
		return ;
	}else if(result==4){
		$.messager.alert('提示','财政拨款为其中专项实施资金和其他财政拨款之和','error');
		return ;
	}else if(result==5){
		$.messager.alert('提示','计划新增投资额为企业自有、银行贷款、财政拨款、其他的和','error');
		return ;
	}
	else{
		$('#project_fund').form('submit',{
		url:'attach3_patent.act.php?action=saveProFund',
		success:function(result){
			$.messager.alert('提示','信息保存成功！','info',function(){
			var complete = completeInput();   
			if(complete) {
				window.parent.save_stage('project_fund');
			}else{
				window.parent.update_stage('project_fund');
			}
			window.parent.setStep('project_fund',complete);
			});
		}
	});
}}



$(function() {
	loadApplyInfo();
/*	$('#back').click(function() {
		root = $(window.parent.parent.document).get(0).location.pathname;
		//alert(root)
		reg = /website/;
		result = root.search(reg);
		//alert(result)
		//前台
		if(result != -1){
			$(window.parent.parent.document).find('iframe').attr('src',"../template/user_project.php");
		}
		//后台
		else{
			$(window.parent.parent.document).find('iframe').attr('src',"/center/php/action/page/approve.php");
		}
	});*/
	
	
});


function completeInput() {
	var returnValue = true;
	$('input').each(function() {
		if(!$(this).val()) {
			returnValue = false;
		}
	})
	var count = 0;
	$(':checkbox').each(function(){
		if($(this).prop('checked')){
			count++;
		}
	})
	if(count == 0){
		return false;
	}
	return returnValue;
}

function getQueryStringByName(name){
    var result = location.search.match(new RegExp("[\?\&]" + name + "=([^\&]+)", "i"));
    if (result == null || result.length < 1) {
        return "";
    }
    return result[1];
}

function loadApplyInfo() {
	$.get('attach3_patent.act.php?action=findProFund',
					function(result) {
						if (result != '0') {
							var res = eval("(" + result + ")");
							$('#project_fund').form('load', res);



						}
						
					});
	
	
	$('.save').bind('click',function(){ project_fund(); });
	$('.reset').bind('click',function(){
		window.location.reload();
	});
}


function validateNum(){
	$invested_bank = $("input[name='invested_bank']");
	$invested_gov = $("input[name='invested_gov']");
	$planadd_bank = $("input[name='planadd_bank']");
	$planadd_gov = $("input[name='planadd_gov']");

	$invest_total = $("input[name='invest_total']");
	$invested = $("input[name='invested']");
	$planadd = $("input[name='planadd']");
	var total1 = wt_add($invested_bank.val(), $invested_gov.val());
	var total2 = wt_add($planadd_bank.val(), $planadd_gov.val());
	var total = wt_add($invested.val(), total2);
	if($invested.val() < total1){
		return 1;//已完成投资额（
	}
	if($planadd.val() != total2){
		return 2;//计划新增投资额（
	}
	if($invest_total.val() != total){
		alert(total);
		alert($invest_total.val());
		return 3;//计划投资总额（万元
	}
    
	$planaddsrc_finpat = $("input[name='planaddsrc_finpat']");
	$planaddsrc_finother = $("input[name='planaddsrc_finother']");
	$planaddsrc_fin = $("input[name='planaddsrc_fin']");
	$tol=wt_add($planaddsrc_finpat.val(), $planaddsrc_finother.val())
	if($planaddsrc_fin.val()!=$tol){
		return 4;//财政拨款
	}
	
	$planaddsrc_com=$("input[name='planaddsrc_com']");
	$planaddsrc_othe=$("input[name='planaddsrc_othe']");
	
	$planaddsrc_bank=$("input[name='planaddsrc_bank']");
	$tal1=wt_add($planaddsrc_com.val(),$planaddsrc_othe.val());
	$tal2=wt_add($planaddsrc_fin.val(),$planaddsrc_bank.val());
	 $tal=wt_add($tal1,$tal2);
     if($planadd.val()!=$tal){
    	 return 5;//计划新增投资额
     }
	return false;

}







