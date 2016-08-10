<?php
header("Content-Type:text/html;charset=utf-8");

$arr=array(
	'a'=>'hello,world!',
	'b'=>'世界，你好！',
);
$arr['name']=$_POST['name'];
$arr['message']=$_POST['message'];
$arr['box']=$_POST['box'];
$arr['checkbox']=$_POST['checkbox'];
$arr['radio']=$_POST['radio'];
//process

$dataarr=array('is_success'=>1);
echo json_encode($dataarr);
?>