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
<script type="text/javascript" src="../../js/projectapp/is_edit_common.js"></script>
<?php if(isset($_GET['is_edit'])&&$_GET['is_edit']){?>
<script type="text/javascript" src="../../js/projectapp/is_edit.js"></script>
<?php }else{ ?>
<script type="text/javascript" src="../../js/projectapp/task_project_techway.js"></script>
<script type="text/javascript" src="../../js/projectapp/is_edit_front.js"></script>
<?php }?>
<link rel="stylesheet" type="text/css" href="../../css/style.css" />
<link rel="stylesheet" type="text/css" href="../../css/table.css" />
<link rel="stylesheet" type="text/css" href="../../css/button.css" />
<style>
p {
	font-size: 16px;
}

body {
	margin: auto 0;
}
</style>
</head>
<body>

<form id="project_tech" method="post">
 	<div class="project_content">
    	<div class="table_title clearfix">
            <div class="title_pic left">项目任务书填写</div>
            <div class="right back_pic" id="back"></div>
        </div>
		<div class="table_content back-long">
		 	<div class="basic_info bg_blue">

				<p class="title_top">项目技术方案与技术路线</p>
				<p class="subtitle">1、技术方案与技术路线 （依据项目任务要求，结合国内外技术发展和本单位实际情况确定，论证前应充分分析和阐述技术方案与技术路线，对不同方案和路线加以比较和论证说明。</span>）</p>
				<div class="text_wrap">
					<textarea id="tech_way" name="tech_way" class="text_content"></textarea>
				</div>
				 <p class="subtitle" >2、项目组织实施与管理措施( 项目的组织管理和协调措施应能保障项目的正常实施；应能落实项目实施所需配套条件；项目负责人应能切实履行项目管理职责；应能落实项目任务所需的研究团队和配套仪器设备、经费等条件，有完善的科技管理制度。)</p>
				
				<div class="text_wrap">
					<textarea id="project_manage" name="project_manage" class="text_content"></textarea>
				</div>
	            <p class="subtitle" >3、考核指标(需另附委托或合作协议) （项目的组织管理和协调措施应能保障项目的正常实施；应能落实项目实施所需配套条件；项目负责人应能切实履行项目管理职责；应能落实项目任务所需的研究团队和配套仪器设备、经费等条件，有完善的科技管理制度。）如有委托研究的任务，受托单位确保委托任务完成的措施；如有多家单位承担项目任务，阐明项目的任务分工及相应的目标和考核指标。）</p>
				
				<div class="text_wrap">
					<textarea id="delegation_task" name="delegation_task" class="text_content"></textarea>
				</div>
				<div class="button_wrapper clearfix">
					<!-- <div class="submit" >提交</div> -->
				   <div class="save" >保存</div>
				   <!-- <div class="reset" >重置</div> -->
				</div>
			</div>
		</div>
	</div>
</form>



</body>
</html>
