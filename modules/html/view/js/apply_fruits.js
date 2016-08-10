/**
author:Gao Xue
date:2014-05-24
*/
var url;
var cat_name='',upper_id=0,upper_cat='.',edtid,globalId;
var pridge;
var flag;
var expertTeam='';
var list;
var treeTitleStr='',gridTitleStr='';
var changTitle='';


var concatID='';

var excelFlag,expertId;

$(function(){
	flag=$._GET('flag');
	$('body').css('display','none');
	$.get('../../../php/action/page/jdgPge.act.php',function(data){
		pridge=data;
		$('body').css('display','block');
		if(data=='super'){
			loadTree();
			loadPage();
		}else{
			if(data.indexOf('fruits_query')<0){
				$('body').html('<h2>您没有操作权限</h2>');
				
			}else{
				var temp = data.split(',')[1].split('.');
				//concatID = temp[temp.length-1];
				concatID=isNaN(parseInt(temp[temp.length-1]))?'':temp[temp.length-1];
				//concatID=parseInt(temp[temp.length-1])===NaN;
				/*if(data.indexOf('admincat_del')<0){
						$("a[onclick='delElelist()']").css('display','none');			
				}
				if(data.indexOf('admincat_add')<0){
						$("a[onclick='newEle()']").css('display','none');			
				}
				if(data.indexOf('admincat_disable')<0){
						$("a[iconCls='icon-no']").css('display','none');			
				}
				if(data.indexOf('admincat_enable')<0){
						$("a[iconCls='icon-ok']").css('display','none');			
				}*/				
				loadTree();
				loadPage();
			}	
		}
	});	
	
	//loadTree();
	//loadPage();
});

/*****查看申请项目********/
function loadTree(){
	$('#treeData').tree({
		url:'../../../php/action/page/applycation/applycat.act.php?action=treeData&flag='+flag+'&con_cat='+concatID,
		onBeforeExpand:function(node){
			$(this).tree('options').url='../../../php/action/page/applycation/applycat.act.php?action=treeData&upper_id='+node.id+'&flag='+flag+'&con_cat='+concatID;
		},
		onClick:function(node){
			if(node.text=='全部'){
				cat_name='';
				upper_id=0;
				//upper_cat='.';
				upper_cat=concatID;
			}else{
				cat_name=node.text;
				upper_id=node.id;
				upper_cat=node.upper_cat+node.id+'.';
				if(upper_cat.indexOf(concatID)<0){
					upper_cat=concatID;
				}
				//alert(upper_cat+'----------');
			}
			$('#applygrid').datagrid('load',{'upper_cat':upper_cat,'num':1});
		}
	});
}
function loadPage(){
	$('#applygrid').datagrid({
		//height:250,
		nowrap : true,//设置为true，当数据长度超出列宽时将会自动截取
		striped : true,//设置为true将交替显示行背景。
		collapsible : false,//显示可折叠按钮
		singleSelect:true,//为true时只能选择单行
		//fitColumns:true,//允许表格自动缩放，以适应父容器
		rownumbers : true,//行数
		pagination:true,//分页
		pageSize: 15,  
		pageList: [5,10,15,20,30], 
		checkOnSelect:false,
		selectOnCheck:false, 
					
		remoteSort : false,
		toolbar:'#toolbar',

		url:'../../../php/action/page/applycation/apply.act.php?action=queryApply&flag='+flag+'&con_cat='+concatID,//url调用Action方法
				
		columns:[[
					
			{field:'id',title:'id',checkbox:true},
			{field:'aname',title:'项目名称',width:300},
			//{field:'impPerson',title:'主要完成人',width:100},
			{field:'completeOrg',title:'第一完成单位'},
			{field:'orgName',title:'申报单位'},
			//{field:'completePhone',title:'联系电话'},
			//{field:'recOrg',title:'推荐单位',width:100},
			//{field:'recPhone',title:'推荐单位电话',width:100},
			//{field:'planID',title:'具体计划、基金的名称和编号',fit:true},
			//{field:'proStart',title:'项目起始时间',width:100},
			//{field:'proEnd',title:'完成时间',width:100},
			{field:'proState',title:'项目状态',
				formatter:function(value,row,index){
					var str='';
					switch(value){
						case '0':
							str='待审核';
							break;
						case '1':
							str='审核通过';
							break;
						case '2':
							str='退回修改';
							break;
						case '3':
							str='未通过审核';
							break;
							default:;
					}
					return str;
				}},
			
			{field:'action',title:'操作',align:'center',
				formatter:function(value,row,index){

					var a='<a href="javascript:void(0)" onclick="checkApply('+row.id+')">查看信息</a>';
					var b='|'+'<a href="javascript:void(0)" onclick="checkScore('+row.id+',\''+row.expertCat+'\')">查看评分</a>';
					var c='|'+'<a href="javascript:void(0)" onclick="score('+row.id+',\''+row.expertCat+'\')">评分</a>';
					var d='|'+'<a href="javascript:void(0)" onclick="checkRepeat('+row.id+')">查看重复项目</a>';
					var e='|'+'<a href="javascript:void(0)" onclick="recommendInfo('+row.id+')">推荐单位意见</a>';//heyangyang
					var f='|'+'<a href="javascript:void(0)" onclick="proState('+row.id+')">项目状态</a>';	
					var g='|'+'<a href="javascript:void(0)" onclick="printForm('+row.id+')">打印表单</a>';								
					var rn='';
					if(pridge=='super'){
							rn=a+b+c+d+e+f+g;
					}else{
							if(pridge.indexOf('fruits_query')>=0){
								rn+=a;
							}
							if(pridge.indexOf('fruitsStore_query')>=0){
								rn+=b;
							}
							if(pridge.indexOf('fruits_score')>=0){
								rn+=c;
							}
							if(pridge.indexOf('fruits_RecAdvice')>=0){
								rn+=d;
							}
							if(pridge.indexOf('fruits_check')>=0){
								rn+=e;
							}
						}
							
					return rn;
				}
			}															
		]]						  
	});
				
	var p = $('#applygrid').datagrid('getPager');			  
	$(p).pagination({  
			pageSize: 15,  
			pageList: [5,10,15,20,30], 
			beforePageText: '第', 
			afterPageText: '页    共 {pages} 页',  
			displayMsg: '当前显示 {from} - {to} 条记录   共 {total} 条记录'  						   
	});  
}

//heyangyang
function recommendInfo(appid){
	$(function(){
		$.get( '../../../../website/php/action/page/apply9.act.php?action=queryinfo&appid='+appid,function(data){
				//alert(data);
				if(data=='null'){
					$('#recommendInfo_form').form('clear');
					$('#recommendInfo_dlg').dialog('open').dialog('setTitle','添加推荐信息');
					url='../../../../website/php/action/page/apply9.act.php?action=add&appid='+appid;	
				}else{
					$('#recommendInfo_dlg').dialog('open').dialog('setTitle','修改推荐信息');
					url='../../../../website/php/action/page/apply9.act.php?action=update&appid='+appid;
					var res=eval("("+data+")");	
					$('#recommendInfo_form').form('load',res);
				}
				
		});
	});
}

function saveRecommendInfo(){
	//alert('save');	
	$('#recommendInfo_form').form('submit',{
		url:url,
		onSubmit: function(){			
		},
		success: function(result){	
			$('#recommendInfo_dlg').dialog('close');			
			url=null;				
		}
	});	
}

function checkApply(id){
	globalId=id;
	$('#checkFruitsdlg').dialog('open').dialog('setTitle','科学技术奖申报信息');
	$.get('../../../php/action/page/applycation/apply.act.php?action=findApply&id='+id,function(result){
		var res=eval("("+result+")");
		$('#impPerson').html(res.impPerson);
		$('#application').form('load',res);
	});
	
	$.get('../../../php/action/page/applycation/apply.act.php?action=findBrief&id='+id,function(result){
		var res1=eval("("+result+")");
		if(res1.proBrief==null&&res1.proBrief==''){
			$('#proBrief').html('尚未填写');
		}else{
			//$('#brief').form('load',res1);
			$('#proBrief').html(res1.proBrief);
		}
	});
	
	$.get('../../../php/action/page/applycation/apply.act.php?action=findCreate&id='+id,function(result){
		var res2=eval("("+result+")");
		if(res2.proCreat==null&&res2.proCreat==''){
			$('#proCreat').html('尚未填写');
		}else{
			//$('#create').form('load',res2);
			$('#proCreat').html(res2.proCreat);
		}
	});
	
	$.get('../../../php/action/page/applycation/apply.act.php?action=findDetail&id='+id,function(result){
		var res3=eval("("+result+")");
		$('#detail').form('load',res3);
	});
	
	$.get('../../../php/action/page/applycation/apply.act.php?action=findRecommend&id='+id,function(result){
		var res9=eval("("+result+")");
		$('#recommend').form('load',res9);
	});	
	//4---------------------------------------------
	$('#grid4').datagrid({
		nowrap : true,//设置为true，当数据长度超出列宽时将会自动截取
		striped : true,
		collapsible : false,
		singleSelect:true,
		fitColumns:true,
		checkOnSelect:false,
		selectOnCheck:false, 
		remoteSort : false,
		toolbar:'',			   
		url:'../../../../website/php/action/page/apply4.act.php?action=queryBenefit&aid='+id,
		columns:[[
					
			//{field:'id',title:'id',checkbox:true},
			{field:'id',title:'id',hidden:true},
			{field:'year',title:'年份',width:100},
			{field:'income',title:'新增销售收入',width:180},
			{field:'profit',title:'新增利润',width:180},
			{field:'tax',title:'新增税收',width:180},
			{field:'foreignCurrency',title:'创收外汇（美元）',width:180},
			{field:'totalSavings',title:'节支总额',width:180}			
		]]
	});
	//4---------------------------------------------//
	
	$('#datagrid5').datagrid({
		title:'本项目曾获科技奖励情况',
		nowrap : true,//设置为true，当数据长度超出列宽时将会自动截取
		striped : true,//设置为true将交替显示行背景。
		collapsible : false,//显示可折叠按钮
		singleSelect:true,//为true时只能选择单行
		fitColumns:true,//允许表格自动缩放，以适应父容器
		rownumbers : true,//行数
		pagination:true,//分页
		pageSize: 5,  
		pageList: [5,10,15], 
		checkOnSelect:false,
		selectOnCheck:false, 
		remoteSort : false,
				   
		url:'../../../../website/php/action/page/apply5.act.php?action=query&id='+id,//url调用Action方法
		columns:[[
			{field:'id',title:'id',hidden:true},
			{field:'applicationName',title:'项目名称',width:150},
			{field:'awardTime',title:'获奖时间',width:100},
			{field:'awardName',title:'奖励名称',width:150},
			{field:'awardGrade',title:'奖励等级',width:50},
			{field:'depart',title:'授奖部门',width:150}		
		]]						  
	});
	var p = $('#datagrid5').datagrid('getPager');			  
	$(p).pagination({  
			pageSize: 5,  
			pageList: [5,10,15],  
			beforePageText: '第', 
			afterPageText: '页    共 {pages} 页',  
			displayMsg: '当前显示 {from} - {to} 条记录   共 {total} 条记录'  						   
	});  
	$('#datagrid6').datagrid({
		title:'主要完成单位情况',
		nowrap : true,//设置为true，当数据长度超出列宽时将会自动截取
		striped : true,
		collapsible : false,
		singleSelect:true,
		fitColumns:true,
		rownumbers : true,
		pagination:true,//分页
		pageSize: 5,  
		pageList: [5,10,15], 
		checkOnSelect:false,
		selectOnCheck:false,
		remoteSort : false,
		url:'../../../../website/php/action/page/apply6.act.php?action=query&id='+id,
		columns:[[				
			{field:'id',title:'id',hidden:true},
			{field:'name',title:'单位名称',width:150},
			{field:'nature',title:'单位性质',width:150},
			{field:'type',title:'单位类型',width:150},
			{field:'registeNum',title:'企业注册号',width:150},
			{field:'organizationCode',title:'组织机构代码',width:150},
			{field:'zone',title:'单位所在地区',width:150},
			{field:'web',title:'单位网址',width:150},
			{field:'contact',title:'单位联系人',width:150}
		]]
	});
	var p6 = $('#datagrid6').datagrid('getPager');			  
	$(p6).pagination({  
			pageSize: 5,  
			pageList: [5,10,15],  
			beforePageText: '第', 
			afterPageText: '页    共 {pages} 页',  
			displayMsg: '当前显示 {from} - {to} 条记录   共 {total} 条记录'  						   
	});
	
	$('#datagrid7').datagrid({
		title:'主要完成人情况',
		nowrap : true,//设置为true，当数据长度超出列宽时将会自动截取
		striped : true,
		collapsible : false,
		singleSelect:true,
		fitColumns:true,
		rownumbers : true,
		pagination:true,//分页
		pageSize: 5,  
		pageList: [5,10,15], 
		checkOnSelect:false,
		selectOnCheck:false,
		remoteSort : false,
		url:'../../../../website/php/action/page/apply7.act.php?action=query&id='+id,
	
		columns:[[				
			{field:'id',title:'id',hidden:true},
			{field:'name',title:'姓名',width:150},
			{field:'sex',title:'性别',width:100},
			{field:'idNumber',title:'身份证号',width:150},
			{field:'isHomecoming',title:'是否归国人员',width:150},
			{field:'company',title:'工作单位',width:150},
			{field:'phone',title:'联系电话',width:150},
			{field:'email',title:'电子邮箱',width:150},
			{field:'tel',title:'手机',width:150},
			{field:'address',title:'通讯地址',width:150},
			{field:'degree',title:'学位',width:150},
			{field:'profession',title:'现从事专业',width:150},
			{field:'contribute',title:'主要贡献',width:150}
		]]
	});
	var p7 = $('#datagrid7').datagrid('getPager');			  
	$(p7).pagination({  
			pageSize: 5,  
			pageList: [5,10,15],  
			beforePageText: '第', 
			afterPageText: '页    共 {pages} 页',  
			displayMsg: '当前显示 {from} - {to} 条记录   共 {total} 条记录'  						   
	});
	$('#datagrid81').datagrid({
		title:'知识产权证明',		
		nowrap : true,//设置为true，当数据长度超出列宽时将会自动截取
		striped : true,
		collapsible : false,
		singleSelect:true,
		fitColumns:true,
		rownumbers : true,
		pagination:true,//分页
		pageSize: 5,  
		pageList: [5,10,15], 
		checkOnSelect:false,
		selectOnCheck:false, 
		remoteSort : false,
				   
		url:'../../../../website/php/action/page/apply81.act.php?action=query&id='+id,
	
		columns:[[
			{field:'id',title:'id',hidden:true},
			{field:'name',title:'授权项目名称',width:150},
			{field:'category',title:'知识产权类别',width:100},
			{field:'country',title:'国（区）别',width:150},
			{field:'authorizationNum',title:'授权号',width:100}
		]]
	});
	var p81 = $('#datagrid81').datagrid('getPager');			  
	$(p81).pagination({  
			pageSize: 5,  
			pageList: [5,10,15],  
			beforePageText: '第', 
			afterPageText: '页    共 {pages} 页',  
			displayMsg: '当前显示 {from} - {to} 条记录   共 {total} 条记录'  						   
	});
	$('#datagrid82').datagrid({
		title:'主要技术评价证明目录',		
		nowrap : true,//设置为true，当数据长度超出列宽时将会自动截取
		striped : true,
		collapsible : false,
		singleSelect:true,
		fitColumns:true,
		rownumbers : true,
		pagination:true,//分页
		pageSize: 5,  
		pageList: [5,10,15], 
		checkOnSelect:false,
		selectOnCheck:false, 
		remoteSort : false,
				   
		url:'../../../../website/php/action/page/apply82.act.php?action=query',
	
		columns:[[
			{field:'id',title:'id',hidden:true},
			{field:'name',title:'项目名称',width:150},
			{field:'evaluationForm',title:'评价形式',width:100},
			{field:'organizationUnit',title:'组织评价单位',width:150},
			{field:'evaluationTime',title:'评价时间',width:100},
			{field:'evaluationLevel',title:'评价水平',width:100},
		]]
	});
	var p82 = $('#datagrid82').datagrid('getPager');			  
	$(p82).pagination({  
			pageSize: 5,  
			pageList: [5,10,15],  
			beforePageText: '第', 
			afterPageText: '页    共 {pages} 页',  
			displayMsg: '当前显示 {from} - {to} 条记录   共 {total} 条记录'  						   
	}); 
	$('#datagrid83').datagrid({
		title:'产品技术标准目录',		
		nowrap : true,//设置为true，当数据长度超出列宽时将会自动截取
		striped : true,
		collapsible : false,
		singleSelect:true,
		fitColumns:true,
		rownumbers : true,
		pagination:true,//分页
		pageSize: 5,  
		pageList: [5,10,15], 
		checkOnSelect:false,
		selectOnCheck:false, 
		remoteSort : false,
				   
		url:'../../../../website/php/action/page/apply83.act.php?action=query',
	
		columns:[[
			{field:'id',title:'id',hidden:true},
			{field:'name',title:'标准名称',width:150},
			{field:'category',title:'类别',width:100},
			{field:'standardNo',title:'标准号/备案号',width:150}
		]]
	});
	var p83 = $('#datagrid83').datagrid('getPager');			  
	$(p83).pagination({  
			pageSize: 5,  
			pageList: [5,10,15],  
			beforePageText: '第', 
			afterPageText: '页    共 {pages} 页',  
			displayMsg: '当前显示 {from} - {to} 条记录   共 {total} 条记录'  						   
	});
	$('#datagrid84').datagrid({
		title:'产品检测报告目录',		
		nowrap : true,//设置为true，当数据长度超出列宽时将会自动截取
		striped : true,
		collapsible : false,
		singleSelect:true,
		fitColumns:true,
		rownumbers : true,
		pagination:true,//分页
		pageSize: 5,  
		pageList: [5,10,15],
		checkOnSelect:false,
		selectOnCheck:false, 
		remoteSort : false,
				   
		url:'../../../../website/php/action/page/apply84.act.php?action=query',
	
		columns:[[
			{field:'id',title:'id',hidden:true},
			{field:'testOrg',title:'检测机构',width:150},
			{field:'client',title:'委托单位',width:100},
			{field:'proName',title:'被检测产品名称',width:150},
			{field:'certificateNo',title:'证书编号',width:150}
		]]
	}); 
	var p84 = $('#datagrid84').datagrid('getPager');			  
	$(p84).pagination({  
			pageSize: 5,  
			pageList: [5,10,15],  
			beforePageText: '第', 
			afterPageText: '页    共 {pages} 页',  
			displayMsg: '当前显示 {from} - {to} 条记录   共 {total} 条记录'  						   
	});
	
	$('#datagrid85').datagrid({
		title:'行业审批文件目录',		
		nowrap : true,//设置为true，当数据长度超出列宽时将会自动截取
		striped : true,
		collapsible : false,
		singleSelect:true,
		fitColumns:true,
		rownumbers : true,
		pagination:true,//分页
		pageSize: 5,  
		pageList: [5,10,15],
		checkOnSelect:false,
		selectOnCheck:false, 
		remoteSort : false,
				   
		url:'../../../../website/php/action/page/apply85.act.php?action=query',
	
		columns:[[
			{field:'id',title:'id',hidden:true},
			{field:'docName',title:'审批文件名称',width:150},
			{field:'proName',title:'产品名称',width:100},
			{field:'examUnit',title:'审批单位',width:150},
			{field:'examDate',title:'审批时间',width:150},
			{field:'appUnit',title:'申请单位',width:150}
		]]
	}); 
	var p85 = $('#datagrid85').datagrid('getPager');			  
	$(p85).pagination({  
			pageSize: 5,  
			pageList: [5,10,15],  
			beforePageText: '第', 
			afterPageText: '页    共 {pages} 页',  
			displayMsg: '当前显示 {from} - {to} 条记录   共 {total} 条记录'  						   
	});
	$('#datagrid86').datagrid({
		title:'应用证明材料目录',		
		nowrap : true,//设置为true，当数据长度超出列宽时将会自动截取
		striped : true,
		collapsible : false,
		singleSelect:true,
		fitColumns:true,
		rownumbers : true,
		pagination:true,//分页
		pageSize: 5,  
		pageList: [5,10,15],
		checkOnSelect:false,
		selectOnCheck:false, 
		remoteSort : false,
				   
		url:'../../../../website/php/action/page/apply86.act.php?action=query',
	
		columns:[[
			{field:'id',title:'id',hidden:true},
			{field:'unit',title:'应用单位名称',width:150},
			{field:'contact',title:'联系人',width:100},
			{field:'phone',title:'电话',width:150},
			{field:'startTime',title:'应用起始时间',width:150},
			{field:'endTime',title:'应用完成时间',width:150},
			{field:'benefit',title:'经济效益',width:150}
		]]
	});
	var p86 = $('#datagrid86').datagrid('getPager');			  
	$(p86).pagination({  
			pageSize: 5,  
			pageList: [5,10,15],  
			beforePageText: '第', 
			afterPageText: '页    共 {pages} 页',  
			displayMsg: '当前显示 {from} - {to} 条记录   共 {total} 条记录'  						   
	});
	
	//10--------------------------------------------------
	$('#grid10').datagrid({
		title:'主要附件信息',
		nowrap : true,//设置为true，当数据长度超出列宽时将会自动截取
		striped : true,
		collapsible : false,
		singleSelect:true,
		fitColumns:true,
		rownumbers : true,	
		checkOnSelect:false,
		selectOnCheck:false,
		pagination:true,
		pageSize: 5,  
		pageList: [5,10,15], 
				
		remoteSort : false,
		//toolbar:'#toolbar',
				   
		url:'../../../../website/php/action/page/apply10.act.php?action=query&id='+id,
	
		columns:[[
					
			{field:'id',title:'id',checkbox:true},
			{field:'title',title:'标题',width:100},
			{field:'descrip',title:'描述',width:200},
			{field:'attname',title:'附件名称',width:100},
			{field:'savepath',title:'存储路径',width:100},
			{field:'pro',title:'附件类型',width:100},
		
		]]
	});
	var p = $('#grid10').datagrid('getPager');  
	$(p).pagination({  
			pageSize: 5,  
			pageList: [5,10,15],  
			beforePageText: '第', 
			afterPageText: '页    共 {pages} 页',  
			displayMsg: '当前显示 {from} - {to} 条记录   共 {total} 条记录'  
				   
	});
}

function setTitle(score){
	if(score=='score0'){
		changTitle='知识产权<br/>情况';
	}else{
		changTitle='论文等级<br/>及篇数';
	}
}

function checkScore(id,expertCat){
	globalId=id;
	expertCat= expertCat.substring(0,expertCat.length-1);
	if(pridge=='super'){
		$.post('../../../php/action/page/applycation/apply.act.php?action=queryScoreCat',{'expertCat':expertCat},function(result){
				setTitle(result.score);
		},'json');
	}else{
		if(pridge.indexOf('score0')>=0){//评分表1
			changTitle='知识产权<br/>情况';
		}
		if(pridge.indexOf('score1')>=0){
			changTitle='论文等级<br/>及篇数';
		}
	}
	
	$('#checkScoredlg').dialog('open').dialog('setTitle','评分信息');
	
	$('#checkScore').datagrid({
		//height:250,
		nowrap : true,//设置为true，当数据长度超出列宽时将会自动截取
		striped : true,//设置为true将交替显示行背景。
		collapsible : false,//显示可折叠按钮
		singleSelect:true,//为true时只能选择单行
		fitColumns:true,//允许表格自动缩放，以适应父容器
		rownumbers : true,//行数
		pagination:true,//分页
		pageSize: 5,  
		pageList: [5,10,15], 
		checkOnSelect:false,
		selectOnCheck:false, 
					
		remoteSort : false,
		//toolbar:'#toolbar1',
				   
		url:'../../../php/action/page/applycation/apply.act.php?action=queryScore&id='+id,//url调用Action方法
		columns:[[
					
			{field:'id',title:'id',hidden:true},
			{title:'技术创新',colspan:'4'},
			{title:'经济社会效益',colspan:'3'},
			{title:'推动科技进步作用',colspan:'3'},
			{field:'property',title:changTitle,fit:true,rowspan:2},
			{field:'technology',title:'科技查新<br/>情况',fit:true,rowspan:2},
			{field:'expertId',title:'评分专家',fit:true,rowspan:2},
			{field:'action',title:'得分',width:100,rowspan:2,
				formatter:function(value,row,index){
					var a=parseInt(row.creative)+parseInt(row.scientific)+parseInt(row.difficulty)+parseInt(row.advanced)+parseInt(row.benefits)+parseInt(row.effectiveness)+parseInt(row.prospect)+parseInt(row.popularize)+parseInt(row.close1)+parseInt(row.affect)+parseInt(row.property)+parseInt(row.technology);
					return a;
				}},
		],[
			{field:'creative',title:'技术<br/>创新<br/>程度',fit:true},
			{field:'scientific',title:'科学性',fit:true},
			{field:'difficulty',title:'难以程度<br/>&nbsp;&nbsp;&nbsp;或<br/>发杂程度',fit:true},
			{field:'advanced',title:'技术经济<br/>指标的先<br/>进程度',fit:true},
			{field:'benefits',title:'已获<br/>经济<br/>效益',fit:true},
			{field:'effectiveness',title:'社会<br/>效益',fit:true},
			{field:'prospect',title:'发展前景<br/>&nbsp;&nbsp;&nbsp;及<br/>潜在效益',fit:true},
			{field:'popularize',title:'转化、<br/>应用、<br/>推广<br/>程度',fit:true},
			{field:'close1',title:'与本区经济、<br/>社会、科技发展<br/>需求的紧密<br/>程度',fit:true},
			{field:'affect',title:'对推动行业<br/>技术进步的作用',fit:true},													
		]]
	});
				
	var p = $('#checkScore').datagrid('getPager');			  
	$(p).pagination({  
			pageSize: 5,  
			pageList: [5,10,15],  
			beforePageText: '第', 
			afterPageText: '页    共 {pages} 页',  
			displayMsg: '当前显示 {from} - {to} 条记录   共 {total} 条记录'  						   
	}); 
}

function setColumn(score){
	if(score=='score0'){
		$('#scoredlg').dialog('open').dialog('setTitle','评分表1');
		$('#changeTitle').text('知识产权情况：');
	}else{
		$('#scoredlg').dialog('open').dialog('setTitle','评分表2');
		$('#changeTitle').text('论文等级及篇数：');
	}
}
function score(id,expertCat){
	if(expertCat=='.'){
		alert('请对此申报项目归类专家组');
		return;
	}
	expertCat= expertCat.substring(0,expertCat.length-1);
	$.post('../../../php/action/page/applycation/apply.act.php?action=getScore&applyId='+id,function(result){
		if(result=='error'){
			$.messager.alert('消息提示','此项目已评分','info');
		}else{
			if(pridge=='super'){
				$.post('../../../php/action/page/applycation/apply.act.php?action=queryScoreCat',{'expertCat':expertCat},function(result){
						setColumn(result.score);
				},'json');
			}else{
				if(pridge.indexOf('score0')>=0){
					$('#scoredlg').dialog('open').dialog('setTitle','评分表1');
				}
				if(pridge.indexOf('score1')>=0){
					$('#scoredlg').dialog('open').dialog('setTitle','评分表2');
					$('#changeTitle').text('论文等级及篇数：');
				}
			}
			$('#scorefm').form('clear');
			url = '/modules/php/action/page/applycation/apply.act.php?action=scoreApply&id='+id;
		}
	},'json');
}

function saveScore(){
	$('#scorefm').form('submit',{
		url:url,
		onSubmit:function(){
		},
		success:function(result){
			$('#scoredlg').dialog('close');
		}
	});
}

/*function queApply(){
	alert('queApply');
}*/

function exportExcel(flag){
	excelFlag=flag;	
	if(flag==0){
		$('#exportdlg').dialog('open').dialog('setTitle','专家组列表');
		$('#expertName').text('专家组列表：');
		$('#combo2').hide();
		$('#combo1').show();
		$("#expertList").combotree({
			url:'../../../php/action/page/applycation/applycat.act.php?action=treeData',
			onBeforeExpand:function(node){
				$(this).tree('options').url='../../../php/action/page/applycation/applycat.act.php?action=treeData&upper_id='+node.id;
			},
			onClick:function(node){
				$('#expertTeamCat').val(node.upper_cat+node.id+'.');
				//expertTeam=$('#expertTeamCat').val();
			},
			onLoadSuccess:function(node,data){
				$("#expertList").combotree('tree').tree('expandAll');
				var node=$("#expertList").combotree('tree').tree('find',0);
				$("#expertList").combotree('tree').tree('update',{target:node.target,text:'请选择专家组'});
			}
		});
	}else{
		if(upper_cat=='.'){
			alert('请选择需要导出专家的专家组');
		}else{
			var category=upper_cat.substring(0,upper_cat.length-1);
			$('#exportdlg').dialog('open').dialog('setTitle','专家列表');
			$('#combo2').show();
			$('#combo1').hide();
			$('#expertName').text('专家列表：');
			//$('#expertfm').form('clear');
			$("#expertCobox").combobox({
				url:'../../../php/action/page/applycation/applycat.act.php?action=loadExpert&upper_cat='+category,
				valueField:'id',
				textField:'text',
				onSelect: function(rec){
					expertId=rec.id;
        		}
        	});
		}
	}
}

function expertScore(){
	var expertCat=$('#expertTeamCat').val();
	$('#exportdlg').dialog('close');
	window.open('../../../php/action/page/downExcel.php?action=Excel&expertCat='+expertCat+'&flag='+excelFlag+'&expertId='+expertId);
}

function printForm(id){
	window.open('http://localhost:8088/MS-Word/application_table/getword.htm?id='+id);
}

function proState(id){
	$('#checkdlg').dialog('open').dialog('setTitle','项目状态');
	$('#upt_ProState').form('clear');
	$('#upt_ProState').form('load',{'proState':0});
	url='../../../php/action/page/applycation/apply.act.php?action=uptProState&id='+id;
}

function uptProState(){
	$('#upt_ProState').form('submit',{
		url:url,
		success:function(result){
			$('#checkdlg').dialog('close');
			$('#applygrid').datagrid('load',{'upper_cat':upper_cat});
		}
	});
}

function arrClassify(){
	
	var rows = $("#applygrid").datagrid("getChecked");
			
	if(rows.length==0){
		$.messager.alert('消息提示','请选择要归类的数据信息','info');	
	}else{
		$('#classifydlg').dialog('open').dialog('setTitle','批量归类');
		$("#expertTree").combotree({
			url:'../../../php/action/page/applycation/applycat.act.php?action=treeData',
			onBeforeExpand:function(node){
				$(this).tree('options').url='../../../php/action/page/applycation/applycat.act.php?action=treeData&upper_id='+node.id;
			},
			onClick:function(node){
				$('#expertCat').val(node.upper_cat+node.id+'.');
				expertTeam=$('#expertCat').val();
			},
			onLoadSuccess:function(node,data){
				$("#expertTree").combotree('tree').tree('expandAll');
				var node=$("#expertTree").combotree('tree').tree('find',0);
				$("#expertTree").combotree('tree').tree('update',{target:node.target,text:'请选择专家组'});
			}
		});
		list=new Array();
		for(var i=0;i<rows.length;i++){
			list[i]=rows[i].id;	
		}
	}
}

function uptClassify(){
	$.messager.confirm('消息提示','确定归类吗',function(r){
	   if (r){
			$.get('../../../php/action/page/applycation/apply.act.php?action=arrClassify&idlist='+list+'&expertTeam='+expertTeam,function(data){			
				$('#classifydlg').dialog('close');
			    $('#applygrid').datagrid('reload');
			});					 
		}
	});
}

function checkRepeat(id){
	$('#checkRepeatdlg').dialog('open').dialog('setTitle','重复项目信息');
	$('#checkRepeat').datagrid({
		nowrap : true,//设置为true，当数据长度超出列宽时将会自动截取
		striped : true,//设置为true将交替显示行背景。
		collapsible : false,//显示可折叠按钮
		singleSelect:true,//为true时只能选择单行
		fitColumns:true,//允许表格自动缩放，以适应父容器
		rownumbers : true,//行数
		pagination:true,//分页
		pageSize: 10,  
		pageList: [5,10,15,20,30], 
		checkOnSelect:false,
		selectOnCheck:false, 
					
		remoteSort : false,
				   
		url:'../../../php/action/page/applycation/apply.act.php?action=queryRepeat&id='+id,//url调用Action方法
		columns:[[
					
			{field:'id',title:'id',checkbox:true},
			{field:'aname',title:'项目名称',width:100},
			{field:'impPerson',title:'主要完成人',width:100},
			{field:'completeOrg',title:'第一完成单位',width:100},
			{field:'completePhone',title:'联系电话',width:100},
			
			{field:'action',title:'操作',width:200,align:'center',
				formatter:function(value,row,index){							
					var a='<a href="javascript:void(0)" onclick="checkApply('+row.id+')">查看信息</a>';
					return a;
				}
			}															
		]]						  
	});
				
	var p = $('#checkRepeat').datagrid('getPager');			  
	$(p).pagination({  
			pageSize: 10,  
			pageList: [5,10,15,20,30], 
			beforePageText: '第', 
			afterPageText: '页    共 {pages} 页',  
			displayMsg: '当前显示 {from} - {to} 条记录   共 {total} 条记录'  						   
	});  
}