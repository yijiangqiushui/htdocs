<?php
/**
author:Gao Xue
date:2014-04-28
*/

class DATA{
	
	function backup($dataname){
		$db=new DB();
		$filepath=DBBACKUPPATH.(date('YmdHis')).$dataname.'.sql';
		$db->DataBackup($dataname,$filepath);
		echo $filepath;
		$db->Close();
	}
	
	function saveBackup($backup){
		$db=new DB();
		$result=$db->InsertData('dbhistory',$backup);
		echo $result;
		$db->Close();
	}
	
	function queryBackup($page,$rows){
		$page=($page-1)*$rows;
		
		$sql='select * from dbhistory ';
		$sqlCount='select count(id) as "count" from dbhistory ';
		
		$db=new DB();
		
		$count=$db->select($sqlCount);
		$count=$count[0][count];
		
		$sql =$sql.' limit '.$page.','.$rows;
		
		$result=$db->select($sql);
		
		if(sizeof($result)>0){
			for($i=0;$i<count($result);$i++){
				$logArr[$i]=array('id'=>$result[$i]['id'],'optname'=>$result[$i]['optname'],'optdate'=>$result[$i]['optdate'],
									 'dbname'=>$result[$i]['dbname']);
			}
			$logJSON='{"total":'.$count.',"rows":'.json_encode($logArr).'}';
		}else{
			$logJSON='{"total":0,"rows":[]}';
		}
		echo $logJSON;
		
		$db->close();
	}
	
	function restoreData($db_filename){
		$dbname= substr(str_replace('.sql','',$db_filename),14);
		$db=new DB();
		$filepath=DBBACKUPPATH.$db_filename;
		$db->RestoreDB($filepath,$dbname);
	}
}
?>