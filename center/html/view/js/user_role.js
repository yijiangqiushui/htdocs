document.write("<script src='../../../../html/view/js/jquery.daterangepicker.js'></script>");
var row = 0;
var keyid='';
/*
function openProject(obj) {
	var name = obj.getAttribute("name");
	var start_time = name + "_start";
	var end_time = name + "_end";
	start_time = eval(document.getElementById(start_time)).value;
	end_time = eval(document.getElementById(end_time)).value;
	// alert(value);

	// alert("start");
	if (start_time != null && start_time != "") {
		$
				.ajax({
						url : "/center/php/action/page/authority/authority_control.php",
						data : {
								'action' : 'open',
								'type_id' : name,
								'start_date' : start_time,
								'end_date' : end_time
						},
						type : 'POST',
						dataType : 'text',

						success : function(data) {
							// document.getElementById(name).style.visibility = "visible";
							// alert("aaaaaaaa"+data);

							window.location.reload();
						},
						error : function(data) {
							alert("错误请联系管理员！");
							// alert(data);
						}

				});
		obj.style.visibility = "hidden";
	} else {
		alert("请填写项目开始日期！");
	}

	
	 * $.post("/center/php/action/page/authority/authority_control.php",{action:'open',type_id:name,date:value},function(data){ if(data == 1){ alert("aaaaaaaa"+data); } else{ alert("错误请联系管理员！"); } });
	 

}*/

function closeProject(obj) {
	if (confirm("确定要关闭该项目？")) {
			$.ajax({
						url : "/center/php/action/page/authority/authority_control.php",
						data : {
								'action' : 'close',
								'type_id' : obj
						},
						type : 'POST',
						dataType : 'text',
						success : function(data) {
							window.location.reload();
						},
						error : function(data) {
							alert("错误请联系管理员！");
						}
				});
	}
}

function show(obj) {
	row =obj;
	var time = $('#userrole').datagrid('getData').rows[obj].date;
	//项目的名字   开启的时候 可以按照这个存储
	keyid = $('#userrole').datagrid('getData').rows[obj].id;
	if(time!=null){
	$('#start').datebox('setValue',time.split("——")[0]);
	$('#end').datebox('setValue',time.split("——")[1]);
	}
	$('#dlg').dialog('open').dialog('setTitle','选择日期');
	//$('#dlg').dialog('open').dialog('setTitle','选择日期');
}
// 设置相应行的 日期
function setdate() {
	var start = $('#start').datebox('getValue');
	var end = $('#end').datebox('getValue');
	if (start == "") {
		start = "未指定";
	}
	if (end == "") {
		end = "未指定";
	}
	//alert(start);
	if(start >= end) {
		alert("截止日期不能早于或等于开始日期！");
	} else {
		$('#dlg').dialog('close');
		var date = start + "——" + end;
		// 设置本行的 开始时间 和 截止时间field : 'date', title : '项目开启/截止时间',
		$('#userrole').datagrid("updateRow",{
				index : row,
				row : {
					date : date
				}
		})
		openProject(keyid,start,end);
	}
	
}


//开启项目
function openProject(keyid,start_time,end) {
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
							window.location.reload();
						},
						error : function(data) {
							alert("错误请联系管理员！");
						}

				});
	} else {
		alert("请填写项目开始日期！");
	}
 $.post("/center/php/action/page/authority/authority_control.php",{action:'open',type_id:name,date:value},function(data){ if(data == 1){ alert("aaaaaaaa"+data); } else{ alert("错误请联系管理员！"); } });
}

function hide(obj) {
	var name = obj.getAttribute("name");
	document.getElementById(name).style.visibility = "hidden";
}

// 页面加载时 加载页面数据
function loadPage(department) {
	var key = checkPri();
	$("#userrole")
			.datagrid(
			{
			title:'申报项目开关',
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
			checkOnSelect : false,
			selectOnCheck : false,
			remoteSort : false,
			// url:'/center/php/action/page/authority/authority_control.php?action=queryAdmin&isDel=0',//url调用Action方法
			url : 'userole_info.php?action=userrole&department='+department,

			// url:'../../../../php/action/page/admin/admin.act.php?action=queryAdmin&isDel=0',
			columns : [ [
/*
									{
											field : 'serial_num',
											title : '序号',
											width : 100,
											align : 'center'
									},*/
									{
											field : 'name',
											title : '项目类别',
											width : 200,
											align : 'center'
									},
									{
											field : 'action',
											title : '项目开放/关闭',
											width : 200,
											rowspan : 2,
											align : 'center',
											formatter : function(value, row,
													index) {
												//console.log(row);
												   var rn='';
												    if(row.apply_status=="1"){
												    	var a = "<input type='radio'    name='"+row.serial_num+"'  checked='true' onclick='show("
														+ index
														+ ");'/><span>开启</span>";
												    	
												    	var b ="<input type='radio'  name='"+row.serial_num+"'  onclick='closeProject("
															+ row.id
															+ ");'/><span>关闭</span>";
												    }else{
												    	var a = "<input type='radio'  name='"+row.serial_num+"'  onclick='show("
															+ index
															+ ");'/><span>开启</span>";
												    	var b ="<input type='radio' name='"+row.serial_num+"'      checked='true'   onclick='closeProject("
															+ row.id
															+ ");'/><span>关闭</span>";
												    }
												
													
													if(row.open==1 && key){
														rn = a+b;
													}
													return rn;
											}
									}, {
											field : 'date',
											title : '项目开启/截止时间',
											width : 200,
											align : 'center',
									},

			] ],
			rownumbers : true,

			});

	var p = $("#userrole").datagrid('getPager');
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

	
	 $('#principal').combobox({ url:'/center/php/action/page/authority/authority_control.php?action=queryUsers', valueField:'id', textField:'text' });
	 

	$(".easyui-combobox")
			.each(
					function() {
						// alert(this);
						$(this)
								.combobox(
										{
												url : '/center/php/action/page/authority/authority_control.php?action=queryUsers',
												valueField : 'id',
												textField : 'text'
										});
					});
}
$(function() {
	//alert("ss");
	loadAll();
	loadWest();
	$(".dataRange").each(function() {
		$(this).dateRangePicker({
				autoClose : true,
				singleDate : true,
				showShortcuts : false
		});
	});
});



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

function checkPri(){
	var key = false;
		
	$.ajax({
			url : "/center/php/action/page/privilageControl.php?action=checkPart",
			data : {
				'module':'szxmkg'
			},
			type : 'POST',
			async:false,
			dataType : 'json',
			success : function(data) {
				if (data.ret == "1") {
                    key = true;
                }
			},
			error : function(data) {
				//alert("错误请联系管理员！");
			}

	});
	
	return key;
	
}

function loadAll() {
	
	var key = checkPri();
	
	$("#userrole")
			.datagrid(
			{
			title:'申报项目开关',
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
			checkOnSelect : false,
			selectOnCheck : false,
			remoteSort : false,
			// url:'/center/php/action/page/authority/authority_control.php?action=queryAdmin&isDel=0',//url调用Action方法
			url : 'userole_info.php?action=userrole_all',

			// url:'../../../../php/action/page/admin/admin.act.php?action=queryAdmin&isDel=0',
			columns : [ [

					/*{
							field : 'serial_num',
							title : '序号',
							width : 100,
							align : 'center'
					},*/
					{
							field : 'name',
							title : '项目类别',
							width : 200,
							align : 'center'
					},
					{
						field : 'open',
						title : '是否有开启关闭按钮',
					 	hidden:true
				   },
				   {
					   field : 'apply_status',
					   title : '是否开启',
						hidden:true
				   },
				   {
						field : 'id',
						title : '主键id',
						hidden:true
				},
					{
							field : 'action',
							title : '项目开放/关闭',
							width : 200,
							rowspan : 2,
							align : 'center',
							formatter : function(value, row,
									index) {
								//console.log(row);
							   var rn = '';
							   var a = '';
							   var b = '';
							    if(row.apply_status=="1"){
							    	a = "<input type='radio'    name='"+row.id+"'  checked='true' onclick='show(" + row.id + ");'/><span>开启</span>";
							    	b ="<input type='radio'  name='"+row.id+"'  onclick='closeProject(" + row.id + ");'/><span>关闭</span>";
							    }else{
							    	a = "<input type='radio'  name='"+row.id+"'  onclick='show(" + row.id + ");'/><span>开启</span>";
							    	b ="<input type='radio' name='"+row.id+"'  checked='true' onclick='closeProject(" + row.id + ");'/><span>关闭</span>";
							    }
								if(key){
									rn = a+b;
								}
								return rn;
							}
					},
					{
							field : 'date',
							title : '项目开启/截止时间',
							width : 200,
							align : 'center',
					},

			] ],
			rownumbers : true,

			});
	//绑定事件
	var show_obj = document.getElementById('show');
	$('#show').bind('click',function(){
		show(show_obj.value);
	});
	var close_obj = document.getElementById('close');
	$('#show').bind('click',function(){
		closeProject(close_obj.value);
	});

	var p = $("#userrole").datagrid('getPager');
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
						// alert(this);
						$(this)
								.combobox(
										{
												url : '/center/php/action/page/authority/authority_control.php?action=queryUsers',
												valueField : 'id',
												textField : 'text'
										});
					});
}

