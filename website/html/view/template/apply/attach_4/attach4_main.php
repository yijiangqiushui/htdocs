
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link  rel="stylesheet" type="text/css"  href="../../../../../../common/html/plugin/easyui/themes/default/easyui.css" />
<link rel="stylesheet" type="text/css"  href="../../../../../../common/html/plugin/easyui/themes/icon.css" />
<link href="../../../css/button.css" rel="stylesheet" type="text/css" />

<link href="../../../css/apply/attach4/attach4_main.css" rel="stylesheet" type="text/css" />

<script src="../../../../../../common/html/lib/js/jquery-1.11.2.min.js"></script>
<script type="text/javascript"  src="../../../../../../common/html/plugin/jquery-hlui-2.0/js/hlui.js"></script>
<script type="text/javascript" src="../../../../../../common/html/plugin/jquery-hlui-2.0/js/form.js"></script>
<script type="text/javascript" src="../../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="../../../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>
<script src="../../../js/apply/app_comon.js"></script>
<script src="../../../../../../common/html/js/piccommon.js"></script>
<script src="../../../../../../common/html/js/attachcommon.js"></script>
<script src="../../../js/apply/attach_4/attach4_main.js"></script>
<script type="text/javascript" src="../../../../../../center/html/view/js/ukeycommon.js"></script>
<script type="text/javascript" src="../../../../../../center/html/view/js/NTClientJavascript.js"></script>
</head>
<body>
<div class="wrapper">
	<div class="body">
	<div class="func-bar">
	</div>
		<div class="menusNiframe">
		  <div class="menus-scroll-hidden">      	
			<div class="menus">
				<ul>
                	<div class="menu-bar"><div title ='通州区支持承担市级以上科技项目申报书'>支持承担市级以上科技项目</div></div>
                	
					<li class="menu menu-unselected org_info clearfix">申报单位基本情况<div class="right pic hide"></div></li>
					<li class="menu menu-unselected project_info clearfix">项目基本情况<div class="right pic hide"></div></li>
					<li class="menu menu-unselected approve">签署意见及承诺<div class="right pic hide"></div></li>
                    <li class="menu menu-unselected check clearfix" id="opinion">审核意见</li>
                    <?php if(false === $app->is_new){  ?>
                    <?php }else{
						if($app->relative_list){
							foreach($app->relative_list as $key=>$item){
								echo '<li stid="'.$item['id'].'" url="'.$item['tpl_url'].'?str_id='.$item['id'].'" class="menu menu-unselected check_define clearfix">'.$item['sl_name'].'</li>';
							}
						}
					} ?>
                    <li class="menu menu-unselected submit clearfix" id="sub" onclick="execute();">提交项目申报书</li>
				</ul>
			 </div>
			</div> <!-- menus-scroll-hidden -->
			<div class="switch-bar"><div class="switch-bar-arrow"></div></div>
			<div class="iframe"><iframe name="subframe" src="org_info.html" frameborder="0"></iframe></div>
			
		</div><!--menusNiframe-->
	</div><!--body-->
</div><!--wrapper-->
</body>
</html>


