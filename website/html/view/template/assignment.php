<?php
include dirname(__FILE__)."/apply/common.php";
?> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link  rel="stylesheet" type="text/css"  href="../../../../common/html/plugin/easyui/themes/default/easyui.css" />
<link rel="stylesheet" type="text/css"  href="../../../../common/html/plugin/easyui/themes/icon.css" />
<link href="../css/assignment/assignment.css" rel="stylesheet" type="text/css" />
<link href="../css/button.css" rel="stylesheet" type="text/css" />
<script src="../../../../common/html/lib/js/jquery-1.11.2.min.js"></script>
<script type="text/javascript"  src="../../../../common/html/plugin/jquery-hlui-2.0/js/hlui.js"></script>
<script type="text/javascript" src="../../../../common/html/plugin/jquery-hlui-2.0/js/form.js"></script>
<script type="text/javascript" src="../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>
<script src="../js/apply/app_comon.js"></script>
<script src="../../../../common/html/js/piccommon.js"></script>
<script src="../../../../common/html/js/attachcommon.js"></script>
<script type="text/javascript" src="../js/assignment.js"></script>
<script type="text/javascript" src="../../../../center/html/view/js/ukeycommon.js"></script>
<script type="text/javascript" src="../../../../center/html/view/js/NTClientJavascript.js"></script>
</head>
<body>
  <!--“立项阶段”的汇总页面  项目任务书 -->
<div class="wrapper">
	<div class="body">
	<div class="func-bar">
	</div>	
		<div class="menusNiframe">
			<div class="menus-scroll-hidden">
			<div class="menus">
				<ul tyle="list-style: none">
				<div class="menu-bar"><div>项目任务书</div></div>
				<?php if(false === $app->is_new){  ?>
                <li class="menu menu-unselected org_info clearfix">项目承担单位基本信息<div class="right pic hide"></div></li>
				<li class="menu menu-unselected project_target clearfix">项目的任务、目标及考核指标<div class="right pic hide"></div></li>
				<li class="menu menu-unselected project_content clearfix">主要研究开发内容<div class="right pic hide"></div></li>
				<li class="menu menu-unselected project_techway clearfix">项目技术方案与技术路线<div class="right pic hide"></div></li>
				<li class="menu menu-unselected project_ann_plan clearfix">项目各年度任务目标、考核指标及研究开发内容完成的计划进度<div class="right pic hide"></div></li>
				<li class="menu menu-unselected total_fund clearfix">项目经费预算<div class="right pic hide"></div></li>
				<li class="menu menu-unselected project_expert_form clearfix">预期成果形式、知识产权归属与管理<div class="right pic hide"></div></li>
				<li class="menu menu-unselected project_member clearfix">项目承担单位、参加单位、主要研究人员<div class="right pic hide"></div></li>
				<li class="menu menu-unselected other_condition clearfix">其他条款<div class="right pic hide"></div></li>
				<li class="menu menu-unselected plan_parties clearfix">任务书各方<div class="right pic hide"></div></li>
				
				<?php }else{
// 					    var_dump($app->relative_list);
						if($app->relative_list){
							foreach($app->relative_list as $key=>$item){
								echo '<li stid="'.$item['id'].'" url="'.$item['tpl_url'].'?str_id='.$item['id'].'" class="menu menu-unselected '.$item['st_name'].' check_define clearfix">'.$item['sl_name'].'<div class="right pic hide"></div></li>';
							}
						}
					} ?>
				<li class="menu menu-unselected imp_plan clearfix">附件上传<div class="right pic hide"></div></li>
				<li class="menu menu-unselected check clearfix">审核意见<div class="right pic hide"></div></li>
                <li class="menu menu-unselected submit" id="sub" onclick="execute();">提交项目任务书</li>
				</ul>
			  </div>
			 </div>
			<div class="switch-bar" id="swich2"><div class="switch-bar-arrow"></div></div>
			<div class="iframe"><iframe name="subframe" src="Projectapp/org_info.php" frameborder="0"  id="iframe2"></iframe></div>
			
		</div><!--menusNiframe-->
	</div><!--body-->
</div><!--wrapper-->
</body>
</html>


