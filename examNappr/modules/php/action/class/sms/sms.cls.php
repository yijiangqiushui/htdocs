<?php
/**
author:Gao Xue
date:2014-09-09
*/

class SMS{
	/**
	功能：加载树结构，得到自己的通讯录
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
		if(count($arr)!=0){
			$k=0;
			if($up_id!==0){
				for($i=0;$i<count($arr);$i++){
					if($arr[$i]['is_leaf']){
						$node[$i]['id']=$arr[$i]['id'];
						//$node[$i]['text']=$arr[$i]['cat_name'].'-'.$arr[$i]['user_id'];
						$node[$i]['text']=$arr[$i]['cat_name'];
						//$node[$i]['state']=$arr[$i]['is_leaf']?'open':'closed';//为closed时节点所有子节点都从远处服务器加载
						$node[$i]['state']='closed';//为closed时节点所有子节点都从远处服务器加载
						$node[$i]['upper_cat']=$arr[$i]['upper_cat'];
						//$node[$i]['is_leaf']=$arr[$i]['is_leaf'];
						$node[$i]['is_leaf']=0;
						$node[$i]['user_id']=$arr[$i]['user_id'];
						$node[$i]['admin_id']=$_SESSION['admin_id'];
						$k++;
					}else{
						$node[$i]['id']=$arr[$i]['id'];
						//$node[$i]['text']=$arr[$i]['cat_name'].'-'.$arr[$i]['user_id'];
						$node[$i]['text']=$arr[$i]['cat_name'];
						$node[$i]['state']=$arr[$i]['is_leaf']?'open':'closed';//为closed时节点所有子节点都从远处服务器加载
						$node[$i]['upper_cat']=$arr[$i]['upper_cat'];
						$node[$i]['is_leaf']=$arr[$i]['is_leaf'];
						$node[$i]['user_id']=$arr[$i]['user_id'];
						$node[$i]['admin_id']=$_SESSION['admin_id'];
						$k++;
					}
				}
			}else{
				for($i=0;$i<count($arr);$i++){
					if($arr[$i]['is_leaf']){
						$node[$i]['id']=$arr[$i]['id'];
						//$node[$i+1]['text']=$arr[$i]['cat_name'].'-'.$arr[$i]['user_id'];
						$node[$i]['text']=$arr[$i]['cat_name'];
						//$node[$i+1]['state']=$arr[$i]['is_leaf']?'open':'closed';//为closed时节点所有子节点都从远处服务器加载
						$node[$i]['state']='closed';//为closed时节点所有子节点都从远处服务器加载
						$node[$i]['upper_cat']=$arr[$i]['upper_cat'];
						//$node[$i+1]['is_leaf']=$arr[$i]['is_leaf'];
						$node[$i]['is_leaf']=0;
						$node[$i]['user_id']=$arr[$i]['user_id'];
						$node[$i]['admin_id']=$_SESSION['admin_id'];
						$k++;
					}else{
						$node[$i]['id']=$arr[$i]['id'];
						//$node[$i+1]['text']=$arr[$i]['cat_name'].'-'.$arr[$i]['user_id'];
						$node[$i]['text']=$arr[$i]['cat_name'];
						$node[$i]['state']=$arr[$i]['is_leaf']?'open':'closed';//为closed时节点所有子节点都从远处服务器加载
						$node[$i]['upper_cat']=$arr[$i]['upper_cat'];
						$node[$i]['is_leaf']=$arr[$i]['is_leaf'];
						$node[$i]['user_id']=$arr[$i]['user_id'];
						$node[$i]['admin_id']=$_SESSION['admin_id'];
						$k++;
					}
				}
			}	
			$sql1="select b.* from smslistcat a,smslistinfo b where b.category = CONCAT(a.upper_cat,a.id,'.') AND (b.category like '%.$up_id.' or b.category like '%.$up_id.' ) and a.user_id = ".$_SESSION['admin_id'];
			$arr1=$db->Select($sql1);
			for($i=0;$i<count($arr1);$i++){
				$node[$k]['id']=$arr1[$i]['id'];
				$node[$k]['text']=$arr1[$i]['name'];
				$node[$k]['state']='open';//为closed时节点所有子节点都从远处服务器加载
				$node[$k]['phone']=$arr1[$i]['tel'];
				$node[$k]['is_leaf']=1;
				$node[$k]['user_id']=$arr1[$i]['user_id'];
				$node[$k]['admin_id']=$_SESSION['admin_id'];
				$k++;
			}
		}else{
			$sql1="select b.* from smslistcat a,smslistinfo b where b.category = CONCAT(a.upper_cat,a.id,'.') AND (b.category like '%.$up_id.' or b.category like '%.$up_id.' ) and a.user_id = ".$_SESSION['admin_id'];
			$arr1=$db->Select($sql1);
			for($i=0;$i<count($arr1);$i++){
				$node[$i]['id']=$arr1[$i]['id'];
				$node[$i]['text']=$arr1[$i]['name'];
				$node[$i]['state']='open';//为closed时节点所有子节点都从远处服务器加载
				$node[$i]['phone']=$arr1[$i]['tel'];
				$node[$i]['is_leaf']=1;
				$node[$i]['user_id']=$arr1[$i]['user_id'];
				$node[$i]['admin_id']=$_SESSION['admin_id'];
			}
		}
		echo json_encode($node);
	}
	//他人联系人列表
	function otherTreeData($up_id,$otherID,$listID){
		$up_id= isset($up_id)?intval($up_id):0;//判断变量是否存在
		$db=new DB();
		$sql1="SELECT * FROM smslistcat WHERE id IN ($listID) AND upper_id NOT IN ($listID) AND upper_id !=0";
		$upper_arr=$db->Select($sql1);
		$str='';
		for($i=0;$i<count($upper_arr);$i++){
			$upper_catStr=str_replace(".", ",", $upper_arr[$i]['upper_cat']);
			$newstr = substr($upper_catStr,1,mb_strlen($upper_catStr,'utf-8')-2);
			if($newstr!=''){
				$str.=" or id in($newstr)";
			}
		}
		$listIDArr=explode(",",$listID);
		if($listIDArr[0]!=0){
			$sql='select * from smslistcat where upper_id ='.$up_id.' and user_id = '.$otherID.' and (id in ('.$listID.')'.$str.')';
		}else{
			$sql='select * from smslistcat where upper_id ='.$up_id.' and user_id = '.$otherID;
		}
		$arr=$db->Select($sql);

		//$sql='select * from smslistcat where upper_id ='.$up_id.' and user_id = '.$otherID;
		//$sql1="select b.* from smslistcat a,smslistinfo b where b.category = CONCAT(a.upper_cat,a.id,'.') AND a.upper_id =$up_id and a.user_id = $otherID";
		//$db=new DB();
		//$arr=$db->Select($sql);
		$listIDArr=explode(",",$listID);
		if(count($arr)!=0){
			$k=0;
			if($up_id!==0||$con_cat!==0){
				for($i=0;$i<count($arr);$i++){
					if($listIDArr[0]!=0){
						//for($j=0;$j<count($listIDArr);$j++){
							//if($listIDArr[$j]==$arr[$i]['id']){
								if($arr[$i]['is_leaf']){
									$node[$i]['id']=$arr[$i]['id'];
									//$node[$i]['text']=$arr[$i]['cat_name'].'-'.$arr[$i]['user_id'];
									$node[$i]['text']=$arr[$i]['cat_name'];
									$node[$i]['state']='closed';//为closed时节点所有子节点都从远处服务器加载
									$node[$i]['upper_cat']=$arr[$i]['upper_cat'];
									$node[$i]['is_leaf']=0;
									$k++;
								}else{
									$node[$i]['id']=$arr[$i]['id'];
									//$node[$i]['text']=$arr[$i]['cat_name'].'-'.$arr[$i]['user_id'];
									$node[$i]['text']=$arr[$i]['cat_name'];
									$node[$i]['state']=$arr[$i]['is_leaf']?'open':'closed';//为closed时节点所有子节点都从远处服务器加载
									$node[$i]['upper_cat']=$arr[$i]['upper_cat'];
									$node[$i]['is_leaf']=$arr[$i]['is_leaf'];
									$k++;
								}
							//}
						//}
					}else{
						if($arr[$i]['is_leaf']){
							$node[$i]['id']=$arr[$i]['id'];
							//$node[$i]['text']=$arr[$i]['cat_name'].'-'.$arr[$i]['user_id'];
							$node[$i]['text']=$arr[$i]['cat_name'];
							$node[$i]['state']='closed';//为closed时节点所有子节点都从远处服务器加载
							$node[$i]['upper_cat']=$arr[$i]['upper_cat'];
							$node[$i]['is_leaf']=0;
							$k++;
						}else{
							$node[$i]['id']=$arr[$i]['id'];
							//$node[$i]['text']=$arr[$i]['cat_name'].'-'.$arr[$i]['user_id'];
							$node[$i]['text']=$arr[$i]['cat_name'];
							$node[$i]['state']=$arr[$i]['is_leaf']?'open':'closed';//为closed时节点所有子节点都从远处服务器加载
							$node[$i]['upper_cat']=$arr[$i]['upper_cat'];
							$node[$i]['is_leaf']=$arr[$i]['is_leaf'];
							$k++;
						}
					}
					/*
					if($i==count($arr)-1){
						$sql1="select b.* from smslistcat a,smslistinfo b where b.category = CONCAT(a.upper_cat,a.id,'.') AND b.category like '%.$up_id.' and a.user_id = $otherID";
						//echo $sql1;
						$arr1=$db->Select($sql1);
						for($j=0;$j<count($arr1);$j++){
							$node[$i+$j+1]['id']=$arr1[$j]['id'];
							$node[$i+$j+1]['text']=$arr1[$j]['name'];
							$node[$i+$j+1]['state']='open';//为closed时节点所有子节点都从远处服务器加载
							$node[$i+$j+1]['phone']=$arr1[$j]['tel'];
							$node[$i+$j+1]['is_leaf']=1;
							$k++;
						}
					}
					*/
				}
			}else{
				for($i=0;$i<count($arr);$i++){
					if($listIDArr[0]!=0){
						for($j=0;$j<count($listIDArr);$j++){
							if($listIDArr[$j]==$arr[$i]['id']){
								$node[$i]['id']=$arr[$i]['id'];
								//$node[$i+1]['text']=$arr[$i]['cat_name'].'-'.$arr[$i]['user_id'];
								$node[$i]['text']=$arr[$i]['cat_name'];
								$node[$i]['state']=$arr[$i]['is_leaf']?'open':'closed';//为closed时节点所有子节点都从远处服务器加载
								$node[$i]['upper_cat']=$arr[$i]['upper_cat'];
								$node[$i]['is_leaf']=$arr[$i]['is_leaf'];
								$k++;
							}
						}
					}else{
						$node[$i]['id']=$arr[$i]['id'];
						//$node[$i+1]['text']=$arr[$i]['cat_name'].'-'.$arr[$i]['user_id'];
						$node[$i]['text']=$arr[$i]['cat_name'];
						$node[$i]['state']=$arr[$i]['is_leaf']?'open':'closed';//为closed时节点所有子节点都从远处服务器加载
						$node[$i]['upper_cat']=$arr[$i]['upper_cat'];
						$node[$i]['is_leaf']=$arr[$i]['is_leaf'];
						$k++;
					}
					/*
					if($i==count($arr)-1){
						$sql1="select b.* from smslistcat a,smslistinfo b where b.category = CONCAT(a.upper_cat,a.id,'.') AND b.category like '%.$up_id.' and a.user_id = $otherID";
						//echo $sql1;
						$arr1=$db->Select($sql1);
						for($j=0;$j<count($arr1);$j++){
							$node[$i+$j+1]['id']=$arr1[$j]['id'];
							$node[$i+$j+1]['text']=$arr1[$j]['name'];
							$node[$i+$j+1]['state']='open';//为closed时节点所有子节点都从远处服务器加载
							$node[$i+$j+1]['phone']=$arr1[$j]['tel'];
							$node[$i+$j+1]['is_leaf']=1;
							$k++;
						}
					}
					*/
				}				
			}
			$sql1="select b.* from smslistcat a,smslistinfo b where b.category = CONCAT(a.upper_cat,a.id,'.') AND b.category like '%.$up_id.' and a.user_id = $otherID";
			$arr1=$db->Select($sql1);
			if(count($arr1)>0){
				for($i=0;$i<count($arr1);$i++){
					$node[$k]['id']=$arr1[$i]['id'];
					$node[$k]['text']=$arr1[$i]['name'];
					$node[$k]['state']='open';//为closed时节点所有子节点都从远处服务器加载
					$node[$k]['phone']=$arr1[$i]['tel'];
					$node[$k]['is_leaf']=1;
					$k++;
				}
			}
		}else{
			$sql1="select b.* from smslistcat a,smslistinfo b where b.category = CONCAT(a.upper_cat,a.id,'.') AND b.category like '%.$up_id.' and a.user_id = $otherID";
			$arr1=$db->Select($sql1);
			if(count($arr1)>0){
				for($i=0;$i<count($arr1);$i++){
					$node[$i]['id']=$arr1[$i]['id'];
					$node[$i]['text']=$arr1[$i]['name'];
					$node[$i]['state']='open';//为closed时节点所有子节点都从远处服务器加载
					$node[$i]['phone']=$arr1[$i]['tel'];
					$node[$i]['is_leaf']=1;
				}
			}else{
				$node='';
			}
		}
		echo json_encode($node);
		$db->Close();
	}
	
	function gridData($flag,$page,$rows){
	//function gridData($page,$rows){
		$db=new DB();
		$page=($page-1)*$rows;
		$sql_query="select category from admininfo where id=".$_SESSION['admin_id']; 
		$result_cat=$db->Select($sql_query);
		$category=$result_cat[0]['category'];
		if($_SESSION['admin_id']==1){
			$sql='select * from smsinfo order by id desc';
			$sql_cou='select count(id) as "count" from smsinfo';
		}else{
			if($flag==0){
				$sql='select * from smsinfo where admin_id='.$_SESSION['admin_id'].' order by id desc';
				$sql_cou='select count(id) as "count" from smsinfo where admin_id='.$_SESSION['admin_id'];
			}else{
				if($category=='.'){
					$sql='select * from smsinfo order by id desc';
					$sql_cou='select count(id) as "count" from smsinfo';
				}else{
					$sql='select * from smsinfo where admin_id='.$_SESSION['admin_id'].' or category like \''.$category.'%\' order by id desc';
					$sql_cou='select count(id) as "count" from smsinfo where admin_id='.$_SESSION['admin_id'].' or category like \''.$category.'%\'';
				}
			}
		}
		/*
			$sql='select * from smsinfo where admin_id='.$_SESSION['admin_id'].' order by id desc';
			$sql_cou='select count(id) as "count" from smsinfo where admin_id='.$_SESSION['admin_id'];
		*/		
		$sql=$sql.' limit '.$page.','.$rows;
		$arr=$db->Select($sql);

		$arr_cou=$db->Select($sql_cou);
		$count=$arr_cou[0]['count'];
		if(count($arr)===0){
			$json='{"total":0,"rows":[]}';	
		}else{
			for($i=0;$i<count($arr);$i++){
				$phone_arr=explode(";",$arr[$i]['smsPhone']);
				//$id_arr=explode(";",$arr[$i]['smsId']);
				$isSent_arr=explode(";",$arr[$i]['isSent']);
				if(count($phone_arr)>0){
					if($phone_arr[count($phone_arr)-1]==''){
						array_pop($phone_arr);
					}
				}
				if(count($isSent_arr)>0){
					if($isSent_arr[count($isSent_arr)-1]==''){
						array_pop($isSent_arr);
					}
				}
				/*
				if(count($id_arr)>0){
					if($id_arr[count($id_arr)-1]==''){
						array_pop($id_arr);
					}
				}
				*/
				$smsPhone=$arr[$i]['smsPhone'];
				$sendName='';
				$isSent_count=0;
				$faileSent='';
				$failePhone='';
				for($j=0;$j<count($phone_arr);$j++){
					$sendName_sql="select name from smslistinfo where tel='".$phone_arr[$j]."' order by id desc limit 0,1";
					//$sendName_sql="select name from smslistinfo where id=".$id_arr[$j];
					$sendNameArr=$db->Select($sendName_sql);
					$sendName.=($sendNameArr[0]['name']==''?$phone_arr[$j]:$sendNameArr[0]['name']).';';
					if($isSent_arr[$j]==1){
						//$faileSent.=($sendNameArr[0]['name']==''?$phone_arr[$j]:$id_arr[$j].'-'.$sendNameArr[0]['name'].'('.$phone_arr[$j].')').';';
						$faileSent.=($sendNameArr[0]['name']==''?$phone_arr[$j]:$sendNameArr[0]['name'].'('.$phone_arr[$j].')').';';
						$failePhone.=$phone_arr[$j].';';
						$isSent_count++;
					}
				}
				//echo $sendName.'****'.$isSent_count.'----'.$faileSent.'@'.$failePhone.'====';
				$faileSent=$faileSent.'@'.$failePhone;
				if($arr[$i]['isSent']=='1'){
					$isSent_str='未发送';
				}else{
					$isSent_str=$isSent_count.' 条失败，'.(count($isSent_arr)-$isSent_count).' 条成功。';
				}
				$name_arr=$db->Select("select realname from admininfo where id ='".$arr[$i]['admin_id']."'");
				$arr2[$i]=array('id'=>$arr[$i]['id'],'smsPhone'=>$smsPhone,'smsName'=>$sendName,'content'=>$arr[$i]['content'],'isSent'=>$isSent_str,'Sent'=>$arr[$i]['isSent'],'sendtime'=>$arr[$i]['sendtime'],'faileSent'=>$faileSent,'admin_id'=>$arr[$i]['admin_id'],'name'=>$name_arr[0]['realname'],'myid'=>$_SESSION['admin_id']);		
				//$arr2[$i]=array('id'=>$arr[$i]['id'],'smsPhone'=>$smsPhone,'smsName'=>$sendName,'content'=>$arr[$i]['content'],'isSent'=>$arr[$i]['isSent'],'sendtime'=>$arr[$i]['sendtime']);		
			}
			$json='{"total":'.$count.',"rows":'.json_encode($arr2).'}';
		}
		echo $json;	
		$db->Close();
	}
	
	function sendSms($smsPhone,$smsinfo){
		$db=new DB();
		if(strstr($smsPhone,";")){
			$phone_arr=explode(";",$smsPhone);
			for($i=0;$i<count($phone_arr);$i++){
				if($phone_arr[$i]!=''){
					$smsinfo['smsPhone']=$phone_arr[$i];
					//echo json_encode($smsinfo);
					$res=$db->InsertData('smsinfo',$smsinfo);
					echo $res.',';
				}
			}
		}else{
			$smsinfo['smsPhone']=$smsPhone;
			$res=$db->InsertData('smsinfo',$smsinfo);
			echo $res;
		}
		$db->Close();
	}
	
	function findById($id){
		$db=new DB();
		$res[0]=$db->GetInfo($id,'smsinfo');
		$jsonArray=array('id'=>$res[0]['id'],'smsPhone'=>$res[0]['smsPhone'],'content'=>$res[0]['content']);
		$json=json_encode($jsonArray);
		echo $json;
		$db->Close();
	}
	
	function edit($id,$smsinfo){
		$db=new DB();
		$res=$db->UpdateData('smsinfo',$id,$smsinfo);
		echo $res;
		$db->Close();
	}
	
	function delSms($id){
		$db=new DB();
		$res=$db->DelData($id,'smsinfo');
		echo $res;
		$db->Close();
	}
	
	function delArrSms($idlist){
		$db=new DB();
		$res=$db->DelArrIdData($idlist,'smsinfo');
		echo $res;
		$db->Close();		
	}
	
	function getCommunicate(){
		$db=new DB();
		$sql="select * from smslistcat where user_id=".$_SESSION['admin_id'];
		$result=$db->Select($sql);
		if(!empty($result)){
			for($i=0;$i<count($result);$i++){
				$comm_arr[$i]=array(
					'id'=>$result[$i]['id'],
					'exclusive_name'=>$result[$i]['exclusive_name'],				
					'cat_name'=>$result[$i]['cat_name'],				
				);
			}
		}else{
			$comm_arr=array();
		}
		echo json_encode($comm_arr);
		$db->Close();		
	}
	
	function get_comm_list($group_id){
		$db=new DB();
		$sql="select * from smslistinfo where category like '%$group_id%' and admin_id=".$_SESSION['admin_id'];
		$result=$db->Select($sql);
		if(!empty($result)){
			for($i=0;$i<count($result);$i++){
				$comm_arr[$i]=array(
					'id'=>$result[$i]['id'],
					'name'=>$result[$i]['name'],				
					'tel'=>$result[$i]['tel'],				
					'company'=>$result[$i]['company'],				
					'job'=>$result[$i]['job'],				
				);
			}
		}
		echo json_encode($comm_arr);
		$db->Close();		
	}
	
	function get_replySms($id){
		$db=new DB();
		/*
		$sql_str="select content from smsinfo where id=$id";
		$res=$db->Select($sql_str);
		$num=substr($res[0]['content'],15,4);
		*/
		$num=$id>14?($id>254?($id>4094?dechex($id):'0'.dechex($id)):'00'.dechex($id)):'000'.dechex($id);
		$sql="select * from smsreply where replyContent like '%$num%' order by id desc";
		$result=$db->Select($sql);
		if(!empty($result)){
			for($i=0;$i<count($result);$i++){
				$sql_name="select name from smslistinfo where tel=".$result[$i]['replyPhone']." or tel=".substr($result[$i]['replyPhone'],2);;
				//$sql_name="select name from smslistinfo where tel=".$result[$i]['replyPhone'];//." or tel=".substr($result[$i]['replyPhone'],2);;
				$res_name=$db->Select($sql_name);
				
				$reply_arr[$i]=array(
					'id'=>$result[$i]['id'],
					'replyPhone'=>$result[$i]['replyPhone'],	
					'replyName'=>$res_name[0]['name'],
					'replyContent'=>$result[$i]['replyContent'],				
					'replyTime'=>$result[$i]['replyTime'],				
				);
			}
			echo json_encode($reply_arr);
		}else{
			$json=array();
			echo json_encode($json);
		}
		$db->Close();		
	}
	/*
	//获取发送进度
	function getProgress($id,$smsPhonestr){
		$db=new DB();
		$ids_sql="select ids from admininfo where id=".$_SESSION['admin_id'];
		$list_sql="select id,tel,name from smslistinfo where admin_id=".$_SESSION['admin_id'];
		$ids_str=$db->Select($ids_sql);
		$ids_arr=explode("-",$ids_str[0]['ids']);
		if(count($ids_arr)>0){
			if($ids_arr[count($ids_arr)-1]==''){
				array_pop($ids_arr);
			}
		}
		for($i=0;$i<count($ids_arr);$i++){
			if($ids_arr[$i]!=''){
				$idsArr=explode(":",$ids_arr[$i]);
				$list_sql.=" or admin_id=".$idsArr[0];
			}
		}
		$result_Arr=$db->Select($list_sql);
		//得到收件人的电话号码串
		if($id==0){
			$smsPhoneArr=explode(";",$smsPhonestr);
			if(count($smsPhoneArr)>0){
				if($smsPhoneArr[count($smsPhoneArr)-1]==''){
					array_pop($smsPhoneArr);
				}
				for($i=0;$i<count($smsPhoneArr);$i++){
					$phone_id_arr=explode("<",$smsPhoneArr[$i]);
					if(count($phone_id_arr)>1){
						$phone_id=explode("-",$phone_id_arr[1]);
						$phoneStr.=$phone_id[0].';';
						$idStr.=substr($phone_id[1],0,strlen($phone_id[1])-1).';';
					}else{
						$sql_id="select id from smslistinfo where tel=".$smsPhoneArr[$i]; 
						$result_id=$db->Select($sql_id);
						if(count($result_id)>0){
							$idStr.=$result_id[0]['id'].';';
						}else{
							$idStr.='0;';
						}
						$phoneStr.=$smsPhoneArr[$i].';';
					}
				}
			}else{
				$sql_id="select id from smslistinfo where tel=".$smsPhonestr; 
				$result_id=$db->Select($sql_id);
				if(count($result_id)>0){
					$idStr=$result_id[0]['id'].';';
				}else{
					$idStr='0;';
				}
				$phoneStr.=$smsPhone.';';
			}
			$smsPhonestr=$phoneStr;
		}
		//替换
		$idStr=$smsPhonestr;
		for($i=0;$i<count($result_Arr);$i++){
			$smsPhonestr=str_replace($result_Arr[$i]['name'],$result_Arr[$i]['tel'],$smsPhonestr);
			$idStr=str_replace($result_Arr[$i]['name'],$result_Arr[$i]['id'],$idStr);
		}
		if($_SESSION['flag']!=0){
			$phone_arr=explode(";",$smsPhonestr);
			$phone_arr=array_unique($phone_arr);
			if($phone_arr[count($phone_arr)-1]==''){
				array_pop($phone_arr);
			}
			$smsPhone=implode(";",$phone_arr);
			$phone_total=count($phone_arr);
			if($id==0){
				$id_sql="select id from smsinfo order by id desc limit 0,1";
				$res=$db->Select($id_sql);
				$id=$res[0]['id'];
			}
			$sql="select sentCount from smsinfo where smsPhone='$smsPhone' or smsPhone='$smsPhone;' and id=$id";
			$result=$db->Select($sql);
			$sentCount=$result[0]['sentCount'];
			//echo $sql;
			$json=array(
				'total'=>$phone_total,
				'count'=>$sentCount,
			);
			echo json_encode($json);
			$db->Close();	
		}else{
			echo 0;
		}
	}
*/
	function getSmsTotal($content,$isReply,$inscribe,$smsPhone){
		//echo '正在发送消息，发送完毕本页面将自动关闭';
		$db=new DB();
		if($inscribe==''){
			$content_str=$content;
		}else{
			$content_str=$content.'【'.$inscribe.'】';
		}
		$admin_id=$_SESSION['admin_id'];
		$sql_query="select category from admininfo where id=".$_SESSION['admin_id']; 
		$result_cat=$db->Select($sql_query);
		$category=$result_cat[0]['category'];
		
		$smsPhoneArr=explode(";",$smsPhone);
		if(count($smsPhoneArr)>1){
			if($smsPhoneArr[count($smsPhoneArr)-1]==''){
				array_pop($smsPhoneArr);
			}
			for($i=0;$i<count($smsPhoneArr);$i++){
				$phone_id_arr=explode("<",$smsPhoneArr[$i]);
				if(count($phone_id_arr)>1){
					//$phone_id=explode("-",$phone_id_arr[1]);
					//$phoneStr.=$phone_id[0].';';
					//$idStr.=substr($phone_id[1],0,strlen($phone_id[1])-1).';';
					$phoneStr.=substr($phone_id_arr[1],0,strlen($phone_id[1])-1).';';
				}else{
					/*
					$sql_id="select id from smslistinfo where tel=".$smsPhoneArr[$i]; 
					$result_id=$db->Select($sql_id);
					if(count($result_id)>0){
						$idStr.=$result_id[0]['id'].';';
					}else{
						$idStr.='0;';
					}
					*/
					$phoneStr.=$smsPhoneArr[$i].';';
				}
				$isSent.='1;';
			}
		}else{
			/*
			$sql_id="select id from smslistinfo where tel=".$smsPhone; 
			$result_id=$db->Select($sql_id);
			if(count($result_id)>0){
				$idStr=$result_id[0]['id'].';';
			}else{
				$idStr='0;';
			}
			*/
			$phoneStr.=$smsPhone.';';
			$isSent='1;';
		}
		//$sql_insert="insert into smsinfo (content,smsId,smsPhone,admin_id,category) values ('$content_str','$idStr','$phoneStr',$admin_id,'$category')";
		$sql_insert="insert into smsinfo (content,smsPhone,admin_id,category) values ('$content_str','$phoneStr',$admin_id,'$category')";
		$res=$db->Insert($sql_insert);
		
		if($res>0){
			if($isReply=='true'){
				$str=$res>14?($res>254?($res>4094?dechex($res):'0'.dechex($res)):'00'.dechex($res)):'000'.dechex($res);
				if($inscribe==''){
					$content_str=$content.'请回复编号"'.$str.'"加回复信息';
				}else{
					$content_str=$content.'【'.$inscribe.'】'.'请回复编号"'.$str.'"加回复信息';
				}
				$sql_str="update smsinfo set content='$content_str' where id=$res";
				$db->Update($sql_str);
			}
			$json=array(
				'message'=>$_SESSION['flag'],
				'content'=>$content_str,
				'id'=>$res,
				'phone'=>$phoneStr,
				'admin_id'=>$admin_id,
				'isSent'=>$isSent,
			);
			echo json_encode($json);
			return;
				/*
			
			if($_SESSION['flag']!=0){//如果是Ukey登录
				//$url = "http://localhost:8080/message/msgsend.htm?admin_id=".$admin_id."&smsPhone=".$smsPhone."&content=".$content_str."&id=".($res);
				$url = "http://".$_SERVER["HTTP_HOST"].":83/message/msgsend.htm?isSent=1"."&admin_id=".$admin_id."&smsPhone=".$phoneStr."&content=".$content_str."&id=".($res);
				$ch = curl_init();
				curl_setopt ($ch, CURLOPT_URL, $url);
				curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT,10);
				$img = curl_exec($ch); 
				curl_close($ch);
				print_r($img);
				//echo '<script>window.close();</script>';
			}else{
				$json=array('message'=>'保存成功，请找管理员进行短信发送！');
				echo json_encode($json);
			}
			*/
		}else{
			$json=array('message'=>'error');
			echo json_encode($json);
		}
		/*
		$json_arr=array(
			'count'=>$result[0]['count'],
			'admin_id'=>$_SESSION['admin_id'],
		);
		echo json_encode($json_arr);
		*/
		$db->Close();		
	}
	
	function adminSendSms($id){
		$db=new DB();
		$sql="select content,smsPhone,admin_id,isSent from smsinfo where id=$id";
		$result=$db->Select($sql);
		$admin_id=$result[0]['admin_id'];
		$isSent=$result[0]['isSent'];
		$smsPhone=$result[0]['smsPhone'];
		$content_str=$result[0]['content'];
		if($result[0]['isSent']==1){
			if($_SESSION['flag']!=0){//如果是Ukey登录
				$url = "http://".$_SERVER["HTTP_HOST"].":83/message/msgsend.htm?isSent=".$isSent."&admin_id=".$admin_id."&smsPhone=".$smsPhone."&content=".$content_str."&id=".$id;
				//$url = "http://localhost:8080/message/msgsend.htm?admin_id=".$admin_id."&smsPhone=".$smsPhone."&content=".$content_str."&id=".$id;
				$ch = curl_init();
				curl_setopt ($ch, CURLOPT_URL, $url);
				curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT,10);
				$img = curl_exec($ch); 
				curl_close($ch);
				print_r($img);
			}else{
				$json=array('message'=>'您不是管理员，请找管理员进行短信发送！');
				echo json_encode($json);
			}
		}else{
			$json=array('message'=>'此短信已经发送过，再次发送请重新编辑！');
			echo json_encode($json);
		}
		$db->Close();		
	}

	function reSendFaileSms($id,$failePhone){
		$db=new DB();
		$sql="select content,smsPhone,admin_id,isSent from smsinfo where id=$id";
		$result=$db->Select($sql);
		/*
		$smsIdArr=explode(";",$result[0]['smsId']);
		$smsPhoneArr=explode(";",$result[0]['smsPhone']);
		$smsTel='';
		if($smsIdArr[count($smsIdArr)-1]==''){
			array_pop($smsIdArr);
		}
		for($i=0;$i<count($smsIdArr);$i++){
			$flags=true;
			$faile_idArr=explode(";",$id_str);
			$failePhoneArr=explode(";",$failePhone);
			if($faile_idArr[count($faile_idArr)-1]==''){
				array_pop($faile_idArr);
			}
			for($j=0;$j<count($faile_idArr);$j++){
				if($smsIdArr[$i]==$faile_idArr[$j]){
					if($smsIdArr[$i]=='0'){
						$failePhones.=$failePhoneArr[$j].';';
						$smsTel.=$failePhoneArr[$j].';';
					}else{
						$get_tel_sql="select tel from smslistinfo where id=".$faile_idArr[$j];
						$res=$db->Select($get_tel_sql);
						$failePhones.=$res['0']['tel'].';';
						$smsTel.=$res['0']['tel'].';';
					}
					$flags=false;
					break;
				}
			}
			if($flags){
				$smsTel.=$smsPhoneArr[$i].';';
			}
		}
		$upt_sql="update smsinfo set smsPhone=".$smsTel." where id=$id";
		$db->Update($upt_sql);
		*/
		$admin_id=$result[0]['admin_id'];
		$isSent=$result[0]['isSent'];
		$smsPhone=$failePhone;
		$content_str=$result[0]['content'];
		$json=array(
			'id'=>$id,
			'admin_id'=>$admin_id,
			'isSent'=>$isSent,
			'smsPhone'=>$smsPhone,
			'content'=>$content_str,
		);
		echo json_encode($json);
		return;
		/*
		if($_SESSION['flag']!=0){//如果是Ukey登录
			$uptsentCount_sql="update smsinfo set sentCount='0' where id=$id";
			$db->Update($uptsentCount_sql);
			$url = "http://".$_SERVER["HTTP_HOST"].":83/message/msgsend.htm?isSent=".$isSent."&smsPhone=".$smsPhone."&content=".$content_str."&id=".$id;
			//$url = "http://localhost:8080/message/msgsend.htm?admin_id=".$admin_id."&smsPhone=".$smsPhone."&content=".$content_str."&id=".$id;
			$ch = curl_init();
			curl_setopt ($ch, CURLOPT_URL, $url);
			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT,10);
			$img = curl_exec($ch); 
			curl_close($ch);
			print_r($img);
		}else{
			$json=array('message'=>'您不是管理员，请找管理员进行短信发送！');
			echo json_encode($json);
		}
		*/
		$db->Close();		
	}
	
	function reload_reply(){
		//$url = "http://localhost:8080/message/msgread.htm";
		$url = "http://".$_SERVER["HTTP_HOST"].":83/message/msgread.htm";
		$ch = curl_init();
		curl_setopt ($ch, CURLOPT_URL, $url);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT,10);
		$img = curl_exec($ch); 
		curl_close($ch);
		print_r($img);
	}
		
	function getOtherReply($id,$phoneStr,$sendtime,$page,$rows){
		$db=new DB();
			$id_str=$id>14?($id>254?($id>4094?dechex($id):'0'.dechex($id)):'00'.dechex($id)):'000'.dechex($id);
			//$str=$id>8?($id>98?($id>998?($id+1):'0'.($id+1)):'00'.($id+1)):'000'.($id+1);
		$phoneArr=explode(';',$phoneStr);
		for($i=0;$i<count($phoneArr);$i++){
			$phoneArr_str.='\''.$phoneArr[$i].'\',\'86'.$phoneArr[$i].'\'';
			if($i<count($phoneArr)-1){
				$phoneArr_str.=',';
			}
		}
		$page=($page-1)*$rows;
		$sendtime=substr($sendtime,0,10).' 00:00:00';
		$sql="select * from smsreply where replyContent not like '%$id_str%' and replyPhone in ($phoneArr_str) and replyTime>='$sendtime' order by id desc limit $page,$rows";
		$sqlCount="select count(id) as count from smsreply where replyContent not like '%$id_str%' and replyPhone in ($phoneArr_str) and replyTime>='$sendtime' order by id desc";
		$result=$db->Select($sql);
		$arr_cou=$db->Select($sqlCount);
		$count=$arr_cou[0]['count'];
		if(!empty($result)){
			for($i=0;$i<count($result);$i++){
				$sql_name="select name from smslistinfo where tel=".$result[$i]['replyPhone']." or tel=".substr($result[$i]['replyPhone'],2);
				$res_name=$db->Select($sql_name);
				
				$reply_arr[$i]=array(
					'id'=>$result[$i]['id'],
					'replyPhone'=>$result[$i]['replyPhone'],	
					'replyName'=>$res_name[0]['name'],
					'replyContent'=>$result[$i]['replyContent'],				
					'replyTime'=>$result[$i]['replyTime'],				
				);
			}
			$json='{"total":'.$count.',"rows":'.json_encode($reply_arr).'}';
		}else{                                                                                                           
			$json='{"total":0,"rows":[]}';	
		}
		echo $json;
		$db->Close();		
	}

	function exportReply($id,$phoneStr,$sendtime){
		$id_str=$id>9?($id>99?($id>999?$id:'0'.$id):'00'.$id):'000'.$id;
		$phoneArr=explode(';',$phoneStr);
		for($i=0;$i<count($phoneArr);$i++){
			$phoneArr_str.='\''.$phoneArr[$i].'\',\'86'.$phoneArr[$i].'\'';
			if($i<count($phoneArr)-1){
				$phoneArr_str.=',';
			}
		}
		$url = "http://".$_SERVER["HTTP_HOST"].":83/message/replyexport.htm?id_str=$id_str&phoneStr=$phoneArr_str";//&sendtime=$sendtime";
		//$url = "http://localhost:8080/message/replyexport.htm?id_str=$id_str&phoneStr=$phoneArr_str";//&sendtime=$sendtime";
		$ch = curl_init();
		curl_setopt ($ch, CURLOPT_URL, $url);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT,10);
		$img = curl_exec($ch); 
		curl_close($ch);
		print_r($img);
	}
	
	function getYE(){
		$db=new DB();
		$sql="SELECT replyContent,id FROM smsreply WHERE replyPhone='10010'AND replyContent LIKE '%您的帐户可用余额为%' order by id desc limit 0,1";
		$result=$db->Select($sql);
		$replyContent=$result[0]['replyContent'];
		$replyContentArr=explode("您的帐户可用余额为",$replyContent);
		$balance=explode("元",$replyContentArr[1]);
		$json=array(
			'balance'=>$balance[0],
			'flag'=>$_SESSION['flag'],		
		);
		//$del_sql="delete from smsreply where replyPhone='10010' and id!=".$result[0]['id'];
		//$db->Delete($del_sql);
		echo json_encode($json);
		$db->Close();
		return;
		/*
		$isSent=1;
		$smsPhone='10010';
		$content_str='CXHF';
		$admin_id=$_SESSION['admin_id'];
		$db=new DB();
		$sql_query="select category from admininfo where id=".$_SESSION['admin_id']; 
		$result_cat=$db->Select($sql_query);
		$category=$result_cat[0]['category'];
		$sql_insert="insert into smsinfo (content,smsPhone,admin_id,category) values ('$content_str','$smsPhone',$admin_id,'$category')";
		$res=$db->Insert($sql_insert);
		if($res>0){
			$db->Close();
			if($_SESSION['flag']!=0){//如果是Ukey登录
				$url = "http://".$_SERVER["HTTP_HOST"].":83/message/msgsend.htm?isSent=".$isSent."&smsPhone=".$smsPhone."&content=".$content_str."&id=".$id;
				//$url = "http://localhost:8080/message/msgsend.htm?admin_id=".$admin_id."&smsPhone=".$smsPhone."&content=".$content_str."&id=".$id;
				$ch = curl_init();
				curl_setopt ($ch, CURLOPT_URL, $url);
				curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT,10);
				$img = curl_exec($ch); 
				curl_close($ch);
				print_r($img);
				$this->reload_reply();
			}else{
				echo $_SESSION['flag'];
			}
		}
		*/
	}
	
//获取通讯录信息
	function getAllSmsList($phone){
		$db=new DB();
		$admin_id=$_SESSION['admin_id'];
		$sql="select * from smslistinfo where tel='$phone' and admin_id=$admin_id limit 0,1";
		$result=$db->Select($sql);
		if(count($result)>0){
		if($result[0]['category']!=null&&$result[0]['category']!=''){
			if($result[0]['category']=='.'){
				$catId=0;
			}else{
				$arr=explode('.',$result[0]['category']);
				$num=count($arr)-2;
				$catId=$arr[$num];
				$sqlcat="select cat_name from smslistcat where id=$arr[$num]";
				$dept=$db->Select($sqlcat);
				//$jsonArray=array('catId'=>$num,);
			}
		}
		$jsonArray=array(
						'id'=>$result[0]['id'],
						'upper_text'=>$dept[0][0],
						'category'=>$result[0]['category'],
						'name'=>$result[0]['name'],
						'tel'=>$result[0]['tel'],
						'company'=>$result[0]['company'],
						'job'=>$result[0]['job'],
						'catId'=>$catId,
					);
		}else{
			$jsonArray=array();
		}
		//$json=json_encode($jsonArray);
		echo json_encode($jsonArray);
		$db->Close();
	}
	
//修改通讯录信息
	function updInfo($id,$phone,$conInfo){
		$db=new DB();
		$db->UpdateData('smslistinfo',$id,$conInfo);
		$tel=$conInfo['tel'];
		$admin_id=$_SESSION['admin_id'];
		$sql="update smslistinfo set tel='$tel' where tel='$phone' and admin_id=$admin_id";
		$db->Update($sql);
		$sql1="SELECT * FROM smsinfo WHERE smsPhone LIKE '%$phone%' and admin_id=$admin_id";
		$result=$db->Select($sql1);
		for($i=0;$i<count($result);$i++){
			$smsPhoneArr=explode(';',$result[$i]['smsPhone']);
			if($smsPhoneArr[count($smsPhoneArr)-1]==''){
				array_pop($smsPhoneArr);
			}
			$smsPhoneStr='';
			for($j=0;$j<count($smsPhoneArr);$j++){
				if($smsPhoneArr[$j]==$phone){
					$smsPhoneStr.=$tel.';';
				}else{
					$smsPhoneStr.=$smsPhoneArr[$j].';';
				}
			}
			$sms_id=$result[$i]['id'];
			$edit_sql="update smsinfo set smsPhone='$smsPhoneStr' where id=$sms_id";
			$db->Update($edit_sql);
		}
		$db->Close();
	}
	
	function sendToPhone($id,$admin_id,$smsPhone,$isSent){
		$db=new DB();
		$sql="select isSent,content from smsinfo where id =$id";
		$result=$db->Select($sql);
		$content=$result[0]['content'];
		if($result[0]['isSent']=='1'){
			$sql="update  smsinfo set isSent='$isSent' where id =$id";
			$db->Update($sql);
		}else{
			$isSent=$result[0]['isSent'];
		}
		$db->Close();
		$url = "http://".$_SERVER["HTTP_HOST"].":83/message/msgsend.htm?isSent=".$isSent."&smsPhone=".$smsPhone."&content=".$content."&id=".$id;
		$ch = curl_init();
		curl_setopt ($ch, CURLOPT_URL, $url);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT,10);
		$img = curl_exec($ch); 
		curl_close($ch);
		print_r($img);
	}
	
	function getReplyContent($id){
		$db=new DB();
		$sql="select replyContent from smsreply where id =$id";
		$result=$db->Select($sql);
		$json=array(
			'replyContent'=>$result[0]['replyContent'],
		);
		echo json_encode($json);
		$db->Close();
	}
	
	function editSmsPhone($id,$phone,$smsphone){
		$db=new DB();
		$sql="select smsPhone from smsinfo where id =$id";
		$result=$db->Select($sql);
		$smsPhoneArr=explode(';',$result[0]['smsPhone']);
		if($smsPhoneArr[count($smsPhoneArr)-1]==''){
			array_pop($smsPhoneArr);
		}
		for($i=0;$i<count($smsPhoneArr);$i++){
			if($smsPhoneArr[$i]==$phone){
				$smsPhone.=$smsphone.';';
			}else{
				$smsPhone.=$smsPhoneArr[$i].';';
			}
		}
		$sql1="update  smsinfo set smsPhone='$smsPhone' where id =$id";
		$res=$db->Update($sql1);
		echo $res;
		$db->Close();
	}
	//获取通讯录搜索结果
	function getSearch($condition,$catList){
		$db=new DB();
		$category=array();
		for($i=0; $i<count($catList); $i++){
			$sql1="select concat(upper_cat,id,'.') from smslistcat where id=$catList[$i]";
			$cate=$db->Select($sql1);
			$category[$i]=$cate[0][0];
		}
		$category_str=implode(',',$category);
		$sql="select name,tel from smslistinfo where (name like '%$condition%' or tel like '%$condition%') and (category in ('$category_str') or admin_id =".$_SESSION['admin_id'].")";
		$res=$db->Select($sql);
		for($i=0; $i<count($res); $i++){
			$json[$i]=array(
				'name'=>$res[$i]['name'],
				'tel'=>$res[$i]['tel']
			);	
		}
		echo json_encode($json);
	}
	
}
?>