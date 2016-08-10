
<head>
<link href="/cms/system/css/table/table.css" type="text/css" rel="stylesheet" />
<link href="/cms/system/css/form/form.css" type="text/css" rel="stylesheet" />
<link href="/cms/system/css/page/page_1.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.all.min.js"> </script>

<script type="text/javascript" src="../../../system/js/aidFunc.js"></script>
<script type="text/javascript" src="../../js/info.js"></script>
<script type="text/javascript" src="../../../system/js/content.js"></script>
<script language="javascript" src="../../../system/js/jquery-1.10.2.min.js"></script>


</head>
<body>
<?php
/************************************************************************************************************
#	PHP Version 1.2   MySQL  JavaScript
#	Copyright (c) 2009 http://www.cnalog.com
#	Author: Li Zhixiao <English Name: Hawking E-mail:lzxbit2008@yahoo.com.cn QQ:578731186>
#	Date: 2009/10/10
************************************************************************************************************/

require_once('../../../../common/php/config.ini.php');
require_once(ROOTPATH.'../../cms/class/content.cls.php');
require_once(ROOTPATH.'../../cms/system/func/special.inc.php');


$category=$_REQUEST['category'];

$id=$_REQUEST['id'];
$page=$_REQUEST['page'];
$dataArr=array();

//echo "category".$category;
//echo "id=".$id;
$contentCls=new content();

if(!$id){
	$dlgTitle='添加任务';
	$operator=$_SESSION['realname'];
	//var_dump($_SESSION);exit;
	$dataArr[source]='';
	$dataArr[releaseTime]= date("Y-m-d H:i:s",strtotime("+0 day"));//默认是今天
}
else{
	$dlgTitle='编辑任务';
	$dataArr=$contentCls->getInfo($id);
	$operator=$dataArr[operator];
	$category=$dataArr[category];
}



$dlgWidth=600;
?>
<!--添加编辑对话框 start-->

<?php require_once(ROOTPATH.'../../cms/system/inc/dlg/dlg_start.php');?>

  <form action="" method="post" enctype="multipart/form-data" name="addNeditForm" id="addNeditForm" target="submitFrame" onSubmit="return false;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" id="formFolder">
    <tr>
      <td width="100">所属类别：</td>
      <td><input name="category" id="category" class="inputWidth_10" type="text" maxlength="10" value="<?php echo $category;?>" readonly /> </td>
    </tr>
    <tr>
      <td>信息：</td>
      <td><input name="title" type="text" class="borderStyle inputWidth_10" id="title" maxlength="50" value="<?php echo $dataArr[title];?>" /> 
      <span class="promptRed">* 必填</span></td>
    </tr>
	<!--备用-->
    <tr>
      <td>上传文件附件：</td>

      <td><input name="uploadFile" type="file" class="borderStyle inputWidth_10" id="uploadFile" />
	  <input name="originalFile" id="originalFile" type="hidden" value="<?php echo $dataArr[filePath];?>" /></td>
    </tr>
    
    <tr>
      <td>负责人：</td>
      <td><input name="operator" type="text" class="borderStyle inputWidth_6" id="operator" maxlength="10" value="<?php echo $operator;?>" readonly /></td>
    </tr>
   
     
    <tr>  
      <td>发布时间：</td>
      <td><input name="releaseTime" type="text" class="borderStyle inputWidth_10" id="releaseTime"  value="<?php echo $dataArr[releaseTime];?>" /><span class="promptRed">默认当日</span></td>
    </tr>
    
    <tr> <!--?php if(strstr($category,'s157es161e')||strstr($category,'s1es177e')||strstr($category,'s1es171e')||strstr($category,'s208e')||strstr($category,'s1es205e'))  echo 'style="display:none"'; /*图片墙不需要正文,前锋微博	,二级页面标题图*/?-->  
      <td>任务内容：</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2">
<textarea name="content" id="content" ><?php echo $dataArr[content];?>
</textarea>  
<script type="text/javascript">  
    UE.getEditor('content')
</script>

	<!--  
		require_once('../../../../fckeditor/fckeditor.php') ;  //把文件包含进来
		$oFCKeditor = new FCKeditor('content') ;  //表单项的名称
		$oFCKeditor->BasePath="../../../fckeditor/";  //编辑器所在目录
		$oFCKeditor->ToolbarSet="MyToolBar";  //工具栏的名字
		$oFCKeditor->Height='350px';  //高度  
		$oFCKeditor->Width='100%';  //宽度  
		$oFCKeditor->Value=$dataArr[content];  //初始值 
		$myeditor=$oFCKeditor->CreateHtml();  //在要显示编缉器的地方输出变量$myeditor的值就行了 
		echo  $myeditor;
		-->		</td>
    </tr>

  <tr id="uploadTr" style="display:none">
      <td>&nbsp;</td>
      <td id="uploadTd">&nbsp;</td>
    </tr>
    <tr>
      <td height="30">&nbsp;</td>
      <td><input name="editId" type="hidden" id="editId" value="<?php echo $id;?>" />
      <input name="addNeditSubmit" type="submit" id="addNeditSubmit" value="提交" class="buttonStyle" onClick="checkAddNEditForm();" />

	  <!--input name="button1" type="button" id="button1" value="测试" class="buttonStyle" onclick="checkAddNEditFormkk();" /-->
      &nbsp; <input name="addNeditCancel" type="button" id="addNeditCancel" onClick="javascript:window.location.href='../../frame/list.php?category=<?php echo $category;?>'
 value="取消" class="buttonStyle" />

	  <iframe name="submitFrame" id="submitFrame" width=400px height=200px style="display:none"></iframe>
	  <!--style="display:none"-->
	  </td>
    </tr>
  </table>

  <input id="page" name="page" type="hidden" value="<?php echo $page;?>" />
  </form>

<?php require_once(ROOTPATH.'../../cms/system/inc/dlg/dlg_end.php');?>


<!--添加编辑对话框 end-->
<script>
//function checkAddNEditFormkk(){
//alert('提示2');
//}
</script>

</body>