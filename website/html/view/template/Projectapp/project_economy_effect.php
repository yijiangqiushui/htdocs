<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>无标题文档</title>
<link rel="stylesheet" type="text/css"
	href="../../../../../common/html/plugin/easyui/themes/default/easyui.css" />
<link rel="stylesheet" type="text/css"
	href="../../../../../common/html/plugin/easyui/themes/icon.css" />
<script type="text/javascript"
	src="../../../../../common/html/plugin/easyui/jquery.min.js"></script>
<script type="text/javascript"
	src="../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript"
	src="../../../../../common/html/plugin/jquery-hlui-2.0/js/hlui.js"></script>
<script type="text/javascript"
	src="../../../../../common/html/plugin/jquery-hlui-2.0/js/form.js"></script>
<script type="text/javascript"
	src="../../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>
<script type="text/javascript" src="../../../../../common/html/js/tablecommon.js"></script>	
<script type="text/javascript" src="../../js/projectapp/is_edit_common.js"></script>
<?php if(isset($_GET['is_edit'])&&$_GET['is_edit']){?>
<script type="text/javascript" src="../../js/projectapp/is_edit.js"></script>
<?php }else{ ?>
<script type="text/javascript" src="../../js/projectapp/project_effect.js"></script>
<script type="text/javascript" src="../../js/projectapp/is_edit_front.js"></script>
<?php }?>
	
<link rel="stylesheet" type="text/css" href="../../css/style.css" />
<link rel="stylesheet" type="text/css" href="../../css/table.css" />
<link rel="stylesheet" type="text/css" href="../../css/button.css" />

</head>

<body>
 	<form id="project_effect" method="post">
 		<div class="project_content">
	   		<div class="table_title clearfix">
	            <div class="title_pic left">项目实施方案填写</div>
	            <div class="right back_pic" id="back"></div>
	        </div>
			<div class="table_content back-long">
				<div class="basic_info bg_blue">
					<p class="title_top">项目完成后的经济社会效益分析及成果推广方案</p>
					<p class="subtitle"><span class="stitle_num">1</span>、<span class="stitle_name">项目完成后的经济社会效益分析及成果推广方案</span><br/> （<span class="stitle_tip">项目完成后的经济社会效益分析应与项目的目的、意义及必要性相对应。成果推广方案应明确项目成果的应用推广领域、拟采取的具体推广措施或推广计划等。</span>）</p>
					
 					<div class="text_wrap">
 						<textarea name="project_effect" id="project_effect" class="text_content"></textarea>
 					</div>
      
					<div class="button_wrapper clearfix">
<!-- 						<div class="submit" >提交</div> -->
					  	<div class="save" >保存</div>
					   	<!-- <div class="reset" >重置</div> -->
					</div>
				</div>
			</div>
		</div>
	</form>
</body>
</html>
