/**
author:Gao Xue
date:2014-07-11
*/
var id;
$(function(){
	id=$._GET('id');
	$.get('../../../../modules/php/action/page/applycation/apply.act.php?action=findApply&id='+id,function(result){
		var res=eval("("+result+")");
		$('#impPerson').html(res.impPerson);
		$('#completeOrg').html(res.completeOrg);
		$('#completeAdress').html(res.completeAdress);
		$('#application').form('load',res);
	});
	
	$.get('../../../../modules/php/action/page/applycation/apply.act.php?action=findBrief&id='+id,function(result){
		var res1=eval("("+result+")");
		if(res1.proBrief==null&&res1.proBrief==''){
			$('#proBrief').val('尚未填写');
		}else{
			$('#brief').form('load',res1);
		}
	});
	
	$.get('../../../../modules/php/action/page/applycation/apply.act.php?action=findCreate&id='+id,function(result){
		var res2=eval("("+result+")");
		if(res2.proCreat==null&&res2.proCreat==''){
			$('#proCreat').val('尚未填写');
		}else{
			$('#create').form('load',res2);
		}
	}); 
	
	$('#grid').datagrid({
		nowrap : true,//设置为true，当数据长度超出列宽时将会自动截取
		striped : true,
		collapsible : false,
		singleSelect:true,
		fitColumns:true,
		//rownumbers : true,
		checkOnSelect:false,
		selectOnCheck:false, 
		remoteSort : false,
		toolbar:'',			   
		url:'../../../php/action/page/apply4.act.php?action=queryBenefit&aid='+id,
		columns:[[
			//{field:'id',title:'id',checkbox:true},
			{field:'id',title:'id',hidden:true},
			{field:'year',title:'年份',width:100},
			{field:'income',title:'新增销售收入',width:180},
			{field:'profit',title:'新增利润',width:180},
			{field:'tax',title:'新增税收',width:180},
			{field:'foreignCurrency',title:'创收外汇（美元）',width:180},
			{field:'totalSavings',title:'节支总额',width:180},
			/*{field:'action',title:'操作',width:120,align:'center',
				formatter:function(value,row,index){
					var a='<a href="javascript:void(0)" onclick="showForm('+row.id+')">编辑</a>';
					var b=' | '+'<a href="javascript:void(0)" onclick="deleteBen('+row.id+')"> 删除</a>';
					return a+b;					
				}
			}*/				
		]]
	});
	var p = $('#grid').datagrid('getPager');  
	$(p).pagination({  
			pageSize: 5,  
			pageList: [5,10,15],  
			beforePageText: '第', 
			afterPageText: '页    共 {pages} 页',  
			displayMsg: '当前显示 {from} - {to} 条记录   共 {total} 条记录'  
				   
	});
	
	$.get( '../../../php/action/page/apply4.act.php?action=show&aid='+id,function(data){
		if(data!='0'){
			$('#showDiv1').show();
			$('#showDiv').hide();
			var res=eval("("+data+")");
        	//$('#f').form('load',res);
			$('#background').html(res.background);
			$('#scienceCon').html(res.scienceCon);
			$('#extend').html(res.extend);
			$('#effect').html(res.effect);
			$('#casculBasis').html(res.casculBasis);
			$('#economicBenefit').html(res.economicBenefit);
			$('#socialeffect').html(res.socialeffect);
		}else{
			$('#showDiv1').hide();
			$('#showDiv').show();
		}
   });
	
	$('#datagrid5').datagrid({
		//title:'本项目曾获科技奖励情况',
		nowrap : true,//设置为true，当数据长度超出列宽时将会自动截取
		striped : true,//设置为true将交替显示行背景。
		collapsible : false,//显示可折叠按钮
		singleSelect:true,//为true时只能选择单行
		fitColumns:true,//允许表格自动缩放，以适应父容器
		rownumbers : true,//行数
		pagination:true,//分页
		pageSize: 15,  
		pageList: [5,10,15],
		checkOnSelect:false,
		selectOnCheck:false, 
		remoteSort : false,
				   
		url:'../../../php/action/page/apply5.act.php?action=query&id='+id,//url调用Action方法
		columns:[[
			{field:'id',title:'id',hidden:true},
			{field:'awardName',title:'项目名称',width:200},
			{field:'awardTime',title:'获奖时间',width:200},
			{field:'awardName',title:'奖励名称',width:200},
			{field:'awardGrade',title:'奖励等级',width:200},
			{field:'depart',title:'授奖部门',width:200}		
		]]						  
	});
				
	var p = $('#datagrid5').datagrid('getPager');			  
	$(p).pagination({  
			pageSize: 15,  
			pageList: [5,10,15],  
			beforePageText: '第', 
			afterPageText: '页    共 {pages} 页',  
			displayMsg: '当前显示 {from} - {to} 条记录   共 {total} 条记录'  						   
	});  
	
	
	$('#datagrid6').datagrid({
		//title:'主要完成单位情况',
		nowrap : true,//设置为true，当数据长度超出列宽时将会自动截取
		striped : true,
		collapsible : false,
		singleSelect:true,
		fitColumns:true,
		rownumbers : true,
		pagination:true,
		pageSize: 15,  
		pageList: [5,10,15],
		checkOnSelect:false,
		selectOnCheck:false,
		remoteSort : false,
		url:'../../../php/action/page/apply6.act.php?action=query&id='+id,
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
			pageSize: 15,  
			pageList: [5,10,15],  
			beforePageText: '第', 
			afterPageText: '页    共 {pages} 页',  
			displayMsg: '当前显示 {from} - {to} 条记录   共 {total} 条记录'  						   
	});
	
	$('#datagrid7').datagrid({
		//title:'主要完成人情况',
		nowrap : true,//设置为true，当数据长度超出列宽时将会自动截取
		striped : true,
		collapsible : false,
		singleSelect:true,
		fitColumns:true,
		rownumbers : true,
		pagination:true,
		pageSize: 15,  
		pageList: [5,10,15],
		checkOnSelect:false,
		selectOnCheck:false,
		remoteSort : false,
		url:'../../../php/action/page/apply7.act.php?action=query&id='+id,
	
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
			pageSize: 15,  
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
		pagination:true,
		pageSize: 15,  
		pageList: [5,10,15],
		checkOnSelect:false,
		selectOnCheck:false, 
		remoteSort : false,
				   
		url:'../../../php/action/page/apply81.act.php?action=query&id='+id,
	
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
			pageSize: 15,  
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
		pagination:true,
		pageSize: 15,  
		pageList: [5,10,15],
		checkOnSelect:false,
		selectOnCheck:false, 
		remoteSort : false,
				   
		url:'../../../php/action/page/apply82.act.php?action=query&id='+id,
	
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
			pageSize: 15,  
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
		pagination:true,
		pageSize: 15,  
		pageList: [5,10,15],
		checkOnSelect:false,
		selectOnCheck:false, 
		remoteSort : false,
				   
		url:'../../../php/action/page/apply83.act.php?action=query&id='+id,
	
		columns:[[
			{field:'id',title:'id',hidden:true},
			{field:'name',title:'标准名称',width:150},
			{field:'category',title:'类别',width:100},
			{field:'standardNo',title:'标准号/备案号',width:150}
		]]
	});
	var p83 = $('#datagrid83').datagrid('getPager');			  
	$(p83).pagination({  
			pageSize: 15,  
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
		pagination:true,
		pageSize: 15,  
		pageList: [5,10,15],
		checkOnSelect:false,
		selectOnCheck:false, 
		remoteSort : false,
				   
		url:'../../../php/action/page/apply84.act.php?action=query&id='+id,
	
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
			pageSize: 15,  
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
		pagination:true,
		pageSize: 15,  
		pageList: [5,10,15],
		checkOnSelect:false,
		selectOnCheck:false, 
		remoteSort : false,
				   
		url:'../../../php/action/page/apply85.act.php?action=query&id='+id,
	
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
			pageSize: 15,  
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
		pagination:true,
		pageSize: 15,  
		pageList: [5,10,15],
		checkOnSelect:false,
		selectOnCheck:false, 
		remoteSort : false,
				   
		url:'../../../php/action/page/apply86.act.php?action=query&id='+id,
	
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
			pageSize: 15,  
			pageList: [5,10,15],  
			beforePageText: '第', 
			afterPageText: '页    共 {pages} 页',  
			displayMsg: '当前显示 {from} - {to} 条记录   共 {total} 条记录'  						   
	}); 
	
	$.get('../../../php/action/page/apply9.act.php?action=query&id='+id,function(result){
		var res2=eval("("+result+")");
		if(res2.content==''&&res2.content==null){
			$('#unitService').html('尚未填写意见');
		}else{
			$('#unitService').html(res2.content);
		}
	});
	
	$('#datagrid10').datagrid({
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
		url:'../../../php/action/page/apply10.act.php?action=query&id='+id,
	
		columns:[[
			{field:'id',title:'id',checkbox:true},
			{field:'title',title:'标题',width:100},
			{field:'descrip',title:'描述',width:200},
			{field:'attname',title:'附件名称',width:100},
			{field:'savepath',title:'存储路径',width:100},
			{field:'pro',title:'附件类型',width:100},
		
		]]
	});
	var p10 = $('#datagrid10').datagrid('getPager');  
	$(p10).pagination({  
			pageSize: 5,  
			pageList: [5,10,15],  
			beforePageText: '第', 
			afterPageText: '页    共 {pages} 页',  
			displayMsg: '当前显示 {from} - {to} 条记录   共 {total} 条记录'  
				   
	});  
});