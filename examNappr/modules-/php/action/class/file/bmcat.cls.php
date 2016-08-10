<?php
/**
author:Gao Xue
date:2014-05-06
*/

class BmCat{
	
	/**
	功能：加载树结构
	*/
	function treeData($up_id){//,$con_cat

		$up_id= isset($up_id)?intval($up_id):0;//判断变量是否存在
		//$con_cat=$con_cat==''?$up_id:$con_cat;
		//$sql="select * from contentcat where  id =  $con_cat OR upper_id LIKE '%$con_cat%' ";
		$sql='select * from contentcat where isDel=0 and upper_id ='.$up_id;
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
	* 查询用章部门或科室
	*@param $up_id 上级节点id
	*/
	function getAllCat($up_id){
		$up_id= isset($up_id)?$up_id:0;//判断变量是否存在
		if($up_id!=0){
			$upid=explode('.',$up_id);
			$up_id=intval($upid[count($upid)-1]);
		}
		$sql="select * from contentcat where upper_id =".$up_id;
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