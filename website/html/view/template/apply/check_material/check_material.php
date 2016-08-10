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
<script src="../../../../../../common/html/js/attachcommon.js"></script>
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
                	<div class="menu-bar"><div>专利验收报告书</div></div>
				
					<li class="menu menu-unselected unit_info clearfix">项目单位基本情况<div class="right pic hide"></div></li>
					<li class="menu menu-unselected org_info clearfix">项目基本情况<div class="right pic hide"></div></li>
					<li class="menu menu-unselected authent clearfix">项目实施过程中企业通过质量认证情况<div class="right pic hide"></div></li>
					<li class="menu menu-unselected index_complete clearfix">项目经济考核指标及完成情况 <div class="right pic hide"></div></li>
					<li class="menu menu-unselected spread clearfix">项目（产品）推广扩散情况<div class="right pic hide"></div></li>
					<li class="menu menu-unselected develop clearfix">项目实施过程中企业研发新专利、开发新产品情况<div class="right pic hide"></div></li>
					<li class="menu menu-unselected talent_training clearfix">项目实施过程中人才培训情况<div class="right pic hide"></div></li>
					<li class="menu menu-unselected funds_use clearfix">项目资金使用情况<div class="right pic hide"></div></li>  
					<li class="menu menu-unselected improve clearfix">项目单位能力改善提高情况<div class="right pic hide"></div></li>
					<li class="menu menu-unselected unit_opinion clearfix">项目单位意见<div class="right pic hide"></div></li>  
					<li class="menu menu-unselected final_opinion clearfix">知识产权局验收意见<div class="right pic hide"></div></li>
					
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
