<?php
/**************************************************
#	Version 1.2		PHP MySQL JavaScript
#	Copyright (c) 2009 http://www.fangbian123.com
#	Author: Li Zhixiao <English Name: Hawking E-mail:578731186@qq.com QQ:578731186>
#	Date: 2009/10/10
#	Modified by Li Zhixiao	2014/03/15
**************************************************/

/**
 * 功能：生成随机验证码
 * 使用示例：$vcode=new ValidateCode('validate_code',4,80,28);
 */
class ValidateCode{
	private $chr_arr=Array('1','2','3','4','5','6','7','8','9','a','b','c','d','e','f','g','h','i','j','k','m','n','p','r','s','t','u','v','w','x','y','z');
	private $session_name='validate_code';//默认的session名称为validate_code
	
	/**
	* 功能：构造函数
	* 参数：$session_name-SESSION名称,$chr_num-文字个数,$width-图片宽度,$height-图片高度
	*/
	function __construct($session_name,$chr_num,$width,$height){
		$this->generateCodeImg($chr_num,$width,$height);
		$this->session_name=$session_name;
	}
	
	/**
	* 功能：设置随机字符串
	* 参数：$chr_num-文字个数
	* 返回：随机字符串
	*/
	function getVerifyStr($chr_num){
		$chrStr='';
		$count=count($this->chr_arr);
		for($i=1;$i<=$chr_num;$i++){											//循环随机取字符生成字符串
			$chrStr .= $this->chr_arr[rand(0,$count-1)];
		}
		session_start();
		$_SESSION[$this->session_name]=$chrStr;										//付值给session
		return $chrStr;
	}
	
	/**
	* 功能：生成随机字符串图片
	* 参数：$chr_num-文字个数,$width-图片宽度,$height-图片高度
	* 返回：随机字符串
	*/
	function generateCodeImg($chr_num,$width,$height){
		$fontSize=16;															//定义字体大小
		$chr_num=$chr_num;																//定义字符串长度
		$chrStr=$this->getVerifyStr($chr_num);												//获取一个随机字符串
		$width=$width;																//定义图片宽度
		$height=$height;																//定义图片高度
		$im=imagecreate($width,$height);										//生成一张指定宽高的图片
		$backgroundcolor=imagecolorallocate($im,255,255,255);					//生成背景色
		$frameColor=imageColorAllocate($im,150,150,150);						//生成边框色
		$font=realpath("font/arial.ttf");						//提取字体文件，开始写字
		for($i=0;$i<$chr_num;$i++){
			$charY=($height+9)/2+rand(-1,1);									//定义字符Y坐标
			$charX=$i*16+8;														//定义字符X坐标
																				//生成字符颜色
			$text_color=imagecolorallocate($im,mt_rand(50,200),mt_rand(50,128),mt_rand(50,200));
			$angle=rand(-20,20);												//生成字符角度
																				//写入字符
			imageTTFText($im,$fontSize,$angle,$charX,$charY,$text_color,$font,$chrStr[$i]);
		}
		
		for($i=0;$i<=10;$i++) {													//循环画背景线
			$linecolor=imagecolorallocate($im,mt_rand(0,255),mt_rand(0,255),mt_rand(0, 255));
			$linex=mt_rand(1,$width-1);
			$liney=mt_rand(1,$height-1);
			imageline($im,$linex,$liney,$linex+mt_rand(0,4)-2,$liney+mt_rand(0,4)-2,$linecolor);
		}
		
		for($i=0;$i<=32;$i++){													//循环画背景点,生成麻点效果
			$pointcolor=imagecolorallocate($im,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
			imagesetpixel($im,mt_rand(1,$width-1),mt_rand(1,$height-1),$pointcolor);
		}
		imagerectangle($im,0,0,$width-1,$height-1,$frameColor);					//画边框

		header('Content-type: image/png');
		imagepng($im);
		imagedestroy($im);
	}
	
}

?>