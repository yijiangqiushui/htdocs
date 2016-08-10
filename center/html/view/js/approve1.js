  //自动加载;
  $(function()
  {
	loadProjectInfo();
  });
  
  //显示datGrid数据的方法
  function loadProjectInfo()
  {
	  var project_id = GetQueryString("project_id");
//	  alert(project_id);
	  var title='项目信息';
		isDel=0;
		
		$('#projectList').datagrid({
			
			title:title,
			nowrap : true,//设置为true，当数据长度超出列宽时将会自动截
			striped : true,//设置为true将交替显示行背景。
			collapsible : false,//显示可折叠按钮
			singleSelect:true,//为true时只能选择单行
			fitColumns:true,//允许表格自动缩放，以适应父容器
			rownumbers : true,//行数
			pagination:true,//分页
			pageSize: 15,  
			pageList: [5,10,15,20,30], 
			checkOnSelect:false,
			selectOnCheck:false, 
			remoteSort : false,
			toolbar:'#toolbar',
			
			//处理数据得到json的类
			url:'/modules/php/action/page/center/center.act.php?action=project_info&project_id='+project_id,
			
			columns:[[
						
				{field:'project_name',title:'项目名称',width:100,align:'center'},
				{field:'project_id',title:'项目编号',width:100,align:'center'},
				{field:'project_end',title:'主管科室',width:150,align:'center'},
				{field:'project_engineer',title:'主管工程师',width:80,align:'center'},
				{field:'domain',title:'所属领域',width:80,align:'center'},
				{field:'org_name',title:'承担单位',width:80,align:'center'},
				{field:'apply_start',title:'开始时间',width:80,align:'center'},
				{field:'apply_end',title:'结束时间',width:80,align:'center'},
				{field:'project_type',title:'项目类型',width:80,align:'center'}															
			]],
		});
		
		//调用马闯传过来的数据并解析;
		$.post('../../../../website/html/view/template/apply/main_plan.php?action=find',function(result)
				{
			          var res=JSON.parse(result);
			           $('#check_article').form('load',res);	
				});
  }
  
//接受参数
  function GetQueryString(name) {
  	var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
  	var r = window.location.search.substr(1).match(reg);
  	if (r != null)
  		return unescape(r[2]);
  	return null;
  }