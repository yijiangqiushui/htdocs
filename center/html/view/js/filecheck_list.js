//页面加载时 加载页面数据

$(function(){
	loaddata(5);

});


/*
 * 取出中文字符
 * function getQueryStringByName(name) {
    var result = location.search.match(new RegExp("[\?\&]" + name + "=([^\&]+)", "i"));
    if (result == null || result.length < 1) {
        return "";
    }
    return result[1];
}*/

function loaddata(classes) {
	var department = getQueryStringByName('department');
	var min = getQueryStringByName('min');
	// 这个 不知道
	var max = getQueryStringByName('max');
	var project_type = decodeURI(getQueryStringByName('name'));

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
							checkOnSelect : false,
							selectOnCheck : false,
							remoteSort : false,
							// url:'/center/php/action/page/authority/authority_control.php?action=queryAdmin&isDel=0',//url调用Action方法
							url : '/center/php/action/page/project_list/checkinfo.php?action=findchecklist&department='
									+ department
									+ "&min="
									+ min
									+ "&max="
									+ max
									/*
									 * 2015.12.01注释;
									 * + "&name="
									   + name
									*/
									+ "&project_type="
									+project_type+"&classes="+classes ,

							// url:'../../../../php/action/page/admin/admin.act.php?action=queryAdmin&isDel=0',
							columns : [ [

									{
											field : 'id',
											title : '序号',
											width : 100,
											align : 'center',
											hidden:'true'
									},
									{
											field : 'name',
											title : '项目名称',
											width : 100,
											align : 'center'
									},
									// {field:'usr',title:'用户名',width:10},
									{
											field : 'project_stage',
											title : '项目阶段',
											width : 100,
											align : 'center'
									},
									{
											field : 'project_status',
											title : '项目状态',
											width : 150,
											align : 'center'
									},
									{
										field : 'project_id',
										title : '项目编号',
										hidden:"true"
									},
									{
										field : 'org_code',
										title : '单位编号',
										hidden:"true"
									},

									{
											field : 'zq',
											title : '中期报告',
											hidden:"true"
									
									},
									{
											field : 'action',
											title : '审批',
											width : 100,
											align : 'center',
											formatter : function(value, row,index) {
//												alert(row.project_id);
												var a = '<a href="javascript:void(0)" onclick="setProject('+"'"+row.project_id+"'"+','+"'"+row.org_code+"'"+')">查看&nbsp;</a>';
												return a;
											}
									}

							] ],
					/**
					 * onLoadSuccess: function () { reSize(); return true; }
					 */
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

// 接受参数
function getQueryStringByName(name){
    var result = location.search.match(new RegExp("[\?\&]" + name + "=([^\&]+)", "i"));
    if (result == null || result.length < 1) {
        return "";
    }
    return result[1];
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
	window.location.href = "/center/php/action/page/project_list/check_list.html?department="
			+ department + "&min=" + $min + "&max=" + $max + "&name=" + $name;
}



function setProject($project_id,$org_code){
	
//	alert($project_id);
	$.get('../../page/setProject.php?project_id='+$project_id+"&org_code="+$org_code,function(result){
		if(result == 0){
			window.location.href = "../../page/approve.php";
		}
		else{
			alert("wrong");
		}
	});
	
}

