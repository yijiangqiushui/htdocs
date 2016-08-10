<?php

class CheckDuplicate{
	private $config=array();
	
	public function set_config($config){
		$this->config=$config;
	}
	
	function mbstringToArray($str) {
		$strlen=mb_strlen($str);
		while($strlen){
		   $array[]=mb_substr($str,0,1,$this->config['charset']);
			$str=mb_substr($str,1,$strlen,$this->config['charset']);
			$strlen=mb_strlen($str);
		}
		return $array;
	}
	
	function mb_str_split($string){ 
		return preg_split('/(?<!^)(?!$)/u', $string); 
	} 
	
	function checkRepeat($str_1,$str_2){
		$cmp_times=mb_strlen($str_1,'utf-8')-$this->config['checklength'];
		for($i=0;$i<$cmp_times;$i++){
			$substr=mb_substr($str_1,$i,$this->config['checklength'],'utf-8');
			$strpos=mb_strpos($str_2,$substr,0,'utf-8');
			if($strpos!==FALSE){
				return 1;
			}
		}
		
		return 0;
	}
	
	function clearPunctuation($str){
		$str=urlencode($str);//将关键字编码
		$str=preg_replace("/(%7E|%60|%21|%40|%23|%24|%25|%5E|%26|%27|%2A|%28|%29|%2B|%7C|%5C|%3D|\-|_|%5B|%5D|%7D|%7B|%3B|%22|%3A|%3F|%3E|%3C|%2C|\.|%2F|%A3%BF|%A1%B7|%A1%B6|%A1%A2|%A1%A3|%A3%AC|%7D|%A1%B0|%A3%BA|%A3%BB|%A1%AE|%A1%AF|%A1%B1|%A3%FC|%A3%BD|%A1%AA|%A3%A9|%A3%A8|%A1%AD|%A3%A4|%A1%A4|%A3%A1|%E3%80%82|%EF%BC%81|%EF%BC%8C|%EF%BC%9B|%EF%BC%9F|%EF%BC%9A|%E3%80%81|%E2%80%A6%E2%80%A6|%E2%80%9D|%E2%80%9C|%E2%80%98|%E2%80%99)+/",'',$str);
		$str=urldecode($str);//将过滤后的关键字解码
		return $str;	
	}
}

