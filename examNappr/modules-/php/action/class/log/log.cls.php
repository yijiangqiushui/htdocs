<?php
/**
author:Gao Xue
date:2014-04-28
modify:Wang Le
date:2014-09-05
*/

class LOGINFO{
	//新增操作日志
	function addLog($opt,$username,$timedata){
		$loginfo['opt']=$opt;
		$loginfo['username']=$username;
		$loginfo['timedata']=$timedata;
		$db=new DB();
		$db->InsertData('loginfo',$loginfo);
		$db->Close();
	}
	//显示操作日志
	function queryLog($page,$rows){
		$page=($page-1)*$rows;
		
		$sql='select * from loginfo where 1=1 order by id desc';
		$sqlCount='select count(id) as "count" from loginfo where 1=1';
		
		$db=new DB();
		
		$count=$db->select($sqlCount);
		$count=$count[0][count];
		
		$sql =$sql.' limit '.$page.','.$rows;
		
		$result=$db->select($sql);
		
		if(sizeof($result)>0){
			for($i=0;$i<count($result);$i++){
				$logArr[$i]=array('id'=>$result[$i]['id'],'opt'=>$result[$i]['opt'],'username'=>$result[$i]['username'],
									 'timedata'=>$result[$i]['timedata']);
			}
			$logJSON='{"total":'.$count.',"rows":'.json_encode($logArr).'}';
		}else{
			$logJSON='{"total":0,"rows":[]}';
		}
		echo $logJSON;
		
		$db->close();
	}
}
?>