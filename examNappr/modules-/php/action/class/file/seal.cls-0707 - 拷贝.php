<?php
class Apply{
	/**
	* 添加印章申请
	*/
	public function saveApply($applyInfo){
		$db=new DB();
		$sql="SELECT * FROM apply WHERE reason='".$applyInfo['reason']."' AND isInvalid=0 and file_no is null and user='".$_SESSION['realname']."'";
		$result=$db->Select($sql);
		if(count($result)>0){
			echo 'exist';
			return;
		}
		$res=$db->InsertData('apply',$applyInfo);
		$db->Close();
		echo $res;
		if($res){
			$log=new LOGINFO();
			$log->addLog('添加印章使用申请',$_SESSION['realname'],date('Y-m-d H:i:s',time()));
		}
	}
	/**
	* 修改印章申请
	*/
	public function editApply($applyInfo,$id){
		$db=new DB();
		$result=$db->Select("select reject as total from apply where id = $id limit 0, 1");
		if($result[0]['reject']===0){
			echo 0;	
		}else{
			$res=$db->UpdateData('apply',$id,$applyInfo);
			echo $res;
			$db->Close();
			if($res){
				$log=new LOGINFO();
				$log->addLog('修改印章使用申请',$_SESSION['realname'],date('Y-m-d H:i:s',time()));
			}
		}
	}
	/**
	* 按id查询印章申请
	*/
	public function getDetail($id){
		$db=new DB();
		$res=$db->GetInfo($id,'apply');
		$db->Close();
		echo json_encode($res);
	}
	/**
	* 获取印章申请表格数据
	*/
	public function getDateGrid($page,$rows,$upper_cat,$beginDate,$endDate,$reason,$file_no,$file_content){
		$page=($page-1)*$rows;
		$upper_cat = isset($upper_cat) ? $upper_cat : '.';
		$res=$this->getDeptByAdmin_id();
		
		$db=new DB();
		if($_SESSION['admin_name']!='super' && strstr($_SESSION['exclusive_name'],'sealer')==false){
			$isLeader=$db->Select("SELECT b.exclusive_name FROM admininfo a, admincat b WHERE a.category=CONCAT(b.upperCat,b.id,'.') AND a.id=".$_SESSION['admin_id']);
			if($upper_cat=='.'){
				if($isLeader[0][0]=='leader'){
					
					$sql="SELECT * FROM apply WHERE 1=0";
					$sql_count="SELECT count(*) as total_num FROM apply WHERE 1=0";
							
					$result=$db->Select("select managerMoreBm from admininfo where id=".$_SESSION['admin_id']);
					if($result[0][0]!=''){
						$arrId=explode(',',$result[0][0]);
						for($i=0;$i<count($arrId);$i++){
							$sql.=" or category like '$arrId[$i]%'";
							$sql_count.=" or category like '$arrId[$i]%'";
						}
					}else{
						$sql_upper_cat="select a.* from admininfo a,admincat b where a.category=CONCAT(b.upperCat,b.id,'.') AND a.id=".$_SESSION['admin_id'];
						$result_upper_cat=$db->Select($sql_upper_cat);
						//$sql="SELECT * FROM apply WHERE category like '".$upper_cat."%' ";
						//$sql_count="SELECT count(*) as total_num FROM apply WHERE category like '".$upper_cat."%' ";
						$sql="SELECT * FROM apply WHERE category like '".$result_upper_cat[0]['category']."%'";
						$sql_count="SELECT count(*) as total_num FROM apply WHERE category like '".$result_upper_cat[0]['category']."%'";
					}
				}
				else{
					$sql_upper_cat="select a.* from admininfo a,admincat b where a.category=CONCAT(b.upperCat,b.id,'.') AND a.id=".$_SESSION['admin_id'];
					$result_upper_cat=$db->Select($sql_upper_cat);
					if($result_upper_cat[0]['isManager']==0){//普通用户
						$sql="SELECT * FROM apply WHERE category like '".$result_upper_cat[0]['category']."%' and user='".$_SESSION['realname']."'";
						$sql_count="SELECT count(*) as total_num FROM apply WHERE category like '".$result_upper_cat[0]['category']."%' and user='".$_SESSION['realname']."'";
					}else{
						//$sql="SELECT * FROM apply WHERE category like '".$upper_cat."%' ";
						//$sql_count="SELECT count(*) as total_num FROM apply WHERE category like '".$upper_cat."%' ";
						$sql="SELECT * FROM apply WHERE category like '".$result_upper_cat[0]['category']."%'";
						$sql_count="SELECT count(*) as total_num FROM apply WHERE category like '".$result_upper_cat[0]['category']."%'";
					}
				}
			}
			else{
				$sql_upper_cat="select a.* from admininfo a,admincat b where a.category=CONCAT(b.upperCat,b.id,'.') AND a.id=".$_SESSION['admin_id'];
				$result_upper_cat=$db->Select($sql_upper_cat);
				if($result_upper_cat[0]['isManager']==0&&$isLeader[0][0]!='leader'){//普通用户
					$sql="SELECT * FROM apply WHERE category like '".$result_upper_cat[0]['category']."%' and user='".$_SESSION['realname']."'";
					$sql_count="SELECT count(*) as total_num FROM apply WHERE category like '".$result_upper_cat[0]['category']."%' and user='".$_SESSION['realname']."'";
				}else{
					$sql="SELECT * FROM apply WHERE category like '".$upper_cat."%' ";
					$sql_count="SELECT count(*) as total_num FROM apply WHERE category like '".$upper_cat."%' ";
				}
			}
		}else{
				$sql="SELECT * FROM apply WHERE category like '".$upper_cat."%' ";
				$sql_count="SELECT count(*) as total_num FROM apply WHERE category like '".$upper_cat."%' ";
		}
		
		if($beginDate!=null &&$beginDate!='' && $endDate!=null &&$endDate!=''){
			$sql=$sql." and use_time between '".$beginDate."' and '".$endDate."'";
			$sqlCount.=" and use_time between '".$beginDate."' and '".$endDate."'";
		}
		if($reason!=null&&$reason!=''){
			$sql.=" and reason like '%$reason%' ";
			$sql_count.=" and reason like '%$reason%' ";
		}
		if($file_no!=null&&$file_no!=''){
			$sql.=" and file_no like '%$file_no%' ";
			$sql_count.=" and file_no like '%$file_no%' ";
		}
		if($file_content!=null&&$file_content!=''){
			$sql.=" and content like '%$file_content%' ";
			$sql_count.=" and content like '%$file_content%' ";
		}
		
		$sql.=" and (isInvalid=0 or isInvalid=1) ORDER BY id desc LIMIT $page, $rows ";
		$sql_count.=" and (isInvalid=0 or isInvalid=1) ";
		$arr=$db->Select($sql);
		$arr_cou=$db->Select($sql_count);
		$count=$arr_cou[0]['total_num'];
		if(count($arr)===0){
			$json='{"total":0,"rows":[]}';	
		}else{
			for($i=0;$i<count($arr);$i++){
				$arr2[$i]=array('id'=>$arr[$i]['id'],
								'total'=>$arr[$i]['total'],
								'setStatus'=>$arr[$i]['setStatus'],
								'use_time'=>$arr[$i]['use_time'],
								'end_time'=>$arr[$i]['end_time'],
								'contentcat_id'=>$arr[$i]['contentcat_id'],
								'reason'=>mb_substr($arr[$i]['reason'],0,25,'utf-8'),
								'content'=>$arr[$i]['content'],
								'admin'=>$arr[$i]['admin'],
								'is_forbidden'=>$arr[$i]['is_forbidden'],
								'is_checked'=>$arr[$i]['is_checked'],
								'is_recommend'=>$arr[$i]['is_recommend'],
								'file_no'=>$arr[$i]['file_no'],
								'addtime'=>$arr[$i]['addtime'],
								'reject'=>$arr[$i]['reject'],
								'isInvalid'=>$arr[$i]['isInvalid'],
								//主要用于判断是否是印章管理员
								'catName'=>$_SESSION['catName'],
								'exclusive_name'=>$_SESSION['exclusive_name'],
								'author'=>$arr[$i]['user'],
								'dept'=>$arr[$i]['dept'],
								'isOwn'=>$arr[$i]['user']==$_SESSION['realname']?'1':'0'
								);		
			}
			$json='{"total":'.$count.',"rows":'.json_encode($arr2).'}';
		}
		echo $json;	
		$db->Close();	
	}
	/**
	* 删除印章申请信息
	*/
	public function delApply($id_arr){
		$sql="delete from apply where reject=1 and id in ($id_arr)";
		$db=new DB();
		$res=$db->Delete($sql);
		$db->Close();
		echo $res;
		if($res){
			$log=new LOGINFO();
			$log->addLog('删除印章申请信息',$_SESSION['realname'],date('Y-m-d H:i:s',time()));
		}
	}
	/**
	* 设置禁用，启用
	*/
	public function setForbidden($id_arr,$val){
		$sql="update apply set is_forbidden = $val where id in ($id_arr)";
		$db=new DB();
		$res=$db->Update($sql);
		$db->Close();
		echo $res;
		if($res){
			$log=new LOGINFO();
			$log->addLog('启用/禁用印章申请信息',$_SESSION['realname'],date('Y-m-d H:i:s',time()));
		}
	}
	/**
	功能：审核
	*/
	public function checkInfo($id){
		$db=new DB();
		$sql="update apply set is_checked =1 where id= $id";
		$result=$db->Update($sql);
		$db->close();
		if($result){
			$log=new LOGINFO();
			$log->addLog('审核印章申请信息',$_SESSION['realname'],date('Y-m-d H:i:s',time()));
		}
	}
	/**
	* 批量审核
	*/
	public function setCheck($id_arr){
		$sql="update apply set is_checked = 1 where id in ($id_arr)";
		$db=new DB();
		$res=$db->Update($sql);
		$db->Close();
		echo $res;
		if($res){
			$log=new LOGINFO();
			$log->addLog('审核印章申请信息',$_SESSION['realname'],date('Y-m-d H:i:s',time()));
		}
	}
	
	/**
	*返回用章状态
	*/
	public function getStatus($id){
		$sql="select setStatus from apply where id=$id";
		$db=new DB();
		$res=$db->Select($sql);
		echo $res[0]['setStatus'];
		$db->Close();
	}
	
	public function updStatus($id,$status){
		//if($_SESSION['catName']=='印章管理员'){
		if(strstr($_SESSION['exclusive_name'],'sealer')!=false){
			$sql="update apply set setStatus=$status where id=$id";
			$db=new DB();
			$res=$db->Update($sql);
			echo $res;
			$db->Close();
			if($res){//更新成功，记录日志
				$log=new LOGINFO();
				$log->addLog('设置印章状态',$_SESSION['realname'],date('Y-m-d H:i:s',time()));
			}
		}else{
			echo 0;
		}
	}
	//获取当天文件总数
	function fileTotal($addtime){
		
		$db=new DB();
		$sql="select count(*) as total from apply where addtime='$addtime'";
		$res=$db->Select($sql);
		echo $res[0]['total'];
		$db->Close();
	}
	//保存文件编号
	function addFileNo($id,$file_no,$addtime){
		$db=new DB();
		$sql="select file_no from apply where id=$id";
		$res=$db->Select($sql);
		if(!empty($res[0]['file_no'])){
			echo $res[0]['file_no'];//该文件编号已存在
		}
		else{
			$sql="update apply set file_no='$file_no',addtime='$addtime' where id=$id";
			$result=$db->Update($sql);
			$db->Close();	
			echo $result;
			if($result){
				$log=new LOGINFO();
				$log->addLog('生成印章使用申请文件编号',$_SESSION['realname'],date('Y-m-d H:i:s',time()));
			}
		}
	}
	//查询申请人所在部门    modify by Wang Le at 2015-06-01
	public function getDeptByAdmin_id(){
		$db=new DB();
		$sql="SELECT userPrivileges FROM admininfo WHERE id=".$_SESSION['admin_id'];
		$arr=$db->Select($sql);
		$concat1=explode(',',$arr[0]['userPrivileges']);
		$dept=explode('_',$concat1[1]);
		//$sql1="SELECT cat_name FROM contentcat WHERE isDel=0 and CONCAT(upper_cat,id) = '".$dept[1]."' limit 0, 1 ";
		$sql1="SELECT catName FROM admincat WHERE isDel=0 and CONCAT(upperCat,id) like '%".$dept[1]."' limit 0, 1 ";
		$res=$db->Select($sql1);
		$result=array(
			//'deptName'=>$res[0]['cat_name'],
			'deptName'=>$res[0]['catName'],
			'category'=>$dept[1].'.'
		);
		$db->Close();
		return $result;
	}
	//设置驳回状态
	public function setReject($id){
			$db=new DB();
			$sql="update apply set reject=1 where file_no IS NULL and id=$id";
			$result=$db->Update($sql);
			echo $result;
			$db->Close();
			$log=new LOGINFO();
			$log->addLog('驳回印章使用申请',$_SESSION['realname'],date('Y-m-d H:i:s',time()));
	}
	/**
	功能：加载树结构
	*/
	function treeData($up_id){
		$res=$this->getDeptByAdmin_id();
		$up_id= isset($up_id)?intval($up_id):0;//判断变量是否存在
		$db=new DB();
		
		//判断是否为leader
		$isLeader=$db->Select("SELECT b.exclusive_name FROM admininfo a, admincat b WHERE a.category=CONCAT(b.upperCat,b.id,'.') AND a.id=".$_SESSION['admin_id']);
		if($isLeader[0][0]=='leader'){
			$result=$db->Select("select managerMoreBm from admininfo where id=".$_SESSION['admin_id']);
			if($result[0][0]!=''){
				$managerMoreBmStr=explode(',',$result[0][0]);
				$str='';
				for($i=0;$i<count($managerMoreBmStr);$i++){
					$deptId=trim(str_replace('.', ' ',$managerMoreBmStr[$i]));
					//$deptId=trim(str_replace('.', ' ',$result[0][0]));
					$str.=$deptId;
					if($i!=count($managerMoreBmStr)-1){
						$str.=',';
					}
				}
				$rest=$db->Select("select a.id from admincat a,admininfo b where b.category=CONCAT(a.upperCat,a.id,'.') and b.id=".$_SESSION['admin_id']);
				$str.=','.$rest[0][0];
				$deptId=trim(str_replace(' ', ',',$str));
				//$sql="select * from contentcat where isDel=0 and upper_id =$up_id and id in ($deptId)";
				$sql="select * from admincat where isDel=0 and upperID =$up_id and id in ($deptId)";
			}else{
				if($up_id!=0){
						$sql="select * from admincat where isDel=0 and upperID =$up_id";
				}else{
					//$sql='select * from contentcat where isDel=0 and id='.$temp[0];
					$rest=$db->Select("select a.id from admincat a,admininfo b where b.category=CONCAT(a.upperCat,a.id,'.') and b.id=".$_SESSION['admin_id']);
					$sql='select * from admincat where isDel=0 and id='.$rest[0][0];
				}
			}
		}else{
			$temp=explode(' ',trim(str_replace('.', ' ',$res['category'])));
			$tmp=trim(str_replace('.', ' ',$res['category']));
			if($_SESSION['admin_name']=='super'||strstr($_SESSION['exclusive_name'],'sealer')!=false){
				//$sql='select * from contentcat where isDel=0 and upper_id = '.$up_id;
				$sql='select * from admincat where isDel=0 and upperID = '.$up_id;
			}else{
				$sqlm="select a.* from admininfo a,admincat b where a.category=CONCAT(b.upperCat,b.id,'.') AND a.id=".$_SESSION['admin_id'];
				$result_isManager=$db->Select($sqlm);
				if($result_isManager[0]['isManager']==0){//普通用户
					$sql='select * from admincat where isDel=0 and id='.$temp[count($temp)-1];
				}else{
					if($up_id!==0){
						$isin = in_array($up_id,$temp);
						if($isin){
							 $sql="select * from admincat where isDel=0 and upperID =$up_id";
						}else{
							$sql="select * from admincat where isDel=0 and upperID =$up_id and id in (".implode(',',$temp).")";
						}
							//$sql="select * from admincat where isDel=0 and upperID =$up_id and id in (".implode(',',$temp).")";
						//$sql="select * from admincat where isDel=0 and exclusive_name!='leader' and upperID =$up_id";// and id in (".implode(',',$temp).")";
					}else{
						$sql='select * from admincat where isDel=0 and id='.$temp[0];
						//$sql='select * from admincat where isDel=0 and exclusive_name!="leader" and upperID=0';// and id='.$temp[0];
					}
				}
			}
		}
		$arr=$db->Select($sql);
		if($up_id!==0){
			for($i=0;$i<count($arr);$i++){
				$node[$i]['id']=$arr[$i]['id'];
				//$node[$i]['text']=$arr[$i]['cat_name'];
				$node[$i]['text']=$arr[$i]['catName'];
				$node[$i]['state']=$arr[$i]['isLast']?'open':'closed';//为closed时节点所有子节点都从远处服务器加载
				//$node[$i]['upper_cat']=$arr[$i]['upper_cat'];
				$node[$i]['upper_cat']=$arr[$i]['upperCat'];
				//$node[$i]['is_leaf']=$arr[$i]['is_leaf'];
				$node[$i]['is_leaf']=$arr[$i]['isLast'];
			}
		}else{
			$node[0]['id']=0;
			$node[0]['text']='全部';
			$node[0]['state']='open';
			$node[0]['upper_cat']='.';
			
			for($i=0;$i<count($arr);$i++){
				$node[$i+1]['id']=$arr[$i]['id'];
				//$node[$i+1]['text']=$arr[$i]['cat_name'];
				$node[$i+1]['text']=$arr[$i]['catName'];
				//$node[$i+1]['upper_cat']=$arr[$i]['upper_cat'];
				$node[$i+1]['upper_cat']=$arr[$i]['upperCat'];
				if($_SESSION['admin_name']!='super'&&strstr($_SESSION['exclusive_name'],'sealer')!=true){
					$node[$i+1]['state']=$arr[$i]['isLast']?'open':'closed';//为closed时节点所有子节点都从远处服务器加载
					$node[$i+1]['is_leaf']=$arr[$i]['isLast'];
					//$node[$i+1]['state']='open';
					//$node[$i+1]['is_leaf']=1;
				}else{
					//$node[$i+1]['state']=$arr[$i]['is_leaf']?'open':'closed';//为closed时节点所有子节点都从远处服务器加载
					$node[$i+1]['state']=$arr[$i]['isLast']?'open':'closed';//为closed时节点所有子节点都从远处服务器加载
					//$node[$i+1]['is_leaf']=$arr[$i]['is_leaf'];
					$node[$i+1]['is_leaf']=$arr[$i]['isLast'];
				}
			}				
		}	
		echo json_encode($node);
		$db->Close();
	}
	
	/*
	*功能：标注无效
	*/
	function cancelSeal($id){
		$db=new DB();
		$sql="update apply set isInvalid=1 where id=$id";
		$res=$db->Update($sql);
		echo $res;
		$db->Close();	
	}
	//查询申请人所在部门
	public function getDept(){
		if($_SESSION['admin_name']){
			$db=new DB();
			$sql="SELECT userPrivileges FROM admininfo WHERE id=".$_SESSION['admin_id'];
			$arr=$db->Select($sql);
			$concat1=explode(',',$arr[0]['userPrivileges']);
			$dept=explode('_',$concat1[1]);
			if($dept[1]=='' || $dept[1]==0){
				$result=array(
					'deptName'=>'全部',
					'category'=>'.'
				);
			}
			else{
				//$sql1="SELECT cat_name FROM contentcat WHERE isDel=0 and CONCAT(upper_cat,id) = '".$dept[1]."' limit 0, 1 ";
				$sql1="SELECT catName FROM admincat WHERE isDel=0 and CONCAT(upperCat,id) like '%".$dept[1]."' limit 0, 1 ";
				$res=$db->Select($sql1);
				$result=array(
					//'deptName'=>$res[0]['cat_name'],
					'deptName'=>$res[0]['catName'],
					'category'=>$dept[1].'.'
				);
			}
			$db->Close();
		}
		else{
			$result=array(
				'deptName'=>'super',
				'category'=>'.'
			);
		}
		return $result;
	}
}
?>