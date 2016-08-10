$(function(){
	loadWest();
	loadAll();
	
//	loadApplyInfo();
});
var dep = 0;


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
	var title='用户信息';
	isDel=0;
	$('#processControl').datagrid({
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
//		url:'/modules/php/action/page/center/center.act.php?action=processControl',
		url:'/modules/php/action/page/center/center.act.php?action=processControlAll',
		columns:[[	
//			{field:'id',title:'项目编号',width:100,align:'center'},
			{field:'name',title:'项目名称',width:250,align:'center'},
			
			{field:'action1',title:'申报阶段',align:'center',width:100,
				formatter:function(value,row,index){							
					var c = row.id + "[]";
				    var b="<input type='checkbox' value='0' name=" + c + " onclick='checkAll(" + row.id + ");'/><span>开启</span>";
					var rn='';
					rn=b;
					return rn;
				}
			},			
			{field:'action2',title:'立项阶段',align:'center',width:100,
				formatter:function(value,row,index){							
					var c = row.id + "[]";
				    var b="<input type='checkbox' value='1' name=" + c + " onclick='checkAll(" + row.id + ");'/><span>开启</span>";
					var rn='';
					rn=b;
					return rn;
				}
			},
			{field:'action3',title:'实施阶段',align:'center',width:100,
				formatter:function(value,row,index){							
					var c = row.id + "[]";
				    var b="<input type='checkbox' value='2' name=" + c + " onclick='checkAll(" + row.id + ");'/><span>开启</span>";
					var rn='';
					rn=b;
					return rn;
				}
			},
			  {field:'action4',title:'验收阶段',align:'center',width:100,
				formatter:function(value,row,index){							
					var c = row.id + "[]";
				    var b="<input type='checkbox' value='3' name=" + c + " onclick='checkAll(" + row.id + ");'/><span>开启</span>";
					var rn='';
					rn=b;
					return rn;
				}
			},
			{field:'action5',title:'全选/反选',align:'center',width:100,
				formatter:function(value,row,index){							
					var a = '';
					var b = '';
					var c = row.id + '.radio';
				    a="<input type='radio' id=" + c + " name=" + c + " onclick='chooseAll(" + row.id + ");'/><span>全选</span>";
				    b="<input type='radio' id=" + c + " name=" + c + "rev onclick='reverseAll(" + row.id + ");'/><span>反选</span>";
					var rn='';
					rn=a+b;
					return rn;
				}
			},
		]],	
		onLoadSuccess:function () {
			loadApplyInfo(4);
	    },
	});
}

function loadPage(department){
	dep = department;
	var title='用户信息';
	isDel=0;
	$('#processControl').datagrid({
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
//		url:'/modules/php/action/page/center/center.act.php?action=processControl',
		url:'/modules/php/action/page/center/center.act.php?action=processControl&department='+department,
		columns:[[	
//			{field:'id',title:'项目编号',width:100,align:'center'},
			{field:'name',title:'项目名称',width:250,align:'center'},
			
			{field:'action1',title:'申报阶段',align:'center',width:100,align:'center',
				formatter:function(value,row,index){	
				
					var c = row.id + "[]";	
				    var b="<input type='checkbox' value='0' name=" + c + " onclick='checkAll(" + row.id + ");'/><span>开启</span>";
					var rn='';
					rn=b;
					return rn;
				}
			},			
			{field:'action2',title:'立项阶段',align:'center',width:100,align:'center',
				formatter:function(value,row,index){							
					var c = row.id + "[]";
				    var b="<input type='checkbox' value='1' name=" + c + " onclick='checkAll(" + row.id + ");'/><span>开启</span>";
					var rn='';
					rn=b;
					return rn;
				}
			},
			{field:'action3',title:'实施阶段',align:'center',width:100,align:'center',
				formatter:function(value,row,index){							
					var c = row.id + "[]";
				    var b="<input type='checkbox' value='2' name=" + c + " onclick='checkAll(" + row.id + ");'/><span>开启</span>";
					var rn='';
					rn=b;
					return rn;
				}
			},
			
			  {field:'action4',title:'验收阶段',align:'center',width:100,align:'center',
				formatter:function(value,row,index){							
					var c = row.id + "[]";
				    var b="<input type='checkbox' value='3' name=" + c + " onclick='checkAll(" + row.id + ");'/><span>开启</span>";
					var rn='';
					rn=b;
					return rn;
				}
			},
			{field:'action5',title:'操作',align:'center',width:100,align:'center',
				formatter:function(value,row,index){							
					var a = '';
					var b = '';
					var c = row.id + '.radio';
				    a="<input type='radio' id=" + c + " name=" + c + " onclick='chooseAll(" + row.id + ");'/><span>全选</span>";
				    b="<input type='radio' id=" + c + " name=" + c + "rev onclick='reverseAll(" + row.id + ");'/><span>反选</span>";
					var rn='';
					rn=a+b;
					return rn;
				}},
		]],
		onLoadSuccess:function () {
			loadApplyInfo(department);
	    },
	});
	
}

/*********************************************我****是****分****割****线************************************************/
function processCon(){
	$('#project_process').form('submit',{
		url:'../../../../../modules/php/action/page/center/process.act.php?action=project_process&dep='+dep,
		success:function(result){
//			alert(result);
			var res=eval("("+result+")");
			if(res.code == 0){
				alert("请至少选择一个阶段！");
				window.location.reload();
			}
			else{
				alert("成功修改流程！");
				window.location.reload();
			}
//			$('#project_process').form('reset');
		}
	});
}

// checkbox和radio进行联动；
function checkAll(id){//  id 是对应的每一行 
	var checktag = document.getElementsByName(id+'[]');
	var radiotagAll = $("input[name='"+id+".radio']");
	var radiotagREV = $("input[name='"+id+".radiorev']");
	var flag = 0; //  flag=0 代表全都选中，flag=1代表不是全都选中
	for(var i = 0; i < checktag.length;i++){
		if(!checktag[i].checked){
			flag = 1;
			radiotagAll.prop("checked",false);break;
		}
	}
	if(flag == 0){
		radiotagAll.prop("checked",true);
	}
	radiotagREV.prop("checked",false);
}

//全选的同时还要判断当前如果是全选的，则当前radio为选中的状态
function chooseAll($id){
	var checktag = document.getElementsByName($id+'[]');
	for(var i = 0; i < checktag.length;i++){
		checktag[i].checked = true;
	}
	var radiotagREV = $("input[name='"+$id+".radiorev']");
	radiotagREV.prop("checked",false);
}

//反选
function reverseAll($id){
	var checktag = document.getElementsByName($id+'[]');
	for(var i = 0; i < checktag.length;i++){
		checktag[i].checked = !(checktag[i].checked);
	}
	var radiotagAll = $("input[name='"+$id+".radio']");
	radiotagAll.prop("checked",false);
	
}

//全都不选
function denyAll($id){
	var checktag = document.getElementsByName($id+'[]');
	for(var i = 0; i < checktag.length;i++){
		checktag[i].checked = false;
	}
}


function loadApplyInfo(department){
		dep = department;
		$.get('../../../../../modules/php/action/page/center/process.act.php?action=find_process&dep=' + department,function(result){
			if(result!='0'){
				var res=eval("("+result+")");
				
//				var res = JSON.parse(result);
				console.log(res);
				$.each(res,function(key,value){
					//alert(key);//项目ID
					var checktag = document.getElementsByName(key+'[]');
					//alert(checktag.length);//  这里就没有值 
//					alert(res);
					if(checktag.length!=0){
						if(value.apply_stage == 1){
							checktag[0].checked = true;
						}
						if(value.setup_stage == 1){
							checktag[1].checked = true;
						}
						if(value.carry_stage == 1){
							checktag[2].checked = true;
						}
						if(value.check_stage == 1){
							checktag[3].checked = true;
						}
						checkAll(key); 
					}
					
					 //联动
				});
				
			}
		});
		
	}