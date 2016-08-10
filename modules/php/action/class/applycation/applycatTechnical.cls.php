<?php
/**
author:Gao Xue 
date:2014-05-24
*/

class APPLYCAT{
	
	/**
	*/
	function treeData($flag,$upper_id){
		if($flag=='scienceCat'){
			$arr=explode(",",str_replace("\n",'',SCIENCE));
			if(count($arr)>0){
				$node[0]['id']=0;
				$node[0]['text']='全部';
				$node[0]['state']='open';
				//$node[0]['upper_cat']='.';
				
				for($i=0;$i<count($arr);$i++){
					$node[$i+1]['id']=''.($i+1).'';
					$node[$i+1]['text']=$arr[$i];
					$a=substr_count($node[$i+1]['text'],'----');
					if($a=1){
						$node[$i+1]['state']='close';
						$node[$i+1]['upper_cat']='.';
						$node[$i+1]['is_leaf']='0';
					}else{
						$node[$i+1]['state']='open';
						$node[$i+1]['upper_cat']='"."'.$node[$i+1]['id'].'';
						$node[$i+1]['is_leaf']='1';
					}
					//$node[$i+1]['upper_cat']='.';
					//$node[$i+1]['is_leaf']='0';
				}
			}else{
				$node[0]['id']=0;
				$node[0]['text']='全部';
				$node[0]['state']='open';
				//$node[0]['upper_cat']='.';
				//$node[0]['is_leaf']=0;
			}
		}else if($flag=='economicCat'){
			$arr=explode(",",str_replace("\n",'',ECONOMIC));
			if(count($arr)>0){
				$node[0]['id']=0;
				$node[0]['text']='全部';
				$node[0]['state']='open';
				$node[0]['upper_cat']='.';
				
				for($i=0;$i<count($arr);$i++){
					$node[$i+1]['id']=$i+1;
					$node[$i+1]['text']=$arr[$i];
					$node[$i+1]['state']='open';
					$node[$i+1]['upper_cat']='.';
				}
			}else{
				$node[0]['id']=0;
				$node[0]['text']='全部';
				$node[0]['state']='open';
				$node[0]['upper_cat']='.';
			}
		}else{
			$upper_id=isset($upper_id)?intval($upper_id):0;
		
			$sql='select * from applycatTechnical where upper_id='.$upper_id;
			$db=new DB();
			$result=$db->Select($sql);
			
			if($upper_id!==0){
				for($i=0;$i<count($result);$i++){
					$node[$i]['id']=$result[$i]['id'];
					$node[$i]['text']=$result[$i]['cat_name'];
					$node[$i]['state']=$result[$i]['is_leaf']?'open':'closed';
					$node[$i]['upper_cat']=$result[$i]['upper_cat'];
					$node[$i]['is_leaf']=$result[$i]['is_leaf'];
				}
			}else{
				$node[0]['id']=0;
				$node[0]['text']='全部';
				$node[0]['state']='open';
				
				for($i=0;$i<count($result);$i++){
					$node[$i+1]['id']=$result[$i]['id'];
					$node[$i+1]['text']=$result[$i]['cat_name'];
					$node[$i+1]['state']=$result[$i]['is_leaf']?'open':'closed';
					$node[$i+1]['upper_cat']=$result[$i]['upper_cat'];
					$node[$i+1]['is_leaf']=$result[$i]['is_leaf'];
				}			
			}
		}
		echo json_encode($node);
	}
	
	function loadExpertTree($upper_id){
		$upper_id=isset($upper_id)?intval($upper_id):0;
	
		$sql='select * from applycatTechnical where upper_id='.$upper_id;
		$db=new DB();
		$result=$db->Select($sql);
		
		if($upper_id!==0){
			for($i=0;$i<count($result);$i++){
				$node[$i]['id']=$result[$i]['id'];
				$node[$i]['text']=$result[$i]['cat_name'];
				$node[$i]['state']=$result[$i]['is_leaf']?'open':'closed';
				$node[$i]['upper_cat']=$result[$i]['upper_cat'];
				$node[$i]['is_leaf']=$result[$i]['is_leaf'];
			}
		}else{
			$node[0]['id']=0;
			$node[0]['text']='全部';
			$node[0]['state']='open';
			
			for($i=0;$i<count($result);$i++){
				$node[$i+1]['id']=$result[$i]['id'];
				$node[$i+1]['text']=$result[$i]['cat_name'];
				$node[$i+1]['state']=$result[$i]['is_leaf']?'open':'closed';
				$node[$i+1]['upper_cat']=$result[$i]['upper_cat'];
				$node[$i+1]['is_leaf']=$result[$i]['is_leaf'];
			}			
		}
		echo json_encode($node);
	}
	
	/**
	*/
	function gridData(){
		global $page;
		global $rows;
		global $upperid;
		
		$page=($page-1)*$rows;
		$upperid = isset($upperid) ? intval($upperid) : 0;
		
		$sql='select * from applycatTechnical where upper_id = '.$upperid;
		$sqlCount='select count(id) as "count" from applycatTechnical where upper_id = '.$upperid;
		
		$sql=$sql.' limit '.$page.','.$rows;
		$db=new DB();	
		$result=$db->Select($sql);
		$resCount=$db->Select($sqlCount);
		$count=$resCount[0]['count'];
		
		if(count($result)===0){
			$catJSON='{"total":0,"rows":[]}';	
		}else{
			for($i=0;$i<count($result);$i++){
				$arr[$i]=array('id'=>$result[$i]['id'],'cat_name'=>$result[$i]['cat_name'],'upper_cat'=>$result[$i]['upper_cat'],'upper_id'=>$result[$i]['upper_id'],'is_forbidden'=>$result[$i]['is_forbidden']?'禁用':'可用','is_leaf'=>$result[$i]['is_leaf']?'是':'否');
			}
			$catJSON='{"total":'.$count.',"rows":'.json_encode($arr).'}';
		}
		echo $catJSON;
		$db->Close();
	}
	
	/**
	*/
	function saveCat($cat){
		$db=new DB();
		$sql='select is_leaf from applycatTechnical where id='.$cat['upper_id'];
		$result=$db->Select($sql);
		
		if($result[0]['is_leaf']==1){
			$sql_edit='update applycatTechnical set is_leaf=0 where id='.$cat['upper_id'];
			$db->Update($sql_edit);	
		}
		
		$db->InsertData('applycatTechnical',$cat);
		
		$sql_id='select max(id) as id from applycatTechnical';
		$maxid=$db->Select($sql_id);
		
		$nd='[{id:'.$maxid[0]['id'].',text:"'.$cat['cat_name'].'",upper_cat:"'.$cat['upper_cat'].'"}]';
		echo $nd;
		$db->Close();
	}
	
	/**
	*/
	function findCat($id){
		$db=new DB();
		$cat=$db->GetInfo($id,'applycatTechnical');
		
		$catJSON='{id:'.$cat['id'].',cat_name:"'.$cat['cat_name'].'",upper_cat:"'.$cat['upper_cat'].'",upper_id:'.$cat['upper_id'].',is_forbidden:'.$cat['is_forbidden'].',is_leaf:'.$cat['is_leaf'].'}';

		echo $catJSON;
		$db->Close();
	}
	
	/**
	*/
	function saveEdtCat($edtid,$cat){
		$db=new DB();
		$sql='select * from applycatTechnical where id='.$edtid;
		$res=$db->Select($sql);
		
		if($res[0]['upper_id']==$cat['upper_id']){
			$sql_edt1='update applycatTechnical set cat_name="'.$cat['cat_name'].'" where id='.$edtid;
			$db->Update($sql_edt1);
		}else{
			if($cat['upper_id']==0){
				$cat['upper_cat']='.';
			}else{
				$sql_par='select upper_cat from applycatTechnical where id='.$cat['upper_id'];
				$par=$db->Select($sql_par);
				$cat['upper_cat']=$par[0]['upper_cat'].$cat['upper_id'].'.';
			}
			$sql_edt1='update applycatTechnical set cat_name="'.$cat['cat_name'].'",upper_cat="'.$cat['upper_cat'].'",upper_id='.$cat['upper_id'].' where id='.$edtid;
			$db->Update($sql_edt1);
			
			if($res['is_leaf']==0){
				$oldcat=$res[0]['upper_cat'].$edtid.'.';
				$newcat=$cat['upper_cat'].$edtid.'.';
				
				$sql_leaf='select id,upper_cat from applycatTechnical where upper_cat like "'.$oldcat.'%"';
				$leaf=$db->Select($sql_leaf);
				for($i=0;$i<count($leaf);$i++){
					$c=str_replace($oldcat,$newcat,$leaf[$i]['upper_cat']);
					$sql_edtleaf='update applycatTechnical set upper_cat ="'.$c.'" where id='.$leaf[$i]['id'];
					$db->Update($sql_edtleaf);	
				}	
			}
			$this->setleaf($db,$res[0]['upper_id']);	
			$this->setleaf($db,$cat['upper_id']);
		}
		$db->Close();

		$state=$res[0]['is_leaf']?'open':'closed';
	
		$jn='[{id:'.$edtid.',text:"'.$cat['cat_name'].'",state:"'.$state.'",upper_id:'.$cat['upper_id'].'}]';
		echo $jn;
	}
	
	/**
	*/
	function setleaf($db,$id){
		if($id!=0){
			$sql='select count(id) as "count" from applycatTechnical where upper_id = '.$id;
			$res=$db->Select($sql);
			if($res[0]['count']==0){
				$leaf=1;	
			}else{
				$leaf=0;	
			}
			$sql2='update applycatTechnical set is_leaf='.$leaf.' where id='.$id;
			$db->Update($sql2);
		}
	}
	
	/**
	*/
	function delCat($id){
		$db=new DB();	
		$sql='select upper_cat,upper_id,is_leaf from applycatTechnical where id='.$id;
		$result=$db->Select($sql);
		
		$upper_id=$result[0]['upper_id'];
		$upper_cat=$result[0]['upper_cat'].$id.'.';
		$leaf=$result[0]['is_leaf'];
		if($leaf==1){	
			$db->DelData($id,'applycatTechnical');
		}else{
			$sql_del='delete from applycatTechnical where upper_cat like "'.$upper_cat.'%"';
			$db->Delete($sql_del);
			$db->DelData($id,'applycatTechnical');	
		}
		$this->setleaf($db,$upper_id);
		$db->Close();
	}
	
	/**
	*/
	function delCatlist($list){
		$db=new DB();
		$idarray=explode(',',$list);
		for($i=0;$i<count($idarray);$i++){
			$sql='select upper_id,upper_cat,is_leaf from applycatTechnical where id='.$idarray[$i];
			$result=$db->Select($sql);
		
			$upper_id=$result[0]['upper_id'];
			$upper_cat=$result[0]['upper_cat'].$idarray[$i].'.';
			$leaf=$result[0]['is_leaf'];
			if($leaf==1){	
				$db->DelData($idarray[$i],'applycatTechnical');
			}else{
				$sql_del='delete from applycatTechnical where upper_cat like "'.$upper_cat.'%"';
				$db->Delete($sql_del);
				$db->DelData($idarray[$i],'applycatTechnical');	
			}
			$this->setleaf($db,$upper_id);
		}
		$db->Close();
		echo $list;
	}
	
	/**
	*/
	function disableCat($list,$flag){
		$db=new DB();
		$idarray=explode(',',$list);
		for($i=0;$i<count($idarray);$i++){
			$sql='select upper_id,upper_cat from applycatTechnical where id='.$idarray[$i];
			$result=$db->Select($sql);
		
			$upper_id=$result[0]['upper_id'];
			$upper_cat=$result[0]['upper_cat'].$idarray[$i].'.';
			
			$sql_edit='update applycatTechnical set is_forbidden='.$flag.' where id='.$idarray[$i].' or upper_cat like "'.$upper_cat.'%"';
			$db->Update($sql_edit);	
		}
		$db->Close();
	}
	
}
?>