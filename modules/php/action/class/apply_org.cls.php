<?php

/**
*author:heyangyang
**/

include '../../../../common/php/lib/db.cls.php';

class ApplyOrg{
	
	/**
	*分页查询
	**/
	public function pageList($name,$page,$rows,$count){
		$page=($page-1)*$rows;
		$db=new DB(); 
	
		$sql='select * from '.$name;
		$sql =$sql.' limit '.$page.','.$rows;
		
		$arr=$db->Select($sql);
		$db->Close();		
		return $arr;
	}
	
	/**
	*获得数据总数
	**/
	public function getCount($name){
		
		$db=new DB(); 
		$sql='select count(id) as "count" from '.$name;
		
		$count=$db->Select($sql);
		$count=$count[0][count];
		
		$db->Close();	
		return $count;	
	}
	
	/**
	*根据sql条件查询
	**/
	public function pageListByCon($page,$rows,$count,$sql){
		$page=($page-1)*$rows;
		$db=new DB(); 
	
		$sql =$sql.' limit '.$page.','.$rows;
		$arr=$db->Select($sql);
		
		$db->Close();
		return $arr;	
	}
	
	/**
	*获得满足条件的对象数量
	**/
	public function getCountByCon($sql){
	
		$db=new DB(); 	
		
		$count=$db->Select($sql);
		$count=$count[0][count];
	
		$db->Close();
		return $count;
			
	}
	
	/**
	*根据sql查询
	**/
	public function findBySql($sql){
		$db=new DB();
		$arr=$db->Select($sql);
		$db->Close();
		return $arr;
	
	}
	
	/**
	*根据sql删除
	**/
	public function delBySql($sql){
		$db=new DB();
		$db->Delete($sql);
		$db->Close();	
	}
	
	/**
	*删除信息
	**/
	public function delInfo($name,$id){
		$db=new DB();
		$db->DelData($id,$name);
		$db->Close();
	}
	
	/**
	*根据id查询
	**/
	public function findById($name,$id){
		$db=new DB();
		$res=$db->GetInfo($id,$name);
		$db->Close();
		return $res;	
	}
	
	/**
	*修改信息
	**/
	public function updateInfo($name,$obj,$id){
		$db=new DB();
		$db->UpdateData($name,$id,$obj);
		$db->Close();
	}
	
	public function updateBySql($sql){
		$db=new DB();
		$db->Update($sql);
		$db->Close();	
	}
	
	/**
	*json转换
	**/
	public function toJson($arr,$count){
		if(count($arr)===0){
			$json='{"total":0,"rows":[]}';	
		}else{
			for($i=0;$i<count($arr);$i++){
				$arr2[$i]=array('id'=>$arr[$i]['id'],'orgCode'=>$arr[$i]['orgCode'],'orgName'=>$arr[$i]['orgName'],'legalPerson'=>$arr[$i]['legalPerson'],'contact'=>$arr[$i]['contact'],'phone'=>$arr[$i]['phone'],'telphone'=>$arr[$i]['telphone'],'email'=>$arr[$i]['email'],'address'=>$arr[$i]['address'],'is_checked'=>$arr[$i]['is_checked']);		
			}
		
			$json='{"total":'.$count.',"rows":'.json_encode($arr2).'}';
	
		}
	
		return $json;
	}
	
	public function toJson2($obj){
		$res='{id:'.$obj['id'].',orgCode:"'.$obj['orgCode'].'",orgName:"'.$obj['orgName'].'",legalPerson:"'.$obj['legalPerson'].'",contact:"'.$obj['contact'].'",phone:"'.$obj['phone'].'",telphone:"'.$obj['telphone'].'",email:"'.$obj['email'].'",address:"'.$obj['address'].'"}';
		return $res;	
	}
	
	/**
	* 改变审核状态
	*/
	public function change_checked($flag,$id){
		$db=new DB;
		$sql="update apply_org set is_checked = $flag where id = $id";
		$res=$db->Update($sql);
		$db->Close();
		echo $res;
	}
}

?>