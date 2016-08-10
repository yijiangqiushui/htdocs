<?php

/**
*author:贺央央
**/
class ExpAct{
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
	public function editInfo($name,$id,$obj){
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

	public function delByCon($name,$id){
		$db=new DB();
		$sql='delete from '.$name.' where exp_id = '.$id;
		$db->Delete($sql);
		$db->Close();
	}
	
	public function getBySql($sql){
		$db=new DB();
		$arr=$db->Select($sql);	
		$db->Close();
		return $arr;
	}
	
	/**
	*分页显示
	**/
	public function pageList($sql,$page,$rows,$count){
		$page=($page-1)*$rows;
		$db=new DB(); 
	
		$sql =$sql.' limit '.$page.','.$rows;
	
		$arr=$db->Select($sql);
		$db->Close();
		
		return $arr;
	}
	
	/**
	*获得个数
	**/
	public function getCount($sql){
		
		$db=new DB(); 
	
		$count=$db->Select($sql);
		$count=$count[0][count];
		
		$db->Close();	
		return $count;	
	}
	
	/**
	*根据id获取信息
	**/
	public function findById($name,$id){
		$db=new DB();
		$res=$db->GetInfo($id,$name);
		$db->Close();
		return $res;	
	}
	
	/**
	*专家信息json形式
	**/
	public function toJson($arr,$count){
		if(count($arr)===0){
			$json='{"total":0,"rows":[]}';	
		}else{
			for($i=0;$i<count($arr);$i++){	
				$arr2[$i]=array('id'=>$arr[$i]['id'],'name'=>$arr[$i]['name'],'sex'=>$arr[$i]['sex'],'age'=>$arr[$i]['age'],'birth'=>$arr[$i]['birth'],'tel'=>$arr[$i]['tel'],'email'=>$arr[$i]['email'],'degree'=>$arr[$i]['degree'],'work'=>$arr[$i]['work'],'office'=>$arr[$i]['office'],'research'=>$arr[$i]['research']);		
			}
			
			$json='{"total":'.$count.',"rows":'.json_encode($arr2).'}';
	
		}
	
		return $json;
	}
	
	public function toJson2($obj){
		$json='{id:'.$obj['id'].',name:"'.$obj['name'].'",sex:"'.$obj['sex'].'",age:'.$obj['age'].',birth:"'.$obj['birth'].'",tel:"'.$obj['tel'].'",email:"'.$obj['email'].'",degree:"'.$obj['degree'].'",work:"'.$obj['work'].'",office:"'.$obj['office'].'",research:"'.$obj['research'].'"}';
		return $json;	
	}
	
	/**
	*教育经历json形式
	**/
	public function toJson_edu($arr,$cou){
		if(count($arr)===0){
			$json='{"total":0,"rows":[]}';	
		}else{
			for($i=0;$i<count($arr);$i++){	
				$arr2[$i]=array('id'=>$arr[$i]['id'],'stage'=>$arr[$i]['stage'],'school'=>$arr[$i]['school'],'starttime'=>$arr[$i]['starttime'],'endtime'=>$arr[$i]['endtime'],'exp_id'=>$arr[$i]['exp_id']);		
			}			
			$json='{"total":'.$cou.',"rows":'.json_encode($arr2).'}';	
		}	
		return $json;
	}
	
	public function toJson2_edu($obj){
		$json='{id:'.$obj['id'].',stage:"'.$obj['stage'].'",school:"'.$obj['school'].'",starttime:"'.$obj['starttime'].'",endtime:"'.$obj['endtime'].'",exp_id:'.$obj['exp_id'].'}';
		return $json;	
	}
	/**
	*获得荣誉json形式
	**/
	public function toJson_hor($arr,$cou){
		if(count($arr)===0){
			$json='{"total":0,"rows":[]}';	
		}else{
			for($i=0;$i<count($arr);$i++){	
				$arr2[$i]=array('id'=>$arr[$i]['id'],'overview'=>$arr[$i]['overview'],'descrip'=>$arr[$i]['descrip'],'attname'=>$arr[$i]['attname'],'savepath'=>$arr[$i]['savepath'],'exp_id'=>$arr[$i]['exp_id']);		
			}			
			$json='{"total":'.$cou.',"rows":'.json_encode($arr2).'}';	
		}	
		return $json;
	}
	
	public function toJson2_hor($obj){
		$json='{id:'.$obj['id'].',overview:"'.$obj['overview'].'",descrip:"'.$obj['descrip'].'",exp_id:'.$obj['exp_id'].'}';
		return $json;	
	}
	
	/**
	*指导竞赛json形式
	**/
	public function toJson_com($arr,$cou){
		if(count($arr)===0){
			$json='{"total":0,"rows":[]}';	
		}else{
			for($i=0;$i<count($arr);$i++){	
				$arr2[$i]=array('id'=>$arr[$i]['id'],'name'=>$arr[$i]['name'],'address'=>$arr[$i]['address'],'time'=>$arr[$i]['time'],'result'=>$arr[$i]['result'],'exp_id'=>$arr[$i]['exp_id']);		
			}			
			$json='{"total":'.$cou.',"rows":'.json_encode($arr2).'}';	
		}	
		return $json;
	}
	
	public function toJson2_com($obj){
		$json='{id:'.$obj['id'].',name:"'.$obj['name'].'",address:"'.$obj['address'].'",time:"'.$obj['time'].'",result:"'.$obj['result'].'",exp_id:'.$obj['exp_id'].'}';
		return $json;	
	}
}

?>