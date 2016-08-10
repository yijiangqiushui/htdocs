<? 
/************************************************************************************************************
#	PHP Version 1.2   MySQL  JavaScript
#	Copyright (c) 2009 http://www.cnalog.com
#	Author: Li Zhixiao <English Name: Hawking E-mail:lzxbit2008@yahoo.com.cn QQ:578731186>
#	Date: 2009/10/10
************************************************************************************************************/

$serverName=$HTTP_SERVER_VARS['SERVER_NAME'];
$submitFrom=$HTTP_SERVER_VARS["HTTP_REFERER"];
$snLen=strlen($serverName); 
$isFrom=substr($submitFrom,7,$snLen);
if($isFrom!=$serverName){
	echo("请不要尝试从外部提交数据！"); 
	exit; 
} 
?>