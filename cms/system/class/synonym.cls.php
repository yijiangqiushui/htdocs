<?php

class synonym extends DBSQL{
	
	public function __construct(){
		parent::__construct();
	}

	/*!- 同义词 start --*/	
	public function addSynonym($data){
		return $this->insertData('synonyminfo',$data);
	}
	
	public function editSynonym($infoId,$data){
		return $this->updateData('synonymInfo',$infoId,$data);
	}
	
	public function deleteSynonym($infoId){
		return $this->delData($infoId,'synonymInfo');
	}
	
	public function getSynonymInfo($infoId){
		$data=array();
		$sql="select * from synonymInfo where id=$infoId";
		$r = $this->select($sql);
		return $r[0];
	}
	
	public function getKeywords($keyword){
		$data=array();
		$sql="select keywords from synonymInfo where keywords like '%$keyword%' order by length(keywords) asc limit 0,1";
		$r = $this->select($sql);
		return $r[0][0];
	}
	
	public function getBatchInfo($sql){
		$r=$this->select($sql);
		return $r;
	}
	
	public function delBatchInfo($idArr){
		return $this->delArrIdData($idArr,'synonymInfo');
	}
	/*!- 同义词 end --*/	

}
?>