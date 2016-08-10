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
				    //david modify
				    if(is_array($value)){
				        foreach($value as $key1=>$value1){
				            $input[$key]=addslashes($value1);
				        }
				    }else{
				        $input[$key]=addslashes($value);
				        
				    }
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
	
	/*发邮件*/
	function email_send($smtpemailto,$mailsubject,$mailbody) {
	    $db = new DB();
	    $data = array(
	        "email"=>$smtpemailto,
	        "mailbody"=>$mailbody,
	        "mailsubject"=>$mailsubject
	    );
	    $insert_result = $db -> InsertData('emaillist', $data);
		//引入发送邮件类
		/* require("smtp.php");
		//使用邮箱服务器
		$smtpserver = "smtpcom.263xmail.com";
		//邮箱服务器端口 
		$smtpserverport = 25;
		//你的服务器邮箱账号
		$smtpusermail = "tzkw@bjtzst.gov.cn";
		//收件人邮箱
		$smtpuser = "tzkw";
		//你的邮箱密码
		$smtppass = "KW6666666";
		//邮件主题 
		$mailtype = "HTML";
		//这里面的一个true是表示使用身份验证,否则不使用身份验证. 
		$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);
		//是否显示发送的调试信息 
		$smtp->debug = TRUE;
		//发送邮件
		$smtp->sendmail($smtpemailto, $smtpusermail, $mailsubject, $mailbody, $mailtype); */
	    
	    /* require 'phpmailer/class.phpmailer.php';
	    
	    try {
	        $mail = new PHPMailer(true);
	        $mail->IsSMTP();
	        $mail->CharSet='UTF-8'; //设置邮件的字符编码，这很重要，不然中文乱码
	        $mail->SMTPAuth   = true;                  //开启认证
	        $mail->Port       = 25;
	        $mail->Host       = "smtpcom.263xmail.com";
	        $mail->Username   = "tzkw@bjtzst.gov.cn";
	        $mail->Password   = "kw6666666";
	        
	        $mail->From       = "tzkw@bjtzst.gov.cn";
	        $mail->FromName   = "北京市通州区科学技术委员会";
	         
	        $to = $smtpemailto;
	        $mail->AddAddress($to);
	        //$mail->AddAttachment("f:/test.png");  //可以添加附件
	        $mail->IsHTML(true);
	        $mail->Subject  = $mailsubject;
	        $mail->Body = $mailbody;
// 	        $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; //当邮件不支持html时备用显示，可以省略
	        $mail->WordWrap   = 80; // 设置每行字符串的长度
	        	    
	        $mail->Send();
	    } catch (phpmailerException $e) {
	        echo "邮件发送失败：".$e->errorMessage();
	    } */
	    
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