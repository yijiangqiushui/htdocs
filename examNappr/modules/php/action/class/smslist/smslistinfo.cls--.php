<?php
/**
author:Gao Xue
date:2014-05-07
Modified by Zhao Xiaogang 2015/03/02 
Modified by Gao Xue 2015/04/08 
*/
class SMSLISTINFO{
	/**
	功能：加载树结构
	*/
	function treeData($up_id){
		$up_id= isset($up_id)?intval($up_id):0;//判断变量是否存在
		//$con_cat=$con_cat==''?$up_id:$con_cat;
		//$sql="select * from smslistcat where  id =  $con_cat OR upper_id LIKE '%$con_cat%' ";
		$sql='select * from smslistcat where upper_id ='.$up_id.' and user_id = '.$_SESSION['admin_id'];
		//echo $sql.'---';return;
		$db=new DB();
		$arr=$db->Select($sql);
		if($up_id!==0||$con_cat!==0){
			for($i=0;$i<count($arr);$i++){
				$node[$i]['id']=$arr[$i]['id'];
				//$node[$i]['text']=$arr[$i]['cat_name'].'-'.$arr[$i]['user_id'];
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
				//$node[$i+1]['text']=$arr[$i]['cat_name'].'-'.$arr[$i]['user_id'];
				$node[$i+1]['text']=$arr[$i]['cat_name'];
				$node[$i+1]['state']=$arr[$i]['is_leaf']?'open':'closed';//为closed时节点所有子节点都从远处服务器加载
				$node[$i+1]['upper_cat']=$arr[$i]['upper_cat'];
				$node[$i+1]['is_leaf']=$arr[$i]['is_leaf'];
			}				
		}	
		echo json_encode($node);
	}
	
	function otherTreeData($up_id,$otherID,$listID){
		$up_id= isset($up_id)?intval($up_id):0;//判断变量是否存在
		$db=new DB();
		$sql1="select * from smslistcat where id in ($listID)";
		$upper_arr=$db->Select($sql1);
		$str='';
		for($i=0;$i<count($upper_arr);$i++){
			$upper_catStr=str_replace(".", ",", $upper_arr[$i]['upper_cat']);
			$newstr = substr($upper_catStr,1,mb_strlen($upper_catStr,'utf-8')-2);
			if($newstr!=''){
				$str.=" or id in($newstr)";
			}
		}
		//$sql='select * from smslistcat where upper_id ='.$up_id.' and user_id = '.$otherID.' and id in ('.$listID.')'.$str;
		$listIDArr=explode(",",$listID);
		if($listIDArr[0]==0){
			$sql='select * from smslistcat where user_id = '.$otherID.' and id in ('.$listID.')';
		}else{
			$sql='select * from smslistcat where upper_id ='.$up_id.' and user_id = '.$otherID.' and id in ('.$listID.')';
		}
		$arr=$db->Select($sql);
		if($up_id!==0||$con_cat!==0){
			$k=0;
			for($i=0;$i<count($arr);$i++){
				if($listIDArr[0]!=0){
					for($j=0;$j<count($listIDArr);$j++){
						//echo $listIDArr[$j].'******';
						if($listIDArr[$j]==$arr[$i]['id']){
							$node[$k]['id']=$arr[$i]['id'];
							//$node[$i]['text']=$arr[$i]['cat_name'].'-'.$arr[$i]['user_id'];
							$node[$k]['text']=$arr[$i]['cat_name'];
							$node[$k]['state']=$arr[$i]['is_leaf']?'open':'closed';//为closed时节点所有子节点都从远处服务器加载
							$node[$k]['upper_cat']=$arr[$i]['upper_cat'];
							$node[$k]['is_leaf']=$arr[$i]['is_leaf'];
							$k=$k+1;
						}
					}
				}else{
					$node[$i]['id']=$arr[$i]['id'];
					//$node[$i]['text']=$arr[$i]['cat_name'].'-'.$arr[$i]['user_id'];
					$node[$i]['text']=$arr[$i]['cat_name'];
					$node[$i]['state']=$arr[$i]['is_leaf']?'open':'closed';//为closed时节点所有子节点都从远处服务器加载
					$node[$i]['upper_cat']=$arr[$i]['upper_cat'];
					$node[$i]['is_leaf']=$arr[$i]['is_leaf'];
				}
			}
		}else{
			$node[0]['id']=0;
			$node[0]['text']='全部';
			$node[0]['state']='open';
			$node[0]['upper_cat']='.';
			
			for($i=0;$i<count($arr);$i++){
				if($listIDArr[0]!=0){
					$k=0;
					for($j=0;$j<count($listIDArr);$j++){
						if($listIDArr[$j]==$arr[$i]['id']){
							$node[$k+1]['id']=$arr[$i]['id'];
							//$node[$i+1]['text']=$arr[$i]['cat_name'].'-'.$arr[$i]['user_id'];
							$node[$k+1]['text']=$arr[$i]['cat_name'];
							$node[$k+1]['state']=$arr[$i]['is_leaf']?'open':'closed';//为closed时节点所有子节点都从远处服务器加载
							$node[$k+1]['upper_cat']=$arr[$i]['upper_cat'];
							$node[$k+1]['is_leaf']=$arr[$i]['is_leaf'];
							$k++;
						}
					}
				}else{
					$node[$i+1]['id']=$arr[$i]['id'];
					//$node[$i+1]['text']=$arr[$i]['cat_name'].'-'.$arr[$i]['user_id'];
					$node[$i+1]['text']=$arr[$i]['cat_name'];
					$node[$i+1]['state']=$arr[$i]['is_leaf']?'open':'closed';//为closed时节点所有子节点都从远处服务器加载
					$node[$i+1]['upper_cat']=$arr[$i]['upper_cat'];
					$node[$i+1]['is_leaf']=$arr[$i]['is_leaf'];
				}
			}				
		}
		echo json_encode($node);
	}
	
	
	/**
	功能：加载表结构
	*/
	function infoGrid($upper_cat,$page,$rows,$name,$tel,$company,$add_time,$upid,$admin_id,$listID){
		$page=($page-1)*$rows;
		//echo $upper_cat.'-----';return;
		//$upper_cat = isset($upper_cat) ? $upper_cat : '.';
		if(isset($upper_cat)){
			$sql='select * from smslistinfo where category like "'.$upper_cat.'%"';
			$sqlCount='select count(id) as "count" from smslistinfo where category like "'.$upper_cat.'%"';
			$upid_sql="select user_id from smslistcat where id=$upid";
		}else{
			$sql='select * from smslistinfo where 1=1';
			$sqlCount='select count(id) as "count" from smslistinfo where 1=1';
		}
		$db=new DB();
		$adminIdArr=$db->Select($upid_sql);
		if($adminIdArr[0]['user_id']==''){
			if($admin_id==''){
				$adminID=$_SESSION['admin_id'];
			}else{
				$adminID=$admin_id;
			}
		}else{
			$adminID=$adminIdArr[0]['user_id'];
		}
		//if($_SESSION['admin_name']!='super'){
			//$sql.=' and admin_id = '.$_SESSION['admin_id'];
			//$sqlCount.=' and admin_id = '.$_SESSION['admin_id'];
		//}
			$sql.=' and admin_id = '.$adminID;
			$sqlCount.=' and admin_id = '.$adminID;
		if($name!==null&&$name!==''){
			$str='"%'.$name.'%"';
			$sql=$sql.' and name like '.$str;
			$sqlCount=$sqlCount.' and name like '.$str;
		}
		if($tel!==null&&$tel!==''){
			$str='"%'.$tel.'%"';
			$sql=$sql.' and tel like '.$str;
			$sqlCount=$sqlCount.' and tel like '.$str;
		}
		if($company!==null&&$company!==''){
			$str='"%'.$company.'%"';
			$sql=$sql.' and company like '.$str;
			$sqlCount=$sqlCount.' and company like '.$str;
		}
		if($add_time!==null&&$add_time!==''){
			$str='"%'.$add_time.'%"';
			$sql=$sql.' and add_time like '.$str;
			$sqlCount=$sqlCount.' and add_time like '.$str;
		}
		
		$sql=$sql.' order by id desc limit '.$page.','.$rows;
		if($listID==''){
			$arr=$db->Select($sql);
			$arr_cou=$db->Select($sqlCount);
			$count=$arr_cou[0]['count'];
			
			if(count($arr)===0){
				$json='{"total":0,"rows":[]}';	
			}else{
				for($i=0;$i<count($arr);$i++){
					$arr2[$i]=array(
					'id'=>$arr[$i]['id'],
					'category'=>$arr[$i]['category'],
					'name'=>$arr[$i]['name'],
					'tel'=>$arr[$i]['tel'],
					'company'=>$arr[$i]['company'],
					'job'=>$arr[$i]['job'],
					'add_time'=>$arr[$i]['add_time'],
					'admin_id'=>$arr[$i]['admin_id'],
					);		
				}
				$json='{"total":'.$count.',"rows":'.json_encode($arr2).'}';
			}
		}else{
			$arr2=array();
			$listIDArr=explode(",",$listID);
			$k=0;
			for($i=0;$i<count($listIDArr);$i++){
				$sql1="select * from smslistinfo where category like '%".$listIDArr[$i].".'";
				$arr=$db->Select($sql1);
				for($j=0;$j<count($arr);$j++){
					$arr2[$k]=array(
					'id'=>$arr[$j]['id'],
					'category'=>$arr[$j]['category'],
					'name'=>$arr[$j]['name'],
					'tel'=>$arr[$j]['tel'],
					'company'=>$arr[$j]['company'],
					'job'=>$arr[$j]['job'],
					'add_time'=>$arr[$j]['add_time'],
					'admin_id'=>$arr[$j]['admin_id'],
					);
					$k++;
				}
			}
			$count=$k;
			
			if($count===0){
				$json='{"total":0,"rows":[]}';	
			}else{
				$json='{"total":'.$count.',"rows":'.json_encode($arr2).'}';
			}
		}
		echo $json;	
		$db->Close();
	}
	
	/**
	功能：添加内容
	*/
	function saveInfo($conInfo){
		$db=new DB();
		$result=$db->InsertData('smslistinfo',$conInfo);
		echo $result;
		$db->Close();
	}
	/**
	功能：获取需要编辑信息
	*/
	function getAttach($id){
		
		$db=new DB();
		$smslistInfo=$db->GetInfo($id,'smslistinfo');
		if($smslistInfo['category']!=null&&$smslistInfo['category']!=''){
			if($smslistInfo['category']=='.'){
				$catId=0;
			}else{
				$arr=explode('.',$smslistInfo['category']);
				$num=count($arr)-2;
				$catId=$arr[$num];
				$sqlcat="select cat_name from smslistcat where id=$arr[$num]";
				$dept=$db->Select($sqlcat);
				$jsonArray=array('catId'=>$num,);
			}
		}
		$jsonArray=array('id'=>$smslistInfo['id'],
						'upper_text'=>$dept[0][0],
						'category'=>$smslistInfo['category'],
						'name'=>$smslistInfo['name'],
						'tel'=>$smslistInfo['tel'],
						'company'=>$smslistInfo['company'],
						'job'=>$smslistInfo['job'],
						'catId'=>$catId,
					);
		$json=json_encode($jsonArray);
		echo $json;
		$db->Close();
	}
	
	
	function updInfo($id,$conInfo){
		$db=new DB();
		$db->UpdateData('smslistinfo',$id,$conInfo);
		$db->Close();
	}
	
	/**
	功能：删除内容
	*/
	function delInfo($id){
		$db=new DB();
		$sql="delete from smslistinfo where id = $id and admin_id = ".$_SESSION['admin_id'];
		$db->Delete($sql);
		//$db->DelData($id,'smslistinfo');
		$db->close();
	}
	
	/**
	功能：批量删除内容
	*/
	function delArrInfo($arrId){
		$db=new DB();
		$idStr=implode(',',$arrId);
		$sql="DELETE FROM smslistinfo WHERE id IN ($idStr) and admin_id = ".$_SESSION['admin_id'];
		//$result=$db->DelArrIdData($idStr,'smslistinfo');
		$db->Delete($sql);
		$db->close();
	}
	/**
	功能：设置允许导出自己通讯录的人
	*/	
	function setOthers($ids,$list){
		$db=new DB();
		$idsArr=explode(',',$ids);
		$idsStr=$_SESSION['admin_id'].':'.$list.'-';
		$rst=true;
		for($i=0;$i<count($idsArr);$i++){
			$otherIdStr='';
			//$idsStr=$idsArr[$i].':'.$list.'-';
			$sql1="select ids from admininfo where id=".$idsArr[$i];
			$result=$db->Select($sql1);
			$otheridsArr=explode('-',$result[0]['ids']);
			$flag=true;
			for($j=0;$j<count($otheridsArr);$j++){
				$otherIdArr=explode(':',$otheridsArr[$j]);
				if($otherIdArr[0]==$_SESSION['admin_id']){
					if($list!=''){
						$otherIdStr.=$idsStr;
					}else{
						$otherIdStr.='';
					}
					$flag=false;
				}else{
					$otherIdStr.=$otheridsArr[$j].'-';
				}
			}
			if($flag){
				$otherIdStr=$result[0]['ids'];
				if($list!=''){
					$otherIdStr.=$idsStr;
				}
			}
			$sql="update admininfo set ids = '$otherIdStr' where id=".$idsArr[$i];
			$res=$db->Update($sql);
			$rst=$rst&&$res;
		}
		//$sql="update smslistinfo set ids = ',$ids,' where admin_id =".$_SESSION['admin_id'];
		//$res=$db->Update($sql);
		echo $rst;
		$db->Close();
	}
	/**
	把别人的通讯录导入到自己的通讯录中
	*/
	function importList($ids){
		$admin_id=$_SESSION['admin_id'];
		$sql="SELECT a.cat_name, b.name, b.tel, b.company, b.job FROM smslistcat a, smslistinfo b WHERE b.category = CONCAT(a.upper_cat,a.id,'.') AND a.user_id IN ($ids) GROUP BY cat_name,name,tel";
		$db=new DB();
		$arr=$db->Select($sql);
		$dept=array();
		$dept1=array();
		for($i=0;$i<count($arr);$i++){
			$cat_name=$arr[$i][0];
			$name = $arr[$i][1];
			$tel = $arr[$i][2];
			$company=$arr[$i][3];
			$job=$arr[$i][4];
			$dept[$i]=$cat_name;
			$dept1[$i]="'".$cat_name."'";
			$data_values .= "('.".$cat_name.".','$name','$tel','$company','$job','$admin_id'),"; 
		}
		$sql_cat="select * from smslistcat where user_id=$admin_id";
		$db=new DB();
		$cat=$db->Select($sql_cat);
		$cat2=array();$k=0;
		for($i=0;$i<count($cat);$i++){
			for($j=count($dept)-1;$j>=0;$j--){
				if($cat[$i]['cat_name']==$dept[$j]){
					array_splice($dept,$j,1);
				}
			}
		}
		$str='';
		for($i=0;$i<count($dept);$i++){
			$str.=" ('".$dept[$i]."','0','.','".$admin_id."'), " ;
		}
		if(count($dept)>0){
			$sql_insert_cat="insert into smslistcat (cat_name,upper_id,upper_cat,user_id) values ".substr($str,0,-2);
			$query = mysql_query($sql_insert_cat);
			$sql_del_cat="DELETE a FROM smslistcat a LEFT JOIN( SELECT id FROM smslistcat GROUP BY cat_name,upper_cat,upper_id,user_id )b ON a.id=b.id WHERE b.id IS NULL";
			$res0=$db->Delete($sql_del_cat);
		}
		$sql_query_cat="select *, concat(upper_cat,id,'.') as category from smslistcat where cat_name in (".implode(',',$dept1)." ) and user_id=$admin_id";
		$query_cat=$db->Select($sql_query_cat);
		for($i=0;$i<count($query_cat);$i++){
			$data_values=str_replace(".".$query_cat[$i]['cat_name'].".",$query_cat[$i]['category'],$data_values);
		}
		$data_values = substr($data_values,0,-1); //去掉最后一个逗号
		fclose($handle); //关闭指针
		
		$query = mysql_query("insert into smslistinfo (category,name,tel,company,job,admin_id) values $data_values");//批量插入数据表中
		$sql_del="DELETE FROM smslistinfo WHERE id IN (SELECT c.id FROM (SELECT b.id FROM smslistinfo b GROUP BY b.name, b.category  HAVING COUNT(*)>1) c)";
		$res1=$db->Delete($sql_del);
		$db->Close(); 
		if($query){ 
			echo '导入成功！'; 
		}else{ 
			echo '导入失败！'; 
		} 	
	}
	/**
	功能：获取当前用户ID
	*/
	function getCurrentID(){
		echo $_SESSION['admin_id'];	
	}
	
	/**
	*加载树结构
	**/
	function getMyList($up_id,$table_name){
		$up_id= isset($up_id)?$up_id:0;//判断变量是否存在
		if($up_id!=0){
			$upid=explode('.',$up_id);
			$up_id=intval($upid[count($upid)-1]);
		}
		//$sql="SELECT *,CONCAT(upper_cat,id,'.')AS category FROM ".$table_name." where upper_id = ".$up_id." ORDER BY category ASC";
		if($table_name=='contentcat'){
			$sql="SELECT *,CONCAT(upper_cat,id,'.')AS category FROM ".$table_name." where upper_id = ".$up_id." ORDER BY category ASC";
		}else{
			$sql="SELECT *,CONCAT(upper_cat,id,'.')AS category FROM ".$table_name." where upper_id = ".$up_id." and user_id=".$_SESSION['admin_id']." ORDER BY category ASC";
		}
		$db=new DB();
		$arr=$db->Select($sql);
		if($up_id!==0){
			for($i=0;$i<count($arr);$i++){
			
				//$node[$i]['id']=$arr[$i]['upperCat'].$arr[$i]['id'];
				$node[$i]['id']=$arr[$i]['id'];
				$node[$i]['category']=$arr[$i]['category'];
				$node[$i]['text']=$arr[$i]['cat_name'];
				$node[$i]['state']=$arr[$i]['is_leaf']?'open':'closed';//为closed时节点所有子节点都从远处服务器加载
				$node[$i]['upper_cat']=$arr[$i]['upper_cat'];
				$node[$i]['is_leaf']=$arr[$i]['is_leaf'];
			}
		}else{
				$node[0]['id']=0;
				$node[0]['upper_cat']='';
				$node[0]['category']='.';
				$node[0]['text']='全部';
				$node[0]['state']='open';
				
				for($i=0;$i<count($arr);$i++){
			
				//$node[$i+1]['id']=$arr[$i]['upperCat'].$arr[$i]['id'];
				$node[$i+1]['id']=$arr[$i]['id'];
				$node[$i+1]['category']=$arr[$i]['category'];
				$node[$i+1]['text']=$arr[$i]['cat_name'];
				$node[$i+1]['state']=$arr[$i]['is_leaf']?'open':'closed';//为closed时节点所有子节点都从远处服务器加载
				$node[$i+1]['upper_cat']=$arr[$i]['upper_cat'];
				$node[$i+1]['is_leaf']=$arr[$i]['is_leaf'];
			}				
		}	
		//print_r($node);return;
		echo json_encode($node);
			
	}
	
	/*
		获取授权给他人可导出的分组
	*/
	function getOtherIds($otherId){
		$db=new DB();
		$sql="select ids from admininfo where id=$otherId";
		$result=$db->Select($sql);
		$otheridsArr=explode('-',$result[0]['ids']);
		for($i=0;$i<count($otheridsArr);$i++){
			$otherIdArr=explode(':',$otheridsArr[$i]);
			if($otherIdArr[0]==$_SESSION['admin_id']){
				$res=explode(',',$otherIdArr[1]);
				break;
			}else{
				$res='';
			}
		}
		echo json_encode($res);
		$db->Close();
	}

}
?>