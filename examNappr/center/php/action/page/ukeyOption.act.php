<?php
/**
author:Gao Xue
date:2014-2015-03-18
*/
include '../class/NT199ServerScript.php';
include '../../../../common/php/lib/common.cls.php';
include '../../../../common/php/lib/db.cls.php';
include '../../../../common/php/config.ini.php';
include '../../../../common/php/lib/user.cls.php';

switch($_GET['action']){
	case 'getUsr':
		echo $_SESSION['flag'];
		break;
	case 'getRandom':
		$crypt = new NT199ServerScript();
		$RndStr = $crypt->GenerateRandomString();
		$_SESSION["RandomStr"] = $RndStr;
		echo  $RndStr;
		break;
	case 'getHeader':
		//$NT199GUID = $_SESSION['NTID'];
	 	$RandomData = $_SESSION["RandomStr"];
	 	$CheckClintValue = $_SESSION['Digest'];
	 	//$oldPwd = $_SESSION['userPin'];
		$crypt = new NT199ServerScript();
	 	$checkSHA1 = $crypt->CheckHashValues($CheckClintValue,$_SESSION['server_seed'],$RandomData);
		if($checkSHA1!=0){
			echo "<script language='javascript'>alert(\"二次验证错误，请配置正确数据库！\");</script>";
			echo "<SCRIPT LANGUAGE=\"JavaScript\">";  
			echo "location.href='center/html/view/template/'";  
			echo "</SCRIPT>"; 
		 }
		 break;
	case 'getOldPwd':
		echo $_SESSION['userPin'];
		break;
	default:;
}
?>