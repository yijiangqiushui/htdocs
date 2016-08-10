 <?php
include dirname(__FILE__)."/../common.php";
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>实施方案</title>
<script src="../../../../../../common/html/lib/js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="../../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
<script src="../../../js/apply/app_comon.js"></script>
<script src="../../../js/apply/genious_award/genious_award.js"></script>
<link href="../../../css/apply/genious_award/genious_award.css" rel="stylesheet" type="text/css" />
<style>
#sub{width:199px;
     height:33px; 
     background-image:url(../../../img/main-xmsbxt/manage.png); 
     float:left;
     color:#ffffff;
     font-size:20px;
 }
</style>
</head>
<body>
	<div class="wrapper">
	<div class="body">
	<div class="func-bar">
	</div>
		<div class="menusNiframe">
			<div class="menus">
				<ul style="list-style: none">
                	<div class="menu-bar"><div>专利资助协议书</div></div>
					<li class="menu menu-unselected pro_target clearfix">项目的实施目标及考核指标<div class="right pic hide"></div></li>
					<li class="menu menu-unselected pro_meaning clearfix">项目实施主要内容及意义<div class="right pic hide"></div></li>
					<li class="menu menu-unselected pro_doing clearfix">项目实施计划和阶段任务<div class="right pic hide"></div></li>
					<li class="menu menu-unselected pro_fund clearfix">项目经费总预算 <div class="right pic hide"></div></li>
					<li class="menu menu-unselected pro_belong clearfix">项目预期成果提供形式、知识产权归属<div class="right pic hide"></div></li>
					<li class="menu menu-unselected pro_member clearfix">项目承担单位、协作单位、主要人员<div class="right pic hide"></div></li>
					<li class="menu menu-unselected common_rule clearfix">共同条款<div class="right pic hide"></div></li>
					<li class="menu menu-unselected other_rule clearfix">其他条款<div class="right pic hide"></div></li>  
					<li class="menu menu-unselected book_others clearfix">协议书各方<div class="right pic hide"></div></li>
					
                    <li class="menu menu-unselected check clearfix">审核意见</li>
					
                    <li class="menu menu-unselected submit" id="sub" onclick="execute()">提交实施方案</li>
				</ul>
			</div>
			<div class="switch-bar" id="swich2"><div class="switch-bar-arrow"></div></div>
			<div class="iframe"><iframe name="subframe" src="../../Projectapp/org_info.php" frameborder="0" id="iframe2"></iframe></div>
		</div><!--menusNiframe-->
	</div><!--body-->
</div><!--wrapper-->
</body>
</html>
