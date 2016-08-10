<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>无标题文档</title>
<link rel="stylesheet" type="text/css" href="../../../../../common/html/plugin/easyui/themes/default/easyui.css" />
<link rel="stylesheet" type="text/css" href="../../../../../common/html/plugin/easyui/themes/icon.css" />
<script type="text/javascript" src="../../../../../center/html/view/js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="../../../../../common/html/plugin/jquery-hlui-2.0/js/hlui.js"></script>
<script type="text/javascript" src="../../../../../common/html/plugin/jquery-hlui-2.0/js/form.js"></script>
<script type="text/javascript" src="../../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>
<script type="text/javascript" src="../../../../../common/html/js/tablecommon.js"></script>
<script type="text/javascript" src="../../../../../common/html/js/validation.js"></script>
<script type="text/javascript" src="../../js/projectapp/expert_arguments.js"></script>
<link rel="stylesheet" type="text/css" href="../../css/table.css" />
<link rel="stylesheet" type="text/css" href="../../css/button.css" />
</head>
<body>
	<div class="project_content">
		<div class="table_title clearfix">
			<div class="title_pic left">专家论证意见填写</div>
			<div class="right back_pic" id="back"></div>
		</div>

		<div class="table_content back-long">
			<form method="post" action="" id="appFm">
				<div class="basic_info">
					<div class="title_top p-b10">专家组论证意见</div>
					<div class="clearfix border-w">
						<div class="title_span left">项目名称</div>
						<div class="input_span left"><input name="project_name"  type="text" /></div>
					</div>
					<p class="subtitle">论证意见</p>
					<div class="text_wrap">
						<textarea id="project_expect" name="expert_arguments" class="text_content"></textarea>
						<div class="button_wrapper clearfix">
			                <div class="save" >保存</div>
			            </div>
					</div>
	        	</div>
			</form>	
		</div>		
</body>
</html>
