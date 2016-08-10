<?php
/**
author:Gao Xue
date:2014-04-30
*/

class ADMININFO{
	
	function queryAdmin($page,$rows,$upCatory,$usr,$isForbidden){
		$page=($page-1)*$rows;
		$sql='select * from admininfo where id!=1';// modify:heyangyang 
		$sqlCount='select count(id) as "count" from admininfo where id!=1';//modify:heyangyang
		if($upCatory!==''&&$upCatory!==null){
			$str='"%'.$upCatory.'%"';
			$sql=$sql.' and category like '.$str;
			$sqlCount=$sqlCount.' and category like '.$str;
		}
		if($usr!==''&&$usr!==null){
			$str='"%'.$usr.'%"';
			$sql=$sql.' and usr like '.$str;
			$sqlCount=$sqlCount.' and usr like '.$str;
		}
		if($isForbidden!==''&&$isForbidden!==null){
			$sql=$sql.' and isForbidden = '.$isForbidden;
			$sqlCount=$sqlCount.' and isForbidden = '.$isForbidden;
		}
		
		$db=new DB();
		
		$count=$db->select($sqlCount);
		$count=$count[0][count];
		
		$sql =$sql.' limit '.$page.','.$rows;

		$result=$db->select($sql);
		
		if(sizeof($result)>0){
			for($i=0;$i<count($result);$i++){
				$adminArr[$i]=array('id'=>$result[$i]['id'],'usr'=>$result[$i]['usr'],'phone'=>$result[$i]['phone'],
									 'email'=>$result[$i]['email'],'qq'=>$result[$i]['qq'],'isForbidden'=>$result[$i]['isForbidden'],
									 'addedDate'=>$result[$i]['addedDate']);
			}
			$adminJSON='{"total":'.$count.',"rows":'.json_encode($adminArr).'}';
		}else{
			$adminJSON='{"total":0,"rows":[]}';
		}
		echo $adminJSON;
		
		$db->close();
	}
	
	
	function saveAdmin($admininfo){
		$db=new DB();
		$result=$db->InsertData('admininfo',$admininfo);
		echo $result;
		$db->Close();
	}
	
	function getAdmin($id){
		$db=new DB();
		$result[0]=$db->GetInfo($id,'admininfo');
		if($result[0]['category']!=='.'){
			$upidArr=explode('.',$result[0]['category']);
			$upperID=intval($upidArr[sizeof($upidArr)-2]);
		}else{
			$upperID=0;
		}
		$labinfoJSON=array('id'=>$result[0]['id'],'usr'=>$result[0]['usr'],'realname'=>$result[0]['realname'],'company'=>$result[0]['company'],'title'=>$result[0]['title'],'cardID'=>$result[0]['cardID'],'cellphone'=>$result[0]['cellphone'],'phone'=>$result[0]['phone'],'email'=>$result[0]['email'],'qq'=>$result[0]['qq'],'isForbidden'=>$result[0]['isForbidden'],'upperID'=>$upperID,'addedDate'=>$result[0]['addedDate'],'lastIP'=>$result[0]['lastIP'],'category'=>$result[0]['category']);
		echo json_encode($labinfoJSON);
		$db->close();
	}
	
	function updateAdmin($id,$upAdmin){
		$user=new USER();
		if($upAdmin['pwd']==''){
			$str='';
		}else{
			$str=',pwd="'.$user->EncriptPWD($upAdmin['pwd']).'"';
		}
		$sql='update admininfo set category="'.$upAdmin['category'].'" ,usr="'.$upAdmin['usr'].'" ,realname="'.$upAdmin['realname'].'" ,phone="'.$upAdmin['phone'].'" ,email="'.$upAdmin['email'].'" ,qq="'.$upAdmin['qq'].'" ,isForbidden='.$upAdmin['isForbidden'].$str.' where id='.$id;

		echo $sql;
		$db=new DB();
		$db->Update($sql);
		$db->close();
	}
	
	function delAdmin($id){
		$db=new DB();
		$db->DelData($id,'admininfo');
		$db->close();
	}
	
	function delArrAdmin($arrId){
		$db=new DB();
		$db->DelArrIdData($arrId,'admininfo');
		$db->close();
	}
	
	function disableAdmin($list,$flag){
		$idarray=explode(',',$list);
		$db=new DB();
		for($i=0;$i<count($idarray);$i++){
			$sql_edit='update admininfo set isForbidden='.$flag.' where id='.$idarray[$i];
			$db->Update($sql_edit);
		}	
		$db->Close();
	}
}
?>