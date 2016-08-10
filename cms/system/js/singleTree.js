<!--
/************************************************************************************************************
#	PHP Version 1.2   MySQL  JavaScript
#	Copyright (c) 2009 http://www.cnalog.com
#	Author: Li Zhixiao <English Name: Hawking E-mail:lzxbit2008@yahoo.com.cn QQ:578731186>
#	Date: 2009/10/10
************************************************************************************************************/

//这边的树形比较特别，所以JS单独列出
var $lastLiId;
function changeBGColor($veryId){
	document.getElementById($veryId).style.backgroundColor='#F0F0F0';
	if(document.getElementById($lastLiId))
		document.getElementById($lastLiId).style.backgroundColor='';
	$lastLiId=$veryId;
}
//-->