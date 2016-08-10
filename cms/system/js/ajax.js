<!--
/************************************************************************************************************
#	PHP Version 1.2   MySQL  JavaScript
#	Copyright (c) 2009 http://www.cnalog.com
#	Author: Li Zhixiao <English Name: Hawking E-mail:lzxbit2008@yahoo.com.cn QQ:578731186>
#	Date: 2009/10/10
************************************************************************************************************/

/**
*!服务器处理的页面应使用UTF-8格式
* 全部函数返回false因为不用提交
**/

/**
* 创建异步对象
**/
function createHttpRequest(){
    var xmlHttp;    
    try{
		xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
    }
    catch(e){
		try{
      		xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
		 }
     	catch(e){
     		xmlHttp = false;
		}
    }
    if(!xmlHttp && typeof XMLHttpRequest != 'undefined')
		xmlHttp = new XMLHttpRequest();
    return xmlHttp;
}

/**
* GET方式(直接操作innerHTML)
* 参数：queryString 请求的地址(使用如check.php?1=1)，loadingTagID 要响应的标签ID，showLoading 是否显示loading提示
* 注意：该方法未使用，为验证，可能出现错误，但是修改很简单
**/
function $_GET(queryString,loadingTagID,showLoading){
	var xmlHttp;
	xmlHttp=createHttpRequest();
	var $QueryString=queryString+"&timeStamp="+new Date().getTime();
	xmlHttp.open("GET",$QueryString);
	xmlHttp.onreadystatechange=function(){
		var $loadingTagID=document.getElementById(loadingTagID);
		if(xmlHttp.readyState==4){
			if(xmlHttp.status==200){
				$loadingTagID.innerHTML=xmlHttp.responseText;
				delete xmlHttp;	
				xmlHttp=null;
			}
		}
		else if(showLoading){
			$loadingTagID.innerHTML="正在加载，请稍后...";
		}
	}
	xmlHttp.send(null);
}

/**
* POST方式(直接操作innerHTML)
* 参数：queryString 请求的地址，loadingTagID 要响应的标签ID，showLoading 是否显示loading提示
**/
function $_POST(serverURL,queryString,loadingTagID,showLoading){
	var xmlHttp;
	xmlHttp=createHttpRequest();
	xmlHttp.open("POST",serverURL+"?timeStamp="+new Date().getTime());
	xmlHttp.onreadystatechange=function(){
		var $loadingTagID=document.getElementById(loadingTagID);
		if(xmlHttp.readyState==4){
			if(xmlHttp.status==200){
				$loadingTagID.innerHTML=xmlHttp.responseText;
				delete xmlHttp;	
				xmlHttp=null;
			}
		}
		else if(showLoading){
			$loadingTagID.innerHTML="loading...";
		}
	}
	xmlHttp.setRequestHeader("Method","POST"+serverURL+" HTTP/1.1");//注意加上
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(queryString);
}

/**
* GET方式(可操作其他函数)
* 参数：queryString 请求的地址，funcName 调用的函数名(为空则表示不调用函数)，showLoading 是否显示loading提示
* 注意：该方法未使用，为验证，可能出现错误，但是修改很简单
**/
function GET_F(queryString,funcName,loadingTagID,showLoading){
	var xmlHttp;
	xmlHttp=createHttpRequest();
	var $QueryString=queryString+"&timeStamp="+new Date().getTime();
	xmlHttp.open("GET",$QueryString);
	xmlHttp.onreadystatechange=function(){
	var $loadingTagID=document.getElementById(loadingTagID);
	if(xmlHttp.readyState==4){
			if(xmlHttp.status==200){
				if(funcName!="")
					eval(funcName)(xmlHttp.responseText);
				delete xmlHttp;	
				xmlHttp=null;
			}
		}
		else if(showLoading){
			$loadingTagID.innerHTML="正在加载，请稍后...";
		}
	}
	xmlHttp.send(null);
}

/**
* POST方式(可操作其他函数)
* 参数：queryString 请求的地址，funcName 调用的函数名(为空则表示不调用函数)，showLoading 是否显示loading提示，buttonIDDis需要disabled的按钮ID，若为"none"，则表示无按钮需要作disabled操作
**/
function POST_F(serverURL,queryString,funcName,loadingTagID,showLoading){
	var xmlHttp;
	xmlHttp=createHttpRequest();
	xmlHttp.open("POST",serverURL+"?timeStamp="+new Date().getTime(),true);
	xmlHttp.onreadystatechange=function(){
	var $loadingTagID=document.getElementById(loadingTagID);
	if(xmlHttp.readyState==4){
			if(xmlHttp.status==200){
				if(funcName!="")
					eval(funcName)(xmlHttp.responseText);
				delete xmlHttp;	
				xmlHttp=null;
			}
		}
		else if(showLoading){
			$loadingTagID.innerHTML="正在加载，请稍后...";
		}
	}
	xmlHttp.setRequestHeader("Method","POST"+serverURL+" HTTP/1.1");//注意加上
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlHttp.send(queryString);
}

/**
* 对话框相关
**/
document.write('<div id="insertDlgHtml" style="display:none;left:50px;top:50px;position:absolute"></div>');

//显示insertDlgHtml
function showDlg($innerHTML){
//	showTransparent();
	$("#insertDlgHtml").fadeIn();
//	document.getElementById('insertDlgHtml').style.display='block';
	document.getElementById('insertDlgHtml').innerHTML=$innerHTML;
	document.getElementById('dlgMenuBar').title='点击此处可以拖拽';
	document.getElementById('dlgMenuBar').onmousedown=function(){
		$("#insertDlgHtml").draggable('enable');
		$("#insertDlgHtml").draggable();
	}
	document.getElementById('dlgMenuBar').onmouseup=function(){
		$("#insertDlgHtml").draggable('disable');
	}
}

//隐藏insertDlgHtml
function hideDlg(){
	$("#insertDlgHtml").fadeOut();
//	document.getElementById('insertDlgHtml').style.display='none';
//	document.getElementById('insertDlgHtml').innerHTML='';
}

//-->