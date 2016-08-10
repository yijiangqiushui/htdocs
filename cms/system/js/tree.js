<!--
/************************************************************************************************************
#	PHP Version 1.2   MySQL  JavaScript
#	Copyright (c) 2009 http://www.cnalog.com
#	Author: Li Zhixiao <English Name: Hawking E-mail:lzxbit2008@yahoo.com.cn QQ:578731186>
#	Date: 2009/10/10
************************************************************************************************************/

var $globalULId;
//添加下级目录，改变图片显示
function showChildTypes($isLastElem,$upperCat,$veryId){
	$globalULId=$veryId.replace('navPorMImg','navUL');
	var $beforeImgs=document.getElementById($veryId.replace('navPorMImg','beforeImgs')).innerHTML;
	var queryString='beforeImgs='+$beforeImgs+'&isLastElem='+$isLastElem+'&upperCat='+$upperCat;
	if(document.getElementById($globalULId).innerHTML=='')//更改后台路径记得同时修改下面的路径"/managementCenter"
		POST_F('../process/info/tree.php',queryString,'showChildrenSucc',$globalULId,0);
}

function showChildrenSucc($returnStr){
	if($returnStr.length!=9){//不等于'<ul></ul>'，ul中间有回车键
		document.getElementById($globalULId).innerHTML=$returnStr;
		document.getElementById($globalULId).style.display='block';
	}
	else
		document.getElementById($globalULId).style.display='none';
}

function switchShowImg($veryId){
	var $navPorMImg=document.getElementById($veryId);
	var $navForPImg=document.getElementById($veryId.replace('navPorMImg','navForPImg'));
	var $ULId=$veryId.replace('navPorMImg','navUL');
	var $imgSrc=$navPorMImg.src;
	if($imgSrc.indexOf('tree/plus.gif')>0){
		$navPorMImg.src='/system/img/tree/minus.gif';
		$navForPImg.src='/system/img/tree/folderopen.gif';
		document.getElementById($ULId).style.display='block';
		return ;
	}
	if($imgSrc.indexOf('tree/minus.gif')>0){
		$navPorMImg.src='/system/img/tree/plus.gif';
		$navForPImg.src='/system/img/tree/folder.gif';
		document.getElementById($ULId).style.display='none';
		return ;
	}
	if($imgSrc.indexOf('tree/lastPlus.gif')>0){
		$navPorMImg.src='/system/img/tree/lastMinus.gif';
		$navForPImg.src='/system/img/tree/folderopen.gif';
		document.getElementById($ULId).style.display='block';
		return ;
	}
	if($imgSrc.indexOf('tree/lastMinus.gif')>0){
		$navPorMImg.src='/system/img/tree/lastPlus.gif';
		$navForPImg.src='/system/img/tree/folder.gif';
		document.getElementById($ULId).style.display='none';
		return ;
	}
}

var $lastLiId;
function changeBGColor($veryId){
	if(document.getElementById($lastLiId))
		document.getElementById($lastLiId).className='bgColor_0';
	$lastLiId=$veryId;
	document.getElementById($veryId).className='bgColor_1';
}

//-->