document.write('<script type="text/javascript" src="/common/html/js/log.js"></script>');
//页面加载时 加载页面数据
var classes_all;
var isPass = '';
var isfresh ;
var userdepartment;
$(function(){
	lval = $("body").attr("cinit");
	//需要定时刷新该界面
//	var isfresh = setInterval("checkPass()",3000);
	
	loaddata(lval);
//	loaddata(lval);
	$('#select').click(function() {
		$('#select_block').dialog('open').dialog('setTitle','查询');
		$('#select_info').form("clear");
	})

	$('#check').click(function() {
		var selRows = $("#projectList").datagrid('getChecked');
		var pidArray = new Array();
		if(selRows==''){
			alert('请选择项目！');
			return;
		}
		for(var item in selRows){
			pidArray[item] = selRows[item].project_id;
		}
		//如果没有选中 提示选择
		if(pidArray.length<=0){
			$.messager.alert("提示","请选中需要审批的项目");
			return  false;
		}
		$.post('/modules/php/action/page/center/center.act.php?action=CanisCheckBatch',

				{selRows:pidArray,status:status},function(result){
							var res = JSON.parse(result);
							if(res.code==0){
								$.messager.alert("提示","你选择的项目有没有当前阶段没有提交完的，请重新选择！");
								return  false;
							}
							else if(res.code==2){
								$.messager.alert("提示","已经有审核的附件，不能批量操作！");
								return  false;
							}
							else if(res.code==3){
								$.messager.alert("提示","申报阶段 不能审核不通过！");
								return  false;
							}else if(res.code==4){
								$.messager.alert("提示","批量操作失败！");
								return  false;
							}else{
								$('#check_block').dialog('open').dialog('setTitle','批量审批');
							    $("#check_opnion").val('');	
							}
						});
	});
	loadTree();
});

 //加载树节点;
 function loadTree(){
	 $('#all_projects').tree({
		 onClick :function(node) {
			 unique_tree(node);
		 }
	 });
	 $('#store_projects').tree({
			url:'/center/php/action/page/project_list/checkinfo.php?action=treedata&index=5&project_type='+project_type,
			animate:true,
			onClick: function(node){
				unique_tree(node);
			  loadTreeData(project_type,node.text,5);
			}
		});
	 $('#nopass_projects').tree({
			url:'/center/php/action/page/project_list/checkinfo.php?action=treedata&index=1&project_type='+project_type,
			animate:true,
			onClick: function(node){
				unique_tree(node);
			  loadTreeData(project_type,node.text,1);
			}
		});

	 $('#pre_projects').tree({
		 onClick :function(node) {
			 unique_tree(node);
		 }
	 });


	 function unique_tree(node) {
		 $('.tree-node-selected').removeClass('tree-node-selected');
		 $('#' + node.domId).addClass('tree-node-selected');
	 }
}
 //树节点的点击结果;
 function loadTreeData(project_type,year,project_stage){
	 
	 $("#projectList").datagrid({
			nowrap : true,// 设置为true，当数据长度超出列宽时将会自动截取
			striped : true,// 设置为true将交替显示行背景。
			collapsible : false,// 显示可折叠按钮
			singleSelect : true,// 为true时只能选择单行
			fitColumns : true,// 允许表格自动缩放，以适应父容器
			// fit:true,
			rownumbers : true,// 行数
			pagination : true,// 分页
			remoteSort : false,
			pageSize : 15,
			pageList : [ 5, 10, 15, 20, 30 ],
			pageNumber:1,
			checkOnSelect : false,
			selectOnCheck : false,
			remoteSort : true,
			resizeHandle:true,
			toolbar:'#toolbar',
		    url : '/center/php/action/page/project_list/checkinfo.php?action=findTreeData&project_type='+project_type+"&year="+year+"&project_stage="+project_stage,

		    columns : [ [

					{
							field : 'id',
							title : '序号',
							align : 'center',
							width:10,									
							hidden:'true'	,
					},
					{
							field : 'project_id',
							title : '项目编号',
							align : 'center',
							width:10,									
							checkbox:'true'										
				    },
					{
							field : 'name',
							title : '项目名称',
							align : 'center',
							sortable:true,
							width:300,									
					},
					{
							field : 'project_stage',
							title : '项目阶段',
							sortable:true,
							align : 'center',
							width:50,									
					},
					{
							field : 'project_status',
							title : '项目状态',
							align : 'center',
							width:100,									
					},
					
					{
							field : 'org_name',
							title : '承担单位',
							align : 'center',
							width:100,									
					},
					{
							field : 'leader_name',
							title : '项目联系人',
							sortable:true,
							align : 'center',
							width:50,									
					},
					{
							field : 'leader_phone',
							title : '联系方式',
							align : 'center',
							width:50,									
					},
					{
							field : 'project_engineer',
							title : '主管工程师',
							align : 'center',
							width:50,									
					},
					{
							field : 'delegate_engineer',
							title : '代管人员',
							width:50,									
							align : 'center'
						
					},
					{
							field : 'org_code',
							title : '单位编号',
							width:50,									
							hidden:"true"
					},
					{
							field : 'action',
							title : '管理',
							width:150,									
							align : 'center',
							formatter : function(value, row,index){
								var rn = '';
								//判断是否恢复项目
								if(row.isDelete == 1){
									rn += '<a href="javascript:void(0)" onclick="recoverProject('+"'"+row.project_id+"'"+')">恢复项目</a>';;
								}else if(row.project_stage == '储存阶段'){
										rn += '<a href="javascript:void(0)" onclick="buildproject('+"'"+row.project_id+"'"+')"> 开启 </a>';
								}else{ 
									rn = '';
							    }
								return rn;
						    }
					}
			] ],
			onLoadSuccess: function (data) {
				$('.checkacc').parent().parent().parent().css('color','#f00');
	  },
	});

		var p = $("#projectList").datagrid('getPager');
		$(p).pagination({
		pageSize : 15,
		pageList : [ 5, 10, 15, 20, 30 ],
		beforePageText : '第',
		afterPageText : '页    共 {pages} 页',
		displayMsg : '当前显示 {from} - {to} 条记录   共 {total} 条记录'
		});
		$('#muti_back').css({
		'display' : 'none'
		});
		$('#back_loadPage').css({
		'display' : 'none'
		});


		$(".easyui-combobox").each(function() {
			$(this).combobox({
			url : '/center/php/action/page/authority/authority_control.php?action=queryUsers',
			valueField : 'id',
			textField : 'text'
		});
	});

}
 
 function getQueryStringByName(name) {
    var result = location.search.match(new RegExp("[\?\&]" + name + "=([^\&]+)", "i"));
    if (result == null || result.length < 1) {
        return "";
    }
    return result[1];
}
var department = getQueryStringByName('department');
var min = getQueryStringByName('min');
// 这个 不知道  
var max = getQueryStringByName('max');
//var project_type = decodeURI(getQueryStringByName('name'));
//这里已经将项目类型改成了id
var project_type = getQueryStringByName('name');
//alert(department)
$.cookie("department1",department,{path: "/"});
$.cookie("min1",min,{path: "/"});
$.cookie("max1",max,{path: "/"});
$.cookie("project_type1",project_type,{path: "/"});
//alert($.cookie("department1"))
function loaddata(classes){
	classes_all = classes;
	var prilist;
	var priTag = $("body").first().attr("roleTag"); 
	//if(classes == 11){ //审批项目
		$(".multiSetEngine").show();
	//}else{
	//	$(".multiSetEngine").hide();
	//}
	$.ajax( {  
		url:"/center/php/action/page/authority/approve_control.php?action=proCheckPriListByPtid",//
		data:{  
			project_type : project_type
		},  
		type:'post',  
		cache:false,
		async:false,
		dataType:'json',  
		success:function(data) {  
			if(data.msgcode == 200 ){
				// $('#approve').form('load',res);alert(res.project_name);
				prilist = data.ret.content; 
				userdepartment = data.ret.department;
			}else{  
				// alert(data.msgcode);
			}  
		},  
		 error : function() {
			  //alert("异常！");
		}
	});
	$("#projectList").datagrid({
							nowrap : true,// 设置为true，当数据长度超出列宽时将会自动截取
							striped : true,// 设置为true将交替显示行背景。
							collapsible : false,// 显示可折叠按钮
							singleSelect : true,// 为true时只能选择单行
							fitColumns : true,// 允许表格自动缩放，以适应父容器
							// fit:true,
							rownumbers : true,// 行数
							pagination : true,// 分页
							remoteSort : false,
							pageSize : 15,
							pageList : [ 5, 10, 15, 20, 30 ],
							pageNumber:1,
							checkOnSelect : false,
							selectOnCheck : false,
							remoteSort : true,
							resizeHandle:true,
							
//							fit : true,
							toolbar:'#toolbar',
							// url:'/center/php/action/page/authority/authority_control.php?action=queryAdmin&isDel=0',//url调用Action方法
						    url : '/center/php/action/page/project_list/checkinfo.php?action=checklist&project_type='+project_type+"&classes="+classes,
/*//							url : '/center/php/action/page/project_list/checkinfo.php?action=checklist&project_type='+project_type+'&project_id='+project_id+'&classes='+classes+'&project_name='
//							       +project_name+'&project_engineer='+project_engineer+'&leader_name='+leader_name+'&start_time='+start_time+'&end_time='+end_time,
*/							// url:'../../../../php/action/page/admin/admin.act.php?action=queryAdmin&isDel=0',
							columns : [ [
									{
											field : 'id',
											title : '序号',
											align : 'center',
											width:10,									
											hidden:'true'										
									},
									{
											field : 'project_id',
											title : '项目编号',
											align : 'center',
											width:10,									
											checkbox:'true'										
								    },
									{
											field : 'name',
											title : '项目名称',
											align : 'center',
											sortable:true,
											width:300,									
													},
									// {field:'usr',title:'用户名',width:10},
									{
											field : 'project_stage',
											title : '项目阶段',
											sortable:true,
											align : 'center',
											width:50,									
									},
									{
											field : 'project_status',
											title : '项目状态',
											//sortable:true,
											align : 'center',
											width:100,									
									},
									
									{
											field : 'org_name',
											title : '承担单位',
											align : 'center',
											sortable:true,
											width:100,									
									},
									{
											field : 'leader_name',
											title : '项目联系人',
											sortable:true,
											align : 'center',
											width:50,									
									},
									{
											field : 'leader_phone',
											title : '联系方式',
											align : 'center',
											width:50,									
									},
									{
											field : 'project_engineer',
											title : '主管工程师',
											align : 'center',
											width:50,									
									},
									{
											field : 'delegate_engineer',
											title : '代管人员',
											align : 'center',
											width:50,									
									},
									{ 
											field : 'org_code',
											title : '单位编号',
											hidden:"true",
											width:50,									
									},
									{
											field : 'action',
											title : '管理',
											align : 'center',
											width:150,									
											formatter : function(value, row,index){
//												alert(row.declare_status + row.name);
//													var b = '<a href="javascript:void(0)" onclick="detail('+"'"+row.project_id+"'"+')">|&nbsp;查看</a>';	
											var rn = '';
											if(userdepartment == 3){
												if(row.showCheck == 0 && row.showBlank == 0){
													return;
												}else{
													rn += '<a href="javascript:void(0)" onclick="setProject('+"'"+row.project_id+"'"+','+"'"+row.org_code+"'"+')">' + '查看 ' + '</a>';
												}
												return rn;
											}
											//首先判断是否需要进行查重
											//判断是否恢复项目
											if(row.isDelete == 1){
												rn += '<a href="javascript:void(0)" onclick="recoverProject('+"'"+row.project_id+"'"+')">恢复项目</a>';;
											}else if(row.project_stage == '储存阶段'){
													rn += '<a href="javascript:void(0)" onclick="buildproject('+"'"+row.project_id+"'"+')"> 开启 </a>';
											}else{
												//显示查看查重报告
												var stage_tag = true;
												//查看还是审批
												if(row.stage_val == "0" && prilist[0] == 0){
													stage_tag = false;
												}
												
												if(row.stage_val > "0" && row.is_ownPri == "0"){
													stage_tag = false;
												}
												if(row.showCheckorlook == 1 && stage_tag){
													rn += '<a href="javascript:void(0)" onclick="setProject('+"'"+row.project_id+"'"+','+"'"+row.org_code+"'"+')">' + '审核 ' + '</a>';
												}else if(row.showCheckorlook == 0){
													rn += '<a href="javascript:void(0)" onclick="setProject('+"'"+row.project_id+"'"+','+"'"+row.org_code+"'"+')">' + '查看 ' + '</a>';
												}

												if(priTag == "1" && classes == 11){
													//alert("呈现控件");
													rn += '<a href="javascript:void(0)" onclick="editEngineer('+"'"+row.project_id+"'"+')">| 修改主管工程师 </a>';
												}
												
												//立项
												if(row.showDeclare && prilist[0] == 1){ //受理人权限
													rn += '<a href="javascript:void(0)" onclick="buildproject('+"'"+row.project_id+"'"+')">| 立项 </a>';
												}
												
												//判断储备
												if(row.showStore && prilist[0] == 1){
													rn += '<a href="javascript:void(0)" onclick="setsavestage('+"'"+row.project_id+"'"+')">| 储备</a>';
												}
												//判断中期
												if(row.showMiddle && row.is_ownPri == "1" && row.showCheck != "0"){ //主管工程师权限
													rn += '<a href="javascript:void(0)" onclick="checkstage('+"'"+row.project_id+"'"+')">| 开启中期</a>';
												}
												
												//判断验收
												if(row.showAccept && row.is_ownPri == "1" && row.showCheck != "0"){
													if(row.changeColor){
														rn +="|  "+ '<a href="javascript:void(0)" class="checkacc" onclick="checkaccstage('+"'"+row.project_id+"'"+')"> 开启验收</a>';
													}else{
														rn +="|  "+ '<a href="javascript:void(0)" onclick="checkaccstage('+"'"+row.project_id+"'"+')"> 开启验收</a>';
													}
												}
												
												//判断关闭验收
												if(row.project_stage == '验收阶段' && row.is_ownPri == "1"){ 
													rn += '<a href="javascript:void(0)" onclick="closeAccept('+"'"+row.project_id+"'"+')">| 关闭验收</a>';
												}
												
												//判断存档
												if(row.showSaveFile && row.is_ownPri == "1"){
													rn += '<a href="javascript:void(0)" onclick="checksavestage('+"'"+row.project_id+"'"+')">| 项目存档</a>';	
												}
												
												if(row.showCheck == "0" && row.showCheck != null){													
														rn += '<a href="javascript:void(0)" onclick="viewResult(' + "'"+row.project_id +"'" + "," +row.showCheck +')"> | 查看查重结果</a>';
													
													//显示查看查重报告
												} else if(row.showCheck != -1 && row.showCheck != null){
													//判断是否显示下载查重报告
														rn += "<a href='"+row.pdf_url+"'> | 下载查重报告</a>";
												}
												
												if(row.showCheckorlook != -1){
													rn += '<a href="javascript:void(0)" onclick="setProject('+"'"+row.project_id+"'"+','+"'"+row.org_code+"'"+')">' + ' | 打印' + '</a>';
												}
											}
											    
												return rn;
										}
									}
							] ],
						 onLoadSuccess: function (data) {
						 	$('.checkacc').parent().parent().parent().css('color','#f00');
						  },
					  });

	var p = $("#projectList").datagrid('getPager');
	$(p).pagination({
			pageSize : 15,
			pageList : [ 5, 10, 15, 20, 30 ],
			beforePageText : '第',
			afterPageText : '页    共 {pages} 页',
			displayMsg : '当前显示 {from} - {to} 条记录   共 {total} 条记录'
	});
	$('#muti_back').css({
		'display' : 'none'
	});
	$('#back_loadPage').css({
		'display' : 'none'
	});

	/*
	 * $('#principal').combobox({ url:'/center/php/action/page/authority/authority_control.php?action=queryUsers', valueField:'id', textField:'text' });
	 */

	$(".easyui-combobox").each(function() {
		// alert(this);
		$(this).combobox({
			url : '/center/php/action/page/authority/authority_control.php?action=queryUsers',
			valueField : 'id',
			textField : 'text'
		});
	});
	
	loadTree();
}

//关闭验收;
function closeAccept(project_id){
	   $.messager.confirm("操作提示", "您确定要关闭验收吗？", function (data) {
           if (data) {
        	
        	   
        	   //开启验收操作日志	
        	   var  params=new Array(project_id);
        	   insertLogInfo("LogCloseCheck",params);
        		$.ajax({
        			url:"/center/php/action/page/project_list/checkinfo.php?action=closeAccept",
        			data:{
        				project_id:project_id,
        			},
        		    type:'post',
        		    cache:false,
        		    async:false,
        		    dataType:'json',
        		    success:function(data){
        		    	if(data.code == 1){
        		    		$.messager.alert('提示','关闭成功,申报用户数据已清空！','',function(){
        	    				$("#projectList").datagrid('reload');
        	    			});
        		    	}else{
        		    		$.messager.alert('提示','恢复失败','',function(){
        	    				$("#projectList").datagrid('reload');
        	    			});
        		    	}
        		    },
        			error: function(){
        				$.messager.alert('提示','执行失败','',function(){
        					$("#projectList").datagrid('reload');
        				});
        			}
        		});
           }
           
       });

}
//相符恢复到原来的状态;
function recoverProject(project_id){
	$.ajax({
		url:"/center/php/action/page/project_list/checkinfo.php?action=recoverProject",
		data:{
			project_id:project_id,
		},
	    type:'post',
	    cache:false,
	    async:false,
	    dataType:'json',
	    success:function(data){
	    	if(data.code == 1){
	    		$.messager.alert('提示','恢复成功','',function(){
    				$("#projectList").datagrid('reload');
    			});
	    	}else{
	    		$.messager.alert('提示','恢复失败','',function(){
    				$("#projectList").datagrid('reload');
    			});
	    	}
	    },
		error: function(){
			$.messager.alert('提示','执行失败','',function(){
				$("#projectList").datagrid('reload');
			});
		}
	});
}
//筛选数据;
function filterData(project_name,project_id,project_engineer,leader_name,start_time,end_time){
	var prilist;

	$.ajax( {  
		url:"/center/php/action/page/authority/approve_control.php?action=proCheckPriListByPtid",//
		data:{  
			project_type : project_type
		},  
		type:'post',  
		cache:false,
		async:false,
		dataType:'json',  
		success:function(data) {  
			if(data.msgcode == 200 ){
				// $('#approve').form('load',res);alert(res.project_name);
				prilist = data.ret.content; 
				userdepartment = data.ret.department;
			}else{  
				// alert(data.msgcode);
			}  
		},  
		 error : function() {
			 // alert("异常！");
		}  
	});
	$("#projectList").datagrid({
		nowrap : true,// 设置为true，当数据长度超出列宽时将会自动截取
		striped : true,// 设置为true将交替显示行背景。
		collapsible : false,// 显示可折叠按钮
		singleSelect : true,// 为true时只能选择单行
		fitColumns : true,// 允许表格自动缩放，以适应父容器
		rownumbers : true,// 行数
		pagination : true,// 分页
		remoteSort : false,
		pageSize : 15,
		pageList : [ 5, 10, 15, 20, 30 ],
		pageNumber:1,
		checkOnSelect : false,
		selectOnCheck : false,
		remoteSort : false,
		resizeHandle:true,
		toolbar:'#toolbar',
		url : '/center/php/action/page/project_list/checkinfo.php?action=filterData&project_type='+project_type+'&project_id='+project_id
		      +'&project_name='+encodeURIComponent(project_name)+'&project_engineer='+encodeURIComponent(project_engineer)+'&leader_name='
		      +encodeURIComponent(leader_name)+'&start_time='+start_time+'&end_time='+end_time+'&department='+userdepartment,
		columns : [ [

				{
						field : 'id',
						title : '序号',
						align : 'center',
						width:10,									
						hidden:'true'										
				},
				{
						field : 'project_id',
						title : '项目编号',
						align : 'center',
						width:10,									
						checkbox:'true'										
			    },
				{
						field : 'name',
						title : '项目名称',
						align : 'center',
						width:300,									
				},
				{
						field : 'project_stage',
						title : '项目阶段',
						align : 'center',
						width:50,									
				},
				{
						field : 'project_status',
						title : '项目状态',
						align : 'center',
						width:100,									
				},
				
				{
						field : 'org_name',
						title : '承担单位',
						align : 'center',
						width:100,									
				},
				{
						field : 'leader_name',
						title : '项目联系人',
						align : 'center',
						width:50,									
				},
				{
						field : 'leader_phone',
						title : '联系方式',
						align : 'center',
						width:50,									
				},
				{
						field : 'project_engineer',
						title : '主管工程师',
						align : 'center',
						width:50,									
				},
				{
						field : 'delegate_engineer',
						title : '代管人员',
						align : 'center',
						width:50,									
				},
				{
						field : 'org_code',
						title : '单位编号',
						hidden:"true",
						width:50,									
				},
				{
					field : 'action',
					title : '管理',
					align : 'center',
						width:150,									
					formatter : function(value, row,index){
						var rn = '';
						if(userdepartment == 3){
							if(row.showCheck == 0 && row.showBlank == 0){
								return;
							}else{
								rn += '<a href="javascript:void(0)" onclick="setProject('+"'"+row.project_id+"'"+','+"'"+row.org_code+"'"+')">' + '查看' + '</a>';
							}
							return rn;
						}
						//首先判断是否需要进行查重
						if(row.showCheck == 0){
							if(row.showBlank != 0){
								rn += '<a href="javascript:void(0)" onclick="viewResult(' + "'"+row.project_id +"'" + "," +row.showCheck +')">查看查重结果</a>';
							}
							//显示查看查重报告
						}else if(row.project_stage == '储存阶段'){
								rn += '<a href="javascript:void(0)" onclick="buildproject('+"'"+row.project_id+"'"+')"> 开启 </a>';
							}
							else{
							//查看还是审批
							if(row.showCheckorlook){
								rn += '<a href="javascript:void(0)" onclick="setProject('+"'"+row.project_id+"'"+','+"'"+row.org_code+"'"+')">' + '审核' + '</a>';
							}else{
								rn += '<a href="javascript:void(0)" onclick="setProject('+"'"+row.project_id+"'"+','+"'"+row.org_code+"'"+')">' + '查看' + '</a>';
							}
							
							//立项
							if(row.showDeclare && prilist[0] == 1){ //受理人权限
								rn += '<a href="javascript:void(0)" onclick="buildproject('+"'"+row.project_id+"'"+')">| 立项 </a>';
							}
							
							//判断储备
							if(row.showStore && prilist[0] == 1){
								rn += '<a href="javascript:void(0)" onclick="setsavestage('+"'"+row.project_id+"'"+')">| 储备</a>';
							}
							//判断中期
							if(row.showMiddle && row.is_ownPri == "1"){ //主管工程师权限
								rn += '<a href="javascript:void(0)" onclick="checkstage('+"'"+row.project_id+"'"+')">| 开启中期</a>';
							}
							
							//判断验收
							if(row.showAccept && row.is_ownPri == "1"){
								if(row.changeColor){
									rn += '<a href="javascript:void(0)" class="checkacc" onclick="checkaccstage('+"'"+row.project_id+"'"+')">| 开启验收</a>';
								}else{
									rn += '<a href="javascript:void(0)" onclick="checkaccstage('+"'"+row.project_id+"'"+')">| 开启验收</a>';

								}
							}
							
							//判断存档
							if(row.showSaveFile && row.is_ownPri == "1"){
								rn += '<a href="javascript:void(0)" onclick="checksavestage('+"'"+row.project_id+"'"+')">| 项目存档</a>';	
							}
							
							//判断是否有查重
							if(row.showCheck != -1){
								rn += "<a href='"+row.pdf_url+"'> | 下载查重报告</a>";
							}
							
						}
							return rn;
					}
				}
		] ],
		onLoadSuccess: function (data) {
				$('.checkacc').parent().parent().parent().css('color','#f00');
  },
});

		var p = $("#projectList").datagrid('getPager');
		$(p).pagination({
			pageSize : 15,
			pageList : [ 5, 10, 15, 20, 30 ],
			beforePageText : '第',
			afterPageText : '页    共 {pages} 页',
			displayMsg : '当前显示 {from} - {to} 条记录   共 {total} 条记录'
		});
		$('#muti_back').css({
			'display' : 'none'
		});
		$('#back_loadPage').css({
			'display' : 'none'
		});
		
		$(".easyui-combobox").each(function() {
			$(this).combobox({
			url : '/center/php/action/page/authority/authority_control.php?action=queryUsers',
			valueField : 'id',
			textField : 'text'
			});
		});
		loadTree();
}

/*
 * 用来返回项目的列表
 */
function checklist($dep_type, $min, $max, $name) {
	var department = "";
	if (!isNaN($dep_type)) {
		switch ($dep_type) {
		case 0:
			department = "发展计划科";
			break;
		case 1:
			department = "知识产权科";
			break;
		case 2:
			department = "科技综合科";
			break;
		}
	} else {
		department = $dep_type;
	}
	window.location.href = "/center/php/action/page/project_list/check_list.html?department=" + department + "&min=" + $min + "&max=" + $max + "&name=" + $name;
}


function startMid(){
	var selRows = $("#projectList").datagrid('getChecked');
	var pidArray = new Array();
	if(selRows==''){
		alert('请选择项目！');
		return;
	}
	for(var item in selRows){
		pidArray[item] = selRows[item].project_id;
	}
	$.post('/modules/php/action/page/center/center.act.php?action=isopenMiddle',{selRows:pidArray},function(result){
		var res = JSON.parse(result);
		var str = '';
		var canOpen = res.canOpen;
		var noMiddle = res.noMiddle;
		var notCarray = res.notCarray;
		if(res.code != 0){
			if(notCarray != null){
				for(var item in notCarray){
					str += notCarray[item].project_name + "，";
				}
				$.messager.alert("提示",str + "\n" + "  以上项目没有实施阶段，无法开启中期报告，请检查项目流程！");
			}else if(noMiddle != null){
				for(var item in noMiddle){
					str += noMiddle[item].project_name + "，";
				}
				$.messager.alert("提示",str + "\n" + "  以上项目没有中期报告，或者中期报告已经提交，无法正常开启中期报告，请检查！");
			}
		}else{
			if(res.status != 1){
				$.messager.alert("提示","插入失败");
			}else{
				$.messager.alert("提示","开启成功！","",function(){
			      	  insertLogInfo("LogOpenMid",pidArray);
					$("#projectList").datagrid('reload');
				});
			}
		}
	});

}
 
/**
 * 批量审批
 */
function batchCheck(status){

	//获取所有的project_id
	var selRows = $("#projectList").datagrid('getChecked');
	var pidArray = new Array();
	for(var item in selRows){
		pidArray[item] = selRows[item].project_id;
	}
	//获取审核意见
	var check_opnion=$("#check_opnion").val();
	//关闭弹出窗口
	$('#check_block').dialog('close');
	 $.messager.confirm("操作提示", "您确定要批量操作吗？", function (data) {
		 
         if (data) {
        	 logBathCheck(pidArray,status);
        		$.post('/modules/php/action/page/center/center.act.php?action=isCheckBatch',{selRows:pidArray,check_opnion:check_opnion,status:status},function(result){
        			var res = JSON.parse(result);
        		if(res.code==0){
        			$.messager.alert("提示","你选择的项目有没有当前阶段没有提交完的，请重新选择！");
        		}
        		else if(res.code==2){
        			$.messager.alert("提示","已经有审核的附件，不能批量操作！");
        		}
        		else if(res.code==3){
        			$.messager.alert("提示","申报阶段 不能审核不通过！");
        		}else if(res.code==4){
        			$.messager.alert("提示","批量操作失败！");
        		}
        		else{
        			$.messager.alert("提示","批量操作成功！");
        			$("#projectList").datagrid('reload');
        		}

        	});
         }
         
     });


}
/**
 * 批量审批 操作日志入库
 */
function logBathCheck(pidArray,zt){
	$.post('/center/php/action/page/log.act.php?action=logBathCheck',{selRows:pidArray,status:zt},function(result){
		
		
	});
}
function startHarvest(){
	var selRows = $("#projectList").datagrid('getChecked');
	var pidArray = new Array();
	if(selRows==''){
		alert('请选择项目！');
		return;
	}
	for(var item in selRows){
		pidArray[item] = selRows[item].project_id;
	}
	$.post('/modules/php/action/page/center/center.act.php?action=isopenAcc',{selRows:pidArray},function(result){
		var res = JSON.parse(result);
		var str = '';
		var noAcc = res.noAcc;
		var notOpen = res.notopen;
		var right = res.right;
		if(res.code != 0){
			if(noAcc != null){
				for(var item in noAcc){
					str += noAcc[item].project_name + "，";
					
				}
				$.messager.alert("提示",str + "\n" + "  以上项目没有验收阶段，无法开启验收操作，请检查项目流程");
			}else if(notOpen != null){   //没有验收阶段
				for(var item in notOpen){
					str += notOpen[item].project_name + "，";
				}
				$.messager.alert("提示",str + "\n" + "以上项目还有表单没有审核通过，暂时不能开启验收，请检查项目审核情况");
			}
		}else{
			if(res.status != 1){
				$.messager.alert("提示","插入失败");
			}else{
				$.messager.alert("提示","开启成功！","",function(){
					$("#projectList").datagrid('reload');
				});
				
			}
		}
		
	});
	
}

//导出为Excel
function exportExcel(){
	var selRows = $("#projectList").datagrid('getChecked');
	console.log(selRows);
	if(selRows.length == 0){
		 $.messager.alert("提示","请选择要导出的数据","info");
	}else{
		var pidArray = new Array();
		for(var i=0;i<selRows.length;i++){
			console.log(selRows[i].project_id);
			pidArray[i] = selRows[i].project_id;
		}
		   //导出excel日志
		   var  params=new Array(pidArray);
     	   insertLogInfo("LogExportExcel",params);
		$.get('/extends/excel/excel_projectsum.php?selRows='+pidArray,function(result){
			    window.location.href = result;
		});
	}
}
/**
 * 审批权限转让
 * */
function priTransfer(){
	var obj = $("#checkPriDlg");

	var t_str;
	var k = 0;
	$("input[name='project_id']").each(function(){
		if($(this).is(":checked"))
		{
			if(t_str == null){
				t_str = $(this).attr('value');
			}else{
				t_str += "|"+$(this).attr('value');
			}
			k++;
		}
	});

	var pids = t_str;

	if(t_str == null){
		alert('请选择需要操作的数据！');
		return;
	}
	$('#checkPri-linkbutton').css({'display':'block'});
	$('#checkPri').datagrid({
		url:'/center/php/action/page/project_type/control.php?action=getUser',
		columns:[[
			{field:'user_id',title:'主管工程师',width:20,formatter:function(value,row,index){
				var rn = '<input type="checkbox" name="engineer" uid="'+row.user_id+'" pids="'+pids+'">';
				return rn;
			}},
            {field:'realname',title:'真实姓名',width:40}
		]]
	});

	obj.dialog({
		title: '审批权限设置',
		width: 400,
		height: 220,
		open: true,
		cache: false,
		//href: url,
		modal: true
	});
}

/**
 * 取消主管工程师转让权限
 */
function cancelUserForDialog(){
	
	$("#checkPriDlg input[name='engineer']").each(function(){
        if($(this).is(":checked")){
            $(this).prop("checked",false);
        }
    });
	
	checkUserForDialog();
}

/**
 * 保存主管工程师转让权限
 */
function checkUserForDialog(){

    var val_owner = new Array();
    var pids = "";

    var selRows = $("#projectList").datagrid('getChecked');
    var pidArray = new Array();
    for(var item in selRows){
        pidArray[item] = selRows[item].project_id;
        if(selRows[item].is_owner == "0"){
            var msg = "您不是《"+selRows[item].name+"》项目主管，无权进行此操作！";
            $.messager.alert("提示",msg);
            return;
        }
    }

    $("#checkPriDlg input[name='engineer']").each(function(){
        if($(this).is(":checked")){
            val_owner.push($(this).attr("uid"));
        }
        pids = $(this).attr("pids");
    });

    var url = "/center/php/action/page/authority/approve_control.php?action=proUserPriSpecial";
    url += "&val_owner="+val_owner.join("|")+"&pids="+pids;

    $.ajax({
        url : url,
        async : false,
        type : "POST",
        dataType : "json",
        success : function(result) {
            var res = result;
            //console.log(status);
            //alert(res.msgcode+'hhhhh');
            if (status) {
                if(res.msgcode >= 100){
                    if (res.msgcode == 101){
                        alert("权限已存在。");
                    }
                }else{ //写入失败
                    alert("权限赋予失败，请重试！");
                }
            }else{
                if(res.msgcode == 100){
					alert(pids);
                    //obj.parent().css("color","#000");
                }else{ //写入失败
                    alert("权限变更失败，请重试！");
                }
            }
        }
    });
   // window.location.reload();
}

/**
 * 开启立项流程 //科长操作
 */
function checkProgram(){
    var selRows = $("#projectList").datagrid('getChecked');
    var pidArray = new Array();
	if(selRows==''){
		alert('请选择项目！');
		return;
	}
    for(var item in selRows){
        pidArray[item] = selRows[item].project_id;
    }
    $.post('/center/php/action/page/project_list/control.php?action=checkAcc',{selRows:pidArray},function(result){
        var res = JSON.parse(result);
        if(res.msgcode == 200){
            $("#projectList").datagrid('reload');
        }else{
            $.messager.alert("提示","审批失败");
        }
    });
}


function changeMid(project_id) {
	$.get('/modules/php/action/page/center/center.act.php?action=OpenMid&project_id='
					+ project_id,function(result) {
				var res = eval("(" + result + ")");
				$('#user_project').form('load',res);

			});
}
//开启中期报告
function checkstage(project_id) {
	$.messager.confirm('确认','您确认开启中期吗？',function(r){
	    if (r){    
	    	//开启中期日志
	       var  params=new Array(project_id);
      	   insertLogInfo("LogOpenMid",project_id);
	    	$.get('/modules/php/action/page/center/center.act.php?action=OpenMid'+"&project_id=" + project_id,function(result) {
	    		if (result != 0) {
					$.messager.alert("提示","工作中期报告开启成功","",function(){
	    				$("#projectList").datagrid('reload');
	    				sendmsg(project_id);
	    			});
	    		}
	    	}); 
	    }    
	}); 
}

// 开启验收阶段的open
function checkaccstage(project_id) {
	//这个地方需要判断是否有中期报告以及中期报告的状态。
	/*
	 * 0:中期计划表为空
	 * 1:中期报告为待提交或者驳回状态的状态
	 * 2：中期报告为审核中的状态
	 */
	$.get('/modules/php/action/page/center/center.act.php?action=MidStatus' + "&project_id=" + project_id,function(result){
		var res = JSON.parse(result);
		var str = "";
		switch(res.code){
			case 1:
				str = "是否跳过 ‘项目工作中期报告’ 直接进入验收阶段？";break;
			case 2:
				str = " ‘项目工作中期报告’ 还未审核，是否跳过审核直接进入验收阶段？";break;
			default:
				str = "确定开启验收阶段？";
		}
		if(res.code == 3){
			str =" ‘项目调整报告’ 还在处理中，不能开启验收";
			$.messager.alert("提示",str);
			return;
		}
		
	
		
//		if(res.code == 1 || res.code == 2){
			$.messager.confirm('确定',str,function(r){
			    if (r){
			    	   //开启验收操作日志	
		        	   var  params=new Array(project_id);
		        	   insertLogInfo("LogOpenCheck",project_id);
			    	 
			    	$.get('/modules/php/action/page/center/center.act.php?action=OpenAcc'
			    			+ "&project_id=" + project_id,function(result) {
			    		if (result != 0) {
//			    			alert("开启成功");
			    			$.messager.alert('提示','开启成功','',function(){
//			    				window.location.reload(); david modify
			    				$("#projectList").datagrid('reload');
			    				
			    				sendmsg(project_id);
			    			});
			    		}

			    	});
			    }
			});
//		}
	});
}

//项目存档函数 2015.12.13
function checksavestage(project_id) {
	$.messager.confirm('确认','您确认要存档吗？',function(r){
		if(r){
			/*var myDate = new Date();
			var year = myDate.getFullYear();
			var str = '';
			for(i=year-10;i<year+10;i++) {
				str += "<option value='"+i+"'>"+i+"</option>";
			}
			$('#save_year_select').append(str);
			$("#save_year").dialog('open').dialog('setTitle','选择年份');
			$('#project_id_year').val(project_id);*/
			$.get('/modules/php/action/page/center/center.act.php?action=Opensave'
					+ "&project_id=" + project_id,function(result) {
				if (result > 0) {
					$.messager.alert("提示",'存档成功！','info',function(){
						$("#projectList").datagrid('reload');
					});
				}
				else
				{
					$.messager.alert("提示","您还有表单没有审核通过！请先审核！",'info',function(){
						$("#projectList").datagrid('reload');
					});
					
				}

			});
		}
	});
}



function openAccet($project_id) {
	$.messager.confirm('确认','您确定要开启吗？',function(r){
		if(r){
			$.get('/modules/php/action/page/center/center.act.php?action=OpenAccet'
					+ "&project_id=" + $project_id,function(result) {
				if (result != 0) {
					alert("开启成功");
					//david modify
					$("#projectList").datagrid('reload');
				}
			});
		}
	});
}

function detail(obj) {

	$.post("/modules/php/action/page/projectapp/projectapp.act.php?action=findProInfoB&project_id="+obj,function(data) {
		// 解析json
		var res = eval("(" + data + ")");
		$('#fm1').form('load',res);
		$('#fm2').form('load',res)
	});
	
	$('#dlg').dialog('open').dialog('setTitle','项目基本信息');

}

//开启立项
function buildproject(obj) {
	$.messager.confirm('确认','您确定要开启吗？',function(r){
		if(r){
			$.post("/modules/php/action/page/projectapp/projectapp.act.php?action=findProInfoB&project_id="+obj,function(data) {
				// 解析json
				var res = eval("(" + data + ")");
				// $('#approve').form('load',res);alert(res.project_name);
				// 如果回来的话 就在这里给窗口赋值
				$('#fm3').form('load',res);
				$('#project_engineer').combobox({
					valueField:'value',
					textField:'text',
					url:'/modules/php/action/page/center/center.act.php?action=findengineer&project_id='+obj
				});
/*				$.post('/modules/php/action/page/center/center.act.php?action=buildEmail',{project_id:obj},function(result){
					
				});*/
				
			});
			$('#setproject').dialog('open').dialog('setTitle','填写项目基本信息');
			//需要发送邮件
		}
	});
}

function buildproject_save() {
	$('#fm3').form('submit',{
		url:'/modules/php/action/page/projectapp/projectapp.act.php?action=saveProInfo',
		success:function(result){
			var res = JSON.parse(result);
			$('#setproject').dialog('close');
			
			//入库查重的状态;
		  /*var url = 'localhost';
			var username = 'fred';
			var password = '123456';
			var database = 'check';
			$.post('/modules/php/action/page/center/center.act.php?action=addCheck&project_id='+res.project_id+'&url='+url+'&username='+username+'&password='+password+'&database='+database,function(data){
				var res = JSON.parse(data);
				if(res.check == true){
					$.messager.alert("提示","查重更改","info");
				}else{
					$.messager.alert("提示","查重失败","error");
				}
			});*/
			
			sendEmailandSms(res.project_id);
			   //立项操作日志	
     	   var  params=new Array(res.project_id);
     	   insertLogInfo("LogBuildProject",params);
//			window.location.reload(); david  modify
//			$("#projectList").datagrid('reload');
			
		}
	});
	
	
	
	
}

//立项阶段的发送邮件和信息;
function sendEmailandSms(project_id){
	$.post("/modules/php/action/page/projectapp/projectapp.act.php?action=sendEmailandSms&project_id_emsm="+project_id,function(result){
		$("#projectList").datagrid('reload');
	});
	sendmsg(project_id);
}

function setProject($project_id,$org_code){
	$.get('../../page/setProject.php?project_id='+$project_id+"&org_code="+$org_code,function(result){

		if(result == 0){
			window.location.href = "../../page/approve.php?min="+min+"&max="+max+"&name="+project_type+"&department="+department + "&userdepartment="+userdepartment;
		}
		else{
			alert("wrong");
		}
	});
}

/**
 * 编辑主管工程师
 * @param project_id
 */
function editEngineer(project_id){
	$('#fitem-linkbutton').css({'display':'block'})
	$('#project_engineer_edit').combobox({
		valueField:'value',
		textField:'text',
		url:'/modules/php/action/page/center/center.act.php?action=findengineer&project_id='+project_id
	});
	$('#setEngiDlg').dialog('open').dialog('setTitle','设置主管工程师');
	$('#setEngiDlg').attr("pid",project_id);

	return;
}


/**
 * 设置主管工程师
 */

function setEngiForDialog(){

	var project_engineer = $("input[name='peEdit']").val();
	var project_id = $('#setEngiDlg').attr("pid");

	$.ajax( {
		url:"/center/php/action/page/project_list/control.php?action=editProEngi",//
		type:'POST',
		data:{
			'project_id':project_id,
			'project_engineer':project_engineer
		},
		cache:false,
		async:false,
		dataType : "json",
		success:function(data){
			if(data.msgcode == 300){
				//return;
				$('#setEngiDlg').dialog('close');
				$("#projectList").datagrid('reload');
			}else{
				$.messager.alert("提示","设置失败,请重试!");
			}
		},
		error:function(data) {
			$.messager.alert("提示","系统错误，请查找管理员");
		}
	});

}

/**
 * 批量编辑主管工程师
 */
function multiSetEngine(){
	$('#fitem-linkbutton').css({'display':'block'});
	var project_ids;
	var project_id;

	var selRows = $("#projectList").datagrid('getChecked');
	var pidArray = new Array();
	if(selRows==''){
		alert('请选择项目！');
		return;
	}
	for(var item in selRows){
		pidArray[item] = selRows[item].project_id;
		project_id = selRows[item].project_id;
	}

	project_ids = pidArray.join('|');

	if(project_id == null){
		return;
	}

	$('#project_engineer_edit').combobox({
		valueField:'value',
		textField:'text',
		url:'/modules/php/action/page/center/center.act.php?action=findengineer&project_id='+project_id
	});
	$('#setEngiDlg').dialog('open').dialog('setTitle','设置主管工程师');
	$('#setEngiDlg').attr("pid",project_ids);

	return;

}

function setsavestage(id) {
	$.messager.confirm('确认','您确定要储备该项目吗？',function(r){
		if(r){
			$.post("/modules/php/action/page/projectapp/projectapp.act.php?action=setsavestage&project_id="+id,function(data) {
				if(data){
//					$.post('/modules/php/action/page/center/center.act.php?action=saveEmail',{project_id:id},function(result){
					$.messager.alert("提示","已将项目转为储存状态","",function(){
						$("#projectList").datagrid('reload');
						$('#store_projects').tree('reload');
					});
//					});
				}
			});
		}
	});
}

function select() {
	var project_name = $('#project_name_select').val();
	var project_id = $('#project_id_select').val();
	var project_engineer = $('#project_engineer_select').val();
	var leader_name = $('#leader_name_select').val();
	var start_time = $("input[name='start_time_select']").val();
	var end_time = $("input[name='end_time_select']").val();
	filterData(project_name,project_id,project_engineer,leader_name,start_time,end_time);
	
	$('#select_block').dialog('close');
}

/*
 *发送单条信息 
 * */
function sendmsg(project_id){
	$.post("/center/php/action/page/sms/sms.act.php?action=sendmsg&project_id="+project_id,function(result){
		var res = JSON.parse(result);
		if(res.success == true){
			$.messager.alert("提示","短信发送成功");
		}else if(res.success == false){
			$.messager.alert("提示","短信发送失败");
		}else {
			if(res.code == "fail"){
				$.messager.alert("提示","操作失败");
			}
		}
	});
}

//打开短信;
function openEditSms(){
	$('#editSms').dialog('open');
	$('#smsInfo').form("clear");
}

/*
 * 批量发送短信;
 * */
function sendSms(){
	var selRows = $("#projectList").datagrid('getChecked');
	if(selRows.length == 0){
		$.messager.alert("提示","请选择发送的联系人");
	}else{
		var i;
		var list = Array();
		for(i=0;i<selRows.length;i++){
			list[i] = selRows[i].project_id;
		}
		var sms_context = $('#sms_context').val();
		$.post("/center/php/action/page/sms/sms.act.php?action=preSendSms&list="+list+"&smscontext="+sms_context,function(result){
			$('#editSms').dialog('close');
			var res = JSON.parse(result);
	        if(res.success == true){
	        	//$.messager.alert("提示","短信发送未结束或有失败");
	        	$.messager.alert("提示","短信发送全部成功");
	        	/*var str = '';
	        	var j;
	        	var arr = res.context;
	        	for(j=0;j<arr.length;j++){
	        		str = arr[j]['project_name']+"项目的联系人"+arr[j]['realname']+"电话号为"+arr[j]['phone']+"没有发送成功";
	        	}
	        	$.messager.alert("提示",str);*/
	        }else if(res.success == false){
	        	$.messager.alert("提示",res.message);
						var id = res.data['id'];
						$.post('/center/php/action/page/sms/sms.act.php?action=failSend&id='+id,function(result){
							   var res = JSON.parse(result);
								 var str = '';
	        	     var j;
	        	     for(j=0;j<res.length;j++){
	        					str = str + "项目的联系人"+res[j]['linkman']+"    电话号为"+res[j]['phone']+"没有发送成功;<br>";
	        	}
	        	$.messager.alert("提示",str);      
							});
	        }else{
	        	$.messager.alert("提示","执行失败");
	        }
	        if(res.success == true){
	        	 var  params=new Array(list);
	        	   insertLogInfo("LogSendSms",params);
	        }
		});
	}
} 

function viewResult(project_id,isPass_status){
	//首先需要获得当前项目的查重状态
	clearInterval(isfresh);
	$.get('/modules/php/action/page/center/center.act.php?action=passStatus&project_id=' + project_id,function(result){
		var res = JSON.parse(result);
		if(res.code == 0){
			$.messager.alert("提示","没有该项目的查重信息，请联系管理员！");
		}else{
			isPass = isPass_status;
			//首先需要进行循环函数
//			alert(isPass);
			isfresh = setInterval("checkPass(" + "'" + project_id + "'" + ")",3000);
			$.ajax( {
				url:"/extends/chachong/api.php?action=status&project_id=" + project_id,// 
				type:'GET',
				cache:false,
				async:false,
				success:function(data){
					if(data == 1){
						$.get('/modules/php/action/page/center/center.act.php?action=checkHtml&project_id=' + project_id,function(result){
//							window.open(result);
							var myDate = new Date();
							var	opentime=myDate.getTime();
							window.open(result+'?t='+opentime);
						});
					}else{
						$.messager.alert("提示","正在查重中，请稍后。。。");
					}
				},
				 error:function(data) {
					    $.messager.alert("提示","系统错误，请查找管理员");
				}  
			});
		}
	});
}

function checkPass(project_id){
//	alert(isPass_status);
	$.get('/modules/php/action/page/center/center.act.php?action=passStatus&project_id=' + project_id,function(result){
		var res = JSON.parse(result);
		if(res.code == 0){
			$.messager.alert("提示","没有该项目的查重信息，请联系管理员！");
		}else{
			//如果状态信息不同，则需要重新刷新界面
/*			alert("res.pass" + res.pass);
//			alert("isPass_status" + isPass_status);*/
//			console.log(isPass_status);
			if(res.pass != isPass){
				isPass = res.pass;
				$("#projectList").datagrid('reload');
//				clearInterval(isfresh);
			}else if(res.pass == 1 && isPass == 1){
				clearInterval(isfresh);
			}
		}
//		isPass = res.pass;
	});
}