<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>申报单位基本情况</title>
 <link rel="stylesheet" type="text/css"
              href="../../../../../../../common/html/plugin/easyui/themes/default/easyui.css" />
              <link rel="stylesheet" type="text/css" href="../../../../../../../common/html/plugin/easyui/themes/icon.css" />
<!-- <link rel="stylesheet" type="text/css" href="../../../../../../../website/html/view/css/tablestyle.css" /> -->
<link rel="stylesheet" type="text/css" href="../../../../css/table.css"/>
<link rel="stylesheet" type="text/css" href="../../../../css/button.css" />
<script type="text/javascript" src="../../../../../../../common/html/plugin/easyui/jquery.min.js"></script>
<script type="text/javascript" src="../../../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="../../../../../../../common/html/plugin/jquery-hlui-2.0/js/hlui.js"></script>
<script type="text/javascript" src="../../../../../../../common/html/plugin/jquery-hlui-2.0/js/form.js"></script>
<script type="text/javascript" src="../../../../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>
<script type="text/javascript" src="../../../../../../../common/html/js/tablecommon.js"></script>
<script type="text/javascript" src="../../../../../../../website/html/view/js/attach4_patent/abstract.js"></script>
	<script type="text/javascript" src="../../../../../../../common/html/js/validation.js"></script>

</head>
<body>
	<form id="abstract" method="post">
 	<div class="project_content">
    	<div class="table_title clearfix">
            <div class="title_pic left">专利可行性分析报告</div>
            <div class="right back_pic" id="back"></div>
        </div>
        
		<div class="table_content back-long">
		 	<div class="basic_info bg_blue">

				<p class="title_top">通州区专利实施项目可行性分析研究报告概述</p>
				
				<p class="subtitle">1、申请项目的概述（<span class="stitle_tip">应包括项目中专利的基本情况、项目的主要内容、技术水平，主要用途及应用范围（限400字以内）。）</p>
				<div class="text_wrap">
					<textarea id="tech_way" name="project_summary" class="text_content" datalength="400"></textarea>
				</div>
				<p class="subtitle">2、简述项目的社会经济意义、目前的进展情况、申请专利实施资金的必要性。</p>
				<div class="text_wrap">
					<textarea id="project_manage" name="social_mean" class="text_content"></textarea>
				</div>
				
				<p class="subtitle">3、简述本企业实施项目的优势和风险。</p>
				<div class="text_wrap">
					<textarea id="delegation_task" name="advan_risks" class="text_content"></textarea>
				</div>
				<p class="subtitle">4、项目计划目标。</p>
				<div class="text_wrap">
					<textarea id="delegation_task" name="plan_target" class="text_content"></textarea>
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
