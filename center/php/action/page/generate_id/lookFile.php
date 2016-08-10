<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>通州科委项目</title>
<link rel="stylesheet" type="text/css"
	href="../../../../../common/html/plugin/easyui/themes/default/easyui.css" />
<link rel="stylesheet" type="text/css"
	href="../../../../../common/html/plugin/easyui/themes/icon.css" />
<script type="text/javascript"
	src="../../../../../common/html/lib/js/jquery-2.1.0.min.js"></script>
<script type="text/javascript"
	src="../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript"
	src="../../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>

<script type="text/javascript" src="../../../../html/view/js/lookFile.js"></script>
<script type="text/javascript" src="../../../../../center/html/view/js/common.js"></script>
<script type="text/javascript" src="../../../../../center/html/view/js/ukeycommon.js"></script>
<script type="text/javascript" src="../../../../../center/html/view/js/NTClientJavascript.js"></script>
<style type="text/css">
	#fm {
		margin: 0;
		padding: 10px 30px;
	}
	
	.ftitle {
		font-size: 14px;
		font-weight: bold;
		color: #666;
		padding: 5px 0;
		margin-bottom: 10px;
		border-bottom: 1px solid #ccc;
	}
	
	.fitem {
		margin: 5px 0 5px 0;
	}
	
	.fitem label {
		display: inline-block;
		width: 80px;
	}
	
	a {
		text-decoration: none;
	}

	#select {
		display: block;
		padding: 10px 10px;

	}
	
	.left {
		float:left;
	}
	
	.title {
	    margin-left: 10px;
    	font-size: 14px;
    }
    
    .clear {
    	clear:both;
    }
    .m-b10 {
    	margin-bottom: 10px;
    }
</style>
</head>
<body class='easyui-layout'>
	<!-- 对树结构添加右键事件-->
	<!--表结构-->
	<div id="west" data-options="region:'west',title:'项目分类',sqlit:'true'"
		style="width: 200px; padding: 5px;">

		<div style="margin: 20px 0;"></div>
		<ul id = "tree">
			 <!--   <li><span>部门分类</span> <span>部门分类</span>
				<ul>
					<li><span><a href="#" onclick="loadAll(0)">发展计划科</a></span></li>
					<li><span><a href="#" onclick="loadAll(1)">科技综合科</a></span></li>
					<li><span><a href="#" onclick="loadAll(2)">知识产权科</a></span></li>
				</ul></li>-->
		</ul>
	</div>
	<div id='center' data-options="region:'center',split:true">
		<div id="toolbar" class="datagrid-toolbar">
			<a id="select" href="#" class="easyui-linkbutton" iconcls="icon-search" plain="true" style="float:left;">查询</a>
		</div>
		<table id="projectList">
		</table>
	</div>
	<div id="select_block" class="easyui-dialog" style="width: 340px; height: auto; padding: 10px 20px;" closed="true">
		  <form id="select_info">	
			<div class="fitem left">
				<label class="title">项目名称:</label>
				<input name="project_name" class="easyui-validatebox" id="project_name"/>
			</div>
			<div class="fitem left">
				<label class="title">项目编号:</label>
				<input name="project_id" class="easyui-validatebox" id="project_id"/>
			</div>
			<div class="fitem left">
				<label class="title">主管工程师:</label>
				<input name="project_engineer" class="easyui-validatebox" id="project_engineer"/>
			</div>
			<div class="fitem left">
				<label class="title">开始时间:</label>
				<input name="start_time" class="easyui-datebox" id="start_time" data-options="formatter:myformatter,parser:myparser" class="project_start" />
			</div>
			<div class="fitem left">
				<label class="title">结束时间:</label>
				<input name="end_time" class="easyui-datebox" id="end_time" data-options="formatter:myformatter,parser:myparser" class="project_end"/>
			</div>
			<div class="clear"></div>
			<div style="text-align:center; margin-top:5px;">
				<a href="javascript:void(0);" class="easyui-linkbutton" iconCls="icon-ok" onclick="select();">确认</a>
				<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#select_block').dialog('close')">取消</a>
			</div>
		  </form>
	</div>
<script>
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
</script>
</body>
</html>


