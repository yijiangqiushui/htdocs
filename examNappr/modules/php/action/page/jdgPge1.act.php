<?php
//author:heyangyang
include '../../../../common/php/config.ini.php';

$adminArr=array(
	'catName'=>$_SESSION['catName'],
	'priviledges'=>$_SESSION['priviledges'],
	'exclusive_name'=>$_SESSION['exclusive_name'],
);
echo json_encode($adminArr);
?>