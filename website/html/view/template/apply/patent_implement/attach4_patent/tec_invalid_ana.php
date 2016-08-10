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
<script type="text/javascript" src="../../../../../../../website/html/view/js/attach4_patent/tec_invalid_ana.js"></script>

</head>
<body>
		<form id="tec_invalid_ana" method="post">
 	<div class="project_content">
    	<div class="table_title clearfix">
            <div class="title_pic left">专利可行性分析报告</div>
            <div class="right back_pic" id="back"></div>
        </div>
        
		<div class="table_content back-long">
		 	<div class="basic_info bg_blue">

				<p class="title_top">技术可行性分析</p>
				<p class="subtitle"><span class="stitle_num">1</span>、<span class="stitle_name">详细说明本项目的基本原理、实施方案和技术路线、关键技术内容及项目涉及专利的情况。</span><br/></p>
				<div class="text_wrap">
					<textarea id="tech_way" name="basic_principle" class="text_content"></textarea>
				</div>
				<p class="subtitle"><span class="stitle_num">2</span>、<span class="stitle_name">国内外同类产品的专利检索情况（产品核心技术的专利情况），本项目产品技术性能水平与其的比较。</span><br/></p>
				<div class="text_wrap">
					<textarea id="project_manage" name="foreign_patents" class="text_content"></textarea>
				</div>
				
				<p class="subtitle"><span class="stitle_num">3</span>、<span class="stitle_name">本企业及技术依托单位或合作单位的研究开发实力。</span></p>
				<div class="text_wrap">
					<textarea id="delegation_task" name="coop_org" class="text_content"></textarea>
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
