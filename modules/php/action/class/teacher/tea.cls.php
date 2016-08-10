<?php

/**
*author:贺央央
**/



class TeaAct{
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
		$sql='delete from '.$name.' where tea_id = '.$id;
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
	
		//$sql='select * from teacher';
		$sql =$sql.' limit '.$page.','.$rows;
	
		$arr=$db->Select($sql);
		$db->Close();
		
		return $arr;
	}
	
	/**
	*获得教师个数
	**/
	public function getCount($sql){
		
		$db=new DB(); 
		//$sql='select count(id) as "count" from teacher';
		
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
	*教师信息json形式
	**/
	public function toJson($teaArr,$count){
		if(count($teaArr)===0){
			$teaJSON='{"total":0,"rows":[]}';	
		}else{
			for($i=0;$i<count($teaArr);$i++){	
				$teaArr2[$i]=array('id'=>$teaArr[$i]['id'],'name'=>$teaArr[$i]['name'],'sex'=>$teaArr[$i]['sex'],'age'=>$teaArr[$i]['age'],'birth'=>$teaArr[$i]['birth'],'tel'=>$teaArr[$i]['tel'],'email'=>$teaArr[$i]['email'],'degree'=>$teaArr[$i]['degree'],'work'=>$teaArr[$i]['work'],'office'=>$teaArr[$i]['office'],'research'=>$teaArr[$i]['research']);		
			}
			
			$teaJSON='{"total":'.$count.',"rows":'.json_encode($teaArr2).'}';
	
		}
	
		return $teaJSON;
	}
	
	public function toJson2($tea){
		$tea='{id:'.$tea['id'].',name:"'.$tea['name'].'",sex:"'.$tea['sex'].'",age:'.$tea['age'].',birth:"'.$tea['birth'].'",tel:"'.$tea['tel'].'",email:"'.$tea['email'].'",degree:"'.$tea['degree'].'",work:"'.$tea['work'].'",office:"'.$tea['office'].'",research:"'.$tea['research'].'"}';
		return $tea;	
	}
	
	/**
	*教育经历json形式
	**/
	public function toJson_edu($arr,$cou){
		if(count($arr)===0){
			$json='{"total":0,"rows":[]}';	
		}else{
			for($i=0;$i<count($arr);$i++){	
				$arr2[$i]=array('id'=>$arr[$i]['id'],'stage'=>$arr[$i]['stage'],'school'=>$arr[$i]['school'],'starttime'=>$arr[$i]['starttime'],'endtime'=>$arr[$i]['endtime'],'tea_id'=>$arr[$i]['tea_id']);		
			}			
			$json='{"total":'.$cou.',"rows":'.json_encode($arr2).'}';	
		}	
		return $json;
	}
	
	public function toJson2_edu($obj){
		$json='{id:'.$obj['id'].',stage:"'.$obj['stage'].'",school:"'.$obj['school'].'",starttime:"'.$obj['starttime'].'",endtime:"'.$obj['endtime'].'",tea_id:'.$obj['tea_id'].'}';
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
				$arr2[$i]=array('id'=>$arr[$i]['id'],'overview'=>$arr[$i]['overview'],'descrip'=>$arr[$i]['descrip'],'attname'=>$arr[$i]['attname'],'savepath'=>$arr[$i]['savepath'],'tea_id'=>$arr[$i]['tea_id']);		
			}			
			$json='{"total":'.$cou.',"rows":'.json_encode($arr2).'}';	
		}	
		return $json;
	}
	
	public function toJson2_hor($obj){
		$json='{id:'.$obj['id'].',overview:"'.$obj['overview'].'",descrip:"'.$obj['descrip'].'",tea_id:'.$obj['tea_id'].'}';
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
				$arr2[$i]=array('id'=>$arr[$i]['id'],'name'=>$arr[$i]['name'],'address'=>$arr[$i]['address'],'time'=>$arr[$i]['time'],'result'=>$arr[$i]['result'],'tea_id'=>$arr[$i]['tea_id']);		
			}			
			$json='{"total":'.$cou.',"rows":'.json_encode($arr2).'}';	
		}	
		return $json;
	}
	
	public function toJson2_com($obj){
		$json='{id:'.$obj['id'].',name:"'.$obj['name'].'",address:"'.$obj['address'].'",time:"'.$obj['time'].'",result:"'.$obj['result'].'",tea_id:'.$obj['tea_id'].'}';
		return $json;	
	}
}

?>