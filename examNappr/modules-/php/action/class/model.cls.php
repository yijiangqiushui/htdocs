<?php
/**
author:Gao Xue
date:2014-06-30
*/

class MODELINFO{
	
	function treeData(){
		$arr=explode(",",str_replace("\n",'',BASE));
		
		if(count($arr)>0){
			
			$node[0]['id']=-1;
			$node[0]['text']='全部';
			$node[0]['state']='open';
			
			for($i=0;$i<count($arr);$i++){
				$node[$i+1]['id']=$i;
				$node[$i+1]['text']=$arr[$i];
				$node[$i+1]['state']='open';
			}
		}else{
			$node[0]['id']=-1;
			$node[0]['text']='全部';
			$node[0]['state']='open';
		}
		echo json_encode($node);
	}
	
	function queryModel($page,$rows){
		global $nodeId;
		$nodeId = isset($nodeId) ? $nodeId: -1;
		$page=($page-1)*$rows;
		
		if($nodeId!=-1){
			$sql='select * from makemodel where 1=1 and fileFolder = '.$nodeId;
			$sqlCount='select count(id) as "count" from makemodel where 1=1 and fileFolder = '.$nodeId;
		}else{
			$sql='select * from makemodel where 1=1';
			$sqlCount='select count(id) as "count" from makemodel where 1=1';
		}
		$db=new DB();
		
		$count=$db->select($sqlCount);
		$count=$count[0][count];
		
		$sql =$sql.' limit '.$page.','.$rows;
		
		$result=$db->select($sql);
		
		if(sizeof($result)>0){
			for($i=0;$i<count($result);$i++){
				$logArr[$i]=array('id'=>$result[$i]['id'],'sqlQuery'=>$result[$i]['sqlQuery'],'fileName'=>$result[$i]['fileName'],
									 'fileType'=>$result[$i]['fileType'],'fileFolder'=>$result[$i]['fileFolder']);
			}
			$logJSON='{"total":'.$count.',"rows":'.json_encode($logArr).'}';
		}else{
			$logJSON='{"total":0,"rows":[]}';
		}
		echo $logJSON;
		
		$db->close();
	}
	
	function getModel($id){
		$db=new DB();
		$modelInfo=$db->GetInfo($id,'makemodel');
		$json_arr=array(
			'id'=>$modelInfo['id'],
			'sqlQuery'=>$modelInfo['sqlQuery'],
			'fileName'=>$modelInfo['fileName'],
			'fileType'=>$modelInfo['fileType'],
			'fileFolder'=>$modelInfo['fileFolder'],
		);
		echo json_encode($json_arr);
		$db->Close();
	}
	
	function updateModel($id,$mo){
		$db=new DB();
		$db->UpdateData('makemodel',$id,$mo);
		$db->Close();
	}
	
	function delModel($id){
		$db=new DB();
		//$file=new FILE();
		//$path=SP_BASEPATH.$this->getPath($id,$db);
		$result=$db->DelData($id,'makemodel');
		/*if($result=='1'){
			$file->del_file($path);
		}*/
		$db->close();
	}
}
?>