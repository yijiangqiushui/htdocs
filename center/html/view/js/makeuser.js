document.write('<script type="text/javascript" src="/common/html/js/log.js"></script>');
//添加表示id的变量;
var user_id = 0;
$(function(){
	loadWest();
	loadAll();
	userDefined();
});

function userDefined(){
	$('#userDefined').treegrid({
		url:'',
		idField:'id',
		treeField:'name',
		columns:[{
			
		}]
	});
}

function loadAll(){
	var title='用户信息';
//	alert("hhhhh");
	isDel=0;
	var toolbar = '';
	toolbar = ["-", {
    	id:'',
        text: '批量恢复',
        iconCls: 'icon-ok',
        handler: function () { recUsers();  }
        },{
		id:'select',
		text: '查询',
		iconCls: 'icon-ok',
		handler: function () { }
	},"-"];
	$('#makeuser').datagrid({
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
		toolbar: toolbar,
		url:'/modules/php/action/page/center/center.act.php?action=queryUser',
		columns:[[
			{field:'id',title:'id',checkbox:true},
			{field:'username',title:'用户名',width:50,},
			{field:'realname',title:'真实姓名',width:50,},
			{field:'telephone',title:'用户联系电话',width:50,},
			{field:'email',title:'E-MAIL',width:50,},
			{field:'org_name',title:'公司名称',width:100,},
			{field:'org_address',title:'公司地址',width:150,},
			{field:'phone',title:'公司电话',width:50,},
			{field:'action',title:'操作',width:100,
				formatter:function(value,row,index){
					var a = '';
				    if(row.isForbidden == 0 )
					{
				    	a='<a href="javascript:void(0)" onclick="delUser('+row.id+')"><span>禁用</span></a>';
					}
				    else {
				       a='<a href="javascript:void(0)" onclick="recUser('+row.id+')"><span style="color:red">启用</span></a>'
				    }
				    var rn='';
					rn=a;
					return rn;
				}
			}															
		]],
	});
	
	//这个是分页的设置
	var p = $('#makeuser').datagrid('getPager');			  
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
		$(this).combobox({
		url:'/center/php/action/page/authority/center.act.php?action=queryUsers',
	    valueField:'id',
	    textField:'text'
	   });
	});
	$('#select').click(function() {
		$('#select_block').dialog('open').dialog('setTitle','筛选');
		$('#select_info').form("clear");
	});
}

function editUser(user_id){
	$('#editlist').treegrid({
		url:'/modules/php/action/page/center/center.act.php?action=userProject',
		idField:'id',
		treeField:'name',
		animate:"true",
		columns:[[
			{field:'name',title:'项目类型名称'},
			{field:'status',title:'启用',width:50,align:'right',
	        	formatter:function(value, row){
	        		if(row._parentId != null){
	        			 var hl =  '<input type="checkbox" id="'+row.id+'" class="ch_able"/>';
	 	        		return hl;
	        		}
	        	}
	        }
		]],
		
		onClickCell:function(field,row){
			console.log(row);
			if(field == "status"){
				if(row.department != null){
					specialProject(row,user_id);
				}else{
					specialUser(row,user_id);
				}
	    	}
		},
		
	    onExpand:function(row){
	    	console.log(row);
	    	if(row._parentId != null){
	    		applyExecheck(row,user_id);
	    	}else{
	    		projectCheck(row,user_id);
	    	}
	    }
	});	
	$('#edituser').dialog("open");
}

//用来判断当前的项目checkbox是否为选中状态。
function projectCheck(row,user_id){
	var project_list = row.children;
	for(var i = 0;i < project_list.length;i++){
		if(projectIscheck(project_list[i],user_id)){
			$('#' + project_list[i].id).prop("checked",true);
		}
	}
}

function projectIscheck(row,user_id){
	var mark = 0;
	$.ajax({
		type:"get",
		url:"/modules/php/action/page/center/center.act.php?action=projectIscheck&ptid=" + row.project_type_id + "&user_id=" + user_id,
		async : false,
		dataType: "json",
		success:function(res){
			if(res.code != 0){
				mark = 1;
			}
		}
		
	});
	return mark;
}

//选中项目按钮以后的操作
function specialProject(row,user_id){
	if($('#' + row.id).prop("checked") == true){
		$('#a' + row.project_type_id).prop("checked",true);
		$('#e' + row.project_type_id).prop("checked",true);
		$('#r' + row.project_type_id).prop("checked",true);
		var tmp = row.children;
		if(tmp != null){
			for(var i = 0;i < tmp.length;i++){
				specialUser(tmp[i],user_id);
			}
		}else{
			specialUser(row,user_id);
		}
		
	}else{
		//如果项目被全部不勾选的话，则要将这个项目全部删除并且将下面的对勾全部去掉
		$('#a' + row.project_type_id).prop("checked",false);
		$('#e' + row.project_type_id).prop("checked",false);
		$('#r' + row.project_type_id).prop("checked",false);
		$.post("/modules/php/action/page/center/center.act.php?action=deleteNewProject",{ptid:row.project_type_id,user_id:user_id},function(result){
			
		});
	}
}

//用来判断申报书和实施方案是否打钩
function applyExecheck(row,user_id){
	var mark = 0;
	/*$.get("/modules/php/action/page/center/center.act.php?action=applyExecheck&ptid=" + row.project_type_id + "&user_id=" + user_id,function(result){
		var res = JSON.parse(result);*/
	$.ajax({
		type:"get",
		url:"/modules/php/action/page/center/center.act.php?action=applyExecheck&ptid=" + row.project_type_id + "&user_id=" + user_id,
		async : false,
		dataType: "json",
		success:function(res){
			if(res.code != 0){
				if(res.apply == 1){
					$('#a' + row.project_type_id).prop("checked",true);
					mark = 1;
	//				console.log($('#'+ 'a' + row.id).checked);
				}else{
					$('#a' + row.project_type_id).prop("checked",false);
				}
				
				if(res.execute == 1){
					$('#e' + row.project_type_id).prop("checked",true);
					mark = 1;
				}else{
					$('#e' + row.project_type_id).prop("checked",false);
				}
				
				if(res.report == 1){
					$('#r' + row.project_type_id).prop("checked",true);
					mark = 1;
				}else{
					$('#r' + row.project_type_id).prop("checked",false);
				}
			}
		}
		
	});
	return mark;
}

//首先需要复制一份出来
function specialUser(row,user_id){
	//首先需要判断当前的这个checkbox是选中的状态
		//是选中的状态我则需要进行复制的操作了
	var project_type = row.project_type_id;
	$.ajax({
		type:"get",
		url:"/modules/php/action/page/center/center.act.php?action=copyNew&ptid=" + project_type + "&user_id=" + user_id,
		async : false,
		dataType: "json",
		success:function(data){
			if(data.code == 1){
				$.ajax({
					type:"post",
					url:"/modules/php/action/page/center/center.act.php?action=inherit",
					data:{ptid:project_type,user_id:user_id},
					async:false,
					datatype:"json",
					success:function(result){
						
					}
				});
			}
		}
	});
			
	if(row.name == "申报书"){
		if($('#' + row.id).prop("checked") == true){
			//增加申报书
			//只要有一个是勾选的状态则项目的属性也是为勾选的状态
			$('#p' + project_type).prop("checked",true);
			$.post("/modules/php/action/page/center/center.act.php?action=addApply",{ptid:project_type,user_id:user_id},function(result){
				
			});
		}else{
			//删除申报书
			$.post("/modules/php/action/page/center/center.act.php?action=deleteApply",{ptid:project_type,user_id:user_id},function(result){
				//还要删除申报阶段
				deleteApplyStage(project_type,user_id);
			});
		}
	}else if(row.name == "实施方案"){
		if($('#' + row.id).prop("checked") == true){
			//增加实施方案
			$('#p' + project_type).prop("checked",true);
			$.post("/modules/php/action/page/center/center.act.php?action=addCheckExe",{ptid:project_type,user_id:user_id,table_id:1},function(result){
				
			});
		}else{
			//去除实施方案
			$.post("/modules/php/action/page/center/center.act.php?action=deleteCheckExe",{ptid:project_type,user_id:user_id,table_id:1},function(result){
				//还要删除申报阶段
				deleteApplyStage(project_type,user_id);
			});
		}
	}else if(row.name == "可行性研究报告"){
		if($('#' + row.id).prop("checked") == true){
			//增加可行性分析报告
			$('#p' + project_type).prop("checked",true);

			$.post("/modules/php/action/page/center/center.act.php?action=addCheckExe",{ptid:project_type,user_id:user_id,table_id:22},function(result){
				
			});
		}else{
			//删除可行性分析报告
			$.post("/modules/php/action/page/center/center.act.php?action=deleteCheckExe",{ptid:project_type,user_id:user_id,table_id:22},function(result){
				//还要删除申报阶段
				deleteApplyStage(project_type,user_id);
			});
		}
	}
		
//	}
}


//删除申报阶段的内容
function deleteApplyStage(project_type,user_id){
	$.post("/modules/php/action/page/center/center.act.php?action=deleteApplyStage",{ptid:project_type,user_id:user_id},function(result){
		
	});
}


function loadWest(){
	$.post('/modules/php/action/page/center/center.act.php?action=isSuper',function(result){
		var res = eval("("+result+")");
		//console.log(res);
		//alert("tese");
		if(res.user_type == 3){
			$(".li1").css('display','block');
			$(".li2").css('display','block');
			$(".li3").css('display','block');
		}
		else{
			
			$("#department").children("li").hide();
			if(res.department == 0){
				$("#department").children("li").eq(0).show();
			}
			else if(res.department == 1){
				$("#department").children("li").eq(1).show();
			}
			else if(res.department == 2){
				$("#department").children("li").eq(2).show();
			}
			else{
				
			}
		}
	});
}

function loadPage(user_type){
//function loadPage(department){
	$('#makeuser').empty();
	var title='用户信息';
	isDel=0;
	var toolbar = '';
	if(user_type==-1){
		toolbar = [
			    "-", {
		    	id:'',
		        text: '添加',
		        iconCls: 'icon-add',
		        handler: function () { newAdmin(); }
		    }, "-", {
		    	id:'',
		        text: '批量恢复',
		        iconCls: 'icon-ok',
		        handler: function () { recUsers(); }
		    },{
				id:'select',
				text: '查询',
				iconCls: 'icon-ok',
				handler: function () { }
			},"-"];
	}
	else{
		toolbar = ["-", {
	    	id:'',
	        text: '批量恢复',
	        iconCls: 'icon-ok',
	        handler: function () { recUsers();  }
	    },{
			id:'select',
			text: '查询',
			iconCls: 'icon-ok',
			handler: function () { }
		},"-"];
	}
	//alert("1111");
	$('#makeuser').datagrid({
		//height:250,
		title:title,
		nowrap : true,//设置为true，当数据长度超出列宽时将会自动截取
		striped : true,//设置为true将交替显示行背景。
		collapsible : false,//显示可折叠按钮
		singleSelect:true,//为true时只能选择单行
		fitColumns:true,//允许表格自动缩放，以适应父容器
		rownumbers : true,//行数
		pagination:true,//分页
		pageSize: 15,  
		pageList: [5,10,15,20,30],
		pageNumber:1,
		checkOnSelect:false,
		selectOnCheck:false, 
		remoteSort : false,
//		fit : true,
		toolbar:toolbar,
		url:'/modules/php/action/page/center/center.act.php?action=queryUserus&login_type='+user_type,
		columns:[[
			{field:'id',title:'id',checkbox:true},
			{field:'username',title:'用户名',width:50,},
			{field:'realname',title:'真实姓名',width:50,},

			{field:'telephone',title:'联系方式',width:50,},
			{field:'email',title:'E-MAIL',width:50,},
			{field:'org_name',title:'公司名称',width:100,},
			{field:'org_address',title:'公司地址',width:150,},
			{field:'phone',title:'公司电话',width:50,},
			{field:'action',title:'操作',align:'center',width:100,
				formatter:function(value,row,index){							
					var a = '';
				    if(row.isForbidden == 0 )
					{
				    	a='<a href="javascript:void(0)" onclick="delUser('+row.id+')"><span>禁用</span></a>';
				    	if(user_type == -1){
					    	a += '<a href="javascript:void(0)" onclick="editUser('+row.id+')"><span> | 编辑</span></a>';
				    	}

					}
				    else
				    {	
				       a='<a href="javascript:void(0)" onclick="recUser('+row.id+')"><span style="color:red">启用</span></a>'
				    }						
					var rn='';
					rn=a;
					return rn;
				}
			}															
		]],
	});

	var p = $('#makeuser').datagrid('getPager');			  
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
		$(this).combobox({
		url:'/center/php/action/page/authority/center.act.php?action=queryUsers',
	    valueField:'id',
	    textField:'text'
		 });
	});
	$('#select').click(function() {
		$('#select_block').dialog('open').dialog('setTitle','筛选');
		$('#select_info').form("clear");
	})
}

//分配用户的显示

//恢复用户的操作
 function recUser(id)
 {
	  $.messager.confirm('消息提示','是否启用？',function(result){
	      if(result){
	    	  //启用用户  日志
	    	  var  params=new Array();
	    	  params[0]=id;
	    	  insertLogInfo("logrecUser",params);
	    		$.post('/center/php/action/page/log.act.php?action=logrecUserr',{uid:id},function(result){
		    		
		    	});
			  $.post('/modules/php/action/page/center/center.act.php?action=recover&id='+id,function(data){
					if(data){
						
						$('#makeuser').datagrid('reload');
					}
					else{
						alert("启用失败");
						$('#makeuser').datagrid('reload');
					}
		  		});
	      }
	  });
 }
 
 //批量恢复的操作
  function recUsers()
  {
	  var rows = $('#makeuser').datagrid("getChecked");
	  if(rows.length == 0)
	  {
	     alert("请选择要恢复的用户");
	  }
	  else
	  {
		  var list_id = new Array();
		  for(var i=0;i<rows.length;i++)
		  {
			  list_id[i] = rows[i].id;
		  }
		  $.messager.confirm('消息提示','是否批量恢复？',function(result){
  			if(result){
  				$.get('/modules/php/action/page/center/center.act.php?action=recUsers&list_id='+list_id,function(data){
  			     //批量回复用户
  		    	    insertLogInfo("LogBatchRecUsers",list_id);
  					$('#makeuser').datagrid('reload');
  				});
  			}
  		});
	  }
  }
function myformatter(date) {
	var y = date.getFullYear();
	var m = date.getMonth() + 1;
	var d = date.getDate();
	return y + '-' + (m < 10 ? ('0' + m) : m) + '-'
		+ (d < 10 ? ('0' + d) : d);
}
function myparser(s) {
	if (!s)
		return new Date();
	var ss = (s.split('-'));
	var y = parseInt(ss[0],10);
	var m = parseInt(ss[1],10);
	var d = parseInt(ss[2],10);
	if (!isNaN(y) && !isNaN(m) && !isNaN(d)) {
		return new Date(y, m - 1, d);
	} else {
		return new Date();
	}
}
  
 function newAdmin(){
	$('#edtdlg').dialog('open').dialog('setTitle','添加用户');
	$('#generateID').form("clear");
 }

function generateid(){

	if($.trim($('#username').val())==''){alert('提示：请输入用户名！');}
	//else if($.trim($('#password').val())==''){alert('提示：请输入密码！');}

	else{
		var username = $.trim($('#username').val());
		var password = $.trim($('#password').val());
		if(password == ''){
		    password = '123456';	
		}
		$.post("/center/php/action/page/form.act.php?action=generateid",{username:username,password:password},function(result){
			if(result == 0){
				var mess = "您生成的账号为：\n用户名：" + username + "\n密码：" + password;
			//	alert('成功增加用户，' + mess);
				$.messager.confirm('消息提示',mess,function(result){
					if(result){
						$('#makeuser').datagrid('reload');
						$('#edtdlg').dialog('close');
						 var params=new Array();
						 params[0] = username;
			        	 insertLogInfo("LogAddUser",params);
					}
					else{
						$('#edtdlg').dialog('close');
					}
				});
				
			}
			else{
				alert("用户已存在！");
				$('#edtdlg').dialog('close');
				$('#makeuser').datagrid('reload');
			}
		});
	}
/*	  $(".username").attr("value","");
	  $("#password").attr("value","");*/
}

function delUser($id){
	
	 $.messager.confirm('消息提示','是否禁用？',function(result){
	    if(result){	 
	    	//禁用用户的 日志
	    	  var  params=new Array();
	    	  params[0]=$id;
	    	  insertLogInfo("logdelUser",params);
	    	 
		$.post('/modules/php/action/page/center/center.act.php?action=delUser&id='+$id, function(data){
				if(data){
					alert("禁用失败");
					$('#makeuser').datagrid('reload');
				}
				else{
					$('#makeuser').datagrid('reload');
				}
			});
		  }
	    });
	
}

function select() {
	var user_name = $('#user_name_select').val();
	var company_name = $('#company_name_select').val();
	var contactman_name = $('#contact_name_select').val();
	if(user_name==""&&company_name==""&&contactman_name==""){
		alert("请输入查询条件");
		return false;
	}
	loadSearchUser(user_name,company_name,contactman_name);
	$('#select_block').dialog('close');

}

function loadSearchUser(user_name,company_name,contactman_name){
	var title='用户信息';
//	alert("hhhhh");
	isDel=0;
	var toolbar = '';
	toolbar = ["-", {
		id:'',
		text: '批量恢复',
		iconCls: 'icon-ok',
		handler: function () { recUsers();  }
	},{
		id:'select',
		text: '查询',
		iconCls: 'icon-ok',
		handler: function () {  }
	},"-"];
	$('#makeuser').datagrid({
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
		pageNumber:1,
		checkOnSelect:false,
		selectOnCheck:false,

		remoteSort : false,
		toolbar: toolbar,
		url:'/modules/php/action/page/center/center.act.php?action=querySearchUser&username='
		+encodeURIComponent(user_name)
		+'&org_name='
		+encodeURIComponent(company_name)
		+'&linkman='
		+encodeURIComponent(contactman_name)
		,
		columns:[[
			{field:'id',title:'id',checkbox:true},
			{field:'username',title:'用户名',width:50,},
			{field:'realname',title:'真实姓名',width:50,},
			{field:'telephone',title:'用户联系电话',width:50,},
			{field:'email',title:'E-MAIL',width:50,},
			{field:'org_name',title:'公司名称',width:100,},
			{field:'org_address',title:'公司地址',width:150,},
			{field:'phone',title:'公司电话',width:50,},
			{field:'action',title:'操作',width:100,
				formatter:function(value,row,index){
					var a = '';
					if(row.isForbidden == 0 )
					{
						a='<a href="javascript:void(0)" onclick="delUser('+row.id+')"><span>禁用</span></a>';
					}
					else
					{
						a='<a href="javascript:void(0)" onclick="recUser('+row.id+')"><span style="color:red">启用</span></a>'
					}
					var rn='';
					rn=a;
					return rn;
				}
			}
		]],
	});

	var p = $('#makeuser').datagrid('getPager');			  
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
		$(this).combobox({
		url:'/center/php/action/page/authority/center.act.php?action=queryUsers',
	    valueField:'id',
	    textField:'text'
		 });
	});
	$('#select').click(function() {
		$('#select_block').dialog('open').dialog('setTitle','筛选');
		$('#select_info').form("clear");
	})
}


