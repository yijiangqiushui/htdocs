<?php
/************************************************************************************************************
#	PHP Version 1.2   MySQL  JavaScript
#	Copyright (c) 2009 http://www.cnalog.com
#	Author: Li Zhixiao <English Name: Hawking E-mail:lzxbit2008@yahoo.com.cn QQ:578731186>
#	Date: 2009/10/10
************************************************************************************************************/

require_once('../../../../common/php/config.ini.php');

require_once(ROOTPATH.'../../cms/class/content.cls.php');
require_once(ROOTPATH.'../../cms/system/class/page.cls.php');
require_once(ROOTPATH.'../../cms/system/func/special.inc.php');

/*!-- 类声明 start --*/
$contentCls=new content();

/*!-- 类声明 end --*/

$nowDate = date('Y-m-d H:i:s');//记下现在的时刻

/**
* 在该部分判断管理员身份，非管理员不进行处理
**/
/*!-- 预留位置 start --*/
//$category=$_GET['category'];
/*$category=1;
if($category!='')
	$querySQL=" and ci.category like '$category%'";
//echo $category;

	
//排序的参数，很重要， by 朱俭
$orderBy=" order by ci.isRecommend desc, ci.sortNo desc, ci.releaseTime desc ";
	


/*!-- 获取列表信息 start --*/
/*$sql="select ci.* from contentInfo ci where 1=1 $querySQL $orderBy limit 0,7 ";
$info=$contentCls->getBatchInfo($sql);
if($info)
	$recordCount=count($info);*/
/*!-- 获取列表信息 end --*/
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
<!--     <meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> -->
<!-- <link type="text/css" href="../css/qianlogin.css" rel="stylesheet"> -->
<script type="text/javascript"
	src="../../../../common/html/lib/js/jquery-2.1.0.min.js"></script>
<script type="text/javascript"
	src="../../../../common/html/plugin/jquery-hlui-2.0/js/hlui.js"></script>
<script type="text/javascript"
	src="../../../../common/html/plugin/jquery-hlui-2.0/js/form.js"></script>

<!-- <link rel="stylesheet" type="text/css"
	href="../../../../common/html/plugin/easyui/themes/default/easyui.css" />
<link rel="stylesheet" type="text/css"
	href="../../../../common/html/plugin/easyui/themes/icon.css" /> -->
<script type="text/javascript"
	src="../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="../js/config.js"></script>
<script type="text/javascript" src="../js/index.js"></script>

<link href="../css/login.css" type="text/css" rel="stylesheet">
<!-- 
<link href="../../../../common/html/plugin/jquery-hlui-2.0/css/form.css"
	rel="stylesheet" type="text/css" /> -->
<style type="text/css">
	* {margin:0;}

</style>
</head>


<body>

<div id="bw-login">
    <a href="http://kw.bjtzh.gov.cn/PBindex.html" target="_blank" class="bw-link"></a>
    <form  id="form1" name="form1" method="post" action="" class="hlui-form">
        <table cellpadding="0" cellspacing="0" border="0" align="center" width="85%" style="margin-left:10px; margin-top:10px">
            <tr>
                <td width="60" >用户名：</td>
                <td><input type="text" name="username" id="username" class="ui-form-validate ui-form-text" data-opt="required:true" /> </td>
            </tr>
            <tr>
                <td>密<span style="visibility:hidden;">__</span>码：</td>
                <td><input type="password" name="password" id="password" class="ui-form-validate ui-form-text" data-opt="required:true" /></td>
            </tr>
            <tr>
                <td>验证码：</td>
                <td>
                    <input type="text" name="validateCode" id="validateCode" style="width:60px;" class="ui-form-validate ui-form-text" data-opt="required:true" />
                    <img src="../../../../common/php/file/validateCode.png.php" alt="点击更换验证码" title="点击更换验证码" id="validateCodeImg"/>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <div class="button">
                        <button class="bw-login" id="submitbtn">登 录</button>
                        <button class="bw-register">注 册</button>
                    </div>
                </td>
            </tr>
            <tr>
                <td></td>
                <td class="bw-forget" valign="top" align="right">
                    <a href="#"  id="get_help">忘记密码</a>
                </td>
            </tr>
        </table>
    </form>
</div>

<!-- 
<div class="wrapper">
 <form id="form1" name="form1" method="post" action="" class="hlui-form">


	
	<div class="body" > 
		<div class="block1"><div class="block1-name1"></div><div class="block1-word1">用户名：<input type="text" name="username" id="username" class="ui-form-validate ui-form-text" data-opt="required:true" /></div>
	<div class="block1-name2"></div><div class="block1-word2">密&nbsp;&nbsp;&nbsp;&nbsp;码：<input type="password" name="password" id="password" class="ui-form-validate ui-form-text" data-opt="required:true" /></div>
	<div class="block1-name3"></div><div class="block1-word3">验证码：<input type="text" name="validateCode" id="validateCode" style="width:80px;" class="ui-form-validate ui-form-text" data-opt="required:true" /></div>
	<div class="block1-validate"><img src="../../../../common/php/file/validateCode.png.php" alt="点击更换验证码" title="点击更换验证码" id="validateCodeImg"/></div>
	<div id="submitbtn"><div class="login" ></div><div class="login-word" id="submitbtn1">登 录</div> </div> <div><a href="register_1.php"><div class="register" ></div><div class="register-word" >注 册</div></a></div>
	<div class="forget-pwd"><a href="#" id="get_help">忘记密码</a></div>
							


			</div>
			</div>
			<div style="clear:both"></div>	
		</div>
	</div>body
	<div class="gap"></div>

	</form>
</div>wrapper -->


</body>
</html>
