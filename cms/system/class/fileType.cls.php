<?php
/************************************************************************************************************
#	PHP Version 1.2   MySQL  JavaScript
#	Copyright (c) 2009 http://www.cnalog.com
#	Author: Li Zhixiao <English Name: Hawking E-mail:lzxbit2008@yahoo.com.cn QQ:578731186>
#	Date: 2009/10/10
************************************************************************************************************/

class fileType extends DBSQL{
	
	public function __construct(){
		parent::__construct();
	}

	/*!- 文件类型分类相关 start --*/	
	public function isCatExist($catId,$catName){
		$sql="select id from fileTypeCat where id<>$catId and catName='$catName' limit 0,1";
		$r = $this->select($sql);
		return $r[0][0];
	}
	
	public function addCat($data){
		return $this->insertData('fileTypeCat',$data);
	}
	
	public function editCat($catId,$data){
		return $this->updateData('fileTypeCat',$catId,$data);
	}
	
	public function deleteCat($catId){
		return $this->delData($catId,'fileTypeCat');
	}
	
	public function getCat($catId){
		$data=array();
		$sql="select * from fileTypeCat where id=$catId limit 0,1";
		$r = $this->select($sql);
		return $r[0];
	}
	
	public function getBatchCat($sql){
		$r=$this->select($sql);
		return $r;
	}
	
	public function delBatchCat($idArr){
		$arr=split(',',$idArr);
		for($i=0;$i<count($arr);$i++){
			$sql="delete from fileTypeInfo where catId=".$arr[$i];
			$this->delete($sql);
		}
		return $this->delArrIdData($idArr,'fileTypeCat');
	}
	/*!- 文件类型分类相关 end --*/	

	/*!- 文件类型相关 start --*/	
	public function addInfo($data){
		return $this->insertData('fileTypeInfo',$data);
	}
	
	public function editInfo($infoId,$data){
		return $this->updateData('fileTypeInfo',$infoId,$data);
	}
	
	public function deleteInfo($infoId){
		return $this->delData($infoId,'fileTypeInfo');
	}
	
	public function getInfo($infoId){
		$data=array();
		$sql="select * from fileTypeInfo where id=$infoId limit 0,1";
		$r = $this->select($sql);
		return $r[0];
	}
	
	public function getBatchInfo($sql){
		$r=$this->select($sql);
		return $r;
	}
	
	public function delBatchInfo($idArr){
		return $this->delArrIdData($idArr,'fileTypeInfo');
	}
	/*!- 文件类型相关 end --*/	
}
?>