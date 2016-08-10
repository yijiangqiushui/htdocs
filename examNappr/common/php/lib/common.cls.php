<?php
/**************************************************
#	Version 1.2		PHP MySQL JavaScript
#	Copyright (c) 2009 http://www.fangbian123.com
#	Author: Li Zhixiao <English Name: Hawking E-mail:578731186@qq.com QQ:578731186>
#	Date: 2009/10/10
#	Modified by Li Zhixiao	2014/03/14
**************************************************/

/**
 * 功能：公用类
 * 使用示例：$cmn=new COMMON();
 */
class COMMON{
	
	/**
	* 功能：防注入
	* 参数：$input-POST或GET
	* 返回：过滤的$input
	*/
	public function noInjection($input){
		if(!get_magic_quotes_gpc()) {
			if(is_array($input)){
				foreach($input as $key=>$value){
					$input[$key]=addslashes($value);
				}
			}
			else{
				addslashes($input);
			}
		}
		return $input;
	}

	/**
	* 获取IP地址
	**/
	function IP(){
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
	* 禁止通过输入地址的方式直接访问
	**/
	function noLocalSubmit($http_server_vars_){
		$serverName=$http_server_vars_['SERVER_NAME'];
		$submitFrom=$http_server_vars_["HTTP_REFERER"];
		$snLen=strlen($serverName); 
		$isFrom=substr($submitFrom,7,$snLen);
		if($isFrom!=$serverName){
			echo ("请不要尝试从外部提交数据！"); 
			exit; 
		}
	} 

	/**
	* 截取UTF8汉字字符串
	**/
	function utf8_substr($str,$start,$end) {
		$str=clearStr($str);
		$null = "";
	   preg_match_all("/./u", $str, $ar);
	   if(func_num_args() >= 3) {
		   $end = func_get_arg(2);
		   return join($null, array_slice($ar[0],$start,$end));
	   } else {
		   return join($null, array_slice($ar[0],$start));
	   }
	}


}

/**
*声明后后面直接调用$comm
*先防注入
*/
$comm=new COMMON();
$comm->noInjection($_GET);
$comm->noInjection($_POST);

//$comm->noLocalSubmit($HTTP_SERVER_VARS);

?>