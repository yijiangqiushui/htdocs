
$(function() {
	loadApplyInfo();
});
function getQueryStringByName(name) {
    var result = location.search.match(new RegExp("[\?\&]" + name + "=([^\&]+)", "i"));
    if (result == null || result.length < 1) {
        return "";
    }
    return result[1];
}
function loadApplyInfo() {
	var department = getQueryStringByName('department');
	var min = getQueryStringByName('min');
	// 这个 不知道
	var userdepartment = getQueryStringByName('userdepartment');
	if($.cookie("userdepartment") != null){
		userdepartment = $.cookie("userdepartment");
	}
	var max = getQueryStringByName('max');
	//现在将project_type 改成了id来显示
	var project_type = getQueryStringByName('name');
	var file = getQueryStringByName('file');
    department = $.cookie("department1");
    min = $.cookie("min1");
    max = $.cookie("max1");
    var name = $.cookie("project_type1");
    //alert(department1);
    if(file == 1){
    	$('#s_back').click(function() {
    		$('#s_back').attr('href',"/center/php/action/page/generate_id/lookFile.php");
    		
    	})
    }else{
    	$('#s_back').click(function() {
    		$('#s_back').attr('href',"/center/php/action/page/project_list/check_list.php?min="+min+"&max="+max+"&department="+department+"&name="+name);
    	})
    }
    
    $.cookie("department",department);
    $.cookie("min",min);
    $.cookie("max",max);
    $.cookie("project_type",project_type);
    $.cookie("userdepartment",userdepartment);
    
	$("#approve").datagrid(
					{
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
							checkOnSelect : false,
							selectOnCheck : false,
							remoteSort : false,
							toolbar:'#toolbar',
							url : '/center/php/action/page/approveinfo.php?action=approveinfo',
							columns : [ [

									{
											field : 'name',
											title : '填写事项',
											align : 'center',
											width : 200
									},
									{
											field : 'last_modify',
											title : '用户最近办理时间',
											align : 'center',
											width : 100
									},
									{
											field : 'status',
											title : '当前状态',
											align : 'center'
									},
									{
											field : 'approval_time',
											title : '审核时间',
											align : 'center'
									},
									{
											field : 'url',
											title : 'url',
											hidden:true
									},
									{
										field : 'print_url',
										title : 'print_url',
										hidden:true
									},
									{
										field : 'project_stage',
										title : 'project_stage',
										hidden:true
									},
									{
										field : 'project_type',
										title : 'project_type',
										hidden:true
									},
									{
											field : 'ispass',
											title : 'ispass',
											hidden:true
									},
									{
											field : 'table_status',
											title : 'table_status',
											hidden:true
								    },
								    {
											field : 'project_id',
											title : 'project_id',
											hidden:true
								    },
								    {
											field : 'table_id',
											title : 'table_id',
											hidden:true
							        },
									{
											field : 'action',
											
											title : '管理',
											width : 100,
											align : 'center',
											formatter : function(value, row, index) {
												var a = '';
												var b = '';
												if(userdepartment == 3){
													return "<a href='"+row.url+"' style='text-decoration:none'>查看</a>|"+"<a  style='text-decoration:none' href='#' onclick= 'printWord("+'"'+row.print_url+'"'+","+row.table_status+","+row.project_type+")'>打 印</a>";
												}else{
													if(row.project_stage == 4){
														a = "<a href='"+row.url+"' style='text-decoration:none'>查看</a>|"+"<a style='text-decoration:none' href='#' onclick= 'printWord("+'"'+row.print_url+'"'+","+row.table_status+","+row.project_type+")'>打 印</a>";
													}else{
														if(row.table_status==6){
															a = '';
														}else{
															if(row.table_status == 2 ){
																a = "<a href='"+row.url+"' style='text-decoration:none'>审批</a>|&nbsp;"+"<a style='text-decoration:none' href='#' onclick= 'printWord("+'"'+row.print_url+'"'+","+row.table_status+","+row.project_type+")'>打 印</a>";
															}else if(row.table_status == 5 || row.table_status == 3){
																a = "<a href='"+row.url+"' style='text-decoration:none'>查看&nbsp;</a>|"+"<a style='text-decoration:none' href='#' onclick= 'printWord("+'"'+row.print_url+'"'+","+row.table_status+","+row.project_type+")'>打 印</a>";
															}else{
																a = "<a href='"+row.url+"' style='text-decoration:none'>查看&nbsp;</a>" + '<a href="javascript:void(0)" style="text-decoration:none" onclick="reject('+"'"+row.name+"'"+ ',' + "'"+ row.table_id +"'" +')">|&nbsp;驳回修改&nbsp;</a>|'+"<a style='text-decoration:none' href='#' onclick= 'printWord("+'"'+row.print_url+'"'+","+row.table_status+","+row.project_type+")'>打 印</a>";
															}
													    }	
													}
													return a+b;
												}
											}
									}

							] ],
					});
	
	var p = $("#approve").datagrid('getPager');
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
	$(".easyui-combobox")
			.each(
					function() {
						$(this)
								.combobox(
										{
												url : '/center/php/action/page/authority/authority_control.php?action=queryUsers',
												valueField : 'id',
												textField : 'text'
										});
					});
}

function isCheck(project_id, value) {
	// 通过审核，跳转到一个文件，改变状态值
	$.post(
					'/modules/php/action/page/projectapp/projectapp.act.php?action=ischeck&project_id='
							+ project_id + '&value=' + value,
					function(result) {
						if (result != null) {
							// 修改数据库中的值成功
							alert('修改状态了');
							window.location.href = '/center/php/action/page/approve.php';
						}
					});
}
function changeOk() {
	$('#approve').form('submit',{
							url : '/modules/php/action/page/projectapp/projectapp.act.php?action=changeOk',
							success : function(result) {
								if (result != null) {
									alert('修改成功');
								}
								window.location.href = '/center/php/action/page/approve.php';
							}
					});
}
function reload() {
	window.location.reload();
}

//接受收查重后的返回值
function find_repeat(){
	//会把需要查重的内容---发送过去---进行查重，
	//会得到一个返回的状态值，查重的结果：status 2  过了（需要修改数据库中的check-repeat 的值）  ，3没过
	//先定义一个status为一个固定值
	
	var status=2;
	if(status==3){
		//查重没通过，就删除这个项目，peoject-info里面的isDelete设为1
		$.post('/modules/php/action/page/projectapp/projectapp.act.php?action=delete_repeat',function(result){
			if(result){
				window.location.href = '/center/php/action/page/approve.php';
			}
			
		});
	}
	else if(status==2){
		//查重通过
	$.post('/modules/php/action/page/projectapp/projectapp.act.php?action=check_repeat',
	function(result) {
		if(result){
			// 成功, 修改按钮为查看的连接,直接变成的。	
			window.location.href = '/center/php/action/page/approve.php';
		}					
	});
	}
}

//2015.1.02
function reject(table_name,table_id){
	$.messager.confirm('确定','确定驳回 ' + table_name + '?',function(r){
		if(r){
			$.post('/center/php/action/page/verify.php',{action:'check_deny',table_name:table_id},function(result){
				var res = JSON.parse(result);
				if(res.code == 0){
					$.messager.alert('提示','驳回成功！','info',function(){
						$("#approve").datagrid("reload");
					  //window.location.href = '/center/php/action/page/approve.php';
					});
				}else{
					$.messager.alert('提示','驳回失败！');
				}
			});
			 var params = new Array(table_id);
	    	 insertLogInfo("LogCheck_deny",params);
		}
		
	});
	
}


function printWord(url,table_status,project_type){
	var uri = url+"?table_status="+table_status+"&project_type="+project_type; 
	$.get(uri,function(result){
		window.location.href = result;
	});
}
