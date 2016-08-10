<?php

/**
*author:贺央央
**/

class StuAct{
	
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
	
		$stuArr=$db->Select($sql);
		
		$db->Close();
		return $stuArr;	
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
	
	
	//根据学生id查询全部
	function getAllByStuid($name,$column,$stuid){
		$sql="select * from ".$name." where ".$column." = ".$stuid;
		$db=new DB();
		$arr=$db->Select($sql);
		$db->Close();
		return $arr;
	}
	
	function delByStuid($name,$column,$stuid){
		$sql="delete from ".$name." where ".$column." = ".$stuid;
		$db=new DB();
		$db->Delete($sql);
		$db->Close();
	}
	
	/**
	*学生信息json转换
	**/
	public function toJson($stuArr,$count){
		if(count($stuArr)===0){
			$stuJSON='{"total":0,"rows":[]}';	
		}else{
			for($i=0;$i<count($stuArr);$i++){
				$stuArr2[$i]=array('id'=>$stuArr[$i]['id'],'number'=>$stuArr[$i]['number'],'name'=>$stuArr[$i]['name'],'sex'=>$stuArr[$i]['sex'],'age'=>$stuArr[$i]['age'],'birthday'=>$stuArr[$i]['birthday'],'tel'=>$stuArr[$i]['tel'],'email'=>$stuArr[$i]['email'],'qq'=>$stuArr[$i]['qq']);		
			}
			
			$stuJSON='{"total":'.$count.',"rows":'.json_encode($stuArr2).'}';
	
		}
	
		return $stuJSON;
	}
	
	public function toJson2($stu){
		$stu='{id:'.$stu['id'].',number:"'.$stu['number'].'",name:"'.$stu['name'].'",sex:"'.$stu['sex'].'",age:'.$stu['age'].',birthday:"'.$stu['birthday'].'",tel:"'.$stu['tel'].'",email:"'.$stu['email'].'",qq:"'.$stu['qq'].'"}';
		return $stu;	
	}
	
	/**
	*家长信息json转换
	**/
	public function toJson_par($arr,$count){
		if(count($arr)===0){
			$json='{"total":0,"rows":[]}';	
		}else{
			for($i=0;$i<count($arr);$i++){
				$arr2[$i]=array('id'=>$arr[$i]['id'],'app'=>$arr[$i]['app'],'name'=>$arr[$i]['name'],'address'=>$arr[$i]['address'],'rel'=>$arr[$i]['rel']);		
			}
			
			$json='{"total":'.$count.',"rows":'.json_encode($arr2).'}';
	
		}
	
		return $json;
	}
	
	public function toJson2_par($p){
		
		$par='{id:'.$p['id'].',app:"'.$p['app'].'",name:"'.$p['name'].'",address:"'.$p['address'].'",tel:"'.$p['tel'].'",stuid:'.$p['stuid'].'}';
		return $par;	
	}
	
	/**
	*教育经历json转换
	**/
	public function toJson_edu($arr,$count){
		if(count($arr)===0){
			$json='{"total":0,"rows":[]}';	
		}else{
			for($i=0;$i<count($arr);$i++){
				$arr2[$i]=array('id'=>$arr[$i]['id'],'school'=>$arr[$i]['school'],'begindate'=>$arr[$i]['begindate'],'enddate'=>$arr[$i]['enddate'],'stage'=>$arr[$i]['stage']);		
			}
			
			$json='{"total":'.$count.',"rows":'.json_encode($arr2).'}';
	
		}
	
		return $json;
	}
	
	public function toJson2_edu($p){
		
		$json='{id:'.$p['id'].',school:"'.$p['school'].'",stage:"'.$p['stage'].'",begindate:"'.$p['begindate'].'",enddate:"'.$p['enddate'].'",stu_id:'.$p['stu_id'].'}';
		return $json;	
	}
	
	/**
	*参加活动json转换
	**/
	public function toJson_act($arr,$count){
		if(count($arr)===0){
			$json='{"total":0,"rows":[]}';	
		}else{
			for($i=0;$i<count($arr);$i++){
				$arr2[$i]=array('id'=>$arr[$i]['id'],'name'=>$arr[$i]['name'],'address'=>$arr[$i]['address'],'time'=>$arr[$i]['time'],'content'=>$arr[$i]['content']);		
			}
			
			$json='{"total":'.$count.',"rows":'.json_encode($arr2).'}';
	
		}
	
		return $json;
	}
	
	public function toJson2_act($p){
		
		$json='{id:'.$p['id'].',name:"'.$p['name'].'",address:"'.$p['address'].'",time:"'.$p['time'].'",content:"'.$p['content'].'",stuid:'.$p['stuid'].'}';
		return $json;	
	}
	
	/**
	*学生作品json转换
	**/
	public function toJson_pro($arr,$count){
		if(count($arr)===0){
			$json='{"total":0,"rows":[]}';	
		}else{
			for($i=0;$i<count($arr);$i++){
				$tea=$this->findById('teacher',$arr[$i]['tea_id']);
				
				$arr2[$i]=array('id'=>$arr[$i]['id'],'title'=>$arr[$i]['title'],'descrip'=>$arr[$i]['descrip'],'filename'=>$arr[$i]['filename'],'autoname'=>$arr[$i]['autoname'],'teacher'=>$tea['name']);		
			}
			
			$json='{"total":'.$count.',"rows":'.json_encode($arr2).'}';
	
		}
	
		return $json;
	}
	
	public function toJson2_pro($p){
		
		$json='{id:'.$p['id'].',title:"'.$p['title'].'",descrip:"'.$p['descrip'].'",filename:"'.$p['filename'].'",autoname:"'.$p['autoname'].'",tea_id:'.$p['tea_id'].'}';
		return $json;	
	}
	
	public function getTea(){
		$sql='select id,name from teacher';
		$db=new DB();
		$arr=$db->Select($sql);
	
		for($i=0;$i<count($arr);$i++){
			$arr2[$i]=array('id'=>$arr[$i]['id'],'name'=>$arr[$i]['name']);
		}
		return $arr2;
	}
	
	/**
	*获得奖励json转换
	**/
	public function toJson_awd($arr,$count){
		if(count($arr)===0){
			$json='{"total":0,"rows":[]}';	
		}else{
			for($i=0;$i<count($arr);$i++){
				$arr2[$i]=array('id'=>$arr[$i]['id'],'act'=>$arr[$i]['act'],'rank'=>$arr[$i]['rank'],'time'=>$arr[$i]['time'],'descrip'=>$arr[$i]['descrip'],'attname'=>$arr[$i]['attname']);		
			}
			
			$json='{"total":'.$count.',"rows":'.json_encode($arr2).'}';
	
		}
	
		return $json;
	}
	
	public function toJson2_awd($p){
		
		$json='{id:'.$p['id'].',act:"'.$p['act'].'",rank:"'.$p['rank'].'",time:"'.$p['time'].'",descrip:"'.$p['descrip'].'",attname:"'.$p['attname'].'",autoname:"'.$p['autoname'].'",stu_id:'.$p['stu_id'].'}';
		return $json;	
	}
	
}

?>