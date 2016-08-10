<?php
/**
*author heyangyang
**/

include 'db.cls.php';
include '../config.ini.php';
include '../../../sp/php/config.ini.php';

class Pridge{
	
	function getPridge($cat){
		if($cat===null||$cat===''){
			return false;	
		}
		
		if($cat=='.'){
			return true;	
		}
		
		$db=new DB();
		$cat=substr($cat,0,strlen($cat)-1);
		$cat=strrchr($cat,'.');
		$catid=intval(substr($cat,1));
		$sql='SELECT userPrivileges FROM admincat WHERE id='.$catid;
		
		$res=$db->Select($sql);
		
		$db->Close();
		
		return $res[0]['userPrivileges'];						
	}
		
}

?>