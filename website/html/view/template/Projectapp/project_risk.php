<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="../../css/style.css" />
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
<script type="text/javascript" src="../../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>
<script type="text/javascript" src="../../../../../common/html/js/tablecommon.js"></script>
<script type="text/javascript" src="../../js/projectapp/is_edit_common.js"></script>
<?php if(isset($_GET['is_edit'])&&$_GET['is_edit']){?>
<script type="text/javascript" src="../../js/projectapp/is_edit.js"></script>
<?php }else{ ?>
<script type="text/javascript" src="../../js/projectapp/project_risk.js"></script>
<script type="text/javascript" src="../../js/projectapp/is_edit_front.js"></script>
<?php }?>

<link rel="stylesheet" type="text/css" href="../../css/style.css" />
<link rel="stylesheet" type="text/css" href="../../css/table.css" />
<link rel="stylesheet" type="text/css" href="../../css/button.css" />
</head>
<body>

    <form id="project_risk" method="post">
        <div class="project_content">
            <div class="table_title clearfix">
                <div class="title_pic left">项目实施方案填写</div>
                <div class="right back_pic" id="back"></div>
            </div>
            <div class="table_content back-long">
                <div class="basic_info bg_blue">
                    <p class="title_top">项目实施的风险分析及规避预案</p>
                    <p class="subtitle"><span class="stitle_num">1</span>、<span class="stitle_name">&nbsp;&nbsp;&nbsp;</span> （<span class="stitle_tip">风险含市场风险、技术风险、政策风险、管理风险等，风险分析需说明有可能存在的风险。</span>）</p>
                    <div class="text_wrap">
                        <textarea id="project_risk" name="project_risk" class="text_content"></textarea>
                    </div>
         	          <div class="button_wrapper clearfix">
<!--                         <div class="submit" >提交</div> -->
                        <div class="save" >保存</div>
                        <!-- <div class="reset" >重置</div> -->
                    </div>
                </div>
            </div>
        </div>
    </form>

</body>
</html>
