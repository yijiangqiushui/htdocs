<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>无标题文档</title>
<link rel="stylesheet" type="text/css" href="../../css/style.css" />
<link rel="stylesheet" type="text/css"
	href="../../../../../common/html/plugin/easyui/themes/default/easyui.css"></link>
	<link rel="stylesheet" type="text/css"
		href="../../../../../common/html/plugin/easyui/themes/icon.css"/>
		<script type="text/javascript"
			src="../../../../../common/html/plugin/easyui/jquery.min.js"></script>
		<script type="text/javascript"
			src="../../../../../common/html/plugin/easyui/jquery.cookie.js"></script>
		<script type="text/javascript"
			src="../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
		<script type="text/javascript"
			src="../../../../../common/html/plugin/jquery-hlui-2.0/js/hlui.js"></script>
		<script type="text/javascript"
			src="../../../../../common/html/plugin/jquery-hlui-2.0/js/form.js"></script>
		<script type="text/javascript"
			src="../../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>
	    <script type="text/javascript" src="../../../../../common/html/js/tablecommon.js"></script>
		<script type="text/javascript"
			src="../../js/acceptance/expert_arguments.js"></script>
		<link rel="stylesheet" type="text/css" href="../../css/table.css"/>
			<link rel="stylesheet" type="text/css" href="../../css/button.css"/>
</head>
<body>
<form id="appFm" method="post" >
 <div class="project_content"/>
        <div class="table_title clearfix">
            <div class="title_pic left">验收专家意见填写</div>
            <div class="right back_pic" id="back"></div>
        </div>
<div class="table_content back-long">
				
					
 <table>

   <tr>
                    <td colspan="2" class="border_left_none" style="background-color:#7AB5ED;">
                        <div class="title_top p-b10">验收专家意见</div>
                    </td>
                </tr>
 <tr>
		<th width="139" height="50"><p>项目名称</p></th>
		<td valign="top"><input  style="width: 99.5%; height: 100%;" name="project_name"/></td>
 </tr>
 
  <tr>
 <td style="background-color:#7AB5ED;height:20px;"colspan="2">
 <center><p style="height:18px;color:#FFF002">（论证意见）</p></center>
 </td>
 </tr>
 <tr style="background-color:#D1E4F3 " colspan="2">
 <td colspan="2"> <textarea name="expert_arguments" id="expert_arguments" 
 style="padding:10px;border:1px solid #1B63AB;height:250px;margin-bottom:50px;width:94%; margin-left:3% ;margin-right:10% ;margin-top:15px ;overflow-x:hidden;border:1px solid #76B8EC" ></textarea></td>
       </tr>
 </table>
        <input type="hidden" name="save_display" id="save_display"/>
            <div class="button_wrapper clearfix d-n">
                <div class="save" >保存</div>
                <!-- <div class="reset" >重置</div> -->
            </div>
        </div>
     
    </div>
</form>
</body>
</html>
