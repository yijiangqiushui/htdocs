<?php
    session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>权限</title>
	<link rel="stylesheet" type="text/css" href="../../../../../common/html/plugin/easyui/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="../../../../../common/html/plugin/easyui/themes/icon.css">
     <script type="text/javascript" src="../../../../../common/html/plugin/easyui/jquery.min.js"></script>
    <script type="text/javascript" src="../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
    <link rel="stylesheet" href="../../../../html/view/css/daterangepicker.css" />
    <script src="../../../../html/view/js/moment.min.js"></script>
<!--     <script src="../../../html/view/js/jquery-1.11.2.min.js"></script> -->
    <script src="../../../../html/view/js/jquery.daterangepicker.js"></script>
    <script src="../../../../html/view/js/generateID.js"></script>
    <style>
    table{ background:#000;}
    table tr td{ background:#FFFAF0; height:35px; font-family: "微软雅黑";font-size: 1.3em;}
    </style>
</head>
<body>
<div style="border:0;margin:auto 0;" title="生成用户账号信息">
	<form method="post" action="" id="generateID">
		<table border="0" cellspacing="0" cellpadding="0" width="400" class="table">
		    <tr>
		        <td width="96"><p align="center">用户名 </p></td>
		        <td colspan="3" ><center><input id="username" class="easyui-validatebox" required="true" type="text"style="height:30px; width:80%" /><span style="color:red">*</span></center></td>
		    </tr>	    
		    <tr>
		        <td width="96"><p align="center">密码 </p></td>
		        <td colspan="3" ><center><input type="password" id="password" class="easyui-validatebox" required="true" style="height:30px; width:80%"/><span style="color:red">*</span></center></td>
		    </tr>	    	    
		    <tr>
		        <td colspan='2' align="center"  height=50 ><input style="height:30px; width:120px" type="button" value="生成账号和密码" onclick="generateid();" /></td>
		    </tr>
		</table>
	</form>
</div>>



</body>

</html>