<?php
/**
author:Gao Xue
date:2014-05-06
*/

class CONTENTCAT{
	
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
	功能：加载表结构
	*/
	function catGrid($isDel,$page,$rows,$upid){		
	
		$page=($page-1)*$rows;
		$upid = isset($upid) ? intval($upid) : 0;
		//$sql='select * from contentcat where upper_id = '.$upid;
		//$sqlCount='select count(id) as "count" from contentcat where upper_id = '.$upid;
		$sql='select * from contentcat where isDel='.$isDel;
		$sqlCount='select count(id) as "count" from contentcat where isDel='.$isDel;
		
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
		if($upid==0){
			if($_SESSION['admin_name']!='super'){
				$res=$this->getDeptByAdmin_id();
				$temp=explode(' ',trim(str_replace('.', ' ',$res['category'])));
				if($temp[0]==0){
					$sql.=" and  CONCAT(upper_cat,id,'.') like '.%' ";
					$sql_count.=" and  CONCAT(upper_cat,id,'.') like '.%' ";
				}else{
					$sql.=" and  CONCAT(upper_cat,id,'.') like '".$res['category']."%' ";
					$sql_count.=" and  CONCAT(upper_cat,id,'.') like '".$res['category']."%' ";
				}
			}
				
		}else{
				$sql.=' and upper_id = '.$upid;
				$sqlCount.=' and upper_id = '.$upid;
			}
		
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
					$upperName_sql="select cat_name from contentcat where id=".$arr[$i]['upper_id'];
					$res=$db->Select($upperName_sql);
					$upperName=$res[0]['cat_name'];
				}
				$arr2[$i]=array('id'=>$arr[$i]['id'],
								'cat_name'=>$arr[$i]['cat_name'],
								'upperName'=>$upperName,
								'upper_cat'=>$arr[$i]['upper_cat'],
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
		if($_SESSION['admin_name']!='super'){
			$res=$this->getDeptByAdmin_id();
			$temp=explode(' ',trim(str_replace('.', ' ',$res['category'])));
			if($temp[0]!=0){
				$catInfo['upper_id']=$res['id'];
				$catInfo['upper_cat']=$res['upper_cat'].$res['id'].'.';
			}
		}
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
		$nd='[{id:'.$maxid[0]['id'].',text:"'.$catInfo['cat_name'].'",upper_cat:"'.$catInfo['upper_cat'].'",catname_all:"'.$catInfo['catname_all'].'"}]';
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
		$json='{id:'.$cat['id'].',cat_name:"'.$cat['cat_name'].'",exclusive_name:"'.$cat['exclusive_name'].'",upper_cat:"'.$cat['upper_cat'].'",catname_all:"'.$cat['catname_all'].'",upper_id:'.$cat['upper_id'].',is_forbidden:'.$cat['is_forbidden'].',is_recommend:'.$cat['is_recommend'].',is_leaf:'.$cat['is_leaf'].'}';
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
			$sql_edt1='update contentcat set cat_name="'.$catInfo['cat_name'].'",catname_all="'.$catInfo['catname_all'].'",is_forbidden='.$catInfo['is_forbidden'].',is_recommend='.$catInfo['is_recommend'].',exclusive_name="'.$catInfo['exclusive_name'].'" where id='.$id;
			$db->Update($sql_edt1);
		}else{
			//$sql_par='select upper_cat from contentcat where id='.$catInfo['upper_id'];
			//$par=$db->Select($sql_par);
			//$catInfo['upper_cat']=$catInfo[0]['upper_cat'].$catInfo['upper_id'].'.';
			$sql_edt1='update contentcat set cat_name="'.$catInfo['cat_name'].'" ,upper_cat="'.$catInfo['upper_cat'].'" ,catname_all="'.$catInfo['catname_all'].'" ,upper_id='.$catInfo['upper_id'].' ,is_forbidden='.$catInfo['is_forbidden'].' ,is_recommend='.$catInfo['is_recommend'].',exclusive_name="'.$catInfo['exclusive_name'].'" where id='.$id;
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
	功能：逻辑删除分类
	*/
	function delCat($id){
		$db=new DB();	
		$sql='select upper_cat,upper_id,is_leaf from contentcat where id='.$id;
		$result=$db->Select($sql);
		$upid=$result[0]['upper_id'];
		$upcat=$result[0]['upper_cat'].$id.'.';
		$is_leaf=$result[0]['is_leaf'];
 
 		$updSql1="update document set isInvalid=2 where category like '%$id%'";//更改该分类下的制发文件
		$updSql2="update apply set isInvalid=2 where category like '%$id%'";//更改该分类下的印章申请
		
		if($is_leaf==1){	
			$contentcatArr['isDel']=1;
			$db->UpdateData('contentcat',$id,$contentcatArr);
		}else{
			$contentcatArr['isDel']=1;
			$sql_del="update contentcat set isDel=1 where upper_cat like '.$upcat.%'";
			$db->Update($sql_del);
			$db->UpdateData('contentcat',$id,$contentcatArr);
		}
		$db->Update($updSql1);
		$db->Update($updSql2);
		$this->setleaf($db,$upid);
		
		$adminSql='select id,upperCat from admincat where userPrivileges like "%concats_'.$result[0]['upper_cat'].$id.'%"';
		$adminRes=$db->Select($adminSql);
		$admincat_id=$adminRes[0]['id'];
		$db->Close();
		if(!empty($admincat_id)){
			$userCat = new USERCAT();
			//$userCat->delEle($admincat_id);//删除该分类下的角色权限
		}
	}
	
	/**
	功能：逻辑批量删除分类
	*/
	function delArrCat($idlist){
		$idarray=explode(',',$idlist);
		$db=new DB();
		for($i=0;$i<count($idarray);$i++){
			$sql='select upper_cat,upper_id,is_leaf from contentcat where id='.$idarray[$i];
			$result=$db->Select($sql);
			$upid=$result[0]['upper_id'];
			$upcat=$result[0]['upper_cat'].$idarray[$i].'.';
			$is_leaf=$result[0]['is_leaf'];
			
			$delSql='delete from admincat where userPrivileges like "%concats_'.$result[0]['upper_cat'].$idarray[$i].'%"';//删除该分类下的角色权限分类
			$adminSql='select id,upperCat from admincat where userPrivileges like "%concats_'.$result[0]['upper_cat'].$idarray[$i].'%"';
			$adminRes=$db->Select($adminSql);
			$adminDel='delete from admininfo where category like "%.'.$adminRes[0]['upper_cat'].$adminRes[0]['id'].'.%"';//删除该分类下的角色
			$updSql1="update document set isInvalid=2 where category like '%$upcat%'";//更改该分类下的制发文件
			$updSql2="update apply set isInvalid=2 where category like '%$upcat%'";//更改该分类下的印章申请

			if($is_leaf==1){	
				$contentcatArr['isDel']=1;
				$db->UpdateData('contentcat',$idarray[$i],$contentcatArr);
			}else{
				$contentcatArr['isDel']=1;
				$sql_del="update contentcat set isDel=1 where upper_cat like '.$upcat.%'";
				$db->Update($sql_del);
				$db->UpdateData('contentcat',$idarray[$i],$contentcatArr);
			}
			$db->Update($updSql1);
			$db->Update($updSql2);
			//$db->Delete($delSql);
			//$db->Delete($adminDel);
			$this->setleaf($db,$upid);

		}
		$db->Close();
		echo $idlist;
	}
	//恢复删除的数据
	function uptisDel($id){
		$db=new DB();	
		$sql='select upper_cat,upper_id,is_leaf from contentcat where id='.$id;
			
		$r=$db->Select($sql);
		$upid=$r[0]['upper_id'];
		$upcat=$r[0]['upper_cat'].$id.'.';
		$l=$r[0]['is_leaf'];
 		$updSql1="update document set isInvalid=0 where category like '%$id%'";//更改该分类下的制发文件
		$updSql2="update apply set isInvalid=0 where category like '%$id%'";//更改该分类下的印章申请
		if($l==1){
			$contentcatArr['isDel']=0;
			$db->UpdateData('contentcat',$id,$contentcatArr);
		}else{
			$contentcatArr['isDel']=1;
			$sql_del="update contentcat set isDel=0 where upper_cat like '.$upcat.%'";
			$db->Update($sql_del);
			$db->UpdateData('contentcat',$id,$contentcatArr);
		}
		$db->Update($updSql1);
		$db->Update($updSql2);
		$this->setleaf($db,$upid);
	
		$db->Close();	
	}	
	
	//批量恢复删除的数据
	function uptisDelList($idlist){
		//global $idlist;全局参数改为传参形式
		$idarray=explode(',',$idlist);
		$db=new DB();
		for($i=0;$i<count($idarray);$i++){
			$sql='select upper_cat,upper_id,is_leaf from contentcat where id='.$idarray[$i];
			$r=$db->Select($sql);
			$upid=$r[0]['upper_id'];
			$upcat=$r[0]['upper_cat'].$idarray[$i].'.';
			$l=$r[0]['is_leaf'];
			$updSql1="update document set isInvalid=0 where category like '%$upcat%'";//更改该分类下的制发文件
			$updSql2="update apply set isInvalid=0 where category like '%$upcat%'";//更改该分类下的印章申请
			if($l==1){	
				$contentcatArr['isDel']=0;
				$db->UpdateData('contentcat',$idarray[$i],$contentcatArr);
			}else{
				$contentcatArr['isDel']=1;
				$sql_del="update contentcat set isDel=0 where upper_cat like '.$upcat.%'";
				$db->Update($sql_del);
				$db->UpdateData('contentcat',$idarray[$i],$contentcatArr);
			}
			$db->Update($updSql1);
			$db->Update($updSql2);
			$this->setleaf($db,$upid);
		}
		$db->Close();
		echo $idlist;
	}
	
	/**
	功能：删除分类
	*/
	function delCat1($id){
		$db=new DB();	
		$sql='select upper_cat,upper_id,is_leaf from contentcat where id='.$id;
		$result=$db->Select($sql);
		$upid=$result[0]['upper_id'];
		$upcat=$result[0]['upper_cat'].$id.'.';
		$is_leaf=$result[0]['is_leaf'];
 
 		$updSql1="update document set isInvalid=2 where category like '%$id%'";//更改该分类下的制发文件
		$updSql2="update apply set isInvalid=2 where category like '%$id%'";//更改该分类下的印章申请
		
		if($is_leaf==1){	
			$db->DelData($id,'contentcat');
		}else{
			$sql_del='delete from contentcat where upper_cat like "'.$upcat.'%"';
			$db->Delete($sql_del);
			$db->DelData($id,'contentcat');	
		}
		$db->Update($updSql1);
		$db->Update($updSql2);
		$this->setleaf($db,$upid);
		
		$adminSql='select id,upperCat from admincat where userPrivileges like "%concats_'.$result[0]['upper_cat'].$id.'%"';
		$adminRes=$db->Select($adminSql);
		$admincat_id=$adminRes[0]['id'];
		$db->Close();
		if(!empty($admincat_id)){
			$userCat = new USERCAT();
			$userCat->delEle($admincat_id);//删除该分类下的角色权限
		}
	}
	
	/**
	功能：批量删除分类
	*/
	function delArrCat1($idlist){
		$idarray=explode(',',$idlist);
		$db=new DB();
		for($i=0;$i<count($idarray);$i++){
			$sql='select upper_cat,upper_id,is_leaf from contentcat where id='.$idarray[$i];
			$result=$db->Select($sql);
			$upid=$result[0]['upper_id'];
			$upcat=$result[0]['upper_cat'].$idarray[$i].'.';
			$is_leaf=$result[0]['is_leaf'];
			
			$delSql='delete from admincat where userPrivileges like "%concats_'.$result[0]['upper_cat'].$idarray[$i].'%"';//删除该分类下的角色权限分类
			$adminSql='select id,upperCat from admincat where userPrivileges like "%concats_'.$result[0]['upper_cat'].$idarray[$i].'%"';
			$adminRes=$db->Select($adminSql);
			$adminDel='delete from admininfo where category like "%.'.$adminRes[0]['upper_cat'].$adminRes[0]['id'].'.%"';//删除该分类下的角色
			$updSql1="update document set isInvalid=2 where category like '%$upcat%'";//更改该分类下的制发文件
			$updSql2="update apply set isInvalid=2 where category like '%$upcat%'";//更改该分类下的印章申请

			if($is_leaf==1){	
				$db->DelData($idarray[$i],'contentcat');
			}else{
				$sql_del='delete from contentcat where upper_cat like "'.$upcat.'%"';
				$db->Delete($sql_del);
				$db->DelData($idarray[$i],'contentcat');	
			}
			$db->Update($updSql1);
			$db->Update($updSql2);
			$db->Delete($delSql);
			$db->Delete($adminDel);
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
			$sql_edit='update contentcat set is_forbidden='.$flag.' where id='.$idarray[$i];
			$result=$db->Update($sql_edit);	
			if($result==1){
				$sqlOne='select * from contentcat where id='.$idarray[$i];
				$res=$db->Select($sqlOne);
				if($res[0]['isLast']==0){
					$sql_editLike='update contentcat set is_forbidden='.$flag.' where upper_cat like "%'.$res[0]['upper_cat'].$res[0]['id'].'.'.'%"';
					$db->Update($sql_editLike);
				}
				$sql_editInfo='update contentinfo set is_forbidden='.$flag.' where category like "%'.$res[0]['upper_cat'].$res[0]['id'].'.'.'%"';
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
	//查询登录人所在部门
	public function getDeptByAdmin_id(){
		$db=new DB();
		$sql="SELECT b.userPrivileges FROM admininfo a, admincat b WHERE a.category=CONCAT(b.upperCat,b.id,'.') AND a.id=".$_SESSION['admin_id'];
		$arr=$db->Select($sql);
		$concat1=explode(',',$arr[0]['userPrivileges']);
		$dept=explode('_',$concat1[1]);
		$sql1="SELECT id, upper_id, upper_cat, cat_name FROM contentcat WHERE a.category=CONCAT(upper_cat,id) = ".$dept[1]."limit 0, 1 ";
		$res=$db->Select($sql1);
		$result=array(
			'id'=>$res[0]['id'],
			'upper_id'=>$res[0]['upper_id'],
			'upper_cat'=>$res[0]['upper_cat'],
			'deptName'=>$res[0]['cat_name'],
			'category'=>$dept[1].'.'
		);
		$db->Close();
		return $result;
	}
	/**
	功能：(部门列表中)加载树结构
	*/
	function treeData_dept($up_id){//,$con_cat
		$res=$this->getDeptByAdmin_id();
		$db=new DB();
		$up_id= isset($up_id)?intval($up_id):0;//判断变量是否存在
		
		//判断是否为leader
		$isLeader=$db->Select("SELECT b.exclusive_name FROM admininfo a, admincat b WHERE a.category=CONCAT(b.upperCat,b.id,'.') AND a.id=".$_SESSION['admin_id']);
		if($isLeader[0][0]=='leader'){
			$result=$db->Select("select managerMoreBm from admininfo where id=".$_SESSION['admin_id']);
			$deptId=trim(str_replace('.', ' ',$result[0][0]));
			$sql="select * from contentcat where isDel=0 and upper_id =$up_id and id in ($deptId)";
		}
		else{
			$temp=explode(' ',trim(str_replace('.', ' ',$res['category'])));
			if($_SESSION['admin_name']=='super' || $temp[0]==0){
				$sql='select * from contentcat where isDel=0 and upper_id = '.$up_id;
			}else{
				if($up_id!=0){
					$sql="select * from contentcat where isDel=0 and upper_id =$up_id and id in (".implode(',',$temp).")";
				}else{
					$sql='select * from contentcat where isDel=0 and id='.$temp[0];
				}
			}
		}
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
		$db->Close();
	}

}
?>