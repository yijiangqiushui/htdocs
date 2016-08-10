<?php
include dirname(__FILE__)."/../common.php";
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>实施方案</title>
<link  rel="stylesheet" type="text/css"  href="../../../../../../common/html/plugin/easyui/themes/default/easyui.css" />
<link rel="stylesheet" type="text/css"  href="../../../../../../common/html/plugin/easyui/themes/icon.css" />
<link href="../../../css/button.css" rel="stylesheet" type="text/css" />
<link href="../../../css/apply/attach1/attach1_main.css" rel="stylesheet" type="text/css" />

<script src="../../../../../../common/html/lib/js/jquery-1.11.2.min.js"></script>
<script type="text/javascript"  src="../../../../../../common/html/plugin/jquery-hlui-2.0/js/hlui.js"></script>
<script type="text/javascript" src="../../../../../../common/html/plugin/jquery-hlui-2.0/js/form.js"></script>
<script type="text/javascript" src="../../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="../../../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>

<script src="../../../js/apply/app_comon.js"></script>
<script src="../../../../../../common/html/js/piccommon.js"></script>
<script src="../../../../../../common/html/js/attachcommon.js"></script>
<script src="../../../js/apply/attach_1/attach1_main.js"></script>
<script type="text/javascript" src="../../../../../../center/html/view/js/ukeycommon.js"></script>
<script type="text/javascript" src="../../../../../../center/html/view/js/NTClientJavascript.js"></script>
</head>
<body>
	<div class="wrapper">
	<div class="body">
	<div class="func-bar"></div>
		<div class="menusNiframe">
		  <div class="menus-scroll-hidden">
			<div class="menus"  >
				<ul style="list-style: none;">
                	<div class="menu-bar" style="text-align: center;"><div style="width:80px">实施方案</div></div>
					<?php if(false === $app->is_new){  ?>
					<li class="menu menu-unselected org_info clearfix">项目承担单位基本信息<div class="right pic hide"></div></li>
					<li class="menu menu-unselected project_mean clearfix">项目的目的、意义及必要性<div class="right pic hide"></div></li>
					<li class="menu menu-unselected work_base clearfix">相关行业、领域国内外研究发展现状、趋势以及本单位在相关领域的工作基础<div class="right pic hide"></div></li>
					<li class="menu menu-unselected project_target clearfix">项目任务与目标、考核指标<div class="right pic hide"></div></li>
					<li class="menu menu-unselected project_content clearfix">项目研究开发内容<div class="right pic hide"></div></li>
					<li class="menu menu-unselected tech_route clearfix">项目技术方案与技术路线<div class="right pic hide"></div></li>
					<li class="menu menu-unselected project_plan clearfix">项目各年度任务目标、考核指标及研究开发内容完成的计划进度<div class="right pic hide"></div></li>
					<li class="menu menu-unselected project_budget clearfix">项目经费预算<div class="right pic hide"></div></li>   <!-- 这个需要更改一下 -->
					<li class="menu menu-unselected project_risk clearfix">项目实施的风险分析及规避预案<div class="right pic hide"></div></li>
					<li class="menu menu-unselected expect_manage clearfix">预期成果形式、知识产权归属与管理<div class="right pic hide"></div></li>
					<li class="menu menu-unselected recommend_plan clearfix">项目完成后的经济社会效益分析与成果推广方案<div class="right pic hide"></div></li>
					<li class="menu menu-unselected project_member clearfix">项目承担单位、参加单位、项目负责人、项目研究人员<div class="right pic hide"></div></li>
					<li class="menu menu-unselected approve clearfix">签署意见及承诺<div class="right pic hide"></div></li>
                    <!-- 附件上传和审核意见放到下面去了 -->
					<?php }else{
						if($app->relative_list){
							foreach($app->relative_list as $key=>$item){
								echo '<li stid="'.$item['id'].'" url="'.$item['tpl_url'].'?str_id='.$item['id'].'" class="menu menu-unselected '.$item['st_name'].' check_define clearfix">'.$item['sl_name'].'<div class="right pic hide"></div></li>';
							}
						}
					} ?>
					<li class="menu menu-unselected imp_plan clearfix">附件上传<div class="right pic hide"></div></li>
                    <li class="menu menu-unselected check clearfix">审核意见</li>
                    <li class="menu menu-unselected submit" id="sub" onclick="execute()"><p style='text-align: center;'>提交项目实施方案</p></li>
				</ul>
			</div><!-- menus -->
			</div>			
			<div class="switch-bar" id="swich2"><div class="switch-bar-arrow"></div></div>
			<div class="iframe"><iframe name="subframe" src="../../Projectapp/org_info.php" frameborder="0" id="iframe2"></iframe></div>
		</div><!--menusNiframe-->
	</div><!--body-->
</div><!--wrapper-->
</body>
</html>
