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
<script type="text/javascript" src="../../js/projectapp/pro_target.js"></script>
<script type="text/javascript" src="../../js/projectapp/is_edit_front.js"></script>
<?php }?>
<link rel="stylesheet" type="text/css" href="../../css/table.css" />
<link rel="stylesheet" type="text/css" href="../../css/button.css" />
<link rel="stylesheet" type="text/css" href="../../css/style.css" />
</head>
<body>
<form id="pro_target" method="post">

    <div class="project_content">
    	<div class="table_title clearfix">
            <div class="title_pic left">项目任务书填写</div>
            <div class="right back_pic" id="back"></div>
        </div>
		<div class="table_content back-long">
		 	<div class="basic_info bg_blue">
				<p class="title_top">项目任务与目标、考核指标</p>
				<p class="subtitle"><span class="stitle_num">1</span>、<span class="stitle_name">项目任务</span>：（<span class="stitle_tip">项目任务应明确科技工作在解决实际问题中的责任和完成工作的范围、界限，即项目全部工作和成果的整体描述。</span>）</p>
				<div class="text_wrap">
					<textarea name="project_mission" id="project_mission" class="text_content"></textarea>
				</div>
				<p class="subtitle"><span class="stitle_num">2</span>、<span class="stitle_name">项目目标</span>：（<span class="stitle_tip">项目目标内容应完整、明确，并能够考查项目完成的程度和实际效果。包括定性、定量两个部分，定性的内容应概括项目预期效果的几个方面，定量的内容应说明预期效果的程度和范围。</span>）</p>
				<div class="text_wrap">
					<textarea name="project_aim" id="project_aim" class="text_content"></textarea>
				</div>
				<p class="subtitle"><span class="stitle_num">3</span>、<span class="stitle_name">考核指标</span>：（<span class="stitle_tip">考核指标应体现项目目标预期完成程度和水平，以及对项目各项研究开发内容预期完成情况的考核。指标体系应系统、完整，客观可检查；项目目标和考核指标应能够系统、完整地表达任务完成情况，具有成果的依附形式或载体，体现实际效果，可查、可测、可看。</span>）</p>
				<div class="text_wrap">
					<textarea id="project_kpi" name="project_kpi" class="text_content"></textarea>
				</div>
				<div class="button_wrapper clearfix">
<!-- 					<div class="submit" >提交</div> -->
				   <div class="save" >保存</div>
				   <!-- <div class="reset" >重置</div> -->
				</div>
			</div>
		</div>
	</div>
	
</form>
</body>
</html>
