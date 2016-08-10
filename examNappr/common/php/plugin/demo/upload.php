<?php
header("Content-Type:text/html;charset=utf-8");

include '../../lib/img.cls.php';

$vars=array(
	'file'=>'fileField',
	'limit_size'=>2*1024*1024,
	'savepath'=>'upload/201404/',
	'rootpath'=>'../../../../',
	'old_file'=>'../../../upload/5bac242b9b7f845eaa46f600fb5f5e70.gif',//不一定在同一个目录下，所以使用完整路径
	'width'=>100,
	'height'=>100
);

//print_r($_POST);
$img=new IMG($vars);
if($img->get_is_up_succeed()){
	echo $img->get_auto_filename();
	echo '<br />';
	echo $img->get_filename();
	echo '<br />';
	echo $img->get_savepath();
	echo '<br />';
	echo $img->get_filesize();
	echo '<br />';
	echo $img->get_filetype();
	echo '<br />';
}
?>