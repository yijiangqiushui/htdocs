<!--
/************************************************************************************************************
#	PHP Version 1.2   MySQL  JavaScript
#	Copyright (c) 2009 http://www.cnalog.com
#	Author: Li Zhixiao <English Name: Hawking E-mail:lzxbit2008@yahoo.com.cn QQ:578731186>
#	Date: 2009/10/10
************************************************************************************************************/

//查看详细信息对话框
function showViewDlg($id){
	POST_F('../dlg/info/view.php','id='+$id,'showViewDlgSucc','insertDlgHtml',0);
}

function showViewDlgSucc($returnStr){
	if($returnStr){
		showDlg($returnStr);
		document.getElementById('closeDlg').onclick=function(){
			hideDlg();
		}
	}
}

//查询对话框
function showQueryDlg($category){
	POST_F('../dlg/info/query.php','category='+$category,'showQueryDlgSucc','insertDlgHtml',0);
}

function showQueryDlgSucc($returnStr){
	if($returnStr){
		showDlg($returnStr);
		document.getElementById('closeDlg').onclick=function(){
			hideDlg();
		}
	}
}

function checkQueryForm($isAll){
	var $queryStr=trim(document.queryForm.queryStr.value);
	var urlStr=document.myForm.reloadPage.value;
	var tmpArr=urlStr.split('=');
	var tmpStr=tmpArr[tmpArr.length-1];
	var redirectPage;
	if($isAll!='all'){
		if($queryStr==''){
			alert('提示：关键词不能为空！');
			return false;
		}
		if(tmpStr!='')
			redirectPage=urlStr.replace('queryStr='+tmpStr,'queryStr='+$queryStr);
		else
			redirectPage=urlStr+$queryStr;
	}
	else{
		if(tmpStr!='')
			redirectPage=urlStr.replace('queryStr='+tmpStr,'queryStr=');
		else
			redirectPage=urlStr;
	}
	window.location.href=redirectPage;
	return false;
}

//添加编辑对话框
function showAddNEditDlg($category,$id){
	var page=document.getElementById("page").value;
	var queryString='id='+$id+'&category='+$category+'&page='+page;
window.location="../dlg/info/addNedit.php?"+queryString;
//alert("../dlg/info/addNedit.php?"+queryString);
//	POST_F('../dlg/info/addNedit.php',queryString,'showAddNEditDlgSucc','insertDlgHtml',0);
}

function showAddNEditDlgSucc($returnStr){
	if($returnStr){
		showDlg($returnStr);
		document.getElementById('addNeditCancel').onclick=function(){
			hideDlg();
		}
		document.getElementById('closeDlg').onclick=function(){
			hideDlg();
		}
	}

}

var $editId;

function checkAddNEditFormkk(){
alert('看下面这个函数提示2');



}

function checkAddNEditForm(){


//	var MyObject = new MyClass();
//	MyObject.UpdateEditorFormValue();
//alert('提示1'+document.addNeditForm.editId.value);
	$editId=document.addNeditForm.editId.value;
	var $category=document.addNeditForm.category.value;

// alert('提示2'+document.addNeditForm.category.value);
	var $title=trim(document.addNeditForm.title.value);

	var $content=trim(document.addNeditForm.content.value);
	var $operator=document.addNeditForm.operator.value;
	// var $source=document.addNeditForm.source.value;
	var $uploadFile=trim(document.addNeditForm.uploadFile.value);

//alert('提示4'+$uploadFile);
//alert('提示4'+$operator);
	if($title==''){
		alert('提示：请填写标题文字！');
		return false;
	}
	if($title.length>25){
		alert('提示：标题不能超过25个字符！');
		return false;
	}	
	if($content==''){
		alert('提示：请填写内容！');
		return false;
	}
	if($content.length>500000){
		alert('提示：内容过长，请使用附件上传发布！');
		return false;
	}
//	if ($source != "本站" && $source.match(/http:\/\/.+/)==null ){ 
//		alert('输入的URL无效，必须要以http://开头'); 
//		return false; 
//	}
//	if($uploadFile!='' ){  //&& !isUploadFileAllowed('upLoadFileAllowedStr',$uploadFile)
//		alert('提示：不允许上传空该类型文件！');
//		return false;
//	}
	document.addNeditForm.addNeditSubmit.disabled=true;
	document.getElementById("uploadTr").style.display='block';
	document.getElementById("uploadTd").innerHTML='<img src="/cms/system/img/loading/2.gif" align="absmiddle" /> 正在提交，请稍后...';
	document.addNeditForm.action='../../process/info/addNedit.php?id='+$editId+'&category='+$category; //真得需要a
// alert(document.addNeditForm.action);
	document.addNeditForm.submit();

}

//批量删除
/**
* 执行删除操作
**/
function delOperation(){
	var $oCheckbox=document.myForm.itemArr;
	var $idArr="";
	var $arrLen=$oCheckbox.length;
	if($arrLen){
		for(var $i=0;$i<$arrLen;$i++){
			if($oCheckbox[$i].checked)
				$idArr += $oCheckbox[$i].value+',';
		}
		$idArr=$idArr.substring(0,$idArr.length-1);
	}
	else{
		if($oCheckbox.checked)
			$idArr=$oCheckbox.value;
	}
	var queryString="idArr="+$idArr;
	if(confirm("确定要删除吗？")){
		document.myForm.deleteAll_btm.disabled=true;
		POST_F('../process/info/delete.php',queryString,'delSuccful','',0);
	}
}

function delSuccful($returnStr){
	document.myForm.deleteAll_btm.disabled=false;
//	if($returnStr=='1'){
		var $url=window.location.href;
		window.location.href=$url.replace('#','');//要去除#号，否则不能更新页面
//	}
//	else
//		alert("提示：删除操作失败！返回值："+$returnStr);
}

function delAttachment($id){
	var queryString="id="+$id;
	if(confirm("确定要删除吗？")){
		POST_F('../process/info/delAttachment.php',queryString,'delAttSuccful','',0);
	}
}
function delAttSuccful($returnStr){
//	if($returnStr=='1'){
		var $url=window.location.href;
		window.location.href=$url.replace('#','');//要去除#号，否则不能更新页面
//	}
//	else
//		alert("提示：删除操作失败！");
}

/**
* instantiate the class for FCFeditor
**/
function MyClass(){
	this.UpdateEditorFormValue = function(){
	for ( i = 0; i < document.frames.length; ++i )
		if ( document.frames[i].FCK )document.frames[i].FCK.UpdateLinkedField();
	}
}
$(function(){
	$('#table_showData_1').find("input[type='checkbox']").filter("#isRecommend").on("click",checkRecommend);
	$('#table_showData_1').find("input[type='checkbox']").filter("#isForbidden").on("click",checkForbidden);
});

function checkRecommend(){
	var value = 0;
	if($(this).is(":checked")){
		value = 1;
	}
	var infoId = $(this).attr("value");
	var url = "editInfoControl.php?action=checkRecommend&infoId="+infoId+"&value="+value;	
	$.ajax({
		url : url,
		async : false,
		type : "POST",
		dataType : "json",
		success : function(result) {
			alert("操作成功");
			var res = eval("("+result+")");
			if(res.msgcode=100){
				alert("操作成功");
			}else{
				alert("操作失败");
			}
		
		}
	});
}
function checkForbidden(){
	var value = 0;
	if($(this).is(":checked")){
		value = 1;
	}
	var infoId = $(this).attr("value");
	var url = "editInfoControl.php?action=checkForbidden&infoId="+infoId+"&value="+value;	
	$.ajax({
		url : url,
		async : false,
		type : "POST",
		dataType : "json",
		success : function(result) {
				alert("操作成功");
				var res = eval("("+result+")");
				if(res.msgcode=100){
					alert("操作成功");
				}else{
					alert("操作失败");
				}
			}
		
	});
}


//-->