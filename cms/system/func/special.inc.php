<?php
/************************************************************************************************************
#	PHP Version 1.2   MySQL  JavaScript
#	Copyright (c) 2009 http://www.cnalog.com
#	Author: Li Zhixiao <English Name: Hawking E-mail:lzxbit2008@yahoo.com.cn QQ:578731186>
#	Date: 2009/10/10
************************************************************************************************************/

/**
* 截取汉字
**/
function getCNSubStr($string, $length, $etc = '...'){
    $result = '';
    $string = html_entity_decode(trim(strip_tags($string)), ENT_QUOTES, 'UTF-8');
    $strlen = strlen($string);
    for($i = 0; (($i < $strlen) && ($length > 0)); $i++){
        if($number = strpos(str_pad(decbin(ord(substr($string, $i, 1))), 8, '0', STR_PAD_LEFT), '0')){
            if($length < 1.0){
                break;
            }
            $result .= substr($string, $i, $number);
            $length -= 1.0;
            $i += $number - 1;
        }
        else{
            $result .= substr($string, $i, 1);
            $length -= 0.5;
        }
    }
    $result = htmlspecialchars($result, ENT_QUOTES, 'UTF-8');
    if($i < $strlen){
        $result .= $etc;
    }
    return $result;
}
/**
*函数名称：post_check()   
*函数作用：对提交的编辑内容进行处理   
*参　　数：$post: 要提交的内容   
*返 回 值：$post: 返回过滤后的内容   
**/
function str2html($str){
   if (!get_magic_quotes_gpc()) {     // 判断magic_quotes_gpc是否为打开     
     $str = addslashes($str);     // 进行magic_quotes_gpc没有打开的情况对提交数据的过滤     
   }
   $str = htmlspecialchars($str);     // html标记转换 
   $str = str_replace(chr(32),"&nbsp;",$str);  
   $str = str_replace(chr(13),"<br />",$str);
   return $str;
}

/**
* 判断一个值是否在某个二维数组中
**/
function ExistInArr($key,$arr,$pos){
	for($i=0;$i<count($arr);$i++){
		if($key==$arr[$i][$pos])
			return $i;
	}
	return -1;
}

/**
* 生成随机验证码
**/
function GetVerify($length){
	$strings=Array('1','2','3','4','5','6','7','8','9','a','b','c','d','e','f','g','h','i','j','k','m','n','p','r','s','t','u','v','w','x','y','z');
	$chrNum='';
	$count=count($strings);
	for($i=1;$i<=$length;$i++){//循环随机取字符生成字符串
		$chrNum .= $strings[rand(0,$count-1)];
	}
	return $chrNum;
}

/**
* 生成随机颜色组
**/
function GetColor($length){
	$strings=Array('1','2','3','4','5','6','7','8','9','a','b','c','d','e','f');
	$chrNum='';
	$count=count($strings);
	for($i=1;$i<=$length;$i++){//循环随机取字符生成字符串
		$chrNum .= $strings[rand(0,$count-1)];
	}
	return $chrNum;
}
/**
* 使用ID生成兼职信息编号
**/
function CreateSerialNo($id,$length){
	$initailNo=$id;
	for($i=0;$i<($length-strlen($id));$i++)
		$initailNo = '0'.$initailNo;
	return 'N'.$initailNo;
}

/**
* 获取IP地址
**/
function getIP(){
	if(getenv('HTTP_CLIENT_IP')) {
		$ip=getenv('HTTP_CLIENT_IP');
	}
	else if(getenv('HTTP_X_FORWARDED_FOR')){
		$ip = getenv('HTTP_X_FORWARDED_FOR');
	}
	else if (getenv('REMOTE_ADDR')) {
		$ip = getenv('REMOTE_ADDR');
	}
	else {
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	return $ip;
}

/**
* 替换[amp /]为&
**/
function str_replace_amp($str){
	$ampStr=str_replace('[amp /]','&amp;',$str);
	return str_replace('&amp;amp;','&amp;',$ampStr);
}

/**
* 重新格式化日期
**/
function formatDate($dateStr){
	$noArr=explode('-',$dateStr);
	if(count($noArr)>1){
		$theDateStr .= $noArr[0];
		if($noArr[1]<10)
			$theDateStr .= '-0'.$noArr[1];
		else
			$theDateStr .= '-'.$noArr[1];
		if($noArr[2]<10)
			$theDateStr .= '-0'.$noArr[2];
		else
			$theDateStr .= '-'.$noArr[2];
	}
	else
		$theDateStr=$dateStr;
	$pattern_1='([0-9]{6})';
	$pattern_2='([0-9]{8})';
	$pattern_3='(([0-9]{2})-([0-9]{2})-([0-9]{2}))';
	$pattern_4='(([0-9]{4})-([0-9]{2})-([0-9]{2}))';
	switch(strlen($theDateStr)){
		case 6:
			if(ereg($pattern_1,$theDateStr)){
				$year=substr($theDateStr,0,2);
				$month=substr($theDateStr,2,2);
				$day=substr($theDateStr,4,2);
				if(intval($year)>50)
					return '19'.$year.'-'.$month.'-'.$day;
				return '20'.$year.'-'.$month.'-'.$day;
			}
			else
				return date('Y-m-d');
			break;
		case 8:
			if(ereg($pattern_2,$theDateStr)){
				$year=substr($theDateStr,0,4);
				$month=substr($theDateStr,4,2);
				$day=substr($theDateStr,6,2);
				return $year.'-'.$month.'-'.$day;
			}
			else if(ereg($pattern_3,$theDateStr)){
				$year=substr($theDateStr,0,4);
				if(intval($year)>50)
					return '19'.$theDateStr;
				return '20'.$theDateStr;
			}
			else
				return date('Y-m-d');
			break;
		case 10:if(ereg($pattern_4,$theDateStr)){
				return $theDateStr;
			}
			else
				return date('Y-m-d');
			break;
		default: return date('Y-m-d');
	}
}

/**
* 把数据写入某个文件
**/
function write2File($fileName,$str){
	$fp=fopen($fileName,'w');
	@fwrite($fp,$str);
	@fclose($fp);
}

/**
* 获取字符串中的所有数字
**/
function getDigitInStr($str){
	return eregi_replace("[^0-9]","",$str);
}

function hideSubIP($ip){
	return preg_replace('/((?:\d+\.){2})\d+.\d+/','\\1*.*',$ip);
}

function utf8TOgb2312($str){
	return $str;//iconv('utf-8','gb2312',$str);
}

function gender2str($gender){
	if($gender==0)
		return '女';
	else
		return '男';
}

function blog_summary($body, $size, $format = NULL){  
   $_size = strlen($body);  
   if($_size <= $size) return $body;  
   // 输入格式中有 PHP 过滤器  
   $strlen_var = strlen($body);  
   // 不包含 html 标签  
   if(strpos($body, '<') === false){  
    return substr($body, 0, $size);  
   }  
   // 包含截断标志，优先  
   if($e = strpos($body, '<!-- break -->')){  
     return substr($body, 0, $e);  
   }  
   // html 代码标记  
   $html_tag = 0;  
   // 摘要字符串  
   $summary_string = '';  
   /**  
    * 数组用作记录摘要范围内出现的 html 标签  
    * 开始和结束分别保存在 left 和 right 键名下  
    * 如字符串为：<h3><p><b>a</b></h3>，假设 p 未闭合  
    * 数组则为：array('left' => array('h3', 'p', 'b'), 'right' => 'b', 'h3');  
    * 仅补全 html 标签，<? <% 等其它语言标记，会产生不可预知结果  
    */ 
   $html_array = array('left' => array(), 'right' => array());  
   for($i = 0; $i < $strlen_var; ++$i) {  
     if(!$size){  
       break;  
     }  
     $current_var = substr($body, $i, 1);  
     if($current_var == '<'){  
       $html_tag = 1;  
       $html_array_str = '';  
     }else if($html_tag == 1){  
       // 一段 html 代码结束  
       if($current_var == '>'){  
         /**  
          * 去除首尾空格，如 <br /  > < img src="" / > 等可能出现首尾空格  
          */ 
         $html_array_str = trim($html_array_str);  
         /**  
          * 判断最后一个字符是否为 /，若是，则标签已闭合，不记录  
          */ 
         if(substr($html_array_str, -1) != '/'){  
           // 判断第一个字符是否 /，若是，则放在 right 单元  
           $f = substr($html_array_str, 0, 1);  
           if($f == '/'){  
             // 去掉 /  
             $html_array['right'][] = str_replace('/', '', $html_array_str);  
           }else if($f != '?'){  
             // 判断是否为 ?，若是，则为 PHP 代码，跳过  
             /**  
              * 判断是否有半角空格，若有，以空格分割，第一个单元为 html 标签  
              * 如 <h2 class="a"> <p class="a">  
              */ 
             if(strpos($html_array_str, ' ') !== false){  
               // 分割成2个单元，可能有多个空格，如：<h2 class="" id="">  
               $html_array['left'][] = strtolower(current(explode(' ', $html_array_str, 2)));  
             }else{  
               /**  
                * * 若没有空格，整个字符串为 html 标签，如：<b> <p> 等  
                * 统一转换为小写  
                */ 
               $html_array['left'][] = strtolower($html_array_str);  
             }  
           }  
         }  
         // 字符串重置  
         $html_array_str = '';  
         $html_tag = 0;  
       }else{  
         /**  
          * 将< >之间的字符组成一个字符串  
          * 用于提取 html 标签  
          */ 
         $html_array_str .= $current_var;  
       }  
     }else{  
       // 非 html 代码才记数  
       --$size;  
     }  
     $ord_var_c = ord($body{$i});  
    switch (true) {  
       case (($ord_var_c & 0xE0) == 0xC0):  
         // 2 字节  
         $summary_string .= substr($body, $i, 2);  
         $i += 1;  
       break;  
       case (($ord_var_c & 0xF0) == 0xE0):  
         // 3 字节  
         $summary_string .= substr($body, $i, 3);  
         $i += 2;  
       break;  
       case (($ord_var_c & 0xF8) == 0xF0):  
         // 4 字节  
         $summary_string .= substr($body, $i, 4);  
         $i += 3;  
       break;  
       case (($ord_var_c & 0xFC) == 0xF8):  
         // 5 字节  
         $summary_string .= substr($body, $i, 5);  
         $i += 4;  
       break;  
       case (($ord_var_c & 0xFE) == 0xFC):  
         // 6 字节  
         $summary_string .= substr($body, $i, 6);  
         $i += 5;  
       break;  
       default:  
         // 1 字节  
         $summary_string .= $current_var;  
     }  
   }  
   if($html_array['left']){  
     /**  
      * 比对左右 html 标签，不足则补全  
      */ 
     /**  
      * 交换 left 顺序，补充的顺序应与 html 出现的顺序相反  
      * 如待补全的字符串为：<h2>abc<b>abc<p>abc  
      * 补充顺序应为：</p></b></h2>  
      */ 
     $html_array['left'] = array_reverse($html_array['left']);  
    foreach($html_array['left'] as $index => $tag){  
       // 判断该标签是否出现在 right 中  
       $key = array_search($tag, $html_array['right']);  
       if($key !== false){  
         // 出现，从 right 中删除该单元  
         unset($html_array['right'][$key]);  
       }else{  
         // 没有出现，需要补全  
         $summary_string .= '</'.$tag.'>';  
       }  
     }  
   }  
   return $summary_string;  
} 

?>