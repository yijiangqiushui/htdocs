<?php
/************************************************************************************************************
#	PHP Version 1.2   MySQL  JavaScript
#	Copyright (c) 2009 http://www.cnalog.com
#	Author: Li Zhixiao <English Name: Hawking E-mail:lzxbit2008@yahoo.com.cn QQ:578731186>
#	Date: 2009/10/10
************************************************************************************************************/

class feedback extends DBSQL{
	
	public function __construct(){
		parent::__construct();
	}

	/*!- 信息反馈相关 start --*/	
	public function addInfo($data){
		return $this->insertData('feedbackInfo',$data);
	}
	
	public function editInfo($infoId,$data){
		return $this->updateData('feedbackInfo',$infoId,$data);
	}
	
	public function deleteInfo($infoId){
		return $this->delData($infoId,'feedbackInfo');
	}
	
	public function getInfo($infoId){
		$data=array();
		$sql="select * from feedbackInfo where id=$infoId limit 0,1";
		$r = $this->select($sql);
		return $r[0];
	}
	
	public function getBatchInfo($sql){
		$r=$this->select($sql);
		return $r;
	}
	
	public function delBatchInfo($idArr){
		$sql="delete from feedbackReply where infoId in ($idArr)";
		$this->delete($sql);
		return $this->delArrIdData($idArr,'feedbackInfo');
	}
	/*!- 信息反馈相关 end --*/	
	
	/*!- 内容回复相关 start --*/	
	public function editReply($infoId,$data){
		return $this->updateData('feedbackReply',$infoId,$data);
	}
	/*!- 内容回复相关 end --*/	
}
?>