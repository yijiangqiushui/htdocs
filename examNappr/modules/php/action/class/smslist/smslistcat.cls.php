<?php
/**
author:Gao Xue
date:2014-05-06
Modified by Gao Xue 2015/04/08
*/

class SMSLISTCAT{
	
	/**
	功能：加载树结构
	*/
	function treeData($up_id){
		$up_id= isset($up_id)?intval($up_id):0;//判断变量是否存在
		//$con_cat=$con_cat==''?$up_id:$con_cat;
		//$sql="select * from smslistcat where  id =  $con_cat OR upper_id LIKE '%$con_cat%' ";
		$sql='select * from smslistcat where upper_id ='.$up_id;
		
		$sql.=' and user_id = '.$_SESSION['admin_id'];
		if($_SESSION['admin_name']!='super'){
			//$sql.=' and user_id = '.$_SESSION['admin_id'];
		}
		//echo $sql.'---';return;
		$db=new DB();
		$arr=$db->Select($sql);
		//if($up_id!==0||$con_cat!==0){
		if($up_id!==0){
			for($i=0;$i<count($arr);$i++){
				$node[$i]['id']=$arr[$i]['id'];
				//$node[$i]['text']=$arr[$i]['cat_name'].'-'.$arr[$i]['user_id'];
				$node[$i]['text']=$arr[$i]['cat_name'];
				$node[$i]['state']=$arr[$i]['is_leaf']?'open':'closed';//为closed时节点所有子节点都从远处服务器加载
				$node[$i]['upper_cat']=$arr[$i]['upper_cat'];
				$node[$i]['is_leaf']=$arr[$i]['is_leaf'];
				$node[$i]['user_id']=$arr[$i]['user_id'];
				$node[$i]['admin_id']=$_SESSION['admin_id'];
			}
		}else{
			$node[0]['id']=0;
			$node[0]['text']='全部';
			$node[0]['state']='open';
			$node[0]['upper_cat']='.';
			
			for($i=0;$i<count($arr);$i++){
				$node[$i+1]['id']=$arr[$i]['id'];
				//$node[$i+1]['text']=$arr[$i]['cat_name'].'-'.$arr[$i]['user_id'];
				$node[$i+1]['text']=$arr[$i]['cat_name'];
				$node[$i+1]['state']=$arr[$i]['is_leaf']?'open':'closed';//为closed时节点所有子节点都从远处服务器加载
				$node[$i+1]['upper_cat']=$arr[$i]['upper_cat'];
				$node[$i+1]['is_leaf']=$arr[$i]['is_leaf'];
				$node[$i+1]['user_id']=$arr[$i]['user_id'];
				$node[$i+1]['admin_id']=$_SESSION['admin_id'];
			}				
		}	
		echo json_encode($node);
	}
	
	/**
	功能：加载表结构
	*/
	function catGrid($page,$rows,$upid){		
	
		$page=($page-1)*$rows;
		$upid = isset($upid) ? intval($upid) : 0;
		$sql='select * from smslistcat where upper_id = '.$upid;
		$sqlCount='select count(id) as "count" from smslistcat where upper_id = '.$upid;

		$sql.=' and user_id = '.$_SESSION['admin_id'];
		$sqlCount.=' and user_id = '.$_SESSION['admin_id'];
		if($_SESSION['admin_name']!='super'){
			//$sql.=' and user_id = '.$_SESSION['admin_id'];
			//$sqlCount.=' and user_id = '.$_SESSION['admin_id'];
		}
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
				if($arr[$i]['upper_id']==0){
					$upperName='全部';
				}else{
					$upperName_sql="select cat_name from smslistcat where id=".$arr[$i]['upper_id'];
					$res=$db->Select($upperName_sql);
					$upperName=$res[0]['cat_name'];
				}
				$arr2[$i]=array('id'=>$arr[$i]['id'],
								//'cat_name'=>$arr[$i]['cat_name'].'-'.$arr[$i]['user_id'],
								'cat_name'=>$arr[$i]['cat_name'],
								'upper_cat'=>$arr[$i]['upper_cat'],
								'upperName'=>$upperName,
								'user_id'=>$arr[$i]['user_id'],
								'exclusive_name'=>$arr[$i]['exclusive_name'],
								'upper_id'=>$arr[$i]['upper_id'],
								'catname_all'=>$arr[$i]['catname_all'],
								'is_forbidden'=>$arr[$i]['is_forbidden'],
								'is_leaf'=>$arr[$i]['is_leaf']
								);		
			}
			$json='{"total":'.$count.',"rows":'.json_encode($arr2).'}';
		}
		echo $json;	
		$db->Close();	
	}
	
	/**
	功能：添加分类
	*/	
	function saveCat($catInfo){
		$db=new DB();
		
		$sql='select is_leaf from smslistcat where id='.$catInfo['upper_id'];
		$res=$db->Select($sql);
		if($res[0]['is_leaf']==1){
			$sql_edit='update smslistcat set is_leaf=0 where id='.$catInfo['upper_id'];
			$db->Update($sql_edit);	
		}
		
		$db->InsertData('smslistcat',$catInfo);
		$sql_id='select max(id) as id from smslistcat';
		$maxid=$db->Select($sql_id);
		$nd='[{id:'.$maxid[0]['id'].',text:"'.$catInfo['cat_name'].'",upper_cat:"'.$catInfo['upper_cat'].'",catname_all:"'.$catInfo['catname_all'].'"}]';
		echo $nd;
		$db->Close();
	}
	
	function setleaf($db,$id){
		if($id!=0){
			$sql='select count(id) as "count" from smslistcat where upper_id = '.$id;
			$res=$db->Select($sql);
			if($res[0]['count']==0){
				$is_leaf=1;	
			}else{
				$is_leaf=0;	
			}
			$sql2='update smslistcat set is_leaf='.$is_leaf.' where id='.$id;
			$db->Update($sql2);
		}
	}
	
	function findCat($id){
		$db=new DB();
		$cat=$db->GetInfo($id,'smslistcat');
		$json='{id:'.$cat['id'].',cat_name:"'.$cat['cat_name'].'",exclusive_name:"'.$cat['exclusive_name'].'",upper_cat:"'.$cat['upper_cat'].'",catname_all:"'.$cat['catname_all'].'",upper_id:'.$cat['upper_id'].',is_forbidden:'.$cat['is_forbidden'].',is_leaf:'.$cat['is_leaf'].'}';
		echo $json;
		$db->Close();	
	}
	
	/**
	功能:编辑分类
	*/
	function saveEdtEle($id,$catInfo){
		$db=new DB();
		$sql='select * from smslistcat where id='.$id;
		$result=$db->Select($sql);
		if($catInfo['upper_id']==$result[0]['id']){
			echo 'error';
			return;
		}
		if($result[0]['upper_id']==$catInfo['upper_id']){
			//节点位置没改变
			$sql_edt1='update smslistcat set cat_name="'.$catInfo['cat_name'].'",catname_all="'.$catInfo['catname_all'].'",exclusive_name="'.$catInfo['exclusive_name'].'" where id='.$id;
			$db->Update($sql_edt1);
		}else{
			//节点位置改变
			if($catInfo['upper_id']==0){
				$catInfo['upper_cat']='.';	
			}else{
				$sql_par='select upper_cat from smslistcat where id='.$catInfo['upper_id'];
				$par=$db->Select($sql_par);
				$catInfo['upper_cat']=$par[0]['upper_cat'].$catInfo['upper_id'].'.';
			}
			$sql_edt1='update smslistcat set cat_name="'.$catInfo['cat_name'].'" ,upper_cat="'.$catInfo['upper_cat'].'" ,catname_all="'.$catInfo['catname_all'].'" ,upper_id='.$catInfo['upper_id'].' ,exclusive_name="'.$catInfo['exclusive_name'].'" where id='.$id;
			//echo $sql_edt1;return;
			$db->Update($sql_edt1);//编辑节点
			$edit_list="update smslistinfo set category='".$catInfo['upper_cat'].$id.".' where category ='".$result[0]['upper_cat'].$id.".'";
			$db->Update($edit_list);
			if($result['is_leaf']==0){
				$oldcat=$result[0]['upper_cat'].$id.'.';
				$newcat=$catInfo['upper_cat'].$id.'.';
				
				$sql_leaf='select id,upper_cat from smslistcat where upper_cat like "'.$oldcat.'%"';
				$leaf=$db->Select($sql_leaf);
				for($i=0;$i<count($leaf);$i++){
					$c=str_replace($oldcat,$newcat,$leaf[$i]['upper_cat']);
					$sql_edtleaf='update smslistcat set upper_cat ="'.$c.'" where id='.$leaf[$i]['id'];
					$db->Update($sql_edtleaf);	
					$edit_list1="update smslistinfo set category='".$c.$leaf[$i]['id'].".' where category ='".$oldcat.$leaf[$i]['id'].".'";
					$db->Update($edit_list1);
				}	
			}
		//编辑完成后修改原父节点和新父节点的isLast属性		
			$this->setleaf($db,$result[0]['upper_id']);	
			$this->setleaf($db,$catInfo['upper_id']);		
		}	
		$db->Close();
		$state=$result[0]['is_leaf']?'open':'closed';
		//echo $catInfo['upper_id'];
		$jn='[{id:'.$id.',text:"'.$catInfo['cat_name'].'",state:"'.$state.'",upper_id:'.$catInfo['upper_id'].'}]';
		//$ndArr=$db->Select($sql);
		//$nd='[{id:'.$id.',text:"'.$ndArr[0]['cat_name'].'",upper_cat:"'.$ndArr[0]['upper_cat'].'",catname_all:"'.$ndArr[0]['catname_all'].'"}]';
		//echo $nd;
		echo $jn;
	}
	
	/**
	功能：删除分类
	*/
	function delCat($id){
		$db=new DB();	
		$sql='select upper_cat,upper_id,is_leaf from smslistcat where id='.$id." and user_id = ".$_SESSION['admin_id'];
		$result=$db->Select($sql);
		$upid=$result[0]['upper_id'];
		$upcat=$result[0]['upper_cat'].$id.'.';
		$is_leaf=$result[0]['is_leaf'];
		if($is_leaf==1){	
			$db->DelData($id,'smslistcat');
		}else{
			$sql_del='delete from smslistcat where upper_cat like "'.$upcat.'%"';
			$db->Delete($sql_del);
			$db->DelData($id,'smslistcat');	
		}
		$sqlInfo='delete from smslistinfo where category like "'.$upcat.'%"';
		$db->Delete($sqlInfo);
		$this->setleaf($db,$upid);
	
		$db->Close();
	}
	
	/**
	功能：批量删除分类
	*/
	function delArrCat($idlist){
		$idarray=explode(',',$idlist);
		$db=new DB();
		for($i=0;$i<count($idarray);$i++){
			$sql='select upper_cat,upper_id,is_leaf from smslistcat where id='.$idarray[$i].' and user_id = '.$_SESSION['admin_id'];
			$result=$db->Select($sql);
			$upid=$result[0]['upper_id'];
			$upcat=$result[0]['upper_cat'].$idarray[$i].'.';
			$is_leaf=$result[0]['is_leaf'];
			if($is_leaf==1){	
				$db->DelData($idarray[$i],'smslistcat');
			}else{
				$sql_del='delete from smslistcat where upper_cat like "'.$upcat.'%"'.' and user_id = '.$_SESSION['admin_id'];
				$db->Delete($sql_del);
				$sql_dels="delete from smslistcat where id = ".$idarray[$i]." and user_id = ".$_SESSION['admin_id'];
				$db->Delete($sql_dels);
				//$db->DelData($idarray[$i],'smslistcat');	
			}
			$sqlInfo='delete from smslistinfo where category like "'.$upcat.'%"';
			$db->Delete($sqlInfo);
			$this->setleaf($db,$upid);
		}
		$db->Close();
		echo $idlist;
	}
	
	/**
	功能：禁用/启用
	*/
	function disableCat($idlist,$flag){
		$idarray=explode(',',$idlist);
		$db=new DB();
		for($i=0;$i<count($idarray);$i++){
			$sql_edit='update smslistcat set is_forbidden='.$flag.' where id='.$idarray[$i].' and user_id = '.$_SESSION['admin_id'];
			$result=$db->Update($sql_edit);	
			if($result==1){
				$sqlOne='select * from smslistcat where id='.$idarray[$i].' and user_id = '.$_SESSION['admin_id'];
				$res=$db->Select($sqlOne);
				if($res[0]['isLast']==0){
					$sql_editLike='update smslistcat set is_forbidden='.$flag.' where upper_cat like "%'.$res[0]['upper_cat'].$res[0]['id'].'.'.'%"'.' and user_id = '.$_SESSION['admin_id'];
					$db->Update($sql_editLike);
				}
				$sql_editInfo='update smslistinfo set is_forbidden='.$flag.' where category like "%'.$res[0]['upper_cat'].$res[0]['id'].'.'.'%"'.' and user_id = '.$_SESSION['admin_id'];
				$db->Update($sql_editInfo);
			}
		}
		$db->Close();	
	}
	
	/**
	* 查询用章部门或科室
	*@param $up_id 上级节点id
	*/
	function getAllCat($up_id){
		$up_id= isset($up_id)?$up_id:0;//判断变量是否存在
		if($up_id!=0){
			$upid=explode('.',$up_id);
			$up_id=intval($upid[count($upid)-1]);
		}
		$sql="select * from smslistcat where upper_id =".$up_id;
		$db=new DB();
		$arr=$db->Select($sql);
		if($up_id!==0){
			for($i=0;$i<count($arr);$i++){
				$node[$i]['id']=$arr[$i]['upper_cat'].$arr[$i]['id'];
				$node[$i]['text']=$arr[$i]['cat_name'];
				$node[$i]['state']=$arr[$i]['is_leaf']?'open':'closed';//为closed时节点所有子节点都从远处服务器加载
				$node[$i]['upper_cat']=$arr[$i]['upper_cat'];
				$node[$i]['is_leaf']=$arr[$i]['is_leaf'];
				$node[$i]['catname_all']=$arr[$i]['catname_all'];
			}
		}else{
			$node[0]['id']=0;
			$node[0]['text']='全部';
			$node[0]['state']='open';
			$node[0]['upper_cat']='.';
			
			for($i=0;$i<count($arr);$i++){
				$node[$i+1]['id']=$arr[$i]['upper_cat'].$arr[$i]['id'];
				$node[$i+1]['text']=$arr[$i]['cat_name'];
				$node[$i+1]['state']=$arr[$i]['is_leaf']?'open':'closed';//为closed时节点所有子节点都从远处服务器加载
				$node[$i+1]['upper_cat']=$arr[$i]['upper_cat'];
				$node[$i+1]['is_leaf']=$arr[$i]['is_leaf'];
				$node[$i+1]['catname_all']=$arr[$i]['catname_all'];
			}				
		}	
		echo json_encode($node);
	}
}
?>