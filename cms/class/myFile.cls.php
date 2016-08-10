<?php
/************************************************************************************************************
#	PHP Version 1.2   MySQL  JavaScript
#	Copyright (c) 2009 http://www.cnalog.com
#	Author: Li Zhixiao <English Name: Hawking E-mail:lzxbit2008@yahoo.com.cn QQ:578731186>
#	Date: 2009/10/10
************************************************************************************************************/

class myFile extends DBSQL{
	
	public function __construct(){
		parent::__construct();
	}

	/*!- 文件类型相关 start --*/	
	public function isCatExist($catId,$catName,$upperCat){
		$sql="select id from myFileCat where id<>$catId and catName='$catName' and upperCat='$upperCat' limit 0,1";
		$r = $this->select($sql);
		return $r[0][0];
	}
	
	public function addCat($data){
		return $this->insertData('myFileCat',$data);
	}
	
	public function editCat($catId,$data){
		$sql="select upperCat from myFileCat where id=$catId limit 0,1";
		$r=$this->select($sql);
		$sql="update myFileCat set upperCat=concat('".$data[upperCat]."',replace(substring(upperCat,locate('s".$catId."e',upperCat)),'s".$r[0][0]."e','s".$data[upperId]."e')) where upperCat like '%s".$catId."e%'";
		$this->update($sql);
		$sql="update myFileCat set isLast=0 where id=".$data[upperId];
		$this->update($sql);
		$sql="update myFileInfo set category=concat('".$data[upperCat]."',replace(substring(category,locate('s".$catId."e',category)),'s".$r[0][0]."e','s".$data[upperId]."e')) where category like '%s".$catId."e%'";
		$this->update($sql);
		return $this->updateData('myFileCat',$catId,$data);
	}
	
	public function deleteCat($catId){
		return $this->delData($catId,'myFileCat');
	}
	
	public function getCat($catId){
		$data=array();
		$sql="select * from myFileCat where id=$catId limit 0,1";
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
			$sql="delete from myFileInfo where category like '%s".$arr[$i]."e%'";
			$this->delete($sql);
			$sql="delete from myFileCat where upperCat like '%s".$arr[$i]."e%'";
			$this->delete($sql);
		}
		return $this->delArrIdData($idArr,'myFileCat');
	}
	/*!- 文件类型相关 end --*/	

	/*!- 文件信息相关 start --*/	
	public function addInfo($data){
		return $this->insertData('myFileInfo',$data);
	}
	
	public function editInfo($infoId,$data){
		return $this->updateData('myFileInfo',$infoId,$data);
	}
	
	public function deleteInfo($infoId){
		return $this->delData($infoId,'myFileInfo');
	}
	
	public function getInfo($infoId){
		$data=array();
		$sql="select * from myFileInfo where id=$infoId limit 0,1";
		$r = $this->select($sql);
		return $r[0];
	}
	
	public function getBatchInfo($sql){
		$r=$this->select($sql);
		return $r;
	}
	
	public function delBatchInfo($idArr){
		return $this->delArrIdData($idArr,'myFileInfo');
	}
	/*!- 文件信息相关 end --*/	
	}
?>