$(function(){
	loadWest();
	loadAll();
	$.get('/center/php/action/page/authority/approve_control.php?action=getUserPriJson',function(result){
		var res = JSON.parse(result);
		if(res.msgcode == 200){
			var data = res.ret.content;
			if(data.is_super == "1" || (data.admin_tag == "1" && data.is_special == "1")){
				$(".jcqx_set").show();
			}else{
				$(".jcqx_set").hide();
			}
		}else{
			//alert("获取数据错误");
		}

	});

});

function loadAll(department){
	var dep;
	var title='项目信息';
	var i=0;
	var arrayObj = new Array();
	var arrayObj2 = new Array();
	var department;
	isDel=0;
	$.ajax( {  
		url:"/modules/php/action/page/center/center.act.php?action=getUserDep",//
		type:'post',  
		cache:false,
		async:false,
		dataType:'json',  
		success:function(data) {  
			if(data.msgcode == 200 ){
				// $('#approve').form('load',res);alert(res.project_name);
				department = data.userDep; 
			}else{  
				alert(data.msgcode);
			}  
		},  
		 error : function() {
			  //alert("异常！");
		}  
	});
	$('#projectList').datagrid({
		//height:250,
		title:title,
		nowrap : true,//设置为true，当数据长度超出列宽时将会自动截
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
		nowrap:true,
		toolbar:'#toolbar',
		autoRowHeight:false,
		url:'/modules/php/action/page/center/center.act.php?action=project_all&department='+department,
		columns:[[
			{field:'id',title:'id',checkbox:true},
			{field:'project_type',title:'项目类别',align:'center',width:300},
			//{field:'usr',title:'用户名',width:10},
			{field:'visors',title:'监察员',align:'center',width:50},
			{field:'project_start',title:'申报开始时间',align:'center',width:80},
			{field:'project_end',title:'申报结束时间',align:'center',width:80},
			//{field:'userPrivileges',title:'权限',width:100,align:'center'},
//			{field:'check_num',title:'待受理数量',align:'center',width:50},
			//{field:'addedDate',title:'添加时间',align:'center'},
			{field:'action',title:'操作',align:'center',width:100,
				formatter:function(value,row,index){
					var a = '';
					var link = '';
					if(department != 3){
						if(row.check_num > 0)
						{
							 link = "/center/php/action/page/project_list/check_list.php?department=" + row.department + "&min=1&max=4&name=" + row.id;
						     arrayObj[i]=row.department;
						     arrayObj2[i]=row.project_type;
						     i++;
//							 a='<a href=' + link +  ' onclick="editAdmin('+"'"+row.id+"'"+')">受理</a>';
						     a='<a href=' + link +  ' >受理</a>';
						}
						else{
							 link = "/center/php/action/page/project_list/check_list.php?department=" + row.department + "&min=1&max=4&name=" + row.id;
							 a='<a href=' + link +  ' >查看</a>';
						}
					}else{
						link = "/center/php/action/page/project_list/check_list.php?department=" + row.department + "&min=1&max=4&name=" + row.id;
						a='<a href=' + link +  ' >查看</a>';
					}
					
					var rn='';
					rn=a;
					return rn;
				}
			}															
		]],
		
	});
	 
		//分页		
	var p = $('#projectList').datagrid('getPager');			  
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

function loadWest(){
//	alert("hhhh");
	$.post('/modules/php/action/page/center/center.act.php?action=isSuper',function(result){
		var res = eval("("+result+")");
//		alert(res.departmesnt);
		if(res.user_type == 3 || res.special == 1){
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
/*
function loadPage(department){
	var title='用户信息';
	isDel=0;
	$('#projectList').datagrid({
		//height:250,
		title:title,
		nowrap : true,//设置为true，当数据长度超出列宽时将会自动截
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
//		url:'/center/php/action/page/authority/authority_control.php?action=queryAdmin&isDel=0',//url调用Action方法
		url:'/modules/php/action/page/center/center.act.php?action=project_main&department='+department,
//		url:'/center/php/action/page/authority/authority_control.php?action=queryAdmin&isDel=0',
//		url:'../../../../php/action/page/admin/admin.act.php?action=queryAdmin&isDel=0',
		columns:[[
					
			{field:'id',title:'id',checkbox:true},
			{field:'project_type',title:'项目类别',align:'center'},
			//{field:'usr',title:'用户名',width:10},
			{field:'project_start',title:'申报开始时间',align:'center'},
			{field:'project_end',title:'申报结束时间',align:'center'},
			//{field:'qq',title:'QQ',width:10},
			//{field:'userPrivileges',title:'权限',width:100,align:'center'},
			{field:'check_num',title:'待审核数量',align:'center',},
			//{field:'addedDate',title:'添加时间',align:'center'},
			{field:'action',title:'操作',align:'center',
				formatter:function(value,row,index){
					var a = '';
					var link = '';
					if(row.check_num > 0)
					{
					   link = "/center/php/action/page/project_list/check_list.php?department=" + row.department + "&min=1&max=4&name=" + row.id;
					   a='<a href=' + link +  ' onclick="editAdmin('+ row.id+');">受理</a>';
					 
					}
					else{
						 link = "/center/php/action/page/project_list/check_list.php?department=" + row.department + "&min=1&max=4&name=" + row.id;
						a='<a href=' + link +  ' onclick="editAdmin('+ row.id+');">查看</a>';
					}
					var rn='';
					rn=a;
					return rn;
				}
			}															
		]],
	});
		//分页		
	var p = $('#projectList').datagrid('getPager');			  
	$(p).pagination({  
			pageSize: 15,  
			pageList: [5,10,15,20,30],  
			beforePageText: '第', 
			afterPageText: '页    共 {pages} 页',  
			displayMsg: '当前显示 {from} - {to} 条记录   共 {total} 条记录'  						   
	});   					
	$('#muti_back').css({'display':'none'});
	$('#back_loadPage').css({'display':'none'});
	
	
	$('#principal').combobox({
	    url:'/center/php/action/page/authority/authority_control.php?action=queryUsers',
	    valueField:'id',
	    textField:'text'
	});
	
	
	$(".easyui-combobox").each(function(){
//		alert(this);
		$(this).combobox({
		url:'/center/php/action/page/authority/authority_control.php?action=queryUsers',
	    valueField:'id',
	    textField:'text'
		 });
	});
}*/
   //打开添加新用户界面;
    function newAdmin()
	{
    	$('#newProject').dialog('open').dialog('setTitle','添加项目');
		$('#addProject').form('clear');
    	
	}
    //添加新用户;
    function addAdmin()
    {
    	$('#newAdmin').form('submit',{
    		url:'/modules/php/action/page/center/center.act.php?action=newadmin',
    		success:function(result){
    			if(result != 0)
    			{
    			  alert("加入成功");
    			  window.location.reload(true);
    			}
    			else
    			{
    				alert("失败");
    			}    			
    		}
    	});
    }
    //单个删除项目;
    
    //这里的删除是谁写的？你猜？
    function delAdmin($project_type)
    {  
    	 if(!confirm("确定要删除吗？")){
    		 return false;
    	 }
    	$.post('/modules/php/action/page/center/center.act.php?action=delAdmin'+'&project_type='+$project_type,function(result){
			if(result!=0){
               alert("删除成功");
               window.location.reload(true);
			}
		});
    }
    
  //批量删除
    function delArrAdmin(){
    	var rows = $("#projectList").datagrid("getChecked");
    	if(rows.length==0){
    		$.messager.alert('消息提示','请选择要删除的信息','info');	
    	}else{
    		var list=new Array();
    		for(var i=0;i<rows.length;i++){
    			list[i]=rows[i].id;
    		}
    		$.messager.confirm('消息提示','确定删除吗？',function(r){
    			if(r){
    				$.get('/modules/php/action/page/center/center.act.php?action=delArrproject_type&arrproject_type='+list,function(data){
    					$('#projectList').datagrid('reload');
    				});
    			}
    		});
    	}
    }


/**
 * 监察权限设置
 */
function visorAdmin(){
	$('#visorPri-linkbutton').css({'display':'block'});
	var obj = $("#visorPriDlg");

	var k = 0;
	var ptid;
	var depart_id;
	var selRows = $("#projectList").datagrid('getChecked');
    var prival = "";
	if(selRows==''){
		$('#visorPri-linkbutton').css({'display':'none'});
		alert('请选择项目！');
		return;	
	}
    for(var item in selRows){
        ptid = selRows[item].id;
        depart_id = selRows[item].department;
        if(prival != ""){
            prival += "|";
        }
        prival += "jcqxPart_"+depart_id+"_"+ptid;
    }

	$('#visorPri').datagrid({
		url:'/center/php/action/page/project_type/control.php?action=getVisor&ptid='+ptid,
		columns:[[
			{field:'user_status',title:'状态',width:50,formatter:function(value,row,index){

				var rn = '<input type="checkbox" name="user_status" uid="'+row.user_id+'" prival="'+prival+'">';
				return rn;
			}
			},
			{field:'realname',title:'真实姓名',width:300,align:'center',}
		]]
	});

	obj.dialog({
		title: '监察权限设置',
		width: 400,
		height: 180,
		open: true,
		cache: false,
		//href: url,
		modal: true
	});
}


/**
 * 对话框确认方式
 */

function cancelForDialog(){

	//remove selected
	$("#visorPriDlg input[name='user_status']").each(function(){
		if($(this).is(":checked")){
			$(this).prop("checked",false);
		}
	});
	checkForDialog();
}


function checkForDialog(){

    var val_visor = new Array();
    var prival = "";

    $("#visorPriDlg input[name='user_status']").each(function(){
        if($(this).is(":checked")){
            val_visor.push($(this).attr("uid"));
        }
        prival = $(this).attr("prival");
    });

    var url = "/center/php/action/page/authority/approve_control.php?action=proOtherPriSpecail";
    url += "&val_visor="+val_visor.join("|")+"&prival="+prival;

    $.ajax({
        url : url,
        async : false,
        type : "POST",
        dataType : "json",
        success : function(result) {
            //var res = eval("("+result+")");
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
					if(val_visor!=''){
						var params=prival;
						$.post('/center/php/action/page/log.act.php',{action:'Logjcqx',params:params},function(result){
							window.location.reload();
						});
						
					}else{
						window.location.reload();
					}
                }else{ //写入失败
                    alert("权限变更失败，请重试！");
					window.location.reload();
                }
            }
        }
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
				}else{ //写入失败
					alert("权限变更失败，请重试！");
				}
			}
		}
	});
}