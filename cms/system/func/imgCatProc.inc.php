<?php
/*使用示例：
$imgFrom=ROOTPATH.'image/category/imgCatFrom.png';
$fontFile=ROOTPATH.'system/file/font/simhei.ttf';
$txt='中国';
$fontSize=18;
$fontColor=array();
$fontColor[0]=0;
$fontColor[1]=0;
$fontColor[2]=255;
$pos_x=10;
$pos_y=30;
$savePath='../image/menus/5r_.png';
addTxt2Img($imgFrom,$fontFile,$txt,$fontSize,$pos_x,$pos_y,$savePath);
*/
function addTxt2Img($imgFrom,$fontFile,$txt,$fontSize,$fontColor,$pos_x,$pos_y,$savePath){
	$img=imagecreatefrompng($imgFrom);
	$color=imagecolorallocate($img,$fontColor[0],$fontColor[1],$fontColor[2]);
	imagettftext($img,$fontSize,0,$pos_x,$pos_y,$color,$fontFile,$txt);
	imagepng($img,$savePath);
	imagedestroy($img);
}

function setNgetImgName(){
	$timeStr=microtime();
	$timeArr=split(' ',$timeStr);
	$fileName=$timeArr[1].substr($timeArr[0],2);
	$fileName=md5(strval($fileName));
	return $fileName;
}

function delImgFile($filePath){
	if(@unlink($filePath))
		return 1;
	else
		return 0;
}
?>