document.write('<script type="text/javascript" src="/common/html/js/log.js"></script>');
var keyid='';
function show(obj) {
	row =obj;
	var time = $('#admingrid').datagrid('getData').rows[obj].date;
	keyid = $('#admingrid').datagrid('getData').rows[obj].id;
	var accp_url = '/center/php/action/page/project_type/control.php?action=getCheckPri&ptid='+keyid;
	var acc_val = new Array();
	$('#acceptor').combobox({
		url:accp_url,
		valueField:'user_id',
		textField:'realname',
		multiple:true, multiline:true,
		onSelect: function(rec){
			checkPart(rec.user_id,1,0,keyid);
		},
		onUnselect: function(rec){
			//var url = 'get_data2.php?id='+rec.id;
			checkPart(rec.user_id,0,0,keyid);
			//$('#acceptor').combobox('reload', accp_url);
		},
		onLoadSuccess:function(res){
			for(item in res) {
				if(res[item].assignee == "1"){
					acc_val.push(res[item].realname);
				}

			}
			//alert(acc_val);
			$('#acceptor').combobox('setValues', acc_val);
		}
	});
//	alert("keyid:" + keyid);
	if(time!=null){
	$('#start').datebox('setValue',time.split("——")[0]);
	$('#end').datebox('setValue',time.split("——")[1]);
	}
	$('#dlg').dialog('open').dialog('setTitle','选择日期');
	//$('#dlg').dialog('open').dialog('setTitle','选择日期');
}

//设置相应行的 日期
function setdate() {
	var start = $('#start').datebox('getValue');
	var end = $('#end').datebox('getValue');
	if (start == "") {
		start = "未指定";
	}
	if (end == "") {
		end = "未指定";
	}
	var s_time = new Date(start).getTime();
	var e_time = new Date(end).getTime();
	if(s_time >= e_time) {
		alert("截止日期不能早于或等于开始日期！");
	} else {
		$('#dlg').dialog('close');
		var date = start + "——" + end;
		// 设置本行的 开始时间 和 截止时间field : 'date', title : '项目开启/截止时间',
		$('#admingrid').datagrid("updateRow",{
				index : row,
				row : {
					date : date
				}
		})
//		alert("openProject");
		openProject(keyid,start,end);
	}
	
}

//开启项目
function openProject(keyid,start_time,end) {
//	alert("openProject inner");
	if (start_time !="未指定") {
		$.ajax({
						url : "/center/php/action/page/authority/authority_control.php",
						data : {
								'action' : 'open',
								'type_id' : keyid,
								'start_date' : start_time,
								'end_date' : end
						},
						type : 'POST',
						dataType : 'text',
						success : function(data) {
							$("#admingrid").datagrid('reload');
							   var  params=new Array(keyid);
				        	   insertLogInfo("LogOpenProject",params);
						},
						error : function(data) {
							alert("错误请联系管理员！");
						}
				});
	} else {
		alert("请填写项目开始日期！");
	}
 $.post("/center/php/action/page/authority/authority_control.php",{action:'open',type_id:name,date:value},function(data){ if(data == 1){ alert(data); } else{ alert("错误请联系管理员！"); } });
}

function closeProject(keyid) {
	if (confirm("确定要关闭该项目？")) {
			$.ajax({
						url : "/center/php/action/page/authority/authority_control.php",
						data : {
								'action' : 'close',
								'type_id' : keyid
						},
						type : 'POST',
						dataType : 'text',
						success : function(data) {
							$("#admingrid").datagrid('reload');
							   var  params=new Array();
							   params[0]=keyid;
				        	   insertLogInfo("LogCloseroject",params);
						},
						error : function(data) {
							alert("错误请联系管理员！");
						}
				});
	}
}

function loadWest(){
//	alert("hhhh");
	$.post('/modules/php/action/page/center/center.act.php?action=isSuper',function(result){
		var res = eval("("+result+")");
//		alert(res.departmesnt);
		if(res.user_type == 3){
//			$("#li0").css('display','block');
			$("#li1").css('display','block');
			$("#li2").css('display','block');
			$("#li3").css('display','block');
//			document.getElementById('body').className = 'easyui-layout'
		}
		else{
			
			$("#_easyui_tree_2").hide();
			$("#_easyui_tree_3").hide();
			$("#_easyui_tree_4").hide();

			if(res.department == 0){
				$("#_easyui_tree_2").show();
				//alert($(".li1"));
			}
			else if(res.department == 1){
				$("#_easyui_tree_3").show();
			}
			else if(res.department == 2){
				$("#_easyui_tree_4").show();
			}
			else{
				
			}
		}
	});
}



function loadAll(){
	var title='项目类型管理';
	isDel=0;
	$('#admingrid').datagrid({
		//height:250,
		title:title,
		nowrap : false,//设置为true，当数据长度超出列宽时将会自动截取
		striped : true,//设置为true将交替显示行背景。
		collapsible : false,//显示可折叠按钮
		singleSelect:true,//为true时只能选择单行
		fitColumns:true,//允许表格自动缩放，以适应父容器
//		fit:true,
		resizeHandle:'both',
		rownumbers : true,//行数
		pagination:true,//分页
		pageSize: 15,  
		pageList: [5,10,15,20,30], 
		checkOnSelect:false,
		selectOnCheck:false, 
					
		remoteSort : false,
		toolbar:'#toolbar',
				   
//		url:'/center/php/action/page/authority/authority_control.php?action=queryAdmin&isDel=0',//url调用Action方法
		url:'/center/php/action/page/project_type/control.php?action=queryAll',
//		url:'../../../../php/action/page/admin/admin.act.php?action=queryAdmin&isDel=0',
		columns:[[
			{field:'id',title:'id',checkbox:true},
			//{field:'usr',title:'用户名',width:10},
			{field:'name',title:'项目类型',align:'center',width:200},
			{field:'dep_name',title:'所属科室',align:'center',width:100},
			{field:'is_public',title:'发布状态',align:'center',width:60,formatter:function(value,row,index){
				var rn = "待发布";
				if(value == "1"){
					rn = "已发布";
				}
				return rn;
			}
			},
			{field:'apply_status',title:'是否启用',rowspan:2,align:'center',width:80,
				formatter:function(value,row,index){
					
					var rn='';
					var a = '';
					var b = '';
				    if(value == "1"){
				    	a = "<input type='radio' name='"+row.id+"'  checked='true' onclick='show(" + index + ");'/><span>开启</span>";
				    	b ="<input type='radio'  name='"+row.id+"'  onclick='closeProject(" + row.id + ");'/><span>关闭</span>";
				    }else{
				    	a = "<input type='radio'  name='"+row.id+"' onclick='show(" + index + ");'/><span>开启</span>";
				    	b ="<input type='radio' name='"+row.id+"'  checked='true' onclick='closeProject(" + row.id+ ");'/><span>关闭</span>";
				    }
				    rn = a + b;
					return rn;
					
				}},
				//2015.12.29 david增加
				{
					field : 'date',
					title : '项目开启/截止时间',
					align : 'center',
					width : 200
				},
				{field:'accept_list',title:'受理人',align:'center',width:100},
				{field:'engi_list',title:'主管工程师',align:'center',width:80},
			//{field:'addedDate',title:'添加时间',align:'center'},
			{field:'action',title:'操作',align:'center',width:200,
				formatter:function(value,row,index){
					var rn='';
					var a='<a href="javascript:void(0)" onclick="editPtOnly('+row.id+')">编辑</a>';
					var d='<a href="javascript:void(0)" onclick="editCheck('+row.id+')">查重设置</a>';
					var c=' | <a href="javascript:void(0)" onclick="editPt('+row.id+')">编辑表格</a>';
					var e=' | <a href="javascript:void(0)" onclick="editExamine ('+row.id+')">审批设置</a>';
					var b=' | <a href="javascript:void(0)" onclick="delPt('+row.id+')"> 删除</a>';
					if (row.is_new != "0") {
						//console.log(row);
                        rn=a+' | '+d+c+e+b;
                    }else{
                    	//2016.01.07 david 增加
                    	rn = d + b;
                    }
					/*if(pridge=='super'){
							rn=a+b;
					}else{
						if(pridge.indexOf('admininfo_edit')>=0){
							rn+=a;
						}
						if(pridge.indexOf('admininfo_del')>=0){
							rn+=b;
						}
					}
					if(rn==''){
						rn='无操作权限';	
					}*/
					return rn;
				}
			},															
		]],
		/**onLoadSuccess: function () {
			reSize();
    	return true;
  	}	*/					  
	});				
	$('#muti_back').css({'display':'none'});
	$('#back_loadPage').css({'display':'none'});
	$('#dlg-renew').dialog({
		onClose:function(){
			window.location.reload() ;
		}
	});
}


function loadPage(department){
	var title='项目类型管理';
	isDel=0;
	$('#admingrid').datagrid({
		//height:250,
		title:title,
		nowrap : true,//设置为true，当数据长度超出列宽时将会自动截取
		striped : true,//设置为true将交替显示行背景。
		collapsible : false,//显示可折叠按钮
		singleSelect:true,//为true时只能选择单行
		fitColumns:true,//允许表格自动缩放，以适应父容器
		//fit:true,
		rownumbers : true,//行数
		pagination:true,//分页
		pageSize: 15,  
		pageList: [5,10,15,20,30], 
		checkOnSelect:false,
		selectOnCheck:false, 
					
		remoteSort : false,
		toolbar:'#toolbar',
		url:'/center/php/action/page/project_type/control.php?action=queryByDepartment&department='+department,
		columns:[[
					
			{field:'id',title:'id',checkbox:true},
			//{field:'usr',title:'用户名',width:10},
			{field:'name',title:'项目类型',width:150,align:'center'},
			{field:'dep_name',title:'所属科室',width:100,align:'center'},
			{field:'is_public',title:'发布状态',width:30,align:'center',formatter:function(value,row,index){
				var rn = "待发布";
				if(value == "1"){
					rn = "已发布";
				}
				return rn;
			}},
			{field:'apply_status',title:'是否启用',width:80,align:'center',
				formatter:function(value,row,index){
					var rn='';
					var a = '';
					var b = '';
				    if(value == "1"){
				    	a = "<input type='radio' name='"+row.id+"'  checked='true' onclick='show(" + index + ");'/><span>开启</span>";
				    	b ="<input type='radio'  name='"+row.id+"'  onclick='closeProject(" + row.id + ");'/><span>关闭</span>";
				    }else{
				    	a = "<input type='radio'  name='"+row.id+"' onclick='show(" + index + ");'/><span>开启</span>";
				    	b ="<input type='radio' name='"+row.id+"'  checked='true' onclick='closeProject(" + row.id + ");'/><span>关闭</span>";
				    }
				    rn = a + b;
					return rn;
				}},
				//2015.12.29 david增加
				{
					field : 'date',
					title : '项目开启/截止时间',
					width : 100,
					align : 'center',
				},
			{field:'action',title:'操作',align:'center',width:100,align:'center',
				formatter:function(value,row,index){
					var rn='';
					var a='<a href="javascript:void(0)" onclick="editPtOnly('+row.id+')">编辑</a>';
					var c=' | <a href="javascript:void(0)" onclick="editPt('+row.id+')">编辑表格</a>';
					var b=' | <a href="javascript:void(0)" onclick="delPt('+row.id+')"> 删除</a>';
					if (row.is_new != "0") {
						//console.log(row);
                        rn=a+c+b;
                    }
					return rn;
				}
			}															
		]],
	});				
	$('#muti_back').css({'display':'none'});
	$('#back_loadPage').css({'display':'none'});
}

function editPt(ptid){ 
	//session
	//
	window.location.href = "control.php?action=subtable&ptid="+ptid;
}

/**
 * 设置
 * 自定义项目权限
 * 自定义流程
 * 自定义表单
 * */
function priSet(){
	
	var obj = $("#proPriDlg");
	
	$('#proPri').datagrid({
	    url:'/center/php/action/page/project_type/control.php?action=getUser',
	    columns:[[
	        {field:'user_status',title:'状态',width:50,formatter:function(value,row,index){
				var rn = '<input type="checkbox" EDIT_TAG onclick="checkSpecialFor(this,'+row.user_id+',\'cjxmlx\')">';
				if (row.user_status == "1") {
					//console.log(row);
                    rn= rn.replace(/EDIT_TAG/,"checked");
                }else{
                	rn= rn.replace(/EDIT_TAG/,"");
                }
				return rn;
			}
	        },
	        {field:'realname',title:'真实姓名',width:300}
	    ]]
	});

	obj.dialog({
	      title: '项目权限设置',
	      width: 400,
	      height: 300,
	      open: true,
	      cache: false,
	      //href: url,
	      modal: true
	  });
}

function checkOtherPri(admin_info_id,prival,status){
	var url = "/center/php/action/page/authority/approve_control.php?action=";
	if (status) {
		url += "proCheckOtherPriMod";
	}else{
		url += "proCheckOtherPriDel";

	}
	url += "&admin_info_id="+admin_info_id+"&prival="+prival;
	var obj = $(this);
	$.ajax({
		url : url,
		async : false,
		type : "POST",
		dataType : "json",
		success : function(result) {
			
			//var res = eval("("+result+")");
			var res = result;
			//console.log(status);
			//alert(res.msgcode+'hhhhh');
			//alert(prival);
			if (status) {
				if(res.msgcode >= 100){
					if (res.msgcode == 101){
						alert("该用户权限已存在。");
					}
				}else{ //写入失败
					alert("权限赋予失败，请重试！");
				}
			}else{
				if(res.msgcode == 100){
					//insertLogInfo('xmqxsz',admin_info_id)
				}else{ //写入失败
					alert("权限变更失败，请重试！");
				}
			}
		}
	});
}

/**
 * 审批权限设置
 * */
function priCheckSet(){
	
	var obj = $("#checkPriDlg");

	var t_str;
	var k = 0;
	$("input[name='id']").each(function(){
		if($(this).is(":checked"))
		{
			$('#checkPri-linkbutton').css({'display':'block'});
			if(t_str == null){
				t_str = $(this).attr('value');
			}else{
				t_str += "|"+$(this).attr('value');
			}
			k++;
		}
	});

	var ptid = t_str;

	if(t_str == null){
		alert('请选择要操作的数据！');
		return;
	}

	$('#checkPri').datagrid({
		url:'/center/php/action/page/project_type/control.php?action=getCheckPri&ptid='+ptid,
		columns:[[
			{field:'realname',title:'真实姓名',width:80},
			{field:'assignee',title:'受理人',width:50,formatter:function(value,row,index){
				var rn = '<input type="checkbox" name="assignee" uid="'+row.user_id+'" ptid="'+ptid+'">';
				return rn;
			}
			},
			{field:'engineer',title:'主管工程师',width:80,formatter:function(value,row,index){
				var rn = '<input type="checkbox" name="engineer" uid="'+row.user_id+'" ptid="'+ptid+'">';
				return rn;
			}
			},
		]]
	});

	obj.dialog({
		title: '审批权限设置',
		width: 400,
		height: 300,
		open: true,
		cache: false,
		//href: url,
		modal: true
	});
}


/**
 * 权限转让
 * */
function priTransfer(){
	var obj = $("#checkPriDlg");

	var t_str;
	var k = 0;
	$("input[name='id']").each(function(){
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

	var ptid = t_str;

	if(t_str == null){
		return;
	}


	if(k>1){
		alert("不支持多个项目类型的配置.");
		return;
	}



	var arr;
	/**
	 *获取目标审批权限列表
	 */

	$.ajax({
		url : '/center/php/action/page/authority/approve_control.php?action=proTranPriList&ptid='+ptid,
		async : false,
		type : "POST",
		dataType : "json",
		success : function(result) {
			//var res = eval("("+result+")");
			var res = result;
			if(res.msgcode == 200){
				arr = res.ret.content;
				console.log(arr);
			}else{ //写入失败
				alert("获取目的用户数据失败，请重试！");
				return;
			}
		}
	});

	if(arr == null){
		return;
	}


	$('#checkPri').datagrid({
		url:'/center/php/action/page/project_type/control.php?action=getCheckPri&ptid='+ptid,
		columns:[[
			{field:'realname',title:'真实姓名',width:80},
			{field:'assignee',title:'受理人',width:50,formatter:function(value,row,index){
				var rn = '<input type="checkbox" EDIT_TAG onclick="checkPartFor(this,'+row.user_id+',0,'+ptid+')">';
				if (row.assignee == "1") {
					//console.log(row);
					rn= rn.replace(/EDIT_TAG/,"checked");
				}else{
					rn= rn.replace(/EDIT_TAG/,"");
				}
				if(arr[0] == "0"){
					rn = "";
				}
				return rn;
			}
			},
			{field:'engineer',title:'主管工程师',width:80,formatter:function(value,row,index){
				var rn = '<input type="checkbox" EDIT_TAG onclick="checkPartFor(this,'+row.user_id+',1,'+ptid+')">';
				if (row.engineer == "1") {
					//console.log(row);
					rn= rn.replace(/EDIT_TAG/,"checked");
				}else{
					rn= rn.replace(/EDIT_TAG/,"");
				}

				if(arr[1] == "0"){
					rn = "";
				}

				return rn;
			}
			},
		]]
	});

	obj.dialog({
		title: '审批权限转让',
		width: 400,
		height: 300,
		open: true,
		cache: false,
		//href: url,
		modal: true
	});
}


/**
*
*/

function checkSpecialFor(obj,admin_info_id,prival){


	var status = 0;

	//如果该状态为被选中的状态
	if ($(obj).is(":checked")) {
		//code
		status = 1;
	}

	checkOtherPri(admin_info_id,prival,status)

}

/**
* 对话框确认方式
*/

function checkPartForDialog(){
	
	var val_engi = new Array();
	var val_assign = new Array();
	var ptid = "";
	
	$("#checkPriDlg input[name='engineer']").each(function(){
		if($(this).is(":checked")){
			val_engi.push($(this).attr("uid"));
		}
		ptid = $(this).attr("ptid");
	});
	
	$("#checkPriDlg input[name='assignee']").each(function(){
		if($(this).is(":checked")) {
			val_assign.push($(this).attr("uid"));
		}
		ptid = $(this).attr("ptid");
	});

	var url = "/center/php/action/page/authority/approve_control.php?action=proCheckPriSpecail";
	url += "&val_assign="+val_assign.join("|")+"&ptid="+ptid+"&val_engi="+val_engi.join("|");
	
	$.ajax({
		url : url,
		async : false,
		type : "POST",
		dataType : "json",
		success : function(result) {
			
			if (status) {
				if(result.msgcode >= 100){
					if (result.msgcode == 101){
						alert("权限已存在。");
					}
				}else{ //写入失败
					alert("权限赋予失败，请重试！");
				}
				window.location.reload();
			}else{
				if(result.msgcode == 100){
					$.post('/center/php/action/page/log.act.php',{action:'LogcheckPart',params:ptid},function(result){
						window.location.reload();
					});
				}else{ //写入失败
					alert("权限变更失败，请重试！");
					window.location.reload();
				}
			}
		}
	});
	
	
}

/**
 *
 */

function checkPartFor(obj,admin_info_id,para_id,ptid){


	var status = 0;

	//如果该状态为被选中的状态
	if ($(obj).is(":checked")) {
		//code
		status = 1;
	}

	var pt_arr = ptid.split('|');
	
	if(key_priSer[para_id] == 0){
		key_priSer[para_id] = 1; //lock the set moment
	}
	
	for(item in pt_arr){
		checkPart(admin_info_id,status,para_id,pt_arr[item])
	}

}


function checkPart(admin_info_id,status,para_id,ptid){

	var url = "/center/php/action/page/authority/approve_control.php?action=";
	if (status) {
		url += "proCheckPriMod";
	}else{
		url += "proCheckPriDel";
	}
	url += "&admin_info_id="+admin_info_id+"&project_type_id="+ptid+"&para_id="+para_id;
	var obj = $(this);

	$.ajax({
		url : url,
		async : false,
		type : "POST",
		dataType : "json",
		success : function(result) {
			var res = eval("("+result+")");
			//console.log(status);
			//alert(res.msgcode+'hhhhh');
			if (status) {
				if(res.msgcode >= 100){
					if (res.msgcode == 101){
						alert("该用户权限已存在。");
					}
				}else{ //写入失败
					alert("权限赋予失败，请重试！");
				}
			}else{
				if(res.msgcode == 100){
					//obj.parent().css("color","#000");
				}else{ //写入失败
					alert("权限变更失败，请重试！");
				}
			}
		}
	});

}

/**
 * 
 * */
function setPub(){
	var t_str;
	$("input[name='id']").each(function(){
		if($(this).is(":checked"))
		{
			if(t_str == null){
				t_str = $(this).attr('value');
			}else{
				t_str += "|"+$(this).attr('value');
			}
		}
	});
	if(t_str==null||t_str==''){
		$.messager.alert("提示","请选择需要发布的项目！");
	}else{
		$.post('/center/php/action/page/authority/approve_control.php?action=ifNeedSet',{ids:t_str},function(result){
			var res = eval("("+result+")");
			if(res.ret=="fail"){
				$.messager.alert("提示","您选择的项目有已经发布的项目！");
			}else{
				//发布项目操作日志入库
				var  params=new Array(t_str);
		       insertLogInfo("LogSetProType",params);
				window.location.href = "control.php?action=pub_define&t_str="+t_str;
			}
		});
	}

	
}

function editExamine(ptid){
	var title = "项目类型恢复";
	$('#editSetCheck').datagrid({
		//height:250,
		striped : true,//设置为true将交替显示行背景。
		collapsible : false,//显示可折叠按钮
		singleSelect:true,//为true时只能选择单行
		fitColumns:true,//允许表格自动缩放，以适应父容器
		//fit:true,
		rownumbers : true,//行数
		pagination:true,//分页
		pageSize: 5,  
		pageList: [5,10,15,20], 
		checkOnSelect:false,
		selectOnCheck:false, 
		remoteSort : false,
//		toolbar:'#toolbar',
		url:'/center/php/action/page/project_type/control.php?action=editExamine&ptid=' + ptid,
		columns:[[
			{field:'name',title:'文件名称',width:600,align:'center'},
			{field:'not_check',title:'是否审批',width:100,align:'center',
				formatter:function(value,row,index){
					var hl =  '<input type="checkbox" id="'+row.id+'" class="ch_able" EDIT_TAG />';
	        		if(value == 0){
	        			hl = hl.replace(/EDIT_TAG/,"checked");
	        		}else{
	        			hl = hl.replace(/EDIT_TAG/,"");
	        		}
	        		return hl;
				}},
		]],
		
		

		onClickCell:function(rowIndex, field, value){ 
			/*console.log(rowIndex);
			console.log(field);
			console.log(value);*/
			//需要进行相应的操作
//			console.log(selRows);
			checkApplyOrCancel(rowIndex,value,ptid);
			 
			//设置审批
			   var  params=new Array();
			   params[0]=ptid;
	     	   insertLogInfo("LogSetCheck",params);
			
		},
	
/*	    onUncheck:function(index,row){
	    	$.post('/center/php/action/page/project_type/control.php?action=renewProject',{pyid:row.id,project_status:1},function(result){
	    		if(result == 0){
					$.messager.alert("提示","出错了！");
				}
			});
	    }*/
	});	
	$('#setCheck').dialog('open');
}

//status=0的时候代表其需要审核，1的时候代表不需要审核
function checkApplyOrCancel(rowIndex,value,ptid){
	console.log(rowIndex);
	var status = 0;
	var selRows = $("#editSetCheck").datagrid('selectRow',rowIndex);
	var selRows = $("#editSetCheck").datagrid('getSelected');
	console.log(selRows['id']);
	if($('#' + selRows['id']).prop("checked") == true){
		status = 0;
	}else if($('#' + selRows['id']).prop("checked") == false){
		status = 1;
	}
	$.post('/center/php/action/page/project_type/control.php?action=checkApplyOrCancel&ttid=' + selRows['id'] + '&status=' + status + '&ptid=' + ptid);
}

function editCheck(ptid){
	//session
	var url = "check.php?ptid="+ptid;
	var obj = $("#ccdlg");
	obj.attr("ptid",ptid);
	$('#tg').treegrid({
	    url:'check.php?action=getList&ptid='+ptid,
	    idField:'id',
	    treeField:'name',
	    onDblClickCell:function(field,row){
	    	if(field == "weight"){
	    		check_edit(); 
	    		   //设置查重日志
	 		   var  params=new Array();
	 		  params[0]=ptid;
	      	   insertLogInfo("LogSetCheckQ",params);
	    	}
	    },
	    onClickCell:function(field,row){
	    	if(field == "status"){
	    		check_status(row);
	    		  //设置查重日志
	    		   var  params=new Array();
	    		   params[0]=ptid;
		      	   insertLogInfo("LogSetCheckQ",params);
	    	}
	    },
	    columns:[[
	        {title:'表名称',field:'name',width:600},
	        {field:'weight',title:'权重',width:50,align:'right'},
	        {field:'status',title:'启用',width:50,align:'right',
	        	formatter:function(value, row){
	        	    var hl =  '<input type="checkbox" sid="'+row.id+'" class="ch_able" EDIT_TAG />';
	        		if(value == 0){
	        			hl = hl.replace(/EDIT_TAG/,"checked");
	        		}else{
	        			hl = hl.replace(/EDIT_TAG/,"");
	        		}
	        		return hl;
	        	}
	        }
	    ]]
	});
	
    obj.dialog({
      title: '查重设置',
      width: 800,
      height: 400,
      open: true,
      cache: false,
      resizable:true,
      //href: url,
      modal: true
  });
}

function delPt(ptid){
	//session
	//
	//david 2016.01.07 modify
	$.get('/center/php/action/page/project_type/control.php?action=canDelete&project_type_id=' + ptid,function(result){
		var res = JSON.parse(result);
		/*
		 * code:0  没有项目
		 */
//		alert(res.code);
		if(res.code == 0){
			$.messager.confirm('确定','确定删除该项目类型？',function(r){
				var  params=new Array();
				params[0]=ptid;
		      	insertLogInfo("LogDeleteProType",params);
				window.location.href = "control.php?action=del_define&ptid="+ptid;
			});
		}else{
			$.messager.alert('提示','您还有项目没有审核完成，不能删除该项目类型');
		}
	});
	
}


function editPtOnly(ptid){
	window.location.href = "control.php?action=edit&ptid="+ptid;
}

function delArrAdmin(){
	var t_str='';
	$("input[name='id']").each(function(){  
		if($(this).is(":checked"))     
		{
			if(t_str == null){
				t_str = $(this).attr('value');
			}else{
				t_str += "|"+$(this).attr('value');
			}
		}     
    });
	if(t_str==''){
		alert('请选择要删除的数据！');
		return;
	}
    $.messager.confirm("操作提示", "您确定要执行操作吗？", function (data) {  
        if (data) {  
        	//批量删除项目类型日志
        	var  params=new Array(t_str);
      	   insertLogInfo("LogDelArrProType",params);
        	window.location.href = "control.php?action=del_define&t_str="+t_str;
        }  
        else {  
          
        }  
    });  
	
}

var editingId;
function check_edit(){
	var row = $('#tg').treegrid('getSelected');
	if (row){
		editingId = row.id
		console.log(row);
		//$('#tg').treegrid('beginEdit', editingId);
		var obj = $('#ccdlg .datagrid-row-selected').first().find("td[field='weight']");
		var val = obj.text();
		if(val == null || val == ""){
			return;
		}
		obj.children("div").html("<input class='ch_setval' style='width:60px' type='text' value='"+val+"' />");
		//obj.find("div".hide());
		obj.find(".ch_setval").blur(function(){
			var t_obj = $(this);
			var new_val = t_obj.val();
			if(new_val == null || new_val == ""){
				new_val = 0;
			}
			if(new_val != val){
				//ajax
				$.ajax({
						url : "check.php?action=upcheck",
						data : {
								'str_id' : row.id,
								'val':new_val,
								'ptid':$("#ccdlg").attr("ptid")
						},
						type : 'POST',
						dataType : 'json',
						success : function(data) {
							
						},
						error : function(data) {
							alert("错误请联系管理员！");
						}
				});
			}
			obj.children("div").text(new_val);
		});
	}
}

function check_status(row){
	var st_val = 0;
	if(!$("#ccdlg").find(".ch_able[sid='"+row.id+"']").is(":checked")){
		st_val = -1;
	}
	var tp = 0; //child
	//ajax
	$.ajax({
			url : "check.php?action=upcheck",
			data : {
					'str_id' : row.id,
					'status': st_val,
					'ptid':$("#ccdlg").attr("ptid")
			},
			type : 'POST',
			dataType : 'json',
			success : function(data) {
				if(tp==0 && st_val == 0 ){
					var ft_obj = $("#ccdlg").find(".ch_able[sid='"+row._parentId+"']");
					if(!ft_obj.is(":checked")){
						ft_obj.prop('checked',true);
					}
				}
				
				if(tp==0 && st_val == -1){
					var sl_obj = $("#ccdlg").find(".ch_able[sid='"+row.id+"']");
					sl_obj.parents(".datagrid-row").next().find(".ch_able[sid]").prop('checked',false);
				}
				
			},
			error : function(data) {
				alert("错误请联系管理员！");
			}
	});
	
}

/**
 * david  2016.01.07
 */
function renew(){
	var title = "项目类型恢复";
	$('#delprojectgrid').datagrid({
		//height:250,
		striped : true,//设置为true将交替显示行背景。
		collapsible : false,//显示可折叠按钮
		singleSelect:true,//为true时只能选择单行
		fitColumns:true,//允许表格自动缩放，以适应父容器
		//fit:true,
		rownumbers : true,//行数
		pagination:true,//分页
		pageSize: 15,  
		pageList: [5,10,15,20,30], 
		checkOnSelect:false,
		selectOnCheck:false, 
		remoteSort : false,
//		toolbar:'#toolbar',
		url:'/center/php/action/page/project_type/control.php?action=queryDelproject',
		columns:[[
			{field:'id',title:'恢复',checkbox:true},
			{field:'name',title:'项目类型',width:100,align:'center'},
														
		]],
		
		onCheck:function(index,row){
			$.post('/center/php/action/page/project_type/control.php?action=renewProject',{pyid:row.id,project_status:0},function(result){
				if(result == 0){
					$.messager.alert("提示","出错了！");
				}else{
					//  
				    	var  params=new Array();
				    	params[0]=row;
			      	   insertLogInfo("LogRelProType",params);
				}
			});
		},
	
	    onUncheck:function(index,row){
	    	$.post('/center/php/action/page/project_type/control.php?action=renewProject',{pyid:row.id,project_status:1},function(result){
	    		if(result == 0){
					$.messager.alert("提示","出错了！");
				}else{
					
				}
			});
	    }
	});	
	$('#dlg-renew').dialog('open').dialog('setTitle','恢复项目类型');
}

$(function(){
	//alert("dd");
	loadAll();
	loadWest();

	
});
