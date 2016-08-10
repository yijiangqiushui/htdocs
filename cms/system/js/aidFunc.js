<!--
/************************************************************************************************************
#	PHP Version 1.2   MySQL  JavaScript
#	Copyright (c) 2009 http://www.cnalog.com
#	Author: Li Zhixiao <English Name: Hawking E-mail:lzxbit2008@yahoo.com.cn QQ:578731186>
#	Date: 2009/10/10
************************************************************************************************************/

/**
* 消除字符串两边空格
**/
function trim(str){
	if(str.length>0){
		var RegExp=/(^\s*)|(\s*$)/g;
		return str.replace(RegExp,"");
	}
	return "";
}

/**
* 判断文本域是否图片类型
**/
function isImageFile(str){
	var imgTypes=".jpg.gif.jepg.png";
	var splitArr=str.split(".");
	var fileExtend=splitArr[splitArr.length-1].toLowerCase();
	if(imgTypes.indexOf(fileExtend)>0)
		return true;
	return false;
}

/**
* 限制上传的文件类型
**/
function isUploadFileAllowed(getFileTypeFuncName,filePathStr){
	if(filePathStr.indexOf('.')>0){
		var fileTypes=eval(getFileTypeFuncName)();
		var splitArr=filePathStr.split(".");
		var fileExtend=splitArr[splitArr.length-1].toLowerCase();
		if(fileTypes.indexOf(fileExtend)>0)
			return true;
		return false;
	}
	else{
		return false;
	}
}

/**
* 获取文件夹
**/
function getFolder(str){
	var strArr=str.split("\\");
	return str.replace(strArr[strArr.length-1],'');
}

/**
* 替换&amp;为[amp /]
**/
function str_replace_amp(str){
	return str.replace(/&/g,'[amp /]');//注意使用/(被替换的字符)/g，这个格式表示替换全部
}

function stripTags($str){  
    return $str.replace(/<[^>].*?>/g,"");
}


//-->
