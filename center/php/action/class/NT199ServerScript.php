<?php  
Class NT199ServerScript {  
  
	var $iv ="\x0\x0\x0\x0\x0\x0\x0\x0"; 
	function GenerateRandomString()
	{
		$RndStr = substr(md5(time()).md5(time()), 0, 32);//������������32λ����������û����Լ����������,�����ڸ�����
		return $RndStr;
	}
	
		
	//Sha1�㷨
	function CheckHashValues($clientHashValue,$userSeed,$randomStr)
	{
		$CheckValue = 1;
		$ServerShaValue = sha1($randomStr.$userSeed);
		if($clientHashValue==$ServerShaValue)
		{
			$CheckValue = 0;
		}
		return $CheckValue;
	}
	
	
	function pkcs5_pad($text, $blocksize)  
	{  
	  $pad = $blocksize - (strlen($text) % $blocksize);  
	  return $text . str_repeat(chr($pad), $pad);  
	}  
	  
	function pkcs5_unpad($text)  
	{  
	  $pad = ord($text{strlen($text)-1});  
	  if ($pad > strlen($text))   
	  {  
		return false;
	  }  
	  if( strspn($text, chr($pad), strlen($text) - $pad) != $pad)  
	  {  
		return false;  
	  }  
	  return substr($text, 0, -1 * $pad);  
	} 
}
