<?php
/**
author:Gao Xue
date:2014-06-27
Modify:Wang Le
data:2014-10-13
*/

header("Content-Type:text/html;charset=utf-8");

function write2file($filename,$str){
	$fp=fopen($filename,'w');
	@fwrite($fp,$str);
	@fclose($fp);
}

$htmlstr=file_get_contents('../../../../website/html/view/template/index.php');
write2file('../../../../website/html/view/template/index.html',$htmlstr);
echo '<p>首页生成成功！</p>';

$htmlstr1=file_get_contents('../../../../website/html/view/template/topic/index.php');
write2file('../../../../website/html/view/template/topic/index.html',$htmlstr1);
echo '<p>主题页生成成功！</p>';

/*
$htmlstr=file_get_contents('../../../../website/html/view/template/fruits-category.php');
write2file('../../../../website/html/view/template/fruits-category.html',$htmlstr);
echo '<p>活动成果分类页生成成功！</p>';

$htmlstr=file_get_contents('../../../../website/html/view/template/talents-category.php');
write2file('../../../../website/html/view/template/talents-category.html',$htmlstr);
echo '<p>人才风采分类页生成成功！</p>';

$htmlstr=file_get_contents('../../../../website/html/view/template/activity-category.php');
write2file('../../../../website/html/view/template/activity-category.html',$htmlstr);
echo '<p>精彩活动分类页生成成功！</p>';
*/
?>