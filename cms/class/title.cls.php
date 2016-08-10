<?php
/************************************************************************************************************
#	PHP Version 1.2   MySQL  JavaScript
#	Copyright (c) 2009 http://www.cnalog.com
#	Author: Li Zhixiao <English Name: Hawking E-mail:lzxbit2008@yahoo.com.cn QQ:578731186>
#	Date: 2009/10/10
************************************************************************************************************/

class title extends DBSQL{
	
	public function __construct(){
		parent::__construct();
	}

	/*!- 标题类型相关 start --*/	
	public function isCatExist($catId,$catName,$upperCat){
		$sql="select id from titleCat where id<>$catId and catName='$catName' and upperCat='$upperCat' limit 0,1";
		$r = $this->select($sql);
		return $r[0][0];
	}
	
	public function addCat($data){
		return $this->insertData('titleCat',$data);
	}
	
	public function editCat($catId,$data){
		$sql="select upperCat from titleCat where id=$catId limit 0,1";
		$r=$this->select($sql);
		$sql="update titleCat set upperCat=concat('".$data[upperCat]."',replace(substring(upperCat,locate('s".$catId."e',upperCat)),'s".$r[0][0]."e','s".$data[upperId]."e')) where upperCat like '%s".$catId."e%'";
		$this->update($sql);
		$sql="update titleCat set isLast=0 where id=".$data[upperId];
		$this->update($sql);
		$sql="update titleInfo set category=concat('".$data[upperCat]."',replace(substring(category,locate('s".$catId."e',category)),'s".$r[0][0]."e','s".$data[upperId]."e')) where category like '%s".$catId."e%'";
		$this->update($sql);
		return $this->updateData('titleCat',$catId,$data);
	}
	
	public function deleteCat($catId){
		return $this->delData($catId,'titleCat');
	}
	
	public function getCat($catId){
		$data=array();
		$sql="select * from titleCat where id=$catId limit 0,1";
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
			$sql="delete from titleInfo where category like '%s".$arr[$i]."e%'";
			$this->delete($sql);
			$sql="delete from titleCat where upperCat like '%s".$arr[$i]."e%'";
			$this->delete($sql);
		}
		return $this->delArrIdData($idArr,'titleCat');
	}
	/*!- 标题类型相关 end --*/	

	/*!- 标题信息相关 start --*/	
	public function addInfo($data){
		return $this->insertData('titleInfo',$data);
	}
	
	public function editInfo($infoId,$data){
		return $this->updateData('titleInfo',$infoId,$data);
	}
	
	public function deleteInfo($infoId){
		return $this->delData($infoId,'titleInfo');
	}
	
	public function getInfo($infoId){
		$data=array();
		$sql="select * from titleInfo where id=$infoId limit 0,1";
		$r = $this->select($sql);
		return $r[0];
	}
	
	public function getBatchInfo($sql){
		$r=$this->select($sql);
		return $r;
	}
	
	public function delBatchInfo($idArr){
		return $this->delArrIdData($idArr,'titleInfo');
	}
	/*!- 标题信息相关 end --*/	
}
?>