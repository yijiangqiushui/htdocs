<?php
/*
Uploadify 后台处理 Demo
Author:wind
Date:2013-1-4
uploadify 后台处理！
*/
include '../../../../../common/php/config1.ini.php';
include '../../class/log/log.cls.php';

//设置上传目录
$time=time();
$y=date('Y',$time);
$m=date('m',$time);
$d=date('d',$time);
$path = SP_BASEPATH."upload/".$y."/".$m."/".$d."/";
if (!empty($_FILES)) {
	
	//得到上传的临时文件流
	$tempFile = $_FILES['Filedata']['tmp_name'];
	
	//得到文件原名
	//$fileName = iconv("UTF-8","gb2312",$_FILES["Filedata"]["name"]);
	$fileName = $_FILES["Filedata"]["name"];
	$timeStr=microtime();
	$timeArr=explode(' ',$timeStr);
	$tmp_filename=$timeArr[1].substr($timeArr[0],2);
	$tmp_filename=sha1(md5(strval($tmp_filename)));
	$tmp_file_ext=substr($fileName,strrpos($fileName,'.'));
	$file_auto_filename=$tmp_filename.$tmp_file_ext;


		$attach=array(
			'filename'=>$fileName,
			'file_auto_filename'=>$file_auto_filename
		);
	//最后保存服务器地址
	if(!is_dir($path))
	   mkdir($path,755,true);
	if (move_uploaded_file($tempFile, $path.$file_auto_filename)){
		echo json_encode($attach);
	}
}
?>