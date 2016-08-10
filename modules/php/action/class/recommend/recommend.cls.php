<?php


class CommAct{
	
	/**
	*添加信息
	**/
	public function addInfo($name,$obj){
		$db=new DB();
		$res=$db->InsertData($name,$obj);
		$db->Close();	
	}
	
	/**
	*修改信息
	**/
	public function editInfo($name,$obj,$id){
		$db=new DB();
		$db->UpdateData($name,$id,$obj);
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
	*根据id查询
	**/
	public function findById($name,$id){
		$db=new DB();
		$res=$db->GetInfo($id,$name);
		$db->Close();
		return $res;	
	}
	
	
	/**
	*根据sql条件查询
	**/
	public function pageListByCon($page,$rows,$count,$sql){
		$page=($page-1)*$rows;
		$db=new DB(); 
	
		$sql =$sql.' limit '.$page.','.$rows;
	
		$commArr=$db->Select($sql);
		
		$db->Close();
		return $commArr;	
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
	
	
	//根据id查询全部
	function getAllByCommid($name,$column,$commid){
		$sql="select * from ".$name." where ".$column." = ".$commid;
		$db=new DB();
		$arr=$db->Select($sql);
		$db->Close();
		return $arr;
	}
	
	function delByCommid($name,$column,$commid){
		$sql="delete from ".$name." where ".$column." = ".$commid;
		$db=new DB();
		$db->Delete($sql);
		$db->Close();
	}
	
	/**
	*信息json转换
	**/
	public function toJson($commArr,$count){
		if(count($commArr)===0){
			$commJSON='{"total":0,"rows":[]}';	
		}else{
			for($i=0;$i<count($commArr);$i++){
				$commArr2[$i]=array('id'=>$commArr[$i]['id'],'name'=>$commArr[$i]['name'],'address'=>$commArr[$i]['address'],'linkman'=>$commArr[$i]['linkman'],'tel'=>$commArr[$i]['tel'],'email'=>$commArr[$i]['email'],'phone'=>$commArr[$i]['phone'],'fax'=>$commArr[$i]['fax'],'type'=>$commArr[$i]['type']);		
			}
			
			$commJSON='{"total":'.$count.',"rows":'.json_encode($commArr2).'}';
	
		}
	
		return $commJSON;
	}
	
	public function toJson2($comm){
		$comm='{id:'.$comm['id'].',name:"'.$comm['name'].'",address:"'.$comm['address'].'",phone:"'.$comm['phone'].'",fax:"'.$comm['fax'].'",postcode:"'.$comm['postcode'].'",tel:"'.$comm['tel'].'",email:"'.$comm['email'].'",linkman:"'.$comm['linkman'].'",type:"'.$comm['type'].'"}';
		return $comm;	
	}


}
?>
