

$(function(){
	loadWest();
	loadAll();
	
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
			$("#_easyui_tree_5").hide();
			if(res.department == 0){
				$("#_easyui_tree_2").show();
				//alert($(".li1"));
			}
			else if(res.department == 1){
				$("#_easyui_tree_3").show();
			}
			else if(res.department == 2){
				$("#_easyui_tree_4").show();
			}else{
				$("#_easyui_tree_5").show();
			}
		}
	});
}


function loadAll(){
	var title='用户信息';
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
		url:'/center/php/action/page/authority/authority_control.php?action=queryAdminAll&isDel=0',
		columns:[[
					
			{field:'id',title:'id',checkbox:true},
			{field:'realname',title:'真实姓名',width:100,align:'center'},
			{field:'phone',title:'联系方式',width:100,align:'center'},
			{field:'email',title:'E-MAIL',width:150,align:'center'},
			{field:'isForbidden',title:'是否禁用',width:80,align:'center',
				formatter:function(value,row,index){
					var s='';
					if(value=='0'){
						s='启用';
					}else{
						s='禁用';
					}
					return s;
				}},
			{field:'action',title:'操作',align:'center',width:100,align:'center',
				formatter:function(value,row,index){							
					var a='<a href="javascript:void(0)" onclick="editAdmin('+row.id+')">编辑</a>';
					var b=' | <a href="javascript:void(0)" onclick="delAdmin('+row.id+')"> 删除</a>';							
					var rn='';
					rn=a+b;
					return rn;
				}
			}															
		]],
	});
				
	var p = $('#admingrid').datagrid('getPager');			  
	$(p).pagination({  
			pageSize: 15,  
			pageList: [5,10,15,20,30],  
			beforePageText: '第', 
			afterPageText: '页    共 {pages} 页',  
			displayMsg: '当前显示 {from} - {to} 条记录   共 {total} 条记录'  						   
	});   					
	$('#muti_back').css({'display':'none'});
	$('#back_loadPage').css({'display':'none'});
	$(".easyui-combobox").each(function(){
//		alert(this);
		$(this).combobox({
		url:'/center/php/action/page/authority/authority_control.php?action=queryUsers',
	    valueField:'id',
	    textField:'text'
		 });
	});
}

function loadPage(departmentauth){
	var title='用户信息';
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
				   
		url:'/center/php/action/page/authority/authority_control.php?action=queryAdmin&isDel=0&$departmentauth='+departmentauth,
		columns:[[
					
			{field:'id',title:'id',checkbox:true},
			{field:'realname',title:'真实姓名',width:100,align:'center'},
			{field:'phone',title:'联系方式',width:100,align:'center'},
			{field:'email',title:'E-MAIL',width:150,align:'center'},
			{field:'isForbidden',title:'是否禁用',width:80,align:'center',
				formatter:function(value,row,index){
					var s='';
					if(value=='0'){
						s='启用';
					}else{
						s='禁用';
					}
					return s;
				}},
			//{field:'addedDate',title:'添加时间',align:'center'},
			{field:'action',title:'操作',align:'center',width:100,align:'center',
				formatter:function(value,row,index){							
					var a='<a href="javascript:void(0)" onclick="editAdmin('+row.id+')">编辑</a>';
					var b=' | <a href="javascript:void(0)" onclick="delAdmin('+row.id+')"> 删除</a>';							
					var rn='';
					rn=a+b;
					return rn;
				}
			}															
		]],
	});
				
	var p = $('#admingrid').datagrid('getPager');			  
	$(p).pagination({  
			pageSize: 15,  
			pageList: [5,10,15,20,30],  
			beforePageText: '第', 
			afterPageText: '页    共 {pages} 页',  
			displayMsg: '当前显示 {from} - {to} 条记录   共 {total} 条记录'  						   
	});   					
	$('#muti_back').css({'display':'none'});
	$('#back_loadPage').css({'display':'none'});
	
	$(".easyui-combobox").each(function(){
//		alert(this);
		$(this).combobox({
		url:'/center/php/action/page/authority/authority_control.php?action=queryUsers',
	    valueField:'id',
	    textField:'text'
		 });
	});
}

function getProList(id){

	if($(window).height()<595){
		$('#gpldlg').css({'height':'350px'});
	}

	$('#gpldlg').attr("tarid",id);


	var obj = $("#gpldlg");
	var uid = $('#edtdlg').attr("tarUid");

	$('#proGpldlg').datagrid({
		nowrap : true,// 设置为true，当数据长度超出列宽时将会自动截取
		striped : true,// 设置为true将交替显示行背景。
		collapsible : false,// 显示可折叠按钮
		singleSelect : true,// 为true时只能选择单行
		fitColumns : true,// 允许表格自动缩放，以适应父容器
		// fit:true,
		rownumbers : true,// 行数
		remoteSort : false,
		checkOnSelect : false,
		selectOnCheck : false,
		remoteSort : true,
		resizeHandle:true,
		width:'auto',
		
		url:'/center/php/action/page/authority/approve_control.php?action=getProListByUid&uid='+uid+'&ptid='+id,
		columns:[[
			{field:'project_name',title:'项目列表',width:200},
			{field:'engi_tag',title:'主管工程师',width:100,formatter:function(value,row,index){
				var rn = '';
				if(row.engi_tag == 1){
					rn = "是";
				}
				return rn;
			}
			},
			{field:'dl_tag',title:'代管工程师',width:200,formatter:function(value,row,index){
				var rn = '';
				if(row.dl_tag == 1){
					rn = "是";
				}
				return rn;
			}
			},
		]]
	});

	obj.dialog('open').dialog('setTitle','主管项目列表');

}

function editAdmin(id){
	if($(window).height()<595){
		$('#edtdlg').css({'height':'450px','width':'1480px'});
		$('.window').css({'top':'0'});
	}
	$('#edtdlg').dialog('open').dialog('setTitle','修改信息');
	$('#edtdlg').attr("tarUid",id);
	$('#edtdlgfm').form('clear');
	$('#priCheckList').find("input[type='checkbox']").parent().css("color","#000");
	/**
	 *获取目标审批权限列表
	 */
	$.get('/center/php/action/page/authority/approve_control.php?action=proCheckPriList&admin_info_id='+id,function(data){
		var res = eval("("+data+")");
		if(res.msgcode == 200){
			var arr = res.ret.content;
			for(var i=0;i<arr.length;i++){
				var obj = arr[i];
				//console.log(obj);
				var tar = $('#priCheckList').find("input[type='checkbox']").filter("[ptid='"+obj.project_type_id+"']").filter("[value='"+obj.project_type_para_id+"']");
				tar.prop("checked",'true');
				if (obj.status == 0) {
                    tar.parent().css("color","#f00");
                }else{
					tar.parent().css("color","#fc2");
				}
			}
		}else{ //写入失败
			alert("获取目的用户数据失败，请重试！");
		}
	});
	$('#priCheckList').find("input[type='checkbox']").on("click",checkPart);
	$('#priCheckList').find("input[type='radio']").on("click",chooseAll);
	/**
	 *获取其他批权限列表
	 */
	$.get('/center/php/action/page/authority/approve_control.php?action=proPriList&admin_info_id='+id,function(data){
		var res = eval("("+data+")");
		if(res.msgcode == 200){
			var arr = res.ret.content;
			for(var i=0;i<arr.length;i++){
				var obj = arr[i];
				var tar = $('#otherPri').find("input[type='checkbox']").filter("[name='"+obj.prival+"']");
				tar.prop("checked",'true');
				var jctar = $('#jcPri').find("input[type='checkbox']").filter("[name='"+obj.prival+"']");
				jctar.prop("checked",'true');
				if (obj.status == 0) {
                    tar.parent().css("color","#f00");
                }else{
					tar.parent().css("color","#fc2");
				}
			}
		}else{ //写入失败
			alert("获取目的用户数据失败，请重试！");
		}
	});	
	$('#otherPri').find("input[type='checkbox']").on("click",checkOtherPri);
	$('#jcPri').find("input[type='checkbox']").on("click",checkOtherPri);
	//$('#otherPri').find("input[type='radio']").on("click",chooseAll);
}

function loadcombotree(res){
	$("#catTree").combotree({
		url:'../../../../php/action/page/admin/admincat.act.php?action=treeData&table_name=admincat',
		onBeforeExpand:function(node){
			$(this).tree('options').url='../../../../php/action/page/admin/admincat.act.php?action=treeData&table_name=admincat&up_id='+node.id;
		},
		onClick:function(node){
			$('#upCat').val(node.upperCat+node.id+'.');
		},
		onLoadSuccess: function (node, data) {
			$('#catTree').combotree('tree').tree("expandAll"); 
		}
	});
}


function checkPart(){
	var admin_info_id = $("#edtdlg").attr("tarUid");
	var para_id = $(this).val();
	var ptid = $(this).attr("ptid");

	var status = 0;
	
	//如果该状态为被选中的状态
	if ($(this).is(":checked")) {
        //code
		status = 1;
    }
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
					obj.parent().css("color","#000");
				}else{ //写入失败
					alert("权限变更失败，请重试！");
				}
			}
		}
	});
	
	/*$.post(url,function(result){
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
				obj.parent().css("color","#000");
			}else{ //写入失败
				alert("权限变更失败，请重试！");
			}
		}
		
	}); */
}

function checkOtherPri(){
	var admin_info_id = $("#edtdlg").attr("tarUid");
	var prival = $(this).attr("name");
	var status = 0;
	
	//如果该状态为被选中的状态
	if ($(this).is(":checked")) {
        //code
		status = 1;
    }
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
					if(obj.attr("sptag") == "1"){
						obj.parent().parent().next().find("input[type='checkbox']").prop("checked",true);
					}
				}else{ //写入失败
					alert("权限赋予失败，请重试！");
				}
			}else{
				if(res.msgcode == 100){
					obj.parent().css("color","#000");
					if(obj.attr("sptag") == "1"){
						obj.parent().parent().next().find("input[type='checkbox']").prop("checked",false);
					}
				}else{ //写入失败
					alert("权限变更失败，请重试！");
				}
			}
		}
	});
	
	/*$.post(url,function(result){
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
				obj.parent().css("color","#000");
			}else{ //写入失败
				alert("权限变更失败，请重试！");
			}
		}
		
	}); */
}

function chooseAll(){
	
	var admin_info_id = $("#edtdlg").attr("tarUid");
	var ptid = $(this).attr("ptid");
	var cval = $(this).attr("cval");
	
	var url = "/center/php/action/page/authority/approve_control.php?action=proCheckPriModAll";
	url += "&admin_info_id="+admin_info_id+"&project_type_id="+ptid+"&cval="+cval;
	var obj = $(this);
	
	$.post(url,function(result){
		var res = eval("("+result+")");
		if (cval == '0') {
            if(res.msgcode >= 300){
				if (res.msgcode == 301){
					alert("该用户权限已存在。");
				}
				obj.parent().parent().find("input[type='checkbox']").prop("checked",true);
			}else{ //写入失败
				alert("权限赋予失败，请重试！");
			}
        }else{
			if(res.msgcode == 400){
				//alert("删除成功");
				obj.parent().parent().find("input[type='checkbox']").prop("checked",false);
				obj.parent().parent().find("input[type='checkbox']").css("color","#000");
			}else{ //写入失败
				alert("权限变更失败，请重试！");
			}
		}
	});
}

function disableAdmin(value){
	var status = value;
	var obj = $("#center").find("input[type='checkbox']").filter("input:checked");
	var msg = false;
	obj.each(function(){
		var url = "/center/php/action/page/authority/authority_control.php?action=updateUser&id="+$(this).val()+"&isForbidden="+value;
		$.post(url,function(result){
			var res = eval("("+result+")");
			if(res.msgcode==100){
				msg = true;
			}
		});
		
	});
	if(obj.length!=0){
		window.location.reload();
	}else{
		alert("请选择用户");
	}	
}

function delAdmin(id){
	var url = "/center/php/action/page/authority/authority_control.php?action=deleteUser&id="+id;
	$.post(url,function(result){
		var res = eval("("+result+")");
		if(res.msgcode==100){
			alert("删除成功");
			window.location.reload();
		}else{
			alert("删除失败");
		}
	});
	
}




