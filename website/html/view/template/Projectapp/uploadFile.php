<?php
session_start();
include '../../../../php/action/class/projectFile.cls.php';
$project_file_obj = new projectFile();
$project_id = $_SESSION['project_id'];
$table_id = intval($_GET['table_id']);
$project_file_info = $project_file_obj->get_attach_lists($project_id,$table_id);
$table_status = $_GET['table_status'];
$user_type = $_GET['user_type'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../../css/uploadifive.css" />

<script type="text/javascript" src="../../../../../common/html/plugin/easyui/jquery.min.js"></script>
<script type="text/javascript" src="../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="../../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>
<script type="text/javascript" src="../../../../../common/html/js/common.js"></script>

<script type="text/javascript" src="../../../../../website/html/view/js/projectapp/upload.js"></script>
<script src="../../../../../website/html/view/js/jquery.uploadifive.js" type="text/javascript"></script>

<script src="../../../../../website/html/view/js/jquery.uploadify.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="../../../../../common/html/plugin/easyui/themes/default/easyui.css" />
<link rel="stylesheet" type="text/css" href="../../../../../common/html/plugin/easyui/themes/icon.css" />
<script type="text/javascript" src="../../../../../common/html/js/tablecommon.js"></script>
<link rel="stylesheet" type="text/css" href="../../css/uploadify.css" />

<link rel="stylesheet" type="text/css" href="../../css/table.css" />
<link rel="stylesheet" type="text/css" href="../../css/button.css" />
<style type="">
  .uploadifive-button{
  	margin-top:-23px;
  }
</style>
</head>
<body>
<div>


	<div class="project_content">
		<div class="table_title clearfix">
            <div class="title_pic left">附件上传</div>
            <div class="right back_pic" id="back"></div>
        </div>
		<div class="table_content back-long">
			<form>
				<div class="basic_info bg_blue">
					<p class="title_top p-b10">相关文档上传处理</p>
					<div class="upload_block" style="height: 60px;">
						<span id="info"></span>
						<label for="fileField"></label>
						 <div id="queue"></div>
						 <p style='width: 360px; margin-left:350px;margin-top:10px;'>此处上传内容中所需图片，如流程图等，也可以上传说明文档（上传的文件不得超过2MB）</p>
						 <input id="file_upload" name="file_upload" type="file" multiple="true" >
					</div>
                     
					 <table cellspacing="0" cellpadding="0" class="basic_info" border="0" style='width: 100%;'>
					  <tr>
					  <th style='width: 100px;'>序号</th>
					  <th style='width: 400px;'>附件名称</th>
					  <th style='width: 580px;'>介绍</th>
					  <th style='width: 200px;'>操作</th>
					  </tr>
					  <?php
					  if($project_file_info){
						 foreach($project_file_info as $key=>$item){
					  ?>
						 <tr>
						 <td><?php echo $key+1; ?></td>
						 <td><?php echo $item['name']; ?></td>
						 <td style='text-align: left;'><p class="realIntro" style='width:100%; word-wrap:break-word; word-break:normal;'><?php echo $item['introduction']; ?></p><textarea style="display: none;padding:10px; width:580px;" class="contentIntro" cid="<?php echo $item['id']; ?>" ></textarea></td>
						 <td><a href="<?php echo $item['path']; ?>" target="_blank">查看</a>&nbsp;<span class="showAttach">|&nbsp;<a href="uploadify.php?action=del&id=<?php echo $item['id']; ?>">删除</a>&nbsp;|&nbsp;<a href="#" class="checkIntro">编辑介绍</a></span></td></tr>
					  <?php
						 }
					  } ?>
					  </table>
				</div>
			</form>
 		</div>
	</div>
<script type="text/javascript">
	$('#back').click(function() {
		$(window.parent.parent.document).find('iframe').attr('src',"../template/user_project.php");
	})
	<?php $timestamp = time();?>
   $(function() {
	   var browser = myBrowser();
	   if(browser != "Firefox"){
		   $('#file_upload').uploadify({
			   'fileSizeLimit' : '2MB',
			   'width' : 100,
			   'formData'     : {
				   'timestamp' : '<?php echo $timestamp;?>',
				   'token'     : '<?php echo md5('unique_salt' . $timestamp);?>'
			   },
			   'swf'      : '/website/html/view/js/uploadify.swf',
			   'uploader' : 'uploadify.php?action=add&table_id=<?php echo $table_id;?>',
			   'buttonText' : '选择上传文件',
			   'overrideEvents' : ['onDialogClose', 'onUploadError', 'onSelectError','onUploadError'],
			   'onUploadSuccess' : function(file,data){
				   var msg = eval("("+data+")");
				   if(msg.status){
					   $("#info").text('文件' + file.name + ' 上传完成。');
				   }else{
					   $.messager.alert("提示",msg.tip);
				   }
				},
				'onQueueComplete' : function(queueData){
				   window.location.reload();
					//console.log(queueData);
				   //alert(queueData.uploadsSuccessful + ' files were successfully uploaded.');
				},
				'onSelectError' : function() {
					$.messager.alert("提示",'单个文件大小超过了2M，请重新检查后上传');return;
		        },

				'onUploadError' : function(file, errorCode, errorMsg, errorString){
					alert("111");
		        }
		   });   
	   }else{
		   
		   $('#file_upload').uploadifive({
			   'auto'             : true,
			   'fileSizeLimit' : '2MB',
			   'width' : 100,
			   'formData'     : {
				   'timestamp' : '<?php echo $timestamp;?>',
				   'token'     : '<?php echo md5('unique_salt' . $timestamp);?>'
			   },
			   'uploadScript' : 'uploadify.php?action=add&table_id=<?php echo $table_id;?>',
			   'buttonText' : '选择上传文件',
			   'overrideEvents' : ['onDialogClose', 'onUploadError', 'onSelectError','onUploadError'],
			   'onUploadSuccess' : function(file,data) {
				   var msg = eval("("+data+")");
				   if(msg.status){
					   $("#info").text('文件' + file.name + ' 上传完成。');
				   }else{
					   $.messager.alert("提示",msg.tip);
				   }
				},
				'onQueueComplete' : function(queueData){
				   window.location.reload();
					//console.log(queueData);
				   //alert(queueData.uploadsSuccessful + ' files were successfully uploaded.');
				},
				'onError'      : function(errorType) {
					var str = '';
					 switch(errorType){
					    case 'FILE_SIZE_LIMIT_EXCEEDED':
					    	str = '单个文件大小超过了2M，请重新检查后上传';break;
					    default:
					    	str = errorType;break;

					 }
					 alert(str);
		            
		        }
					
		   }); 
		   }
	   
	   
	   $(".checkIntro").on("click",function(){
				var realIntro = $(this).parents("tr").first().find(".realIntro").first();
				var contentIntro = realIntro.siblings(".contentIntro").first();
				contentIntro.text(realIntro.text());
				realIntro.hide();
				contentIntro.show();
		});

	   
	    $(".contentIntro").on("blur",function(){
				var obj = $(this);
				var realIntro = obj.siblings(".realIntro").first();
				var content = obj.val();
				var cid = obj.attr("cid");
				realIntro.text(content);
				
				$.ajax({
						url : "uploadify.php?action=editIntro",
						data : {
							'cid':cid,
							'content':content
						},
						type : 'POST',
						async: false,
						dataType : 'json',
						success : function(data) {
							if(data.msgcode == 100){
								//
							}else{
								alert("保存失败");
							}
						},
						error : function(data) {
							//alert("修改失败，请重试，或联系管理员！");
						}
				});
				
				obj.hide();
				realIntro.show();
		});
	   
   });
</script>
</body>
</html>
