document.write('<script type="text/javascript" src="/common/html/js/log.js"></script>');
function loadWest(){
	$.post('/modules/php/action/page/center/center.act.php?action=isSuper',function(result){
		var res = eval("("+result+")");
//		alert(res.user_type);
		if(res.user_type == 3){
			$("#li1").css('display','block');
			$("#li2").css('display','block');
			$("#li3").css('display','block');
//			document.getElementById('body').className = 'easyui-layout'
		}
		else{
			if(res.department == 0){
				$("#li1").css('display','block');
			}
			else if(res.department == 1){
				$("#li2").css('display','block');
			}
			else if(res.department == 2){
				$("#li3").css('display','block');
			}
			else{
				
			}
		}
	});
}

//用来控制自定义类型创建子类的页面显示
function isFather(){
	var status = 1;
	$(".pt_fid").change(function(){
		if($(this).val()=="0"){
			$("#children").parent().parent().show();
			
		}else{
			$("#children").val("0");
			$("#children").attr('checked',false);
			$("#children").parent().parent().hide();
			$("#children").parent().parent().next().hide();
			
		}
	});
	$("#children").click(function(){
		if($(this).val()=="0"){
			$(this).val("1");
			$("#children").parent().parent().next().show();
		}else{
			$(this).val("0");
			$("#children").attr('checked',false);
			$("#children").parent().parent().next().hide();
		}			
		});
	$("input[name='table_list']").on('click',function(){
		var table = $(this);
		if(table.is(':checked')){
			table.parents("div").children(":first").children().prop("checked","checked");
		}
		table.parent().parent().children().find("input[name='table_list']").each(function(){
			var tablecheck = $(this);
			tablecheck.each(function(){
				if($(this).prop('checked')) {
					status = 0;
			    }
			});
			
		});
		
//		alert(status);
		if(status == 1){
			table.parents("div").children(":first").children().prop("checked",false);
		}
		status = 1;
	});
	$("input[name='Fruit']").on('click',function(){
		if(!$(this).is(':checked')){
			$(this).parents("div").children().children().prop('checked',false);
		}
	});
	
}

function submitForm(){
	
	var local_tag = 0;
	
	/*if($("input[name='changeFile1']").is(':checked')||$("input[name='changeFile2']").is(':checked')){
		local_tag = 1;
	}*/
	
	var local_str = "p";
	var t_str = "t";
	
	$("input[name='Fruit']").each(function(){     
		if($(this).is(":checked"))     
		{     
			local_str += "|"+$(this).attr('value');
		}     
    });
	
	$("input[name='table_list']").each(function(){     
		if($(this).is(":checked"))     
		{     
			t_str += "|"+$(this).attr('value');
		}     
    });
	var dpid = $(".dp_id").find("option:selected").val();
	//get json for initialization
	$.ajax({
		url : "/center/php/action/page/project_type/control.php?action=create_define",
		data : {
			'ptname':$("input[name='ptname']").first().val(),
			'ptid':$(".pt_fid").find("option:selected").val(),
			'dpid':$(".dp_id").find("option:selected").val(),
			'local_str':local_str,
			't_str':t_str,
			'children':$("#children").val(),
			'pt_child_name':$("#pt_child_name").val()
		},
		type : 'POST',
		async: false,
		dataType : 'json',
		success : function(data) {
			if(data.msgcode == 100){
				if (data.ret) {
					//新建项目日志
					var ptname=$("input[name='ptname']").first().val();
					var stname=$("#pt_child_name").val();
					   var  params=new Array(ptname,stname);
		        	   insertLogInfo("LogAddProType",params);
                    //change to edit form
					if(local_tag){
						window.location.href = "?action=subtable";
					}else{
						window.location.href = "?action=admin";
					}
                }else{
                	
                }
			}else{
				alert("error");
			}
		},
		error : function(data) {
			//alert("修改失败，请重试，或联系管理员！");
		}
	});
	
}

function editForm(){
	var local_tag = 0;
	var local_str = "p";
	var t_str = "t";
	/*$("input[name='Fruit'][value='0']").each(function(){
		alert($(this).val());
	});*/
	var chooseStatus = 1;
	$("input[name='Fruit']").each(function(){
		var fruit = $(this);
		if($(this).is(":checked"))     
		{   
			chooseStatus = 1;
			local_str += "|"+$(this).attr('value');
//			alert($(this).val());
			//还需要将改阶段的所有文件判断一遍看看这个是否是有文件的
			$(this).parent().parent().children().find("input[name='table_list']").each(function(){
				
				var table = $(this);
				table.each(function(){
					if($(this).prop('checked')){
//						alert($(this).val());
						chooseStatus = 0;
					}
					
				});
			});
			
			if(chooseStatus){
				local_str = "";
				alert("您选择的有误，选中的阶段必须至少有一个审批文件，请检查后提交！");
				die;
			}
		}
		
		
    });
	
	$("input[name='table_list']").each(function(){     
		if($(this).is(":checked"))     
		{     
			t_str += "|"+$(this).attr('value');
		}     
    });
	var dpid = $(".dp_id").find("option:selected").val();
	//get json for initialization
	$.ajax({
		url : "/center/php/action/page/project_type/control.php?action=edit_define",
		data : {
			'ptname':$("input[name='ptname']").first().val(),
			'ptid':$(".pt_fid").find("option:selected").val(),
			'dpid':$(".dp_id").find("option:selected").val(),
			'local_str':local_str,
			't_str':t_str
		},
		type : 'POST',
		async: false,
		dataType : 'json',
		success : function(data) {
			if(data.msgcode == 100){
				if (data.ret ) {
					//新建项目日志
					var ptname=$("input[name='ptname']").first().val();
					 var  params=new Array(ptname);
		        	  insertLogInfo("LogEditProType",params);
                    window.location.href = "?action=admin";
                }else{
                	
                }
			}else{
				alert("error");
			}
		},
		error : function(data) {
			//alert("修改失败，请重试，或联系管理员！");
		}
	});
	
}

function clearForm(){
	$("input[name='Fruit']").each(function(){     
		if($(this).is(":checked"))     
		{     
			$(this).attr('checked',false);
		}     
    });
	
	$("input[name='table_list']").each(function(){     
		if($(this).is(":checked"))     
		{     
			$(this).attr('checked',false);
		}     
    });
	//alert("重置");
	
}
function loadPage(department) {
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
												
													
													if(row.open==1){
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

$(function(){
	loadWest();
	isFather();
});