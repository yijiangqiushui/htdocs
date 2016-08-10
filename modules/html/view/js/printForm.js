/**
date:2014-07-30
author:Gao Xue
*/

$(function(){
	var id=$._GET('id');
	loadcombotree();
	/*$('#rec_org').combobox({   
		url:'/modules/php/action/page/applycation/apply.act.php?action=queryRecOrg',   
		valueField:'id',   
		textField:'text'
	});*/
	
	/**************一、项目基本情况*****************/
	$.get('/modules/php/action/page/applycation/apply.act.php?action=findApply&id='+id,function(result){
		//alert(result);
		var res=eval("("+result+")");
		
		//alert(res.science+'===================');
		
		$('#aname').html(res.aname);
		$('#impPerson').html(res.impPerson);
		$('#completeOrg').html(res.completeOrg);
		$('#completeAdress').html(res.completeAdress);
		$('#completeCode').html(res.completeCode);
		$('#completePerson').html(res.completePerson);
		$('#completeTel').html(res.completeTel);
		$('#completePhone').html(res.completePhone);
		$('#completeFax').html(res.completeFax);
		$('#completeEmail').html(res.completeEmail);
		$('#rec_org').html(res.recOrg);
		$('#economicText').html($('#economic').find("option:selected").text());
		//$('#scienceText').html($('#scienceTree').combobox('getText'));
		$('#scienceText').html(res.science);
		$('#sourceText').html($('#source').find("option:selected").text());
		$('#planID').html(res.planID);
		$('#proStart').html(res.proStart);
		$('#proEnd').html(res.proEnd);
		/*$('#appFm').form('load',res);*/
	});
	
	/********************二、项目简介****************************/
	$.get('/modules/php/action/page/applycation/apply.act.php?action=findBrief&id='+id,function(result){
		var res1=eval("("+result+")");
		$('#proBrief').html(res1.proBrief);
		//$('#briefForm').form('load',res1);
	});
	
	$.get('/modules/php/action/page/applycation/apply.act.php?action=findCreate&id='+id,function(result){
		var res2=eval("("+result+")");
		$('#proCreat').html(res2.proCreat);
		//$('#createForm').form('load',res2);
	});
	
	$.get( '../../../../website/php/action/page/apply4.act.php?action=show&aid='+id,function(data){
		if(data!='0'){
			$('#showDiv1').show();
			$('#showDiv').hide();
			var res=eval("("+data+")");
			$('#background').html(res.background);
			$('#scienceCon').html(res.scienceCon);
			$('#extend').html(res.extend);
			$('#effect').html(res.effect);
			$('#invest').html(res.invest);
			$('#recoverDate').html(res.recoverDate);
			$('#casculBasis').html(res.casculBasis);
			$('#economicBenefit').html(res.economicBenefit);
			$('#socialeffect').html(res.socialeffect);
        	//$('#f').form('load',res);
		}else{
			$('#showDiv1').hide();
			$('#showDiv').show();
		}
   });
   
	$.get('../../../../website/php/action/page/apply4.act.php?action=printBen&aid='+id,function(result){
		var resBen=eval(result);
		var sumIncome=0,sumProfit=0,sumTax=0,sumForeignCurrency=0,sumTotalSavings=0;
		for(var i=0;i<resBen.length;i++){
			$.each($('#Ben tbody tr'),function(){
				if($(this).attr('id')=='Benifity'){
					//var currentRow=$('#Ben tbody tr:eq('+i+')');
					var currentRow=$(this);
					str="<tr><td style='background-color:#fff;'>"+resBen[i]['year']+"</td><td style='background-color:#fff;'>"+resBen[i]['income']+"</td><td style='background-color:#fff;'>"+resBen[i]['profit']+"</td><td style='background-color:#fff;'>"+resBen[i]['tax']+"</td><td style='background-color:#fff;'>"+resBen[i]['foreignCurrency']+"</td><td style='background-color:#fff;'>"+resBen[i]['totalSavings']+"</td></tr>";
					currentRow.after(str);
				}
			})
			sumIncome+=parseInt(resBen[i]['income']);
			sumProfit+=parseInt(resBen[i]['profit']);
			sumTax+=parseInt(resBen[i]['tax']);
			sumForeignCurrency+=parseInt(resBen[i]['foreignCurrency']);
			sumTotalSavings+=parseInt(resBen[i]['totalSavings']);
		}
		$('#sumBen td:eq(1)').text(sumIncome);
		$('#sumBen td:eq(2)').text(sumProfit);
		$('#sumBen td:eq(3)').text(sumTax);
		$('#sumBen td:eq(4)').text(sumForeignCurrency);
		$('#sumBen td:eq(5)').text(sumTotalSavings);
	});
	
	$.get('../../../../website/php/action/page/apply5.act.php?action=printAdward&id='+id,function(result){
		var resAward=eval(result);
		for(var i=0;i<resAward.length;i++){
			var j=resAward.length-i;
			$.each($('#Adward tbody tr'),function(){
				if($(this).attr('id')=='one'){
					//var currentRow=$('#Ben tbody tr:eq('+i+')');
					var currentRow=$(this);
					str="<tr><td style='background-color:#fff;'>"+j+"</td><td style='background-color:#fff;'>"+resAward[i]['awardName']+"</td><td style='background-color:#fff;'>"+resAward[i]['awardTime']+"</td><td style='background-color:#fff;'>"+resAward[i]['name']+"</td><td style='background-color:#fff;'>"+resAward[i]['awardGrade']+"</td><td style='background-color:#fff;'>"+resAward[i]['depart']+"</td></tr>";
					currentRow.after(str);
				}
			})
		}
	});
	
	$.get('../../../../website/php/action/page/apply6.act.php?action=printUnit&id='+id,function(result){
		//alert(result);
		var resUnit=eval(result);
		if(resUnit.length>1){
			$(".Unit").after($(".Unit").clone(resUnit.length));
		}
		for(var i=0;i<resUnit.length;i++){
			$('.Unit div[class="sort"]').eq(i).html(resUnit[i]['sort']);
			$('.Unit div[class="name"]').eq(i).html(resUnit[i]['name']);
			$('.Unit div[class="contribute"]').eq(i).html(resUnit[i]['contribute']);
			$('.Unit div[class="address"]').eq(i).html(resUnit[i]['address']);
			$('.Unit div[class="postcode"]').eq(i).html(resUnit[i]['postcode']);
			$('.Unit div[class="nature"]').eq(i).html(resUnit[i]['nature']);
			$('.Unit div[class="type"]').eq(i).html(resUnit[i]['type']);
			$('.Unit div[class="isSeparateLegal"]').eq(i).html(resUnit[i]['isSeparateLegal']);
			$('.Unit div[class="registeNum"]').eq(i).html(resUnit[i]['registeNum']);
			$('.Unit div[class="organizationCode"]').eq(i).html(resUnit[i]['organizationCode']);
			$('.Unit div[class="zone"]').eq(i).html(resUnit[i]['zone']);
			$('.Unit div[class="web"]').eq(i).html(resUnit[i]['web']);
			$('.Unit div[class="contact"]').eq(i).html(resUnit[i]['contact']);
			$('.Unit div[class="phone"]').eq(i).html(resUnit[i]['phone']);
			$('.Unit div[class="fax"]').eq(i).html(resUnit[i]['fax']);
			$('.Unit div[class="tel"]').eq(i).html(resUnit[i]['tel']);
			$('.Unit div[class="email"]').eq(i).html(resUnit[i]['email']);
			$('.Unit div[class="proContact"]').eq(i).html(resUnit[i]['proContact']);
			$('.Unit div[class="proTel"]').eq(i).html(resUnit[i]['proTel']);
			$('.Unit div[class="proEmail"]').eq(i).html(resUnit[i]['proEmail']);
		}
	});
	
	
	$.get('../../../../website/php/action/page/apply7.act.php?action=printPeople&id='+id,function(result){
		//alert(result);
		var resPeople=eval(result);
		if(resPeople.length>1){
			$(".People").after($(".People").clone(resPeople.length));
		}
		for(var i=0;i<resPeople.length;i++){
			$('.People div[class="sort"]').eq(i).html(resPeople[i]['sort']);
			$('.People div[class="name"]').eq(i).html(resPeople[i]['name']);
			$('.People div[class="sex"]').eq(i).html(resPeople[i]['sex']);
			$('.People div[class="nation"]').eq(i).html(resPeople[i]['nation']);
			$('.People div[class="birthplace"]').eq(i).html(resPeople[i]['birthplace']);
			$('.People div[class="birthdate"]').eq(i).html(resPeople[i]['birthdate']);
			$('.People div[class="idNumber"]').eq(i).html(resPeople[i]['idNumber']);
			$('.People div[class="eduLeval"]').eq(i).html(resPeople[i]['eduLeval']);
			$('.People div[class="graduateTime"]').eq(i).html(resPeople[i]['graduateTime']);
			$('.People div[class="isHomecoming"]').eq(i).html(resPeople[i]['isHomecoming']);
			$('.People div[class="company"]').eq(i).html(resPeople[i]['company']);
			$('.People div[class="phone"]').eq(i).html(resPeople[i]['phone']);
			$('.People div[class="email"]').eq(i).html(resPeople[i]['email']);
			$('.People div[class="tel"]').eq(i).html(resPeople[i]['tel']);
			$('.People div[class="address"]').eq(i).html(resPeople[i]['address']);
			$('.People div[class="graduateSchool"]').eq(i).html(resPeople[i]['graduateSchool']);
			$('.People div[class="major"]').eq(i).html(resPeople[i]['major']);
			$('.People div[class="degree"]').eq(i).html(resPeople[i]['degree']);
			$('.People div[class="profession"]').eq(i).html(resPeople[i]['profession']);
			$('.People div[class="techTitle"]').eq(i).html(resPeople[i]['techTitle']);
			$('.People div[class="adminPost"]').eq(i).html(resPeople[i]['adminPost']);
			$('.People div[class="familiarSubject"]').eq(i).html(resPeople[i]['familiarSubject']);
			$('.People div[class="techAward"]').eq(i).html(resPeople[i]['techAward']);
			$('.People div[class="startTime"]').eq(i).html(resPeople[i]['startTime']);
			$('.People div[class="endTime"]').eq(i).html(resPeople[i]['endTime']);
			$('.People div[class="contribute"]').eq(i).html(resPeople[i]['contribute']);
		}
	});
	
	$.get('../../../../website/php/action/page/apply81.act.php?action=printProof1&id='+id,function(result){
		var resProo1=eval(result);
		for(var i=0;i<resProo1.length;i++){
			var j=resProo1.length-i;
			$.each($('#proof tbody tr'),function(){
				if($(this).attr('id')=='proof1'){
					//var currentRow=$('#Ben tbody tr:eq('+i+')');
					var currentRow=$(this);
					str="<tr><td style='background-color:#fff;'>"+j+"</td><td style='background-color:#fff;'>"+resProo1[i]['name']+"</td><td colspan='2' style='background-color:#fff;'>"+resProo1[i]['category']+"</td><td style='background-color:#fff;'>"+resProo1[i]['country']+"</td><td colspan='2' style='background-color:#fff;'>"+resProo1[i]['authorizationNum']+"</td></tr>";
					currentRow.after(str);
				}
			})
		}
	});
	
	$.get('../../../../website/php/action/page/apply82.act.php?action=printProof2&id='+id,function(result){
		if(result!=""){
			var resProo2=eval(result);
			for(var i=0;i<resProo2.length;i++){
				var j=resProo2.length-i;
				$.each($('#proof tbody tr'),function(){
					if($(this).attr('id')=='proof2'){
						//var currentRow=$('#Ben tbody tr:eq('+i+')');
						var currentRow=$(this);
						str="<tr><td style='background-color:#fff;'>"+j+"</td><td style='background-color:#fff;'>"+resProo2[i]['name']+"</td><td colspan='2' style='background-color:#fff;'>"+resProo2[i]['evaluationForm']+"</td><td style='background-color:#fff;'>"+resProo2[i]['organizationUnit']+"</td><td style='background-color:#fff;'>"+resProo2[i]['evaluationTime']+"</td><td style='background-color:#fff;'>"+resProo2[i]['evaluationLevel']+"</td></tr>";
						currentRow.after(str);
					}
				})
			}
		}
	});
	
	$.get('../../../../website/php/action/page/apply83.act.php?action=printProof3&id='+id,function(result){
		if(result!=""){
			var resProo3=eval(result);
			for(var i=0;i<resProo3.length;i++){
				var j=resProo3.length-i;
				$.each($('#proof tbody tr'),function(){
					if($(this).attr('id')=='proof3'){
						//var currentRow=$('#Ben tbody tr:eq('+i+')');
						var currentRow=$(this);
						str="<tr><td style='background-color:#fff;'>"+j+"</td><td  colspan='3' style='background-color:#fff;'>"+resProo3[i]['name']+"</td><td style='background-color:#fff;'>"+resProo3[i]['category']+"</td><td colspan='2' style='background-color:#fff;'>"+resProo3[i]['standardNo']+"</td></tr>";
						currentRow.after(str);
					}
				})
			}
		}
	});
	
	$.get('../../../../website/php/action/page/apply84.act.php?action=printProof4&id='+id,function(result){
		if(result!=""){
			var resProo4=eval(result);
			for(var i=0;i<resProo4.length;i++){
				var j=resProo4.length-i;
				$.each($('#proof tbody tr'),function(){
					if($(this).attr('id')=='proof4'){
						//var currentRow=$('#Ben tbody tr:eq('+i+')');
						var currentRow=$(this);
						str="<tr><td style='background-color:#fff;'>"+j+"</td><td style='background-color:#fff;'>"+resProo4[i]['testOrg']+"</td><td colspan='2' style='background-color:#fff;'>"+resProo4[i]['client']+"</td><td style='background-color:#fff;'>"+resProo4[i]['proName']+"</td><td colspan='2' style='background-color:#fff;'>"+resProo4[i]['certificateNo']+"</td></tr>";
						currentRow.after(str);
					}
				})
			}
		}
	});
	
	$.get('../../../../website/php/action/page/apply85.act.php?action=printProof5&id='+id,function(result){
		var resProo5=eval(result);
		for(var i=0;i<resProo5.length;i++){
			var j=resProo5.length-i;
			$.each($('#proof tbody tr'),function(){
				if($(this).attr('id')=='proof5'){
					//var currentRow=$('#Ben tbody tr:eq('+i+')');
					var currentRow=$(this);
					str="<tr><td style='background-color:#fff;'>"+j+"</td><td style='background-color:#fff;'>"+resProo5[i]['docName']+"</td><td colspan='2' style='background-color:#fff;'>"+resProo5[i]['proName']+"</td><td style='background-color:#fff;'>"+resProo5[i]['examUnit']+"</td><td style='background-color:#fff;'>"+resProo5[i]['examDate']+"</td><td style='background-color:#fff;'>"+resProo5[i]['appUnit']+"</td></tr>";
					currentRow.after(str);
				}
			})
		}
	});
	
	$.get('../../../../website/php/action/page/apply86.act.php?action=printProof6&id='+id,function(result){
		var resProo6=eval(result);
		for(var i=0;i<resProo6.length;i++){
			var j=resProo6.length-i;
			$.each($('#proof tbody tr'),function(){
				if($(this).attr('id')=='proof6'){
					//var currentRow=$('#Ben tbody tr:eq('+i+')');
					var currentRow=$(this);
					str="<tr><td style='background-color:#fff;'>"+j+"</td><td style='background-color:#fff;'>"+resProo6[i]['unit']+"</td><td style='background-color:#fff;'>"+resProo6[i]['contact']+"</td><td style='background-color:#fff;'>"+resProo6[i]['phone']+"</td><td style='background-color:#fff;'>"+resProo6[i]['startTime']+"</td><td style='background-color:#fff;'>"+resProo6[i]['endTime']+"</td><td style='background-color:#fff;'>"+resProo6[i]['benefit']+"</td></tr>";
					currentRow.after(str);
				}
			})
		}
	});
	
	$.get('../../../../website/php/action/page/apply87.act.php?action=printProof7&id='+id,function(result){
		var resProo7=eval(result);
		for(var i=0;i<resProo7.length;i++){
			var j=resProo7.length-i;
			$.each($('#proof tbody tr'),function(){
				if($(this).attr('id')=='proof7'){
					//var currentRow=$('#Ben tbody tr:eq('+i+')');
					var currentRow=$(this);
					str="<tr><td style='background-color:#fff;'>"+j+"</td><td style='background-color:#fff;'>"+resProo7[i]['name']+"</td><td colspan='2' style='background-color:#fff;'>"+resProo7[i]['category']+"</td><td style='background-color:#fff;'>"+resProo7[i]['country']+"</td><td colspan='2' style='background-color:#fff;'>"+resProo7[i]['authorizationNum']+"</td></tr>";
					currentRow.after(str);
				}
			})
		}
	});
	
	$.get('../../../../website/php/action/page/apply9.act.php?action=query&id='+id,function(data){
		//alert(data);
		var resAdvice=eval("("+data+")");	
		$('#UnitAdvice').html(resAdvice.content);			
		//$('#fm').form('load',res);
	});
	
	/*$.get('../../../../website/php/action/page/apply10.act.php?action=printAttach&id='+id,function(result){
		alert(result);
		/*var resProof=eval(result);
		for(var i=0;i<resProof.length;i++){
			var j=resProof.length-i;
			$.each($('#attachProof tbody tr'),function(){
				if($(this).attr('id')=='attachProof1'){
					//var currentRow=$('#Ben tbody tr:eq('+i+')');
					var currentRow=$(this);
					str="<tr><td style='background-color:#fff;'>"+j+"</td><td style='background-color:#fff;'>"+resProof[i]['awardName']+"</td><td style='background-color:#fff;'>"+resProof[i]['awardTime']+"</td><td style='background-color:#fff;'>"+resProof[i]['name']+"</td></tr>";
					currentRow.after(str);
				}
			})
		}
	});*/

	
	
});


/********树形下拉菜单*******************/
function loadcombotree(){
	$("#scienceTree").combotree({
		url:'/modules/php/action/page/applycation/applycat.act.php?action=treeData',
		onBeforeExpand:function(node){
			$(this).tree('options').url='/modules/php/action/page/applycation/applycat.act.php?action=treeData&upper_id='+node.id;
		},
		onClick:function(node){
			$('#scienceCat').val(node.upper_cat+node.id+'.');
		},
		onLoadSuccess:function(node,data){
			$("#scienceTree").combotree('tree').tree('expandAll');
			var node=$("#scienceTree").combotree('tree').tree('find',0);
			$("#scienceTree").combotree('tree').tree('update',{target:node.target,text:'请选择所属科技领域'});
		}	
	});
}

function printFm(){
	//alert();
	//$.post('/common/php/plugin/html2fpdf_zh_cn/test.php',{'html':$('body').html()},function(result){
	/*var locate='../../../../1.doc';
	$.post('/modules/php/action/page/printPdf.php',{'html':$('#appFm').html(),'locate':locate},function(result){
		//alert(result);
		window.open(locate);
	});*/
	window.open('/modules/php/action/page/printPdf.php');
	//$('#test').text($('body').html());
	//$("#pp").jqprint();
}