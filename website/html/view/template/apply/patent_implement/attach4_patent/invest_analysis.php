<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>申报单位基本情况</title>

<link rel="stylesheet" type="text/css" href="../../../../../../../common/html/plugin/easyui/themes/default/easyui.css"></link>
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
<script type="text/javascript" src="../../../../../../../website/html/view/js/attach4_patent/invest_analysis.js"></script>

</head>
<body>
	<form id="invest_analysis" method="post">
 	<div class="project_content">
    	<div class="table_title clearfix">
            <div class="title_pic left">专利可行性分析报告</div>
            <div class="right back_pic" id="back"></div>
        </div>
        
		<div class="table_content back-long">
		 	<div class="basic_info bg_blue">
				<p class="title_top">投资估算及资金筹措</p>
				<p class="subtitle"><span class="stitle_num">1</span>、<span class="stitle_name">项目投资估算。</span><br/></p>
				
				<div class="text_wrap">
					<textarea id="tech_way" name="invest_estimate" class="text_content"></textarea>
				</div>
				<p class="subtitle"><span class="stitle_num">2</span>、<span class="stitle_name">资金筹措方案。</span><br/></p>
				<div class="text_wrap">
					<textarea id="project_manage" name="financing_scheme" class="text_content"></textarea>
				</div>
				<p class="subtitle"><span class="stitle_num">3</span>、<span class="stitle_name">投资使用计划。</span><br/></p>
				<div class="text_wrap">
					<textarea id="project_manage" name="invest_use_plan" class="text_content"></textarea>
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
