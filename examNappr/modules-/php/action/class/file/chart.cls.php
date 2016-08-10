<?php
/*
author:Hao xiaoqiang
date:2014-06-10
Modify by: Ma Jun wei
date:2015-03-19
*/
class Chart{
	public function getCount($sql){
		$db=new DB();
		$res=$db->Select($sql);
		return $res[0]['count'];
	}
	public function getData($sql){
		$db=new DB();
		$res=$db->Select($sql);
		return $res;	
		}
	
	//各个类型的制发文件数量
	public function getTypeData_comm(){
	
		$sql="select types,count(types) as 'count' from document where ismake=1 and isInvalid=0 group by types";
		$arr=$this->getData($sql);
		for($i=0;$i<count($arr);$i++){
			$resarr[$i]=array('types'=>$arr[$i]['types'],'count'=>$arr[$i]['count']);
		}
		$json=json_encode($resarr);		
		echo $json;	
	}
	//各单位制发文件数量
	public function getDeptData_comm(){
		$sql="SELECT COUNT(a.category) as total, b.catName FROM document a, admincat b WHERE a.category=CONCAT(b.upperCat,b.id,'.') and ismake=1 and isInvalid=0 GROUP BY a.category";
		$db=new DB();
		$res=$db->Select($sql);
		$db->Close();
		$result=array();
		for($i=0;$i<count($res);$i++){
			$result[$i]=array(
				'department'=>$res[$i]['catName'],
				'count'=>$res[$i]['total']
			);
		}
		echo json_encode($result);
	}
	//各加密级别制发文件数量
	public function getLevelData_comm(){
	
		$sql="select file_level,count(file_level) as 'count' from document where ismake=1 and isInvalid=0 group by file_level";
		$arr=$this->getData($sql);
		for($i=0;$i<count($arr);$i++){
			$resarr[$i]=array('file_level'=>$arr[$i]['file_level'],'count'=>$arr[$i]['count']);
		}
		$json=json_encode($resarr);		
		echo $json;	
	}
	//各日期制发文件数量
	public function getaddedData_comm(){
		$sql="SELECT COUNT(a.addedDate) AS count , CONCAT(MONTH(addedDate),'月')AS addedDate FROM document a WHERE YEAR(NOW())=YEAR(addedDate) and ismake=1 and isInvalid=0 GROUP BY MONTH(addedDate) ";	
		$arr=$this->getData($sql);
		for($i=0;$i<count($arr);$i++){
			$resarr[$i]=array('addedDate'=>$arr[$i]['addedDate'],'count'=>$arr[$i]['count']);
		}
		$json=json_encode($resarr);		
		echo $json;	
	}
	//按用章人查询印章使用申请数量
	public function getDeptDataTotal(){
		$sql="SELECT COUNT(a.category) as total, b.catName FROM apply a, admincat b WHERE a.category=CONCAT(b.upperCat,b.id,'.') and file_no is not null and isInvalid=0 GROUP BY a.category";
		$db=new DB();
		$res=$db->Select($sql);
		$db->Close();
		$result=array();
		for($i=0;$i<count($res);$i++){
			$result[$i]=array(
				'cat_name'=>$res[$i]['catName'],
				'total'=>$res[$i]['total']
			);
		}
		echo json_encode($result);
	}
	//按用章内容查询印章使用申请数量
	public function getConDataTotal(){
		$sql="SELECT COUNT(content) AS total, content FROM apply where file_no is not null and isInvalid=0 GROUP BY content";
		$db=new DB();
		$res=$db->Select($sql);
		$db->Close();
		$result=array();
		for($i=0;$i<count($res);$i++){
			$result[$i]=array(
				'content'=>$res[$i]['content'],
				'total'=>$res[$i]['total']
			);	
		}
		echo json_encode($result);
	}
	//按用章时间查询(按当年的月份统计)
	public function getUseTimeDataTotal(){
		$sql="SELECT COUNT(a.use_time) AS total , CONCAT(MONTH(use_time),'月')AS use_time FROM apply a WHERE YEAR(NOW())=YEAR(use_time) and file_no is not null and isInvalid=0 GROUP BY MONTH(use_time) ";	
		$db=new DB();
		$res=$db->Select($sql);
		$db->Close();
		$result=array();
		for($i=0;$i<count($res);$i++){
			$result[$i]=array(
				'use_time'=>$res[$i]['use_time'],
				'total'=>$res[$i]['total']
			);	
		}
		echo json_encode($result);
	}
	//按是否借用查询印章使用申请数量
	public function getBorrowDataTotal(){
		$sql="SELECT COUNT(end_time ) AS total, '借出' AS way   FROM apply  WHERE file_no is not null and isInvalid=0 and end_time IS NOT NULL UNION SELECT (SELECT COUNT(id) AS total  FROM apply) - (SELECT COUNT(end_time ) AS total FROM apply  WHERE end_time IS NOT NULL) AS total, '使用' AS way";	
		$db=new DB();
		$res=$db->Select($sql);
		$db->Close();
		$result=array();
		for($i=0;$i<count($res);$i++){
			$result[$i]=array(
				'way'=>$res[$i]['way'],
				'total'=>$res[$i]['total']
			);	
		}
		echo json_encode($result);
	}
	//各日期短信数量
	public function getaddedData_sms(){
		$sql="SELECT COUNT(a.sendtime) AS count , CONCAT(MONTH(sendtime),'月')AS sendtime FROM smsinfo a WHERE YEAR(NOW())=YEAR(sendtime) GROUP BY MONTH(sendtime) ";	
		$arr=$this->getData($sql);
		for($i=0;$i<count($arr);$i++){
			$resarr[$i]=array('sendtime'=>$arr[$i]['sendtime'],'count'=>$arr[$i]['count']);
		}
		$json=json_encode($resarr);		
		echo $json;	
	}
	
}
?>