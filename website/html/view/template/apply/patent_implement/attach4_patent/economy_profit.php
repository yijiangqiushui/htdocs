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
<script type="text/javascript" src="../../../../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>.
<script type="text/javascript" src="../../../../../../../common/html/js/tablecommon.js"></script>
<script type="text/javascript" src="../../../../../../../website/html/view/js/attach4_patent/economy_profit.js"></script>
</head>
<body>
	<form id="economy_profit" method="post">
 	<div class="project_content">
    	<div class="table_title clearfix">
            <div class="title_pic left">专利可行性分析报告</div>
            <div class="right back_pic" id="back"></div>
        </div>
        
		<div class="table_content back-long">
		 	<div class="basic_info bg_blue">
				<p class="title_top">经济和社会效益分析</p>
				<p class="subtitle"><span class="stitle_num">1</span>、<span class="stitle_name">生产成本估算、销售收入估算。</span><br/></p>
				
				<div class="text_wrap">
					<textarea id="tech_way" name="thing_estimate" class="text_content"></textarea>
				</div>
				<p class="subtitle"><span class="stitle_num">2</span>、<span class="stitle_name">财务分析,以动态分析为主,提供财务内部收益率、贷款偿还期、投资回收期、投资利润率和利税率、财务净现值等指标。</span><br/></p>
				<div class="text_wrap">
					<textarea id="project_manage" name="financial_analysis" class="text_content"></textarea>
				</div>
				<p class="subtitle"><span class="stitle_num">3</span>、<span class="stitle_name">不确定性分析,主要进行盈亏平衡分析和敏感性分析,对项目的抗风险能力作出判断。</span><br/></p>
				<div class="text_wrap">
					<textarea id="project_manage" name="un_analy" class="text_content"></textarea>
				</div>
				<p class="subtitle"><span class="stitle_num">4</span>、<span class="stitle_name">财务分析结论。</span><br/></p>
				<div class="text_wrap">
					<textarea id="project_manage" name="finan_analy" class="text_content"></textarea>
				</div>
				<p class="subtitle"><span class="stitle_num">5</span>、<span class="stitle_name">社会效益分析。</span><br/></p>
				<div class="text_wrap">
					<textarea id="project_manage" name="social_results" class="text_content"></textarea>
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
