
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>实施方案</title>
 <link rel="stylesheet" type="text/css" href="../../../../../../../common/html/plugin/easyui/themes/default/easyui.css"/>
    <link rel="stylesheet" type="text/css" href="../../../../../../../common/html/plugin/easyui/themes/icon.css"/>
    <link href="../../../../css/button.css" rel="stylesheet" type="text/css" />
<script src="../../../../../../../common/html/lib/js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="../../../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
<script src="../../../../js/apply/app_comon.js"></script>
<link href="../../../../css/apply/attach4_patent/attach4_patent.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../../../../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>
<script src="../../../../../../../common/html/js/piccommon.js"></script>
<script src="../../../../../../../common/html/js/attachcommon.js"></script>
<script src="../../../../js/apply/patent_implement/attach4_patent.js" type="text/javascript"></script>
<script type="text/javascript" src="../../../../../../../center/html/view/js/ukeycommon.js"></script>
<script type="text/javascript" src="../../../../../../../center/html/view/js/NTClientJavascript.js"></script>

<style>
 .menu{
	position:relative;
 }
</style>
 
</head>
<body>
	<div class="wrapper">
	<div class="body">
	<div class="func-bar">
	</div>
		<div class="menusNiframe">
		  <div class="menus-scroll-hidden">
			<div class="menus">
				<ul style="list-style: none">
                	<div class="menu-bar"><div title="专利可行性分析研究报告">专利实施可行性分析报告</div></div>
					
					<li class="menu menu-unselected abstract clearfix">概述<div class="right pic hide"></div></li>
					<li class="menu menu-unselected org_info clearfix">申报企业情况<div class="right pic hide"></div></li>
					<li class="menu menu-unselected tec_invalid_ana clearfix">技术可行性分析<div class="right pic hide"></div></li>
					<li class="menu menu-unselected project_extent clearfix">项目成熟程度<div class="right pic hide"></div></li>
					<li class="menu menu-unselected market_situation clearfix">市场需求情况<div class="right pic hide"></div></li>
					<li class="menu menu-unselected invest_analysis clearfix">投资估算及资金筹措<div class="right pic hide"></div></li>
					<li class="menu menu-unselected economy_profit clearfix">经济和社会效益分析<div class="right pic hide"></div></li>
					<li class="menu menu-unselected project_effect clearfix">项目实施进度计划<div class="right pic hide"></div></li>
                    <li class="menu menu-unselected imp_plan clearfix">附件上传<div class="right pic hide"></div></li>
                    <li class="menu menu-unselected check clearfix">审核意见</li>
					<?php if(false === $app->is_new){  ?>
					<?php }else{
						if($app->relative_list){
							foreach($app->relative_list as $key=>$item){
								echo '<li stid="'.$item['id'].'" url="'.$item['tpl_url'].'?str_id='.$item['id'].'" class="menu menu-unselected check_define clearfix">'.$item['sl_name'].'</li>';
							}
						}
					} ?>
                    <li class="menu menu-unselected submit" id="sub" onclick="execute()">提交专利可行性分析报告</li>
				</ul>
			</div>
			</div>
			<div class="switch-bar" id="swich2"><div class="switch-bar-arrow"></div></div>
			<div class="iframe"><iframe name="subframe" src="abstract.php" frameborder="0" id="iframe2"></iframe></div>
		  
		</div><!--menusNiframe-->
	</div><!--body-->
</div><!--wrapper-->
</body>
</html>

