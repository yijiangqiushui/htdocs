<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>无标题文档</title>
<link rel="stylesheet" type="text/css"
	href="../../../../../common/html/plugin/easyui/themes/default/easyui.css" />
<link rel="stylesheet" type="text/css"
	href="../../../../../common/html/plugin/easyui/themes/icon.css" />
<script type="text/javascript"
	src="../../../../../common/html/plugin/easyui/jquery.min.js"></script>
<script type="text/javascript"
	src="../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript"
	src="../../../../../common/html/plugin/jquery-hlui-2.0/js/hlui.js"></script>
<script type="text/javascript"
	src="../../../../../common/html/plugin/jquery-hlui-2.0/js/form.js"></script>
<script type="text/javascript"
	src="../../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>
<script type="text/javascript" src="../../../../../common/html/js/tablecommon.js"></script>
	
<script type="text/javascript" src="../../../../../common/html/js/validation.js"></script>
<script type="text/javascript" src="../../js/projectapp/is_edit_common.js"></script>
<?php if(isset($_GET['is_edit'])&&$_GET['is_edit']){?>
<script type="text/javascript" src="../../js/projectapp/is_edit.js"></script>
<?php }else{ ?>
<script type="text/javascript" src="../../js/projectapp/task_project_content.js"></script>
<script type="text/javascript" src="../../js/projectapp/is_edit_front.js"></script>
<?php }?>
<link rel="stylesheet" type="text/css" href="../../css/style.css" />
<link rel="stylesheet" type="text/css" href="../../css/table.css" />
<link rel="stylesheet" type="text/css" href="../../css/button.css" />
</head>
 <form id="pro_content" method="post">
    	<div class="project_content">
	    	<div class="table_title clearfix">
	            <div class="title_pic left">项目任务书填写</div>
	            <div class="right back_pic" id="back"></div>
	        </div>
		    <div class="table_content back-long">
				<div class="basic_info bg_blue">
					 <p class="title_top">项目研究开发内容</p>
					 <p class="subtitle">项目主要研发内容、关键技术及创新点，对完成项目目标和考核指标的重要性。</p>
					 <div class="text_wrap">
						<textarea id="project_content" name="project_content" class="text_content"></textarea>
					</div>
					<div class="button_wrapper clearfix">
					<!-- 	<div class="submit" >提交</div> -->
					   <div class="save" >保存</div>
					   <!-- <div class="reset" >重置</div> -->
					</div>
				</div>
			</div>
		</div>
	</form>


</body>
</html>
