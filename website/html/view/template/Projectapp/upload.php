<?php
header("Content-Type:text/html;charset=utf-8");
include '../../../../../center/php/config.ini.php';
include '../../../../../common/php/config.ini.php';
include '../../../../../common/php/lib/db.cls.php';
include '../../../../../common/php/lib/file.cls.php';

session_start();
$db = new DB();
$project_id = $_SESSION['project_id'];
$time=time();
$date=date("y-m-d",$time) ;
$savepath="/upload/".$project_id."/".$date."/";
$vars=array(
		'file'=>'fileField',
		'limit_size'=>2*1024*1024,
		'savepath'=>$savepath,
		'rootpath'=>'../../../',
		'old_file'=>'',
		'allowed_ext'=>'.jpg,.png,.gif'
);

$file=new FILE($vars);
if($file->get_is_up_succeed()){
 $save_path =$file->get_savepath().$file->get_auto_filename();
 $sql ="update project_info  set  file_path = '$save_path'  where  project_id ='$project_id'";
 $db->Update($sql);
 $db->Close();
	$name = '上传成功';
	$success = true;
}
else{
	$name = '上传失败';
	$success = false;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title></title>
	<link rel="stylesheet" type="text/css" href="../../../../../common/html/plugin/easyui/themes/default/easyui.css"/>
	<link rel="stylesheet" type="text/css" href="../../../../../common/html/plugin/easyui/themes/icon.css"/>
	<script type="text/javascript" src="../../../../../common/html/lib/js/jquery-2.1.0.min.js"></script>
	<script type="text/javascript" src="../../../../../common/html/plugin/easyui/jquery.easyui.min.js"></script>
	<script type="text/javascript" src="../../../../../common/html/plugin/easyui/locale/easyui-lang-zh_CN.js"></script>
</head>
<body class="easyui-layout">
<script>
	$(function() {
		$.messager.alert('消息提示', '<?php echo $name; ?>', 'info', function() {
			history.go(-1);
			<?php if($success):?>
				window.parent.setSuccess('imp_plan',1);
			<?php endif;?>
			
		});
	});
</script>
</body>
</html>
