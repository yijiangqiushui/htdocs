<?php
/**
author:Gao Xue
date:2014-05-06
*/

class CONTENTCAT{
	
	/**
	功能：加载树结构
	*/
	function treeData(){
		global $up_id;
		$up_id= isset($up_id)?intval($up_id):0;//判断变量是否存在
		
		$sql='select * from contentcat where upper_id ='.$up_id;
		$db=new DB();
		$arr=$db->Select($sql);
		if($up_id!==0){
			for($i=0;$i<count($arr);$i++){
				$node[$i]['id']=$arr[$i]['id'];
				$node[$i]['text']=$arr[$i]['cat_name'];
				$node[$i]['state']=$arr[$i]['is_leaf']?'open':'closed';//为closed时节点所有子节点都从远处服务器加载
				$node[$i]['upper_cat']=$arr[$i]['upper_cat'];
				$node[$i]['is_leaf']=$arr[$i]['is_leaf'];
			}
		}else{
			$node[0]['id']=0;
			$node[0]['text']='全部';
			$node[0]['state']='open';
			$node[0]['upper_cat']='.';
			
			for($i=0;$i<count($arr);$i++){
				$node[$i+1]['id']=$arr[$i]['id'];
				$node[$i+1]['text']=$arr[$i]['cat_name'];
				$node[$i+1]['state']=$arr[$i]['is_leaf']?'open':'closed';//为closed时节点所有子节点都从远处服务器加载
				$node[$i+1]['upper_cat']=$arr[$i]['upper_cat'];
				$node[$i+1]['is_leaf']=$arr[$i]['is_leaf'];
			}				
		}	
		echo json_encode($node);
	}
	
	/**
	功能：加载表结构
	*/
	function catGrid(){
		global $upid;
		global $page;
		global $rows;
		
		$page=($page-1)*$rows;
		$upid = isset($upid) ? intval($upid) : 0;
	
		$sql='select * from contentcat where upper_id = '.$upid;
		$sqlCount='select count(id) as "count" from contentcat where upper_id = '.$upid;	
		
		/*if($role['catName']!==null&&$role['catName']!==''){
			$str='"%'.$role['catName'].'%"';
			$sql=$sql.' and catName like '.$str;
			
			$sql_cou=$sql_cou.' and catName like '.$str;
			
		}
		if($role['isForbidden']!==null&&$role['isForbidden']!==''){
			$i=intval($role['isForbidden']);
			$sql=$sql.' and isForbidden = '.$i;
			$sql_cou=$sql_cou.' and isForbidden ='.$i;
		}*/
		
		$sql=$sql.' limit '.$page.','.$rows;
		$db=new DB();
		$arr=$db->Select($sql);
		$arr_cou=$db->Select($sqlCount);
		$count=$arr_cou[0]['count'];
		
		if(count($arr)===0){
			$json='{"total":0,"rows":[]}';	
		}else{
			for($i=0;$i<count($arr);$i++){
				$arr2[$i]=array('id'=>$arr[$i]['id'],'cat_name'=>$arr[$i]['cat_name'],'upper_cat'=>$arr[$i]['upper_cat'],'exclusive_name'=>$arr[$i]['exclusive_name'],'upper_id'=>$arr[$i]['upper_id'],'is_forbidden'=>$arr[$i]['is_forbidden'],'is_leaf'=>$arr[$i]['is_leaf']);		
			}
			$json='{"total":'.$count.',"rows":'.json_encode($arr2).'}';
		}
		echo $json;	
		$db->Close();	
	}
	
	/**
	功能：添加分类
	*/
	function saveCat(){
		global $catInfo;
		$db=new DB();
		
		$sql='select is_leaf from contentcat where id='.$catInfo['upper_id'];
		
		$res=$db->Select($sql);
		if($res[0]['is_leaf']==1){
			$sql_edit='update contentcat set is_leaf=0 where id='.$catInfo['upper_id'];
			$db->Update($sql_edit);	
		}
		
		$db->InsertData('contentcat',$catInfo);
		
		$sql_id='select max(id) as id from contentcat';
		$maxid=$db->Select($sql_id);
		$nd='[{id:'.$maxid[0]['id'].',text:"'.$catInfo['cat_name'].'",upper_cat:"'.$catInfo['upper_cat'].'"}]';
		echo $nd;
		$db->Close();
	}
	
	function setleaf($db,$id){
		if($id!=0){
			$sql='select count(id) as "count" from contentcat where upper_id = '.$id;
			$res=$db->Select($sql);
			if($res[0]['count']==0){
				$is_leaf=1;	
			}else{
				$is_leaf=0;	
			}
			$sql2='update contentcat set is_leaf='.$is_leaf.' where id='.$id;
			$db->Update($sql2);
		}
	}
	
	function findCat($id){
		$db=new DB();
		$cat=$db->GetInfo($id,'contentcat');
		
		$json='{id:'.$cat['id'].',cat_name:"'.$cat['cat_name'].'",exclusive_name:"'.$cat['exclusive_name'].'",upper_cat:"'.$cat['upper_cat'].'",upper_id:'.$cat['upper_id'].',is_forbidden:'.$cat['is_forbidden'].',is_recommend:'.$cat['is_recommend'].',is_leaf:'.$cat['is_leaf'].'}';
		echo $json;
		$db->Close();	
	}
	
	/**
	功能:编辑分类
	*/
	function saveEdtEle($id,$catInfo){
	
		$db=new DB();
		$sql='select * from contentcat where id='.$id;
		$result=$db->Select($sql);
		if($result[0]['upper_id']==$catInfo['upper_id']){
			$sql_edt1='update contentcat set cat_name="'.$catInfo['cat_name'].'",is_forbidden='.$catInfo['is_forbidden'].',is_recommend='.$catInfo['is_recommend'].',exclusive_name="'.$catInfo['exclusive_name'].'" where id='.$id;
			//echo $sql_edt1.'-------------------';
			$db->Update($sql_edt1);
		}else{
			//$sql_par='select upper_cat from contentcat where id='.$catInfo['upper_id'];
			//$par=$db->Select($sql_par);
			//$catInfo['upper_cat']=$catInfo[0]['upper_cat'].$catInfo['upper_id'].'.';
			$sql_edt1='update contentcat set cat_name="'.$catInfo['cat_name'].'" ,upper_cat="'.$catInfo['upper_cat'].'" ,upper_id='.$catInfo['upper_id'].' ,is_forbidden='.$catInfo['is_forbidden'].' ,is_recommend='.$catInfo['is_recommend'].',exclusive_name="'.$catInfo['exclusive_name'].'" where id='.$id;
			//echo $sql_edt1.'+++++++++++++++++++++';
			$db->Update($sql_edt1);//编辑节点
			if($result['is_leaf']==0){
				$oldcat=$result[0]['upper_cat'].$id.'.';
				$newcat=$catInfo['upper_cat'].$id.'.';
				
				$sql_leaf='select id,upper_cat from contentcat where upper_cat like "'.$oldcat.'%"';
				$leaf=$db->Select($sql_leaf);
				for($i=0;$i<count($leaf);$i++){
					$c=str_replace($oldcat,$newcat,$leaf[$i]['upper_cat']);
					$sql_edtleaf='update contentcat set upper_cat ="'.$c.'" where id='.$leaf[$i]['id'];
					$db->Update($sql_edtleaf);	
				}	
			}
		//编辑完成后修改原父节点和新父节点的isLast属性		
			$this->setleaf($db,$result[0]['upper_id']);	
			$this->setleaf($db,$catInfo['upper_id']);		
		}	
		$db->Close();
		echo $catInfo['upper_id'];
	}
	
	/**
	功能：删除分类
	*/
	function delCat($id){
		$db=new DB();	
		$sql='select upper_cat,upper_id,is_leaf from contentcat where id='.$id;
			
		$result=$db->Select($sql);
		
		$upid=$result[0]['upper_id'];
		$upcat=$result[0]['upper_cat'].$id.'.';
		$is_leaf=$result[0]['is_leaf'];
		
		if($is_leaf==1){	
			$db->DelData($id,'contentcat');
		}else{
			$sql_del='delete from contentcat where upper_cat like "'.$upcat.'%"';
			$db->Delete($sql_del);
			$db->DelData($id,'contentcat');	
		}
		$this->setleaf($db,$upid);
	
		$db->Close();
	}
	
	/**
	功能：批量删除分类
	*/
	function delArrCat(){
		global $idlist;
		$idarray=explode(',',$idlist);
		$db=new DB();
	
		for($i=0;$i<count($idarray);$i++){
			$sql='select upper_cat,upper_id,is_leaf from contentcat where id='.$idarray[$i];
			$result=$db->Select($sql);
		
			$upid=$result[0]['upper_id'];
			$upcat=$result[0]['upper_cat'].$idarray[$i].'.';
			$is_leaf=$result[0]['is_leaf'];
			if($is_leaf==1){	
				$db->DelData($idarray[$i],'contentcat');
			}else{
				$sql_del='delete from contentcat where upper_cat like "'.$upcat.'%"';
				$db->Delete($sql_del);
				$db->DelData($idarray[$i],'contentcat');	
			}
			$this->setleaf($db,$upid);
		}
		$db->Close();
		echo $idlist;
	}
}
?>